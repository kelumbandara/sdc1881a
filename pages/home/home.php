<!--<?php
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
    //$all_section   = $_SESSION["user_roll_sections"];
    $roll_areas     = $_SESSION["user_roll_areas"];
    $roll_other     = $_SESSION["user_roll_other"];
?>-->

<?php
    require_once('../../headers/header.php');
?>
<body class="hold-transition sidebar-mini layout-fixed dark-mode">   
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
            <div class="container-fluid">
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="text-center" style="display: flex; align-items: center; justify-content: center; color: #f5e342; padding: 10px; border-radius: 8px;">
                        <h1 style="margin: 0; padding-right: 10px;">
                            HVAC Performance Monitoring System of MFM & MFI
                        </h1>                        
                    </div>
                <div class="row my-1" id="id_homeDetails">
                <div class="col-md-3">
                    <div class="card" style="height: 225px; width: 100%;"> <!-- Set fixed height and width -->
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <!-- <p class="text-center"><strong>Work Order Details</strong></p> -->
                            <p class="text-center"><strong>MFM kW</strong></p>
                            <div class="js-gauge js-gauge--1 gauge"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card" style="height: 225px; width: 100%;">
                        <div class="card-body" style="font-size: 17px; font-weight: bold;">
                            <p class="text-center py-1 border-bottom"><strong>MFM Real Time Data</strong></p>
                            <div class="d-flex justify-content-between py-1 border-bottom">
                                <span style="width: 55%;">Thermal energy</span>
                                <span id="id_MFM_Thermal_energy_unit" style="width: 45%;">: -</span>
                            </div>
                            <div class="d-flex justify-content-between py-1 border-bottom">
                                <span style="width: 55%;">CH Water Flow</span>
                                <span id="id_MFM_Child_Water_Flow" style="width: 45%;">: -</span>
                            </div>
                            <div class="d-flex justify-content-between  py-1 border-bottom">
                                <span style="width: 60%;">CH Water Sup Temp</span>
                                  <span id="id_MFM_Child_Water_return_Temp" style="width: 40%;">: -</span>
                            </div>
                            <div class="d-flex justify-content-between  py-1 border-bottom">
                                <span style="width: 60%;">CH Water Ret Temp</span>
				<span id="id_MFM_Child_Water_Supply_Temp" style="width: 40%;">: -</span>
                              
                            </div>
                        </div>
                    </div>                        
                </div>
                <div class="col-md-3">
                    <div class="card" style="height: 225px; width: 100%;"> <!-- Set fixed height and width -->
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <!-- <p class="text-center"><strong>Work Order Details</strong></p> -->
                            <p class="text-center"><strong>MFI kW</strong></p>
                            <div class="js-gauge js-gauge--2 gauge"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">                        
                    <div class="card" style="height: 225px; width: 100%;">
                        <div class="card-body" style="font-size: 17px; font-weight: bold;">
                            <p class="text-center py-1 border-bottom"><strong>MFI Real Time Data</strong></p>
                            <div class="d-flex justify-content-between py-1 border-bottom">
                                <span style="width: 55%;">Thermal energy</span>
                                <span id="id_MFI_Thermal_energy_unit" style="width: 45%;">: -</span>
                            </div>
                            <div class="d-flex justify-content-between py-1 border-bottom">
                                <span style="width: 55%;">CH Water Flow</span>
                                <span id="id_MFI_Child_Water_Flow" style="width: 45%;">: -</span>
                            </div>
                            <div class="d-flex justify-content-between  py-1 border-bottom">
                                <span style="width: 60%;">CH Water Sup Temp</span>
                                 <span id="id_MFI_Child_Water_return_Temp" style="width: 40%;">: -</span>
                            </div>
                            <div class="d-flex justify-content-between  py-1 border-bottom">
                                <span style="width: 60%;">CH Water Ret Temp</span>
				<span id="id_MFI_Child_Water_Supply_Temp" style="width: 40%;">: -</span>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-success" style="height: 380px; width: 100%;">
                            <h6 class="text-center">MFM & MFI Cooling Load</h6>
                            <div class="card-body" id="Id_DivBarChart_1"></div>
                        </div>
                    </div>
                    <div class="col-md-2">                            
                       <div class="card card-success card-body d-flex flex-column justify-content-center align-items-center" style="height: 380px; width: 100%;">
                            <div class="text-center" style="font-size: 32px; font-weight: bold;">Total kW</div>
                            <div id="id_Home_units" class="text-center mt-3" style="font-size: 40px; font-weight: bold;">- -</div>

                            <div class="text-center text-warning mt-5" style="font-size: 12px; font-weight: bold;">Last Updated Time MFM</div>
                            <div id="id_Home_LstUpDateTime_MFM" class="text-center text-warning" style="font-size: 12px; font-weight: bold;">- -</div>

                            <div class="text-center text-warning mt-3" style="font-size: 12px; font-weight: bold;">Last Updated Time MFI</div>
                            <div id="id_Home_LstUpDateTime_MFI" class="text-center text-warning" style="font-size: 12px; font-weight: bold;">- -</div>
                        </div>                           
                    </div> 
                    <div class="col-md-4">    
                        <div class="card" style="height: 380px; width: 100%;">
                            <div class="card-header" style="padding-top: 3px; padding-bottom: 3px; line-height: 1.2;">
                                <center>Chiller Operations</center>
                            </div>
                            <div class="card-header" style="background-color: #707070 ; padding-top: 3px; padding-bottom: 3px; line-height: 1.2;"><center>CHILLERS</center>
                                <table style="width: 80%; margin: 0 auto;">
                                    <tr>
                                        <td style=" font-size: 20px; font-weight: bold;">
                                           <div class="small-box mx-2">
                                                <div style="background-color: red; width:60px; height: 40px; border-radius: 10px; border: 1px solid black; display: flex; justify-content: center; align-items: center; color: black;">                                                    
                                                    <center><h6>OFF</h6></center>
                                                </div>
                                            </div>
                                        </td>
                                        <td style=" font-size: 20px; font-weight: bold;">
                                           <div class="small-box mx-2">
                                                <div style="background-color: red; width:60px; height: 40px; border-radius: 10px; border: 1px solid black; display: flex; justify-content: center; align-items: center; color: black;">                                                    
                                                    <center><h6>OFF</h6></center>
                                                </div>
                                            </div>
                                        </td>
                                        <td style=" font-size: 20px; font-weight: bold;">
                                           <div class="small-box mx-2">
                                                <div style="background-color: red; width:60px; height: 40px; border-radius: 10px; border: 1px solid black; display: flex; justify-content: center; align-items: center; color: black;">                                                    
                                                    <center><h6>OFF</h6></center>
                                                </div>
                                            </div>
                                        </td>
                                        <td style=" font-size: 20px; font-weight: bold;">
                                           <div class="small-box mx-2">
                                                <div style="background-color: red; width:60px; height: 40px; border-radius: 10px; border: 1px solid black; display: flex; justify-content: center; align-items: center; color: black;">                                                    
                                                    <center><h6>OFF</h6></center>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="card-header" style="padding-top: 3px; padding-bottom: 3px; line-height: 1.2;"><center>CHILLER PUMP</center>
                                <table style="width: 80%; margin: 0 auto;">
                                    <tr>
                                        <td style=" font-size: 20px; font-weight: bold;">
                                           <div class="small-box mx-2">
                                                <div style="background-color: red; width:60px; height: 40px; border-radius: 10px; border: 1px solid black; display: flex; justify-content: center; align-items: center; color: black;">                                                    
                                                    <center><h6>OFF</h6></center>
                                                </div>
                                            </div>
                                        </td>
                                        <td style=" font-size: 20px; font-weight: bold;">
                                           <div class="small-box mx-2">
                                                <div style="background-color: red; width:60px; height: 40px; border-radius: 10px; border: 1px solid black; display: flex; justify-content: center; align-items: center; color: black;">                                                    
                                                    <center><h6>OFF</h6></center>
                                                </div>
                                            </div>
                                        </td>
                                        <td style=" font-size: 20px; font-weight: bold;">
                                           <div class="small-box mx-2">
                                                <div style="background-color: red; width:60px; height: 40px; border-radius: 10px; border: 1px solid black; display: flex; justify-content: center; align-items: center; color: black;">                                                    
                                                    <center><h6>OFF</h6></center>
                                                </div>
                                            </div>
                                        </td>
                                        <td style=" font-size: 20px; font-weight: bold;">
                                           <div class="small-box mx-2">
                                                <div style="background-color: red; width:60px; height: 40px; border-radius: 10px; border: 1px solid black; display: flex; justify-content: center; align-items: center; color: black;">                                                    
                                                    <center><h6>OFF</h6></center>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="card-header" style="background-color: #707070 ; padding-top: 3px; padding-bottom: 3px; line-height: 1.2;"><center>CILLER OUTER PUMP</center>
                                <table style="width: 80%; margin: 0 auto;">
                                    <tr>
                                        <td style=" font-size: 20px; font-weight: bold;">
                                           <div class="small-box mx-2">
                                                <div style="background-color: red; width:60px; height: 40px; border-radius: 10px; border: 1px solid black; display: flex; justify-content: center; align-items: center; color: black;">                                                    
                                                    <center><h6>OFF</h6></center>
                                                </div>
                                            </div>
                                        </td>
                                        <td style=" font-size: 20px; font-weight: bold;">
                                           <div class="small-box mx-2">
                                                <div style="background-color: red; width:60px; height: 40px; border-radius: 10px; border: 1px solid black; display: flex; justify-content: center; align-items: center; color: black;">                                                    
                                                    <center><h6>OFF</h6></center>
                                                </div>
                                            </div>
                                        </td>
                                        <td style=" font-size: 20px; font-weight: bold;">
                                           <div class="small-box mx-2">
                                                <div style="background-color: red; width:60px; height: 40px; border-radius: 10px; border: 1px solid black; display: flex; justify-content: center; align-items: center; color: black;">                                                    
                                                    <center><h6>OFF</h6></center>
                                                </div>
                                            </div>
                                        </td>
                                        <td style=" font-size: 20px; font-weight: bold;">
                                           <div class="small-box mx-2">
                                                <div style="background-color: red; width:60px; height: 40px; border-radius: 10px; border: 1px solid black; display: flex; justify-content: center; align-items: center; color: black;">                                                    
                                                    <center><h6>OFF</h6></center>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="card-header" style="padding-top: 3px; padding-bottom: 3px; line-height: 1.2;"><center>COOLING TOWER</center>
                                <table style="width: 80%; margin: 0 auto;">
                                    <tr>
                                        <td style=" font-size: 20px; font-weight: bold;">
                                           <div class="small-box mx-2">
                                                <div style="background-color: red; width:60px; height: 40px; border-radius: 10px; border: 1px solid black; display: flex; justify-content: center; align-items: center; color: black;">                                                    
                                                    <center><h6>OFF</h6></center>
                                                </div>
                                            </div>
                                        </td>
                                        <td style=" font-size: 20px; font-weight: bold;">
                                           <div class="small-box mx-2">
                                                <div style="background-color: red; width:60px; height: 40px; border-radius: 10px; border: 1px solid black; display: flex; justify-content: center; align-items: center; color: black;">                                                    
                                                    <center><h6>OFF</h6></center>
                                                </div>
                                            </div>
                                        </td>
                                        <td style=" font-size: 20px; font-weight: bold;">
                                           <div class="small-box mx-2">
                                                <div style="background-color: red; width:60px; height: 40px; border-radius: 10px; border: 1px solid black; display: flex; justify-content: center; align-items: center; color: black;">                                                    
                                                    <center><h6>OFF</h6></center>
                                                </div>
                                            </div>
                                        </td>
                                        <td style=" font-size: 20px; font-weight: bold;">
                                           <div class="small-box mx-2">
                                                <div style="background-color: red; width:60px; height: 40px; border-radius: 10px; border: 1px solid black; display: flex; justify-content: center; align-items: center; color: black;">                                                    
                                                    <center><h6>OFF</h6></center>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>                                                    
                    </div> 
                </div>
            </div>
        </section>
    </div>
    <?php
        include '../../headers/footer-bar.php'
    ?> 
</div>    
 
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
    "buttons": [
               { extend: 'copyHtml5', footer: true },
               { extend: 'excelHtml5', footer: true },
               { extend: 'csvHtml5', footer: true },
               { extend: 'pdfHtml5', footer: true },
               { extend: 'print', footer: true }
           ]
});
    var i;
    var j;
    
    var dtbl1;
    var dtbl2;
    var dtbl3;
    var strReceiptNo    = "0";
    //var intDebugEnable  = "1";
    
    //------------- PHP Session Variable to JS variables ---------------------     
    var SESSION_CurrentUserName     = "<?php echo htmlspecialchars($_SESSION["user_name"]); ?>";
    var SESSION_CurrentUserEPF      = "<?php echo htmlspecialchars($_SESSION["user_epf"]); ?>";
    var SESSION_CurrentUserContact      = "<?php echo htmlspecialchars($_SESSION["user_contactno"]); ?>";
    var SESSION_CurrentUserDepartment   = "<?php echo htmlspecialchars($_SESSION["user_department"]); ?>";      
    var SESSION_CurrentUserType   = "<?php echo htmlspecialchars($_SESSION["user_type"]); ?>";
          
          
    var roll_areas_ary      = <?php echo json_encode($roll_areas); ?>;
    var roll_other_ary      = <?php echo json_encode($roll_other); ?>;
           
    var strNextModelID = "NA";
    //alert(roll_areas_ary);
    //alert(roll_other_ary);
    
    $('.js-gauge--1').kumaGauge({
            value : Math.floor((Math.random() * 599) + 1),
            max: 1200
        });
	
    function updateKnobValue(newValue)
    {
        $('.js-gauge--1').kumaGauge('update', {	value : newValue});
    }
    //----------------- Second Gage --------------------------------------------------
    $('.js-gauge--2').kumaGauge({
		value : Math.floor((Math.random() * 800) + 1),
		max: 1200
	});
    function updateKnobValue2(newValue)
    {
        $('.js-gauge--2').kumaGauge('update', {	value : newValue});
    }
    //alert("Start Code.- 2");
    $(function () 
    {        
        //alert("Start Code..");
        // Start automatic scrolling Andon Dashboard 
        //autoScroll();  
        //Date and time picker
        //$('#ModOtherProjectCre_dtmDateTime').datetimepicker({
        //    format: 'YYYY-MM-DD HH:mm:ss',
        //    icons: { time: 'far fa-clock' } 
        //});
        //------------ Hide home Details, When MC Login -----------------------
        
        //alert("Start Code.- 3");
        //
        //----------------------------------------------------------------------
        //Initialize Select2 Elements
        //$('.select2').select2({ closeOnSelect: true});
        //Initialize Select2 Elements
        //$('.select2bs4').select2({
        //  theme: 'bootstrap4', closeOnSelect: true
        //});  
        //alert("Start Code.- 4");
        //------------ Home DataTable Initialize -------------------
        let intTableHeight = 160;
        if(roll_other_ary.includes("90012")){intTableHeight = 400;}

        //--- Load Tables --------------------------------------            
               
        fun_MFM_RealTimeData();
        fun_MFI_RealTimeData();
        funRefresh_Chart();
        //alert("Hooi");
    }); 
    
    
    
    // Function to automatically scroll the dashboard container
    function autoScroll() 
    {
        if (cardContainer.scrollWidth > cardContainer.clientWidth) 
        {
            const cardWidth = 150; // Adjust as needed
            const totalWidth = cardContainer.scrollWidth;
            const remainingWidth = totalWidth - cardContainer.scrollLeft - cardContainer.clientWidth;  
            if (remainingWidth > 0) 
            {
                cardContainer.scrollLeft += 1; // Adjust scrolling direction and speed as needed
                setTimeout(autoScroll, scrollSpeed); // Repeat the scrolling process
            }
            else 
            {
                // Reset scroll position to the beginning to create continuous scrolling effect
                cardContainer.scrollLeft = 0;
                setTimeout(autoScroll, 1000); // Wait for 1 second before restarting scrolling
            }
        }
        else 
        {
            // No scrolling needed, wait for 1 second before checking again
            setTimeout(autoScroll, 1000);
        }
    }
    //$('#button').click(function () 
    //{
    //    var table = $('#example1').DataTable();
    //    alert(table.rows('.selected').data().length + ' row(s) selected');
    //});
    // Update the count down every 1 second
    var x = setInterval(function() 
    {
        //alert("Timer running..");
        //-------------- Show Time -------------------------------------------------
        //var today = new Date();
        //var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
        //var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
        //document.getElementById("id_datetime").innerHTML = date+' '+time;
        //--------------- Update Data ----------------------------------------------
        //------------ Refresh Home Page Parts ----------------------
        
                fun_MFM_RealTimeData();
            
                //alert("Location : 9001314"); 
                fun_MFI_RealTimeData();
            
                //alert("Location : 9001315"); 
                funRefresh_Chart();
              
    }, 60000); 
    
    //function showAlert(button)
    //{
    //    alert("Test");
    //}
     //-------------------- Refresh Home Chart -------------------
     function funRefresh_Chart() 
     {
        let intDebugEnable = 0;        
        if(intDebugEnable === 1)    alert("funRefresh_Chart");
        //-------------- Update Home page Chart ---------------------------------------------
        var vblSendPara =  "1234"; 
        $.post('class/getData_HomeChart.php', { userpara: vblSendPara }, function(json_data2) 
        {
            if(intDebugEnable === 1)    alert("json_data2 : " +json_data2);           
            var res = $.parseJSON(json_data2);        
            //const varDate = ["08/12/2023", "09/12/2023", "10/12/2023","12/12/2023", "14/12/2023", "16/12/2023","17/12/2023", "19/12/2023", "20/12/2023"];
            //const varWoCount = [10,18,11,20,23,19,16,21,11];  

            var varDate = new Array();
            var varWoCount = new Array();

            varDate = res.Date_Ary;          
            varWoCount = res.TotPlacedWorkOrders_Ary;              
            //-------------------------------------------------------------
            //- BAR CHART:1 - Line Wise Downtime Summary  
            //-------------------------------------------------------------     
            document.getElementById("Id_DivBarChart_1").innerHTML = '&nbsp;';
            document.getElementById("Id_DivBarChart_1").innerHTML = '<canvas id="id_barChart_1" style="height: 280px; max-width: 120%;"></canvas>';
            var barChartCanvas = document.getElementById('id_barChart_1').getContext('2d');

            var barChart1_Data = {
                labels: res.Date_Ary,
                datasets: [
                    {
                        label: 'MFM',                        
                        borderColor: '#008080',             // Teal line color
                        pointBackgroundColor: '#008080',    // Matching teal for data points
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        //borderColor: 'rgba(60,141,188,0.8)',
                        pointRadius: false,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: res.MeterNumber1,
                        fill: false // Disable fill to show only the line
                    }, 
                    {
                        label: 'MFI',
                        borderColor: '#DAA520',             // Goldenrod line color
                        pointBackgroundColor: '#DAA520',    // Matching goldenrod for data points
                        backgroundColor: 'rgba(210, 44, 44, 0.9)',
                        //borderColor: 'rgba(210, 44, 44, 0.8)',
                        pointRadius: false,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(210, 44, 44, 1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(210, 44, 44, 1)',
                        data: res.MeterNumber2,
                        fill: false // Disable fill to show only the line
                    }
                ]    
            };

            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false,
                chartArea: { backgroundColor: 'rgba(255, 0, 0, 0.1)' }, // Change the background color of the chart area
                scales: {
                    yAxes: [{
                        ticks: {
                            fontSize: 8, // Adjust the font size for y-axis ticks
                            fontColor: 'white' // Change the font color for y-axis ticks to white
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            fontSize: 8, // Adjust the font size for x-axis ticks
                            fontColor: 'white' // Change the font color for x-axis ticks to white
                        }
                    }]
                }    
            };

            new Chart(barChartCanvas, {
                type: 'line',
                data: barChart1_Data,
                options: barChartOptions
            });
        });
    }

    //-------------------- Refresh Home Downtime Summary -----------------
    function fun_MFM_RealTimeData() 
    {
        let intDebugEnable = 0;        
        if(intDebugEnable === 1)    alert("fun_MFM_RealTimeData");
        //alert("Refresh Downtime Summary");
        //var formattedTime; 
        const DataAry = []; 
        //----------------- Home Downtime Summary-----------------------------------        
        DataAry[0] = "MFM_Real_Time_Data";        // Function Name    
        DataAry[1] = "NA";
        if(intDebugEnable === 1)    alert("DataAry :" + DataAry);   
        $.post('class/getData_HomeSummary.php', { userpara: DataAry }, function(json_data2) 
        {
            if(intDebugEnable === 1)    alert("json_data2 :" + json_data2); 
            var res = $.parseJSON(json_data2); 
           
            updateKnobValue(res.Data_Ary[0]);
            
            if(res.Status_Ary[0] === "true")
            {
                document.getElementById("id_MFM_Thermal_energy_unit").innerHTML     = ": " + parseFloat(res.Data_Ary[0]).toFixed(1) + " KW";
                document.getElementById("id_MFM_Child_Water_Flow").innerHTML        = ": " + parseFloat(res.Data_Ary[1]).toFixed(1) + " m3/h";
                document.getElementById("id_MFM_Child_Water_Supply_Temp").innerHTML = ": " + parseFloat(res.Data_Ary[2]).toFixed(1) + " °C";
                document.getElementById("id_MFM_Child_Water_return_Temp").innerHTML = ": " + parseFloat(res.Data_Ary[3]).toFixed(1) + " °C";
                document.getElementById("id_Home_units").innerHTML         =  res.Data_Ary[4];
                document.getElementById("id_Home_LstUpDateTime_MFM").innerHTML         =  res.Data_Ary[5];
            }                  
        });
    }
    //-------------------- Refresh Home Work Order Summary -----------------
    function fun_MFI_RealTimeData() 
    {
        let intDebugEnable = 0;        
        if(intDebugEnable === 1)    alert("fun_MFI_RealTimeData");
        const DataAry = []; 
        //----------------- Home Downtime Summary-----------------------------------        
        DataAry[0] = "MFI_Real_Time_Data";        // Function Name    
        DataAry[1] = "NA";
        if(intDebugEnable === 1)    alert("DataAry : " + DataAry);    
        $.post('class/getData_HomeSummary.php', { userpara: DataAry }, function(json_data2) 
        {
            if(intDebugEnable === 1)    alert("json_data2 : " + json_data2); 
            var res = $.parseJSON(json_data2);   
            updateKnobValue2(res.Data_Ary[0]);  
            if(res.Status_Ary[0] === "true")
            {
                document.getElementById("id_MFI_Thermal_energy_unit").innerHTML     = ": " + parseFloat(res.Data_Ary[0]).toFixed(1) + " KW";
                document.getElementById("id_MFI_Child_Water_Flow").innerHTML        = ": " + parseFloat(res.Data_Ary[1]).toFixed(1) + " m3/h";
                document.getElementById("id_MFI_Child_Water_Supply_Temp").innerHTML = ": " + parseFloat(res.Data_Ary[2]).toFixed(1) + " °C";
                document.getElementById("id_MFI_Child_Water_return_Temp").innerHTML = ": " + parseFloat(res.Data_Ary[3]).toFixed(1) + " °C";
                document.getElementById("id_Home_LstUpDateTime_MFI").innerHTML      =  res.Data_Ary[4];                
            }                     
        });  
    }
    //----------- fun Refresh All Areas ---------------------------------
    function funRefresh_HomePage()
    {         
        fun_MFM_RealTimeData();
        fun_MFI_RealTimeData();
        funRefresh_Chart();        
    }
    
</script>
</body>
</html>
