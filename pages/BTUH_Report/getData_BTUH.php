<?php

    session_start();
    require_once('../../initialize.php');
    require_once('../../config.php');
    
    $num = $_POST["userpara"];    
    $strFuncType = $num[0];    
    //$strFuncType = "funGetData_Table";
      
    //----------- Set TimeZone ----------------------------
    date_default_timezone_set('Asia/Kolkata');
    $strServerDateTime = date("Y-m-d H:i:s");    
    //----------- Declare Variables -----------------------  
    $i = 0; 
    $j = 0;     
    $Status_ary     = array();
    $ReturnData_ary = array();
    //$ReturnData_ary[0][0]  = "NA";
    $strText    = "";
    $ReturnData_ary[0][0] = "NA"; 
    //$ReturnData_ary[0][1] = "NA";
    //$ReturnData_ary[1][0] = "NA"; 
    //$ReturnData_ary[1][1] = "NA";
    
    $intWoState = 4;    
    
    //------------- Table data load --------------------
     if($strFuncType === "funGetData_Table") 
    {        
        $strStarDate3       = $num[1];
        $strEndDate3        = $num[2];
        try 
        { 
            $sqlString = "
                SELECT 
                    DATE(`ServerDatetime`) AS DatePart,
                    -- For MeterNumber = '1'
                    MIN(CASE WHEN `MeterNumber` = '1' AND TIME(`ServerDatetime`) BETWEEN '00:00:00' AND '05:30:00' THEN `Enet` END) AS Enet_Min_T1_Meter1,
                    MAX(CASE WHEN `MeterNumber` = '1' AND TIME(`ServerDatetime`) BETWEEN '00:00:00' AND '05:30:00' THEN `Enet` END) AS Enet_Max_T1_Meter1,
                    MIN(CASE WHEN `MeterNumber` = '1' AND TIME(`ServerDatetime`) BETWEEN '18:30:00' AND '22:30:00' THEN `Enet` END) AS Enet_Min_T2_Meter1,
                    MAX(CASE WHEN `MeterNumber` = '1' AND TIME(`ServerDatetime`) BETWEEN '18:30:00' AND '22:30:00' THEN `Enet` END) AS Enet_Max_T2_Meter1,
                    MAX(CASE WHEN `MeterNumber` = '1' AND TIME(`ServerDatetime`) BETWEEN '22:30:00' AND '23:59:59' THEN `Enet` END) AS Enet_Max_T3_Meter1,
                    -- For MeterNumber = '2'
                    MIN(CASE WHEN `MeterNumber` = '2' AND TIME(`ServerDatetime`) BETWEEN '00:00:00' AND '05:30:00' THEN `Enet` END) AS Enet_Min_T1_Meter2,
                    MAX(CASE WHEN `MeterNumber` = '2' AND TIME(`ServerDatetime`) BETWEEN '00:00:00' AND '05:30:00' THEN `Enet` END) AS Enet_Max_T1_Meter2,
                    MIN(CASE WHEN `MeterNumber` = '2' AND TIME(`ServerDatetime`) BETWEEN '18:30:00' AND '22:30:00' THEN `Enet` END) AS Enet_Min_T2_Meter2,
                    MAX(CASE WHEN `MeterNumber` = '2' AND TIME(`ServerDatetime`) BETWEEN '18:30:00' AND '22:30:00' THEN `Enet` END) AS Enet_Max_T2_Meter2,
                    MAX(CASE WHEN `MeterNumber` = '2' AND TIME(`ServerDatetime`) BETWEEN '22:30:00' AND '23:59:59' THEN `Enet` END) AS Enet_Max_T3_Meter2
                FROM 
                    `btuevent`
                WHERE 
                    DATE(`ServerDatetime`) BETWEEN :sdate AND :edate
                GROUP BY 
                    DATE(`ServerDatetime`)
                ORDER BY 
                    DatePart ASC;";


            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            $stmt = $conn->prepare($sqlString);
            $stmt->bindParam(':sdate', $strStarDate3); 
            $stmt->bindParam(':edate', $strEndDate3);

            $stmt->execute();
            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);        
            $result = $stmt->fetchAll();
            $i = 0;
            foreach($result as $row)
            {
                $ReturnData_ary[$i][0] = $row['DatePart'];
                $ReturnData_ary[$i][1] = $row['Enet_Min_T2_Meter1'] - $row['Enet_Max_T1_Meter1'];       // 05:30:00 to 18:30:00
                $ReturnData_ary[$i][2] = $row['Enet_Max_T2_Meter1'] - $row['Enet_Min_T2_Meter1'];       // 18:30:00 to 22:30:00
                $ReturnData_ary[$i][3] = ($row['Enet_Max_T1_Meter1'] - $row['Enet_Min_T1_Meter1']) + ($row['Enet_Max_T3_Meter1'] - $row['Enet_Max_T2_Meter1']); // Morning +Night
              
                $ReturnData_ary[$i][4] = $row['Enet_Min_T2_Meter2'] - $row['Enet_Max_T1_Meter2'];       // 05:30:00 to 18:30:00
                $ReturnData_ary[$i][5] = $row['Enet_Max_T2_Meter2'] - $row['Enet_Min_T2_Meter2'];       // 18:30:00 to 22:30:00
                $ReturnData_ary[$i][6] = ($row['Enet_Max_T1_Meter2'] - $row['Enet_Min_T1_Meter2']) + ($row['Enet_Max_T3_Meter2'] - $row['Enet_Max_T2_Meter2']); // Morning +Night
                
                $i++;
            }  
            if($i === 0)    // No Data
             {
                $ReturnData_ary[0] = $strText;
                $Status_ary[0] = "false";
                $Status_ary[1] = "Data not found"; 
            }
            else
            {
                //$ReturnData_ary[0] = $strText;
                $Status_ary[0] = "true";
                $Status_ary[1] = "Data Available"; 
            } 
        } 
        catch(PDOException $ex) 
        {
            //$error =  "Error: " . $e->getMessage();
            $Status_ary[0] = "error";
            $Status_ary[1] = 'Error Msg: ' .$ex->getMessage();        
        }    
        $conn=null;
    }

    $data_ary['Status_Ary'] = $Status_ary;
    $data_ary['Data_Ary']   = $ReturnData_ary;
        
    //print json_encode($error);
    print json_encode($data_ary); 

?>
