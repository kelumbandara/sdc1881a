<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


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
    date_default_timezone_set('Asia/Colombo');
    $strDateTime = date("Y-m-d H:i:s");
    $strServerDateTime = date("Y-m-d H:i:s");    
    $strServerDateTime_2=date("H:i");  

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
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
    <div class="content-wrapper"  >
        <!-- Main content -->
        <section class="" id="content" style="margin: auto;"  > 
            <h5>Diagnostic</h5>
           
        
            <div  id="luwa_image"  style="position: relative; width: 100%;">
                
                
                <img src="../../assets/images/luwa2.png" style="width: 80%; height: 80%;" />
                    <!-- Last Times -->
                    <div id="L1AST" style="display: none;" ></div>
                    <div id="L1AET" style="display: none;"></div>
                    <div id="L1BST" style="display: none;"></div>
                    <div id="L1BET" style="display: none;"></div>

                    <div id="L2AST" style="display: none;"></div>
                    <div id="L2AET" style="display: none;"></div>
                    <div id="L2BST" style="display: none;"></div>
                    <div id="L2BET" style="display: none;"></div>

                
                    <div id="L3AST" style="display: none;"></div>
                    <div id="L3AET" style="display: none;"></div>
                    <div id="L3BST" style="display: none;"></div>
                    <div id="L3BET" style="display: none;"></div>

                    <div id="L4AST" style="display: none;"></div>
                    <div id="L4AET" style="display: none;"></div>
                    <div id="L4BST" style="display: none;"></div>
                    <div id="L4BET" style="display: none;"></div>

                    <div id="L5AST" style="display: none;"></div>
                    <div id="L5AET" style="display: none;"></div>
                    <div id="L5BST" style="display: none;"></div>
                    <div id="L5BET" style="display: none;"></div>

                    <div id="L6AST" style="display: none;"></div>
                    <div id="L6AET" style="display: none;"></div>
                    <div id="L6BST" style="display: none;"></div>
                    <div id="L6BET" style="display: none;"></div>

                
                    <div id="L7AST" style="display: none;"></div>
                    <div id="L7AET" style="display: none;"></div>
                    <div id="L7BST" style="display: none;"></div>
                    <div id="L7BET" style="display: none;"></div>

                    
                    <div id="L8AST" style="display: none;"></div>
                    <div id="L8AET" style="display: none;"></div>
                    <div id="L8BST" style="display: none;"></div>
                    <div id="L8BET" style="display: none;"></div>


                
                
                    <!-- Dots -->
                    <div id="L1ASD_dot" class="dot"></div>  
                    <div id="L1AED_dot" class="dot"></div>
                    <div id="L1BSD_dot" class="dot"></div>
                    <div id="L1BED_dot" class="dot"></div>

                    <div id="L2ASD_dot" class="dot"></div>  
                    <div id="L2AED_dot" class="dot"></div>
                    <div id="L2BSD_dot" class="dot"></div>
                    <div id="L2BED_dot" class="dot"></div>

                    <div id="L3ASD_dot" class="dot"></div>  
                    <div id="L3AED_dot" class="dot"></div>
                    <div id="L3BSD_dot" class="dot"></div>
                    <div id="L3BED_dot" class="dot"></div>

                    <div id="L4ASD_dot" class="dot"></div>  
                    <div id="L4AED_dot" class="dot"></div>
                    <div id="L4BSD_dot" class="dot"></div>
                    <div id="L4BED_dot" class="dot"></div>

                    
                    <div id="L5ASD_dot" class="dot"></div>  
                    <div id="L5AED_dot" class="dot"></div>
                    <div id="L5BSD_dot" class="dot"></div>
                    <div id="L5BED_dot" class="dot"></div>

                    <div id="L6ASD_dot" class="dot"></div>  
                    <div id="L6AED_dot" class="dot"></div>
                    <div id="L6BSD_dot" class="dot"></div>
                    <div id="L6BED_dot" class="dot"></div>

                    <div id="L7ASD_dot" class="dot"></div>  
                    <div id="L7AED_dot" class="dot"></div>
                    <div id="L7BSD_dot" class="dot"></div>
                    <div id="L7BED_dot" class="dot"></div>

                    <div id="L8ASD_dot" class="dot"></div>  
                    <div id="L8AED_dot" class="dot"></div>
                    <div id="L8BSD_dot" class="dot"></div>
                    <div id="L8BED_dot" class="dot"></div>

            

                

                

                    <!-- Data -->
                    <!-- <div id="L3ASD" > </div>
                    <div id="L3AED" > </div>
                    <div id="L3BSD" > </div>
                    <div id="L3BED" > </div> -->

                    <!-- <div id="L4ASD" > </div>
                    <div id="L4AED" > </div>
                    <div id="L4BSD" > </div>
                    <div id="L4BED" > </div> -->

                    <!-- <div id="L5ASD"> </div>
                    <div id="L5AED"> </div>
                    <div id="L5BSD"> </div>
                    <div id="L5BED" > </div> -->

                    <!-- <div id="L6ASD"> </div>
                    <div id="L6AED"> </div>
                    <div id="L6BSD"> </div>
                    <div id="L6BED" > </div> -->

                    <!-- <div id="L8ASD"> </div>
                    <div id="L8AED"> </div>
                    <div id="L8BSD"> </div>
                    <div id="L8BED" > </div> -->


                    <!-- Message Boxex -->
                    



                    


                    <div id="L1ASD_message" >
                        <div id="Line_name" style="font-size: px;" >1A Start</div>
                        <div id="L1ASD"></div>
                    </div>
                    
                    <div id="L1AED_message">
                
                        <div id="Line_name" >1A End</div>
                        <div id="L1AED" > </div>
                    </div>


                    <div id="L1BSD_message">
                        <div id="Line_name" style="margin-top: 10px;">1B Start</div>
                        <div id="L1BSD" > </div>
                    </div>

                    <div id="L1BED_message">
                        <div id="Line_name" style="margin-top: 10px;" >1B End</div>
                        <div id="L1BED"> </div>
                    </div>

                    <!-- luwa 2 -->
                    <div id="L2ASD_message">
                        <div id="Line_name" style="margin-top:10px">2A Start</div>
                        <div id="L2ASD" ></div>
                    </div>
                    
                    <div id="L2AED_message">
                        <div id="Line_name" >2A End</div>
                        <div id="L2AED" > </div>
                    </div>


                    <div id="L2BSD_message" >
                        <div id="Line_name" style="margin-top:10px">2B Start</div>
                        <div id="L2BSD" > </div>
                    </div>

                    <div id="L2BED_message">
                        <div id="Line_name"style="margin-top:10px" >2B End</div>
                        <div id="L2BED"> </div>
                    </div>

                    <!-- Luwa 3 -->
                    <div id="L3ASD_message">
                        <div id="Line_name" >3A Start</div>
                        <div id="L3ASD"></div>
                    </div>
                    
                    <div id="L3AED_message">
                        <div id="Line_name" >3A End</div>
                        <div id="L3AED" > </div>
                    </div>


                    <div id="L3BSD_message">
                        <div id="Line_name" style="margin-top:10px">3B Start</div>
                        <div id="L3BSD" > </div>
                    </div>

                    <div id="L3BED_message">
                        <div id="Line_name"style="margin-top:10px" >3B End</div>
                        <div id="L3BED"> </div>
                    </div>

                    <!-- Luwa 4 -->
                    <div id="L4ASD_message">
                        <div id="Line_name" >4A Start</div>
                        <div id="L4ASD"></div>
                    </div>
                    
                    <div id="L4AED_message">
                        <div id="Line_name" >4A End</div>
                        <div id="L4AED" > </div>
                    </div>


                    <div id="L4BSD_message" >
                        <div id="Line_name" style="margin-top:10px">4B Start</div>
                        <div id="L4BSD" > </div>
                    </div>

                    <div id="L4BED_message" >
                        <div id="Line_name" style="margin-top:10px">4B End</div>
                        <div id="L4BED"> </div>
                    </div>

                    <!-- Luwa 5 -->
                    <div id="L5ASD_message">
                        <div id="Line_name" >5A Start</div>
                        <div id="L5ASD"></div>
                    </div>
                    
                    <div id="L5AED_message">
                        <div id="Line_name" >5A End</div>
                        <div id="L5AED" > </div>
                    </div>


                    <div id="L5BSD_message">
                        <div id="Line_name"style="margin-top:10px" >5B Start</div>
                        <div id="L5BSD" > </div>
                    </div>

                    <div id="L5BED_message">
                        <div id="Line_name"style="margin-top:10px" >5B End</div>
                        <div id="L5BED"> </div>
                    </div>

                    <!-- Luwa 6 -->
                    <div id="L6ASD_message">
                        <div id="Line_name" >6A Start</div>
                        <div id="L6ASD"></div>
                    </div>
                    
                    <div id="L6AED_message">
                        <div id="Line_name" >6A End</div>
                        <div id="L6AED" > </div>
                    </div>


                    <div id="L6BSD_message">
                        <div id="Line_name"style="margin-top:10px" >6B Start</div>
                        <div id="L6BSD" > </div>
                    </div>

                    <div id="L6BED_message">
                        <div id="Line_name" style="margin-top:10px">6B End</div>
                        <div id="L6BED"> </div>
                    </div>

                    <!-- Luwa 7 -->
                    <div id="L7ASD_message">
                        <div id="Line_name" >7A Start</div>
                        <div id="L7ASD"></div>
                    </div>
                    
                    <div id="L7AED_message">
                        <div id="Line_name" >7A End</div>
                        <div id="L7AED" > </div>
                    </div>


                    <div id="L7BSD_message">
                        <div id="Line_name"style="margin-top:10px" >7B Start</div>
                        <div id="L7BSD" > </div>
                    </div>

                    <div id="L7BED_message">
                        <div id="Line_name"style="margin-top:10px" >7B End</div>
                        <div id="L7BED"> </div>
                    </div>
        
                    <!-- Luwa 8 -->
                    <div id="L8ASD_message">
                        <div id="Line_name" >8A Start</div>
                        <div id="L8ASD"></div>
                    </div>
                    
                    <div id="L8AED_message">
                        <div id="Line_name" >8A End</div>
                        <div id="L8AED" > </div>
                    </div>


                    <div id="L8BSD_message">
                        <div id="Line_name" style="margin-top:10px" >8B Start</div>
                        <div id="L8BSD" > </div>
                    </div>

                    <div id="L8BED_message">
                        <div id="Line_name" style="margin-top:10px" >8B End</div>
                        <div id="L8BED"> </div>
                </div> 
            </div>
        </section>
      

    </div>






<script>
    var hour_now_time_js="";
    var min_now_time_js="";
   
     function funLoadUsers()
            {

                //console.log("Reload:", new Date().toLocaleTimeString()); // Logs time in HH:MM:SS format

                //------------ Load Line Setting --------------------------------------
                const DataAry = [];
                DataAry[0] = "funGetLineData";        // Table Name
                DataAry[1] = "Active";
               // alert(DataAry[1])
               // alert(DataAry);
                $.post('get_live_details.php', { userpara: DataAry }, function(json_data2)
                {

                    // var now_time_js = "<?php echo date(' H:i'); ?>";
                    // var h_now_time_js = now_time_js.split(":"); // Splitting the input string
                    // var hour_now_time_js =parseInt(h_now_time_js[0]); 
                    // var min_now_time_js = parseInt(h_now_time_js[1]);
                    //console.log(hour_now_time_js+":"+min_now_time_js);
                    //console.log( new Date().toLocaleTimeString());
                    const d = new Date();
                    var hour_now_time_js = d.getHours();
                    var min_now_time_js= d.getMinutes();
                    if (min_now_time_js<10){
                        min_now_time_js = "0" + min_now_time_js;;
                    }
                    //console.log(min_now_time_js);





                    var res = $.parseJSON(json_data2);
                   //alert(res.Data_Ary.join(", "));
                   //alert(json_data2);
                  console.log(json_data2)

                        // lUWA 1A

                        Data_Ary=(res.Data_Ary.join(", "));
                        Data_Ary2=(res.Data_Ary2.join(", "));
                        Data_Ary3=(res.Data_Ary3.join(", "));
                        Data_Ary4=(res.Data_Ary4.join(", "));
                        var New_1A_End=[];
                        var Chart1_Display_Time=[];
                        
                        Luwa_1A_Start_Length= res.Data_Ary.length; //1
                        Luwa_1A_End_Length= res.Data_Ary3.length;  //2

                        Luwa_1A_Start_Data=[]; //1
                        Luwa_1A_Start_Time=[];
                        
                        Luwa_1A_End_Data=[]; //2 
                        Luwa_1A_End_Time=[];
                        
                        for (var i = 0; i < Luwa_1A_Start_Length; i++)
                        {
                           
                            Luwa_1A_Start_Data.push(res.Data_Ary[i]);
                            Luwa_1A_Start_Time.push(res.Data_Ary2[i]);
                            last_index_Luwa_1A_Start=i
                             
                        }
                        for (var i = 0; i < Luwa_1A_End_Length; i++)
                        {
                            Luwa_1A_End_Data.push(res.Data_Ary3[i]);
                            Luwa_1A_End_Time.push(res.Data_Ary4[i]);
                            last_index_line1A_End=i;

                        }

                        try{
                            
                            if(Luwa_1A_Start_Data.length >= 1)
                            {
                                //alert(Luwa_1A_Start_Data.length)
                                Chart1_Display_Time=Luwa_1A_Start_Time;
                                for(var x=0;x<Luwa_1A_Start_Data.length;x++)
                                {

                                    
                                    //console.log(" ");
                                    Time=Luwa_1A_Start_Time[x];
                                    let h = Time.split(":"); // Splitting the input string
                                    let hour =parseInt(h[0]); 
                                    let min = parseInt(h[1]);
                                    //console.log("Time 1A "+hour+":"+min);

                                  

                                     




                                    
                                    for(var a=0;a<Luwa_1A_End_Time.length;a++)
                                    {
                                        var Time2=Luwa_1A_End_Time[a];
                                        let h2 = Time2.split(":"); // Splitting the input string
                                        let hour2 =parseInt(h2[0]); 
                                        let min2 = parseInt(h2[1]);
                                        
                                        var diff_Hour=parseInt(hour2-hour);
                                        var diff_min=parseInt(min2-min);
                                        //console.log("diff_min "+line1A_Time[x]+" "+Luwa_1A_End_Time[a]+" "+diff_min);

                          
                                     

                                        if (diff_Hour == 0 && diff_min >= 0 && diff_min < 4 || diff_Hour == 0 && diff_min < 0 && diff_min > -3 ) 
                                        {
                                            New_1A_End[x]=Luwa_1A_End_Data[a];
                                        }
                                      
                                    }
                                }
                            }


                            if(Luwa_1A_Start_Data.length == 1 && Luwa_1A_End_Data.length > 1 )
                            {
                                
                                Chart1_Display_Time=Luwa_1A_End_Time;
                                New_1A_End=Luwa_1A_End_Data;

                             

                            }
                            //console.log(New_2B_End)
                        }
                        catch(err)
                        {
                            //console.log("Error 1A: "+err)
                           //console.log(line1A_Time);
                           //console.log(line1A_Length);
                           //console.log(line1B_Length);
                            //console.log(Luwa_1A_End_Data);
                            //console.log(Luwa_1A_End_Time);
                            //console.log(" ");
                                        
                        }

                     //Chart 2 Array (Luwa 1B)
                    Data_Ary=(res.Data_Ary5.join(", "));
                    Data_Ary2=(res.Data_Ary6.join(", "));
                    Data_Ary3=(res.Data_Ary7.join(", "));
                    Data_Ary4=(res.Data_Ary8.join(", "));
                    var New_1B_End=[];
                    

                    Luwa_1B_Start_Length= res.Data_Ary5.length;
                    Luwa_1B_End_Length= res.Data_Ary7.length;


                    Luwa_1B_Start_Data=[];
                    Luwa_1B_Start_Time=[];
                    Luwa_1B_End_Data=[];
                    Luwa_1B_End_Time=[];

                    for (var i = 0; i < Luwa_1B_Start_Length; i++)
                     {
                        Luwa_1B_Start_Data.push(res.Data_Ary5[i]);
                        Luwa_1B_Start_Time.push(res.Data_Ary6[i]);
                        last_index_line1B_Start=i;
                    }

                    for (var i = 0; i < Luwa_1B_End_Length; i++)
                     {
                        Luwa_1B_End_Data.push(res.Data_Ary7[i]);
                        Luwa_1B_End_Time.push(res.Data_Ary8[i]);
                        last_index_line1B_End=i;
                     }


                    try{

                        for(var x=0;x<Luwa_1B_Start_Data.length;x++)
                        {
                            
                            //console.log(" ");
                            Time=Luwa_1B_Start_Time[x];
                            let h = Time.split(":"); // Splitting the input string
                            let hour =parseInt(h[0]); 
                            let min = parseInt(h[1]);
                            //console.log("Time 2A "+hour+":"+min);
                            
                            for(var a=0;a<Luwa_1B_End_Time.length;a++)
                            {
                                var Time2=Luwa_1B_End_Time[a];
                                let h2 = Time2.split(":"); // Splitting the input string
                                let hour2 =parseInt(h2[0]); 
                                let min2 = parseInt(h2[1]);
                                
                                var diff_Hour=parseInt(hour2-hour);
                                var diff_min=parseInt(min2-min);
                                //console.log("diff_min "+Luwa_1B_Start_Time[x]+" "+Luwa_1B_End_Time[a]+" "+diff_min);


                                if (diff_Hour == 0 && diff_min >= 0 && diff_min < 4 || diff_Hour == 0 && diff_min < 0 && diff_min > -3 ) 
                                {
                                    New_1B_End[x]=Luwa_1B_End_Data[a];
                                }
                            }
                        }
                        //console.log(New_1B_End)
                    }

                    catch(err)
                    {
                        //console.log("Error 2B: "+err)
                        //console.log(Luwa_1B_Start_Time);
                        //console.log(Luwa_1B_Start_Length);
                        //console.log(Luwa_1B_End_Length);
                        //console.log(Luwa_1B_End_Data);
                        //console.log(Luwa_1B_End_Time);
                        //console.log(" ");
                                    
                    }
              
                    //Chart 3 Array (Luwa 2A) (5/2/24)
                    Data_Ary=(res.Data_Ary9.join(", "));
                    Data_Ary2=(res.Data_Ary10.join(", "));
                    Data_Ary3=(res.Data_Ary11.join(", "));
                    Data_Ary4=(res.Data_Ary12.join(", "));
                    var New_2A_End=[];

                    Luwa_2A_Start_Length= res.Data_Ary9.length;
                    Luwa_2A_End_Length= res.Data_Ary9.length;


                    Luwa_2A_Start_Data=[];
                    Luwa_2A_Start_Time=[];
                    
                    Luwa_2A_End_Data=[];
                    Luwa_2A_End_Time=[];

                    for (var i = 0; i < Luwa_2A_Start_Length; i++)
                     {
                        Luwa_2A_Start_Data.push(res.Data_Ary9[i]);
                        Luwa_2A_Start_Time.push(res.Data_Ary10[i]);
                        last_index_Luwa_3A_Start=i;
                     }
                    for (var i = 0; i < Luwa_2A_End_Length; i++)
                     {
                        Luwa_2A_End_Data.push(res.Data_Ary11[i]);
                        Luwa_2A_End_Time.push(res.Data_Ary12[i]);
                        last_index_Luwa_3A_End=i;
                     }
                     try
                     {

                        for(var x=0;x<Luwa_2A_Start_Data.length;x++)
                        {
                            
                            //console.log(" ");
                            Time=Luwa_2A_Start_Time[x];
                            let h = Time.split(":"); // Splitting the input string
                            let hour =parseInt(h[0]); 
                            let min = parseInt(h[1]);
                            //console.log("Time 3A "+hour+":"+min);
                            
                            for(var a=0;a<Luwa_2A_End_Time.length;a++)
                            {
                                var Time2=Luwa_2A_End_Time[a];
                                let h2 = Time2.split(":"); // Splitting the input string
                                let hour2 =parseInt(h2[0]); 
                                let min2 = parseInt(h2[1]);
                                
                                var diff_Hour=parseInt(hour2-hour);
                                var diff_min=parseInt(min2-min);
                                //console.log("diff_min "+Luwa_2A_Start_Time[x]+" "+Luwa_2A_End_Time[a]+" "+diff_min);


                                if (diff_Hour == 0 && diff_min >= 0 && diff_min < 4 || diff_Hour == 0 && diff_min < 0 && diff_min > -3 ) 
                                {
                                    New_2A_End[x]=Luwa_2A_End_Data[a];
                                }
                            }
                        }
                        ////console.log(New_2B_End)
                    }
                    catch(err)
                    {
                        //console.log("Error 1B: "+err)
                        //console.log(Luwa_3A_Start_Time);
                        //console.log(Luwa_3A_Start_Length);
                        //console.log(Luwa_3A_End_Length);
                        //console.log(Luwa_3A_End_Data);
                        //console.log(Luwa_3A_End_Time);
                        //console.log(" ");
            
                    }

                    //Chart 4 Array (2B) (5/2/24)
                    Data_Ary=(res.Data_Ary13.join(", "));
                    Data_Ary2=(res.Data_Ary14.join(", "));
                    Data_Ary3=(res.Data_Ary15.join(", "));
                    Data_Ary4=(res.Data_Ary16.join(", "));
                    var New_2B_End=[];

                    Luwa_2B_Start_Length= res.Data_Ary13.length;
                    Luwa_2B_End_Length= res.Data_Ary15.length;


                    Luwa_2B_Start_Data=[];
                    Luwa_2B_Start_Time=[];

                    Luwa_2B_End_Data=[];
                    Luwa_2B_End_Time=[];
                    //console.log(Luwa_2B_Start_Length);
                    //console.log(Luwa_2B_End_Length);
                    

                    for (var i = 0; i < Luwa_2B_Start_Length; i++)
                     {
                        // Skip every other row (i.e., push the 1st, 3rd, 5th, etc. rows)
                       
                            Luwa_2B_Start_Data.push(res.Data_Ary13[i]);
                            Luwa_2B_Start_Time.push(res.Data_Ary14[i]);
                            last_index_Luwa_1A_Start=i;
                    }

                    for (var i = 0; i < Luwa_2B_End_Length; i++)
                     {
                        Luwa_2B_End_Data.push(res.Data_Ary15[i]);
                        Luwa_2B_End_Time.push(res.Data_Ary16[i]);
                        last_index_Luwa_1A_End=i;
                     }


                   try{

                    for(var x=0;x<Luwa_2B_Start_Time.length;x++){
                        
                        //console.log(" ");
                        Time=Luwa_2B_Start_Time[x];
                        let h = Time.split(":"); // Splitting the input string
                        let hour =parseInt(h[0]); 
                        let min = parseInt(h[1]);
                        //console.log("Time A4 "+hour+":"+min);
                        
                    

                    for(var a=0;a<Luwa_2B_End_Time.length;a++){
                        var Time2=Luwa_2B_End_Time[a];
                        let h2 = Time2.split(":"); // Splitting the input string
                        let hour2 =parseInt(h2[0]); 
                        let min2 = parseInt(h2[1]);
                        
                        var diff_Hour=parseInt(hour2-hour);
                        var diff_min=parseInt(min2-min);
                       //console.log("diff_Hour "+diff_Hour);
                        //console.log("diff_min 4 "+Luwa_2B_Start_Time[x]+" "+Luwa_2B_End_Time[a]+" "+diff_min);


                        if (diff_Hour == 0 && diff_min >= 0 && diff_min < 4 || diff_Hour == 0 && diff_min < 0 && diff_min > -3 ) 
                        {
                            New_2B_End[x]=Luwa_2B_End_Data[a];
                        }
                    }

                }
                //console.log(New_2B_End)
            }
            catch(err){

                //console.log("Error 4 : "+err)
                New_2B_End=Luwa_2B_End_Data;
                //console.log(Luwa_2B_Start_Data);
                //console.log(Luwa_2B_Start_Time);
                //console.log(" ");

                //console.log(Luwa_2B_End_Data);
                //console.log(Luwa_2B_End_Time);
            }



                    //Chart 5 Array (3A) (6/2/24)
                    Data_Ary=(res.Data_Ary17.join(", "));
                    Data_Ary2=(res.Data_Ary18.join(", "));
                    Data_Ary3=(res.Data_Ary19.join(", "));
                    Data_Ary4=(res.Data_Ary20.join(", "));
                    var New_3A_End=[];

                    Luwa_3A_Start_Length= res.Data_Ary17.length;
                    Luwa_3A_End_Length= res.Data_Ary19.length;


                    Luwa_3A_Start_Data=[];
                    Luwa_3A_Start_Time=[];
                    Luwa_3A_End_Data=[];
                    Luwa_3A_End_Time=[];

                    for (var i = 0; i < Luwa_3A_Start_Length; i++)
                     {
                        
                            Luwa_3A_Start_Data.push(res.Data_Ary17[i]);
                            Luwa_3A_Start_Time.push(res.Data_Ary18[i]);
                          last_index_Luwa_3A_Start=i;
                       
                    }
                    for (var i = 0; i < Luwa_3A_End_Length; i++)
                     {
                        Luwa_3A_End_Data.push(res.Data_Ary19[i]);
                        Luwa_3A_End_Time.push(res.Data_Ary20[i]);
                        last_index_Luwa_3A_End=i;

                     }

                    try
                    {

                        for(var x=0;x<Luwa_3A_Start_Data.length;x++)
                        {
                            
                            //console.log(" ");
                            Time=Luwa_3A_Start_Time[x];
                            let h = Time.split(":"); // Splitting the input string
                            let hour =parseInt(h[0]); 
                            let min = parseInt(h[1]);
                            //console.log("Time 5A "+hour+":"+min);
                            
                            for(var a=0;a<Luwa_3A_End_Time.length;a++)
                            {
                                var Time2=Luwa_3A_End_Time[a];
                                let h2 = Time2.split(":"); // Splitting the input string
                                let hour2 =parseInt(h2[0]); 
                                let min2 = parseInt(h2[1]);
                                
                                var diff_Hour=parseInt(hour2-hour);
                                var diff_min=parseInt(min2-min);
                                //console.log("diff_min "+Luwa_3A_Start_Time[x]+" "+Luwa_3A_End_Time[a]+" "+diff_min);


                                if (diff_Hour == 0 && diff_min >= 0 && diff_min < 4 || diff_Hour == 0 && diff_min < 0 && diff_min > -3 ) 
                                {
                                    New_3A_End[x]=Luwa_3A_End_Data[a];
                                }
                            }
                        }
                        //  //console.log(New_1B_End)
                    }

                    catch(err)
                    {
                        //console.log("Error 5B: "+err)
                        //console.log(Luwa_3A_Start_Time);
                        //console.log(Luwa_3A_Start_Length);
                        //console.log(Luwa_3A_End_Length);
                        //console.log(Luwa_3A_End_Data);
                        //console.log(Luwa_3A_End_Time);
                        //console.log(" ");
                    }


                   

                    //Chart 6 Array (6A) (6/2/24)
                    Data_Ary=(res.Data_Ary21.join(", "));
                    Data_Ary2=(res.Data_Ary22.join(", "));
                    Data_Ary3=(res.Data_Ary23.join(", "));
                    Data_Ary4=(res.Data_Ary24.join(", "));

                    var New_3B_End=[];

                    Luwa_3B_Start_Length= res.Data_Ary21.length;
                    Luwa_3B_End_Length= res.Data_Ary23.length;


                    Luwa_3B_Start_Data=[];
                    Luwa_3B_Start_Time=[];
                    Luwa_3B_End_Data=[];
                    Luwa_3B_End_Time=[];

                    for (var i = 0; i < Luwa_3B_Start_Length; i++)
                     {
                     
                            Luwa_3B_Start_Data.push(res.Data_Ary21[i]);
                            Luwa_3B_Start_Time.push(res.Data_Ary22[i]);
                            last_index_Luwa_3B_Start=i;
                       
                    }

                    for (var i = 0; i < Luwa_3B_End_Length; i++)
                    {
                        Luwa_3B_End_Data.push(res.Data_Ary23[i]);
                        Luwa_3B_End_Time.push(res.Data_Ary24[i]);
                        last_index_line_3B_End=i;   

                    }




                    let max_value_line6A = Math.max(...Luwa_3B_Start_Data);
                    let max_value_line6B = Math.max(...Luwa_3B_End_Data);


                    try{

                        for(var x=0;x<Luwa_3B_Start_Data.length;x++)
                        {
                            
                            //console.log(" ");
                            Time=Luwa_3B_Start_Time[x];
                            let h = Time.split(":"); // Splitting the input string
                            let hour =parseInt(h[0]); 
                            let min = parseInt(h[1]);
                            //console.log("Time A "+hour+":"+min);
                            
                            for(var a=0;a<Luwa_3B_End_Time.length;a++)
                            {
                            var Time2=Luwa_3B_End_Time[a];
                            let h2 = Time2.split(":"); // Splitting the input string
                            let hour2 =parseInt(h2[0]); 
                            let min2 = parseInt(h2[1]);
                            
                            var diff_Hour=parseInt(hour2-hour);
                            var diff_min=parseInt(min2-min);
                            //console.log("diff_Hour "+diff_Hour);
                            //console.log("diff_min "+Luwa_3B_Start_Time[x]+" "+Luwa_3B_End_Time[a]+" "+diff_min);


                            if (diff_Hour == 0 && diff_min >= 0 && diff_min < 4 || diff_Hour == 0 && diff_min < 0 && diff_min > -3 ) 
                            {
                                New_3B_End[x]=Luwa_3B_End_Data[a];
                            }

                        }

                        }
                        //console.log(New_3B_End)
                        }
                    catch(err){

                        //console.log("Error 6B: "+err)
                        //New_3B_End=Luwa_3B_End_Data;
                       //console.log(Luwa_3B_Start_Data);
                        //console.log(Luwa_3B_Start_Time);
                        
                        //console.log(Luwa_3B_Start_Length);
                        //console.log(Luwa_3B_End_Length);
                        

                        //console.log(Luwa_3B_End_Data);
                        //console.log(Luwa_3B_End_Time);
                        //console.log(" ");
                        }


                    

                
                 

                    //Chart 7 Array (7A) (6/2/24)
                    Data_Ary=(res.Data_Ary25.join(", "));
                    Data_Ary2=(res.Data_Ary26.join(", "));
                    Data_Ary3=(res.Data_Ary27.join(", "));
                    Data_Ary4=(res.Data_Ary28.join(", "));
                    var New_4A_End=[];
                    
                    Luwa_4A_Start_Length= res.Data_Ary25.length;
                    Luwa_4A_End_Length= res.Data_Ary27.length;


                    Luwa_4A_Start_Data=[];
                    Luwa_4A_Start_Time=[];
                    Luwa_4A_End_Data=[];
                    Luwa_4A_End_Time=[];

                    for (var i = 0; i < Luwa_4A_Start_Length; i++)
                     {
                            Luwa_4A_Start_Data.push(res.Data_Ary25[i]);
                            Luwa_4A_Start_Time.push(res.Data_Ary26[i]);
                          last_index_Luwa_4A_Start=i;
                      
                    }
                    for (var i = 0; i < Luwa_4A_End_Length; i++)
                    {
                        Luwa_4A_End_Data.push(res.Data_Ary27[i]);
                        Luwa_4A_End_Time.push(res.Data_Ary28[i]);
                        last_index_line_4A_End=i;
                    }

                    try
                    {

                        for(var x=0;x<Luwa_4A_Start_Data.length;x++)
                        {
                            
                            //console.log(" ");
                            Time=Luwa_4A_Start_Time[x];
                            let h = Time.split(":"); // Splitting the input string
                            let hour =parseInt(h[0]); 
                            let min = parseInt(h[1]);
                            //console.log("Time 7A "+hour+":"+min);
                            
                            for(var a=0;a<Luwa_4A_End_Time.length;a++)
                            {
                                var Time2=Luwa_4A_End_Time[a];
                                let h2 = Time2.split(":"); // Splitting the input string
                                let hour2 =parseInt(h2[0]); 
                                let min2 = parseInt(h2[1]);
                                
                                var diff_Hour=parseInt(hour2-hour);
                                var diff_min=parseInt(min2-min);
                                //console.log("diff_min "+Luwa_4A_Start_Time[x]+" "+Luwa_4A_End_Time[a]+" "+diff_min);


                                if (diff_Hour == 0 && diff_min >= 0 && diff_min < 4 || diff_Hour == 0 && diff_min < 0 && diff_min > -3 ) 
                                {
                                    New_4A_End[x]=Luwa_4A_End_Data[a];
                                }
                            }
                        }
                        //  //console.log(New_1B_End)
                    }
                    catch(err)
                    {
                        //console.log("Error 7B: "+err)
                        //console.log(Luwa_4B_Start_Time);
                        //console.log(Luwa_4B_Start_Length);
                        //console.log(Luwa_4B_End_Length);
                        //console.log(Luwa_4B_End_Data);
                        //console.log(Luwa_4B_End_Time);
                        //console.log(" ");
                                    
                    }


                    //Chart 8 Array (8A) (6/2/24)
                    Data_Ary=(res.Data_Ary29.join(", "));
                    Data_Ary2=(res.Data_Ary30.join(", "));
                    Data_Ary3=(res.Data_Ary31.join(", "));
                    Data_Ary4=(res.Data_Ary32.join(", "));
                    var New_4B_End=[];
                    


                    Luwa_4B_Start_Length= res.Data_Ary29.length;
                    Luwa_4B_End_Length= res.Data_Ary31.length;


                    Luwa_4B_Start_Data=[];
                    Luwa_4B_Start_Time=[];
                    Luwa_4B_End_Data=[];
                    Luwa_4B_End_Time=[];

                    for (var i = 0; i < Luwa_4B_Start_Length; i++)
                     {
                        Luwa_4B_Start_Data.push(res.Data_Ary29[i]);
                        Luwa_4B_Start_Time.push(res.Data_Ary30[i]);
                      last_index_Luwa_4B_Start=i;
                       
                    }
                    for (var i = 0; i < Luwa_4B_End_Length; i++)
                    {
                        Luwa_4B_End_Data.push(res.Data_Ary31[i]);
                        Luwa_4B_End_Time.push(res.Data_Ary32[i]);
                        last_index_line_4B_End=i;
                    }
                    console.log(last_index_Luwa_4B_Start)

                    try
                    {

                        for(var x=0;x<Luwa_4B_Start_Data.length;x++)
                        {
                            
                            //console.log(" ");
                            Time=Luwa_4B_Start_Time[x];
                            let h = Time.split(":"); // Splitting the input string
                            let hour =parseInt(h[0]); 
                            let min = parseInt(h[1]);
                            //console.log("Time 8A "+hour+":"+min);
                            
                            for(var a=0;a<Luwa_4B_End_Time.length;a++)
                            {
                                var Time2=Luwa_4B_End_Time[a];
                                let h2 = Time2.split(":"); // Splitting the input string
                                let hour2 =parseInt(h2[0]); 
                                let min2 = parseInt(h2[1]);
                                
                                var diff_Hour=parseInt(hour2-hour);
                                var diff_min=parseInt(min2-min);
                                //console.log("diff_min "+Luwa_4B_Start_Time[x]+" "+Luwa_4B_End_Time[a]+" "+diff_min);


                                if (diff_Hour == 0 && diff_min >= 0 && diff_min < 4 || diff_Hour == 0 && diff_min < 0 && diff_min > -3 ) 
                                {
                                    New_4B_End[x]=Luwa_4B_End_Data[a];
                                }
                            }
                        }
                        //  //console.log(New_1B_End)
                    }
                    catch(err)
                    {
                        //console.log("Error 8B: "+err)
                        //console.log(Luwa_4B_Start_Time);
                        //console.log(Luwa_4B_Start_Length);
                        //console.log(Luwa_4B_End_Length);
                        //console.log(Luwa_4B_End_Data);
                        //console.log(Luwa_4B_End_Time);
                        //console.log(" ");
                                    
                    }


               



                    //Chart 9 Array (9A) (6/2/24)
                    Luwa_5A_Start_Data=(res.Data_Ary33.join(", "));
                    Luwa_5A_Start_Time=(res.Data_Ary34.join(", "));
                    Luwa_5A_End_Data=(res.Data_Ary35.join(", "));
                    Luwa_5A_End_Time=(res.Data_Ary36.join(", "));
                    var New_5A_End=[];
                   
                    
                    Luwa_5A_Start_Length= res.Data_Ary33.length;
                    Luwa_5A_End_Length= res.Data_Ary35.length;
                    
                   
                  
                   

                  
                    try
                    {
                         for(var x=0;x<Luwa_5A_Start_Data.length;x++)
                        {
                            //console.log(" ");
                            Time=Luwa_5A_Start_Time[x];
                            let h = Time.split(":"); // Splitting the input string
                            let hour =parseInt(h[0]); 
                            let min = parseInt(h[1]);
                            //console.log("Time A "+hour+":"+min);
                            
                            for(var a=0;a<Luwa_5A_End_Time.length;a++)
                            {
                                var Time2=Luwa_5A_End_Time[a];
                                let h2 = Time2.split(":"); // Splitting the input string
                                let hour2 =parseInt(h2[0]); 
                                let min2 = parseInt(h2[1]);
                            
                                var diff_Hour=parseInt(hour2-hour);
                                var diff_min=parseInt(min2-min);
                                //console.log("diff_Hour "+diff_Hour);
                                //console.log("diff_min "+Luwa_5A_Start_Time[x]+" "+Luwa_5A_End_Time[a]+" "+diff_min);


                               if (diff_Hour == 0 && diff_min >= 0 && diff_min < diff_min_high || diff_Hour == 0 && diff_min < 0 && diff_min > diff_min_low ) 
                                {

                                    New_5A_End[x]=Luwa_5A_End_Data[a];
                               }
                            }

                        }
                       //console.log(New_5A_End)
                    }
                    catch(err)
                    {

                        //console.log("Error Luwa 5A: "+err)
                        //New_6B=line6B_Data;
                        //console.log(line6A_Data);
                        //console.log(Luwa_5A_Start_Time);

                        //console.log(Luwa_5A_Start_Length);
                        //console.log(Luwa_5A_End_Length);


                        //console.log(Luwa_5A_End_Data);
                        //console.log(Luwa_5A_End_Time);
                        //console.log(" ");
                    }


                    


                    //Chart 10 Array (10A) (6/2/24)
                    Luwa_5B_Start_Data=(res.Data_Ary37.join(", "));
                    Luwa_5B_Start_Time=(res.Data_Ary38.join(", "));
                    Luwa_5B_End_Data=(res.Data_Ary39.join(", "));
                    Luwa_5B_End_Time=(res.Data_Ary40.join(", "));
                    var New_5B_End=[];

                    Luwa_5B_Start_Length= res.Data_Ary37.length;
                    Luwa_5B_End_Length= res.Data_Ary39.length;



                  
                    
                  
                    
                    try
                    {
                        for(var x=0;x<Luwa_5B_Start_Data.length;x++)
                            {
                                //console.log(" ");
                                Time=Luwa_5B_Start_Time[x];
                                let h = Time.split(":"); // Splitting the input string
                                let hour =parseInt(h[0]); 
                                let min = parseInt(h[1]);
                                //console.log("Time 10A "+hour+":"+min);
                                
                                for(var a=0;a<Luwa_5B_End_Time.length;a++)
                                {
                                    var Time2=Luwa_5B_End_Time[a];
                                    let h2 = Time2.split(":"); // Splitting the input string
                                    let hour2 =parseInt(h2[0]); 
                                    let min2 = parseInt(h2[1]);
                                    var diff_Hour=parseInt(hour2-hour);
                                    var diff_min=parseInt(min2-min);
                                    //console.log("diff_Hour "+diff_Hour);
                                    //console.log("diff_min "+Luwa_5B_Start_Time[x]+" "+Luwa_5B_End_Time[a]+" "+diff_min);
                                    
                                   if (diff_Hour == 0 && diff_min >= 0 && diff_min < diff_min_high || diff_Hour == 0 && diff_min < 0 && diff_min > diff_min_low ) 
                                    {
                                        
                                        New_5B_End[x]=Luwa_5B_End_Data[a];
                                    }


                                }

                            }
                           //console.log(New_5B_End)
                        }
                        catch(err)
                        {
                            //console.log("Error Luwa 5B: "+err)
                           
                        }

                        



                   

                    //Chart 11 Array [lUWA 6A] (17/2/24)
                    Luwa_6A_Start_Data=(res.Data_Ary41.join(", "));
                    Luwa_6A_Start_Time=(res.Data_Ary42.join(", "));
                    Luwa_6A_End_Data=(res.Data_Ary43.join(", "));
                    Luwa_6A_End_Time=(res.Data_Ary44.join(", "));

                    var New_6A_End=[];

                    Luwa_6A_Start_Length= res.Data_Ary41.length;
                    Luwa_6A_End_Length= res.Data_Ary43.length;


                    

                     try
                    {
                        for(var x=0;x<Luwa_6A_Start_Data.length;x++)
                            {
                                //console.log(" ");
                                Time=Luwa_6A_Start_Time[x];
                                let h = Time.split(":"); // Splitting the input string
                                let hour =parseInt(h[0]); 
                                let min = parseInt(h[1]);
                                //console.log("Time lUWA 6A "+hour+":"+min);
                                
                                for(var a=0;a<Luwa_6A_End_Time.length;a++)
                                {
                                    var Time2=Luwa_6A_End_Time[a];
                                    let h2 = Time2.split(":"); // Splitting the input string
                                    let hour2 =parseInt(h2[0]); 
                                    let min2 = parseInt(h2[1]);
                                    var diff_Hour=parseInt(hour2-hour);
                                    var diff_min=parseInt(min2-min);
                                    //console.log("diff_Hour "+diff_Hour);
                                    //console.log("diff_min "+Luwa_6A_Start_Time[x]+" "+Luwa_6A_End_Time[a]+" "+diff_min);
                                    
                                   if (diff_Hour == 0 && diff_min >= 0 && diff_min < diff_min_high || diff_Hour == 0 && diff_min < 0 && diff_min > diff_min_low ) 
                                    {
                                        
                                        New_6A_End[x]=Luwa_6A_End_Data[a];
                                    }


                                }

                            }
                            //console.log(New_6A_End)
                        }
                        catch(err)
                        {
                            //console.log("Error LUWA 6A: "+err)
                            //New_6B=line6B_Data;
                            //console.log(line6A_Data);
                            //console.log(Luwa_5B_Start_Time);

                            //console.log(Luwa_5B_Start_Length);
                            //console.log(line6B_Length);


                            //console.log(Luwa_5B_End_Data);
                            //console.log(Luwa_5B_End_Time);
                            //console.log(" ");
                        }





                   
                    //Chart 12 Array (12A) (18/2/24)
                    Luwa_6B_Start_Data=(res.Data_Ary45.join(", "));
                    Luwa_6B_Start_Time=(res.Data_Ary46.join(", "));
                    Luwa_6B_End_Data=(res.Data_Ary47.join(", "));
                    Luwa_6B_End_Time=(res.Data_Ary48.join(", "));
                    var New_6B_End=[];

                    Luwa_6B_Start_Length= res.Data_Ary45.length;
                    Luwa_6B_End_Length= res.Data_Ary47.length;


                    

                    try
                    {
                        for(var x=0;x<Luwa_6B_Start_Data.length;x++)
                            {
                                //console.log(" ");
                                Time=Luwa_6B_Start_Time[x];
                                let h = Time.split(":"); // Splitting the input string
                                let hour =parseInt(h[0]); 
                                let min = parseInt(h[1]);
                                //console.log("Time LUWA 6B "+hour+":"+min);
                                
                                for(var a=0;a<Luwa_6B_End_Time.length;a++)
                                {
                                    var Time2=Luwa_6B_End_Time[a];
                                    let h2 = Time2.split(":"); // Splitting the input string
                                    let hour2 =parseInt(h2[0]); 
                                    let min2 = parseInt(h2[1]);
                                    var diff_Hour=parseInt(hour2-hour);
                                    var diff_min=parseInt(min2-min);
                                    //console.log("diff_Hour "+diff_Hour);
                                    //console.log("diff_min "+Luwa_6B_Start_Time[x]+" "+Luwa_6B_End_Time[a]+" "+diff_min);
                                    
                                   if (diff_Hour == 0 && diff_min >= 0 && diff_min < diff_min_high || diff_Hour == 0 && diff_min < 0 && diff_min > diff_min_low ) 
                                    {
                                        
                                        New_6B_End[x]=Luwa_6B_End_Data[a];
                                    }


                                }

                            }
                          //  //console.log(New_6B_End)
                        }
                        catch(err)
                        {
                            //console.log("Error Luwa 6B: "+err)
                            //New_6B=line6B_Data;
                            //console.log(line6A_Data);
                            //console.log(Luwa_5B_Start_Time);

                            //console.log(Luwa_5B_Start_Length);
                            //console.log(line6B_Length);


                            //console.log(Luwa_5B_End_Data);
                            //console.log(Luwa_5B_End_Time);
                            //console.log(" ");
                        }


              
                  
                 


                    //Chart 13 Array (13A) (18/2/24)
                    Luwa_7A_Start_Data=(res.Data_Ary49.join(", "));
                    Luwa_7A_Start_Time=(res.Data_Ary50.join(", "));
                    Luwa_7A_End_Data=(res.Data_Ary51.join(", "));
                    Luwa_7A_End_Time=(res.Data_Ary52.join(", "));
                    var New_7A_End=[];

                    Luwa_7A_Start_Length= res.Data_Ary49.length;
                    Luwa_7A_End_Length= res.Data_Ary51.length;


                 

                    try
                    {
                        for(var x=0;x<Luwa_7A_Start_Data.length;x++)
                            {
                                //console.log(" ");
                                Time=Luwa_7A_Start_Time[x];
                                let h = Time.split(":"); // Splitting the input string
                                let hour =parseInt(h[0]); 
                                let min = parseInt(h[1]);
                                //console.log("Time Luwa 7A "+hour+":"+min);
                                
                                for(var a=0;a<Luwa_7A_End_Time.length;a++)
                                {
                                    var Time2=Luwa_7A_End_Time[a];
                                    let h2 = Time2.split(":"); // Splitting the input string
                                    let hour2 =parseInt(h2[0]); 
                                    let min2 = parseInt(h2[1]);
                                    var diff_Hour=parseInt(hour2-hour);
                                    var diff_min=parseInt(min2-min);
                                    //console.log("diff_Hour "+diff_Hour);
                                    //console.log("diff_min "+Luwa_7A_Start_Time[x]+" "+Luwa_7A_End_Time[a]+" "+diff_min);
                                    
                                   if (diff_Hour == 0 && diff_min >= 0 && diff_min < diff_min_high || diff_Hour == 0 && diff_min < 0 && diff_min > diff_min_low ) 
                                    {
                                        
                                        New_7A_End[x]=Luwa_7A_End_Data[a];
                                    }


                                }

                            }
                           
                        }
                        catch(err)
                        {
                            //console.log("Error Luwa 7A: "+err)
                            
                        }

                        
                    //Chart 14 Array (14A) (18/2/24)
                    Luwa_7B_Start_Data=(res.Data_Ary53.join(", "));
                    Luwa_7B_Start_Time=(res.Data_Ary54.join(", "));
                    Luwa_7B_End_Data=(res.Data_Ary55.join(", "));
                    Luwa_7B_End_Time=(res.Data_Ary56.join(", "));
                    var New_7B_End=[];
                    

                    Luwa_7B_Start_Length= res.Data_Ary53.length;
                    Luwa_7B_End_Length= res.Data_Ary55.length;
                    
                   

                    try
                    {
                        for(var x=0;x<Luwa_7B_Start_Data.length;x++)
                            {
                                //console.log(" ");
                                Time=Luwa_7B_Start_Time[x];
                                let h = Time.split(":"); // Splitting the input string
                                let hour =parseInt(h[0]); 
                                let min = parseInt(h[1]);
                                //console.log("Time 14A "+hour+":"+min);
                                
                                for(var a=0;a<Luwa_7B_End_Time.length;a++)
                                {
                                    var Time2=Luwa_7B_End_Time[a];
                                    let h2 = Time2.split(":"); // Splitting the input string
                                    let hour2 =parseInt(h2[0]); 
                                    let min2 = parseInt(h2[1]);
                                    var diff_Hour=parseInt(hour2-hour);
                                    var diff_min=parseInt(min2-min);
                                    //console.log("diff_Hour "+diff_Hour);
                                    //console.log("diff_min "+Luwa_7B_Start_Time[x]+" "+Luwa_7B_End_Time[a]+" "+diff_min);
                                    
                                    if (diff_Hour == 0 && diff_min >= 0 && diff_min < diff_min_high || diff_Hour == 0 && diff_min < 0 && diff_min > diff_min_low ) 
                                    {
                                        
                                        New_7B_End[x]=Luwa_7B_End_Data[a];
                                    }


                                }

                            }

                        }
                        catch(err)
                        {
                            //console.log("Error Luwa 7B: "+err)
                           
                        }

                        
                    

                        

                    //Chart 15 Array (15A) (18/2/24)
                    Luwa_8A_Start_Data=(res.Data_Ary57.join(", "));
                    Luwa_8A_Start_Time=(res.Data_Ary58.join(", "));
                    Luwa_8A_End_Data=(res.Data_Ary59.join(", "));
                    Luwa_8A_End_Time=(res.Data_Ary60.join(", "));
                    var New_8A_End=[];

                    Luwa_8A_Start_Length= res.Data_Ary57.length;
                    Luwa_8A_End_Length= res.Data_Ary59.length;



                    try
                    {
                        for(var x=0;x<Luwa_8A_Start_Data.length;x++)
                            {
                                //console.log(" ");
                                Time=Luwa_8A_Start_Time[x];
                                let h = Time.split(":"); // Splitting the input string
                                let hour =parseInt(h[0]); 
                                let min = parseInt(h[1]);
                                //console.log("Time 15A "+hour+":"+min);
                                
                                for(var a=0;a<Luwa_8A_End_Time.length;a++)
                                {
                                    var Time2=Luwa_8A_End_Time[a];
                                    let h2 = Time2.split(":"); // Splitting the input string
                                    let hour2 =parseInt(h2[0]); 
                                    let min2 = parseInt(h2[1]);
                                    var diff_Hour=parseInt(hour2-hour);
                                    var diff_min=parseInt(min2-min);
                                    //console.log("diff_Hour "+diff_Hour);
                                    //console.log("diff_min "+Luwa_8A_Start_Time[x]+" "+Luwa_8A_End_Time[a]+" "+diff_min);
                                    
                                   if (diff_Hour == 0 && diff_min >= 0 && diff_min < diff_min_high || diff_Hour == 0 && diff_min < 0 && diff_min > diff_min_low ) 
                                    {
                                        
                                        New_8A_End[x]=Luwa_8A_End_Data[a];
                                    }


                                }

                            }
                            //console.log(New_8A_End)
                        }
                        catch(err)
                        {
                            //console.log("Error 15B: "+err)
                           
                        }



                   
                       
                   


                    //Chart 16 Array (16A) (18/2/24)
                    Luwa_8B_Start_Data=(res.Data_Ary61.join(", "));
                    Luwa_8B_Start_Time=(res.Data_Ary62.join(", "));
                    Luwa_8B_End_Data=(res.Data_Ary63.join(", "));
                    Luwa_8B_End_Time=(res.Data_Ary64.join(", "));
                    var New_8B_End=[];
                    

                    Luwa_8B_Start_Length= res.Data_Ary61.length;
                    Luwa_8B_End_Length= res.Data_Ary63.length;


                    
                     try
                    {
                        for(var x=0;x<Luwa_8B_Start_Data.length;x++)
                            {
                                //console.log(" ");
                                Time=Luwa_8B_Start_Time[x];
                                let h = Time.split(":"); // Splitting the input string
                                let hour =parseInt(h[0]); 
                                let min = parseInt(h[1]);
                                //console.log("Time Luwa 8B "+hour+":"+min);
                                
                                for(var a=0;a<Luwa_8B_End_Time.length;a++)
                                {
                                    var Time2=Luwa_8B_End_Time[a];
                                    let h2 = Time2.split(":"); // Splitting the input string
                                    let hour2 =parseInt(h2[0]); 
                                    let min2 = parseInt(h2[1]);
                                    var diff_Hour=parseInt(hour2-hour);
                                    var diff_min=parseInt(min2-min);
                                    //console.log("diff_Hour "+diff_Hour);
                                    //console.log("diff_min "+Luwa_8B_Start_Time[x]+" "+Luwa_8B_End_Time[a]+" "+diff_min);
                                    
                                   if (diff_Hour == 0 && diff_min >= 0 && diff_min < diff_min_high || diff_Hour == 0 && diff_min < 0 && diff_min > diff_min_low ) 
                                    {
                                        
                                        New_8B_End[x]=Luwa_8B_End_Data[a];
                                    }


                                }

                            }
                          
                        }
                        catch(err)
                        {
                            //console.log("Error 16B: "+err)
                           
                        }
                           
                            //Chart 1
                            let Luwa_1A_Start_lastValue = Luwa_1A_Start_Data[Luwa_1A_Start_Data.length - 1] === undefined ? 0 : Luwa_1A_Start_Data[Luwa_1A_Start_Data.length - 1];
                            let Luwa_1A_Start_last_Time = Luwa_1A_Start_Time[Luwa_1A_Start_Time.length - 1] === undefined ? 0 : Luwa_1A_Start_Time[Luwa_1A_Start_Time.length - 1];
                            let New_1A_End_lastValue = New_1A_End[New_1A_End.length - 1] === undefined ? 0 : New_1A_End[New_1A_End.length - 1];
                            let Luwa_1A_End_last_Time   = Luwa_1A_End_Time[Luwa_1A_End_Time.length - 1] === undefined ? 0 : Luwa_1A_End_Time[Luwa_1A_End_Time.length - 1];


                            //Chart 2
                            let Luwa_1B_Start_lastValue = Luwa_1B_Start_Data[Luwa_1B_Start_Data.length - 1] === undefined ? 0 : Luwa_1B_Start_Data[Luwa_1B_Start_Data.length - 1];
                            let Luwa_1B_Start_last_Time = Luwa_1B_Start_Time[Luwa_1B_Start_Time.length - 1] === undefined ? 0 : Luwa_1B_Start_Time[Luwa_1B_Start_Time.length - 1];
                            let New_1B_End_lastValue = New_1B_End[New_1B_End.length - 1] === undefined ? 0 : New_1B_End[New_1B_End.length - 1];
                            let Luwa_1B_End_last_Time   = Luwa_1B_End_Time[Luwa_1B_End_Time.length - 1] === undefined ? 0 : Luwa_1B_End_Time[Luwa_1B_End_Time.length - 1];

                            //Chart 3
                            let Luwa_2A_Start_lastValue = Luwa_2A_Start_Data[Luwa_2A_Start_Data.length - 1] === undefined ? 0 : Luwa_2A_Start_Data[Luwa_2A_Start_Data.length - 1];
                            let Luwa_2A_Start_last_Time = Luwa_2A_Start_Time[Luwa_2A_Start_Time.length - 1] === undefined ? 0 : Luwa_2A_Start_Time[Luwa_2A_Start_Time.length - 1];
                            let New_2A_End_lastValue    = New_2A_End[New_2A_End.length - 1] === undefined ? 0 : New_2A_End[New_2A_End.length - 1];
                            let Luwa_2A_End_last_Time   = Luwa_2A_End_Time[Luwa_2A_End_Time.length - 1] === undefined ? 0 : Luwa_2A_End_Time[Luwa_2A_End_Time.length - 1];

                           
                            
                            //Chart 4
                            let Luwa_2B_Start_lastValue = Luwa_2B_Start_Data[Luwa_2B_Start_Data.length - 1] === undefined ? 0 : Luwa_2B_Start_Data[Luwa_2B_Start_Data.length - 1];
                            let Luwa_2B_Start_last_Time = Luwa_2B_Start_Time[Luwa_2B_Start_Time.length - 1] === undefined ? 0 : Luwa_2B_Start_Time[Luwa_2B_Start_Time.length - 1];
                            let New_2B_End_lastValue = New_2B_End[New_2B_End.length - 1] === undefined ? 0 : New_2B_End[New_2B_End.length - 1];
                            let Luwa_2B_End_last_Time   = Luwa_2B_End_Time[Luwa_2B_End_Time.length - 1] === undefined ? 0 : Luwa_2B_End_Time[Luwa_2B_End_Time.length - 1];

                            //Chart 5
                            let Luwa_3A_Start_lastValue = Luwa_3A_Start_Data[Luwa_3A_Start_Data.length - 1] === undefined ? 0 : Luwa_3A_Start_Data[Luwa_3A_Start_Data.length - 1];
                            let Luwa_3A_Start_last_Time = Luwa_3A_Start_Time[Luwa_3A_Start_Time.length - 1] === undefined ? 0 : Luwa_3A_Start_Time[Luwa_3A_Start_Time.length - 1];
                            let New_3A_End_lastValue = New_3A_End[New_3A_End.length - 1] === undefined ? 0 : New_3A_End[New_3A_End.length - 1];
                            let Luwa_3A_End_last_Time   = Luwa_3A_End_Time[Luwa_3A_End_Time.length - 1] === undefined ? 0 : Luwa_3A_End_Time[Luwa_3A_End_Time.length - 1];

                            //Chart 6
                            let Luwa_3B_Start_lastValue = Luwa_3B_Start_Data[Luwa_3B_Start_Data.length - 1] === undefined ? 0 : Luwa_3B_Start_Data[Luwa_3B_Start_Data.length - 1];
                            let Luwa_3B_Start_last_Time = Luwa_3B_Start_Time[Luwa_3B_Start_Time.length - 1] === undefined ? 0 : Luwa_3B_Start_Time[Luwa_3B_Start_Time.length - 1];
                            let New_3B_End_lastValue = New_3B_End[New_3B_End.length - 1] === undefined ? 0 : New_3B_End[New_3B_End.length - 1];
                            let Luwa_3B_End_last_Time   = Luwa_3B_End_Time[Luwa_3B_End_Time.length - 1] === undefined ? 0 : Luwa_3B_End_Time[Luwa_3B_End_Time.length - 1];

                           

                            let Luwa_4A_Start_lastValue = Luwa_4A_Start_Data[Luwa_4A_Start_Data.length - 1] === undefined ? 0 : Luwa_4A_Start_Data[Luwa_4A_Start_Data.length - 1];
                            let New_4A_End_lastValue = New_4A_End[New_4A_End.length - 1] === undefined ? 0 : New_4A_End[New_4A_End.length - 1];
                            let Luwa_4A_Start_last_Time = Luwa_4A_Start_Time[Luwa_4A_Start_Time.length - 1] === undefined ? 0 : Luwa_4A_Start_Time[Luwa_4A_Start_Time.length - 1];
                            let Luwa_4A_End_last_Time   = Luwa_4A_End_Time[Luwa_4A_End_Time.length - 1] === undefined ? 0 : Luwa_4A_End_Time[Luwa_4A_End_Time.length - 1];


                            let Luwa_4B_Start_lastValue = Luwa_4B_Start_Data[Luwa_4B_Start_Data.length - 1] === undefined ? 0 : Luwa_4B_Start_Data[Luwa_4B_Start_Data.length - 1];
                            let New_4B_End_lastValue = New_4B_End[New_4B_End.length - 1] === undefined ? 0 : New_4B_End[New_4B_End.length - 1];
                            let Luwa_4B_Start_last_Time = Luwa_4B_Start_Time[Luwa_4B_Start_Time.length - 1] === undefined ? 0 : Luwa_4B_Start_Time[Luwa_4B_Start_Time.length - 1];
                            let Luwa_4B_End_last_Time   = Luwa_4B_End_Time[Luwa_4B_End_Time.length - 1] === undefined ? 0 : Luwa_4B_End_Time[Luwa_4B_End_Time.length - 1];

                            let Luwa_5A_Start_lastValue = Luwa_5A_Start_Data;
                            let New_5A_End_lastValue    = Luwa_5A_End_Data;
                            let Luwa_5A_Start_last_Time = Luwa_5A_Start_Time;
                            let Luwa_5A_End_last_Time   = Luwa_5A_End_Time;
 
                            
                            let Luwa_5B_Start_lastValue = Luwa_5B_Start_Data;
                            let New_5B_End_lastValue = Luwa_5B_End_Data;
                            let Luwa_5B_Start_last_Time =Luwa_5B_Start_Time;
                            let Luwa_5B_End_last_Time   = Luwa_5B_End_Time;
                            
                            let Luwa_6A_Start_lastValue = Luwa_6A_Start_Data;
                            let New_6A_End_lastValue = Luwa_6A_End_Data
                            let Luwa_6A_Start_last_Time = Luwa_6A_Start_Time
                            let Luwa_6A_End_last_Time   = Luwa_6A_End_Time;
                           
                            let Luwa_6B_Start_lastValue = Luwa_6B_Start_Data;
                            let New_6B_End_lastValue = Luwa_6B_End_Data;
                            let Luwa_6B_Start_last_Time = Luwa_6B_Start_Time;
                            let Luwa_6B_End_last_Time   = Luwa_6B_End_Time;
                           
                           
                            let Luwa_7A_Start_lastValue = Luwa_7A_Start_Data;
                            let New_7A_End_lastValue = Luwa_7A_End_Data;
                            let Luwa_7A_Start_last_Time = Luwa_7A_Start_Time;
                            let Luwa_7A_End_last_Time   = Luwa_7A_End_Time;
                            
                            
                            let Luwa_7B_Start_lastValue = Luwa_7B_Start_Data;
                            let New_7B_End_lastValue = Luwa_7B_End_Data;
                            let Luwa_7B_Start_last_Time = Luwa_7B_Start_Time;
                            let Luwa_7B_End_last_Time   = Luwa_7B_End_Time;
                           
                           
                           
                            let Luwa_8A_Start_lastValue = Luwa_8A_Start_Data;
                            let New_8A_End_lastValue = Luwa_8A_End_Data;
                            let Luwa_8A_Start_last_Time = Luwa_8A_Start_Time;
                            let Luwa_8A_End_last_Time   =Luwa_8A_End_Time;
                            
                            let Luwa_8B_Start_lastValue =Luwa_8B_Start_Data ;
                            let New_8B_End_lastValue = Luwa_8B_End_Data;
                            let Luwa_8B_Start_last_Time = Luwa_8B_Start_Time;
                            let Luwa_8B_End_last_Time   = Luwa_8B_End_Time;
                            
                            
                           
                            
                            console.log("Debug"+" "+Luwa_8B_Start_lastValue+" "+New_8B_End_lastValue+" "+Luwa_8B_Start_last_Time+" "+Luwa_8B_End_last_Time);

                           

                                // Create an object to store the arrays dynamically
                                var New_B_arrays = {};

                                // Populate New_B_arrays with arrays dynamically
                                for (var i = 1; i <= 100; i++) {
                                    New_B_arrays[i] = window["New_" + i + "B"];
                                }

                                //find Machine on or off

                                //Luwa 1A split Last time
                                try
                                {
                                    for (var x = 0; x < 100; x++) 
                                    {
                                       
                                    //     var Time_arr = [];
                                    //     for (var i = 1; i < 9; i++) {
                                    //         Time_arr.push("Luwa_" + i + "A_" + "Start_last_Time");
                                    //         Time_arr.push("Luwa_" + i + "A_" + "End_last_Time");
                                    //     }

                                    //    console.log(Time_arr[x]);
                    

                                        var Time_arr = 
                                        [
                                            Luwa_1A_Start_last_Time,
                                            Luwa_1A_End_last_Time,
                                            Luwa_1B_Start_last_Time,
                                            Luwa_1B_End_last_Time,

                                            Luwa_2A_Start_last_Time,
                                            Luwa_2A_End_last_Time,
                                            Luwa_2B_Start_last_Time,
                                            Luwa_2B_End_last_Time,

                                            Luwa_3A_Start_last_Time,
                                            Luwa_3A_End_last_Time,
                                            Luwa_3B_Start_last_Time,
                                            Luwa_3B_End_last_Time,

                                            Luwa_4A_Start_last_Time,
                                            Luwa_4A_End_last_Time,
                                            Luwa_4B_Start_last_Time,
                                            Luwa_4B_End_last_Time,

                                            Luwa_5A_Start_last_Time,
                                            Luwa_5A_End_last_Time,
                                            Luwa_5B_Start_last_Time,
                                            Luwa_5B_End_last_Time,

                                            Luwa_6A_Start_last_Time,
                                            Luwa_6A_End_last_Time,
                                            Luwa_6B_Start_last_Time,
                                            Luwa_6B_End_last_Time,

                                            Luwa_7A_Start_last_Time,
                                            Luwa_7A_End_last_Time,
                                            Luwa_7B_Start_last_Time,
                                            Luwa_7B_End_last_Time,

                                            Luwa_8A_Start_last_Time,
                                            Luwa_8A_End_last_Time,
                                            Luwa_8B_Start_last_Time,
                                            Luwa_8B_End_last_Time,
                                        
                                        ];
                                        
                                        var last_value_arr=
                                        [
                                            Luwa_1A_Start_lastValue,
                                            New_1A_End_lastValue,
                                            Luwa_1B_Start_lastValue,
                                            New_1B_End_lastValue,

                                            Luwa_2A_Start_lastValue,
                                            New_2A_End_lastValue,
                                            Luwa_2B_Start_lastValue,
                                            New_2B_End_lastValue,
                                            
                                            Luwa_3A_Start_lastValue,
                                            New_3A_End_lastValue,
                                            Luwa_3B_Start_lastValue,
                                            New_3B_End_lastValue,

                                            Luwa_4A_Start_lastValue,
                                            New_4A_End_lastValue,
                                            Luwa_4B_Start_lastValue,
                                            New_4B_End_lastValue,

                                            Luwa_5A_Start_lastValue,
                                            New_5A_End_lastValue,
                                            Luwa_5B_Start_lastValue,
                                            New_5B_End_lastValue,

                                            Luwa_6A_Start_lastValue,
                                            New_6A_End_lastValue,
                                            Luwa_6B_Start_lastValue,
                                            New_6B_End_lastValue,

                                            Luwa_7A_Start_lastValue,
                                            New_7A_End_lastValue,
                                            Luwa_7B_Start_lastValue,
                                            New_7B_End_lastValue,

                                            Luwa_8A_Start_lastValue,
                                            New_8A_End_lastValue,
                                            Luwa_8B_Start_lastValue,
                                            New_8B_End_lastValue,


                                            
                                            


                                          
                                       
                                        ];



                                        var  Dot_arr=
                                        [
                                            "L1ASD_dot",
                                            "L1AED_dot",
                                            "L1BSD_dot",
                                            "L1BED_dot",

                                            "L2ASD_dot",
                                            "L2AED_dot",
                                            "L2BSD_dot",
                                            "L2BED_dot",

                                            "L3ASD_dot",
                                            "L3AED_dot",
                                            "L3BSD_dot",
                                            "L3BED_dot",

                                            "L4ASD_dot",
                                            "L4AED_dot",
                                            "L4BSD_dot",
                                            "L4BED_dot",

                                            "L5ASD_dot",
                                            "L5AED_dot",
                                            "L5BSD_dot",
                                            "L5BED_dot",

                                            "L6ASD_dot",
                                            "L6AED_dot",
                                            "L6BSD_dot",
                                            "L6BED_dot",

                                            "L7ASD_dot",
                                            "L7AED_dot",
                                            "L7BSD_dot",
                                            "L7BED_dot",

                                            "L8ASD_dot",
                                            "L8AED_dot",
                                            "L8BSD_dot",
                                            "L8BED_dot",
                                       
                                            
                                          
                                        
                                        ];
                                        var  Data_arr=[
                                            "L1ASD",
                                            "L1AED",
                                            "L1BSD",
                                            "L1BED",

                                            "L2ASD",
                                            "L2AED",
                                            "L2BSD",
                                            "L2BED",

                                            
                                            "L3ASD",
                                            "L3AED",
                                            "L3BSD",
                                            "L3BED",

                                            "L4ASD",
                                            "L4AED",
                                            "L4BSD",
                                            "L4BED",

                                            "L5ASD",
                                            "L5AED",
                                            "L5BSD",
                                            "L5BED",

                                            "L6ASD",
                                            "L6AED",
                                            "L6BSD",
                                            "L6BED",

                                            "L7ASD",
                                            "L7AED",
                                            "L7BSD",
                                            "L7BED",

                                            "L8ASD",
                                            "L8AED",
                                            "L8BSD",
                                            "L8BED",
                                        
                                        ];
                                        var  Date_arr=[
                                            "L1AST",
                                            "L1AET",
                                            "L1BST",
                                            "L1BET",

                                            "L2AST",
                                            "L2AET",
                                            "L2BST",
                                            "L2BET",

                                            "L3AST",
                                            "L3AET",
                                            "L3BST",
                                            "L3BET",

                                            "L4AST",
                                            "L4AET",
                                            "L4BST",
                                            "L4BET",

                                            "L5AST",
                                            "L5AET",
                                            "L5BST",
                                            "L5BET",

                                            "L6AST",
                                            "L6AET",
                                            "L6BST",
                                            "L6BET",

                                            "L7AST",
                                            "L7AET",
                                            "L7BST",
                                            "L7BET",

                                            "L8AST",
                                            "L8AET",
                                            "L8BST",
                                            "L8BET",
                                           
                                           
                                        ];
                                      //  console.log(Time_arr[x] +x); // Output the first element
                                      
                                        
                                        if(Time_arr[x]=="0"){
                                            Time_arr[x]="00:00";
                                        }

                                        Time3=Time_arr[x];
                                        let h3 = Time3.split(":"); // Splitting the input string
                                        let hour3 =parseInt(h3[0]); 
                                        let min3 = parseInt(h3[1]);

                                        if(hour_now_time_js - hour3==0)
                                            {
                                                if(min_now_time_js-min3<=10)
                                                {
                                                    document.getElementById(Dot_arr[x]).classList.remove('blinkRed');
                                                    document.getElementById(Dot_arr[x]).classList.add('blinkGreen');
                                                }
                                                if(min_now_time_js-min3>=10)
                                                {
                                                    document.getElementById(Dot_arr[x]).classList.remove('blinkGreen');
                                                    document.getElementById(Dot_arr[x]).classList.add('blinkRed');
                                                }
                                            }
                                        else{
                                          document.getElementById(Dot_arr[x]).style.backgroundColor = 'red';
                                      //    document.getElementById('L1AST').innerHTML=hour_now_time_js - hour3;
                                          document.getElementById(Dot_arr[x]).classList.remove('blinkGreen');
                                          document.getElementById(Dot_arr[x]).classList.add('blinkRed');
                                       
                                        }

                                        document.getElementById(Date_arr[x]).innerHTML=Time_arr[x];
                                        document.getElementById(Data_arr[x]).innerHTML=last_value_arr[x];

                                     //   console.log(Dot_arr[x]);

                                }

                               
                            }
                                catch{

                                }














                                // Now, log the entire New_B_arrays object
                                //console.log(New_B_arrays);  


                                ////console.log("Luwa_1A_Start_lastValue ",Luwa_1A_Start_lastValue)
                                ////console.log("New_1A_lastValue ",New_1A_End_lastValue)
                                ////console.log(" ")
                                // document.getElementById('L1ASD').innerHTML=Luwa_1A_Start_lastValue;//Luwa 1A start data
                                // document.getElementById('L1AST').innerHTML=Luwa_1A_Start_last_Time;//Luwa 1A start data

                                


                                ////console.log("Luwa_1B_Start_lastValue ",Luwa_1B_Start_lastValue)
                                ////console.log("New_1B_End_lastValue ",New_1B_End_lastValue)
                                ////console.log(" ")

                                ////console.log("Luwa_2A_Start_lastValue ",Luwa_2A_Start_lastValue)
                                ////console.log("New_2A_End_lastValue ",New_2A_End_lastValue)
                                ////console.log(" ")

                                ////console.log("Luwa_2B_Start_lastValue ",Luwa_2B_Start_lastValue)
                                ////console.log("New_2B_End_lastValue ",New_2B_End_lastValue)
                                ////console.log(" ")

                                ////console.log("Luwa_3A_Start_lastValue ",Luwa_3A_Start_lastValue)
                                ////console.log("New_3A_End_lastValue ",New_3A_End_lastValue)
                                ////console.log(" ")

                                ////console.log("Luwa_3B_Start_lastValue ",Luwa_3B_Start_lastValue)
                                ////console.log("New_3B_End_lastValue ",New_3B_End_lastValue)
                                ////console.log(" ")

                                ////console.log("Luwa_4A_Start_lastValue ",Luwa_4A_Start_lastValue)
                                ////console.log("New_4A_End_lastValue ",New_4A_End_lastValue)
                                ////console.log(" ")

                               //console.log("Luwa_4B_Start_lastValue ",Luwa_4B_Start_lastValue)
                               //console.log("New_4B_End_lastValue ",New_4B_End_lastValue)
                               //console.log(" ")





                }
                )}


    function ReloadContent()
        {
            funLoadUsers();
        }

 


//setTimeout(funLoadUsers, 2000);
funLoadUsers();
setInterval(ReloadContent, 5000);
</script>




<?php
        include '../../headers/footer-bar.php'
    ?> 




</div>  
</body>
</html>
