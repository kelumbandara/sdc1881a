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
#ver6 
#add sms service

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


#shanu --
import requests
from datetime import datetime
# Notify.lk credentials
api_key = "377KHuJODrQ2onp4fJTV"
sender_id = "NotifyDEMO"
group1_mobile_number=[]
group2_mobile_number=[]
group3_mobile_number=[]
#shanu --


count=0
#broker ='perahara.lk'
broker ='smartandons.com'
port = 1883
#subscribe_topic="sss"
strPublishTopic="sky/iot-4to20ma-module-4ch/pub/v1/svr/buzzer"
strPublishTopic="DCS-1515A"
subscribe_topic ="sky/iot-4to20ma-module-4ch/pub/v1/svr/#"
#subscribe_topic ="sky/iot-4to20ma-module-4ch/pub/v1/svr/test"
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

# Initializing values for buzzer states
low_value_date = low_buzzer = high_value_date = high_buzzer = None

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
                update_send_status(MacAdd,client,first_sensor_value,second_sensor_value)
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





# SHANIKA Send SMS part satrt---

#ErrorCode=

def update_send_status(MacAdd,client,first_sensor_value,second_sensor_value):
    
    if DebugEnable==1:
        print ("SEND SMS SHANIKA")
    
    colombo_tz = pytz.timezone('Asia/Colombo')
    # Get the current server datetime in the Colombo timezone
    server_datetime = datetime.now(colombo_tz)
    
    connection = mysql.connector.connect(
    host    =MYSQL_HOST,
    user    =MYSQL_USER,
    password=MYSQL_PASSWORD,
    database=MYSQL_DATABASE
    )
    cursor = connection.cursor()
    #find worksenters
    get_WorkCenter = """SELECT Workcenter_1, Workcenter_2 FROM `tbl_workcenter_settings` WHERE MAC_address = %s;"""
    
   
        
    group1_mobile_number=[]
    group2_mobile_number=[]
    group3_mobile_number=[]
    
    
    query = """SELECT contactNumber FROM tblphone_numbers WHERE `group`=1;"""
    cursor.execute(query)
    results = cursor.fetchall()

    for row in results:
        group1_mobile_number.append(row[0])  # row is a tuple like (contactNumber,)


    query = """SELECT contactNumber FROM tblphone_numbers WHERE `group`=2;"""
    cursor.execute(query)
    results = cursor.fetchall()

    for row in results:
        group2_mobile_number.append(row[0])  # row is a tuple like (contactNumber,)


    query = """SELECT contactNumber FROM tblphone_numbers WHERE `group`=3;"""
    cursor.execute(query)
    results = cursor.fetchall()

    for row in results:
        group3_mobile_number.append(row[0])  # row is a tuple like (contactNumber,)

    

    
    
    cursor.execute(get_WorkCenter, (MacAdd,))
    Workcenters = cursor.fetchall()

    if Workcenters is None:
        if DebugEnable==1:
            print(f"MAC address {MacAdd} not found in `tbl_workcenter_settings`.")
    else:

        for row in Workcenters:
                global Workcenter_1, Workcenter_2  # Declare them as  inside the loop
                Workcenter_1 = row[0]  # First column
                Workcenter_2 = row[1]  # Second column
                if DebugEnable==1:
                    print("Workcenter_1:", Workcenter_1)
                    print("Workcenter_2:", Workcenter_2)
                    
     
    if 6500 <= first_sensor_value <= 7000:
        if DebugEnable==1:
            print("First sensor value between 6500 and 7000.")
        wc_1_status = 3

        # Last status of Workcenter_1
        query_1 = """SELECT wc_1_status FROM tbl_sms_handling WHERE MAC_Address = %s;"""
        cursor.execute(query_1, (MacAdd,))
        last_status_on_wc1 = cursor.fetchone()
        if DebugEnable==1:
            print("Last status of Workcenter_1:", last_status_on_wc1)

        if last_status_on_wc1:
            previous_status = last_status_on_wc1[0]
            

            # If previous status was alert (4), send clear message
            if previous_status in (4, 6, 7):
                if DebugEnable==1:
                    print(group1_mobile_number)
                message_lines = ["SUCTION AIR PRESSURE - ALERT CLEAR"]
                message_lines.append(f"{Workcenter_1}")
                message_body = "\n".join(message_lines)

                for mobile_number in group1_mobile_number:
                    payload = {
                        'user_id': '27053',
                        'api_key': api_key,
                        'sender_id': sender_id,
                        'to': mobile_number,
                        'message': message_body
                    }

                    if DebugEnable==1:
                        print("Sending to:", mobile_number)
                    response = requests.post("https://app.notify.lk/api/v1/send", data=payload)
                    print("SMS Response:", response.text)
                    
            if previous_status == 6:
                if DebugEnable==1:
                    print(group1_mobile_number)
                message_lines = ["SUCTION AIR PRESSURE - ALERT CLEAR"]
                message_lines.append(f"{Workcenter_1}")
                message_body = "\n".join(message_lines)

                for mobile_number in group2_mobile_number:
                    payload = {
                        'user_id': '27053',
                        'api_key': api_key,
                        'sender_id': sender_id,
                        'to': mobile_number,
                        'message': message_body
                    }

                    if DebugEnable==1:
                        print("Sending to:", mobile_number)
                    response = requests.post("https://app.notify.lk/api/v1/send", data=payload)
                    print("SMS Response:", response.text)
            
            if previous_status == 7:
                if DebugEnable==1:
                    print(group1_mobile_number)
                message_lines = ["SUCTION AIR PRESSURE - ALERT CLEAR"]
                message_lines.append(f"{Workcenter_1}")
                message_body = "\n".join(message_lines)

                for mobile_number in group3_mobile_number:
                    payload = {
                        'user_id': '27053',
                        'api_key': api_key,
                        'sender_id': sender_id,
                        'to': mobile_number,
                        'message': message_body
                    }

                    if DebugEnable==1:
                        print("Sending to:", mobile_number)
                    response = requests.post("https://app.notify.lk/api/v1/send", data=payload)
                    print("SMS Response:", response.text)
                    
                    
                    
            # Update status if it wasn't already 3
            if previous_status != 3:
                update_query = """
                    UPDATE tbl_sms_handling 
                    SET wc_1_status = %s, wc_1_ServerDateTime = %s 
                    WHERE MAC_Address = %s
                """
                cursor.execute(update_query, (wc_1_status, server_datetime, MacAdd))
                connection.commit()
                if DebugEnable==1:
                    print("Data Updated successfully.")
                
                          
        if Workcenter_2:
            if 6500 <= second_sensor_value <= 7000:
                if DebugEnable==1:
                    print(" Second sensor value between 6500 and 7000.")
                wc_2_status=3
                
                #last satus of Workcenter_2
                Quary_2="""SELECT wc_2_status FROM `tbl_sms_handling` WHERE MAC_Address = %s ;"""
                cursor.execute(Quary_2,(MacAdd,))
                last_status_on_wc2=cursor.fetchone()
                if DebugEnable==1:
                    print("last satus of Workcenter_2:",last_status_on_wc2)
                
                if last_status_on_wc2:
                    previous_status = last_status_on_wc2[0]
                    

                    # If previous status was alert (4), send clear message
                    if previous_status in (4, 6, 7) :
                        if DebugEnable==1:
                            print(group1_mobile_number)
                        message_lines = ["SUCTION AIR PRESSURE - ALERT CLEAR"]
                        message_lines.append(f"{Workcenter_2}")
                        message_body = "\n".join(message_lines)

                        for mobile_number in group1_mobile_number:
                            payload = {
                                'user_id': '27053',
                                'api_key': api_key,
                                'sender_id': sender_id,
                                'to': mobile_number,
                                'message': message_body
                            }

                            if DebugEnable==1:
                                print("Sending to:", mobile_number)
                            response = requests.post("https://app.notify.lk/api/v1/send", data=payload)
                            print("SMS Response:", response.text)
                    
                    if previous_status == 6:
                        if DebugEnable==1:
                            print(group1_mobile_number)
                        message_lines = ["SUCTION AIR PRESSURE - ALERT CLEAR"]
                        message_lines.append(f"{Workcenter_2}")
                        message_body = "\n".join(message_lines)

                        for mobile_number in group2_mobile_number:
                            payload = {
                                'user_id': '27053',
                                'api_key': api_key,
                                'sender_id': sender_id,
                                'to': mobile_number,
                                'message': message_body
                            }

                            if DebugEnable==1:
                                print("Sending to:", mobile_number)
                            response = requests.post("https://app.notify.lk/api/v1/send", data=payload)
                            print("SMS Response:", response.text)
                    
                    if previous_status == 7:
                        if DebugEnable==1:
                            print(group1_mobile_number)
                        message_lines = ["SUCTION AIR PRESSURE - ALERT CLEAR"]
                        message_lines.append(f"{Workcenter_2}")
                        message_body = "\n".join(message_lines)

                        for mobile_number in group3_mobile_number:
                            payload = {
                                'user_id': '27053',
                                'api_key': api_key,
                                'sender_id': sender_id,
                                'to': mobile_number,
                                'message': message_body
                            }

                            if DebugEnable==1:
                                print("Sending to:", mobile_number)
                            response = requests.post("https://app.notify.lk/api/v1/send", data=payload)
                            print("SMS Response:", response.text)

                
                
                if last_status_on_wc2 and last_status_on_wc2[0] != 3:                   
                    sql_query2 = """UPDATE tbl_sms_handling SET  wc_2_status =%s , wc_2_ServerDateTime =%s WHERE MAC_address =%s"""
                    cursor.execute(sql_query2, (wc_2_status,server_datetime,MacAdd))
                    connection.commit()
                    print("Data Updated successfully.")
                    
                
        
    
    if first_sensor_value > 7000:
        if DebugEnable==1:
            print(" First sensor value is above 7000.")
        wc_1_status=1
        
        #last satus of Workcenter_1
        Quary_1="""SELECT wc_1_status FROM `tbl_sms_handling` WHERE MAC_Address = %s ;"""
        cursor.execute(Quary_1,(MacAdd,))
        last_status_on_wc1=cursor.fetchone()
        if DebugEnable==1:
            print("last satus of Workcenter_1:",last_status_on_wc1)
        
        if last_status_on_wc1 and last_status_on_wc1[0] not in (1, 4):             
            sql_query = """UPDATE tbl_sms_handling SET  wc_1_status =%s, wc_1_ServerDateTime =%s WHERE MAC_address =%s"""
            cursor.execute(sql_query, (wc_1_status,server_datetime,MacAdd))
            connection.commit()
            if DebugEnable==1:
                print("Data Updated successfully.")
            
    if Workcenter_2:
        if second_sensor_value > 7000:
            if DebugEnable==1:
                print(" Second sensor value is above 7000.")
            wc_2_status=1
            
            #last satus of Workcenter_2
            Quary_2="""SELECT wc_2_status FROM `tbl_sms_handling` WHERE MAC_Address = %s ;"""
            cursor.execute(Quary_2,(MacAdd,))
            last_status_on_wc2=cursor.fetchone()
            if DebugEnable==1:
                print("last satus of Workcenter_2:",last_status_on_wc2)
            
            if last_status_on_wc2 and last_status_on_wc2[0] not in (1, 4):                   
                sql_query2 = """UPDATE tbl_sms_handling SET  wc_2_status =%s , wc_2_ServerDateTime =%s WHERE MAC_address =%s"""
                cursor.execute(sql_query2, (wc_2_status,server_datetime,MacAdd))
                connection.commit()
                if DebugEnable==1:
                    print("Data Updated successfully.")
        
    if 5000 < first_sensor_value < 6500:
        if DebugEnable==1:
            print(" First sensor value is below 6500.")
        wc_1_status=2
        
        #last satus of Workcenter_1
        Quary_1="""SELECT wc_1_status FROM `tbl_sms_handling` WHERE MAC_Address = %s ;"""
        cursor.execute(Quary_1,(MacAdd,))
        last_status_on_wc1=cursor.fetchone()
        if DebugEnable==1:
            print("last satus of Workcenter_1:",last_status_on_wc1)
        
        if last_status_on_wc1 and last_status_on_wc1[0] not in (2, 4):             
            sql_query = """UPDATE tbl_sms_handling SET  wc_1_status =%s, wc_1_ServerDateTime =%s WHERE MAC_address =%s"""
            cursor.execute(sql_query, (wc_1_status,server_datetime,MacAdd))
            connection.commit()
            if DebugEnable==1:
                print("Data Updated successfully.")
            
    if Workcenter_2:
        if 5000 < second_sensor_value < 6500:
            if DebugEnable==1:
                print(" Second sensor value is below 6500.")
            wc_2_status=2
            
            #last satus of Workcenter_2
            Quary_2="""SELECT wc_2_status FROM `tbl_sms_handling` WHERE MAC_Address = %s ;"""
            cursor.execute(Quary_2,(MacAdd,))
            last_status_on_wc2=cursor.fetchone()
            if DebugEnable==1:
                print("last satus of Workcenter_2:",last_status_on_wc2)
            
            if last_status_on_wc2 and last_status_on_wc2[0] not in (2, 4):                   
                sql_query2 = """UPDATE tbl_sms_handling SET  wc_2_status =%s , wc_2_ServerDateTime =%s WHERE MAC_address =%s"""
                cursor.execute(sql_query2, (wc_2_status,server_datetime,MacAdd))
                connection.commit()
                if DebugEnable==1:
                    print("Data Updated successfully.")
                
    
    if 1 < first_sensor_value < 5000:
        if DebugEnable==1:
            print(" First sensor value is below 5000.")
        wc_1_status=5
        
        #last satus of Workcenter_1
        Quary_1="""SELECT wc_1_status FROM `tbl_sms_handling` WHERE MAC_Address = %s ;"""
        cursor.execute(Quary_1,(MacAdd,))
        last_status_on_wc1=cursor.fetchone()
        if DebugEnable==1:
            print("last satus of Workcenter_1:",last_status_on_wc1)
        
        if last_status_on_wc1 and last_status_on_wc1[0] not in (5, 4):             
            sql_query = """UPDATE tbl_sms_handling SET  wc_1_status =%s, wc_1_ServerDateTime =%s WHERE MAC_address =%s"""
            cursor.execute(sql_query, (wc_1_status,server_datetime,MacAdd))
            connection.commit()
            if DebugEnable==1:
                print("Data Updated successfully.")
            
    if Workcenter_2:
        if 1 <  second_sensor_value < 5000:
            if DebugEnable==1:
                print(" Second sensor value is below 5000.")
            wc_2_status=5
            
            #last satus of Workcenter_2
            Quary_2="""SELECT wc_2_status FROM `tbl_sms_handling` WHERE MAC_Address = %s ;"""
            cursor.execute(Quary_2,(MacAdd,))
            last_status_on_wc2=cursor.fetchone()
            if DebugEnable==1:
                print("last satus of Workcenter_2:",last_status_on_wc2)
            
            if last_status_on_wc2 and last_status_on_wc2[0] not in (5, 4):                   
                sql_query2 = """UPDATE tbl_sms_handling SET  wc_2_status =%s , wc_2_ServerDateTime =%s WHERE MAC_address =%s"""
                cursor.execute(sql_query2, (wc_2_status,server_datetime,MacAdd))
                connection.commit()
                if DebugEnable==1:
                    print("Data Updated successfully.")
                
    cursor.close()
    connection.close()
    sendsms()
    
def sendsms():
    colombo_tz = pytz.timezone('Asia/Colombo')
    server_datetime = datetime.now(colombo_tz)

    connection = mysql.connector.connect(
        host=MYSQL_HOST,
        user=MYSQL_USER,
        password=MYSQL_PASSWORD,
        database=MYSQL_DATABASE
    )
    cursor = connection.cursor()

    message_lines = ["SUCTION AIR PRESSURE - ALERT"]
    message_lines30 = ["SUCTION AIR PRESSURE - ALERT"]
    message_lines60 = ["SUCTION AIR PRESSURE - ALERT"]
    wc1_ids, wc2_ids = set(), set()
    id_30,id_60,wc_name60,wc_name30= set(), set(), set(), set()
    
    #mobile_number = "94755544819"
    
    group1_mobile_number=[]
    group2_mobile_number=[]
    group3_mobile_number=[]
    
    
    query = """SELECT contactNumber FROM tblphone_numbers WHERE `group`=1;"""
    cursor.execute(query)
    results = cursor.fetchall()

    for row in results:
        group1_mobile_number.append(row[0])  # row is a tuple like (contactNumber,)

    if DebugEnable==1:
        print("Group 1 Numbers:", group1_mobile_number)
    
    
    
    query = """SELECT contactNumber FROM tblphone_numbers WHERE `group`=2;"""
    cursor.execute(query)
    results = cursor.fetchall()

    for row in results:
        group2_mobile_number.append(row[0])  # row is a tuple like (contactNumber,)

    if DebugEnable==1:
        print("Group 2 Numbers:", group2_mobile_number)
    
    
    query = """SELECT contactNumber FROM tblphone_numbers WHERE `group`=3;"""
    cursor.execute(query)
    results = cursor.fetchall()

    for row in results:
        group3_mobile_number.append(row[0])  # row is a tuple like (contactNumber,)

    if DebugEnable==1:
        print("Group 3 Numbers:", group3_mobile_number)
        

    def process_status(workcenter, status_type, status_value, id_list, label):
        query = f"SELECT ID, {workcenter}, wc_{workcenter[-1]}_ServerDateTime FROM tbl_sms_handling WHERE wc_{workcenter[-1]}_status = {status_value};"
        cursor.execute(query)
        results = cursor.fetchall()

        if not results:
           if DebugEnable==1:
               print(f"No {label} data found for {workcenter}.")
        else:
            for row_id, wc_name, wc_time in results:
                if status_type == "high":
                    if wc_time.tzinfo is None:
                        wc_time = colombo_tz.localize(wc_time)
                    if server_datetime - wc_time > timedelta(minutes=60):
                        message_lines60.append(f"{wc_name}  -HIGH")
                        id_60.add(row_id)
                        wc_name60.add(wc_name)
                        
                    elif server_datetime - wc_time > timedelta(minutes=30):
                        message_lines30.append(f"{wc_name}  -HIGH")
                        id_30.add(row_id)
                        wc_name30.add(wc_name)
                        
                    elif server_datetime - wc_time > timedelta(minutes=5):
                        
                        message_lines.append(f"{wc_name}  -HIGH")
                        id_list.add(row_id)
                else:
                    if status_type == "low":
                        if wc_time.tzinfo is None: 
                            wc_time = colombo_tz.localize(wc_time)
                        if server_datetime - wc_time > timedelta(minutes=60):
                            message_lines60.append(f"{wc_name}  -LOW")
                            id_60.add(row_id)
                            wc_name60.add(wc_name)
                            
                        elif server_datetime - wc_time > timedelta(minutes=30):
                            message_lines30.append(f"{wc_name}  -LOW")
                            id_30.add(row_id)
                            wc_name30.add(wc_name)
                            
                        elif server_datetime - wc_time > timedelta(minutes=5):
                            message_lines.append(f"{wc_name}  -LOW")
                            id_list.add(row_id)
                            
                    if status_type == "toolow":
                            message_lines.append(f"{wc_name}  -LOW")
                            id_list.add(row_id)   
                    

    # Process LOW and HIGH for both workcenters
    process_status("Workcenter_1", "low", 2, wc1_ids, "low")
    process_status("Workcenter_2", "low", 2, wc2_ids, "low")
    process_status("Workcenter_1", "high", 1, wc1_ids, "high")
    process_status("Workcenter_2", "high", 1, wc2_ids, "high")
    process_status("Workcenter_1", "toolow", 5, wc1_ids, "toolow")
    process_status("Workcenter_2", "toolow", 5, wc2_ids, "toolow")
    
    if DebugEnable==1:
        print(message_lines60)
        print(message_lines30)
        print(message_lines)

    if wc1_ids or wc2_ids:
        
        message_body = "\n".join(message_lines)
        
        for mobile_number in group1_mobile_number:
            payload = {
                'user_id': '27053',
                'api_key': api_key,
                'sender_id': sender_id,
                'to': mobile_number,
                'message': message_body
            }
            if DebugEnable==1:
                print("Sending to:", mobile_number)
            
            # Send SMS to each number inside the loop
            response = requests.post("https://app.notify.lk/api/v1/send", data=payload)
            print("SMS Response:", response.text)

        #print(wc1_ids, wc2_ids)

        cursor.executemany("UPDATE tbl_sms_handling SET wc_1_status = 4 WHERE ID = %s", [(i,) for i in wc1_ids])
        cursor.executemany("UPDATE tbl_sms_handling SET wc_2_status = 4 WHERE ID = %s", [(i,) for i in wc2_ids])
        connection.commit()
        if DebugEnable==1:
            print("Data Updated successfully.")
        
    if wc_name30:
        message_body30 = "\n".join(message_lines30)
        for mobile_number in group2_mobile_number:
            payload = {
                'user_id': '27053',
                'api_key': api_key,
                'sender_id': sender_id,
                'to': mobile_number,
                'message': message_body30
            }
            if DebugEnable==1:
                print("Sending to:", mobile_number)
            response = requests.post("https://app.notify.lk/api/v1/send", data=payload)
            print("Group 2 SMS Response:", response.text)
            
        for i in wc_name30:
            Quary_30 = """
                SELECT ID,
                    CASE 
                        WHEN Workcenter_1 = %s THEN 'Workcenter_1'
                        WHEN Workcenter_2 = %s THEN 'Workcenter_2'
                    END AS Matching_Workcenter
                FROM tbl_sms_handling
                WHERE Workcenter_1 = %s OR Workcenter_2 = %s;
            """
            cursor.execute(Quary_30, (i, i, i, i))
            results = cursor.fetchall()
            
            if results:
                for row in results:
                    id_wc = row[0]
                    workcenter_name = row[1]
                    print("ID:", id_wc, "| Matching Workcenter:", workcenter_name)
                    if workcenter_name == "Workcenter_1":
                        cursor.execute("UPDATE tbl_sms_handling SET wc_1_status = 6 WHERE ID = %s", (id_wc,))
                        connection.commit()
                        if DebugEnable==1:
                            print("Data Updated successfully.")
                    elif workcenter_name == "Workcenter_2":
                        cursor.execute("UPDATE tbl_sms_handling SET wc_2_status = 6 WHERE ID = %s", (id_wc,))
                        connection.commit()
                        if DebugEnable==1:
                            print("Data Updated successfully.")
            else:
                print(f"No match found for: {i}")
            
             
            

    if wc_name60:
        message_body60 = "\n".join(message_lines60)
        for mobile_number in group3_mobile_number:
            payload = {
                'user_id': '27053',
                'api_key': api_key,
                'sender_id': sender_id,
                'to': mobile_number,
                'message': message_body60
            }
            if DebugEnable==1:
                ("Sending to:", mobile_number)
            response = requests.post("https://app.notify.lk/api/v1/send", data=payload)
            if DebugEnable==1:
                print("Group 3 SMS Response:", response.text)
            
        for i in wc_name60:
            Quary_60 = """
                SELECT ID,
                    CASE 
                        WHEN Workcenter_1 = %s THEN 'Workcenter_1'
                        WHEN Workcenter_2 = %s THEN 'Workcenter_2'
                    END AS Matching_Workcenter
                FROM tbl_sms_handling
                WHERE Workcenter_1 = %s OR Workcenter_2 = %s;
            """
            cursor.execute(Quary_60, (i, i, i, i))
            results = cursor.fetchall()
            
            if results:
                for row in results:
                    id_wc = row[0]
                    workcenter_name = row[1]
                    if DebugEnable==1:
                        print("ID:", id_wc, "| Matching Workcenter:", workcenter_name)
                    if workcenter_name == "Workcenter_1":
                        cursor.execute("UPDATE tbl_sms_handling SET wc_1_status = 7 WHERE ID = %s", (id_wc,))
                        connection.commit()
                        if DebugEnable==1:
                            print("Data Updated successfully.")
                    elif workcenter_name == "Workcenter_2":
                        cursor.execute("UPDATE tbl_sms_handling SET wc_2_status = 7 WHERE ID = %s", (id_wc,))
                        connection.commit()
                        if DebugEnable==1:
                            print("Data Updated successfully.")
            else:
                print(f"No match found for: {i}")
            
        
    


    

    cursor.close()
    connection.close()
    
    
    
    # SHANIKA Send SMS part END---

         
    
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
    
    global high_value_date, low_value_date, high_buzzer, low_buzzer
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
       # print('get ToweLamp Mac ',Tower_Lamp_MAC)

        #Now Time
        server_datetime = datetime.now(colombo_tz)
        server_datetime = server_datetime.strftime('%Y-%m-%d %H:%M:%S')
        server_datetime=datetime.strptime(server_datetime, '%Y-%m-%d %H:%M:%S')

        #find Have a Low Values
        Low_Values_Count = "SELECT COUNT(Airpressure) FROM `tbl_summary_air_flow`  WHERE `LastUpdatedTime` >= DATE_SUB(%s, INTERVAL 1 MINUTE) AND Airpressure<6500;"
        cursor = connection.cursor()
        cursor.execute(Low_Values_Count,(server_datetime,))
        result = cursor.fetchone()
        Low_Values_Count=result[0]
        print('Low_Values_Count ',Low_Values_Count)
        
        if Low_Values_Count>0:
            if low_value_date:
                if (server_datetime-low_value_date).total_seconds()>300:
                    low_buzzer=1
                else:
                    low_buzzer=0
            else:
                low_value_date=server_datetime
        else:
            low_value_date= None
            low_buzzer=0
            
        #find Have a Low Values
        too_Low_Values_Count = "SELECT COUNT(Airpressure) FROM `tbl_summary_air_flow`  WHERE `LastUpdatedTime` >= DATE_SUB(%s, INTERVAL 1 MINUTE) AND Airpressure<5000;"
        cursor = connection.cursor()
        cursor.execute(too_Low_Values_Count,(server_datetime,))
        result = cursor.fetchone()
        too_Low_Values_Count=result[0]
        print('too_Low_Values_Count ',too_Low_Values_Count)
                  
        
        #find Have a High Values
        High_Values_Count = "SELECT COUNT(Airpressure) FROM `tbl_summary_air_flow`  WHERE `LastUpdatedTime` >= DATE_SUB(%s, INTERVAL 1 MINUTE) AND Airpressure>7000;"
        cursor = connection.cursor()
        cursor.execute(High_Values_Count,(server_datetime,))
        result = cursor.fetchone()
        High_Values_Count=result[0]
        print('High_Values_Count ',High_Values_Count)
        
        if High_Values_Count>0:
            if  high_value_date :
                if (server_datetime-high_value_date ).total_seconds()>300:
                    high_buzzer=1
                else:
                    high_buzzer=0
            else:
                high_value_date =server_datetime
        else:
            high_value_date = None
            high_buzzer=0

        if Low_Values_Count>0 and High_Values_Count>0:
            print('Red and yellow')
            if high_buzzer== 1 and low_buzzer == 1:
                strPayload = ("{\"MacAdd\":\"" + Tower_Lamp_MAC + "\",\"MsgType\":\"EventTWL\",\"EventNo\":\"2\",\"Kpd_No\":\"1\",\"Data\":[1,1,0,0,1,0]}")
            else:
                strPayload = ("{\"MacAdd\":\"" + Tower_Lamp_MAC + "\",\"MsgType\":\"EventTWL\",\"EventNo\":\"2\",\"Kpd_No\":\"1\",\"Data\":[1,1,0,0,0,0]}")
        if Low_Values_Count==0 and High_Values_Count>0:
            print("Yellow Color [High]")
            if high_buzzer==1:
                strPayload = ("{\"MacAdd\":\"" + Tower_Lamp_MAC + "\",\"MsgType\":\"EventTWL\",\"EventNo\":\"2\",\"Kpd_No\":\"1\",\"Data\":[0,1,0,0,1,0]}")
            else:
                strPayload = ("{\"MacAdd\":\"" + Tower_Lamp_MAC + "\",\"MsgType\":\"EventTWL\",\"EventNo\":\"2\",\"Kpd_No\":\"1\",\"Data\":[0,1,0,0,0,0]}")
        if Low_Values_Count>0 and High_Values_Count==0:
            print("Red Color [Low]")
            if low_buzzer==1:
                strPayload = ("{\"MacAdd\":\"" + Tower_Lamp_MAC + "\",\"MsgType\":\"EventTWL\",\"EventNo\":\"2\",\"Kpd_No\":\"1\",\"Data\":[1,0,0,0,1,0]}")
            else:
                strPayload = ("{\"MacAdd\":\"" + Tower_Lamp_MAC + "\",\"MsgType\":\"EventTWL\",\"EventNo\":\"2\",\"Kpd_No\":\"1\",\"Data\":[1,0,0,0,0,0]}")
        if Low_Values_Count==0 and High_Values_Count==0:
            print("Green Color")
            strPayload = ("{\"MacAdd\":\"" + Tower_Lamp_MAC + "\",\"MsgType\":\"EventTWL\",\"EventNo\":\"2\",\"Kpd_No\":\"1\",\"Data\":[0,0,1,0,0,0]}")
        if too_Low_Values_Count>0:
            print("red color")
            strPayload = ("{\"MacAdd\":\"" + Tower_Lamp_MAC + "\",\"MsgType\":\"EventTWL\",\"EventNo\":\"2\",\"Kpd_No\":\"1\",\"Data\":[1,0,0,0,1,0]}")
        
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



