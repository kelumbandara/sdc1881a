
<?php
    
    $num = $_POST["userpara"];    
    
    $strFuncType = $num[0];    
    //$strFuncType = "funGet_Summary_Last30"; 
    
    //$num[1] = "1";
    //$num[2] = "WoDepartment";
    //$num[3] = "Engineering";       //Engineering
    //----------- Database Connection ---------------------
    require '../../../dbconnection/dbConnection.php';   
    //----------- Error Loging Path ---------------------
    //require_once '../class/logging.php';
    //----------- Set TimeZone ----------------------------
    date_default_timezone_set('Asia/Colombo');
    $strDateTime = date("Y-m-d");   
    //----------- Declare Variables -----------------------     
    $i = 0; 
    $j = 0; 
    $error = "NA";
    $intWoState = 4;   
    
    $Status_ary     = array();
    $ReturnData_ary = array();
    $ReturnData_ary[0]  = "NA"; 
    //----------------- Function : Get Checking Details ------------------------------
    if($strFuncType === "MFM_Real_Time_Data")      //-------------- funGetCheckInDetails_byWoEpf -----------
    {
        //$strWoState     = $num[1];    
        //$strWoCategory     = "BreakDown";    
        try 
        {    
    
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //--------- MFM Real Time Data ---------------------------------------------
            $stmt = $conn->prepare("
            SELECT * 
            FROM 
                btuevent 
            WHERE 
                MeterNumber='1' 
            ORDER BY 
                ServerDatetime DESC LIMIT 1;
            ");
            
            //$stmt->bindParam(':wocat', $strWoCategory); 
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);     
            // If you want to assign these values to an array as in the original code
            $ReturnData_ary[0] = $result['ThermalEnergyUnit'];
            $ReturnData_ary[1] = $result['ChilledWaterFlow'];
            $ReturnData_ary[2] = $result['ChilledWaterSupplyTemp'];
            $ReturnData_ary[3] = $result['ChilledWaterReturnTemp'];
            $ReturnData_ary[5] = $result['LstUpDateTime'];
            
            //--------- total units ---------------------------------------------
            $stmt = $conn->prepare("
                                    SELECT
                                        t1.ThermalEnergyUnit AS ThermalEnergyUnit_Meter1,
                                        t2.ThermalEnergyUnit AS ThermalEnergyUnit_Meter2
                                    FROM 
                                        (SELECT 
                                            ID, 
                                            ServerDatetime, 
                                            ThermalEnergyUnit 
                                        FROM 
                                            btuevent 
                                        WHERE 
                                            MeterNumber = '1'
                                        ORDER BY 
                                            ServerDatetime DESC
                                        LIMIT 1) t1
                                    JOIN 
                                        (SELECT 
                                            ServerDatetime, 
                                            ThermalEnergyUnit 
                                        FROM 
                                            btuevent 
                                        WHERE 
                                            MeterNumber = '2'
                                        ORDER BY 
                                            
                                        ServerDatetime DESC
                                        LIMIT 1) t2;");
            //$stmt->bindParam(':wocat', $strWoCategory); 
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);     
            // If you want to assign these values to an array as in the original code
            $ReturnData_ary[4] = $result['ThermalEnergyUnit_Meter1'] + $result['ThermalEnergyUnit_Meter2'];
            

            
            
            $i++;
            if($i === 0)    // No Data
            {
                $Status_ary[0] = "false";
                $Status_ary[1] = "Data not found"; 
            }
            else
            {
                
                $Status_ary[0] = "true";
                $Status_ary[1] = "Data Available"; 
            }  
            
            //echo $strSummaryAry;
        } 
        catch(PDOException $e) 
        {
            $error =  "Error: " . $e->getMessage();            
            //writeToLogFile($error);
        }    
        $conn = null;        
    }
    else if($strFuncType === "MFI_Real_Time_Data")      //-------------- funGetCheckInDetails_byWoEpf -----------
    {
        //$strWoState     = $num[1];    
        $strWoCategory     = "BreakDown";    
        try 
        {    
    
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //--------- MFM Real Time Data ---------------------------------------------
            $stmt = $conn->prepare("
            SELECT * FROM btuevent WHERE MeterNumber='2' ORDER BY ServerDatetime DESC LIMIT 1;
            ");
            
            //$stmt->bindParam(':wocat', $strWoCategory); 
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);     
            // If you want to assign these values to an array as in the original code
            $ReturnData_ary[0] = $result['ThermalEnergyUnit'];
            $ReturnData_ary[1] = $result['ChilledWaterFlow'];
            $ReturnData_ary[2] = $result['ChilledWaterSupplyTemp'];
            $ReturnData_ary[3] = $result['ChilledWaterReturnTemp'];
            $ReturnData_ary[4] = $result['LstUpDateTime'];
            

            //--------- total units ---------------------------------------------
            $stmt = $conn->prepare("
                                    SELECT
                                        t1.ThermalEnergyUnit AS ThermalEnergyUnit_Meter1,
                                        t2.ThermalEnergyUnit AS ThermalEnergyUnit_Meter2
                                    FROM 
                                        (SELECT 
                                            ID, 
                                            ServerDatetime, 
                                            ThermalEnergyUnit 
                                        FROM 
                                            btuevent 
                                        WHERE 
                                            MeterNumber = '1'
                                        ORDER BY 
                                            ServerDatetime DESC
                                        LIMIT 1) t1
                                    JOIN 
                                        (SELECT 
                                            ServerDatetime, 
                                            ThermalEnergyUnit 
                                        FROM 
                                            btuevent 
                                        WHERE 
                                            MeterNumber = '2'
                                        ORDER BY 
                                            
                                        ServerDatetime DESC
                                        LIMIT 1) t2;");
            //$stmt->bindParam(':wocat', $strWoCategory); 
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);     
            // If you want to assign these values to an array as in the original code
            $ReturnData_ary[5] = $result['ThermalEnergyUnit_Meter1'] + $result['ThermalEnergyUnit_Meter2'];

            $i++;
            if($i === 0)    // No Data
            {
                $Status_ary[0] = "false";
                $Status_ary[1] = "Data not found"; 
            }
            else
            {
                $Status_ary[0] = "true";
                $Status_ary[1] = "Data Available"; 
            }  
            
            //echo $strSummaryAry;
        } 
        catch(PDOException $e) 
        {
            $error =  "Error: " . $e->getMessage();            
            //writeToLogFile($error);
        }    
        $conn = null;        
    }
    $data_ary['Status_Ary'] = $Status_ary;
    $data_ary['Data_Ary']   = $ReturnData_ary;
          
    //print json_encode($error);
    print json_encode($data_ary); 
    // print json_encode($ProductQuantity_ary);
       
?>