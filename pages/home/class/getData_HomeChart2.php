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
    $ReturnData_ary = array();
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
            $x=1;
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            $stmt = $conn->prepare("SELECT * FROM btuevent where Unit=$x LImit 5;");
            
            //$stmt->bindParam(':wono', $strWoNumber);      
            $stmt->execute();
           // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC); 
            $result = $stmt->fetchAll();
           

            
            foreach ($result as $i => $row) {
                
                    $strAirFlow[$i]= htmlspecialchars($row['AirFlow']);
                    $strTime[$i]= htmlspecialchars($row['ServerDatetime']);
                
            }


            if($i === 0)    // No Data
            {
                $Status_ary[0] = "false";
                $Status_ary[1] = "Data not found"; 
            }
            else
            {
                $ReturnData_ary['airflow_ary'] = $strAirFlow; 
                $ReturnData_ary['Time']        = $strTime;
                


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




    if($strFuncType === "funDashboardView") //------------- funUpdateEventLog --------------------
    {
        //$strUserType         = $num[1];               
        try 
        {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            $stmt = $conn->prepare("SELECT * FROM tbl_suppermarket_wip ");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC); 
            $result = $stmt->fetchAll();
            
            $midPoint = count($result)/2;
            $strText .= "<ul class='list-inline'>";
           
           
            foreach ($result as $row) {

                $Limit_High="";
                $Limit_Low="";
                $Color_High="";
                $Color_Low="";
                $Color_Middle="";

                $color="";

                 $Linesettings = $conn->prepare("SELECT * FROM tbl_suppermarket_setting where id= ".$row['id']);
                 $Linesettings->execute();
                 $Linesettings->setFetchMode(PDO::FETCH_ASSOC); 
                 $Settingsresult = $Linesettings->fetchAll();

                 foreach ($Settingsresult as $Settingrow) {

                     $Limit_High    =  $Settingrow['Limit_High'];
                     $Limit_Low     =  $Settingrow['Limit_Low'];
                     $Color_High    =  $Settingrow['Color_High'];
                     $Color_Low     =  $Settingrow['Color_Low'];
                     $Color_Middle  =  $Settingrow['Color_Middle'];
                    
                    

                 }
                 
                 
               

                if($row['quantity']<$Limit_Low){
                    $color=$Color_Low;
                }

                else if($row['quantity']>$Limit_High){
                    $color=$Color_High;
                }

                elseif( $row['quantity']>$Limit_Low && $row['quantity']<$Limit_High){
                    $color=$Color_Middle;
                 }

                $strText .= "  <li class='list-inline-item '  >";
                $strText .= "<div class='card' id='id_card" . $row['id'] . "' style='width: 10rem; background-color: " . $color . ";'>";
                $strText .= "<div class='card-body'    >";
                $strText .= "<h2 class='card-title fw-bold text-center'>" . htmlspecialchars($row['Line']) . "</h2>";
                $strText .="<p class='card-text  text-center' >". htmlspecialchars($row['quantity']) ."</p>";
                
                $strText .="</div>";  
                $strText .="</div>";
    
                $i++;
            }

            
            if($i === 0)    // No Data
            {
                $Status_ary[0] = "false";
                $Status_ary[1] = "Data not found"; 
            }
            else
            {
                $ReturnData_ary[0] = $strText;
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
    $data_ary['Data_Ary']   = $ReturnData_ary;
        
    //print json_encode($error);
    print json_encode($data_ary); 

?>
