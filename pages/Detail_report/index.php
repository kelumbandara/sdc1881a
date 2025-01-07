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
                                    <label style="font-weight: bolder;" >Factory</label>    
                                    <select class="form-control select2" onchange="funLoadTable()" id="id_Select_Factory" style="width: 100%;">
                                        <option value="All">MFI & MFM</option> 
                                        <option value="2">MFI</option> 
                                        <option value="1">MFM</option> 
                                        
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
                                                    <th>Meter No</th>
                                                    <th>ThermalEnergyUnit</th>
                                                    <th>ChilledWaterFlow</th>
                                                    <th>ChilledWaterSupplyTemp</th> 
                                                    <th>ChilledWaterReturnTemp</th> 
                                                    <th>ENET</th>                                                    
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
            </section>
        </div> 
        <!-- Include Footer -->
        <?php
            include '../../headers/footer-bar.php'
        ?> 
</div>    
 
<!-- Page specific script -->
<script>
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
        DataAry[3] = document.getElementById("id_Select_Factory").value;

        if(intDebugEnable === 1) alert("DataAry :" + DataAry);
        $.post('getData_Detail_Report.php', { userpara: DataAry }, function(json_data2) 
        {
            if(intDebugEnable === 1) alert("json_data2 :" + json_data2);           
            var res = $.parseJSON(json_data2);

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
                        res.Data_Ary2[i][3], 
                        res.Data_Ary2[i][4],
                        res.Data_Ary2[i][5],
                        res.Data_Ary2[i][6],
                        res.Data_Ary2[i][7],

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
</body>
</html>
