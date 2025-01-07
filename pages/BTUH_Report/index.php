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
        <!-- Main Sidebar Container -->
        <?php
            include '../../headers/left-sidebar.php'
        ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- /.card-header -->                    
                    <div class="card card-default" >
                        <div class="card-header">
                            <h3 class="card-title">Thermal consumption Report</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>                                
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">  
                            <div class="row">                                 
                                <div class="col-md-2">    
                                    <div class="form-group">
                                        <label>Start Date</label>
                                        <div>
                                            <input class="form-control" type="date" id="id_startdate" onchange="funLoadAllChart()" name="startDate" style="font-size: 15px;"/>
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-md-2">    
                                    <div class="form-group">
                                        <label>End Date</label>
                                        <div>
                                            <input class="form-control" type="date" id="id_enddate" onchange="funLoadAllChart()" name="endDate" style="font-size: 15px;"/>
                                        </div>
                                    </div> 
                                </div>
                                <!-- <div class="col-md-2">    
                                    <div class="form-group">
                                        <label>Start Time</label>
                                        <div>
                                            <input class="form-control" type="time" id="id_endtime" onchange="funLoadAllChart()" name="endTime" style="font-size: 15px;"/>
                                        </div>
                                    </div> 
                                </div>

                                <div class="col-md-2">    
                                    <div class="form-group">
                                        <label>End Time</label>
                                        <div>
                                            <input class="form-control" type="time" id="id_endtime" onchange="funLoadAllChart()" name="endTime" style="font-size: 15px;"/>
                                        </div>
                                    </div> 
                                </div>

                                <div class="col-md-2">                   
                                    <label style="font-weight: bolder;" >SBU</label>    
                                    <select class="form-control select2" onchange="funLoadAllChart()" id="id_Select_Status" style="width: 100%;">
                                        <option value="1">MFM</option> 
                                        <option value="2">MFI</option> 
                                        
                                    </select>
                                </div> -->
                                <div class="col-md-2"> 
                                    <div class="form-group">                                         
                                        <div class="form-group">
                                            <button type="button" class="form-control btn btn-primary mt-4" onclick="funLoadAllChart()" id="id_ViewReport" name="viewbutton">View Report</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2"> 
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                    <section class="content">
    <div class="container-fluid">                            
        <div class="row">
            <div class="col-12">
                <div class="card card-danger">  
                    <div class="card-header">
                        <h3 class="card-title"><b>Thermal Details</b></h3>                                    
                    </div> 
                </div>
                <div class="card-body" id="id_class1">
                    <table id="id_table1" class="table table-bordered table-striped display compact">
                        <thead class="bg-info">
                            <tr>
                                <th colspan="8" style="text-align: center; background-color: yellow; color: black; font-weight: bold;">
                                    Thermal Energy Consumption of MFM
                                </th>
                                <th colspan="6" style="text-align: center; background-color: red; color: White; font-weight: bold;">
                                    Thermal Energy Consumption of MFI
                                </th>
                                <th colspan="5" style="text-align: center; background-color: yellow; color: black; font-weight: bold;">
                                    Daly total energy consumption of MFM & MFI
                                </th>
                            </tr>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Day (5.30 - 18:30)Kwh</th>
                                <th>Peak (18:30 - 22:30)Kwh</th>
                                <th>Off Peak (00:00-05:30 + 22:30-23:59)Kwh</th>
                                <th style="background-color: lime; color: black;">Day %</th> 
                                <th style="background-color: lime; color: black;">Peak %</th>           
                                <th style="background-color: lime; color: black;">Off Peak %</th>
                                <th>Day (5.30am - 6.30pm)Kwh</th>
                                <th>Peak (6.30pm - 10.30pm)Kwh</th>
                                <th>Off Peak (00:00-05:30 + 22:30-23:59)Kwh</th>
                                <th style="background-color: lime; color: black;">Day %</th> 
                                <th style="background-color: lime; color: black;">Peak %</th>           
                                <th style="background-color: lime; color: black;">Off Peak %</th>
                                <th>MFM Kwh</th>
                                <th>MFI Kwh</th>
                                <th>Total MFM & MFI</th>
                                <th style="background-color: lime; color: black;">MFM %</th>
                                <th style="background-color: lime; color: black;">MFI %</th>
                                  
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
                <!-- Include Footer -->
                <?php
                    include '../../headers/footer-bar.php'
                ?> 
            </section>
        </div>    
    </div>    
 
<!-- Page specific script -->
<!-- ChartJS -->
    <script src="../../plugins/chart.js/Chart.min.js"></script>
    <script src="../../plugins/chartjs-plugin-datalabels/chartjs-plugin-datalabels.js"></script> 
<script>

    //--------------- Admin Panel Minimize ----------------------
    $('[data-widget="pushmenu"]').PushMenu("collapse");
    
    $(function () 
    {      
         //-------------- Load Datetime box ----------------------------------------
        var currentDate = new Date(); // Get the current date and time
        var currentDay = new Date(currentDate.getFullYear(), currentDate.getMonth(), currentDate.getDate()); // Get midnight of the current day
        var oneWeekAgo = new Date(currentDay.getTime() - (5 * 24 * 60 * 60 * 1000)); // Calculate 7 days (1 week) ago from midnight of the current day
        var oneDayAfter = new Date(currentDay.getTime()); // Calculate 1 day after midnight of the current day

        document.getElementById('id_startdate').valueAsDate = oneWeekAgo; // Set the value of the input element to 7 days ago
        document.getElementById('id_enddate').valueAsDate = oneDayAfter; // Set the value of the input element to 1 day after
        
     
    
        $('#id_table1').DataTable({ 
            scrollX: true, // Enable horizontal scroll
            scrollY: "400px", // Set vertical scroll height
            scrollCollapse: true, // Collapse table height when less than scrollY
            paging: true, // Enable paging
            pageLength: 10, // Set the number of rows per page
            dom: 'Bfrtip',
            buttons: [
                { extend: 'copyHtml5', footer: true },
                { extend: 'excelHtml5', footer: true },
                { extend: 'csvHtml5', footer: true },
                { extend: 'pdfHtml5', footer: true },
                { extend: 'print', footer: true }
            ],
            createdRow: function (row, data, dataIndex) {
                // Apply inline styles to the specific columns
                $(row).find('td:eq(5)').css({
                    'background-color': '#99E699',
                    'color': 'black'
                });
                $(row).find('td:eq(6)').css({
                    'background-color': '#99E699',
                    'color': 'black'
                });
                $(row).find('td:eq(7)').css({
                    'background-color': '#99E699',
                    'color': 'black'
                });
                $(row).find('td:eq(11)').css({
                    'background-color': '#99E699',
                    'color': 'black'
                });
                $(row).find('td:eq(12)').css({
                    'background-color': '#99E699',
                    'color': 'black'
                });
                $(row).find('td:eq(13)').css({
                    'background-color': '#99E699',
                    'color': 'black'
                });
                $(row).find('td:eq(17)').css({
                    'background-color': '#99E699',
                    'color': 'black'
                });
                $(row).find('td:eq(18)').css({
                    'background-color': '#99E699',
                    'color': 'black'
                });
            }
        });

    funLoadAllChart();
        
    });

    //-------------------- ViewReport Function --------------------------------------------
    
    //-------------------- ViewReport Function --------------------------------------------
    function funLoadTable() 
    { 
        let intDebugEnable = 0;
        if(intDebugEnable === 1) alert("funLoadTable");
        const DataAry = []; 
        //--------------TABLE ------------------------------
        DataAry[0] = "funGetData_Table";        // Table Name
        DataAry[1] = document.getElementById("id_startdate").value;
        DataAry[2] = document.getElementById("id_enddate").value;
       
        if(intDebugEnable === 1) alert("DataAry :" + DataAry);
        $.post('getData_BTUH.php', { userpara: DataAry }, function(json_data2) 
        {
            if(intDebugEnable === 1) alert("json_data2 :" + json_data2);           
            var res = $.parseJSON(json_data2);                 
            if(res.Status_Ary[0] === "true")   // No data found, insert new record
            {
                if(intDebugEnable === 1) alert("data available");
                var dtbl2 = $('#id_table1').DataTable();
                dtbl2.clear().draw();
                intRowCount = res.Data_Ary.length;
                if(intDebugEnable === 1) alert("intRowCount :" + intRowCount);
                let intTmp = 0;
                for(i=0;i<intRowCount;i++)
                {
                    intTmp = i + 1;

                    
                    let mfm = parseFloat(res.Data_Ary[i][1]) + parseFloat(res.Data_Ary[i][2]) + parseFloat(res.Data_Ary[i][3]);
                    let mfi = parseFloat(res.Data_Ary[i][4]) + parseFloat(res.Data_Ary[i][5]) + parseFloat(res.Data_Ary[i][6]);
                    let percentageMFM = (mfm + mfi > 0) ? Math.round((mfm / (mfm + mfi)) * 100) + " %" : "0 %";
                    let percentageMFI = (mfm + mfi > 0) ? Math.round((mfi / (mfm + mfi)) * 100) + " %" : "0 %";


                    dtbl2.row.add([
                        intTmp.toString(), 
                        res.Data_Ary[i][0], 
                        res.Data_Ary[i][1], 
                        res.Data_Ary[i][2], 
                        res.Data_Ary[i][3], 
                        '<td style="background-color: #99E699; color: black;">' + 
                            (
                                (parseFloat(res.Data_Ary[i][1]) + parseFloat(res.Data_Ary[i][4])) !== 0 ? 
                                Math.round((parseFloat(res.Data_Ary[i][1]) / (parseFloat(res.Data_Ary[i][1]) + parseFloat(res.Data_Ary[i][4]))) * 100) : 
                                0
                            ) + " %" +
                        '</td>',
                        '<td style="background-color: #99E699; color: black;">' + 
                            (
                                (parseFloat(res.Data_Ary[i][2]) + parseFloat(res.Data_Ary[i][5])) !== 0 ? 
                                Math.round((parseFloat(res.Data_Ary[i][2]) / (parseFloat(res.Data_Ary[i][2]) + parseFloat(res.Data_Ary[i][5]))) * 100) : 
                                0
                            ) + " %" + 
                        '</td>',
                        '<td style="background-color: #99E699; color: black;">' + 
                            (
                                (parseFloat(res.Data_Ary[i][3]) + parseFloat(res.Data_Ary[i][6])) !== 0 ? 
                                Math.round((parseFloat(res.Data_Ary[i][3]) / (parseFloat(res.Data_Ary[i][3]) + parseFloat(res.Data_Ary[i][6]))) * 100) : 
                                0
                            ) +  " %" +
                        '</td>',

                        res.Data_Ary[i][4],
                        res.Data_Ary[i][5],
                        res.Data_Ary[i][6],
                        '<td style="background-color: 99E699; color: black;">' + 
                            (
                                (parseFloat(res.Data_Ary[i][1]) + parseFloat(res.Data_Ary[i][4])) !== 0 ? 
                                Math.round((parseFloat(res.Data_Ary[i][4]) / (parseFloat(res.Data_Ary[i][1]) + parseFloat(res.Data_Ary[i][4]))) * 100) : 
                                0
                            ) +  " %" +
                        '</td>',
                        '<td style="background-color: 99E699; color: black;">' + 
                            (
                                (parseFloat(res.Data_Ary[i][2]) + parseFloat(res.Data_Ary[i][5])) !== 0 ? 
                                Math.round((parseFloat(res.Data_Ary[i][5]) / (parseFloat(res.Data_Ary[i][2]) + parseFloat(res.Data_Ary[i][5]))) * 100) : 
                                0
                            ) +  " %" +
                        '</td>',
                        '<td style="background-color: 99E699; color: black;">' + 
                            (
                                (parseFloat(res.Data_Ary[i][3]) + parseFloat(res.Data_Ary[i][6])) !== 0 ? 
                                Math.round((parseFloat(res.Data_Ary[i][6]) / (parseFloat(res.Data_Ary[i][3]) + parseFloat(res.Data_Ary[i][6]))) * 100) : 
                                0
                            ) +  " %" +
                        '</td>',

                        mfm ,
                        mfi ,
                        mfm + mfi ,
                        percentageMFM,
                        percentageMFI

                    ]).draw(false);
                } 
            }
            else if(res.Status_Ary[0] === "false") 
            {
                var dtbl2 = $('#id_table1').DataTable();
                dtbl2.clear().draw();
                if(intDebugEnable === 1) alert("data not available"); 
            }
            else
            {
                var dtbl2 = $('#id_table1').DataTable();
                dtbl2.clear().draw();
                if(intDebugEnable === 1) alert("Error"); 
            }
        });        
    }

    function funLoadAllChart() 
    {
        let intDebugEnable = 0;        
        if(intDebugEnable === 1) alert("funLoadAllChart");
        funLoadTable();
    }    
</script>
</body>
</html>
