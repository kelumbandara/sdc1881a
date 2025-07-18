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


    
    
    if($strFuncType === "funGetLineData") //------------- funUpdateEventLog --------------------
    {
        //$strUserType         = $num[1];               
        try 
        {
            
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            
            foreach(range(1,16) as $units)
            {
                //Drive


                foreach (['A', 'B'] as $suffix) 
                {
                    
                    $unit = "Line_{$units}{$suffix}";
                    //Line_1A,Line_1B

                    $stmt = $conn->prepare("SELECT * FROM `tbl_event_air_flow`WHERE WorkCenter = 'Line_1A'AND (TIMESTAMPDIFF(MINUTE, start_time, end_time) = 8 OR TIMESTAMPDIFF(MINUTE, start_time, end_time) = 10);");

                    //$stmt = $conn->prepare("SELECT * FROM (SELECT * FROM tbl_event_air_flow WHERE WorkCenter = :unit ORDER BY ID DESC  ) subquery WHERE ServerDateTime >= NOW() - INTERVAL 13 HOUR ORDER BY ID ASC ;");
                    //$stmt = $conn->prepare("SELECT * FROM tbl_summary_air_flow WHERE LastUpdatedTime >= DATE_SUB(NOW(), INTERVAL 0.1 HOUR);");
                    //$stmt = $conn->prepare("SELECT * FROM (SELECT * FROM tbleventairflow WHERE FlowMeterNo = 'Line1A' ORDER BY ID DESC LIMIT 5) subquery ORDER BY ID ASC");

                    //$stmt = $conn->prepare("SELECT * FROM (SELECT * FROM btuevent WHERE Unit = $unit ORDER BY ID DESC LIMIT 5) subquery ORDER BY ID ASC;");
                   //$stmt = $conn->prepare("SELECT * FROM `tbl_event_air_flow` WHERE WorkCenter = 'Line_1A' AND `ServerDateTime` >= NOW() - INTERVAL 3 HOUR AND ID = 1 ORDER BY `ServerDateTime` ASC;");
                    
                    $stmt->bindParam(':unit', $unit);
                    $stmt->execute();
                    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
                    $result = $stmt->fetchAll();

                    $rowCount = count($result);
                    $emptyRecodes=5 -$rowCount;

                    $arraySize = count($result);
                    


                    ${"result" . $unit} = $result;

               }
                
                    
                
            }
             
            // At this point, $result1 and $result2 hold the fetched data for Unit 1 and Unit 2 respectively

            $resultList=[$resultLine_1A,$resultLine_1B];
            

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

    $data_ary['Data_Ary']  =!empty($ReturnData_ary0) ? $ReturnData_ary0 : [0];
    $data_ary['Data_Ary2'] =!empty($ReturnData_ary_Time0) ? $ReturnData_ary_Time0 : [0];
    $data_ary['Data_Ary3'] =!empty($ReturnData_ary1) ? $ReturnData_ary1 : [0];
    $data_ary['Data_Ary4'] =!empty($ReturnData_ary_Time1) ? $ReturnData_ary_Time1 : [0];
    $data_ary['Data_Ary5'] =!empty($ReturnData_ary2) ? $ReturnData_ary2 : [0];
    $data_ary['Data_Ary6'] =!empty($ReturnData_ary_Time2) ? $ReturnData_ary_Time2 : [0];
    
  

  
        
    //print json_encode($error);
    print json_encode($data_ary);
   
  

?>
