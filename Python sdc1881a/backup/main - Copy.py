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

broker = 'broker.hivemq.com'
port = 1883
topic = "sasanka99"
# Generate a Client ID with the subscribe prefix.
client_id = f'subscribe-{random.randint(0, 100)}'
# username = 'emqx'
# password = 'public'
# Define global variables for MySQL connection details
MYSQL_HOST = "localhost"
MYSQL_USER = "root"
MYSQL_PASSWORD = ""
MYSQL_DATABASE = "svr1871a"
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
        send_RuntimeError("CR","ErrorCode=100","JSON decode error: Expecting value: line 1 column 1 (char 0)","on_message(client, userdata, msg)","While checking whether the MQTT message format is correct ","InCorrect Message Format")
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
    expected_json_format_1=['MacAdd', 'MsgType', 'EventNo', 'DeviceNo', 'Data']
    expected_json_format_2=['MacAdd', 'MsgType', 'IPAdd', 'Mc_No', 'ModelNo','ManufacDate','EventNo','PwrOnCount','RunTime','HardVer','SoftVer','SigStrength']
    

    lists = [] #json format
    for key,values in msg_payload.items():
        lists.append(key)
    
    #print(lists)
     
    
   
   
    #Check MAC address is Available in Reseved MQTT?
    ErrorCode=120
    if "MacAdd"in msg_payload:
        msg_payload_have_mac=1
       
    else:
        msg_payload_have_mac=0
        if DebugEnable==1:
            print("MAC address is not available in MQTT")
            #print(msg_payload_have_mac)
        logging.error("MAC address is not available in MQTT")
        #send_RuntimeError("1","1","1","1","1","MAC address is not available in MQTT")
        send_RuntimeError("MJ","ErrorCode=120","","on_message(client, userdata, msg)","while checking if the MAC address is included in MQTT","MAC address is not available in MQTT")
        return 0
    
    
    #Check MsgType  is Available in Reseved MQTT?
    ErrorCode=130
    if "MsgType"in msg_payload:
        msg_payload_have_mac=1
       
    else:
        msg_payload_have_mac=0
        if DebugEnable==1:
            print("MsgType address is not available in MQTT")
            #print(msg_payload_have_mac)
        logging.error("MsgType  is not available in MQTT")
        send_RuntimeError("MJ","ErrorCode=130","","on_message(client, userdata, msg)","while checking if the MsgType is included in MQTT","MsgType is not available in MQTT")
        return 0

    ErrorCode=140
     #Check Message Format in Reseved MQTT?
    if(msg_payload_have_mac==1):
        
        if(lists==expected_json_format_1 or lists==expected_json_format_2):
            Correct_Message_Format=1
            #print("Correct Message Format")
        else:
            Correct_Message_Format=0
            #Debug Mode
            if DebugEnable==1:
                print("InCorrect Message Format")
                logging.error("InCorrect Message Format")
                send_RuntimeError("CR","ErrorCode=140","","on_message","while checking MQTT Format","InCorrect Message Format")
            #run()

    MsgType  = msg_payload['MsgType']
    
    if(Correct_Message_Format==1):
        if(MsgType=="EventSuction"):
            
            MAC          = msg_payload['MacAdd']
            MACAvailable=checkMAC(MAC) #if mac is Availbale in Database return 1 ,if MAC is Not Availbale in Database return 0
            
            if MACAvailable==1:
                
                MacAdd     = msg_payload['MacAdd'] 
                MsgType    = msg_payload['MsgType']
                EventNo    = msg_payload['EventNo']
                DeviceNo   = msg_payload['DeviceNo']
                AirFlowIn  = msg_payload['Data']['AirFlowIn']
                AirFlowOut = msg_payload['Data']['AirFlowOut']
                    
                #Execute function
                insertRecord(MacAdd,MsgType,EventNo,DeviceNo,AirFlowIn,AirFlowOut)
        
        if(lists==expected_json_format_2):
            MacAdd       = msg_payload['MacAdd']
            MsgType      = msg_payload['MsgType']
            IPAdd        = msg_payload['IPAdd']
            Mc_No        = msg_payload['Mc_No']
            ModelNo      = msg_payload['ModelNo']
            ManufacDate  = msg_payload['ManufacDate']
            EventNo      = msg_payload['EventNo']
            PwrOnCount   = msg_payload['PwrOnCount']
            RunTime      = msg_payload['RunTime']
            HardVer      = msg_payload['HardVer']
            SoftVer      = msg_payload['SoftVer']
            SigStrength  = msg_payload['SigStrength']
            
            PwrOnReConnMSG(MacAdd,MsgType,IPAdd,Mc_No,ModelNo,ManufacDate,EventNo,PwrOnCount,RunTime,HardVer,SoftVer,SigStrength)
        
        ErrorCode=150
        if MsgType != "PwrOn" and MsgType != "ReConn" and MsgType != "EventSuction":

            #Debug Mode
            if DebugEnable==1:
                print("MsgType Error ")

            logging.info("MsgType Error ")
            send_RuntimeError("MJ","ErrorCode=150","","on_message","While checking if the included 'msgtype' is relevant or not","MsgType Error")


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


    




def checkMAC(MAC):
    
    connection = mysql.connector.connect(
        host    =MYSQL_HOST,
        user    =MYSQL_USER,
        password=MYSQL_PASSWORD,
        database=MYSQL_DATABASE
        )
        
    mac_filter = """SELECT * FROM tbl_work_center_setting WHERE mac IS NOT NULL AND mac = %s"""
    cursor = connection.cursor()
    cursor.execute(mac_filter, (MAC,))
    result = cursor.fetchone()
    
    ErrorCode=100
    if result:
        #print("MacAdd is  Available in tbl_work_center_setting ")
        return 1
    
    else:
        #Debug Mode
        if DebugEnable==1:
            print("MacAdd is Not Available in tbl_work_center_setting ")
        logging.info("MacAdd is Not Available in tbl_work_center_setting ")
        send_RuntimeError("MN","ErrorCode=100","","checkMAC(MAC)","While checking if the received MQTT's MAC was included in the database","MacAdd is Not Available in tbl_work_center_setting")
        return 0

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

def PwrOnReConnMSG(MacAdd,MsgType,IPAdd,Mc_No,ModelNo,ManufacDate,EventNo,PwrOnCount,RunTime,HardVer,SoftVer,SigStrength):
        #Database Connection
        connection = mysql.connector.connect(
            host    =MYSQL_HOST,
            user    =MYSQL_USER,
            password=MYSQL_PASSWORD,
            database=MYSQL_DATABASE
            )

        cursor = connection.cursor()
        
        if MsgType=="PwrOn":
            sql_query = """INSERT INTO  tbl_device_pwron (ServerDateTime,MacAdd,MsgType,IPAdd,Mc_No,ModelNo,ManufacDate,EventNo,PwrOnCount,RunTime,HardVer,SoftVer,SigStrength)VALUES (%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)"""
            cursor.execute(sql_query, (server_datetime,MacAdd,MsgType,IPAdd,Mc_No,ModelNo,ManufacDate,EventNo,PwrOnCount,RunTime,HardVer,SoftVer,SigStrength))
            #print(server_datetime)

        if MsgType=="ReConn":
            #print("ReConn")
            sql_query = """INSERT INTO  tbl_device_reconn (ServerDateTime,MacAdd,MsgType,IPAdd,Mc_No,ModelNo,ManufacDate,EventNo,PwrOnCount,RunTime,HardVer,SoftVer,SigStrength)VALUES (%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)"""
            cursor.execute(sql_query, (server_datetime,MacAdd,MsgType,IPAdd,Mc_No,ModelNo,ManufacDate,EventNo,PwrOnCount,RunTime,HardVer,SoftVer,SigStrength))
        
        connection.commit()  
        
        if connection.is_connected():
            cursor.close()
            connection.close()
            #print("MySQL connection is closed.")

def insertRecord(MAC,MsgType,EventNo,DeviceNo,AirFlowIn,AirFlowOut):

        #Database Connection
        connection = mysql.connector.connect(
        host    =MYSQL_HOST,
        user    =MYSQL_USER,
        password=MYSQL_PASSWORD,
        database=MYSQL_DATABASE
        )
        
        cursor = connection.cursor()
        sql_query = """INSERT INTO  tbl_Event_AirFlow (ServerDateTime,MacAdd,MsgType,EventNo,DeviceNo,AirFlowIn,AirFlowOut)VALUES (%s,%s,%s,%s,%s,%s,%s)"""
        cursor.execute(sql_query, (server_datetime,MAC,MsgType,EventNo,DeviceNo,AirFlowIn,AirFlowOut))
        connection.commit()
        #print("Mqtt Inserted to the Database")
        logging.info("Mqtt Inserted to the Database")
        
        if connection.is_connected():
            cursor.close()
            connection.close()
            #print("MySQL connection is closed.")

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
        send_RuntimeError("CR","ErrorCode=100","","MQTTConnection()","While checking if MQTT is connected or not","MQTT Broker Connection Failed!")
        MQTTConnection()
        


#Connect Database (1)
databaseConnection()

#Connect MQTT (2)
MQTTConnection()

