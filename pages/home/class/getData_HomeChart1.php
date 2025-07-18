<?php

    session_start();
    require_once('../../../initialize.php');
    require_once('../../../config.php');
    
    $num = $_POST["userpara"];    
    $strFuncType = $num[0];    
    //$strFuncType = "funGetUserTable";
   
    //----------- Set TimeZone ----------------------------
  
    date_default_timezone_set('Asia/Colombo');
    $strDateTime = date("Y-m-d H:i:s");
    $strServerDateTime = date("Y-m-d H:i:s");    

    //----------- Declare Variables -----------------------  
    $i = 0; 
    $j = 0;     
    $Status_ary     = array();
    $ReturnData_ary0 = array();
    $ReturnData_ary1 = array();

    $ReturnData_ary_Time0=array();
    $ReturnData_ary_Time1=array();

    //$ReturnData_ary[0][0]  = "NA";
    $strText    = "";

    $strAirFlow=array('');
    $strTime=array(''); 
    $strSettingText    = "";
    $ReturnData_ary[0] = "NA";
  

    $strAirFlow[10]=0;
    $strTime[4]="NA";


    
    
    if($strFuncType === "funGetLineData") //------------- funUpdateEventLog --------------------
    {
        //$strUserType         = $num[1];               
        try 
        {
            
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            
            foreach(range(1,16) as $units)
            {
                
                foreach (['A', 'B'] as $suffix) 
                {
                    foreach (['Start', 'End'] as $suffix2)   //Luwa_1A_Start
                    {
                        $unit = "Luwa_".$units .$suffix.'_'. $suffix2;
                        $stmt = $conn->prepare("SELECT * 
                                                FROM tbl_event_air_flow 
                                                WHERE WorkCenter = :unit 
                                                AND ServerDateTime >=  :strDateTime - INTERVAL 1 HOUR 
                                                ORDER BY ID ASC;
                                                ");

                        $stmt->bindParam(':unit', $unit);
                        $stmt->bindParam(':strDateTime', $strDateTime);
                        $stmt->execute();
                        $stmt->setFetchMode(PDO::FETCH_ASSOC); 
                        $result = $stmt->fetchAll();
                        $rowCount = count($result);
                        ${"Result_".$unit} = $result;
                    }
                }
            }



            $resultList=
            [
                $Result_Luwa_1A_Start,
                $Result_Luwa_1A_End,
                $Result_Luwa_1B_Start,
                $Result_Luwa_1B_End,
                $Result_Luwa_2A_Start,
                $Result_Luwa_2A_End,
                $Result_Luwa_2B_Start,
                $Result_Luwa_2B_End,
                $Result_Luwa_3A_Start,
                $Result_Luwa_3A_End,
                $Result_Luwa_3B_Start,
                $Result_Luwa_3B_End,
                $Result_Luwa_4A_Start,
                $Result_Luwa_4A_End,
                $Result_Luwa_4B_Start,
                $Result_Luwa_4B_End,
                $Result_Luwa_5A_Start,
                $Result_Luwa_5A_End,
                $Result_Luwa_5B_Start,
                $Result_Luwa_5B_End,
                $Result_Luwa_6A_Start,
                $Result_Luwa_6A_End,
                $Result_Luwa_6B_Start,
                $Result_Luwa_6B_End,
                $Result_Luwa_7A_Start,
                $Result_Luwa_7A_End,
                $Result_Luwa_7B_Start,
                $Result_Luwa_7B_End,
                $Result_Luwa_8A_Start,
                $Result_Luwa_8A_End,
                $Result_Luwa_8B_Start,
                $Result_Luwa_8B_End,
                $Result_Luwa_9A_Start,
                $Result_Luwa_9A_End,
                $Result_Luwa_9B_Start,
                $Result_Luwa_9B_End,
                $Result_Luwa_10A_Start,
                $Result_Luwa_10A_End,
                $Result_Luwa_10B_Start,
                $Result_Luwa_10B_End,
                $Result_Luwa_11A_Start,
                $Result_Luwa_11A_End,
                $Result_Luwa_11B_Start,
                $Result_Luwa_11B_End,
                $Result_Luwa_12A_Start,
                $Result_Luwa_12A_End,
                $Result_Luwa_12B_Start,
                $Result_Luwa_12B_End,
                $Result_Luwa_13A_Start,
                $Result_Luwa_13A_End,
                $Result_Luwa_13B_Start,
                $Result_Luwa_13B_End,
                $Result_Luwa_14A_Start,
                $Result_Luwa_14A_End,
                $Result_Luwa_14B_Start,
                $Result_Luwa_14B_End,
                $Result_Luwa_15A_Start,
                $Result_Luwa_15A_End,
                $Result_Luwa_15B_Start,
                $Result_Luwa_15B_End,
                $Result_Luwa_16A_Start,
                $Result_Luwa_16A_End,
                $Result_Luwa_16B_Start,
                $Result_Luwa_16B_End,
            ];
            foreach ($resultList as $x => $row) 
            {
    

                foreach ($resultList[$x] as $i => $row) 
                {
                        
                    $strAirFlow1[$i]= htmlspecialchars($row['Airpressure']);
                    ${"strAirFlow" . $x}[$i] = htmlspecialchars($row['Airpressure']);
                  

                    //$strTime[$i]= htmlspecialchars("H:i",strtotime$row['ServerDatetime']);
                    ${"strTime".$x}[$i] = htmlspecialchars(date("H:i", strtotime($row['ServerDateTime'])));
                
                }
            }

            


            
            {
               


                foreach ($resultList as $x => $row) 
                {
        
                    foreach ($resultList[$x] as $i => $row) 
                    {
                       
                            ${"ReturnData_ary".$x}[$i] = ${"strAirFlow".$x}[$i];  
                            ${"ReturnData_ary_Time".$x}[$i] = ${"strTime".$x}[$i];        
                            

                    }
                }
                
                $Status_ary[0] = "true";
                $Status_ary[1] = "Data Available"; 
            } 
        } 
        catch(PDOException $ex) 
        {
            //$error =  "Error: " . $e->getMessage();
            $Status_ary[0] = "false";
            $Status_ary[1] = 'Error Msg: ' .$ex->getMessage();        
        }    
        $conn = null;
    }



    $data_ary['Status_Ary'] = $Status_ary;
  
    //$data_ary['Data_Ary']   = $ReturnData_ary0;
    //$data_ary['Data_Ary2']   = $ReturnData_ary_Time0;
    //$data_ary['Data_Ary3']   = $ReturnData_ary1;
    //$data_ary['Data_Ary4']   = $ReturnData_ary_Time1;
    
    //1A
    $data_ary['Data_Ary'] =!empty($ReturnData_ary0) ? $ReturnData_ary0 : [0];
    $data_ary['Data_Ary2'] =!empty($ReturnData_ary_Time0) ? $ReturnData_ary_Time0 : [0];

     //1B
    $data_ary['Data_Ary3'] =!empty($ReturnData_ary1) ? $ReturnData_ary1 : [0];
    $data_ary['Data_Ary4'] =!empty($ReturnData_ary_Time1) ? $ReturnData_ary_Time1 : [0];

    //2A
    $data_ary['Data_Ary5'] =!empty($ReturnData_ary2) ? $ReturnData_ary2 : [0];
    $data_ary['Data_Ary6'] =!empty($ReturnData_ary_Time2) ? $ReturnData_ary_Time2 : [0];
 
    //2B
    $data_ary['Data_Ary7'] =!empty($ReturnData_ary3) ? $ReturnData_ary3 : [0];
    $data_ary['Data_Ary8'] =!empty($ReturnData_ary_Time3) ? $ReturnData_ary_Time3 : [0];

    //3A
    $data_ary['Data_Ary9'] =!empty($ReturnData_ary4) ? $ReturnData_ary4 : [0];
    $data_ary['Data_Ary10'] =!empty($ReturnData_ary_Time4) ? $ReturnData_ary_Time4: [0];
    
    //3B
    $data_ary['Data_Ary11'] =!empty($ReturnData_ary5) ? $ReturnData_ary5 : [0];
    $data_ary['Data_Ary12'] =!empty($ReturnData_ary_Time5) ? $ReturnData_ary_Time5: [0];

    //4A
    $data_ary['Data_Ary13'] =!empty($ReturnData_ary6) ? $ReturnData_ary6 : [0];
    $data_ary['Data_Ary14'] =!empty($ReturnData_ary_Time6) ? $ReturnData_ary_Time6: [0];

    //4B
    $data_ary['Data_Ary15'] =!empty($ReturnData_ary7) ? $ReturnData_ary7 : [0];
    $data_ary['Data_Ary16'] =!empty($ReturnData_ary_Time7) ? $ReturnData_ary_Time7: [0];
  
    //5A
    $data_ary['Data_Ary17'] =!empty($ReturnData_ary8) ? $ReturnData_ary8 : [0];
    $data_ary['Data_Ary18'] =!empty($ReturnData_ary_Time8) ? $ReturnData_ary_Time8: [0];

    //5B
    $data_ary['Data_Ary19'] =!empty($ReturnData_ary9) ? $ReturnData_ary9 : [0];
    $data_ary['Data_Ary20'] =!empty($ReturnData_ary_Time9) ? $ReturnData_ary_Time9: [0];
  

    //6A
    $data_ary['Data_Ary21'] =!empty($ReturnData_ary10) ? $ReturnData_ary10 : [0];
    $data_ary['Data_Ary22'] =!empty($ReturnData_ary_Time10) ? $ReturnData_ary_Time10: [0];

    //6B
    $data_ary['Data_Ary23'] =!empty($ReturnData_ary11) ? $ReturnData_ary11 : [0];
    $data_ary['Data_Ary24'] =!empty($ReturnData_ary_Time11) ? $ReturnData_ary_Time11: [0];

    //7A
    $data_ary['Data_Ary25'] =!empty($ReturnData_ary12) ? $ReturnData_ary12 : [0];
    $data_ary['Data_Ary26'] =!empty($ReturnData_ary_Time12) ? $ReturnData_ary_Time12: [0];
 
    //7B
    $data_ary['Data_Ary27'] =!empty($ReturnData_ary13) ? $ReturnData_ary13 : [0];
    $data_ary['Data_Ary28'] =!empty($ReturnData_ary_Time13) ? $ReturnData_ary_Time13: [0]; 

    //8A
    $data_ary['Data_Ary29'] =!empty($ReturnData_ary14) ? $ReturnData_ary14 : [0];
    $data_ary['Data_Ary30'] =!empty($ReturnData_ary_Time14) ? $ReturnData_ary_Time14: [0];
  
    //8B
    $data_ary['Data_Ary31'] =!empty($ReturnData_ary15) ? $ReturnData_ary15 : [0];
    $data_ary['Data_Ary32'] =!empty($ReturnData_ary_Time15) ? $ReturnData_ary_Time15: [0]; 

    //9A
    $data_ary['Data_Ary33'] =!empty($ReturnData_ary16) ? $ReturnData_ary16 : [0];
    $data_ary['Data_Ary34'] =!empty($ReturnData_ary_Time16) ? $ReturnData_ary_Time16: [0];
  
    //9B
    $data_ary['Data_Ary35'] =!empty($ReturnData_ary17) ? $ReturnData_ary17 : [0];
    $data_ary['Data_Ary36'] =!empty($ReturnData_ary_Time17) ? $ReturnData_ary_Time17: [0];
    
    //10A
    $data_ary['Data_Ary37'] =!empty($ReturnData_ary18) ? $ReturnData_ary18 : [0];
    $data_ary['Data_Ary38'] =!empty($ReturnData_ary_Time18) ? $ReturnData_ary_Time18: [0];
  
    //10B
    $data_ary['Data_Ary39'] =!empty($ReturnData_ary19) ? $ReturnData_ary19 : [0];
    $data_ary['Data_Ary40'] =!empty($ReturnData_ary_Time19) ? $ReturnData_ary_Time19: [0]; 

    //11A
    $data_ary['Data_Ary41'] =!empty($ReturnData_ary20) ? $ReturnData_ary20 : [0];
    $data_ary['Data_Ary42'] =!empty($ReturnData_ary_Time20) ? $ReturnData_ary_Time20: [0];
  
    //11B
    $data_ary['Data_Ary43'] =!empty($ReturnData_ary21) ? $ReturnData_ary21 : [0];
    $data_ary['Data_Ary44'] =!empty($ReturnData_ary_Time21) ? $ReturnData_ary_Time21: [0]; 

    //12A
    $data_ary['Data_Ary45'] =!empty($ReturnData_ary22) ? $ReturnData_ary22 : [0];
    $data_ary['Data_Ary46'] =!empty($ReturnData_ary_Time22) ? $ReturnData_ary_Time22: [0]; 

    //12B
    $data_ary['Data_Ary47'] =!empty($ReturnData_ary23) ? $ReturnData_ary23 : [0];
    $data_ary['Data_Ary48'] =!empty($ReturnData_ary_Time23) ? $ReturnData_ary_Time23: [0]; 

   

    //13A
    $data_ary['Data_Ary49'] =!empty($ReturnData_ary24) ? $ReturnData_ary24 : [0];
    $data_ary['Data_Ary50'] =!empty($ReturnData_ary_Time24) ? $ReturnData_ary_Time24: [0]; 

    //13B
    $data_ary['Data_Ary51'] =!empty($ReturnData_ary25) ? $ReturnData_ary25 : [0];
    $data_ary['Data_Ary52'] =!empty($ReturnData_ary_Time25) ? $ReturnData_ary_Time25: [0]; 

    //14A
    $data_ary['Data_Ary53'] =!empty($ReturnData_ary26) ? $ReturnData_ary26 : [0];
    $data_ary['Data_Ary54'] =!empty($ReturnData_ary_Time26) ? $ReturnData_ary_Time26: [0]; 
   
    //14B
    $data_ary['Data_Ary55'] =!empty($ReturnData_ary27) ? $ReturnData_ary27 : [0];
    $data_ary['Data_Ary56'] =!empty($ReturnData_ary_Time27) ? $ReturnData_ary_Time27: [0]; 

    //15A
    $data_ary['Data_Ary57'] =!empty($ReturnData_ary28) ? $ReturnData_ary28 : [0];
    $data_ary['Data_Ary58'] =!empty($ReturnData_ary_Time28) ? $ReturnData_ary_Time28: [0]; 

    //15B
    $data_ary['Data_Ary59'] =!empty($ReturnData_ary29) ? $ReturnData_ary29 : [0];
    $data_ary['Data_Ary60'] =!empty($ReturnData_ary_Time29) ? $ReturnData_ary_Time29: [0]; 

    //16A
    $data_ary['Data_Ary61'] =!empty($ReturnData_ary30) ? $ReturnData_ary30 : [0];
    $data_ary['Data_Ary62'] =!empty($ReturnData_ary_Time30) ? $ReturnData_ary_Time30: [0]; 

    //16B
    $data_ary['Data_Ary63'] =!empty($ReturnData_ary31) ? $ReturnData_ary31 : [0];
    $data_ary['Data_Ary64'] =!empty($ReturnData_ary_Time31) ? $ReturnData_ary_Time31: [0];

    //17A
    $data_ary['Data_Ary65'] =!empty($ReturnData_ary32) ? $ReturnData_ary32 : [0];
    $data_ary['Data_Ary66'] =!empty($ReturnData_ary_Time32) ? $ReturnData_ary_Time32: [0];

    //17B
    $data_ary['Data_Ary67'] =!empty($ReturnData_ary33) ? $ReturnData_ary33 : [0];
    $data_ary['Data_Ary68'] =!empty($ReturnData_ary_Time33) ? $ReturnData_ary_Time33: [0];

    //18A
    $data_ary['Data_Ary69'] =!empty($ReturnData_ary34) ? $ReturnData_ary34 : [0];
    $data_ary['Data_Ary70'] =!empty($ReturnData_ary_Time34) ? $ReturnData_ary_Time34: [0];

    //18B
    $data_ary['Data_Ary71'] =!empty($ReturnData_ary35) ? $ReturnData_ary35 : [0];
    $data_ary['Data_Ary72'] =!empty($ReturnData_ary_Time35) ? $ReturnData_ary_Time35: [0];
  
      
    //print json_encode($error);
    print json_encode($data_ary);
   
  

?>
