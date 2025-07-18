<?php
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION["user_name"]))
    {
        // If not logged in, redirect to the login page
        header("Location: index.php");
        exit();
    }
    // Display the authenticated user's information
    $username = $_SESSION["user_name"];

?>
<?php
    include_once'../../headers/header.php';
    //include_once'../../dbconnection/dbConnection.php';
?> 
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="../../myimg/favicon-16x16.png" alt="Sky Logo" height="60" width="60">
        </div>
        <!-- Navbar -->
        <?php
            include '../../headers/top-menu.php'
        ?>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <?php
             include '../../headers/left-sidebar.php'
        ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid  "> 
                    <div class="card card-default" >
                        <div class="card-header">
                            <h2 class="card-title text-warning"><strong>Details Report</strong></h2>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>                                
                            </div>
                        </div>                        
                         
                        <div class="row col-12"> 
                            <div class="col-md-2"> 
                                <label style="font-weight: bolder;">Date Start:</label>
                                <div>
                                    <input class="form-control" onchange="funLoadTable()" type="date" id="id_sdate" value="22-07-2018" />
                                </div>
                            </div>
                            <div class="col-md-2"> 
                                <label style="font-weight: bolder;">End Start:</label>
                                <div>
                                    <input class="form-control" onchange="funLoadTable()" type="date" id="id_edate" value="22-07-2018" />
                                </div>
                            </div>
                            <div class="col-md-2">                   
                                    <label style="font-weight: bolder;" >Unit</label>    
                                    <select class="form-control select2" onchange="funLoadTable()" id="id_Select_Unit" style="width: 100%;">
                                        <option value="Luwa_1A_Start">Luwa 1A Start</option> 
                                        <option value="Luwa_1A_End">Luwa 1A End</option>
                                        <option value="Luwa_1B_Start">Luwa 1B Start </option> 
                                        <option value="Luwa_1B_End">Luwa 1B End</option>
                                        <option value="Luwa_2A_Start">Luwa 2A Start</option> 
                                        <option value="Luwa_2A_End">Luwa 2A End</option>
                                        <option value="Luwa_2B_Start">Luwa 2B Start</option> 
                                        <option value="Luwa_2B_End">Luwa 2B End</option>
                                        <option value="Luwa_3A_Start">Luwa 3A Start</option> 
                                        <option value="Luwa_3A_End">Luwa 3A End</option>
                                        <option value="Luwa_3B_Start">Luwa 3B Start</option> 
                                        <option value="Luwa_3B_End">Luwa 3B End</option>
                                        <option value="Luwa_4A_Start">Luwa 4A Start</option> 
                                        <option value="Luwa_4A_End">Luwa 4A End</option>
                                        <option value="Luwa_4B_Start">Luwa 4B Start</option> 
                                        <option value="Luwa_4B_End">Luwa 4B End</option>
                                        <option value="Luwa_5A_Start">Luwa 5A Start</option> 
                                        <option value="Luwa_5A_End">Luwa 5A End</option>
                                        <option value="Luwa_5B_Start">Luwa 5B Start</option> 
                                        <option value="Luwa_5B_End">Luwa 5B End</option>
                                        <option value="Luwa_6A_Start">Luwa 6A Start</option> 
                                        <option value="Luwa_6A_End">Luwa 6A End</option>
                                        <option value="Luwa_6B_Start">Luwa 6B Start</option> 
                                        <option value="Luwa_6B_End">Luwa 6B End</option>
                                        <option value="Luwa_7A_Start">Luwa 7A Start</option> 
                                        <option value="Luwa_7A_End">Luwa 7A End</option>
                                        <option value="Luwa_7B_Start">Luwa 7B Start</option> 
                                        <option value="Luwa_7B_End">Luwa 7B End</option>
                                        <option value="Luwa_8A_Start">Luwa 8A Start</option> 
                                        <option value="Luwa_8A_End">Luwa 8A End</option>
                                        <option value="Luwa_8B_Start">Luwa 8B Start</option> 
                                        <option value="Luwa_8B_End">Luwa 8B End</option>
                                       
                                         
                                        
                                    </select>
                                </div>
                            <div class="col-md-2">                              
                                <div class="mt-4">
                                    <button class="form-control btn btn-primary" type="button" class="btn btn-primary" onclick="funLoadTable()" id="id_ViewReport" name="viewbutton">View Report</button>
                                </div>
                            </div>   
                        </div>
                        <br>
                    </div>                    
                    <!-- /.card -->
                  
                    <section class="content">
                        <div class="container-fluid">                            
                            <div class="row">
                                <div class="col-12">
                                    <div class="card card-danger">  
                                        <div class="card-header">
                                            <h3 class="card-title"><b>Energy Details</b></h3>                                    
                                        </div> 
                                    </div>
                                    <div class="card-body" id="id_class1">
                                        <table id="id_table1" class="table table-bordered table-striped display compact">
                                            <thead class="bg-info">
                                                <tr>
                                                    <th>#</th>
                                                    <th>ServerDateTime</th>
                                                    <th>Unit</th>
                                                    <th>Airflow</th>
                                                    <!-- <th>State</th> -->
                                                  
                                                              
                                                </tr>
                                            </thead>
                                            <tbody>                                            
                                            </tbody>
                                        </table>	
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>              

   
         

<!-- Page specific script -->
<script>

//Today 
// document.addEventListener("DOMContentLoaded", function() {
//         let today = new Date().toISOString().split('T')[0];
//         document.getElementById('id_sdate').value = today;
//         document.getElementById('id_edate').value = today;
//     });

function toDateInputValue(dateObject){
    const local = new Date(dateObject);
    local.setMinutes(dateObject.getMinutes() - dateObject.getTimezoneOffset());
    return local.toJSON().slice(0,10);
};

document.getElementById('id_sdate').value = toDateInputValue(new Date());
document.getElementById('id_edate').value = toDateInputValue(new Date());

  

    //--------------- Admin Panel Minimize ----------------------
    $('[data-widget="pushmenu"]').PushMenu("collapse");
    
    $('#id_table1').DataTable({
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": true,
    "dom": 'Bfrtip',
    "pageLength": 20,
    "buttons": [
               { extend: 'copyHtml5', footer: true },
               { extend: 'excelHtml5', footer: true },
               { extend: 'csvHtml5', footer: true },
               { extend: 'pdfHtml5', footer: true },
               { extend: 'print', footer: true }
           ]
});
    
    $(function () 
    {
        document.getElementById('id_sdate').valueAsDate = new Date(Date.now() - (3600 * 1000 ));
        document.getElementById('id_edate').valueAsDate = new Date(Date.now() + ( 3600 * 1000 ));        
        funLoadTable();  
    });

    //-------------------- Load Datatable Function --------------------------------------------
    function funLoadTable() 
    { 
        let intDebugEnable = 0;
        if(intDebugEnable === 1) alert("funLoadTable");
        const DataAry = []; 
        //--------------TABLE ------------------------------
        DataAry[0] = "funGetData_Table";        // Table Name
        DataAry[1] = document.getElementById("id_sdate").value;
        DataAry[2] = document.getElementById("id_edate").value;
        DataAry[3] = document.getElementById("id_Select_Unit").value;
        

        if(intDebugEnable === 1) alert("DataAry :" + DataAry);
        $.post('getData_Detail_Report.php', { userpara: DataAry }, function(json_data2) 
        {
            
            if(intDebugEnable === 1) alert("json_data2 :" + json_data2);           
            var res = $.parseJSON(json_data2);
           // alert(json_data2);

            var dtbl2 = $('#id_table1').DataTable();
            dtbl2.clear().draw();

            if(res.Status_Ary[0] === "true") 
            { // Data available
                if(intDebugEnable === 1) alert("data available");
                let intRowCount = res.Data_Ary2.length;
                if(intDebugEnable === 1) alert("intRowCount :" + intRowCount);
                let intTmp = 0;
                for(let i = 0; i < intRowCount; i++) 
                {
                    intTmp = i + 1;
                    dtbl2.row.add([
                        intTmp.toString(), 
                        res.Data_Ary2[i][0], 
                        res.Data_Ary2[i][1], 
                        res.Data_Ary2[i][2],
                        // res.Data_Ary2[i][3],
                    ]).draw(false);
                }
            } else if(res.Status_Ary[0] === "false") { // No data available
                if(intDebugEnable === 1) alert("data not available"); 
            } else {
                if(intDebugEnable === 1) alert("Error"); 
            }
        });
    }

</script>

        <!-- Include Footer -->
        
        </div> 



        <?php
                include '../../headers/footer-bar.php'
            ?> 
    </section>
        </div>  
        
</body>
</html>
