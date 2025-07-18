

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
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

            <div class="" id="main_content">
                <div class="row">
                    <div class="col">

                        <div class="">
                            <div  class="flexbox" id="id_flexbox">
                                <div class="chartBox">
                                    <canvas id="myChart"></canvas>
                                </div>
                                <div class="chartBox" >
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


                <div class="row">
                    <div class="col">

                        <div class="">
                            <div  class="flexbox" id="id_flexbox">

                                <div class="chartBox">
                                    <canvas id="myChart9"></canvas>
                                </div>
                                <div class="chartBox">
                                    <canvas id="myChart10"></canvas>
                                </div>

                                <div class="chartBox">
                                    <canvas id="myChart11"></canvas>
                                </div>

                                <div class="chartBox">
                                    <canvas id="myChart12"></canvas>
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
                                    <canvas id="myChart13"></canvas>
                                </div>
                                <div class="chartBox">
                                    <canvas id="myChart14"></canvas>
                                </div>

                                <div class="chartBox">
                                    <canvas id="myChart15"></canvas>
                                </div>

                                <div class="chartBox">
                                    <canvas id="myChart16"></canvas>
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
                                    <canvas id="myChart17"></canvas>
                                </div>
                                <div class="chartBox">
                                    <canvas id="myChart18"></canvas>
                                </div>

                                <div class="chartBox">
                                    <canvas id="myChart19"></canvas>
                                </div>

                                <div class="chartBox">
                                    <canvas id="myChart20"></canvas>
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
                                    <canvas id="myChart21"></canvas>
                                </div>

                                <div class="chartBox">
                                    <canvas id="myChart22"></canvas>
                                </div>

                                <div class="chartBox">
                                    <canvas id="myChart23"></canvas>
                                </div>

                                <div class="chartBox">
                                    <canvas id="myChart24"></canvas>
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
                                    <canvas id="myChart25"></canvas>
                                </div>

                                <div class="chartBox">
                                    <canvas id="myChart26"></canvas>
                                </div>

                                <div class="chartBox">
                                    <canvas id="myChart27"></canvas>
                                </div>

                                <div class="chartBox">
                                    <canvas id="myChart28"></canvas>
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
                                    <canvas id="myChart29"></canvas>
                                </div>

                                <div class="chartBox">
                                    <canvas id="myChart30"></canvas>
                                </div>

                                <div class="chartBox">
                                    <canvas id="myChart31"></canvas>
                                </div>

                                <div class="chartBox">
                                    <canvas id="myChart32"></canvas>
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
                                    <canvas id="myChart33"></canvas>
                                </div>

                                <div class="chartBox">
                                    <canvas id="myChart34"></canvas>
                                </div>

                                <div class="chartBox">
                                    <canvas id="myChart35"></canvas>
                                </div>

                                <div class="chartBox">
                                    <canvas id="myChart36"></canvas>
                                </div>

                                


                            </div>
                        </div>
                    </div>
                </div>








            </div>















<script>
var ctx = null;
let lineChart = null;
let lineChart2 = null;
let lineChart3 = null;
let lineChart4 = null;
let lineChart5 = null;
let lineChart6 = null;
let lineChart7 = null;
let lineChart8 = null;
let lineChart9 = null;
let lineChart10 = null;
let lineChart11 = null;
let lineChart12 = null;
let lineChart13 = null;
let lineChart14 = null;
let lineChart15 = null;
let lineChart16 = null;
let lineChart17 = null;
let lineChart18 = null;
let lineChart19 = null;
let lineChart20 = null;
let lineChart21 = null;
let lineChart22 = null;
let lineChart23 = null;
let lineChart24 = null;
let lineChart25 = null;
let lineChart26 = null;
let lineChart27 = null;
let lineChart28 = null;
let lineChart29 = null;
let lineChart30 = null;
let lineChart31 = null;
let lineChart32 = null;
let lineChart33 = null;
let lineChart34 = null;
let lineChart35 = null;
let lineChart36 = null;

var min_limit=6500;
var max_limit=7000;
var line4A_Time_count=0;
var line4B_Time_count=0;
var line4B_Data_new;

        function funLoadUsers()
            {
                console.log("ctx ", ctx);
               
               



                //$("#main_content").load(location.href + " #main_content");


            // Loop through each canvas element and clear it
            // canvases.forEach(function(canvas) {
            //     var ctx = canvas.getContext('2d');
            //     ctx.clearRect(0, 0, canvas.width, canvas.height);
            // });




                console.log("Reload:", new Date().toLocaleTimeString()); // Logs time in HH:MM:SS format



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
                   //alert(json_data2);
                   console.log(json_data2)


                   //Chart 1  Array
                   try
                    {
                   
                        Data_Ary=(res.Data_Ary.join(", "));
                        Data_Ary2=(res.Data_Ary2.join(", "));
                        Data_Ary3=(res.Data_Ary3.join(", "));
                        Data_Ary4=(res.Data_Ary4.join(", "));

                        line1A_Length= res.Data_Ary.length;
                    

                        line2B_Length= res.Data_Ary3.length;

                        line1A_Data=[];
                        line1A_Time=[];
                        
                        line1B_Data=[];
                        line1B_Time=[];



                        for (var i = 0; i < line1A_Length; i++)
                        {
                            // Skip every other row (i.e., push the 1st, 3rd, 5th, etc. rows)
                        
                                line1A_Data.push(res.Data_Ary[i]);
                                line1A_Time.push(res.Data_Ary2[i]);
                                line1B_Data.push(res.Data_Ary3[i]);
                                line1B_Time.push(res.Data_Ary4[i]);

                                last_value_Line_1A=i
                                last_value_Line_1B=i
                                last_value_line1B=i;
                            

                        }
                        let max_value_line1A = Math.max(...line1A_Data);
                        let max_value_line1B = Math.max(...line1B_Data);
                    }  
                        catch(err)
                        {
                            console.log(err)
                        }


                        









                  



                     //Chart 2 Array (2A 2B)
                    Data_Ary=(res.Data_Ary5.join(", "));
                    Data_Ary2=(res.Data_Ary6.join(", "));
                    Data_Ary3=(res.Data_Ary7.join(", "));
                    Data_Ary4=(res.Data_Ary8.join(", "));

                    line2A_Length= res.Data_Ary5.length;
                    line2B_Length= res.Data_Ary7.length;


                    line2A_Data=[];
                    line2A_Time=[];
                    line2B_Data=[];
                    line2B_Time=[];

                    for (var i = 0; i < line2A_Length; i++)
                     {
                        
                       
                            line2A_Data.push(res.Data_Ary5[i]);
                            line2A_Time.push(res.Data_Ary6[i]);
                            line2B_Data.push(res.Data_Ary7[i]);
                            line2B_Time.push(res.Data_Ary8[i]);


                            last_value_line2A=i;
                            last_value_line2B=i;
                        




                    }
                    let max_value_line2A = Math.max(...line2A_Data);
                    let max_value_line2B = Math.max(...line2B_Data);
                    //alert(line2A_Data)


                    


                    //Chart 3 Array (3A 3B) (5/2/24)
                    Data_Ary=(res.Data_Ary9.join(", "));
                    Data_Ary2=(res.Data_Ary10.join(", "));
                    Data_Ary3=(res.Data_Ary11.join(", "));
                    Data_Ary4=(res.Data_Ary12.join(", "));

                    line3A_Length= res.Data_Ary9.length;
                    line3B_Length= res.Data_Ary9.length;


                    line3A_Data=[];
                    line3A_Time=[];
                    
                    line3B_Data=[];
                    line3B_Time=[];

                    for (var i = 0; i < line3A_Length; i++)
                     {
                        // Skip every other row (i.e., push the 1st, 3rd, 5th, etc. rows)
                       
                            line3A_Data.push(res.Data_Ary9[i]);
                            line3A_Time.push(res.Data_Ary10[i]);
                            line3B_Data.push(res.Data_Ary11[i]);
                            line3B_Time.push(res.Data_Ary12[i]);


                            last_value_line3A=i;
                            last_value_line3B=i;
                        
                    }
                   // alert(last_value_line3A)
                    let max_value_line3A = Math.max(...line3A_Data);
                    let max_value_line3B = Math.max(...line3B_Data);





                    //Chart 4 Array (4A) (5/2/24)
                    Data_Ary=(res.Data_Ary13.join(", "));
                    Data_Ary2=(res.Data_Ary14.join(", "));
                    Data_Ary3=(res.Data_Ary15.join(", "));
                    Data_Ary4=(res.Data_Ary16.join(", "));
                    var New_B=[];

                    line4A_Length= res.Data_Ary13.length;
                    line4B_Length= res.Data_Ary15.length;


                    line4A_Data=[];
                    line4A_Time=[];

                    line4B_Data=[];
                    line4B_Time=[];
                    console.log(line4A_Length);
                    console.log(line4B_Length);
                    

                    for (var i = 0; i < line4A_Length; i++)
                     {
                        // Skip every other row (i.e., push the 1st, 3rd, 5th, etc. rows)
                       
                            line4A_Data.push(res.Data_Ary13[i]);
                            line4A_Time.push(res.Data_Ary14[i]);
                            last_value_line4A=i;
                    }

                    for (var i = 0; i < line4B_Length; i++)
                     {
                        line4B_Data.push(res.Data_Ary15[i]);
                        line4B_Time.push(res.Data_Ary16[i]);
                        last_value_line4B=i;
                     }
                    




                    //alert(last_value_line 4)
                    let max_value_line4A = Math.max(...line4A_Data);
                    let max_value_line4B = Math.max(...line4A_Data);

                    New_B=line4B_Data;


                    // var hour;
                    // var min;
                   // console.log("line4A_Time.length "+line4A_Time.length);
                   // console.log("line4B_Time.length "+line4B_Time.length);

                   try{

                    for(var x=0;x<line4A_Time.length;x++){
                        
                        console.log(" ");
                        Time=line4A_Time[x];
                        let h = Time.split(":"); // Splitting the input string
                        let hour =parseInt(h[0]); 
                        let min = parseInt(h[1]);
                        console.log("Time A "+hour+":"+min);
                        
                    

                    for(var a=0;a<line4B_Time.length;a++){
                        var Time2=line4B_Time[a];
                        let h2 = Time2.split(":"); // Splitting the input string
                        let hour2 =parseInt(h2[0]); 
                        let min2 = parseInt(h2[1]);
                        
                        var diff_Hour=parseInt(hour2-hour);
                        var diff_min=parseInt(min2-min);
                       // console.log("diff_Hour "+diff_Hour);
                        console.log("diff_min "+line4A_Time[x]+" "+line4B_Time[a]+" "+diff_min);


                        if (diff_Hour == 0 && diff_min >= 0 && diff_min < 3 || diff_Hour == 0 && diff_min < 0 && diff_min > -3 ) {
                            //  || diff_Hour == 0 && diff_min < 0 && diff_min > -3 
                            // console.log("greater than 0 and less than 2 minutes");
                            //console.log("Time :"+Time+" Time 2 "+ Time2);
                        New_B[x]=line4B_Data[a];
                    }
                

                                              

                    }

                }
                console.log(New_B)
            }
            catch(err){

                console.log("Error 4 : "+err)
                New_B=line4B_Data;
                console.log(line4A_Data);
                console.log(line4A_Time);
                console.log(" ");

                console.log(line4B_Data);
                console.log(line4B_Time);
            }







                    


                   

                    //Chart 5 Array (5A) (6/2/24)
                    Data_Ary=(res.Data_Ary17.join(", "));
                    Data_Ary2=(res.Data_Ary18.join(", "));
                    Data_Ary3=(res.Data_Ary19.join(", "));
                    Data_Ary4=(res.Data_Ary20.join(", "));

                    line5A_Length= res.Data_Ary17.length;
                    line5B_Length= res.Data_Ary19.length;


                    line5A_Data=[];
                    line5A_Time=[];
                    line5B_Data=[];
                    line5B_Time=[];

                    for (var i = 0; i < line5A_Length; i++)
                     {
                        
                            line5A_Data.push(res.Data_Ary17[i]);
                            line5A_Time.push(res.Data_Ary18[i]);
                            line5B_Data.push(res.Data_Ary19[i]);
                            line5B_Time.push(res.Data_Ary20[i]);


                            last_value_line5A=i;
                            last_value_line5B=i;
                        




                    }

                    let max_value_line5A = Math.max(...line5A_Data);
                    let max_value_line5B = Math.max(...line5B_Data);
                   
                   

                    //Chart 6 Array (6A) (6/2/24)
                    Data_Ary=(res.Data_Ary21.join(", "));
                    Data_Ary2=(res.Data_Ary22.join(", "));
                    Data_Ary3=(res.Data_Ary23.join(", "));
                    Data_Ary4=(res.Data_Ary24.join(", "));

                    var New_6B=[];

                    line6A_Length= res.Data_Ary21.length;
                    line6B_Length= res.Data_Ary23.length;


                    line6A_Data=[];
                    line6A_Time=[];
                    line6B_Data=[];
                    line6B_Time=[];

                    for (var i = 0; i < line6A_Length; i++)
                     {
                     
                            line6A_Data.push(res.Data_Ary21[i]);
                            line6A_Time.push(res.Data_Ary22[i]);
                            last_value_line6A=i;
                       
                    }

                    for (var i = 0; i < line6B_Length; i++)
                    {
                        line6B_Data.push(res.Data_Ary23[i]);
                        line6B_Time.push(res.Data_Ary24[i]);
                        last_value_line6B=i;   

                    }




                    let max_value_line6A = Math.max(...line6A_Data);
                    let max_value_line6B = Math.max(...line6B_Data);


                    try{

                        for(var x=0;x<line6A_Data.length;x++){
                            
                            console.log(" ");
                            Time=line6A_Time[x];
                            let h = Time.split(":"); // Splitting the input string
                            let hour =parseInt(h[0]); 
                            let min = parseInt(h[1]);
                            console.log("Time A "+hour+":"+min);
                            


                        for(var a=0;a<line6B_Time.length;a++){
                            var Time2=line6B_Time[a];
                            let h2 = Time2.split(":"); // Splitting the input string
                            let hour2 =parseInt(h2[0]); 
                            let min2 = parseInt(h2[1]);
                            
                            var diff_Hour=parseInt(hour2-hour);
                            var diff_min=parseInt(min2-min);
                        // console.log("diff_Hour "+diff_Hour);
                            console.log("diff_min "+line6A_Time[x]+" "+line6B_Time[a]+" "+diff_min);


                            if (diff_Hour == 0 && diff_min >= 0 && diff_min < 4 || diff_Hour == 0 && diff_min < 0 && diff_min > -3 ) {
                                //  || diff_Hour == 0 && diff_min < 0 && diff_min > -3 
                                // console.log("greater than 0 and less than 2 minutes");
                                //console.log("Time :"+Time+" Time 2 "+ Time2);
                            New_6B[x]=line4B_Data[a];
                        }


                                                

                        }

                        }
                        console.log(New_B)
                        }
                    catch(err){

                        console.log("Error 6B: "+err)
                        //New_6B=line6B_Data;
                        console.log(line6A_Data);
                        console.log(line6A_Time);
                        
                        console.log(line6A_Length);
                        console.log(line6B_Length);
                        

                        console.log(line6B_Data);
                        console.log(line6B_Time);
                        console.log(" ");
                        }


                    

                
                 

                    //Chart 7 Array (7A) (6/2/24)
                    Data_Ary=(res.Data_Ary25.join(", "));
                    Data_Ary2=(res.Data_Ary26.join(", "));
                    Data_Ary3=(res.Data_Ary27.join(", "));
                    Data_Ary4=(res.Data_Ary28.join(", "));

                    line7A_Length= res.Data_Ary25.length;
                    line7B_Length= res.Data_Ary27.length;


                    line7A_Data=[];
                    line7A_Time=[];
                    line7B_Data=[];
                    line7B_Time=[];

                    for (var i = 0; i < line7A_Length; i++)
                     {
                        
                            line7A_Data.push(res.Data_Ary25[i]);
                            line7A_Time.push(res.Data_Ary26[i]);
                            line7B_Data.push(res.Data_Ary27[i]);
                            line7B_Time.push(res.Data_Ary28[i]);


                            last_value_line7A=i;
                            last_value_line7B=i;
                        




                    }

                    let max_value_line7A = Math.max(...line7A_Data);
                    let max_value_line7B = Math.max(...line7B_Data);

                 


                    //Chart 8 Array (8A) (6/2/24)
                    Data_Ary=(res.Data_Ary29.join(", "));
                    Data_Ary2=(res.Data_Ary30.join(", "));
                    Data_Ary3=(res.Data_Ary31.join(", "));
                    Data_Ary4=(res.Data_Ary32.join(", "))

                    line8A_Length= res.Data_Ary29.length;
                    line8B_Length= res.Data_Ary31.length;


                    line8A_Data=[];
                    line8A_Time=[];
                    line8B_Data=[];
                    line8B_Time=[];

                    for (var i = 0; i < line8A_Length; i++)
                     {
                        
                            line8A_Data.push(res.Data_Ary29[i]);
                            line8A_Time.push(res.Data_Ary30[i]);
                            line8B_Data.push(res.Data_Ary31[i]);
                            line8B_Time.push(res.Data_Ary32[i]);


                            last_value_line8A=i;
                            last_value_line8B=i;
                        




                    }

                    let max_value_line8A = Math.max(...line8A_Data);
                    let max_value_line8B = Math.max(...line8B_Data);



                    //Chart 9 Array (9A) (6/2/24)
                    Data_Ary=(res.Data_Ary33.join(", "));
                    Data_Ary2=(res.Data_Ary34.join(", "));
                    Data_Ary3=(res.Data_Ary35.join(", "));
                    Data_Ary4=(res.Data_Ary36.join(", "));

                    line9A_Length= res.Data_Ary31.length;
                    line9B_Length= res.Data_Ary35.length;



                    line9A_Data=[];
                    line9A_Time=[];
                    line9B_Data=[];
                    line9B_Time=[];

                    for (var i = 0; i < line9A_Length; i++)
                     {
                        // Skip every other row (i.e., push the 1st, 3rd, 5th, etc. rows)
                        if (i % 2 === 0) {
                            line9A_Data.push(res.Data_Ary33[i]);
                            line9A_Time.push(res.Data_Ary34[i]);
                            line9B_Data.push(res.Data_Ary35[i]);
                            line9B_Time.push(res.Data_Ary36[i]);


                            last_value_line9A=i;
                            last_value_line9B=i;
                        }




                    }

                    let max_value_line9A = Math.max(...line9A_Data);
                    let max_value_line9B = Math.max(...line9B_Data);

                   



                    //Chart 10 Array (10A) (6/2/24)
                    Data_Ary=(res.Data_Ary37.join(", "));
                    Data_Ary2=(res.Data_Ary38.join(", "));
                    Data_Ary3=(res.Data_Ary39.join(", "));
                    Data_Ary4=(res.Data_Ary40.join(", "));

                    line10A_Length= res.Data_Ary37.length;
                    line10B_Length= res.Data_Ary39.length;



                    line10A_Data=[];
                    line10A_Time=[];
                    line10B_Data=[];
                    line10B_Time=[];

                    for (var i = 0; i < line10A_Length; i++)
                     {
                        // Skip every other row (i.e., push the 1st, 3rd, 5th, etc. rows)
                        
                            line10A_Data.push(res.Data_Ary37[i]);
                            line10A_Time.push(res.Data_Ary38[i]);
                            line10B_Data.push(res.Data_Ary39[i]);
                            line10B_Time.push(res.Data_Ary40[i]);


                            last_value_line10A=i;
                            last_value_line10B=i;
                        

                    }

                    let max_value_line10A = Math.max(...line10A_Data);
                    let max_value_line10B = Math.max(...line10B_Data);

                   

                    //Chart 11 Array (11A) (17/2/24)
                    Data_Ary=(res.Data_Ary41.join(", "));
                    Data_Ary2=(res.Data_Ary42.join(", "));
                    Data_Ary3=(res.Data_Ary43.join(", "));
                    Data_Ary4=(res.Data_Ary44.join(", "));

                    line11A_Length= res.Data_Ary41.length;
                    line11B_Length= res.Data_Ary43.length;


                    line11A_Data=[];
                    line11A_Time=[];
                    
                    line11B_Data=[];
                    line11B_Time=[]

                    for (var i = 0; i < line11A_Length; i++)
                     {
                       
                      
                            line11A_Data.push(res.Data_Ary41[i]);
                            line11A_Time.push(res.Data_Ary42[i]);
                            line11B_Data.push(res.Data_Ary43[i]);
                            line11B_Time.push(res.Data_Ary44[i]);


                            last_value_line11A=i;
                            last_value_line11B=i;
                        


                    }

                    let max_value_line11A = Math.max(...line11A_Data);
                    let max_value_line11B = Math.max(...line11B_Data);

                   
                    //Chart 12 Array (12A) (18/2/24)
                    Data_Ary=(res.Data_Ary45.join(", "));
                    Data_Ary2=(res.Data_Ary46.join(", "));
                    Data_Ar3=(res.Data_Ary47.join(", "));
                    Data_Ary4=(res.Data_Ary48.join(", "));

                    line12A_Length= res.Data_Ary45.length;
                    line12B_Length= res.Data_Ary47.length;


                    line12A_Data=[];
                    line12A_Time=[];
                    line12B_Data=[];
                    line12B_Time=[];

                    for (var i = 0; i < line12A_Length; i++)
                     {
                       
                            line12A_Data.push(res.Data_Ary45[i]);
                            line12A_Time.push(res.Data_Ary46[i]);
                            line12B_Data.push(res.Data_Ary47[i]);
                            line12B_Time.push(res.Data_Ary48[i]);


                            last_value_line12A=i;
                            last_value_line12B=i;
                        
                    }

                    let max_value_line12A = Math.max(...line12A_Data);
                    let max_value_line12B = Math.max(...line12B_Data);

                  
                 


                    //Chart 13 Array (13A) (18/2/24)
                    Data_Ary=(res.Data_Ary49.join(", "));
                    Data_Ary2=(res.Data_Ary50.join(", "));
                    Data_Ary3=(res.Data_Ary51.join(", "));
                    Data_Ary4=(res.Data_Ary52.join(", "));

                    line13A_Length= res.Data_Ary49.length;
                    line13B_Length= res.Data_Ary51.length;


                    line13A_Data=[];
                    line13A_Time=[];
                    line13B_Data=[];
                    line13B_Time=[];

                    for (var i = 0; i < line13A_Length; i++)
                     {
                       
                            line13A_Data.push(res.Data_Ary49[i]);
                            line13A_Time.push(res.Data_Ary50[i]);
                            line13B_Data.push(res.Data_Ary51[i]);
                            line13B_Time.push(res.Data_Ary52[i]);
                            
                            last_value_line13A=i;
                            last_value_line13B=i;
                     
                    }

                    let max_value_line13A = Math.max(...line13A_Data);
                    let max_value_line13B = Math.max(...line13B_Data);



                    //Chart 14 Array (14A) (18/2/24)
                    Data_Ary=(res.Data_Ary53.join(", "));
                    Data_Ary2=(res.Data_Ary54.join(", "));
                    Data_Ary=(res.Data_Ary55.join(", "));
                    Data_Ary2=(res.Data_Ary56.join(", "));
                    

                    line14A_Length= res.Data_Ary53.length;
                    line14B_Length= res.Data_Ary55.length;
                    
                    line14A_Data=[];
                    line14A_Time=[];
                    line14B_Data=[];
                    line14B_Time=[];

                    for (var i = 0; i < line14A_Length; i++)
                     {
                       
                            line14A_Data.push(res.Data_Ary53[i]);
                            line14A_Time.push(res.Data_Ary54[i]);
                            line14B_Data.push(res.Data_Ary55[i]);
                            line14B_Time.push(res.Data_Ary56[i]);


                            last_value_line14A=i;
                            last_value_line14B=i;
                    

                    }

                    let max_value_line14A = Math.max(...line14A_Data);
                    let max_value_line14B = Math.max(...line14B_Data);


                  

               


                    //Chart 15 Array (15A) (18/2/24)
                    Data_Ary=(res.Data_Ary57.join(", "));
                    Data_Ary2=(res.Data_Ary58.join(", "));
                    Data_Ary=(res.Data_Ary59.join(", "));
                    Data_Ary2=(res.Data_Ary60.join(", "));

                    line15A_Length= res.Data_Ary57.length;
                    line15B_Length= res.Data_Ary59.length;


                    line15A_Data=[];
                    line15A_Time=[];
                    line15B_Data=[];
                    line15B_Time=[];

                    for (var i = 0; i < line15A_Length; i++)
                     {
                       
                            line15A_Data.push(res.Data_Ary57[i]);
                            line15A_Time.push(res.Data_Ary58[i]);
                            line15B_Data.push(res.Data_Ary59[i]);
                            line15B_Time.push(res.Data_Ary60[i]);


                            last_value_line15A=i;
                            last_value_line15B=i;
                        




                    }

                    let max_value_line15A = Math.max(...line15A_Data);
                    let max_value_line15B = Math.max(...line15B_Data);


                   
               
                   


                    //Chart 16 Array (16A) (18/2/24)
                    Data_Ary=(res.Data_Ary61.join(", "));
                    Data_Ary2=(res.Data_Ary62.join(", "));
                    Data_Ary3=(res.Data_Ary63.join(", "));
                    Data_Ary4=(res.Data_Ary64.join(", "));
                    

                    line16A_Length= res.Data_Ary61.length;
                    line16B_Length= res.Data_Ary63.length;


                    line16A_Data=[];
                    line16A_Time=[];
                    line16B_Data=[];
                    line16B_Time=[];

                    for (var i = 0; i < line16A_Length; i++)
                     {
                        
                            line16A_Data.push(res.Data_Ary61[i]);
                            line16A_Time.push(res.Data_Ary62[i]);
                            line16B_Data.push(res.Data_Ary63[i]);
                            line16B_Time.push(res.Data_Ary64[i]);


                            last_value_line16A=i;
                            last_value_line16B=i;
                        




                    }

                    let max_value_line16A = Math.max(...line16A_Data);
                    let max_value_line16B = Math.max(...line16B_Data);


                    
                  


                    //Chart 17 Array (17A) (18/2/24)
                    Data_Ary=(res.Data_Ary65.join(", "));
                    Data_Ary2=(res.Data_Ary66.join(", "));
                    Data_Ary=(res.Data_Ary67.join(", "));
                    Data_Ary2=(res.Data_Ary68.join(", "));

                    line17A_Length= res.Data_Ary65.length;
                    line17B_Length= res.Data_Ary67.length;


                    line17A_Data=[];
                    line17A_Time=[];
                    line17B_Data=[];
                    line17B_Time=[];

                    for (var i = 0; i < line17A_Length; i++)
                     {
                        // Skip every other row (i.e., push the 1st, 3rd, 5th, etc. rows)
                        
                            line17A_Data.push(res.Data_Ary65[i]);
                            line17A_Time.push(res.Data_Ary66[i]);
                            line17B_Data.push(res.Data_Ary67[i]);
                            line17B_Time.push(res.Data_Ary68[i]);


                            last_value_line17A=i;
                            last_value_line17B=i;
                        




                    }

                    let max_value_line17A = Math.max(...line17A_Data);
                    let max_value_line17B = Math.max(...line17B_Data);


                    


          


                 
                 

                    //Chart 18 Array (18A) (18/2/24)
                    Data_Ary=(res.Data_Ary69.join(", "));
                    Data_Ary2=(res.Data_Ary70.join(", "));
                    Data_Ary3=(res.Data_Ary71.join(", "));
                    Data_Ary4=(res.Data_Ary72.join(", "));
                    

                    line18A_Length= res.Data_Ary69.length;
                    line18B_Length= res.Data_Ary71.length;

                    line18A_Data=[];
                    line18A_Time=[];
                    line18B_Data=[];
                    line18B_Time=[];

                    for (var i = 0; i < line18A_Length; i++)
                     {
                        // Skip every other row (i.e., push the 1st, 3rd, 5th, etc. rows)
                        if (i % 2 === 0) {
                            line18A_Data.push(res.Data_Ary69[i]);
                            line18A_Time.push(res.Data_Ary70[i]);
                            line18B_Data.push(res.Data_Ary71[i]);
                            line18B_Time.push(res.Data_Ary72[i]);


                            last_value_line18A=i;
                            last_value_line18B=i;
                        }




                    }

                    let max_value_line18A = Math.max(...line18A_Data);
                  



               




                   
                    








                        //////////////////////////////////
                          // Check if a chart instance already exists



                        //await waitforme(1000);

                       // await delay(1000);


                 //Chart JS

                
                    //Chart 1
                    const ctx = document.getElementById('myChart');
                    ctx.style.backgroundColor = 'rgba(24, 24, 24, 0.71)';

          
                       
                    if (lineChart) {
                        lineChart.destroy(); // Destroy existing chart
                    }

                        
                        
                     lineChart = new Chart(ctx, {
                        
                    type: 'line', // Line chart type
                    data:
                    {
                        labels: line1A_Time, // X-axis labels
                        datasets:
                            [{
                                label: 'Line 1A',
                                data: line1A_Data,
                                borderColor: 'rgb(255, 255, 255)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:0.1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            },
                            {
                                label: 'Line 1B',
                                data: line1B_Data,
                                borderColor: 'rgb(0, 255, 8)', // Line2 color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:0.1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            },
                        
                        
                        
                        ]
                    },

                    
                     options:
                    {
                        animation: {
                            duration: 0
                        },
                        animation: {
                            duration: 0
                        },
                        

                        maintainAspectRatio: false,
                        responsive: true,

                        plugins:
                        {
                            legend:
                            {
                                labels:
                                {
                                    color: 'white', // Legend labels color
                                
                                    font: {
                                    size: 10 // Optional: Change font size
                                    }

                                   
                                }
                            },

                            title:
                            {
                                display: true, // Display the title
                                text: 'Line 1', // Title text
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
                                    max: 7500,
                                    min:6400,
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
                                            { yValue:min_limit , color: 'red' },
                                            { yValue:max_limit, color: 'red' }
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

                 if (lineChart2) {
                    lineChart2.destroy(); // Destroy existing chart
                }


                    lineChart2 = new Chart(ctx2, {
                    type: 'line', // Line chart type
                    data:
                    {
                        labels: line1B_Time, // X-axis labels
                        datasets:
                            [{
                                label: 'Line 2A',
                                data: line2A_Data,
                                borderColor: 'rgb(255, 255, 255)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:0.1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            },
                            {
                                label: 'Line 2B',
                                data: line2B_Data,
                                borderColor: 'rgb(0, 255, 8)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:0.1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            },
                        
                        ]
                    },
                     options:
                    {
                        animation: {
                            duration: 0
                        },
                        maintainAspectRatio: false,
                        responsive: true,
                        plugins:
                        {
                            legend:
                            {
                                labels:
                                {
                                    color: 'white', // Legend labels color
                                
                                    font: {
                                    size: 10 // Optional: Change font size
                                    }

                                   
                                }
                            },

                            title:
                            {
                                display: true, // Display the title
                                text: 'Line 2', // Title text
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
                                    max: 7500,
                                    min:6400,
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
                                            { yValue: min_limit, color: 'red' },
                                            { yValue: max_limit, color: 'red' }
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
    
                    if (lineChart3) {
                        lineChart3.destroy(); // Destroy existing chart
                    }

                     lineChart3 = new Chart(ctx3, {
                    type: 'line', // Line chart type
                    data:
                    {
                        labels: line3A_Time, // X-axis labels
                        datasets:
                            [{
                                label: 'Air Flow',
                                data: line3A_Data,
                                borderColor: 'rgb(255, 255, 255)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:0.1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            }
                            ,
                            {
                                label: 'Air Flow',
                                data: line3B_Data,
                                borderColor: 'rgb(0, 255, 8)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:0.1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            }
                        
                        ]
                    },
                     options:
                    {
                        animation: {
                            duration: 0
                        },
                        maintainAspectRatio: false,
                        responsive: true,
                        plugins:
                        {
                            legend:
                            {
                                labels:
                                {
                                    color: 'white', // Legend labels color
                                
                                    font: {
                                    size: 10 // Optional: Change font size
                                    }

                                   
                                }
                            },

                            title:
                            {
                                display: true, // Display the title
                                text: 'Line 3', // Title text
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
                                    max: 7500,
                                    min:6400,
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
                                            { yValue:min_limit , color: 'red' },
                                            { yValue:max_limit, color: 'red' }
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
                 var time_arr=[...line4B_Time,...line6B_Time];
                 time_arr=time_arr.sort();
                // alert(time_arr.sort())
                //alert(time_arr.length);





                //Chart 4 (Line 4A )
                    const ctx4 = document.getElementById('myChart4');
                    ctx4.style.backgroundColor = 'rgba(24, 24, 24, 0.71)';
                   // line6B_Data=[7000,7000,7000,7000]


                    if (lineChart4) {
                        lineChart4.destroy(); // Destroy existing chart
                    }
                     lineChart4 = new Chart(ctx4, {
                    type: 'line', // Line chart type
                    data:
                    {
                       
                        labels: line4A_Time,
                        datasets:
                            [{
                                label: 'Air Flow',
                                data: line4A_Data,
                                borderColor: 'rgb(255, 255, 255)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            },
                           
                            {
                                label: 'Air Flow',
                                data: New_B,
                                borderColor: 'rgb(0, 255, 8)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            }
                        
                        
                        ]
                    },
                     options:
                    {
                        animation: {
                            duration: 0
                        },
                        maintainAspectRatio: false,
                        responsive: true,
                        plugins:
                        {
                            legend:
                            {
                                labels:
                                {
                                    color: 'white', // Legend labels color
                                
                                    font: {
                                    size: 10 // Optional: Change font size
                                    }

                                   
                                }
                            },

                            title:
                            {
                                display: true, // Display the title
                                text: 'Line 4', // Title text
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
                                    max: 7500,
                                    min:6400,
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
                                            { yValue:min_limit , color: 'red' },
                                            { yValue:max_limit, color: 'red' }
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

    
                    if (lineChart5) {
                        lineChart5.destroy(); // Destroy existing chart
                    }
                     lineChart5 = new Chart(ctx5, {
                    type: 'line', // Line chart type
                    data:
                    {
                        labels: line3A_Time, // X-axis labels
                        datasets:
                            [{
                                label: 'Air Flow',
                                data: line5A_Data,
                                borderColor: 'rgb(255, 255, 255)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:0.1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            },
                            {
                                label: 'Air Flow',
                                data: line5A_Data,
                                borderColor: 'rgb(0, 255, 8)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:0.1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            }
                        ]
                    },
                     options:
                    {
                        animation: {
                            duration: 0
                        },
                        maintainAspectRatio: false,
                        responsive: true,
                        plugins:
                        {
                            legend:
                            {
                                labels:
                                {
                                    color: 'white', // Legend labels color
                                
                                    font: {
                                    size: 10 // Optional: Change font size
                                    }

                                   
                                }
                            },

                            title:
                            {
                                display: true, // Display the title
                                text: 'Line 5', // Title text
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
                                    max: 7500,
                                    min:6400,
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
                                            { yValue:min_limit , color: 'red' },
                                            { yValue:max_limit, color: 'red' }
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




                //Chart 6 (Line 6A)
                const ctx6 = document.getElementById('myChart6');
                    ctx6.style.backgroundColor = 'rgba(24, 24, 24, 0.71)';

    
                    if (lineChart6) {
                        lineChart6.destroy(); // Destroy existing chart
                    }
                     lineChart6 = new Chart(ctx6, {
                    type: 'line', // Line chart type
                    data:
                    {
                        labels: line6A_Time, // X-axis labels
                        datasets:
                            [{
                                label: 'Air Flow',
                                data: line6A_Data,
                                borderColor: 'rgb(255, 255, 255)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:0.1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            },
                            {
                                label: 'Air Flow',
                                data: New_6B,
                                borderColor: 'rgb(0, 255, 8)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:0.1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            },
                            
                        ]
                    },
                     options:
                    {
                        animation: {
                            duration: 0
                        },
                        maintainAspectRatio: false,
                        responsive: true,
                        plugins:
                        {
                            legend:
                            {
                                labels:
                                {
                                    color: 'white', // Legend labels color
                                
                                    font: {
                                    size: 10 // Optional: Change font size
                                    }

                                   
                                }
                            },

                            title:
                            {
                                display: true, // Display the title
                                text: 'Line 6', // Title text
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
                                    max: 7500,
                                    min:6400,
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
                                    ctx.fillText(res.Data_Ary21[last_value_line6A]+' Pa', chart.width - 10, 30); // Adjust position as needed
                                    ctx.restore();
                                }

                                ,id: 'horizontalLine', // Combine logic under a single plugin
                                    afterDraw: (chart) =>
                                    {
                                        const ctx = chart.ctx;

                                          // Horizontal lines data
                                        const lines = [
                                            { yValue:min_limit , color: 'red' },
                                            { yValue:max_limit, color: 'red' }
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
    
                    if (lineChart7) {
                        lineChart7.destroy(); // Destroy existing chart
                    }

                     lineChart7 = new Chart(ctx7, {
                    type: 'line', // Line chart type
                    data:
                    {
                        labels: line4A_Time, // X-axis labels
                        datasets:
                            [{
                                label: 'Air Flow',
                                data: line7A_Data,
                                borderColor: 'rgb(255, 255, 255)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:0.1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            },
                            {
                                label: 'Air Flow',
                                data: line7B_Data,
                                borderColor: 'rgb(0, 255, 8)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:0.1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            }
                        ]
                    },
                     options:
                    {
                        animation: {
                            duration: 0
                        },
                        maintainAspectRatio: false,
                        responsive: true,
                        plugins:
                        {
                            legend:
                            {
                                labels:
                                {
                                    color: 'white', // Legend labels color
                                
                                    font: {
                                    size: 10 // Optional: Change font size
                                    }

                                   
                                }
                            },

                            title:
                            {
                                display: true, // Display the title
                                text: 'Line 7', // Title text
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
                                    max: 7500,
                                    min:6400,
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
                                            { yValue:min_limit , color: 'red' },
                                            { yValue:max_limit, color: 'red' }
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
    
                    if (lineChart8) {
                        lineChart8.destroy(); // Destroy existing chart
                    }

                     lineChart8 = new Chart(ctx8, {
                    type: 'line', // Line chart type
                    data:
                    {
                        labels: line8A_Time, // X-axis labels
                        datasets:
                            [{
                                label: 'Air Flow',
                                data: line8A_Data,
                                borderColor: 'rgb(255, 255, 255)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:0.1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            },
                            {
                                label: 'Air Flow',
                                data:line8B_Data ,
                                borderColor: 'rgb(0, 255, 8)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:0.1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            }
                        ]
                    },
                     options:
                    {
                        animation: {
                            duration: 0
                        },
                        maintainAspectRatio: false,
                        responsive: true,
                        plugins:
                        {
                            legend:
                            {
                                labels:
                                {
                                    color: 'white', // Legend labels color
                                
                                    font: {
                                    size: 10 // Optional: Change font size
                                    }

                                   
                                }
                            },

                            title:
                            {
                                display: true, // Display the title
                                text: 'Line 8', // Title text
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
                                    max: 7500,
                                    min:6400,
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
                                    ctx.fillText(res.Data_Ary29[last_value_line8A]+' Pa', chart.width - 10, 30); // Adjust position as needed
                                    ctx.restore();
                                }

                                ,id: 'horizontalLine', // Combine logic under a single plugin
                                    afterDraw: (chart) =>
                                    {
                                        const ctx = chart.ctx;

                                          // Horizontal lines data
                                        const lines = [
                                            { yValue:min_limit , color: 'red' },
                                            { yValue:max_limit, color: 'red' }
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


                //Chart 9 (Line 5A)
                const ctx9 = document.getElementById('myChart9');
                ctx9.style.backgroundColor = 'rgba(24, 24, 24, 0.71)';
    
                    if (lineChart9) {
                        lineChart9.destroy(); // Destroy existing chart
                    }

                     lineChart9 = new Chart(ctx9, {
                    type: 'line', // Line chart type
                    data:
                    {
                        labels: line5A_Time, // X-axis labels
                        datasets:
                            [{
                                label: 'Air Flow',
                                data: line9A_Data,
                                borderColor: 'rgb(255, 255, 255)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:0.1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            },
                            {
                                label: 'Air Flow',
                                data: line9B_Data,
                                borderColor: 'rgb(0, 255, 8)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:0.1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            }
                        
                        ]
                    },
                     options:
                    {
                        animation: {
                            duration: 0
                        },
                        maintainAspectRatio: false,
                        responsive: true,
                        plugins:
                        {
                            legend:
                            {
                                labels:
                                {
                                    color: 'white', // Legend labels color
                                
                                    font: {
                                    size: 10 // Optional: Change font size
                                    }

                                   
                                }
                            },

                            title:
                            {
                                display: true, // Display the title
                                text: 'Line 9', // Title text
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
                                    max: 7500,
                                    min:6400,
                                    
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
                                    ctx.fillText(res.Data_Ary17[last_value_line5A]+' Pa', chart.width - 10, 30); // Adjust position as needed
                                    ctx.restore();
                                }

                                ,id: 'horizontalLine', // Combine logic under a single plugin
                                    afterDraw: (chart) =>
                                    {
                                        const ctx = chart.ctx;

                                        // Horizontal lines data
                                        const lines = [
                                            { yValue: min_limit, color: 'red' },
                                            { yValue: max_limit, color: 'red' }
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



                 //Chart 10 (Line 5B)
                 const ctx10 = document.getElementById('myChart10');
                    ctx10.style.backgroundColor = 'rgba(24, 24, 24, 0.71)';

    
                    if (lineChart10) {
                        lineChart10.destroy(); // Destroy existing chart
                    }
                     lineChart10 = new Chart(ctx10, {
                    type: 'line', // Line chart type
                    data:
                    {
                        labels: line10A_Time, // X-axis labels
                        datasets:
                            [{
                                label: 'Air Flow',
                                data: line10A_Data,
                                borderColor: 'rgb(255, 255, 255)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:0.1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            },
                            {
                                label: 'Air Flow',
                                data: line10B_Data,
                                borderColor: 'rgb(0, 255, 8)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:0.1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            }
                        ]
                    },
                     options:
                    {
                        animation: {
                            duration: 0
                        },
                        maintainAspectRatio: false,
                        responsive: true,
                        plugins:
                        {
                            legend:
                            {
                                labels:
                                {
                                    color: 'white', // Legend labels color
                                
                                    font: {
                                    size: 10 // Optional: Change font size
                                    }

                                   
                                }
                            },

                            title:
                            {
                                display: true, // Display the title
                                text: 'Line 10', // Title text
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
                                    max: 7500,
                                    min:6400,
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
                                    ctx.fillText(res.Data_Ary37[last_value_line10A]+' Pa', chart.width - 10, 30); // Adjust position as needed
                                    ctx.restore();
                                }

                                ,id: 'horizontalLine', // Combine logic under a single plugin
                                    afterDraw: (chart) =>
                                    {
                                        const ctx = chart.ctx;

                                        // Horizontal lines data
                                        const lines = [
                                            { yValue: min_limit, color: 'red' },
                                            { yValue: max_limit, color: 'red' }
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


                //Chart 11 (Line 6A)
                const ctx11 = document.getElementById('myChart11');
                    ctx11.style.backgroundColor = 'rgba(24, 24, 24, 0.71)';
    
                    if (lineChart11) {
                        lineChart11.destroy(); // Destroy existing chart
                    }

                     lineChart11 = new Chart(ctx11, {
                    type: 'line', // Line chart type
                    data:
                    {
                        labels: line6A_Time, // X-axis labels
                        datasets:
                            [{
                                label: 'Air Flow',
                                data: line11A_Data,
                                borderColor: 'rgb(255, 255, 255)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:0.1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            },
                            {
                                label: 'Air Flow',
                                data: line11B_Data,
                                borderColor: 'rgb(0, 255, 8)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:0.1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            }
                        ]
                    },
                     options:
                    {
                        animation: {
                            duration: 0
                        },
                        maintainAspectRatio: false,
                        responsive: true,
                        plugins:
                        {
                            legend:
                            {
                                labels:
                                {
                                    color: 'white', // Legend labels color
                                
                                    font: {
                                    size: 10 // Optional: Change font size
                                    }

                                   
                                }
                            },

                            title:
                            {
                                display: true, // Display the title
                                text: 'Line 11', // Title text
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
                                    max: 7500,
                                    min:6400,
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
                                    ctx.fillText(res.Data_Ary21[last_value_line6A]+' Pa', chart.width - 10, 30); // Adjust position as needed
                                    ctx.restore();
                                }

                                ,id: 'horizontalLine', // Combine logic under a single plugin
                                    afterDraw: (chart) =>
                                    {
                                        const ctx = chart.ctx;

                                          // Horizontal lines data
                                        const lines = [
                                            { yValue:min_limit , color: 'red' },
                                            { yValue:max_limit, color: 'red' }
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


                //Chart 12 (Line 6B)
                const ctx12 = document.getElementById('myChart12');
                    ctx12.style.backgroundColor = 'rgba(24, 24, 24, 0.71)';

    
                    if (lineChart12) {
                        lineChart12.destroy(); // Destroy existing chart
                    }
                     lineChart12 = new Chart(ctx12, {
                    type: 'line', // Line chart type
                    data:
                    {
                        labels: line12A_Time, // X-axis labels
                        datasets:
                            [{
                                label: 'Air Flow',
                                data: line12A_Data,
                                borderColor: 'rgb(255, 255, 255)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:0.1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            },
                            {
                                label: 'Air Flow',
                                data: line12B_Data,
                                borderColor: 'rgb(0, 255, 8)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:0.1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            }
                        ]
                    },
                     options:
                    {
                        animation: {
                            duration: 0
                        },
                        maintainAspectRatio: false,
                        responsive: true,
                        plugins:
                        {
                            legend:
                            {
                                labels:
                                {
                                    color: 'white', // Legend labels color
                                
                                    font: {
                                    size: 10 // Optional: Change font size
                                    }

                                   
                                }
                            },

                            title:
                            {
                                display: true, // Display the title
                                text: 'Line 12', // Title text
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
                                    max: 7500,
                                    min:6400,
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
                                    ctx.fillText(res.Data_Ary45[last_value_line12A]+' Pa', chart.width - 10, 30); // Adjust position as needed
                                    ctx.restore();
                                }

                                ,id: 'horizontalLine', // Combine logic under a single plugin
                                    afterDraw: (chart) =>
                                    {
                                        const ctx = chart.ctx;

                                          // Horizontal lines data
                                        const lines = [
                                            { yValue:min_limit , color: 'red' },
                                            { yValue:max_limit, color: 'red' }
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


                //Chart 13 (Line 7A)
                const ctx13 = document.getElementById('myChart13');
                    ctx13.style.backgroundColor = 'rgba(24, 24, 24, 0.71)';
    
                    if (lineChart13) {
                        lineChart13.destroy(); // Destroy existing chart
                    }

                     lineChart13 = new Chart(ctx13, {
                    type: 'line', // Line chart type
                    data:
                    {
                        labels: line7A_Time, // X-axis labels
                        datasets:
                            [{
                                label: 'Air Flow',
                                data: line13A_Data,
                                borderColor: 'rgb(255, 255, 255)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:0.1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            },
                            {
                                label: 'Air Flow',
                                data: line13B_Data,
                                borderColor: 'rgb(0, 255, 8)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:0.1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            }]
                    },
                     options:
                    {
                        animation: {
                            duration: 0
                        },
                        maintainAspectRatio: false,
                        responsive: true,
                        plugins:
                        {
                            legend:
                            {
                                labels:
                                {
                                    color: 'white', // Legend labels color
                                
                                    font: {
                                    size: 10 // Optional: Change font size
                                    }

                                   
                                }
                            },

                            title:
                            {
                                display: true, // Display the title
                                text: 'Line 13', // Title text
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
                                    max: 7500,
                                    min:6400,
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
                                    ctx.fillText(res.Data_Ary25[last_value_line7A]+' Pa', chart.width - 10, 30); // Adjust position as needed
                                    ctx.restore();
                                }

                                ,id: 'horizontalLine', // Combine logic under a single plugin
                                    afterDraw: (chart) =>
                                    {
                                        const ctx = chart.ctx;

                                          // Horizontal lines data
                                        const lines = [
                                            { yValue:min_limit , color: 'red' },
                                            { yValue:max_limit, color: 'red' }
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

                //Chart 14 (Line 7B)
                const ctx14 = document.getElementById('myChart14');
                ctx14.style.backgroundColor = 'rgba(24, 24, 24, 0.71)';
    
                if (lineChart14) {
                        lineChart14.destroy(); // Destroy existing chart
                    }

                     lineChart14 = new Chart(ctx14, {
                    type: 'line', // Line chart type
                    data:
                    {
                        labels: line14A_Time, // X-axis labels
                        datasets:
                            [{
                                label: 'Air Flow',
                                data: line14A_Data,
                                borderColor: 'rgb(255, 255, 255)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:0.1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            },
                            {
                                label: 'Air Flow',
                                data: line14B_Data,
                                borderColor: 'rgb(0, 255, 8)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:0.1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            },]
                    },
                     options:
                    {
                        animation: {
                            duration: 0
                        },
                        maintainAspectRatio: false,
                        responsive: true,
                        plugins:
                        {
                            legend:
                            {
                                labels:
                                {
                                    color: 'white', // Legend labels color
                                
                                    font: {
                                    size: 10 // Optional: Change font size
                                    }

                                   
                                }
                            },

                            title:
                            {
                                display: true, // Display the title
                                text: 'Line 14', // Title text
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
                                    max: 7500,
                                    min:6400,
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
                                    ctx.fillText(res.Data_Ary53[last_value_line14A]+' Pa', chart.width - 10, 30); // Adjust position as needed
                                    ctx.restore();
                                }

                                ,id: 'horizontalLine', // Combine logic under a single plugin
                                    afterDraw: (chart) =>
                                    {
                                        const ctx = chart.ctx;

                                          // Horizontal lines data
                                        const lines = [
                                            { yValue:min_limit , color: 'red' },
                                            { yValue:max_limit, color: 'red' }
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


                 //Chart 15 (Line 15A)
                 const ctx15 = document.getElementById('myChart15');
                ctx15.style.backgroundColor = 'rgba(24, 24, 24, 0.71)';
    
                if (lineChart15) {
                        lineChart15.destroy(); // Destroy existing chart
                    }

                     lineChart15 = new Chart(ctx15, {
                    type: 'line', // Line chart type
                    data:
                    {
                        labels: line15A_Time, // X-axis labels
                        datasets:
                            [{
                                label: 'Air Flow',
                                data: line15A_Data,
                                borderColor: 'rgb(255, 255, 255)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:0.1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            },
                            {
                                label: 'Air Flow',
                                data: line15B_Data,
                                borderColor: 'rgb(0, 255, 8)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:0.1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            },]
                    },
                     options:
                    {
                        animation: {
                            duration: 0
                        },
                        maintainAspectRatio: false,
                        responsive: true,
                        plugins:
                        {
                            legend:
                            {
                                labels:
                                {
                                    color: 'white', // Legend labels color
                                
                                    font: {
                                    size: 10 // Optional: Change font size
                                    }

                                   
                                }
                            },

                            title:
                            {
                                display: true, // Display the title
                                text: 'Line 15', // Title text
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
                                    max: 7500,
                                    min:6400,
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
                                    ctx.fillText(res.Data_Ary57[last_value_line15A]+' Pa', chart.width - 10, 30); // Adjust position as needed
                                    ctx.restore();
                                }

                                ,id: 'horizontalLine', // Combine logic under a single plugin
                                    afterDraw: (chart) =>
                                    {
                                        const ctx = chart.ctx;

                                          // Horizontal lines data
                                        const lines = [
                                            { yValue:min_limit , color: 'red' },
                                            { yValue:max_limit, color: 'red' }
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


                 //Chart 16 (Line 16A)
                 const ctx16 = document.getElementById('myChart16');
                ctx16.style.backgroundColor = 'rgba(24, 24, 24, 0.71)';
    
                if (lineChart16) {
                        lineChart16.destroy(); // Destroy existing chart
                    }

                     lineChart16 = new Chart(ctx16, {
                    type: 'line', // Line chart type
                    data:
                    {
                        labels: line16A_Time, // X-axis labels
                        datasets:
                            [{
                                label: 'Air Flow',
                                data: line16A_Data,
                                borderColor: 'rgb(255, 255, 255)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:0.1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            },
                            {
                                label: 'Air Flow',
                                data: line16B_Data,
                                borderColor: 'rgb(0, 255, 8)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:0.1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            },

                           
                        
                        ]
                    },
                     options:
                    {
                        animation: {
                            duration: 0
                        },
                        maintainAspectRatio: false,
                        responsive: true,
                        plugins:
                        {
                            legend:
                            {
                                labels:
                                {
                                    color: 'white', // Legend labels color
                                
                                    font: {
                                    size: 10 // Optional: Change font size
                                    }

                                   
                                }
                            },

                            title:
                            {
                                display: true, // Display the title
                                text: 'Line 16', // Title text
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
                                    max: 7500,
                                    min:6400,
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
                                    ctx.fillText(res.Data_Ary61[last_value_line16A]+' Pa', chart.width - 10, 30); // Adjust position as needed
                                    ctx.restore();
                                }

                                ,id: 'horizontalLine', // Combine logic under a single plugin
                                    afterDraw: (chart) =>
                                    {
                                        const ctx = chart.ctx;

                                          // Horizontal lines data
                                        const lines = [
                                            { yValue:min_limit , color: 'red' },
                                            { yValue:max_limit, color: 'red' }
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


                //Chart 17 (Line 17A)
                const ctx17 = document.getElementById('myChart17');
                ctx17.style.backgroundColor = 'rgba(24, 24, 24, 0.71)';

    
                if (lineChart17) {
                        lineChart17.destroy(); // Destroy existing chart
                    }
                     lineChart17 = new Chart(ctx17, {
                    type: 'line', // Line chart type
                    data:
                    {
                        labels: line17A_Time, // X-axis labels
                        datasets:
                            [{
                                label: 'Air Flow',
                                data: line17A_Data,
                                borderColor: 'rgb(255, 255, 255)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:0.1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            },
                            {
                                label: 'Air Flow',
                                data: line17B_Data,
                                borderColor: 'rgb(0, 255, 8)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:0.1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            },
                        ]
                    },
                     options:
                    {
                        animation: {
                            duration: 0
                        },
                        maintainAspectRatio: false,
                        responsive: true,
                        plugins:
                        {
                            legend:
                            {
                                labels:
                                {
                                    color: 'white', // Legend labels color
                                
                                    font: {
                                    size: 10 // Optional: Change font size
                                    }

                                   
                                }
                            },

                            title:
                            {
                                display: true, // Display the title
                                text: 'Line 17', // Title text
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
                                    max: 7500,
                                    min:6400,
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
                                    ctx.fillText(res.Data_Ary65[last_value_line17A]+' Pa', chart.width - 10, 30); // Adjust position as needed
                                    ctx.restore();
                                }

                                ,id: 'horizontalLine', // Combine logic under a single plugin
                                    afterDraw: (chart) =>
                                    {
                                        const ctx = chart.ctx;

                                          // Horizontal lines data
                                        const lines = [
                                            { yValue:min_limit , color: 'red' },
                                            { yValue:max_limit, color: 'red' }
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

                //Chart 18 (Line 18A)
                const ctx18 = document.getElementById('myChart18');
                ctx18.style.backgroundColor = 'rgba(24, 24, 24, 0.71)';
    
                if (lineChart18) {
                        lineChart18.destroy(); // Destroy existing chart
                    }

                     lineChart18 = new Chart(ctx18, {
                    type: 'line', // Line chart type
                    data:
                    {
                        labels: line18A_Time, // X-axis labels
                        datasets:
                            [{
                                label: 'Air Flow',
                                data: line18A_Data,
                                borderColor: 'rgb(255, 255, 255)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:0.1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            },  
                            {
                                label: 'Air Flow',
                                data: line18B_Data,
                                borderColor: 'rgb(0, 255, 8)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:0.1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            },
                        ]
                    },
                     options:
                    {
                        animation: {
                            duration: 0
                        },
                        maintainAspectRatio: false,
                        responsive: true,
                        plugins:
                        {
                            legend:
                            {
                                labels:
                                {
                                    color: 'white', // Legend labels color
                                
                                    font: {
                                    size: 10 // Optional: Change font size
                                    }

                                   
                                }
                            },

                            title:
                            {
                                display: true, // Display the title
                                text: 'Line 18', // Title text
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
                                    max: 7500,
                                    min:6400,
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
                                    ctx.fillText(res.Data_Ary71[last_value_line18A]+' Pa', chart.width - 10, 30); // Adjust position as needed
                                    ctx.restore();
                                }

                                ,id: 'horizontalLine', // Combine logic under a single plugin
                                    afterDraw: (chart) =>
                                    {
                                        const ctx = chart.ctx;

                                          // Horizontal lines data
                                        const lines = [
                                            { yValue:min_limit , color: 'red' },
                                            { yValue:max_limit, color: 'red' }
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



            }

            function refreshFrontEnd() {
                console.log("refreshFrontEnd");

              //  $("#content").load(location.href + " #content");
                funLoadUsers();

            }

            function ReloadContent(){
                // console.log("Reload FrontEnd And BackeEnd");
                // document.querySelectorAll("canvas").forEach(canvas => {
                //     const ctx = canvas.getContext("2d");
                //     ctx.clearRect(0, 0, canvas.width, canvas.height);
                // });
              //  $("#content").load(location.href + " #content");
            //   document.querySelectorAll("canvas").forEach(canvas => {
            //     const ctx = canvas.getContext("2d");
            //     ctx.clearRect(0, 0, canvas.width, canvas.height);
            // });



                funLoadUsers();
               // $("#main_content").load(location.href + " #main_content");

                //window.top.location = window.top.location;


            }



            funLoadUsers();
            setInterval(ReloadContent, 5000);
            //setInterval(funLoadUsers, 5000);

           // funLoadUsers();






</script>



<style>
      /* canvas
        {
            width: 100% !important;
            height: 100% !important;
          } */

          canvas{
            width: 100% !important;
            height:100% !important;

          }
        .chartBox
        {

            width:500px;
            height:250px;
            padding:5px;
            /* background-color:yellow; */


        }

        .flexbox
        {
            display: flex;
        }



</style>










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
