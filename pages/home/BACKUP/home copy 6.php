  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<?php
// sleep(3);

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
?>
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
                            
                           
                        </div>
                        </div>
                    
                    
                    <div class="">
                        <div  class="flexbox" id="id_flexbox"> 
                            
                            
                        <div class="chartBox">
                                <canvas id="myChart3"></canvas>
                            </div>

                            <div class="chartBox">
                                <canvas id="myChart4"></canvas>
                            </div>
                        </div>
                    </div>


                    <div class="">
                        <div  class="flexbox" id="id_flexbox"> 
                            
                            <div class="chartBox">
                                <canvas id="myChart7"></canvas>
                            </div>
                            <div class="chartBox">
                                <canvas id="myChart8"></canvas>
                            </div>
                            <div class="chartBox">
                                <canvas id="myChart9"></canvas>
                            </div>
                        </div>
                    </div>

                    
                </div>
                        <br>

                        <div id="id_tableLine"></div>
                        <div id="id_tableLine2"></div>

                        <canvas id="myChart2"></canvas>
                        </div>
                    </section>
                </div>

    <style>
        .chartBox
        {
            width: 600px;
            margin:5px;
           
            
        }

        .flexbox
        {
            display: flex;
        }
        canvas{
            ma
        }

    </style>


<script> 

        function funLoadUsers() 

        
            {       
                
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
                            line1A_Data.push(res.Data_Ary2[i]);
                            line1A_Time.push(res.Data_Ary[i]);
                            
                            last_value_Line_1A=i
                        }
                        
                        
                    }
                    
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
                            line2B_Data.push(res.Data_Ary5[i]);
                            line2B_Time.push(res.Data_Ary6[i]);
                            
                           
                            last_value_line2B=i;
                        }
                        
                       
                       
                        
                    }
                    let max_value_line2B = Math.max(...line2B_Data);
                    //alert(line2B_Data)



                    // //Chart 4  Array (Line_3B)
                    // Data_Ary=(res.Data_Ary7.join(", "));
                    // Data_Ary2=(res.Data_Ary8.join(", "));

                    // line3B_Length= res.Data_Ary7.length;
                   

                    // line3B_Data=[];
                    // line3B_Time=[];

                    // for (var i = 0; i < line3A_Length; i++)
                    //  {
                    //     // Skip every other row (i.e., push the 1st, 3rd, 5th, etc. rows)
                    //     if (i % 2 === 0) {
                    //         line3B_Data.push(res.Data_Ary5[i]);
                    //         line3B_Time.push(res.Data_Ary6[i]);
                            
                           
                    //         last_value_line3B=i;
                    //     }
                        
                       
                       
                        
                    // }
                    // let max_value_line3B = Math.max(...line3A_Data);
                    // alert(line3B_Data)


                    


                    


                   


                    
                   












                     
                    // Data_Ary3=(res.Data_Ary.join(", "));
                    // Data_Ary4=(res.Data_Ary.join(", "));

                    // line1A_Length= res.Data_Ary3.length;
                    // line2B_Length= res.Data_Ary4.length;
                    
                    // line2A_Data=[];
                    // line2A_Time=[];

                    // for (var i = 0; i < line2A_Length; i++)
                    //  {
                    //     // Skip every other row (i.e., push the 1st, 3rd, 5th, etc. rows)
                    //     if (i % 2 === 0) {
                    //         line2A_Data.push(res.Data_Ary3[i]);
                    //         line2A_Time.push(res.Data_Ary4[i]);
                           
                    //         lastEvenNumber=i
                    //     }
                        
                    // }

                     //alert(json_data2);

                
                    //Chart 1
                    const ctx = document.getElementById('myChart');
                     ctx.style.backgroundColor = 'rgba(24, 24, 24, 0.49)';
                    const horizontalLinePlugin = {
                            id: 'horizontalLine',
                            afterDraw: (chart) => {
                                const ctx = chart.ctx;
                                const yValues = [20, 40]; // Y values where lines should be drawn

                                ctx.save();
                                yValues.forEach((yValue) => {
                                    const yPixel = chart.scales.y.getPixelForValue(yValue);
                                    ctx.beginPath();
                                    ctx.moveTo(chart.chartArea.left, yPixel);
                                    ctx.lineTo(chart.chartArea.right, yPixel);
                                    ctx.strokeStyle = 'red'; // Line color
                                    ctx.lineWidth = 3; // Line width
                                    ctx.stroke();
                                });
                                ctx.restore();
                            },

                                };



                                


                            const chart1 = new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels:[20,40,60,80,100],
                                    datasets: [{
                                        label: 'Air Flow',
                                        data: [10,20,30,40,50],
                                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                        borderColor: 'rgb(3, 238, 109)',
                                        borderWidth: 1,
                                        tension: 0.4 
                                        // backgroundColor: ['red', 'blue', 'green', 'purple']
                                    }]
                                },
                                options: 
                                {
                                    responsive: true,

                                    scales: {
                                        x: {
                                            ticks: {
                                                color: 'white', // Color of the x-axis labels
                                            },
                                            grid: {
                                                color: 'rgba(238, 238, 238, 0.42)', // Color of the grid lines for x-axis
                                            }
                                        },

                                        y: {
                                            ticks: {
                                                color: 'white', // Color of the x-axis labels
                                            },
                                            grid: {
                                                color: 'rgba(238, 238, 238, 0.6)', // Color of the grid lines for x-axis
                                            }
                                        }
                                    
                                    
                                    
                                    }
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                },
                                plugins: [horizontalLinePlugin]
                            });



              }); 
              
              
            } 

    
            

    funLoadUsers();
    
  
  

</script>



<?php
        include '../../headers/footer-bar.php'
    ?> 
</div>  
</body>
</html>
