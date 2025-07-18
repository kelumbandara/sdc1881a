# python 3.11
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

broker ='perahara.lk'
port = 1883
#topic ="sasanka99"
#topic ="Sasanka99"
topic ="sky/iot-4to20ma-module-4ch/pub/v1/svr/event/sky-iot-4to20ma-4ch/none/#"
# Generate a Client ID with the subscribe prefix.
client_id = f'subscribe-{random.randint(0, 100)}'
# username = 'emqx'
# password = 'public'
# Define global variables for MySQL connection details
MYSQL_HOST = "localhost"
MYSQL_USER = "root"
MYSQL_PASSWORD = ""
MYSQL_DATABASE = "sdc1881a"
connection=""
DebugEnable=1
msg_payload_have_mac=0
Correct_Message_Format=0
Valid_JSon=0
# Define the Colombo timezone
colombo_tz = pytz.timezone('Asia/Colombo')
# Get the current server datetime in the Colombo timezone
server_datetime = datetime.now(colombo_tz)

#print(server_datetime)

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
                print("Database is connected")
                #logging.info("Database is connected")
         
    except:
        
        print("Database Connection Faild")
        logging.error("Database Connection Faild")

        time.sleep(15)
        
        #loop try get connection to database
        #logging.info("Trying Connect to Database..............")
        #print("Trying Connect to Database..............")
        databaseConnection() 


def connect_mqtt() -> mqtt_client:
    def on_connect(client, userdata, flags, rc):
        if rc == 0:
            if DebugEnable==1:
                print("Connect To Broker :"+broker)
                print("Subscribed To Topic :"+topic)
            #logging.info("Connected to MQTT Broker!" )
            
        else:
            print("Failed to connect, return code %d\n", rc)
            logging.info("Failed to connect MQTT:" )

            connect_mqtt()

            

    client = mqtt_client.Client(client_id)
    # client.username_pw_set(username, password)
    client.on_connect = on_connect
    client.connect(broker, port)
    return client


def on_message(client, userdata, msg):
    
    #Debug Mode
    if DebugEnable==1:
        print(" ")
        print(msg.payload.decode())
    

    x=CheckItPlainText(msg)

    ErrorCode=100
    if(x==0):
       #Incorrect Plain Text( Example= test)
        print("InCorrect Message Format")
        logging.error("InCorrect Message Format")
       # send_RuntimeError("CR","ErrorCode=100","JSON decode error: Expecting value: line 1 column 1 (char 0)","on_message(client, userdata, msg)","While checking whether the MQTT message format is correct ","InCorrect Message Format")
        return 0
 
    
    #print(f"Received `{msg.payload.decode()}` from `{msg.topic}` topic")
    msg_payload = msg.payload.decode()  # Decode the payload
    
    
    #Incorrect JSON ( Example:"test")
    if msg_payload[0] == '"' and msg_payload[-1] == '"':
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


    lists = [] #json format
    for key,values in msg_payload.items():
        lists.append(key)
    
    print(lists)
     
    
   
   
    #Check MAC address is Available in Reseved MQTT?
    ErrorCode=120
    if "mac"in msg_payload:
        msg_payload_have_mac=1
        print("mac Have")
       
    else:
        msg_payload_have_mac=0
        if DebugEnable==1:
            print("MAC address is not available in MQTT")
            #print(msg_payload_have_mac)
        logging.error("MAC address is not available in MQTT")
        #send_RuntimeError("1","1","1","1","1","MAC address is not available in MQTT")
        #send_RuntimeError("MJ","ErrorCode=120","","on_message(client, userdata, msg)","while checking if the MAC address is included in MQTT","MAC address is not available in MQTT")
        return 0
    
    
    ErrorCode=130
    if "event"in msg_payload:
        msg_payload_have_event=1
        print("event Have")
        
    
    else:
        msg_payload_have_event=0
       
        if DebugEnable==1:
            print("event  is not available in MQTT")
            #print(msg_payload_have_mac)
        logging.error("event is not available in MQTT")
        #send_RuntimeError("1","1","1","1","1","MAC address is not available in MQTT")
        #send_RuntimeError("MJ","ErrorCode=120","","on_message(client, userdata, msg)","while checking if the MAC address is included in MQTT","MAC address is not available in MQTT")
      

    #Check if mac address have in setting table
    MAC     = msg_payload['mac']
    MAC_Available_Database=Check_Mac(MAC)
    
    if MAC_Available_Database==1:
        print("Mac Is available in Database")


   
        ErrorCode=140
        #Check Message Format in Reseved MQTT?
        if(msg_payload_have_event==1):
            
            if(lists==expected_json_format_1 ):   #Event Data
                Correct_Message_Format=1
                print("Correct Message Format")
                MacAdd     = msg_payload['mac'] 
                first_sensor_value =msg_payload['Data']['sensor_data'][0]['value']
                second_sensor_value =msg_payload['Data']['sensor_data'][1]['value']

                print("first_sensor_value")
                print(first_sensor_value)

                print("second_sensor_value")
                print(second_sensor_value)
                

                Timers= Timer(MacAdd,client,first_sensor_value,second_sensor_value)
                # if Timers==1:
                #         print('access granted to insertRecord()')

                #         #findWorkCenter(MacAdd,first_sensor_value,second_sensor_value)
                #         insertRecord(first_sensor_value,second_sensor_value)
                
                # Timers2= Timer_event_air_flow(MacAdd,client)
                # if Timers2==1:
                #         print('access granted Timer_event_air_flow')

                #         #findWorkCenter(MacAdd,first_sensor_value,second_sensor_value)
                #         insertRecord_event_air_flow(first_sensor_value,second_sensor_value)
        
        #power on message
        # if(lists==expected_json_format_3 ):
        #     if DebugEnable==1:
        #         print("Power on")

        #     MAC=msg_payload['mac'] 
        #     UnitID=msg_payload['device']['uuid']
        #     ServerDateTime = datetime.now(colombo_tz)
        #     pwron_count=msg_payload['startup']['pwron_count']
        #     Signal_Strength=msg_payload['network']['rssi']

        #     print(MAC,UnitID,ServerDateTime)

            
        #     PwrOnMSG(MAC,UnitID,ServerDateTime,pwron_count,Signal_Strength)

        
        

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
        print("MacAdd is  Available in tbl_work_center_setting ")
        return 1
    
    else:
        #Debug Mode
        if DebugEnable==1:
            print("MacAdd is Not Available in tbl_work_center_setting ")
        logging.info("MacAdd is Not Available in tbl_work_center_setting ")
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


    




def PwrOnMSG(MAC,UnitID,ServerDateTime,pwron_count,Signal_Strength):
    
    
    connection = mysql.connector.connect(
        host    =MYSQL_HOST,
        user    =MYSQL_USER,
        password=MYSQL_PASSWORD,
        database=MYSQL_DATABASE
        )
    
    cursor = connection.cursor()
    sql_query = """INSERT INTO tblmc_devicepoweron (UnitID,MAC_Address,ServerDateTime,DevicePowerOnCount,SignalStrength)VALUES (%s,%s,%s,%s,%s)"""
    cursor.execute(sql_query, (UnitID,MAC,ServerDateTime,pwron_count,Signal_Strength))
    
    connection.commit()  
        
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

    print(Workcenters)

    if Workcenters is None:
        print(f"MAC address {MacAdd} not found in `tbl_workcenter_settings`.")
    else:
        print(f"WorkCenter settings for MAC address {MacAdd}: {Workcenters}")

        for row in Workcenters:
                global Workcenter_1, Workcenter_2  # Declare them as  inside the loop
                Workcenter_1 = row[0]  # First column
                Workcenter_2 = row[1]  # Second column
                print("Workcenter_1:", Workcenter_1)
                print("Workcenter_2:", Workcenter_2)
                time.sleep(1)

        
        #Now Time

        colombo_tz = pytz.timezone('Asia/Colombo')
        # Get the current server datetime in the Colombo timezone
        server_datetime = datetime.now(colombo_tz)
        server_datetime = server_datetime.strftime('%Y-%m-%d %H:%M:%S')
        server_datetime=datetime.strptime(server_datetime, '%Y-%m-%d %H:%M:%S')
        print(server_datetime)
        

        #Find Last Data Inserted  last_Data_Inserted_Time_summary table
        query2= """ SELECT LastUpdatedTime FROM `tbl_summary_air_flow` WHERE WorkCenter=%s OR WorkCenter=%s ORDER BY LastUpdatedTime DESC LIMIT 1;"""
        cursor.execute(query2, (Workcenter_1,Workcenter_2,)) 
        last_Data_Inserted_Time_summary = cursor.fetchall()
       

        #Find Last Data Inserted  last_Data_Inserted_Time_event table
        query3= """ SELECT ServerDateTime FROM `tbl_event_air_flow` WHERE WorkCenter=%s OR WorkCenter=%s ORDER BY ServerDateTime DESC LIMIT 1;"""
        cursor.execute(query3, (Workcenter_1,Workcenter_2,)) 
        last_Data_Inserted_Time_event = cursor.fetchall()

        #Data_Inserted_Time_summary table (15s)
        if last_Data_Inserted_Time_summary:
            for row in last_Data_Inserted_Time_summary:
                last_Data_Inserted_Time_summary = row[0]
                last_Data_Inserted_Time_summary = last_Data_Inserted_Time_summary.strftime("%Y-%m-%d %H:%M:%S")
                print("Formatted last_Data_Inserted_Time_summary:", last_Data_Inserted_Time_summary)
                last_Data_Inserted_Time_summary = datetime.strptime(last_Data_Inserted_Time_summary, "%Y-%m-%d %H:%M:%S")
                TimeDIff=server_datetime-last_Data_Inserted_Time_summary
                print(TimeDIff)

                if(TimeDIff>=timedelta(seconds=15)):
                    print("Data Insert summary table")
                    insertRecord(first_sensor_value,second_sensor_value)

        if last_Data_Inserted_Time_summary is None:
            print("Data Insert summary table 1st Recode")
            insertRecord(first_sensor_value,second_sensor_value)

                    

        #Data_Inserted_Time_event table (5min)
        if last_Data_Inserted_Time_event:
            for row in last_Data_Inserted_Time_event:
                last_Data_Inserted_Time_event = row[0]
                last_Data_Inserted_Time_event = last_Data_Inserted_Time_event.strftime("%Y-%m-%d %H:%M:%S")
                print("Formatted last_Data_Inserted_Time_event:", last_Data_Inserted_Time_event)
                last_Data_Inserted_Time_event = datetime.strptime(last_Data_Inserted_Time_event, "%Y-%m-%d %H:%M:%S")
                TimeDIff_Event=server_datetime-last_Data_Inserted_Time_event
                print(TimeDIff_Event)

            if(TimeDIff_Event>=timedelta(seconds=300)):
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

    print("Workcenter_1",Workcenter_1)
    print("Workcenter_2",Workcenter_2)
    print("first_sensor_value",first_sensor_value)
    print("second_sensor_value",second_sensor_value)

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
        logging.info("Mqtt Inserted to the Database")
        
                
    except Exception as e:
            print(".............")   
    
    if connection.is_connected():
         cursor.close()
         connection.close()
         print("MySQL connection is closed.")


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
                print("Workcenter_1:", Workcenter_1)
                print("Workcenter_2:", Workcenter_2)

                time.sleep(2)

               



                #Timer =Accsess insert data in database
                #query = """SELECT LastUpdatedTime FROM `tbl_summary_air_flow` WHERE WorkCenter=%s OR  WorkCenter=%s;"""
                query= """ SELECT ServerDateTime FROM `tbl_event_air_flow` WHERE WorkCenter=%s OR WorkCenter=%s ORDER BY ServerDateTime DESC LIMIT 1;"""
  
                last_data_insert_time=0
                print(last_data_insert_time)

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
                    print("Formatted server_datetime:", formatted_datetime)

                    #print("last_data_insert_time : ",last_data_insert_time)
                

                    last_data_insert_time_add_5_min=last_data_insert_time+timedelta(seconds=300)
                    print("last_data_insert_time_add_5_min : ",last_data_insert_time_add_5_min)

                    print(type(last_data_insert_time_add_5_min))
                    print(type(formatted_datetime))

                    time.sleep(3)

                    if(last_data_insert_time_add_5_min<formatted_datetime):
                        print("equal or >")
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

    print("Workcenter_1",Workcenter_1)
    print("Workcenter_2",Workcenter_2)
    print("first_sensor_value",first_sensor_value)
    print("second_sensor_value",second_sensor_value)

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
        logging.info("Mqtt Inserted to the Database")
        
                
    except Exception as e:
            print(".............")   
    
    if connection.is_connected():
         cursor.close()
         connection.close()
         print("MySQL connection is closed.")







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
        #logging.error("Failed to connect MQTT: %s", e)
        logging.error("MQTT Broker Connection Failed!")
        print("MQTT Broker Connection Failed!")
        
        time.sleep(15)

       # logging.info("Trying connect MQTT Connection")
       # print("Trying connect MQTT Connection")
       # print(" ")
        databaseConnection()
       # send_RuntimeError("CR","ErrorCode=100","","MQTTConnection()","While checking if MQTT is connected or not","MQTT Broker Connection Failed!")
        MQTTConnection()
        


#Connect Database (1)
databaseConnection()

#Connect MQTT (2)
MQTTConnection()

