
<?php
    
    $num = $_POST["userpara"];    
    //$startData = $num[0];
    //$endData = $num[1];
    //----------- Database Connection ---------------------
    require '../../../dbconnection/dbConnection.php';        
    //----------- Set TimeZone ----------------------------
    date_default_timezone_set('Asia/Colombo');
    $strDateTime = date("Y-m-d");   
    //----------- Declare Variables -----------------------     
    $i = 0; 
    $j = 0; 
    $error = "NA";
    $intWoState = 6;
               
    // Calculate the start date of the last week
    $start_date = date('Y-m-d', strtotime('-6 days'));
    try 
    {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);                       
        //$stmt = $conn->prepare("SELECT DATE(CreatedDateTime) AS DatePart, COUNT(WorkOrderNo) AS TotalWorkOrders FROM tblwo_event WHERE DATE(CreatedDateTime) >= :start_date GROUP BY DATE(CreatedDateTime) ORDER BY DatePart");
        // $stmt = $conn->prepare("
        // WITH latest_values AS ( SELECT MeterNumber, ThermalEnergyUnit, DATE_FORMAT(ServerDatetime, '%m-%d') AS DatePart, ROW_NUMBER() OVER (PARTITION BY MeterNumber, DATE_FORMAT(ServerDatetime, '%m-%d') ORDER BY ServerDatetime DESC) AS RowNum FROM btuevent
        //  WHERE MeterNumber IN ('1', '2') ) SELECT DatePart, MAX(CASE WHEN MeterNumber = '1' THEN ThermalEnergyUnit END) AS MeterNumber1, MAX(CASE WHEN MeterNumber = '2' THEN ThermalEnergyUnit END) AS MeterNumber2 FROM latest_values WHERE RowNum = 1 GROUP BY DatePart;
        // ");


        $stmt = $conn->prepare("WITH latest_values AS (
                                    SELECT 
                                        MeterNumber, 
                                        ThermalEnergyUnit, 
                                        DATE_FORMAT(ServerDatetime, '%m-%d') AS DatePart, 
                                        ROW_NUMBER() OVER (PARTITION BY MeterNumber, DATE_FORMAT(ServerDatetime, '%m-%d') ORDER BY ServerDatetime DESC) AS RowNum
                                    FROM btuevent
                                    WHERE 
                                        MeterNumber IN ('1', '2') 
                                        AND ServerDatetime >= NOW() - INTERVAL 7 DAY  -- Limits to the last 7 days
                                )
                                SELECT 
                                    DatePart, 
                                    MAX(CASE WHEN MeterNumber = '1' THEN ThermalEnergyUnit END) AS MeterNumber1,
                                    MAX(CASE WHEN MeterNumber = '2' THEN ThermalEnergyUnit END) AS MeterNumber2
                                FROM latest_values
                                WHERE RowNum = 1
                                GROUP BY DatePart");
         


        $stmt->execute();
        // set the resulting array to associative
        $stmt->setFetchMode(PDO::FETCH_ASSOC);        
        $result = $stmt->fetchAll();        
        foreach($result as $row)
        {           
            $Date_ary[$i]                   = $row['DatePart']; 
            $TotPlacedWorkOrders_ary[$i]    = $row['MeterNumber1']; 
            $CompletedWorkOrders_ary[$i]    = $row['MeterNumber2']; 
           
            $i++;
            //echo $i;
        }                
        //echo $strSummaryAry;
    } 
    catch(PDOException $e) 
    {
        $error =  "Error: " . $e->getMessage();
    }    
    $conn = null;
    if($i > 0)
    {
        //------------ Update Line Balance Data -------------------------------------------------   
        $data_ary['Date_Ary']                   = $Date_ary;
        $data_ary['MeterNumber1']    = $TotPlacedWorkOrders_ary; 
        $data_ary['MeterNumber2']    = $CompletedWorkOrders_ary; 
       
    }
    else 
    {
        $data_ary = array(0);
    }
    //print json_encode($error);
    print json_encode($data_ary); 
   // print json_encode($ProductQuantity_ary);
       
?>