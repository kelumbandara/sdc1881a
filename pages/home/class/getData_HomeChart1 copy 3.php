<?php

    session_start();
    require_once('../../../initialize.php');
    require_once('../../../config.php');
    
    $num = $_POST["userpara"];    
    $strFuncType = $num[0];    
    //$strFuncType = "funGetUserTable";
   
    //----------- Set TimeZone ----------------------------
    date_default_timezone_set('Asia/Kolkata');
    $strServerDateTime = date("Y-m-d H:i:s");    
    //----------- Declare Variables -----------------------  
    $i = 0; 
    $j = 0;     
    $Status_ary     = array();
    $ReturnData_ary1 = array();
    $ReturnData_ary = array();
    $ReturnData_ary2=array();

  



    //$ReturnData_ary[0][0]  = "NA";
    $strText    = "";

    $strAirFlow=array('');
    $strTime=array(''); 
    $strSettingText    = "";
    $ReturnData_ary[0] = "NA";
  

    $strAirFlow[10]=0;
    $strTime[4]="NA";

    $resultLine_1A=[];
    $resultLine_3A=[];
    
    
    
    if($strFuncType === "funGetLineData") //------------- funUpdateEventLog --------------------
    {
        //$strUserType         = $num[1];               
        try 
        {
            
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            
            foreach(range(1,32) as $units)
            {
                //Drive


                foreach (['A', 'B'] as $suffix) 
                {
                    
                    $unit = "Line_{$units}{$suffix}";
                    //Line_1A,Line_1B

                  

                    $stmt = $conn->prepare("SELECT * FROM (SELECT * FROM tbl_event_air_flow WHERE WorkCenter = :unit ORDER BY ID DESC   ) subquery WHERE ServerDateTime >= NOW() - INTERVAL 3 HOUR ORDER BY ID ASC  ;");
                    
                    
                    
                    
                    //$stmt = $conn->prepare("SELECT * FROM (SELECT * FROM tbl_event_air_flow WHERE  WorkCenter = :unit ORDER BY ID DESC  ) subquery WHERE MOD(ID, 2) = 1 AND ServerDateTime >= NOW() - INTERVAL 13 HOUR ORDER BY ID ASC ;");
                    
                    $stmt->bindParam(':unit', $unit);
                    $stmt->execute();
                    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
                    
                    $result = $stmt->fetchAll();

                    $rowCount = count($result);
                    
                    ${"result" . $unit} = $result;

               }

                
                    
                
            }

            sleep(5);
             
            // At this point, $result1 and $result2 hold the fetched data for Unit 1 and Unit 2 respectively

            $resultList=
                [
                    $resultLine_1A,$resultLine_1B,
                    $resultLine_2A,$resultLine_2B,
                    $resultLine_3A,
                    $resultLine_3B,
                  

                    $resultLine_4A,
                     //$resultLine_4B,

                    //$resultLine_3A,
                   // $resultLine_3B,
                     //$resultLine_4A,$resultLine_4B,
                ];
              

                sleep(5);
            foreach ($resultList as $x => $row) 
            {
    

                foreach ($resultList[$x] as $i => $row) 
                {
                        
                   // $strAirFlow1[$i]= htmlspecialchars($row['Airpressure']);
                    ${"strAirFlow" . $x}[$i] = htmlspecialchars($row['Airpressure']);
                  

                    //$strTime[$i]= htmlspecialchars("H:i",strtotime$row['ServerDatetime']);
                    ${"strTime".$x}[$i] = htmlspecialchars(date("H:i", strtotime($row['ServerDateTime'])));
                
                }
            }

            


            if($i === 0)    // No Data
            {
                $Status_ary[0] = "false";
                $Status_ary[1] = "Data not found"; 
            }
            else
            {
               

                
                // for ($x = 0; $x < $i; $x++) 
                //   {
                //     $ReturnData_ary[$x] = $strAirFlow0[$x];       //Chart 1
                //     $ReturnData_ary2[$x] = $strTime0[$x];      //Chart 1
                //     $ReturnData_ary3[$x] = $strAirFlow1[$x]; 
                //     $ReturnData_ary4[$x] = $strTime1[$x]; 

                //   }

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
    sleep(5);
    //1A
    $data_ary['Data_Ary']  =!empty($ReturnData_ary0) ? $ReturnData_ary0 : [0];
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

    // //4B
    // $data_ary['Data_Ary15'] =!empty($ReturnData_ary7) ? $ReturnData_ary7 : [0];
    // $data_ary['Data_Ary16'] =!empty($ReturnData_ary_Time7) ? $ReturnData_ary_Time7: [0];
  

  
        
    //print json_encode($error);
    print json_encode($data_ary);
   
  

?>
