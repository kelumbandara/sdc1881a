# python 3.11
#ver 6
#9/3/2025
#Logger Time Zone SL
#Add restart function
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
broker ='perahara.lk'
port = 1883
#topic ="sasanka99"
#topic ="Sasanka99"
topic ="sky/iot-4to20ma-module-4ch/pub/v1/svr/#"
#topic ="sky/iot-4to20ma-module-4ch/pub/v1/svr/startup/sky-iot-4to20ma-4ch/none/5C013B6BD674"
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
DebugEnable=0
msg_payload_have_mac=0
Correct_Message_Format=0
Valid_JSon=0
mqttConnetionFaild=0
# Define the Colombo timezone
colombo_tz = pytz.timezone('Asia/Colombo')
# Get the current server datetime in the Colombo timezone
server_datetime = datetime.now(colombo_tz)

#print(server_datetime)

#logger time 
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


    

def databaseConnection():
    ErrorCode=100
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
        
        restart_program() 


def connect_mqtt() -> mqtt_client:
   
    def on_connect(client, userdata, flags, rc):
        if rc == 0:
               
            if DebugEnable==1:
                logging.info("Connected to MQTT Broker!" )
                print("Connect To Broker :"+broker)
                print("Subscribed To Topic :"+topic)
            
        else:
            print("Failed to connect, return code %d\n", rc)
            logging.info("Failed to connect MQTT:" )
            time.sleep(2)
            databaseConnection() 

            connect_mqtt()


            

    client = mqtt_client.Client(client_id)
    # client.username_pw_set(username, password)
    client.on_connect = on_connect
    client.on_disconnect = on_disconnect
    client.connect(broker, port)
    return client


def on_disconnect(client, userdata, rc):
    print("Disconnected. Trying to reconnect...")
    while True:
        try:
            client.reconnect()
            print("Reconnected successfully!")
            MQTTConnection()
            

        except Exception as e:
            print(f"Reconnection failed: {e}")
            time.sleep(5)
            restart_program()



def on_message(client, userdata, msg):
    
    #Debug Mode
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
 
    
    #print(f"Received `{msg.payload.decode()}` from `{msg.topic}` topic")
    msg_payload = msg.payload.decode()  # Decode the payload
    
    
    #Incorrect JSON ( Example:"test")
    if msg_payload[0] == '"' and msg_payload[-1] == '"':
        if DebugEnable==1:
            print("InCorrect Message Format")
            logging.error("InCorrect Message Format")
        send_RuntimeError("CR","ErrorCode=100","","on_message(client, userdata, msg)","While checking whether the MQTT message format is correct","InCorrect Message Format")
        return 0
    #else:
        #print("The string does not start and end with double quotes.")


    
   
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

    # if DebugEnable==1:
    #     print(lists)
     
    
   
   
    #Check MAC address is Available in Reseved MQTT?
    ErrorCode=120
    if "mac"in msg_payload:
        msg_payload_have_mac=1
        if DebugEnable==1:
            print("This Message have a MAC")

        # if(lists==expected_json_format_4 ):
        #     print("Power On message")
        #     MAC=msg_payload['mac'] 



        #     PwrOnMSG(MAC,UnitID,ServerDateTime,pwron_count,Signal_Strength)







       
    else:
        msg_payload_have_mac=0
        if DebugEnable==1:
            print("MAC address is not available in MQTT")
            #print(msg_payload_have_mac)
            logging.error("MAC address is not available in MQTT")
        #send_RuntimeError("1","1","1","1","1","MAC address is not available in MQTT")
        send_RuntimeError("MJ","ErrorCode=120","","on_message(client, userdata, msg)","while checking if the MAC address is included in MQTT","MAC address is not available in MQTT")
        return 0
    
    
    ErrorCode=130
    if "event"in msg_payload:
        msg_payload_have_event=1
        if DebugEnable==1:
            print("This is Event Message")
        
    
    else:
        msg_payload_have_event=0
       
        # if DebugEnable==1:
        #     print("event is not available in Message")
            #print(msg_payload_have_mac)
            #logging.error("event is not available in MQTT")
        #send_RuntimeError("1","1","1","1","1","MAC address is not available in MQTT")
        send_RuntimeError("MJ","ErrorCode=120","","on_message(client, userdata, msg)","while checking if the MAC address is included in MQTT","MAC address is not available in MQTT")
      

    #Check if mac address have in setting table
    MAC     = msg_payload['mac']
    MAC_Available_Database=Check_Mac(MAC)
    
    if MAC_Available_Database==1:
        # if DebugEnable==1:
        #     print("Mac Is available in Database")


   
        ErrorCode=140
        #Check Message Format in Reseved MQTT?
        if(msg_payload_have_event==1):
            
            if(lists==expected_json_format_1 ):   #Event Data
                Correct_Message_Format=1
                # if DebugEnable==1:
                #     print("Correct Message Format")
                MacAdd     = msg_payload['mac'] 
                first_sensor_value =msg_payload['Data']['sensor_data'][0]['value']
                second_sensor_value =msg_payload['Data']['sensor_data'][1]['value']

                # if DebugEnable==1:
                #     print("first_sensor_value")
                #     print(first_sensor_value)

                #     print("second_sensor_value")
                #     print(second_sensor_value)
                

                Timers= Timer(MacAdd,client,first_sensor_value,second_sensor_value)
               
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
            # if(msg_type=="PWR_ON"):
            #     if DebugEnable==1:
            #         print("Power On message",MAC)
                    #logging.info("Device Power On Message : "+MAC)

            PwrOnMSG(MAC,UnitID,ServerDateTime,DevicePowerOnCount,DeviceReconnectCount)


            





    
    if MAC_Available_Database==0:
        if DebugEnable==1:
            print("MAC_Not Available_Database ",MAC)
        time.sleep(2)
        send_RuntimeError("MJ","ErrorCode=140","","on_message","while checking if the MAC address is included in database","MAC_Not Available_Database")
      
        #databaseConnection()
        #MQTTConnection()
        #on_message
       # subscribe(client)

        
        

def Check_Mac(MAC):
    
    connection = mysql.connector.connect(
        host    =MYSQL_HOST,
        user    =MYSQL_USER,
        password=MYSQL_PASSWORD,
        database=MYSQL_DATABASE
        )
        
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
        #Debug Mode
        # if DebugEnable==1:
        #     print("MacAdd is Not Available in tbl_work_center_setting ")
        #     logging.error("MacAdd is Not Available in tbl_work_center_setting ")
        #send_RuntimeError("MN","ErrorCode=100","","checkMAC(MAC)","While checking if the received MQTT's MAC was included in the database","MacAdd is Not Available in tbl_work_center_setting")
        return 0
      
   
    


def CheckItPlainText(msg):
    
    msg_payload = msg.payload.decode()  # Decode the payload once
    
    try:
        # Attempt to parse the JSON string
        json.loads(msg_payload)
        return 1  # Return 1 if valid JSON
    except json.JSONDecodeError :

        if(msg_payload=='"'+msg_payload+'"'):
            print("False")
        return 0  # Return 0 if not valid JSON


    




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
            # if DebugEnable==1:
            #    print(MAC," power on message saved ")  
            #    logging.info(MAC," power on message saved ")

        else:
            #check database value and now value not equal?
            #change datatype str to int
            DB_power_on_count=int(DB_power_on_count[0])

            #print(type(DB_power_on_count))
           # print(type(DevicePowerOnCount))

            if(DB_power_on_count<DevicePowerOnCount):
                sql_query = """INSERT INTO tblmc_devicepoweron (UnitID,MAC_Address,ServerDateTime,DevicePowerOnCount)VALUES (%s,%s,%s,%s)"""
                cursor.execute(sql_query, (UnitID,MAC,ServerDateTime,DevicePowerOnCount))
                connection.commit()
                if DebugEnable==1:
                    print(MAC," power on message saved ") 
                    logging.info(MAC," power on message saved ")

        
        #Reconnect Msg Operation

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
            #check database value and now value not equal?
            #change datatype str to int
            DB_Reconnection_count=int(DB_Reconnection_count[0])

            #print(type(DB_Reconnection_count))
            #print(type(DeviceReconnectCount))

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
   
    



def send_RuntimeError(AlarmCategory,ErrorCode,ErrorCatched,MainLocation,SubLocation,Details):
        #print("send_RuntimeError")
        #Database Connection
        connection = mysql.connector.connect(
        host    =MYSQL_HOST,
        user    =MYSQL_USER,
        password=MYSQL_PASSWORD,
        database=MYSQL_DATABASE
        )
        
        cursor = connection.cursor()
        
        sql_query = """INSERT INTO tblmc_runtime_errors (ServerDateTime,AlarmCategory,ErrorCode,ErrorCatched,MainLocation,SubLocation,Details)VALUES (%s, %s, %s, %s, %s, %s, %s)"""
        cursor.execute(sql_query, (server_datetime,AlarmCategory,ErrorCode,ErrorCatched,MainLocation,SubLocation,Details))
        connection.commit()
        #print("Runtime Error to the Database")
        #logging.info("Runtime Error  to the Database")
               

        if connection.is_connected():
            cursor.close()
            connection.close()
            #print("MySQL connection is closed.")


def get_last_server_datetime_in_Energy(strUnitID):
    print(strUnitID)


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
    # if DebugEnable==1:
    #     print(Workcenters)

    if Workcenters is None:
        print(f"MAC address {MacAdd} not found in `tbl_workcenter_settings`.")
    else:
        # if DebugEnable==1:
        #     print(f"WorkCenter settings for MAC address {MacAdd}: {Workcenters}")

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
        # Get the current server datetime in the Colombo timezone
        server_datetime = datetime.now(colombo_tz)
        server_datetime = server_datetime.strftime('%Y-%m-%d %H:%M:%S')
        server_datetime=datetime.strptime(server_datetime, '%Y-%m-%d %H:%M:%S')
        # if DebugEnable==1:
        #     print("server_datetime : ",server_datetime)
        

        #Find Last Data Inserted  last_Data_Inserted_Time_summary table
        query2= """ SELECT LastUpdatedTime FROM `tbl_summary_air_flow` WHERE WorkCenter=%s OR WorkCenter=%s ORDER BY LastUpdatedTime DESC LIMIT 1;"""
        cursor.execute(query2, (Workcenter_1,Workcenter_2,)) 
        last_Data_Inserted_Time_summary = cursor.fetchall()
        
        #if No any Recode found-Save 1st Record 
        if(last_Data_Inserted_Time_summary==[]):
           insertRecord(first_sensor_value,second_sensor_value)
       

        #Find Last Data Inserted  last_Data_Inserted_Time_event table
        query3= """ SELECT ServerDateTime FROM `tbl_event_air_flow` WHERE WorkCenter=%s OR WorkCenter=%s ORDER BY ServerDateTime DESC LIMIT 1;"""
        cursor.execute(query3, (Workcenter_1,Workcenter_2,)) 
        last_Data_Inserted_Time_event = cursor.fetchall()
        
        #if No any Recode found-Save 1st Record 
        if(last_Data_Inserted_Time_event==[]):
            insertRecord_event_air_flow(first_sensor_value,second_sensor_value)

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
                    insertRecord(first_sensor_value,second_sensor_value)

        if last_Data_Inserted_Time_summary is None:
            print("Data Insert tbl_summary_air_flow table 1st Recode")
            insertRecord(first_sensor_value,second_sensor_value)

                    

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

            if(TimeDIff_Event>=timedelta(seconds=300)):
                    if DebugEnable==1:
                        print("Data Insert event table")
                    insertRecord(first_sensor_value,second_sensor_value)
                    insertRecord_event_air_flow(first_sensor_value,second_sensor_value)

        if last_Data_Inserted_Time_event is None:
            print("Data Insert event table 1st Recode")
            insertRecord(first_sensor_value,second_sensor_value)
            insertRecord_event_air_flow(first_sensor_value,second_sensor_value)
       
       
       








    
    
     

def insertRecord(first_sensor_value,second_sensor_value):

    time.sleep(1)
    colombo_tz = pytz.timezone('Asia/Colombo')
    # Get the current server datetime in the Colombo timezone
    server_datetime = datetime.now(colombo_tz)
    # if DebugEnable==1:

    #     print("Workcenter_1",Workcenter_1)
    #     print("Workcenter_2",Workcenter_2)
    #     print("first_sensor_value",first_sensor_value)
    #     print("second_sensor_value",second_sensor_value)

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
        cursor.execute(sql_query, (server_datetime,0,Workcenter_1,first_sensor_value))
        cursor.execute(sql_query2, (server_datetime,0,Workcenter_2,second_sensor_value))
        connection.commit()
        #print("Mqtt Inserted to the Database")
        #logging.info("Mqtt Inserted to the Database")
        
                
    except Exception as e:
            print(".............")   
    
    # if connection.is_connected():
    #      cursor.close()
    #      connection.close()
    #      print("MySQL connection is closed.")


def Timer_event_air_flow(MacAdd,client):
    
    time.sleep(2)
    print("def Timer_event_air_flow")
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

    cursor = connection.cursor()

    #accsess tbl_workcenter_settings
    #check if mac have in  tbl_workcenter_settings 

    get_WorkCenter = """SELECT Workcenter_1, Workcenter_2 FROM `tbl_workcenter_settings` WHERE MAC_address = %s;"""

    try:
        cursor.execute(get_WorkCenter, (MacAdd,))
        rows = cursor.fetchall()

        if not rows:  # Check if rows are empty
            if DebugEnable==1:
                print("No found Workcenter_1 and Workcenter_2 in tbl_workcenter_settings on Related MAC address.")
                logging.error("No found Workcenter_1 and Workcenter_2 in tbl_workcenter_settings on Related MAC address.")
           
        else:
            #if Workcenter_1 and Workcenter_2 found on  tbl_workcenter_settings
            for row in rows:
                global Workcenter_1, Workcenter_2  # Declare them as  inside the loop
                Workcenter_1 = row[0]  # First column
                Workcenter_2 = row[1]  # Second column
                # if DebugEnable==1:
                #     print("Workcenter_1:", Workcenter_1)
                #     print("Workcenter_2:", Workcenter_2)

                time.sleep(2)

               



                #Timer =Accsess insert data in database
                #query = """SELECT LastUpdatedTime FROM `tbl_summary_air_flow` WHERE WorkCenter=%s OR  WorkCenter=%s;"""
                query= """ SELECT ServerDateTime FROM `tbl_event_air_flow` WHERE WorkCenter=%s OR WorkCenter=%s ORDER BY ServerDateTime DESC LIMIT 1;"""
  
                last_data_insert_time=0
                print("last_data_insert_time ",last_data_insert_time)

                try:
                    cursor.execute(query, (Workcenter_1,Workcenter_2,))       
                    rows = cursor.fetchall()

                    if rows == " ":
                        print("No data found in tbl_event_air_flow.  return 1")
                        return 1
                    
                    time.sleep(1)
                    
                    # Print the actual value
                    if rows:
                        for row in rows:
                            
                            last_data_insert_time=row[0]
                            

                            #print("last_data_insert_time:",last_data_insert_time)  # row[0] contains the first column value
                            
                    else:
                        print("No data found. last_data_insert_time in tbl_event_air_flow")
                        print(" ")
                        return 1
                        
                
                                
                except mysql.connector.Error as err:
                    print("Error : ")
                    print(f"Error: {err}")

                print(" ")
                #print("server_datetime : ",server_datetime)

                try:

                    if DebugEnable == 1:
                        print("Retrieved last ServerDateTime:", last_data_insert_time)


                    formatted_datetime = server_datetime.strftime('%Y-%m-%d %H:%M:%S')
                    formatted_datetime=datetime.strptime(formatted_datetime, '%Y-%m-%d %H:%M:%S')

                    if DebugEnable == 1:
                        print("Formatted server_datetime:", formatted_datetime)

                    #print("last_data_insert_time : ",last_data_insert_time)
                

                    last_data_insert_time_add_5_min=last_data_insert_time+timedelta(seconds=300)
                    print("last_data_insert_time_add_5_min : ",last_data_insert_time_add_5_min)

                    print(type(last_data_insert_time_add_5_min))
                    print(type(formatted_datetime))

                    time.sleep(3)

                    if(last_data_insert_time_add_5_min<formatted_datetime):
                        #print("equal or >")
                        return 1

                except Exception as e:
                    print(e)

                
                # try:
                #     if(last_data_insert_time_add_5_min<formatted_datetime):
                #         print("equal or >")
                #         return 1
                # except Exception as e:
                #     print("..........")

                #     Timer()

            


           
    except mysql.connector.Error as err:
        print(f"Error: {err}")

     
    time.sleep(1)

def insertRecord_event_air_flow(first_sensor_value,second_sensor_value):

    time.sleep(1)
    colombo_tz = pytz.timezone('Asia/Colombo')
    # Get the current server datetime in the Colombo timezone
    server_datetime = datetime.now(colombo_tz)
    # if DebugEnable==1:
    #     print("Workcenter_1",Workcenter_1)
    #     print("Workcenter_2",Workcenter_2)
    #     print("first_sensor_value",first_sensor_value)
    #     print("second_sensor_value",second_sensor_value)

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
        cursor.execute(sql_query, (server_datetime,0,Workcenter_1,first_sensor_value))
        cursor.execute(sql_query2, (server_datetime,0,Workcenter_2,second_sensor_value))
        connection.commit()
        #print("Mqtt Inserted to the Database")
        #logging.info("Mqtt Inserted to the Database")
        
                
    except Exception as e:
            print(".............")  
             
    
    # if connection.is_connected():
    #      cursor.close()
    #      connection.close()
    #      print("MySQL connection is closed.")







def subscribe(client: mqtt_client):
    client.subscribe(topic)
    client.on_message = on_message
  







#Connect MQTT (2)
def MQTTConnection():
    try:
        client = connect_mqtt()
        subscribe(client)
        client.loop_forever()

    except Exception as e:
        #ErrorCode=200

        #logging.error("Failed to connect MQTT: %s", e)
        logging.error("MQTT Broker Connection Failed! ")
        print("MQTT Broker Connection Failed! ")
    
       
        
        
        time.sleep(15)
        
       


        restart_program()
       


def restart_program():
    print("Restarting program...")
    time.sleep(5)  # Optionally wait a few seconds before restarting
    subprocess.call([sys.executable, *sys.argv])  # Restart the program

def main():   
    databaseConnection()

   

if __name__=="__main__":
    main()



