<?php
    session_start();
    $usernames = $_SESSION["user_name"];


 
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
    $ReturnData_ary2 = array();
    
    //$ReturnData_ary[0][0]  = "NA";
    $strText    = "";
    $ReturnData_ary[0] = "NA";     
    $ReturnData_ary2[0][0] = "NA";     
    $ReturnData_ary2[0][1] = "NA";
    //error_log("Your log message", 3, "/logs/file.log");
        
   
    //------------- Table data load --------------------
    if($strFuncType === "funGetLineData") 
    {
        //2024-03-13,2024-03-28,All,All,All,All,All
         $strusername       = $num[1];  
        // $strEndDate         = $num[2]; 
        // $strUnit            = $num[3];   //$num[3];       
        
        /*
        $strStartDate       = '2024-03-01'; //$num[1];  
        $strEndDate         = '2024-03-28'; //$num[2];        
        $strMcCategory      = 'All';   //$num[3];
        $strFaultType       = 'All';   // $num[4];
        $strLevel1          = 'All';   // $num[5];
        $strLevel2          = 'All';   // $num[6];
        $strLevel3          = 'All';   // $num[7];
        */

    
       
      
        try 
        {           
            $username = $_SESSION["user_name"];
            
            $sqlString = "SELECT * FROM tblusers_account WHERE UserName=:username";              
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            $stmt = $conn->prepare($sqlString);
            //$stmt->bindParam(':strusername', $strusername); 
            $stmt->bindParam(':username', $username); 
            
            $stmt->execute();
            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);        
            $result = $stmt->fetchAll();
            $i = 0;
  
            foreach($result as $row)
            {           
                $ReturnData_ary2[$i][0] = $row['EmpName'];
                $ReturnData_ary2[$i][1] = $row['Contact'];
                //$ReturnData_ary2[$i][2] = $row['Airpressure'];
                // $ReturnData_ary2[$i][3] = $row['State'];

        
                $i++;
            }  
            if($i === 0)    // No Data
            {
                $ReturnData_ary2[0][0] = $strText;
                $Status_ary[0] = "false";
                $Status_ary[1] = "Data not found"; 
            }
            else
            {
                //$ReturnData_ary2[0] = $strText;
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
        $conn = null;
    }
    //error_log("Test error log: ", 3, "/logs/server/error.log");     
   // $data_ary['Status_Ary'] = $Status_ary;
    //$data_ary['Data_Ary']   = $ReturnData_ary;
    $data_ary['Data_Ary2']  = $usernames;  

    print json_encode($data_ary); 

?>
