

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script> -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

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
        <section class="content" id="content">
            <h3>Dashboard</h3>

            <div class="">
                <div class="row">
                    <div class="col">

                        <div class="">
                            <div  class="flexbox" id="id_flexbox"> 
                                <div class="chartBox">
                                    <canvas id="myChart"></canvas>
                                </div>
                                <div class="chartBox">
                                    <canvas id="myChart2"></canvas>
                                </div>

                                <div class="chartBox">
                                    <canvas id="myChart3"></canvas>
                                </div>

                                <div class="chartBox">
                                    <canvas id="myChart4"></canvas>
                                </div>
                                
                            
                            </div>
                        </div>
                    </div>
                </div>

           


            
         
                <div class="row">
                    <div class="col">

                        <div class="">
                            <div  class="flexbox" id="id_flexbox"> 
                                
                                <div class="chartBox">
                                    <canvas id="myChart5"></canvas>
                                </div>
                                <div class="chartBox">
                                    <canvas id="myChart6"></canvas>
                                </div>

                                <div class="chartBox">
                                    <canvas id="myChart7"></canvas>
                                </div>

                                <div class="chartBox">
                                    <canvas id="myChart8"></canvas>
                                </div>
                                
                            
                            </div>
                        </div>
                    </div>
                </div>

            </div>
</select>
                

         




                 
      
                    
      

<style>
        .chartBox
        {
            width: 800px;
            margin:2px;
            
           
            
        }

        .flexbox
        {
            display: flex;
        }
        

</style>


<script> 

        function funLoadUsers() 
        
            {     
                
                        
                
                console.log("Reload:", new Date().toLocaleTimeString()); // Logs time in HH:MM:SS format
                //$("#content").load(location.href + " #content");

                
                //------------ Load Line Setting --------------------------------------
                const DataAry = []; 
                DataAry[0] = "funGetLineData";        // Table Name
                DataAry[1] = "Active";        
              //  alert(DataAry[1])
               // alert(DataAry);
                $.post('class/getData_HomeChart1.php', { userpara: DataAry }, function(json_data2) 
                {

                    var res = $.parseJSON(json_data2);    
                   //alert(res.Data_Ary.join(", ")); 
                   //alert(json_data2)


                   //Chart 1  Array
                    Data_Ary=(res.Data_Ary.join(", "));
                    Data_Ary2=(res.Data_Ary2.join(", "));

                    line1A_Length= res.Data_Ary.length;
                    line1B_Length= res.Data_Ary2.length;

                    line1A_Data=[];
                    line1A_Time=[];



                    for (var i = 0; i < line1A_Length; i++)
                     {
                        // Skip every other row (i.e., push the 1st, 3rd, 5th, etc. rows)
                        if (i % 2 === 0) {
                            line1A_Data.push(res.Data_Ary[i]);
                            line1A_Time.push(res.Data_Ary2[i]);
                            
                            last_value_Line_1A=i
                        }
                        
                    }
                    let max_value_line1A = Math.max(...line1A_Data);
                    console.log(max_value_line1A)
                    
                    
                    //Chart 2 Array
                    Data_Ary=(res.Data_Ary3.join(", "));
                    Data_Ary2=(res.Data_Ary4.join(", "));

                    line2B_Length= res.Data_Ary3.length;
                   

                    line1B_Data=[];
                    line1B_Time=[];

                    for (var i = 0; i < line2B_Length; i++)
                     {
                        // Skip every other row (i.e., push the 1st, 3rd, 5th, etc. rows)
                        if (i % 2 === 0) {
                            line1B_Data.push(res.Data_Ary3[i]);
                            line1B_Time.push(res.Data_Ary4[i]);
                            
                           
                            last_value_line1B=i;
                        }
                        
                       
                       
                        
                    }
                    let max_value_line1B = Math.max(...line1B_Data);
                   


                     //Chart 3 Array (2A)
                    Data_Ary=(res.Data_Ary5.join(", "));
                    Data_Ary2=(res.Data_Ary6.join(", "));

                    line2A_Length= res.Data_Ary5.length;
                   

                    line2A_Data=[];
                    line2A_Time=[];

                    for (var i = 0; i < line2A_Length; i++)
                     {
                        // Skip every other row (i.e., push the 1st, 3rd, 5th, etc. rows)
                        if (i % 2 === 0) {
                            line2A_Data.push(res.Data_Ary5[i]);
                            line2A_Time.push(res.Data_Ary6[i]);
                            
                           
                            last_value_line2A=i;
                        }
                        
                       
                       
                        
                    }
                    let max_value_line2A = Math.max(...line2A_Data);
                    //alert(line2A_Data)


                    //Chart 4 Array (2B)
                    Data_Ary=(res.Data_Ary7.join(", "));
                    Data_Ary2=(res.Data_Ary8.join(", "));

                    line2B_Length= res.Data_Ary7.length;
                   

                    line2B_Data=[];
                    line2B_Time=[];

                    for (var i = 0; i < line2A_Length; i++)
                     {
                        // Skip every other row (i.e., push the 1st, 3rd, 5th, etc. rows)
                        if (i % 2 === 0) {
                            line2B_Data.push(res.Data_Ary7[i]);
                            line2B_Time.push(res.Data_Ary8[i]);
                            
                           
                            last_value_line2B=i;
                        }
                        
                       
                       
                        
                    }
                    let max_value_line2B = Math.max(...line2B_Data);


                    //Chart 5 Array (3A) (5/2/24)
                    Data_Ary=(res.Data_Ary9.join(", "));
                    Data_Ary2=(res.Data_Ary10.join(", "));

                    line3A_Length= res.Data_Ary9.length;
                   

                    line3A_Data=[];
                    line3A_Time=[];

                    for (var i = 0; i < line3A_Length; i++)
                     {
                        // Skip every other row (i.e., push the 1st, 3rd, 5th, etc. rows)
                        if (i % 2 === 0) {
                            line3A_Data.push(res.Data_Ary9[i]);
                            line3A_Time.push(res.Data_Ary10[i]);
                            
                           
                            last_value_line3A=i;
                        }
                        
                       
                       
                        
                    }
                   // alert(last_value_line3A)
                    let max_value_line3A = Math.max(...line3A_Data);



                    //Chart 6 Array (3B) (5/2/24)
                    Data_Ary=(res.Data_Ary11.join(", "));
                    Data_Ary2=(res.Data_Ary12.join(", "));

                    line3B_Length= res.Data_Ary9.length;
                   

                    line3B_Data=[];
                    line3B_Time=[];

                    for (var i = 0; i < line3B_Length; i++)
                     {
                        // Skip every other row (i.e., push the 1st, 3rd, 5th, etc. rows)
                        if (i % 2 === 0) {
                            line3B_Data.push(res.Data_Ary11[i]);
                            line3B_Time.push(res.Data_Ary12[i]);
                            
                           
                            last_value_line3B=i;
                        }
                        
                       
                       
                        
                    }
                   // alert(last_value_line3B)
                    let max_value_line3B = Math.max(...line3B_Data);


                    //Chart 7 Array (4A) (5/2/24)
                    Data_Ary=(res.Data_Ary13.join(", "));
                    Data_Ary2=(res.Data_Ary14.join(", "));

                    line4A_Length= res.Data_Ary11.length;
                   

                    line4A_Data=[];
                    line4A_Time=[];

                    for (var i = 0; i < line4A_Length; i++)
                     {
                        // Skip every other row (i.e., push the 1st, 3rd, 5th, etc. rows)
                        if (i % 2 === 0) {
                            line4A_Data.push(res.Data_Ary13[i]);
                            line4A_Time.push(res.Data_Ary14[i]);
                            
                           
                            last_value_line4A=i;
                        }
                        
                       
                       
                        
                    }
                    //alert(last_value_line3B)
                    let max_value_line4A = Math.max(...line4A_Data);


                    //Chart 8 Array (4B) (5/2/24)
                    Data_Ary=(res.Data_Ary15.join(", "));
                    Data_Ary2=(res.Data_Ary16.join(", "));

                    line4B_Length= res.Data_Ary15.length;
                   

                    line4B_Data=[];
                    line4B_Time=[];

                    for (var i = 0; i < line4B_Length; i++)
                     {
                        // Skip every other row (i.e., push the 1st, 3rd, 5th, etc. rows)
                        if (i % 2 === 0) {
                            line4B_Data.push(res.Data_Ary15[i]);
                            line4B_Time.push(res.Data_Ary16[i]);
                            
                           
                            last_value_line4B=i;
                        }
                        
                       
                       
                        
                    }
                    //alert(last_value_line3B)
                    let max_value_line4B = Math.max(...line4B_Data);


                    








                    
                
                    //Chart 1
                    const ctx = document.getElementById('myChart');
                    ctx.style.backgroundColor = 'rgba(24, 24, 24, 0.71)';
                   

                    const lineChart = new Chart(ctx, {
                    type: 'line', // Line chart type
                    data: 
                    {
                        labels: line1A_Time, // X-axis labels
                        datasets: 
                            [{
                                label: 'Air Flow',
                                data: line1A_Data,
                                borderColor: 'rgb(0, 252, 63)', // Line color
                                borderWidth: 2, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4 // Curve effect on the line
                            }]
                    },
                    options: 
                    {
                       
                        plugins: 
                        {
                            legend: 
                            {
                                labels: 
                                {
                                    color: 'white', // Legend labels color
                                    font: {
                                    size: 14 // Optional: Change font size
                                    }
                                }
                            },
        
                            title: 
                            {
                                display: true, // Display the title
                                text: 'Line 1A', // Title text
                                position: 'top', 
                                font: {
                                    size: 20 ,// Font size for the title
                                    color: 'white'
                                },
                                color: 'white', // Optional title color
                                align: 'start',
                                padding:{
                                    top:10,

                                }
                                
                            },

                        },

                            footer: 
                            {
                                display: true,
                                text: 'This is footer text', // Footer text

                            },

                            scales: 
                            {
                                y: 
                                {
                                    max: max_value_line1A*1.5,
                                    //max:100,
                                    ticks: 
                                        {
                                            color: 'rgb(235, 235, 235)' // X-axis font color
                                        },
                                    
                                    title: 
                                        {
                                            display: true,
                                            color: 'Azure',
                                            text: 'Negative pressure',

                                            font: 
                                            {
                                                size: 14 // Optional: Change font size
                                            }
                                        },

                                    beginAtZero: true, // Start Y-axis from zero
                                            grid: 
                                            {
                                                color: 'rgba(5, 5, 5, 0.23)', // Gridline color
                                                borderColor: 'rgba(219, 219, 219, 0.44)' // Y-axis border color
                                            }
                                },

                                x: 
                                {
                                    ticks: 
                                        {
                                            color: 'rgb(235, 235, 235)' // X-ax
                                        },

                                    title: 
                                    {
                                        display: true,
                                        color: 'white',
                                        text: 'Time',

                                        font: 
                                        {
                                        size: 14 // Optional: Change font size
                                        }
                                    },

                                
                                
                                    grid: 
                                    {
                                        color: 'rgba(5, 5, 5, 0.23)', // Gridline color
                                        borderColor: 'rgba(219, 219, 219, 0.44)' // Y-axis border color
                                    }
                                }
                            },

                    },
                    
                        plugins: 
                        [
                            {
                                id: 'customRightText',
                                beforeDraw: (chart) => 
                                {
                                    const ctx = chart.ctx;
                                    ctx.save();
                                    ctx.font = '25px Arial';
                                    ctx.fillStyle = 'white';
                                    ctx.textAlign = 'right';
                                    ctx.fontWeight = 'bold'; // corrected
                                    ctx.fillText(res.Data_Ary[last_value_Line_1A]+' Pa', chart.width - 10, 30); // Adjust position as needed
                                    ctx.restore();
                                }

                                ,id: 'horizontalLine', // Combine logic under a single plugin
                                    afterDraw: (chart) => 
                                    {
                                        const ctx = chart.ctx;

                                        // Horizontal lines data
                                        const lines = [
                                            { yValue: 10, color: 'red' },
                                            { yValue: 40, color: 'red' }
                                        ];

                                        lines.forEach((line) => 
                                        {
                                            const yValue = chart.scales.y.getPixelForValue(line.yValue);

                                            ctx.save();
                                            ctx.beginPath();
                                            ctx.moveTo(chart.chartArea.left, yValue);
                                            ctx.lineTo(chart.chartArea.right, yValue);
                                            ctx.strokeStyle = line.color; // Line color
                                            ctx.lineWidth = 2; // Line width
                                            ctx.stroke();
                                            ctx.restore();
                                        });
                            }}
                        
                        ]

                });




                //Chart 2
                    const ctx2 = document.getElementById('myChart2');
                    ctx2.style.backgroundColor = 'rgba(24, 24, 24, 0.71)';
                   

                    const lineChart2 = new Chart(ctx2, {
                    type: 'line', // Line chart type
                    data: 
                    {
                        labels: line1B_Time, // X-axis labels
                        datasets: 
                            [{
                                label: 'Air Flow',
                                data: line1B_Data,
                                borderColor: 'rgb(0, 252, 63)', // Line color
                                borderWidth: 2, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4 // Curve effect on the line
                            }]
                    },
                    options: 
                    {
                       
                        plugins: 
                        {
                            legend: 
                            {
                                labels: 
                                {
                                    color: 'white', // Legend labels color
                                    font: {
                                    size: 14 // Optional: Change font size
                                    }
                                }
                            },
        
                            title: 
                            {
                                display: true, // Display the title
                                text: 'Line 1B', // Title text
                                position: 'top', 
                                font: {
                                    size: 20 ,// Font size for the title
                                    color: 'white'
                                },
                                color: 'white', // Optional title color
                                align: 'start',
                                padding:{
                                    top:10,

                                }
                                
                            },

                        },

                            footer: 
                            {
                                display: true,
                                text: 'This is footer text', // Footer text

                            },

                            scales: 
                            {
                                y: 
                                {
                                    max:max_value_line1B*2,
                                    ticks: 
                                        {
                                            color: 'rgb(235, 235, 235)' // X-axis font color
                                        },
                                    
                                    title: 
                                        {
                                            display: true,
                                            color: 'Azure',
                                            text: 'Negative pressure',

                                            font: 
                                            {
                                                size: 14 // Optional: Change font size
                                            }
                                        },

                                    beginAtZero: true, // Start Y-axis from zero
                                            grid: 
                                            {
                                                color: 'rgba(5, 5, 5, 0.23)', // Gridline color
                                                borderColor: 'rgba(219, 219, 219, 0.44)' // Y-axis border color
                                            }
                                },

                                x: 
                                {
                                    ticks: 
                                        {
                                            color: 'rgb(235, 235, 235)' // X-ax
                                        },

                                    title: 
                                    {
                                        display: true,
                                        color: 'white',
                                        text: 'Time',

                                        font: 
                                        {
                                        size: 14 // Optional: Change font size
                                        }
                                    },

                                
                                
                                    grid: 
                                    {
                                        color: 'rgba(5, 5, 5, 0.23)', // Gridline color
                                        borderColor: 'rgba(219, 219, 219, 0.44)' // Y-axis border color
                                    }
                                }
                            },

                    },
                    
                    plugins: 
                        [
                            {
                                id: 'customRightText',
                                beforeDraw: (chart) => 
                                {
                                    const ctx = chart.ctx;
                                    ctx.save();
                                    ctx.font = '25px Arial';
                                    ctx.fillStyle = 'white';
                                    ctx.textAlign = 'right';
                                    ctx.fontWeight = 'bold'; // corrected
                                    ctx.fillText(res.Data_Ary3[last_value_line1B]+' Pa', chart.width - 10, 30); // Adjust position as needed
                                    ctx.restore();
                                }

                                ,id: 'horizontalLine', // Combine logic under a single plugin
                                    afterDraw: (chart) => 
                                    {
                                        const ctx = chart.ctx;

                                        // Horizontal lines data
                                        const lines = [
                                            { yValue: 10, color: 'red' },
                                            { yValue: 40, color: 'red' }
                                        ];

                                        lines.forEach((line) => 
                                        {
                                            const yValue = chart.scales.y.getPixelForValue(line.yValue);

                                            ctx.save();
                                            ctx.beginPath();
                                            ctx.moveTo(chart.chartArea.left, yValue);
                                            ctx.lineTo(chart.chartArea.right, yValue);
                                            ctx.strokeStyle = line.color; // Line color
                                            ctx.lineWidth = 2; // Line width
                                            ctx.stroke();
                                            ctx.restore();
                                        });
                            }}
                        
                        ]

                });




                 //Chart 3 (Line 2A)
                 const ctx3 = document.getElementById('myChart3');
                    ctx3.style.backgroundColor = 'rgba(24, 24, 24, 0.71)';
                   

                    const lineChart3 = new Chart(ctx3, {
                    type: 'line', // Line chart type
                    data: 
                    {
                        labels: line2A_Time, // X-axis labels
                        datasets: 
                            [{
                                label: 'Air Flow',
                                data: line2A_Data,
                                borderColor: 'rgb(0, 252, 63)', // Line color
                                borderWidth: 2, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4 // Curve effect on the line
                            }]
                    },
                    options: 
                    {
                       
                        plugins: 
                        {
                            legend: 
                            {
                                labels: 
                                {
                                    color: 'white', // Legend labels color
                                    font: {
                                    size: 14 // Optional: Change font size
                                    }
                                }
                            },
        
                            title: 
                            {
                                display: true, // Display the title
                                text: 'Line 2A', // Title text
                                position: 'top', 
                                font: {
                                    size: 20 ,// Font size for the title
                                    color: 'white'
                                },
                                color: 'white', // Optional title color
                                align: 'start',
                                padding:{
                                    top:10,

                                }
                                
                            },

                        },

                            footer: 
                            {
                                display: true,
                                text: 'This is footer text', // Footer text

                            },

                            scales: 
                            {
                                y: 
                                {
                                    max:max_value_line2A*2,
                                    ticks: 
                                        {
                                            color: 'rgb(235, 235, 235)' // X-axis font color
                                        },
                                    
                                    title: 
                                        {
                                            display: true,
                                            color: 'Azure',
                                            text: 'Negative pressure',

                                            font: 
                                            {
                                                size: 14 // Optional: Change font size
                                            }
                                        },

                                    beginAtZero: true, // Start Y-axis from zero
                                            grid: 
                                            {
                                                color: 'rgba(5, 5, 5, 0.23)', // Gridline color
                                                borderColor: 'rgba(219, 219, 219, 0.44)' // Y-axis border color
                                            }
                                },

                                x: 
                                {
                                    ticks: 
                                        {
                                            color: 'rgb(235, 235, 235)' // X-ax
                                        },

                                    title: 
                                    {
                                        display: true,
                                        color: 'white',
                                        text: 'Time',

                                        font: 
                                        {
                                        size: 14 // Optional: Change font size
                                        }
                                    },

                                
                                
                                    grid: 
                                    {
                                        color: 'rgba(5, 5, 5, 0.23)', // Gridline color
                                        borderColor: 'rgba(219, 219, 219, 0.44)' // Y-axis border color
                                    }
                                }
                            },

                    },
                    
                    plugins: 
                        [
                            {
                                id: 'customRightText',
                                beforeDraw: (chart) => 
                                {
                                    const ctx = chart.ctx;
                                    ctx.save();
                                    ctx.font = '25px Arial';
                                    ctx.fillStyle = 'white';
                                    ctx.textAlign = 'right';
                                    ctx.fontWeight = 'bold'; // corrected
                                    ctx.fillText(res.Data_Ary5[last_value_line2A]+' Pa', chart.width - 10, 30); // Adjust position as needed
                                    ctx.restore();
                                }

                                ,id: 'horizontalLine', // Combine logic under a single plugin
                                    afterDraw: (chart) => 
                                    {
                                        const ctx = chart.ctx;

                                        // Horizontal lines data
                                        const lines = [
                                            { yValue: 10, color: 'red' },
                                            { yValue: 40, color: 'red' }
                                        ];

                                        lines.forEach((line) => 
                                        {
                                            const yValue = chart.scales.y.getPixelForValue(line.yValue);

                                            ctx.save();
                                            ctx.beginPath();
                                            ctx.moveTo(chart.chartArea.left, yValue);
                                            ctx.lineTo(chart.chartArea.right, yValue);
                                            ctx.strokeStyle = line.color; // Line color
                                            ctx.lineWidth = 2; // Line width
                                            ctx.stroke();
                                            ctx.restore();
                                        });
                            }}
                        
                        ]

                });


                

                //Chart 4 (Line 2B)
                    const ctx4 = document.getElementById('myChart4');
                    ctx4.style.backgroundColor = 'rgba(24, 24, 24, 0.71)';
                   

                    const lineChart4 = new Chart(ctx4, {
                    type: 'line', // Line chart type
                    data: 
                    {
                        labels: line2B_Time, // X-axis labels
                        datasets: 
                            [{
                                label: 'Air Flow',
                                data: line2B_Data,
                                borderColor: 'rgb(0, 252, 63)', // Line color
                                borderWidth: 2, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4 // Curve effect on the line
                            }]
                    },
                    options: 
                    {
                       
                        plugins: 
                        {
                            legend: 
                            {
                                labels: 
                                {
                                    color: 'white', // Legend labels color
                                    font: {
                                    size: 14 // Optional: Change font size
                                    }
                                }
                            },
        
                            title: 
                            {
                                display: true, // Display the title
                                text: 'Line 2B', // Title text
                                position: 'top', 
                                font: {
                                    size: 20 ,// Font size for the title
                                    color: 'white'
                                },
                                color: 'white', // Optional title color
                                align: 'start',
                                padding:{
                                    top:10,

                                }
                                
                            },

                        },

                            footer: 
                            {
                                display: true,
                                text: 'This is footer text', // Footer text

                            },

                            scales: 
                            {
                                y: 
                                {
                                    max:max_value_line2B*2,
                                    ticks: 
                                        {
                                            color: 'rgb(235, 235, 235)' // X-axis font color
                                        },
                                    
                                    title: 
                                        {
                                            display: true,
                                            color: 'Azure',
                                            text: 'Negative pressure',

                                            font: 
                                            {
                                                size: 14 // Optional: Change font size
                                            }
                                        },

                                    beginAtZero: true, // Start Y-axis from zero
                                            grid: 
                                            {
                                                color: 'rgba(5, 5, 5, 0.23)', // Gridline color
                                                borderColor: 'rgba(219, 219, 219, 0.44)' // Y-axis border color
                                            }
                                },

                                x: 
                                {
                                    ticks: 
                                        {
                                            color: 'rgb(235, 235, 235)' // X-ax
                                        },

                                    title: 
                                    {
                                        display: true,
                                        color: 'white',
                                        text: 'Time',

                                        font: 
                                        {
                                        size: 14 // Optional: Change font size
                                        }
                                    },

                                
                                
                                    grid: 
                                    {
                                        color: 'rgba(5, 5, 5, 0.23)', // Gridline color
                                        borderColor: 'rgba(219, 219, 219, 0.44)' // Y-axis border color
                                    }
                                }
                            },

                    },
                    
                    plugins: 
                        [
                            {
                                id: 'customRightText',
                                beforeDraw: (chart) => 
                                {
                                    const ctx = chart.ctx;
                                    ctx.save();
                                    ctx.font = '25px Arial';
                                    ctx.fillStyle = 'white';
                                    ctx.textAlign = 'right';
                                    ctx.fontWeight = 'bold'; // corrected
                                    ctx.fillText(res.Data_Ary5[last_value_line2A]+' Pa', chart.width - 10, 30); // Adjust position as needed
                                    ctx.restore();
                                }

                                ,id: 'horizontalLine', // Combine logic under a single plugin
                                    afterDraw: (chart) => 
                                    {
                                        const ctx = chart.ctx;

                                        // Horizontal lines data
                                        const lines = [
                                            { yValue: 10, color: 'red' },
                                            { yValue: 40, color: 'red' }
                                        ];

                                        lines.forEach((line) => 
                                        {
                                            const yValue = chart.scales.y.getPixelForValue(line.yValue);

                                            ctx.save();
                                            ctx.beginPath();
                                            ctx.moveTo(chart.chartArea.left, yValue);
                                            ctx.lineTo(chart.chartArea.right, yValue);
                                            ctx.strokeStyle = line.color; // Line color
                                            ctx.lineWidth = 2; // Line width
                                            ctx.stroke();
                                            ctx.restore();
                                        });
                            }}
                        
                        ]

                });

    //5 ,6

    //Chart 5 (Line 3A)
    const ctx5 = document.getElementById('myChart5');
                    ctx5.style.backgroundColor = 'rgba(24, 24, 24, 0.71)';
                   

                    const lineChart5 = new Chart(ctx5, {
                    type: 'line', // Line chart type
                    data: 
                    {
                        labels: line3A_Time, // X-axis labels
                        datasets: 
                            [{
                                label: 'Air Flow',
                                data: line3A_Data,
                                borderColor: 'rgb(0, 252, 63)', // Line color
                                borderWidth: 2, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4 // Curve effect on the line
                            }]
                    },
                    options: 
                    {
                       
                        plugins: 
                        {
                            legend: 
                            {
                                labels: 
                                {
                                    color: 'white', // Legend labels color
                                    font: {
                                    size: 14 // Optional: Change font size
                                    }
                                }
                            },
        
                            title: 
                            {
                                display: true, // Display the title
                                text: 'Line 3A', // Title text
                                position: 'top', 
                                font: {
                                    size: 20 ,// Font size for the title
                                    color: 'white'
                                },
                                color: 'white', // Optional title color
                                align: 'start',
                                padding:{
                                    top:10,

                                }
                                
                            },

                        },

                            footer: 
                            {
                                display: true,
                                text: 'This is footer text', // Footer text

                            },

                            scales: 
                            {
                                y: 
                                {
                                    max:max_value_line3A*2,
                                    ticks: 
                                        {
                                            color: 'rgb(235, 235, 235)' // X-axis font color
                                        },
                                    
                                    title: 
                                        {
                                            display: true,
                                            color: 'Azure',
                                            text: 'Negative pressure',

                                            font: 
                                            {
                                                size: 14 // Optional: Change font size
                                            }
                                        },

                                    beginAtZero: true, // Start Y-axis from zero
                                            grid: 
                                            {
                                                color: 'rgba(5, 5, 5, 0.23)', // Gridline color
                                                borderColor: 'rgba(219, 219, 219, 0.44)' // Y-axis border color
                                            }
                                },

                                x: 
                                {
                                    ticks: 
                                        {
                                            color: 'rgb(235, 235, 235)' // X-ax
                                        },

                                    title: 
                                    {
                                        display: true,
                                        color: 'white',
                                        text: 'Time',

                                        font: 
                                        {
                                        size: 14 // Optional: Change font size
                                        }
                                    },

                                
                                
                                    grid: 
                                    {
                                        color: 'rgba(5, 5, 5, 0.23)', // Gridline color
                                        borderColor: 'rgba(219, 219, 219, 0.44)' // Y-axis border color
                                    }
                                }
                            },

                    },
                    
                    plugins: 
                        [
                            {
                                id: 'customRightText',
                                beforeDraw: (chart) => 
                                {
                                    const ctx = chart.ctx;
                                    ctx.save();
                                    ctx.font = '25px Arial';
                                    ctx.fillStyle = 'white';
                                    ctx.textAlign = 'right';
                                    ctx.fontWeight = 'bold'; // corrected
                                    ctx.fillText(res.Data_Ary9[last_value_line3A]+' Pa', chart.width - 10, 30); // Adjust position as needed
                                    ctx.restore();
                                }

                                ,id: 'horizontalLine', // Combine logic under a single plugin
                                    afterDraw: (chart) => 
                                    {
                                        const ctx = chart.ctx;

                                        // Horizontal lines data
                                        const lines = [
                                            { yValue: 10, color: 'red' },
                                            { yValue: 50, color: 'red' }
                                        ];

                                        lines.forEach((line) => 
                                        {
                                            const yValue = chart.scales.y.getPixelForValue(line.yValue);

                                            ctx.save();
                                            ctx.beginPath();
                                            ctx.moveTo(chart.chartArea.left, yValue);
                                            ctx.lineTo(chart.chartArea.right, yValue);
                                            ctx.strokeStyle = line.color; // Line color
                                            ctx.lineWidth = 2; // Line width
                                            ctx.stroke();
                                            ctx.restore();
                                        });
                            }}
                        
                        ]

                });


                

                //Chart 6 (Line 3B)
                const ctx6 = document.getElementById('myChart6');
                    ctx6.style.backgroundColor = 'rgba(24, 24, 24, 0.71)';
                   

                    const lineChart6 = new Chart(ctx6, {
                    type: 'line', // Line chart type
                    data: 
                    {
                        labels: line3B_Time, // X-axis labels
                        datasets: 
                            [{
                                label: 'Air Flow',
                                data: line3B_Data,
                                borderColor: 'rgb(0, 252, 63)', // Line color
                                borderWidth: 2, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4 // Curve effect on the line
                            }]
                    },
                    options: 
                    {
                       
                        plugins: 
                        {
                            legend: 
                            {
                                labels: 
                                {
                                    color: 'white', // Legend labels color
                                    font: {
                                    size: 14 // Optional: Change font size
                                    }
                                }
                            },
        
                            title: 
                            {
                                display: true, // Display the title
                                text: 'Line 3B', // Title text
                                position: 'top', 
                                font: {
                                    size: 20 ,// Font size for the title
                                    color: 'white'
                                },
                                color: 'white', // Optional title color
                                align: 'start',
                                padding:{
                                    top:10,

                                }
                                
                            },

                        },

                            footer: 
                            {
                                display: true,
                                text: 'This is footer text', // Footer text

                            },

                            scales: 
                            {
                                y: 
                                {
                                    max:max_value_line3B*2,
                                    ticks: 
                                        {
                                            color: 'rgb(235, 235, 235)' // X-axis font color
                                        },
                                    
                                    title: 
                                        {
                                            display: true,
                                            color: 'Azure',
                                            text: 'Negative pressure',

                                            font: 
                                            {
                                                size: 14 // Optional: Change font size
                                            }
                                        },

                                    beginAtZero: true, // Start Y-axis from zero
                                            grid: 
                                            {
                                                color: 'rgba(5, 5, 5, 0.23)', // Gridline color
                                                borderColor: 'rgba(219, 219, 219, 0.44)' // Y-axis border color
                                            }
                                },

                                x: 
                                {
                                    ticks: 
                                        {
                                            color: 'rgb(235, 235, 235)' // X-ax
                                        },

                                    title: 
                                    {
                                        display: true,
                                        color: 'white',
                                        text: 'Time',

                                        font: 
                                        {
                                        size: 14 // Optional: Change font size
                                        }
                                    },

                                
                                
                                    grid: 
                                    {
                                        color: 'rgba(5, 5, 5, 0.23)', // Gridline color
                                        borderColor: 'rgba(219, 219, 219, 0.44)' // Y-axis border color
                                    }
                                }
                            },

                    },
                    
                    plugins: 
                        [
                            {
                                id: 'customRightText',
                                beforeDraw: (chart) => 
                                {
                                    const ctx = chart.ctx;
                                    ctx.save();
                                    ctx.font = '25px Arial';
                                    ctx.fillStyle = 'white';
                                    ctx.textAlign = 'right';
                                    ctx.fontWeight = 'bold'; // corrected
                                    ctx.fillText(res.Data_Ary11[last_value_line3B]+' Pa', chart.width - 10, 30); // Adjust position as needed
                                    ctx.restore();
                                }

                                ,id: 'horizontalLine', // Combine logic under a single plugin
                                    afterDraw: (chart) => 
                                    {
                                        const ctx = chart.ctx;

                                        // Horizontal lines data
                                        const lines = [
                                            { yValue: 10, color: 'red' },
                                            { yValue: 40, color: 'red' }
                                        ];

                                        lines.forEach((line) => 
                                        {
                                            const yValue = chart.scales.y.getPixelForValue(line.yValue);

                                            ctx.save();
                                            ctx.beginPath();
                                            ctx.moveTo(chart.chartArea.left, yValue);
                                            ctx.lineTo(chart.chartArea.right, yValue);
                                            ctx.strokeStyle = line.color; // Line color
                                            ctx.lineWidth = 2; // Line width
                                            ctx.stroke();
                                            ctx.restore();
                                        });
                            }}
                        
                        ]

                });



                //Chart 7 (Line 4A)
                    const ctx7 = document.getElementById('myChart7');
                    ctx7.style.backgroundColor = 'rgba(24, 24, 24, 0.71)';
                   

                    const lineChart7 = new Chart(ctx7, {
                    type: 'line', // Line chart type
                    data: 
                    {
                        labels: line4A_Time, // X-axis labels
                        datasets: 
                            [{
                                label: 'Air Flow',
                                data: line4A_Data,
                                borderColor: 'rgb(0, 252, 63)', // Line color
                                borderWidth: 2, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4 // Curve effect on the line
                            }]
                    },
                    options: 
                    {
                       
                        plugins: 
                        {
                            legend: 
                            {
                                labels: 
                                {
                                    color: 'white', // Legend labels color
                                    font: {
                                    size: 14 // Optional: Change font size
                                    }
                                }
                            },
        
                            title: 
                            {
                                display: true, // Display the title
                                text: 'Line 4A', // Title text
                                position: 'top', 
                                font: {
                                    size: 20 ,// Font size for the title
                                    color: 'white'
                                },
                                color: 'white', // Optional title color
                                align: 'start',
                                padding:{
                                    top:10,

                                }
                                
                            },

                        },

                            footer: 
                            {
                                display: true,
                                text: 'This is footer text', // Footer text

                            },

                            scales: 
                            {
                                y: 
                                {
                                    max:max_value_line4A*2,
                                    ticks: 
                                        {
                                            color: 'rgb(235, 235, 235)' // X-axis font color
                                        },
                                    
                                    title: 
                                        {
                                            display: true,
                                            color: 'Azure',
                                            text: 'Negative pressure',

                                            font: 
                                            {
                                                size: 14 // Optional: Change font size
                                            }
                                        },

                                    beginAtZero: true, // Start Y-axis from zero
                                            grid: 
                                            {
                                                color: 'rgba(5, 5, 5, 0.23)', // Gridline color
                                                borderColor: 'rgba(219, 219, 219, 0.44)' // Y-axis border color
                                            }
                                },

                                x: 
                                {
                                    ticks: 
                                        {
                                            color: 'rgb(235, 235, 235)' // X-ax
                                        },

                                    title: 
                                    {
                                        display: true,
                                        color: 'white',
                                        text: 'Time',

                                        font: 
                                        {
                                        size: 14 // Optional: Change font size
                                        }
                                    },

                                
                                
                                    grid: 
                                    {
                                        color: 'rgba(5, 5, 5, 0.23)', // Gridline color
                                        borderColor: 'rgba(219, 219, 219, 0.44)' // Y-axis border color
                                    }
                                }
                            },

                    },
                    
                    plugins: 
                        [
                            {
                                id: 'customRightText',
                                beforeDraw: (chart) => 
                                {
                                    const ctx = chart.ctx;
                                    ctx.save();
                                    ctx.font = '25px Arial';
                                    ctx.fillStyle = 'white';
                                    ctx.textAlign = 'right';
                                    ctx.fontWeight = 'bold'; // corrected
                                    ctx.fillText(res.Data_Ary13[last_value_line4A]+' Pa', chart.width - 10, 30); // Adjust position as needed
                                    ctx.restore();
                                }

                                ,id: 'horizontalLine', // Combine logic under a single plugin
                                    afterDraw: (chart) => 
                                    {
                                        const ctx = chart.ctx;

                                        // Horizontal lines data
                                        const lines = [
                                            { yValue: 10, color: 'red' },
                                            { yValue: 50, color: 'red' }
                                        ];

                                        lines.forEach((line) => 
                                        {
                                            const yValue = chart.scales.y.getPixelForValue(line.yValue);

                                            ctx.save();
                                            ctx.beginPath();
                                            ctx.moveTo(chart.chartArea.left, yValue);
                                            ctx.lineTo(chart.chartArea.right, yValue);
                                            ctx.strokeStyle = line.color; // Line color
                                            ctx.lineWidth = 2; // Line width
                                            ctx.stroke();
                                            ctx.restore();
                                        });
                            }}
                        
                        ]

                });


                

                //Chart 8 (Line 4B)
                const ctx8 = document.getElementById('myChart8');
                    ctx8.style.backgroundColor = 'rgba(24, 24, 24, 0.71)';
                   

                    const lineChart8 = new Chart(ctx8, {
                    type: 'line', // Line chart type
                    data: 
                    {
                        labels: line4B_Time, // X-axis labels
                        datasets: 
                            [{
                                label: 'Air Flow',
                                data: line4B_Data,
                                borderColor: 'rgb(0, 252, 63)', // Line color
                                borderWidth: 2, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4 // Curve effect on the line
                            }]
                    },
                    options: 
                    {
                       
                        plugins: 
                        {
                            legend: 
                            {
                                labels: 
                                {
                                    color: 'white', // Legend labels color
                                    font: {
                                    size: 14 // Optional: Change font size
                                    }
                                }
                            },
        
                            title: 
                            {
                                display: true, // Display the title
                                text: 'Line 4B', // Title text
                                position: 'top', 
                                font: {
                                    size: 20 ,// Font size for the title
                                    color: 'white'
                                },
                                color: 'white', // Optional title color
                                align: 'start',
                                padding:{
                                    top:10,

                                }
                                
                            },

                        },

                            footer: 
                            {
                                display: true,
                                text: 'This is footer text', // Footer text

                            },

                            scales: 
                            {
                                y: 
                                {
                                    max:max_value_line4B*2,
                                    ticks: 
                                        {
                                            color: 'rgb(235, 235, 235)' // X-axis font color
                                        },
                                    
                                    title: 
                                        {
                                            display: true,
                                            color: 'Azure',
                                            text: 'Negative pressure',

                                            font: 
                                            {
                                                size: 14 // Optional: Change font size
                                            }
                                        },

                                    beginAtZero: true, // Start Y-axis from zero
                                            grid: 
                                            {
                                                color: 'rgba(5, 5, 5, 0.23)', // Gridline color
                                                borderColor: 'rgba(219, 219, 219, 0.44)' // Y-axis border color
                                            }
                                },

                                x: 
                                {
                                    ticks: 
                                        {
                                            color: 'rgb(235, 235, 235)' // X-ax
                                        },

                                    title: 
                                    {
                                        display: true,
                                        color: 'white',
                                        text: 'Time',

                                        font: 
                                        {
                                        size: 14 // Optional: Change font size
                                        }
                                    },

                                
                                
                                    grid: 
                                    {
                                        color: 'rgba(5, 5, 5, 0.23)', // Gridline color
                                        borderColor: 'rgba(219, 219, 219, 0.44)' // Y-axis border color
                                    }
                                }
                            },

                    },
                    
                    plugins: 
                        [
                            {
                                id: 'customRightText',
                                beforeDraw: (chart) => 
                                {
                                    const ctx = chart.ctx;
                                    ctx.save();
                                    ctx.font = '25px Arial';
                                    ctx.fillStyle = 'white';
                                    ctx.textAlign = 'right';
                                    ctx.fontWeight = 'bold'; // corrected
                                    ctx.fillText(res.Data_Ary15[last_value_line4B]+' Pa', chart.width - 10, 30); // Adjust position as needed
                                    ctx.restore();
                                }

                                ,id: 'horizontalLine', // Combine logic under a single plugin
                                    afterDraw: (chart) => 
                                    {
                                        const ctx = chart.ctx;

                                        // Horizontal lines data
                                        const lines = [
                                            { yValue: 10, color: 'red' },
                                            { yValue: 40, color: 'red' }
                                        ];

                                        lines.forEach((line) => 
                                        {
                                            const yValue = chart.scales.y.getPixelForValue(line.yValue);

                                            ctx.save();
                                            ctx.beginPath();
                                            ctx.moveTo(chart.chartArea.left, yValue);
                                            ctx.lineTo(chart.chartArea.right, yValue);
                                            ctx.strokeStyle = line.color; // Line color
                                            ctx.lineWidth = 2; // Line width
                                            ctx.stroke();
                                            ctx.restore();
                                        });
                            }}
                        
                        ]

                });

                



                


              });       
            //   $("#myChart").load(location.href + " #myChart");
            //   $("#myChart2").load(location.href + " #myChart2");
            //   $("#myChart3").load(location.href + " #myChart3");
            //   $("#myChart4").load(location.href + " #myChart4");
            //   $("#myChart5").load(location.href + " #myChart5");
            //   $("#myChart6").load(location.href + " #myChart6");
            //   $("#myChart7").load(location.href + " #myChart7");
            //   $("#myChart8").load(location.href + " #myChart8 ");
           
            } 

            function refreshFrontEnd() {
                console.log("refreshFrontEnd")
                $("#content").load(location.href + " #content");
              
            }

            function ReloadContent(){
             
                //setInterval(funLoadUsers, 2000);
                //setInterval(refreshFrontEnd, 2000)
               // DistroyChart();

               //alert("Reload");
               
              
              
               funLoadUsers();
               refreshFrontEnd();
              // DistroyChart();
               
              
               
                
                //setInterval(refreshFrontEnd, 10000);
               
            }

            function DistroyChart(){
                myChart.destroy();
                myChart2.destroy();
                myChart3.destroy();
                myChart4.destroy();
                myChart5.destroy();
                myChart6.destroy();
                myChart7.destroy();
                myChart8.destroy();

                myChart.clear();
                myChart2.clear();
                myChart3.clear();
                myChart4.clear();
                myChart5.clear();
                myChart6.clear();
                myChart7.clear();
                myChart8.clear();
            }
         
              
          
            funLoadUsers();
            //setInterval(funLoadUsers, 5000);
          //  ReloadContent();
          //  setInterval(ReloadContent, 3000);
            

           


  
</script>




<!-- <footer class="container-fluid text-center bg-dark">
    <div class="row">
        <div class="col-md-6 px-1 pt-1">
             <p>Copyright © 2024 Sky Smart Technology Pvt Ltd. All Rights Reserved</p>
        </div>
        <div class="col-md-6 px-1 pt-1">
             <p> Soft Ver: 4.3</p>
        </div>
    </div>
</footer> -->


<!-- MQTT -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.js" type="text/javascript"></script>
<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- InputMask -->
<script src="../../plugins/moment/moment.min.js"></script>
<script src="../../plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="../../plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- BS-Stepper -->
<script src="../../plugins/bs-stepper/js/bs-stepper.min.js"></script>
<!-- dropzonejs -->
<script src="../../plugins/dropzone/min/dropzone.min.js"></script>
<!-- Select2 -->
<script src="../../plugins/select2/js/select2.full.min.js"></script>



<!-- kuma-gauge chart meeter shanika -->
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js"></script>
<script type="text/javascript" src="../../plugins/sky_shanika/kuma-gauge.jquery.js"></script>


<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- Include SweetAlert JavaScript -->
<script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Include Google Chart JavaScript -->
<script src="../../plugins/chart-google/loader.js"></script>

<!-- Include Error Log Events JavaScript -->
<script src="../../includes/write_LogFile.js"></script>







<!-- JAVASCRIPT -->
<script src="../../assets/libs/jquery/jquery.min.js"></script>
<script src="../../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/libs/metismenu/metisMenu.min.js"></script>
<script src="../../assets/libs/simplebar/simplebar.min.js"></script>
<script src="../../assets/libs/node-waves/waves.min.js"></script>
<!-- apexcharts -->
<script src="../../assets/libs/apexcharts/apexcharts.min.js"></script>
<!-- jquery.vectormap map -->
<script src="../../assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../../assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js"></script>
<!-- Required datatable js -->
<script src="../../assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- Responsive examples -->
<script src="../../assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<script src="../../assets/js/pages/dashboard.init.js"></script>
<!-- App js -->
<script src="../../assets/js/app.js"></script>












</div>  
</body>
</html>
