<?php

    session_start();
    require_once('../../initialize.php');
    require_once('../../config.php');
    
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
    $ReturnData_ary[0] = "NA";  
    if($strFuncType === "funGetUserTable") //------------- funUpdateEventLog --------------------
    {
        //$strUserType         = $num[1];               
        try 
        {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            $stmt = $conn->prepare("SELECT * FROM tblphone_numbers");
            //$stmt->bindParam(':wono', $strWoNumber);      
            $stmt->execute();
            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);        
            $result = $stmt->fetchAll();
            //$i = 1;
            foreach($result as $row)
            {             
                $strText .= "<tr>";               
                $strText .= "<td>" . $row['id'] . "</td>";
                $strText .= "<td>" . $row['contactNumber'] . "</td>";
                $strText .= "<td>" . $row["group"] . "</td>";
                $strText .= "<td>" . $row["status"] . "</td>";
                //$strText .= "<td><button class='btn btn-warning btn-sm' onclick='editUser(" . $row["ID"] . ")'>Edit</button> <button class='btn btn-danger btn-sm' onclick='deleteUser(" . $row["ID"] . ")'>Delete</button></td>";
                $strText .= "<td><button class='btn btn-warning btn-sm' onclick='editUser(" . $row["id"] . ")'>Edit</button></td>";
                $strText .= "<td><button class='btn btn-danger btn-sm' onclick='deleteUser(" . $row["id"] . ")'>Delete</button></td>";

                $strText .= "</tr>";                
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
    else if($strFuncType === "funDeleteUser") //------------- funUpdateEventLog --------------------
    {
        $strUserID         = $num[1];
        //$strUserID       = 21;  
        //$strSectionData      = $num[2];  
        //$strUserType         = "admin"; 
        //$strSectionData      = "10";        
        try 
        {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            //$stmt = $conn->prepare("SELECT * FROM tblusers_account WHERE ID=:usrid");
            $stmt = $conn->prepare("DELETE FROM tblphone_numbers WHERE ID=:usrid");   
            $stmt->bindParam(':usrid', $strUserID);      
            $stmt->execute();
            // set the resulting array to associative
            //$stmt->setFetchMode(PDO::FETCH_ASSOC);        
            //$result = $stmt->fetchAll();
            //$i = 1;            
            $affectedRows = $stmt->rowCount();
            if ($affectedRows > 0) 
            {
                // Deletion was successful
                $ReturnData_ary[0] = "NA";
                $Status_ary[0] = "true";
                $Status_ary[1] = "Delete Success"; 
            }
            else
            {
                // No matching user found for deletion
                $Status_ary[0] = "false";
                $Status_ary[1] = "Delete Not Success";
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
    else if($strFuncType === "funUpdateUser") //------------- funUpdateEventLog --------------------
    {
        $strID          = $num[1]; 
        $strEPF         = $num[2];
        $strEmpName     = $num[3];
        $strStatus    = "Active";
       
        try 
        {
            
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare("UPDATE tblphone_numbers SET contactNumber=:epf, `group`=:empname, Status=:status WHERE ID=:userid");
                $stmt->bindParam(':epf', $strEPF);
                $stmt->bindParam(':empname', $strEmpName);
                $stmt->bindParam(':status', $strStatus);
                $stmt->bindParam(':userid', $strID);
            
                       
            $stmt->execute();
            $Status_ary[0] = "true";
            $Status_ary[1] = "Update Success Eventlog"; 
        } 
        catch(PDOException $ex) 
        {
            //$error =  "Error: " . $e->getMessage();
            $Status_ary[0] = "false";
            $Status_ary[1] = 'Error Msg: ' .$ex->getMessage();        
        }    
        $conn = null;
    }
    else if($strFuncType === "funNewUser") //------------- funUpdateEventLog --------------------
    {
        //$strID          = $num[1]; 
        $strEPF         = $num[2];
        $strEmpName     = $num[3];
        $strStatus    = "Active";
       
        try 
        {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("INSERT INTO tblphone_numbers (contactNumber, `group`, Status) VALUES (:epf, :empname, :status)");
            $stmt->bindParam(':epf', $strEPF);
            $stmt->bindParam(':empname', $strEmpName);
            $stmt->bindParam(':status', $strStatus);
            //$stmt->bindParam(':userid', $strID);
            $stmt->execute();
            $Status_ary[0] = "true";
            $Status_ary[1] = "Update Success Eventlog"; 
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
