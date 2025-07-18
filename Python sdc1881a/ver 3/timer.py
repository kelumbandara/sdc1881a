def Timer(MacAdd,client):
    
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
                query= """ SELECT LastUpdatedTime FROM `tbl_summary_air_flow` WHERE WorkCenter=%s OR WorkCenter=%s ORDER BY LastUpdatedTime DESC LIMIT 1;"""
             
                last_data_insert_time=0
                print(last_data_insert_time)

                try:
                     cursor.execute(query, (Workcenter_1, Workcenter_2))
                     rows = cursor.fetchone()  # Fetch the first row only

                    



                    if rows == " ":
                        print("No data found.  return 1")
                        return 1
                    
                    time.sleep(1)
                    
                    # Print the actual value
                    if rows:
                        for row in rows:
                            
                            last_data_insert_time=row[0]
                            

                            #print("last_data_insert_time:",last_data_insert_time)  # row[0] contains the first column value
                            
                    else:
                        print("No data found. last_data_insert_time")
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
                

                    last_data_insert_time_add_5_min=last_data_insert_time+timedelta(seconds=15)
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
    
     