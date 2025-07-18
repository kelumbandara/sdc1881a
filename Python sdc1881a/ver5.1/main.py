# python 3.11
#ver 5
#04/04/2025
#Logger Time Zone SL
#Update connection functions
#add try catchs
#runtime err 
#add mysql closed

#remmove or condition in timer
#remove send null worksenter values
#Tower lamp
#Remove Unwanted Code Lines And comments


 
import random
import time
import mysql.connector
import json
from paho.mqtt import client as mqtt_client
from mysql.connector import Error
from datetime import datetime 
import pytz
import logging
import sys
from datetime import timedelta
from pytz import timezone
import subprocess
count=0
#broker ='perahara.lk'
broker ='smartandons.com'
port = 1883
#subscribe_topic="sss"
#strPublishTopic="sky/iot-4to20ma-module-4ch/pub/v1/svr/buzzer"
strPublishTopic="SDC-5291A"
subscribe_topic ="sky/iot-4to20ma-module-4ch/pub/v1/svr/#"
#subscribe_topic ="sky/iot-4to20ma-module-4ch/pub/v1/svr/startup/sky-iot-4to20ma-4ch/none/5C013B6BD674"
# Generate a Client ID with the subscribe prefix.
client_id = f'subscribe-{random.randint(0, 100)}'
# username = 'emqx'
# password = 'public'
# Define global variables for MySQL connection details
MYSQL_HOST = "localhost"
MYSQL_USER = "root"
MYSQL_PASSWORD = ""
#MYSQL_PASSWORD = "sKy@1234"
MYSQL_DATABASE = "sdc1881a"
connection=""
DebugEnable=1
msg_payload_have_mac=0
Correct_Message_Format=0
Valid_JSon=0
mqttConnetionFaild=0

# Define the Colombo timezone
colombo_tz = pytz.timezone('Asia/Colombo')
# Get the current server datetime in the Colombo timezone
server_datetime = datetime.now(colombo_tz)
server_datetime = server_datetime.strftime('%Y-%m-%d %H:%M:%S')
server_datetime=datetime.strptime(server_datetime, '%Y-%m-%d %H:%M:%S')
Towerlamp_Red_Time=None
def timetz(*args):
    return datetime.now(tz).timetuple()
tz = timezone('Asia/Colombo') 
logging.Formatter.converter = timetz

# Configure logging
logging.basicConfig(
    filename='logging.log',  # Log file name
    level=logging.INFO,    # Log level to capture INFO and ERROR messages
    format='%(asctime)s - %(levelname)s - %(message)s'  # Log message format
    
)
print("Ver 5")

def on_message(client, userdata, msg):
    if DebugEnable==1:
        print(" ")
        print(msg.payload.decode())
    x=CheckItPlainText(msg)

    ErrorCode=100
    if(x==0):
       #Incorrect Plain Text( Example= test)
        if DebugEnable==1:
            print("InCorrect Message Format")
            logging.error("InCorrect Message Format")
        send_RuntimeError("CR","ErrorCode=100","JSON decode error: Expecting value: line 1 column 1 (char 0)","on_message(client, userdata, msg)","While checking whether the MQTT message format is correct ","InCorrect Message Format")
        return 0
    
    msg_payload = msg.payload.decode()  # Decode the payload
    #Incorrect JSON ( Example:"test")
    if msg_payload[0] == '"' and msg_payload[-1] == '"':
        if DebugEnable==1:
            print("InCorrect Message Format")
            logging.error("InCorrect Message Format")
        send_RuntimeError("CR","ErrorCode=100","","on_message","While checking whether the MQTT message format is correct","InCorrect MQTT Message Format")
        return 0
   
    #print("Raw payload:", msg_payload)  # Debugging step
    msg_payload = msg_payload.replace("'", '"')
    msg_payload = json.loads(msg_payload)
    #print("Parsed payload:", msg_payload)  # Debugging step
    
    #Validate MQTT format
    expected_json_format_1=['msg_idx', 'mac', 'event', 'Data']
    expected_json_format_2=['msg_idx', 'mac', 'device', 'network', 'startup', 'fw', 'hw']
    expected_json_format_3=['msg_idx', 'mac', 'device', 'network', 'startup', 'fw', 'hw', 'error']
    expected_json_format_4=['msg_idx' ,'mac','device','network','startup','fw','hw']
    expected_json_format_5=['msg_idx' ,'mac','device','network','startup','fw','hw']

    lists = [] #json format
    for key,values in msg_payload.items():
        lists.append(key)
   
    #Check MAC address is Available in Reseved MQTT?
    ErrorCode=120
    if "mac"in msg_payload:
        msg_payload_have_mac=1
        if DebugEnable==1:
            print("This Message have a MAC")
       
    else:
        msg_payload_have_mac=0
        if DebugEnable==1:
            print("MAC address is not available in MQTT")
            #print(msg_payload_have_mac)
            logging.error("MAC address is not available in MQTT")
        #send_RuntimeError("1","1","1","1","1","MAC address is not available in MQTT")
        send_RuntimeError("MN","ErrorCode=120","","on_message(client, userdata, msg)","while checking if the MAC address is included in MQTT "+MacAdd,"MAC address is not available in MQTT"+MacAdd)
        return 0
    
    ErrorCode=130
    if "event"in msg_payload:
        msg_payload_have_event=1
        if DebugEnable==1:
            print("This is Event Message")
    else:
        msg_payload_have_event=0
        send_RuntimeError("MJ","ErrorCode=130","","on_message","while checking if the MAC address is included in MQTT","MAC address is not available in MQTT")

    #Check if mac address have in setting table
    MAC     = msg_payload['mac']
    MAC_Available_Database=Check_Mac(MAC)
    
    if MAC_Available_Database==1:
        ErrorCode=140
        #Check Message Format in Reseved MQTT?
        if(msg_payload_have_event==1):
            if(lists==expected_json_format_1 ):   #Event Data
                Correct_Message_Format=1
                MacAdd     = msg_payload['mac'] 
                first_sensor_value =msg_payload['Data']['sensor_data'][0]['value']
                second_sensor_value =msg_payload['Data']['sensor_data'][1]['value']
                Timers= Timer(MacAdd,client,first_sensor_value,second_sensor_value)
                Towerlamp(MacAdd,client,first_sensor_value,second_sensor_value)
               
        if(lists==expected_json_format_4 ):
            msg_type      = msg_payload['startup'] ['rst_rsn']
            MAC           = msg_payload['mac'] 
            ServerDateTime = datetime.now(colombo_tz)
            DeviceEventNumber=''
            DevicePowerOnCount=msg_payload['startup'] ['pwron_cnt']
            DeviceReconnectCount=msg_payload['startup'] ['recon_cnt']
            UnitID=msg_payload['device'] ['uuid']
            
            if DebugEnable==1:
                print("msg_type",msg_type)
            PwrOnMSG(MAC,UnitID,ServerDateTime,DevicePowerOnCount,DeviceReconnectCount)
            
    if MAC_Available_Database==0:
        if DebugEnable==1:
            print("MAC_Not Available_Database ",MAC)
        time.sleep(2)
        send_RuntimeError("MJ","ErrorCode=140","","on_message","while checking if the MAC address is included in database",f"MAC_Not Available_Database: {MAC}")


ErrorCode=150
def Check_Mac(MAC):
    connection = mysql.connector.connect(
        host    =MYSQL_HOST,
        user    =MYSQL_USER,
        password=MYSQL_PASSWORD,
        database=MYSQL_DATABASE
        )
    try:
        mac_filter = """SELECT * FROM tbl_workcenter_settings WHERE MAC_address IS NOT NULL AND MAC_address = %s"""
        cursor = connection.cursor()
        cursor.execute(mac_filter, (MAC,))
        result = cursor.fetchone()
        
        ErrorCode=100
        if result:
            if DebugEnable == 1:
                print("MacAdd is  Available in Database tbl_work_center_setting  table")
            return 1
        else:
            return 0
    except Exception as e:
        print (e)
    finally:
        if connection.is_connected():
            cursor.close()
            connection.close()

ErrorCode=160
def CheckItPlainText(msg):
    msg_payload = msg.payload.decode()
    try:
        json.loads(msg_payload)
        return 1  # Return 1 if valid JSON
    except json.JSONDecodeError :
        
        if(msg_payload=='"'+msg_payload+'"'):
            if DebugEnable == 1:
                print("It is not valid JSON")
            send_RuntimeError("CR","ErrorCode=160","","on_message","While checking whether the MQTT message format is correct","InCorrect MQTT Message Format ,It is Plain Text")
        return 0  # Return 0 if not valid JSON

ErrorCode=170
def PwrOnMSG(MAC,UnitID,ServerDateTime,DevicePowerOnCount,DeviceReconnectCount):
    connection = mysql.connector.connect(
        host    =MYSQL_HOST,
        user    =MYSQL_USER,
        password=MYSQL_PASSWORD,
        database=MYSQL_DATABASE
        )
    cursor = connection.cursor()
    try:
        #Database last Power On count
        Quary_1="""SELECT DevicePowerOnCount FROM `tblmc_devicepoweron`WHERE MAC_Address = %s ORDER BY `ServerDateTime` DESC LIMIT 1;"""
        cursor.execute(Quary_1,(MAC,))
        DB_power_on_count=cursor.fetchone()

        if(DB_power_on_count==None):
            sql_query = """INSERT INTO tblmc_devicepoweron (UnitID,MAC_Address,ServerDateTime,DevicePowerOnCount)VALUES (%s,%s,%s,%s)"""
            cursor.execute(sql_query, (UnitID,MAC,ServerDateTime,DevicePowerOnCount))
            connection.commit()
        else:
            DB_power_on_count=int(DB_power_on_count[0])
            if(DB_power_on_count<DevicePowerOnCount):
                sql_query = """INSERT INTO tblmc_devicepoweron (UnitID,MAC_Address,ServerDateTime,DevicePowerOnCount)VALUES (%s,%s,%s,%s)"""
                cursor.execute(sql_query, (UnitID,MAC,ServerDateTime,DevicePowerOnCount))
                connection.commit()
                if DebugEnable==1:
                    print(MAC," power on message saved ") 
                    logging.info(MAC," power on message saved ")

        #Database last Reconnection On count
        Quary_2="""SELECT DeviceReconnectCount FROM `tblmc_devicereconnect` WHERE MAC_Address = %s ORDER BY `ServerDateTime` DESC LIMIT 1"""
        cursor.execute(Quary_2,(MAC,))
        DB_Reconnection_count=cursor.fetchone()

        if(DB_Reconnection_count==None):
            sql_query2 = """INSERT INTO tblmc_devicereconnect (UnitID,MAC_Address,ServerDateTime,DeviceReconnectCount)VALUES (%s,%s,%s,%s)"""
            cursor.execute(sql_query2, (UnitID,MAC,ServerDateTime,DeviceReconnectCount))
            connection.commit()
            if DebugEnable==1:
                print(MAC," Reconnect message saved ")  
                logging.info(MAC," Reconnect message saved ")
        else:
            DB_Reconnection_count=int(DB_Reconnection_count[0])
            if(DB_Reconnection_count < DeviceReconnectCount):
                sql_query2 = """INSERT INTO tblmc_devicereconnect (UnitID,MAC_Address,ServerDateTime,DeviceReconnectCount)VALUES (%s,%s,%s,%s)"""
                cursor.execute(sql_query2, (UnitID,MAC,ServerDateTime,DeviceReconnectCount))
                connection.commit()
                if DebugEnable==1:
                    print(MAC," Reconnect message saved ")
    except Exception as e:
            print("Exception:",e)  
            logging.error(e)
    if connection.is_connected():
         cursor.close()
         connection.close()

ErrorCode=180
def send_RuntimeError(AlarmCategory,ErrorCode,ErrorCatched,MainLocation,SubLocation,Details):
        connection = mysql.connector.connect(
        host    =MYSQL_HOST,
        user    =MYSQL_USER,
        password=MYSQL_PASSWORD,
        database=MYSQL_DATABASE
        )
        cursor = connection.cursor()
        try:
            sql_query = """INSERT INTO tblmc_runtime_errors (ServerDateTime,AlarmCategory,ErrorCode,ErrorCatched,MainLocation,SubLocation,Details)VALUES (%s, %s, %s, %s, %s, %s, %s)"""
            cursor.execute(sql_query, (server_datetime,AlarmCategory,ErrorCode,ErrorCatched,MainLocation,SubLocation,Details))
            connection.commit()
        except Exception as e:
            send_RuntimeError("CR","ErrorCode=180",str(e),"send_RuntimeError","Save Runtime Error on Database",str(e))
            if DebugEnable==1:
                print(f"Runtime Error Saving Error{e}")
                logging.error(e)
        finally:
           if connection.is_connected():
                cursor.close()
                connection.close()

def get_last_server_datetime_in_Energy(strUnitID):
    print(strUnitID)

#Timer 1
def Timer(MacAdd,client,first_sensor_value,second_sensor_value):
    
    time.sleep(2)
    #print("Timer")
    colombo_tz = pytz.timezone('Asia/Colombo')
    # Get the current server datetime in the Colombo timezone
    server_datetime = datetime.now(colombo_tz)

  #Database Connection
    connection = mysql.connector.connect(
    host    =MYSQL_HOST,
    user    =MYSQL_USER,
    password=MYSQL_PASSWORD,
    database=MYSQL_DATABASE
    
    )

    #find worksenters
    get_WorkCenter = """SELECT Workcenter_1, Workcenter_2 FROM `tbl_workcenter_settings` WHERE MAC_address = %s;"""
    cursor = connection.cursor()
    cursor.execute(get_WorkCenter, (MacAdd,))
    Workcenters = cursor.fetchall()

    if Workcenters is None:
        print(f"MAC address {MacAdd} not found in `tbl_workcenter_settings`.")
    else:

        for row in Workcenters:
                global Workcenter_1, Workcenter_2  # Declare them as  inside the loop
                Workcenter_1 = row[0]  # First column
                Workcenter_2 = row[1]  # Second column
                if DebugEnable==1:
                    print("Workcenter_1:", Workcenter_1)
                    print("Workcenter_2:", Workcenter_2)
                time.sleep(1)

        #Now Time
        colombo_tz = pytz.timezone('Asia/Colombo')
        server_datetime = datetime.now(colombo_tz)
        server_datetime = server_datetime.strftime('%Y-%m-%d %H:%M:%S')
        server_datetime=datetime.strptime(server_datetime, '%Y-%m-%d %H:%M:%S')

        #Find Last Data Inserted  last_Data_Inserted_Time_summary table
        query2= """ SELECT LastUpdatedTime FROM `tbl_summary_air_flow` WHERE WorkCenter=%s ORDER BY LastUpdatedTime DESC LIMIT 1;"""
        cursor.execute(query2, (Workcenter_1,)) 
        last_Data_Inserted_Time_summary = cursor.fetchall()
        
        #if No any Recode found-Save 1st Record 
        if(last_Data_Inserted_Time_summary==[]):
           insertRecord(MacAdd,first_sensor_value,second_sensor_value)

        #Find Last Data Inserted  last_Data_Inserted_Time_event table
        query3= """ SELECT ServerDateTime FROM `tbl_event_air_flow` WHERE WorkCenter=%s  ORDER BY ServerDateTime DESC LIMIT 1;"""
        cursor.execute(query3, (Workcenter_1,)) 
        last_Data_Inserted_Time_event = cursor.fetchall()
        
        #if No any Recode found-Save 1st Record 
        if(last_Data_Inserted_Time_event==[]):
            insertRecord_event_air_flow(MacAdd,first_sensor_value,second_sensor_value)

        #Data_Inserted_Time_summary table (15s)
        if last_Data_Inserted_Time_summary:
            for row in last_Data_Inserted_Time_summary:
                last_Data_Inserted_Time_summary = row[0]
                last_Data_Inserted_Time_summary = last_Data_Inserted_Time_summary.strftime("%Y-%m-%d %H:%M:%S")

                if DebugEnable == 1:
                    print("Last Data Inserted Time tbl_summary_air_flow Table:", last_Data_Inserted_Time_summary)

                last_Data_Inserted_Time_summary = datetime.strptime(last_Data_Inserted_Time_summary, "%Y-%m-%d %H:%M:%S")
                TimeDIff=server_datetime-last_Data_Inserted_Time_summary
                if DebugEnable == 1:
                    print("Time Difference Summary Data Last Inserted Time and Current Time : ",TimeDIff)

                if(TimeDIff>=timedelta(seconds=15)):
                    if DebugEnable==1:
                        print("Data Insert tbl_summary_air_flow Table ")
                    insertRecord(MacAdd,first_sensor_value,second_sensor_value)

        if last_Data_Inserted_Time_summary is None:
            print("Data Insert tbl_summary_air_flow table 1st Recode")
            insertRecord(MacAdd,first_sensor_value,second_sensor_value)

        #Data_Inserted_Time_event table (5min)
        if last_Data_Inserted_Time_event:
            for row in last_Data_Inserted_Time_event:
                last_Data_Inserted_Time_event = row[0]
                last_Data_Inserted_Time_event = last_Data_Inserted_Time_event.strftime("%Y-%m-%d %H:%M:%S")
                if DebugEnable == 1:
                    print("Last Data Inserted Time tbl_event_air_flow Table:", last_Data_Inserted_Time_event)
                last_Data_Inserted_Time_event = datetime.strptime(last_Data_Inserted_Time_event, "%Y-%m-%d %H:%M:%S")
                TimeDIff_Event=server_datetime-last_Data_Inserted_Time_event
                if DebugEnable == 1:
                    print('Time Difference tbl_event_air_flow Data Last Inserted Time and Current Time ',TimeDIff_Event)

            if(TimeDIff_Event>=timedelta(seconds=120)):
                    if DebugEnable==1:
                        print("Data Insert event table")
                   # insertRecord(MacAdd,first_sensor_value,second_sensor_value)
                    insertRecord_event_air_flow(MacAdd,first_sensor_value,second_sensor_value)

        if last_Data_Inserted_Time_event is None:
            print("Data Insert event table 1st Recode")
            insertRecord(MacAdd,first_sensor_value,second_sensor_value)
            insertRecord_event_air_flow(MacAdd,first_sensor_value,second_sensor_value)

        if connection.is_connected():
            cursor.close()
            connection.close()

ErrorCode=190
def insertRecord(MacAdd,first_sensor_value,second_sensor_value):
    time.sleep(1)
    colombo_tz = pytz.timezone('Asia/Colombo')
    server_datetime = datetime.now(colombo_tz)

    #Database Connection
    connection = mysql.connector.connect(
    host    =MYSQL_HOST,
    user    =MYSQL_USER,
    password=MYSQL_PASSWORD,
    database=MYSQL_DATABASE
    )

    #Unit Number Identify Using MAC
    cursor = connection.cursor()        
    try:                
        sql_query = """INSERT INTO  tbl_summary_air_flow (LastUpdatedTime,UnitNumber,WorkCenter,Airpressure)VALUES (%s,%s,%s,%s)"""
        sql_query2 = """INSERT INTO  tbl_summary_air_flow (LastUpdatedTime,UnitNumber,WorkCenter,Airpressure)VALUES (%s,%s,%s,%s)"""
        cursor.execute(sql_query, (server_datetime,MacAdd,Workcenter_1,first_sensor_value))
        
        if Workcenter_2 :
            cursor.execute(sql_query2, (server_datetime,MacAdd,Workcenter_2,second_sensor_value))
        connection.commit()

    except Exception as e:
            if DebugEnable==1:
                print(f"Summary Air flow Data Insert Error,{e}")
                logging.error(e)
            send_RuntimeError("CR","ErrorCode=190","","insertRecord","Insert Record in Summary Air Flow",str(e))
    finally:
        if connection.is_connected():
            cursor.close()
            connection.close()


ErrorCode=200
def insertRecord_event_air_flow(MacAdd,first_sensor_value,second_sensor_value):

    time.sleep(1)
    colombo_tz = pytz.timezone('Asia/Colombo')
    # Get the current server datetime in the Colombo timezone
    server_datetime = datetime.now(colombo_tz)
    
    #Database Connection
    connection = mysql.connector.connect(
    host    =MYSQL_HOST,
    user    =MYSQL_USER,
    password=MYSQL_PASSWORD,
    database=MYSQL_DATABASE
    )

  #Unit Number Identify Using MAC
    cursor = connection.cursor()        
    try:                
        sql_query = """INSERT INTO  tbl_event_air_flow (ServerDateTime,UnitNumber,WorkCenter,Airpressure)VALUES (%s,%s,%s,%s)"""
        sql_query2 = """INSERT INTO  tbl_event_air_flow (ServerDateTime,UnitNumber,WorkCenter,Airpressure)VALUES (%s,%s,%s,%s)"""
        cursor.execute(sql_query, (server_datetime,MacAdd,Workcenter_1,first_sensor_value))

        if Workcenter_2:
            cursor.execute(sql_query2, (server_datetime,MacAdd,Workcenter_2,second_sensor_value))
        connection.commit()

    except Exception as e:
        if DebugEnable==1:
            print(f"Timer_event_air_flow Error : {e}")
            logging.error(e)
        send_RuntimeError("CR","ErrorCode=200",str(e),"insertRecord_event_air_flow","Insert Record in Event Air Flow",str(e))  
             
    finally:
        if connection.is_connected():
            cursor.close()
            connection.close()

ErrorCode=210
def Towerlamp(MacAdd,client,first_sensor_value,second_sensor_value):
    #print("210")
    try:
        connection = mysql.connector.connect(
            host    =MYSQL_HOST,
            user    =MYSQL_USER,
            password=MYSQL_PASSWORD,
            database=MYSQL_DATABASE
            )
        
        #get ToweLamp Mac
        ToweLamp_Mac = "SELECT * FROM `tbl_workcenter_settings_towerlamp` WHERE 1;"
        cursor = connection.cursor()
        cursor.execute(ToweLamp_Mac)
        result = cursor.fetchone()
        Tower_Lamp_MAC=result[1]
        print('get ToweLamp Mac ',Tower_Lamp_MAC)

        #Now Time
        server_datetime = datetime.now(colombo_tz)
        server_datetime = server_datetime.strftime('%Y-%m-%d %H:%M:%S')
        server_datetime=datetime.strptime(server_datetime, '%Y-%m-%d %H:%M:%S')

        #Read Database Last Value
        
        Last_Saved_Value = "SELECT * FROM `tbl_summary_air_flow` ORDER BY ID DESC LIMIT 1;;"
        cursor = connection.cursor()
        cursor.execute(Last_Saved_Value)
        result = cursor.fetchone()
        Last_Saved_Value=result[4]
        print('Last_Saved_Value ',Last_Saved_Value)
        Last_Saved_Value=(int(Last_Saved_Value))
       
        
        global Towerlamp_Red_Time
        
        if Last_Saved_Value<6500:
            print("ssss")

            #Send MQTT -Red Lamp
            strPayload = ("{\"MacAdd\":\"" + Tower_Lamp_MAC + "\",\"MsgType\":\"EventTWL\",\"EventNo\":\"2\",\"Kpd_No\":\"1\",\"Data\":[1,0,0,0,0,0]}")
            
            if Towerlamp_Red_Time is None:
                Towerlamp_Red_Time=server_datetime
                
            if Towerlamp_Red_Time is not None:
                if (server_datetime-Towerlamp_Red_Time).total_seconds()>120:
                    #Send MQTT -Red Lamp And Buzzer
                    strPayload = ("{\"MacAdd\":\"" + Tower_Lamp_MAC + "\",\"MsgType\":\"EventTWL\",\"EventNo\":\"2\",\"Kpd_No\":\"1\",\"Data\":[1,0,0,0,1,0]}")

        if Last_Saved_Value>7000:
            print("High Limit Yellow")
            #strPayload = ("{\"MacAdd\":\"" + Tower_Lamp_MAC + "\",\"MsgType\":\"EventTWL\",\"EventNo\":\"2\",\"Kpd_No\":\"1\",\"Data\":[0,1,0,0,0,0]}")


        else:
            print("Mid Level")
            Towerlamp_Red_Time =None 
            #Send MQTT Green Light
            strPayload = ("{\"MacAdd\":\"" + Tower_Lamp_MAC + "\",\"MsgType\":\"EventTWL\",\"EventNo\":\"2\",\"Kpd_No\":\"1\",\"Data\":[0,0,1,0,0,0]}")
        
        if DebugEnable==1:
            print("Payload : ", strPayload)
            logging.info("Payload : "+strPayload)

        result = client.publish(strPublishTopic, strPayload)
        if result[0] == 0:
            if DebugEnable==1:
                print(f"Publish `{strPayload}` to strPublishTopic `{strPublishTopic}`")
                logging.info("Publish : "+strPayload)
        else:
            if DebugEnable==1:
                print(f"Failed to Publish message to strPublishTopic {strPublishTopic}")
                logging.error("Failed to Publish message to strPublishTopic : "+strPublishTopic)
            send_RuntimeError("CR","ErrorCode=210","Failed to Publish message to strPublishTopic","Towerlamp","Publish Tower Lamp MQTT","Failed to Publish message to strPublishTopic")
    except mysql.connector.Error as e:
        print("Error reading data from MySQL:", e)
        logging.error(e)
        send_RuntimeError("MN","ErrorCode=210",e,"Towerlamp","Publish Tower Lamp MQTT","Error reading data from MySQL")
    
    finally:
        if connection.is_connected():
            cursor.close()
            connection.close()


def databaseConnection():
    while True:
        try:
            connection = mysql.connector.connect(
            host    =MYSQL_HOST,
            user    =MYSQL_USER,
            password=MYSQL_PASSWORD,
            database=MYSQL_DATABASE
            )
            if connection.is_connected():
                if DebugEnable==1:
                    logging.info("Database is connected")
                    print("Database is connected")
                MQTTConnection()
                
        except:
            print("Database Connection Faild")
            logging.error("Database Connection Faild")
        time.sleep(15)

def connect_mqtt():
    def on_connect(client, userdata, flags, rc):
        if rc == 0:
            if DebugEnable==1:
                logging.info("Connected to MQTT Broker!" )
                print("Connect To Broker :"+broker)
                print("Subscribed To Topic :"+subscribe_topic)
            client.subscribe(subscribe_topic)
            client.on_message = on_message
        else:
            print("Failed to connect, return code %d\n", rc)
            logging.info("Failed to connect MQTT:" )
            time.sleep(2)
    client = mqtt_client.Client(client_id)
    # client.username_pw_set(username, password)
    client.on_connect = on_connect
    client.connect(broker, port,keepalive=60)
    return client

def MQTTConnection():
    while True:
        time.sleep(10)
        try:
            client = connect_mqtt()
            #client.loop_start()
            client.loop_forever()

        except Exception as e:
            logging.error(e)
            if DebugEnable==1:
                print(e)
                
def main(): 
    print("MQTT Program is Running....")  
    databaseConnection()

if __name__=="__main__":
    main()



