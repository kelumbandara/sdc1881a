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
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    require_once('../../headers/header.php');
?>


<body>
    
  <!-- Button to open the full screen modal -->
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#fullscreenModal">
    Open Fullscreen Chart
  </button>

  <!-- Full screen modal -->
  <div class="modal fade" id="fullscreenModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen" role="document">
      <div class="modal-content p-0">
        <canvas id="myCharts" style="width:100vw; height:100vh;"></canvas>
      </div>
    </div>
  </div>

  <!-- Bootstrap 5 JS (requires Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('shown.bs.modal', function () {
      const ctx = document.getElementById('myCharts').getContext('2d');
      new Chart(ctx, {
        type: 'line',
        data: {
          labels: ['Jan', 'Feb', 'Mar', 'Apr'],
          datasets: [{
            label: 'Sales',
            data: [10, 20, 30, 40],
            borderColor: 'blue',
            fill: false
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false
        }
      });
    });
  </script>

</body>




<script>
var Global_chart_model="";
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

let lineChart_Model_box = null;
var min_limit=6500;
var max_limit=7000;
var line4A_Time_count=0;
var line4B_Time_count=0;
var line4B_Data_new;
var diff_min_low=-3;
var diff_min_high=3;

        function luwa_1A_model(chart)
           {

             Global_chart_model=chart;
            //alert(Global_chart_model)

            }

        function funLoadUsers()
            {
                console.log("ctx ", ctx);
                console.log("Reload:", new Date().toLocaleTimeString()); // Logs time in HH:MM:SS format

                //------------ Load Line Setting --------------------------------------
                const DataAry = [];
                DataAry[0] = "funGetLineData";        // Table Name
                DataAry[1] = "Active";
               // alert(DataAry[1])
               // alert(DataAry);
                $.post('class/getData_HomeChart1.php', { userpara: DataAry }, function(json_data2)
                {
                    var res = $.parseJSON(json_data2);
                   //alert(res.Data_Ary.join(", "));
                   //alert(json_data2);
                   console.log(json_data2);
                  // console.log("Global_chart_model "+Global_chart_model);
                   //alert(Global_chart_model);



                        //Chart 1 [Luwa 1A] Array
                   
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

                          
                                     

                                        if (diff_Hour == 0 && diff_min >= 0 && diff_min < diff_min_high || diff_Hour == 0 && diff_min < 0 && diff_min > diff_min_low ) 
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
                          
                        }
                        catch(err)
                        {
                            // console.log("Error 1A: "+err)
                            // console.log(line1A_Time);
                            // console.log(line1A_Length);
                            // console.log(line1B_Length);
                            // console.log(line1B_Data);
                            // console.log(line1B_Time);
                            // console.log(" ");
                                        
                        }

                     //Chart 2 Array [luwa 1B]
                    Data_Ary=(res.Data_Ary5.join(", "));
                    Data_Ary2=(res.Data_Ary6.join(", "));
                    Data_Ary3=(res.Data_Ary7.join(", "));
                    Data_Ary4=(res.Data_Ary8.join(", "));
                    var New_1B_End=[];
                    var Chart2_Display_Time=[];
                    
                    

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


                                if (diff_Hour == 0 && diff_min >= 0 && diff_min < diff_min_high || diff_Hour == 0 && diff_min < 0 && diff_min > diff_min_low ) 
                                {
                                    New_1B_End[x]=Luwa_1B_End_Data[a];
                                }
                            }
                        }
                        //console.log(New_1B_End)
                    }

                    catch(err)
                    {
                        console.log("Error Luwa 1B: "+err)
                        // console.log(line2A_Time);
                        // console.log(line2A_Length);
                        // console.log(line2B_Length);
                        // console.log(line2B_Data);
                        // console.log(line2B_Time);
                        // console.log(" ");
                                    
                    }
              
                    //Chart 3 Array [Luwa 2A] (5/2/24)
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


                                if (diff_Hour == 0 && diff_min >= 0 && diff_min < diff_min_high || diff_Hour == 0 && diff_min < 0 && diff_min > diff_min_low ) 
                                {
                                    New_2A_End[x]=Luwa_2A_End_Data[a];
                                }
                            }
                        }
                        ////console.log(New_2B_End)
                    }
                    catch(err)
                    {    console.log("Error Luwa 2A: "+err)
                        // console.log(line3A_Time);
                        // console.log(line3A_Length);
                        // console.log(line3B_Length);
                        // console.log(line3B_Data);
                        // console.log(line3B_Time);
                        // console.log(" ");
            
                    }

                    //Chart 4 Array (Luwa 2B) (5/2/24)
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
                    // //console.log("diff_Hour "+diff_Hour);
                        //console.log("diff_min 4 "+Luwa_2B_Start_Time[x]+" "+Luwa_2B_End_Time[a]+" "+diff_min);


                        if (diff_Hour == 0 && diff_min >= 0 && diff_min < diff_min_high || diff_Hour == 0 && diff_min < 0 && diff_min > diff_min_low ) 
                        {
                            New_2B_End[x]=Luwa_2B_End_Data[a];
                        }
                    }

                    }
                    //console.log(New_2B_End)
                    }
                    catch(err){

                        console.log("Error Luwa 2B: "+err)
                        // New_4B=line4B_Data;
                        // console.log(line4A_Data);
                        // console.log(line4A_Time);
                        // console.log(" ");

                        // console.log(line4B_Data);
                        // console.log(line4B_Time);
                    }



                    //Chart 5 Array (5A) (6/2/24)
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


                                if (diff_Hour == 0 && diff_min >= 0 && diff_min < diff_min_high || diff_Hour == 0 && diff_min < 0 && diff_min > diff_min_low ) 
                                {
                                    New_3A_End[x]=Luwa_3A_End_Data[a];
                                }
                            }
                        }
                        //  //console.log(New_1B_End)
                    }

                    catch(err)
                    {
                        console.log("Error Luwa 3A: "+err)
                        // console.log(line5A_Time);
                        // console.log(line5A_Length);
                        // console.log(line5B_Length);
                        // console.log(line5B_Data);
                        // console.log(line5B_Time);
                        // console.log(" ");
                    }


                   

                    //Chart 6 Array [Luwa 3B] (6/2/24)
                    Data_Ary=(res.Data_Ary21.join(", "));
                    Data_Ary2=(res.Data_Ary22.join(", "));
                    Data_Ary3=(res.Data_Ary23.join(", "));
                    Data_Ary4=(res.Data_Ary24.join(", "));var New_3B_End=[];

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
                            // //console.log("diff_Hour "+diff_Hour);
                            //console.log("diff_min "+Luwa_3B_Start_Time[x]+" "+Luwa_3B_End_Time[a]+" "+diff_min);


                            if (diff_Hour == 0 && diff_min >= 0 && diff_min < diff_min_high || diff_Hour == 0 && diff_min < 0 && diff_min > diff_min_low ) 
                            {
                                New_3B_End[x]=Luwa_3B_End_Data[a];
                            }

                        }

                        }
                        //console.log(New_3B_End)
                        }
                    catch(err){

                        console.log("Error Luwa 3B: "+err)
                        //New_6B=line6B_Data;
                       // console.log(line6A_Data);
                        // console.log(line6A_Time);
                        
                        // console.log(line6A_Length);
                        // console.log(line6B_Length);
                        

                        // console.log(line6B_Data);
                        // console.log(line6B_Time);
                        // console.log(" ");
                        }


                    

                
                 

                    //Chart 7 Array [Luwa 4A] (6/2/24)
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


                                if (diff_Hour == 0 && diff_min >= 0 && diff_min < diff_min_high || diff_Hour == 0 && diff_min < 0 && diff_min > diff_min_low ) 
                                {
                                    New_4A_End[x]=Luwa_4A_End_Data[a];
                                }
                            }
                        }
                        //  //console.log(New_1B_End)
                    }
                    catch(err)
                    {
                        console.log("Error Luwa 4A: "+err)
                        // console.log(line8A_Time);
                        // console.log(line8A_Length);
                        // console.log(line8B_Length);
                        // console.log(line8B_Data);
                        // console.log(line8B_Time);
                        console.log(" ");
                                    
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


                                if (diff_Hour == 0 && diff_min >= 0 && diff_min < diff_min_high || diff_Hour == 0 && diff_min < 0 && diff_min > diff_min_low ) 
                                {
                                    New_4B_End[x]=Luwa_4B_End_Data[a];
                                }
                            }
                        }
                        //  //console.log(New_1B_End)
                    }
                    catch(err)
                    {    console.log("Error Lwua 4B: "+err)
                        // console.log(line8A_Time);
                        // console.log(line8A_Length);
                        // console.log(line8B_Length);
                        // console.log(line8B_Data);
                        // console.log(line8B_Time);
                        // console.log(" ");
                                    
                    }


               



                    //Chart 9 Array (9A) (6/2/24)
                    Data_Ary=(res.Data_Ary33.join(", "));
                    Data_Ary2=(res.Data_Ary34.join(", "));
                    Data_Ary3=(res.Data_Ary35.join(", "));
                    Data_Ary4=(res.Data_Ary36.join(", "));
                    var New_5A_End=[];
                    
                    Luwa_5A_Start_Length= res.Data_Ary33.length;
                    Luwa_5A_End_Length= res.Data_Ary35.length;
                    
                    Luwa_5A_Start_Data=[];
                    Luwa_5A_Start_Time=[];
                    Luwa_5A_End_Data=[];
                    Luwa_5A_End_Time=[];

                    for (var i = 0; i < Luwa_5A_Start_Length; i++)
                     {
                        Luwa_5A_Start_Data.push(res.Data_Ary33[i]);
                        Luwa_5A_Start_Time.push(res.Data_Ary34[i]);
                        last_index_line_5A_Start=i;
                     }
                    for (var i = 0; i < Luwa_5A_End_Length; i++)
                    {
                        Luwa_5A_End_Data.push(res.Data_Ary35[i]);
                        Luwa_5A_End_Time.push(res.Data_Ary36[i]);
                        last_index_line_5A_End=i;
                    }

                    try
                    {
                         for(var x=0;x<Luwa_5A_Start_Data.length;x++)
                        {
                            console.log(" ");
                            Time=Luwa_5A_Start_Time[x];
                            let h = Time.split(":"); // Splitting the input string
                            let hour =parseInt(h[0]); 
                            let min = parseInt(h[1]);
                            console.log("Time A "+hour+":"+min);
                            
                            for(var a=0;a<Luwa_5A_End_Time.length;a++)
                            {
                                var Time2=Luwa_5A_End_Time[a];
                                let h2 = Time2.split(":"); // Splitting the input string
                                let hour2 =parseInt(h2[0]); 
                                let min2 = parseInt(h2[1]);
                            
                                var diff_Hour=parseInt(hour2-hour);
                                var diff_min=parseInt(min2-min);
                                // console.log("diff_Hour "+diff_Hour);
                                console.log("diff_min "+Luwa_5A_Start_Time[x]+" "+Luwa_5A_End_Time[a]+" "+diff_min);


                               if (diff_Hour == 0 && diff_min >= 0 && diff_min < diff_min_high || diff_Hour == 0 && diff_min < 0 && diff_min > diff_min_low ) 
                                {

                                    New_5A_End[x]=Luwa_5A_End_Data[a];
                               }
                            }

                        }
                       // console.log(New_5A_End)
                    }
                    catch(err)
                    {

                        console.log("Error Luwa 5A: "+err)
                        //New_6B=line6B_Data;
                        // console.log(line6A_Data);
                        // console.log(Luwa_5A_Start_Time);

                        // console.log(Luwa_5A_Start_Length);
                        // console.log(Luwa_5A_End_Length);


                        // console.log(Luwa_5A_End_Data);
                        // console.log(Luwa_5A_End_Time);
                        // console.log(" ");
                    }



                   



                    //Chart 10 Array [Luwa 5B] (6/2/24)
                    Data_Ary=(res.Data_Ary37.join(", "));
                    Data_Ary2=(res.Data_Ary38.join(", "));
                    Data_Ary3=(res.Data_Ary39.join(", "));
                    Data_Ary4=(res.Data_Ary40.join(", "));
                    var New_5B_End=[];

                    Luwa_5B_Start_Length= res.Data_Ary37.length;
                    Luwa_5B_End_Length= res.Data_Ary39.length;



                    Luwa_5B_Start_Data=[];
                    Luwa_5B_Start_Time=[];
                    Luwa_5B_End_Data=[];
                    Luwa_5B_End_Time=[];

                    for (var i = 0; i < Luwa_5B_Start_Length; i++)
                    {
                        Luwa_5B_Start_Data.push(res.Data_Ary37[i]);
                        Luwa_5B_Start_Time.push(res.Data_Ary38[i]);
                        last_index_line_5B_Start=i;
                      
                    }
                    for (var i = 0; i < Luwa_5B_End_Length; i++)
                    {
                        Luwa_5B_End_Data.push(res.Data_Ary39[i]);
                        Luwa_5B_End_Time.push(res.Data_Ary40[i]);
                        last_index_line_5B_End=i;
                    }
                    try
                    {
                        for(var x=0;x<Luwa_5B_Start_Data.length;x++)
                            {
                                console.log(" ");
                                Time=Luwa_5B_Start_Time[x];
                                let h = Time.split(":"); // Splitting the input string
                                let hour =parseInt(h[0]); 
                                let min = parseInt(h[1]);
                                console.log("Time 10A "+hour+":"+min);
                                
                                for(var a=0;a<Luwa_5B_End_Time.length;a++)
                                {
                                    var Time2=Luwa_5B_End_Time[a];
                                    let h2 = Time2.split(":"); // Splitting the input string
                                    let hour2 =parseInt(h2[0]); 
                                    let min2 = parseInt(h2[1]);
                                    var diff_Hour=parseInt(hour2-hour);
                                    var diff_min=parseInt(min2-min);
                                    // console.log("diff_Hour "+diff_Hour);
                                    console.log("diff_min "+Luwa_5B_Start_Time[x]+" "+Luwa_5B_End_Time[a]+" "+diff_min);
                                    
                                   if (diff_Hour == 0 && diff_min >= 0 && diff_min < diff_min_high || diff_Hour == 0 && diff_min < 0 && diff_min > diff_min_low ) 
                                    {
                                        
                                        New_5B_End[x]=Luwa_5B_End_Data[a];
                                    }


                                }

                            }
                           // console.log(New_5B_End)
                        }
                        catch(err)
                        {
                            console.log("Error Luwa 5B: "+err)
                           
                        }

                        



                   

                    //Chart 11 Array [lUWA 6A] (17/2/24)
                    Data_Ary=(res.Data_Ary41.join(", "));
                    Data_Ary2=(res.Data_Ary42.join(", "));
                    Data_Ary3=(res.Data_Ary43.join(", "));
                    Data_Ary4=(res.Data_Ary44.join(", "));

                    var New_6A_End=[];

                    Luwa_6A_Start_Length= res.Data_Ary41.length;
                    Luwa_6A_End_Length= res.Data_Ary43.length;


                    Luwa_6A_Start_Data=[];
                    Luwa_6A_Start_Time=[];
                    
                    Luwa_6A_End_Data=[];
                    Luwa_6A_End_Time=[]

                    for (var i = 0; i < Luwa_6A_Start_Length; i++)
                     {
                        Luwa_6A_Start_Data.push(res.Data_Ary41[i]);
                        Luwa_6A_Start_Time.push(res.Data_Ary42[i]);
                        last_index_line_6A_Start=i;
                        
                    }
                    for (var i = 0; i < Luwa_6A_End_Length; i++)
                     { 
                        Luwa_6A_End_Data.push(res.Data_Ary43[i]);
                        Luwa_6A_End_Time.push(res.Data_Ary44[i]);
                        last_index_line_6A_End=i;

                     }

                     try
                    {
                        for(var x=0;x<Luwa_6A_Start_Data.length;x++)
                            {
                                console.log(" ");
                                Time=Luwa_6A_Start_Time[x];
                                let h = Time.split(":"); // Splitting the input string
                                let hour =parseInt(h[0]); 
                                let min = parseInt(h[1]);
                                console.log("Time lUWA 6A "+hour+":"+min);
                                
                                for(var a=0;a<Luwa_6A_End_Time.length;a++)
                                {
                                    var Time2=Luwa_6A_End_Time[a];
                                    let h2 = Time2.split(":"); // Splitting the input string
                                    let hour2 =parseInt(h2[0]); 
                                    let min2 = parseInt(h2[1]);
                                    var diff_Hour=parseInt(hour2-hour);
                                    var diff_min=parseInt(min2-min);
                                    // console.log("diff_Hour "+diff_Hour);
                                    console.log("diff_min "+Luwa_6A_Start_Time[x]+" "+Luwa_6A_End_Time[a]+" "+diff_min);
                                    
                                   if (diff_Hour == 0 && diff_min >= 0 && diff_min < diff_min_high || diff_Hour == 0 && diff_min < 0 && diff_min > diff_min_low ) 
                                    {
                                        
                                        New_6A_End[x]=Luwa_6A_End_Data[a];
                                    }


                                }

                            }
                            console.log(New_6A_End)
                        }
                        catch(err)
                        {
                            console.log("Error LUWA 6A: "+err)
                            //New_6B=line6B_Data;
                            // console.log(line6A_Data);
                            // console.log(Luwa_5B_Start_Time);

                            // console.log(Luwa_5B_Start_Length);
                            // console.log(line6B_Length);


                            // console.log(Luwa_5B_End_Data);
                            // console.log(Luwa_5B_End_Time);
                            // console.log(" ");
                        }





                   
                    //Chart 12 Array (12A) (18/2/24)
                    Data_Ary=(res.Data_Ary45.join(", "));
                    Data_Ary2=(res.Data_Ary46.join(", "));
                    Data_Ar3=(res.Data_Ary47.join(", "));
                    Data_Ary4=(res.Data_Ary48.join(", "));
                    var New_6B_End=[];

                    Luwa_6B_Start_Length= res.Data_Ary45.length;
                    Luwa_6B_End_Length= res.Data_Ary47.length;


                    Luwa_6B_Start_Data=[];
                    Luwa_6B_Start_Time=[];
                    Luwa_6B_End_Data=[];
                    Luwa_6B_End_Time=[];

                    for (var i = 0; i < Luwa_6B_Start_Length; i++)
                     {
                        Luwa_6B_Start_Data.push(res.Data_Ary45[i]);
                        Luwa_6B_Start_Time.push(res.Data_Ary46[i]);
                        last_index_line_6B_Start=i;
                    }
                    for (var i = 0; i < Luwa_6B_End_Length; i++)
                     {
                        Luwa_6B_End_Data.push(res.Data_Ary47[i]);
                        Luwa_6B_End_Time.push(res.Data_Ary48[i]);
                        last_index_line_6B_End=i;                     
                    }

                    try
                    {
                        for(var x=0;x<Luwa_6B_Start_Data.length;x++)
                            {
                                console.log(" ");
                                Time=Luwa_6B_Start_Time[x];
                                let h = Time.split(":"); // Splitting the input string
                                let hour =parseInt(h[0]); 
                                let min = parseInt(h[1]);
                                console.log("Time LUWA 6B "+hour+":"+min);
                                
                                for(var a=0;a<Luwa_6B_End_Time.length;a++)
                                {
                                    var Time2=Luwa_6B_End_Time[a];
                                    let h2 = Time2.split(":"); // Splitting the input string
                                    let hour2 =parseInt(h2[0]); 
                                    let min2 = parseInt(h2[1]);
                                    var diff_Hour=parseInt(hour2-hour);
                                    var diff_min=parseInt(min2-min);
                                    // console.log("diff_Hour "+diff_Hour);
                                    console.log("diff_min "+Luwa_6B_Start_Time[x]+" "+Luwa_6B_End_Time[a]+" "+diff_min);
                                    
                                   if (diff_Hour == 0 && diff_min >= 0 && diff_min < diff_min_high || diff_Hour == 0 && diff_min < 0 && diff_min > diff_min_low ) 
                                    {
                                        
                                        New_6B_End[x]=Luwa_6B_End_Data[a];
                                    }


                                }

                            }
                          //  console.log(New_6B_End)
                        }
                        catch(err)
                        {
                            console.log("Error Luwa 6B: "+err)
                            //New_6B=line6B_Data;
                            // console.log(line6A_Data);
                            // console.log(Luwa_5B_Start_Time);

                            // console.log(Luwa_5B_Start_Length);
                            // console.log(line6B_Length);


                            // console.log(Luwa_5B_End_Data);
                            // console.log(Luwa_5B_End_Time);
                            // console.log(" ");
                        }


              
                  
                 


                    //Chart 13 Array (13A) (18/2/24)
                    Data_Ary=(res.Data_Ary49.join(", "));
                    Data_Ary2=(res.Data_Ary50.join(", "));
                    Data_Ary3=(res.Data_Ary51.join(", "));
                    Data_Ary4=(res.Data_Ary52.join(", "));
                    var New_7A_End=[];

                    Luwa_7A_Start_Length= res.Data_Ary49.length;
                    Luwa_7A_End_Length= res.Data_Ary51.length;


                    Luwa_7A_Start_Data=[];
                    Luwa_7A_Start_Time=[];
                    Luwa_7A_End_Data=[];
                    Luwa_7A_End_Time=[];

                    for (var i = 0; i < Luwa_7A_Start_Length; i++)
                    {
                        Luwa_7A_Start_Data.push(res.Data_Ary49[i]);
                        Luwa_7A_Start_Time.push(res.Data_Ary50[i]);
                        last_index_line_7A_Start=i;
                    }

                    for (var i = 0; i < Luwa_7A_End_Length; i++)
                    {
                        Luwa_7A_End_Data.push(res.Data_Ary51[i]);
                        Luwa_7A_End_Time.push(res.Data_Ary52[i]);
                        last_index_line_7A_End=i;

                    }

                    try
                    {
                        for(var x=0;x<Luwa_7A_Start_Data.length;x++)
                            {
                                console.log(" ");
                                Time=Luwa_7A_Start_Time[x];
                                let h = Time.split(":"); // Splitting the input string
                                let hour =parseInt(h[0]); 
                                let min = parseInt(h[1]);
                                console.log("Time Luwa 7A "+hour+":"+min);
                                
                                for(var a=0;a<Luwa_7A_End_Time.length;a++)
                                {
                                    var Time2=Luwa_7A_End_Time[a];
                                    let h2 = Time2.split(":"); // Splitting the input string
                                    let hour2 =parseInt(h2[0]); 
                                    let min2 = parseInt(h2[1]);
                                    var diff_Hour=parseInt(hour2-hour);
                                    var diff_min=parseInt(min2-min);
                                    // console.log("diff_Hour "+diff_Hour);
                                    console.log("diff_min "+Luwa_7A_Start_Time[x]+" "+Luwa_7A_End_Time[a]+" "+diff_min);
                                    
                                   if (diff_Hour == 0 && diff_min >= 0 && diff_min < diff_min_high || diff_Hour == 0 && diff_min < 0 && diff_min > diff_min_low ) 
                                    {
                                        
                                        New_7A_End[x]=Luwa_7A_End_Data[a];
                                    }


                                }

                            }
                           
                        }
                        catch(err)
                        {
                            console.log("Error Luwa 7A: "+err)
                            
                        }

                        
                    //Chart 14 Array (14A) (18/2/24)
                    Data_Ary=(res.Data_Ary53.join(", "));
                    Data_Ary2=(res.Data_Ary54.join(", "));
                    Data_Ary=(res.Data_Ary55.join(", "));
                    Data_Ary2=(res.Data_Ary56.join(", "));
                    var New_7B_End=[];
                    

                    Luwa_7B_Start_Length= res.Data_Ary53.length;
                    Luwa_7B_End_Length= res.Data_Ary55.length;
                    
                    Luwa_7B_Start_Data=[];
                    Luwa_7B_Start_Time=[];
                    Luwa_7B_End_Data=[];
                    Luwa_7B_End_Time=[];

                    for (var i = 0; i < Luwa_7B_Start_Length; i++)
                    {
                        Luwa_7B_Start_Data.push(res.Data_Ary53[i]);
                        Luwa_7B_Start_Time.push(res.Data_Ary54[i]);
                        last_index_line_7B_Start=i;
                    }

                    for (var i = 0; i < Luwa_7B_End_Length; i++)
                    {
                        Luwa_7B_End_Data.push(res.Data_Ary55[i]);
                        Luwa_7B_End_Time.push(res.Data_Ary56[i]);
                        last_index_line_7B_End=i;

                    }

                    try
                    {
                        for(var x=0;x<Luwa_7B_Start_Data.length;x++)
                            {
                                console.log(" ");
                                Time=Luwa_7B_Start_Time[x];
                                let h = Time.split(":"); // Splitting the input string
                                let hour =parseInt(h[0]); 
                                let min = parseInt(h[1]);
                                console.log("Time 14A "+hour+":"+min);
                                
                                for(var a=0;a<Luwa_7B_End_Time.length;a++)
                                {
                                    var Time2=Luwa_7B_End_Time[a];
                                    let h2 = Time2.split(":"); // Splitting the input string
                                    let hour2 =parseInt(h2[0]); 
                                    let min2 = parseInt(h2[1]);
                                    var diff_Hour=parseInt(hour2-hour);
                                    var diff_min=parseInt(min2-min);
                                    // console.log("diff_Hour "+diff_Hour);
                                    console.log("diff_min "+Luwa_7B_Start_Time[x]+" "+Luwa_7B_End_Time[a]+" "+diff_min);
                                    
                                    if (diff_Hour == 0 && diff_min >= 0 && diff_min < diff_min_high || diff_Hour == 0 && diff_min < 0 && diff_min > diff_min_low ) 
                                    {
                                        
                                        New_7B_End[x]=Luwa_7B_End_Data[a];
                                    }


                                }

                            }

                        }
                        catch(err)
                        {
                            console.log("Error Luwa 7B: "+err)
                           
                        }

                        
                    

                        

                    //Chart 15 Array (15A) (18/2/24)
                    Data_Ary=(res.Data_Ary57.join(", "));
                    Data_Ary2=(res.Data_Ary58.join(", "));
                    Data_Ary=(res.Data_Ary59.join(", "));
                    Data_Ary2=(res.Data_Ary60.join(", "));
                    var New_8A_End=[];

                    Luwa_8A_Start_Length= res.Data_Ary57.length;
                    Luwa_8A_End_Length= res.Data_Ary59.length;


                    Luwa_8A_Start_Data=[];
                    Luwa_8A_Start_Time=[];
                    Luwa_8A_End_Data=[];
                    Luwa_8A_End_Time=[];

                    for (var i = 0; i < Luwa_8A_Start_Length; i++)
                        {
                            Luwa_8A_Start_Data.push(res.Data_Ary57[i]);
                            Luwa_8A_Start_Time.push(res.Data_Ary58[i]);
                            last_index_line_8A_Start=i;
                        
                        }
                    for (var i = 0; i < Luwa_8A_End_Length; i++)
                        {
                            Luwa_8A_End_Data.push(res.Data_Ary59[i]);
                            Luwa_8A_End_Time.push(res.Data_Ary60[i]);
                            last_index_line_8A_End=i;

                        }

                    try
                    {
                        for(var x=0;x<Luwa_8A_Start_Data.length;x++)
                            {
                                console.log(" ");
                                Time=Luwa_8A_Start_Time[x];
                                let h = Time.split(":"); // Splitting the input string
                                let hour =parseInt(h[0]); 
                                let min = parseInt(h[1]);
                                console.log("Time 15A "+hour+":"+min);
                                
                                for(var a=0;a<Luwa_8A_End_Time.length;a++)
                                {
                                    var Time2=Luwa_8A_End_Time[a];
                                    let h2 = Time2.split(":"); // Splitting the input string
                                    let hour2 =parseInt(h2[0]); 
                                    let min2 = parseInt(h2[1]);
                                    var diff_Hour=parseInt(hour2-hour);
                                    var diff_min=parseInt(min2-min);
                                    // console.log("diff_Hour "+diff_Hour);
                                    console.log("diff_min "+Luwa_8A_Start_Time[x]+" "+Luwa_8A_End_Time[a]+" "+diff_min);
                                    
                                   if (diff_Hour == 0 && diff_min >= 0 && diff_min < diff_min_high || diff_Hour == 0 && diff_min < 0 && diff_min > diff_min_low ) 
                                    {
                                        
                                        New_8A_End[x]=Luwa_8A_End_Data[a];
                                    }


                                }

                            }
                            console.log(New_8A_End)
                        }
                        catch(err)
                        {
                            console.log("Error 15B: "+err)
                           
                        }



                   
               
                   


                    //Chart 16 Array (16A) (18/2/24)
                    Data_Ary=(res.Data_Ary61.join(", "));
                    Data_Ary2=(res.Data_Ary62.join(", "));
                    Data_Ary3=(res.Data_Ary63.join(", "));
                    Data_Ary4=(res.Data_Ary64.join(", "));
                    var New_8B_End=[];
                    

                    Luwa_8B_Start_Length= res.Data_Ary61.length;
                    Luwa_8B_End_Length= res.Data_Ary63.length;


                    Luwa_8B_Start_Data=[];
                    Luwa_8B_Start_Time=[];
                    Luwa_8B_End_Data=[];
                    Luwa_8B_End_Time=[];

                    for (var i = 0; i < Luwa_8B_Start_Length; i++)
                     {
                        Luwa_8B_Start_Data.push(res.Data_Ary61[i]);
                        Luwa_8B_Start_Time.push(res.Data_Ary62[i]);
                        last_index_line_8B_Start=i;
                    }

                    for (var i = 0; i < Luwa_8B_End_Length; i++)
                     {
                        Luwa_8B_End_Data.push(res.Data_Ary63[i]);
                        Luwa_8B_End_Time.push(res.Data_Ary64[i]);
                        last_index_line_8B_End=i;
                        
                     }

                     try
                    {
                        for(var x=0;x<Luwa_8B_Start_Data.length;x++)
                            {
                                console.log(" ");
                                Time=Luwa_8B_Start_Time[x];
                                let h = Time.split(":"); // Splitting the input string
                                let hour =parseInt(h[0]); 
                                let min = parseInt(h[1]);
                                console.log("Time Luwa 8B "+hour+":"+min);
                                
                                for(var a=0;a<Luwa_8B_End_Time.length;a++)
                                {
                                    var Time2=Luwa_8B_End_Time[a];
                                    let h2 = Time2.split(":"); // Splitting the input string
                                    let hour2 =parseInt(h2[0]); 
                                    let min2 = parseInt(h2[1]);
                                    var diff_Hour=parseInt(hour2-hour);
                                    var diff_min=parseInt(min2-min);
                                    // console.log("diff_Hour "+diff_Hour);
                                    console.log("diff_min "+Luwa_8B_Start_Time[x]+" "+Luwa_8B_End_Time[a]+" "+diff_min);
                                    
                                   if (diff_Hour == 0 && diff_min >= 0 && diff_min < diff_min_high || diff_Hour == 0 && diff_min < 0 && diff_min > diff_min_low ) 
                                    {
                                        
                                        New_8B_End[x]=Luwa_8B_End_Data[a];
                                    }


                                }

                            }
                          
                        }
                        catch(err)
                        {
                            console.log("Error 16B: "+err)
                           
                        }


                    //Chart 17 Array (17A) (18/2/24)
                    Data_Ary=(res.Data_Ary65.join(", "));
                    Data_Ary2=(res.Data_Ary66.join(", "));
                    Data_Ary=(res.Data_Ary67.join(", "));
                    Data_Ary2=(res.Data_Ary68.join(", "));
                    var New_17B=[];

                    line17A_Length= res.Data_Ary65.length;
                    line17B_Length= res.Data_Ary67.length;


                    line17A_Data=[];
                    line17A_Time=[];
                    line17B_Data=[];
                    line17B_Time=[];

                    for (var i = 0; i < line17A_Length; i++)
                    {
                        line17A_Data.push(res.Data_Ary65[i]);
                        line17A_Time.push(res.Data_Ary66[i]);
                        last_value_line17A=i;
                    }

                    for (var i = 0; i < line17B_Length; i++)
                    {
                        line17B_Data.push(res.Data_Ary67[i]);
                        line17B_Time.push(res.Data_Ary68[i]);
                        last_value_line17B=i;
                    }

                    try
                    {
                        for(var x=0;x<line17A_Data.length;x++)
                            {
                                console.log(" ");
                                Time=line17A_Time[x];
                                let h = Time.split(":"); // Splitting the input string
                                let hour =parseInt(h[0]); 
                                let min = parseInt(h[1]);
                                console.log("Time 17A "+hour+":"+min);
                                
                                for(var a=0;a<line17B_Time.length;a++)
                                {
                                    var Time2=line17B_Time[a];
                                    let h2 = Time2.split(":"); // Splitting the input string
                                    let hour2 =parseInt(h2[0]); 
                                    let min2 = parseInt(h2[1]);
                                    var diff_Hour=parseInt(hour2-hour);
                                    var diff_min=parseInt(min2-min);
                                    // console.log("diff_Hour "+diff_Hour);
                                    console.log("diff_min "+line17A_Time[x]+" "+line17B_Time[a]+" "+diff_min);
                                    
                                   if (diff_Hour == 0 && diff_min >= 0 && diff_min < diff_min_high || diff_Hour == 0 && diff_min < 0 && diff_min > diff_min_low ) 
                                    {
                                        New_17B[x]=line17B_Data[a];
                                    }


                                }

                            }
                            console.log(New_17B)
                        }
                        catch(err)
                        {
                            console.log("Error 17B: "+err)
                           
                        }

                    //Chart 18 Array (18A) (18/2/24)
                    Data_Ary=(res.Data_Ary69.join(", "));
                    Data_Ary2=(res.Data_Ary70.join(", "));
                    Data_Ary3=(res.Data_Ary71.join(", "));
                    Data_Ary4=(res.Data_Ary72.join(", "));
                    var New_18B=[];
                    

                    line18A_Length= res.Data_Ary69.length;
                    line18B_Length= res.Data_Ary71.length;

                    line18A_Data=[];
                    line18A_Time=[];
                    line18B_Data=[];
                    line18B_Time=[];

                    for (var i = 0; i < line18A_Length; i++)
                     {
                        line18A_Data.push(res.Data_Ary69[i]);
                        line18A_Time.push(res.Data_Ary70[i]);
                        last_value_line18A=i;
                    }
                    for (var i = 0; i < line18B_Length; i++)
                     {
                        line18B_Data.push(res.Data_Ary71[i]);
                        line18B_Time.push(res.Data_Ary72[i]);
                        last_value_line18B=i;
                    }
                    try
                    {
                        for(var x=0;x<line18A_Data.length;x++)
                            {
                                console.log(" ");
                                Time=line18A_Time[x];
                                let h = Time.split(":"); // Splitting the input string
                                let hour =parseInt(h[0]); 
                                let min = parseInt(h[1]);
                                console.log("Time 18A "+hour+":"+min);
                                
                                for(var a=0;a<line18B_Time.length;a++)
                                {
                                    var Time2=line18B_Time[a];
                                    let h2 = Time2.split(":"); // Splitting the input string
                                    let hour2 =parseInt(h2[0]); 
                                    let min2 = parseInt(h2[1]);
                                    var diff_Hour=parseInt(hour2-hour);
                                    var diff_min=parseInt(min2-min);
                                    // console.log("diff_Hour "+diff_Hour);
                                    console.log("diff_min "+line18A_Time[x]+" "+line18B_Time[a]+" "+diff_min);
                                    
                                   if (diff_Hour == 0 && diff_min >= 0 && diff_min < diff_min_high || diff_Hour == 0 && diff_min < 0 && diff_min > diff_min_low ) 
                                    {
                                        New_18B[x]=line18B_Data[a];
                                    }


                                }

                            }
                            console.log(New_18B)
                        }
                        catch(err)
                        {
                            console.log("Error 18B: "+err)
                           
                        }

                       

                        //Find Last Value   


                            let Luwa_1A_Start_lastValue = Luwa_1A_Start_Data[Luwa_1A_Start_Data.length - 1] === undefined ? 0 : Luwa_1A_Start_Data[Luwa_1A_Start_Data.length - 1];
                            let Luwa_1A_Start_last_Time = Luwa_1A_Start_Time[Luwa_1A_Start_Time.length - 1] === undefined ? 0 : Luwa_1A_Start_Time[Luwa_1A_Start_Time.length - 1];

                            let Luwa_1B_Start_lastValue = Luwa_1B_Start_Data[Luwa_1B_Start_Data.length - 1] === undefined ? 0 : Luwa_1B_Start_Data[Luwa_1B_Start_Data.length - 1];
                            let Luwa_2A_Start_lastValue = Luwa_2A_Start_Data[Luwa_2A_Start_Data.length - 1] === undefined ? 0 : Luwa_2A_Start_Data[Luwa_2A_Start_Data.length - 1];
                            let Luwa_2B_Start_lastValue = Luwa_2B_Start_Data[Luwa_2B_Start_Data.length - 1] === undefined ? 0 : Luwa_2B_Start_Data[Luwa_2B_Start_Data.length - 1];
                            let Luwa_3A_Start_lastValue = Luwa_3A_Start_Data[Luwa_3A_Start_Data.length - 1] === undefined ? 0 : Luwa_3A_Start_Data[Luwa_3A_Start_Data.length - 1];
                            let Luwa_3B_Start_lastValue = Luwa_3B_Start_Data[Luwa_3B_Start_Data.length - 1] === undefined ? 0 : Luwa_3B_Start_Data[Luwa_3B_Start_Data.length - 1];
                            let Luwa_4A_Start_lastValue = Luwa_4A_Start_Data[Luwa_4A_Start_Data.length - 1] === undefined ? 0 : Luwa_4A_Start_Data[Luwa_4A_Start_Data.length - 1];
                            let Luwa_4B_Start_lastValue = Luwa_4B_Start_Data[Luwa_4B_Start_Data.length - 1] === undefined ? 0 : Luwa_4B_Start_Data[Luwa_4B_Start_Data.length - 1];
                            let Luwa_5A_Start_lastValue = Luwa_5A_Start_Data[Luwa_5A_Start_Data.length - 1] === undefined ? 0 : Luwa_5A_Start_Data[Luwa_5A_Start_Data.length - 1];
                            let Luwa_5B_Start_lastValue = Luwa_5B_Start_Data[Luwa_5B_Start_Data.length - 1] === undefined ? 0 : Luwa_5B_Start_Data[Luwa_5B_Start_Data.length - 1];
                            let Luwa_6A_Start_lastValue = Luwa_6A_Start_Data[Luwa_6A_Start_Data.length - 1] === undefined ? 0 : Luwa_6A_Start_Data[Luwa_6A_Start_Data.length - 1];
                            let Luwa_6B_Start_lastValue = Luwa_6B_Start_Data[Luwa_6B_Start_Data.length - 1] === undefined ? 0 : Luwa_6B_Start_Data[Luwa_6B_Start_Data.length - 1];
                            let Luwa_7A_Start_lastValue = Luwa_7A_Start_Data[Luwa_7A_Start_Data.length - 1] === undefined ? 0 : Luwa_7A_Start_Data[Luwa_7A_Start_Data.length - 1];
                            let Luwa_7B_Start_lastValue = Luwa_7B_Start_Data[Luwa_7B_Start_Data.length - 1] === undefined ? 0 : Luwa_7B_Start_Data[Luwa_7B_Start_Data.length - 1];
                            let Luwa_8A_Start_lastValue = Luwa_8A_Start_Data[Luwa_8A_Start_Data.length - 1] === undefined ? 0 : Luwa_8A_Start_Data[Luwa_8A_Start_Data.length - 1];
                            let Luwa_8B_Start_lastValue = Luwa_8B_Start_Data[Luwa_8B_Start_Data.length - 1] === undefined ? 0 : Luwa_8B_Start_Data[Luwa_8B_Start_Data.length - 1];


                            let New_1A_End_lastValue = New_1A_End[New_1A_End.length - 1] === undefined ? 0 : New_1A_End[New_1A_End.length - 1];
                            let New_1B_End_lastValue = New_1B_End[New_1B_End.length - 1] === undefined ? 0 : New_1B_End[New_1B_End.length - 1];
                            let New_2A_End_lastValue = New_2A_End[New_2A_End.length - 1] === undefined ? 0 : New_2A_End[New_2A_End.length - 1];
                          
                            let New_2B_End_lastValue = New_2B_End[New_2B_End.length - 1] === undefined ? 0 : New_2B_End[New_2B_End.length - 1];
                            let New_3A_End_lastValue = New_3A_End[New_3A_End.length - 1] === undefined ? 0 : New_3A_End[New_3A_End.length - 1];
                            let New_3B_End_lastValue = New_3B_End[New_3B_End.length - 1] === undefined ? 0 : New_3B_End[New_3B_End.length - 1];
                            let New_4A_End_lastValue = New_4A_End[New_4A_End.length - 1] === undefined ? 0 : New_4A_End[New_4A_End.length - 1];
                            let New_4B_End_lastValue = New_4B_End[New_4B_End.length - 1] === undefined ? 0 : New_4B_End[New_4B_End.length - 1];
                            let New_5A_End_lastValue = New_5A_End[New_5A_End.length - 1] === undefined ? 0 : New_5A_End[New_5A_End.length - 1];
                            let New_5B_End_lastValue = New_5B_End[New_5B_End.length - 1] === undefined ? 0 : New_5B_End[New_5B_End.length - 1];
                            let New_6A_End_lastValue = New_6A_End[New_6A_End.length - 1] === undefined ? 0 : New_6A_End[New_6A_End.length - 1];
                            let New_6B_End_lastValue = New_6B_End[New_6B_End.length - 1] === undefined ? 0 : New_6B_End[New_6B_End.length - 1];
                            let New_7A_End_lastValue = New_7A_End[New_7A_End.length - 1] === undefined ? 0 : New_7A_End[New_7A_End.length - 1];
                            let New_7B_End_lastValue = New_7B_End[New_7B_End.length - 1] === undefined ? 0 : New_7B_End[New_7B_End.length - 1];
                            let New_8A_End_lastValue = New_8A_End[New_8A_End.length - 1] === undefined ? 0 : New_8A_End[New_8A_End.length - 1];
                            let New_8B_End_lastValue = New_8B_End[New_8B_End.length - 1] === undefined ? 0 : New_8B_End[New_8B_End.length - 1];


                        // Create an object to store the arrays dynamically
                        var New_B_arrays = {};

                        // Populate New_B_arrays with arrays dynamically
                        for (var i = 1; i <= 18; i++) {
                            New_B_arrays[i] = window["New_" + i + "B"];
                        }

                        // Now, log the entire New_B_arrays object
                        console.log(New_B_arrays);  



                          
                       
                          


                      




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
                        labels: Chart1_Display_Time, // X-axis labels
                        datasets:
                            [{
                                label: 'Start',
                                data: Luwa_1A_Start_Data,
                                borderColor: 'rgb(255, 255, 255)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:0.1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            },
                            {
                                label: 'End',
                                data: Luwa_1A_End_Data,
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
                                text: 'Luwa 1A', // Title text
                                position: 'top',
                                font: {
                                    size: 13 ,// Font size for the title
                                    color: 'white'
                                },
                                color: 'white', // Optional title color
                                align: 'start',
                                padding:{
                                    top:10,
                                    left:20,

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
                                                size: 11 // Optional: Change font size
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
                                        size: 12// Optional: Change font size
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
                                    ctx.font = '15px Arial';
                                    ctx.fillStyle = 'white';
                                    ctx.textAlign = 'right';
                                    ctx.fontWeight = 'bold'; // corrected

                                  //  ctx.fillText(res.Data_Ary[last_value_Line_1A]+' Pa', chart.width - 10, 30); // Adjust position as needed

                                    ctx.fillText(Luwa_1A_Start_lastValue+' Pa', chart.width -100, 20); // Adjust position as needed

                                    // Additional Drawing
                                    ctx.fillStyle = 'rgb(0, 255, 8)'; // Change color for distinction
                                    ctx.fillText(New_1A_End_lastValue+ ' Pa', chart.width -10, 20); // Adjust position




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

                //Chart 1 [Model box]
                 
                const ctx1_model_box = document.getElementById('myChartModel');
                    ctx1_model_box.style.backgroundColor = 'rgba(24, 24, 24, 0.71)';


                    if (lineChart_Model_box) {
                        lineChart_Model_box.destroy(); // Destroy existing chart
                    }

                        
                        
                    lineChart_Model_box = new Chart(ctx1_model_box, {
                        
                    type: 'line', // Line chart type
                    data:
                    {
                        labels: Chart1_Display_Time, // X-axis labels
                        datasets:
                            [{
                                label: 'Start',
                                data: Luwa_1A_Start_Data,
                                borderColor: 'rgb(255, 255, 255)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:0.1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            },
                            {
                                label: 'End',
                                data: Luwa_1A_End_Data,
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
                                text: 'Luwa 1A', // Title text
                                position: 'top',
                                font: {
                                    size: 13 ,// Font size for the title
                                    color: 'white'
                                },
                                color: 'white', // Optional title color
                                align: 'start',
                                padding:{
                                    top:10,
                                    left:20,

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
                                                size: 11 // Optional: Change font size
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
                                        size: 12// Optional: Change font size
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
                                    ctx.font = '15px Arial';
                                    ctx.fillStyle = 'white';
                                    ctx.textAlign = 'right';
                                    ctx.fontWeight = 'bold'; // corrected

                                  //  ctx.fillText(res.Data_Ary[last_value_Line_1A]+' Pa', chart.width - 10, 30); // Adjust position as needed

                                    ctx.fillText(Luwa_1A_Start_lastValue+' Pa', chart.width -100, 20); // Adjust position as needed

                                    // Additional Drawing
                                    ctx.fillStyle = 'rgb(0, 255, 8)'; // Change color for distinction
                                    ctx.fillText(New_1A_End_lastValue+ ' Pa', chart.width -10, 20); // Adjust position




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


                 //Chart 2 [Luwa 1B]
                 const ctx2 = document.getElementById('myChart2');
                 ctx2.style.backgroundColor = 'rgba(24, 24, 24, 0.71)';

                 if (lineChart2) {
                    lineChart2.destroy(); // Destroy existing chart
                }


                    lineChart2 = new Chart(ctx2, {
                    type: 'line', // Line chart type
                    data:
                    {
                        labels: Luwa_1B_Start_Time, // X-axis labels
                        datasets:
                            [{
                                label: 'Start',
                                data: Luwa_1B_Start_Data,
                                borderColor: 'rgb(255, 255, 255)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:0.1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            },
                            {
                                label: 'End',
                                data: Luwa_1B_End_Data,
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
                                text: 'Luwa 1B', // Title text
                                position: 'top',
                                font: {
                                    size: 13 ,// Font size for the title
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
                                                size: 11 // Optional: Change font size
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
                                        size: 12// Optional: Change font size
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
                                    ctx.font = '15px Arial';
                                    ctx.fillStyle = 'white';
                                    ctx.textAlign = 'right';
                                    ctx.fontWeight = 'bold'; // corrected
                                    ctx.fillText(Luwa_1B_Start_lastValue +' Pa', chart.width - 100, 20); // Adjust position as needed

                                    // Additional Drawing
                                    ctx.fillStyle = 'rgb(0, 255, 8)'; // Change color for distinction
                                    ctx.fillText(New_1B_End_lastValue + ' Pa', chart.width -10, 20); // Adjust position

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
                        labels: Luwa_2A_Start_Time, // X-axis labels
                        datasets:
                            [{
                                label: 'Start',
                                data: Luwa_2A_Start_Data,
                                borderColor: 'rgb(255, 255, 255)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:0.1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            }
                            ,
                            {
                                label: 'End',
                                data: Luwa_2A_End_Data,
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
                                text: 'Luwa 2A', // Title text
                                position: 'top',
                                font: {
                                    size: 13 ,// Font size for the title
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
                                                size: 11 // Optional: Change font size
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
                                        size: 12// Optional: Change font size
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
                                    ctx.font = '15px Arial';
                                    ctx.fillStyle = 'white';
                                    ctx.textAlign = 'right';
                                    ctx.fontWeight = 'bold'; // corrected
                                    ctx.fillText(Luwa_2A_Start_lastValue+' Pa', chart.width - 100, 20); // Adjust position as needed

                                    // Additional Drawing
                                    ctx.fillStyle = 'rgb(0, 255, 8)'; // Change color for distinction
                                    ctx.fillText(New_2A_End_lastValue + ' Pa', chart.width -10, 20); // Adjust position
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
                //  var time_arr=[...line4B_Time,...line6B_Time];
                //  time_arr=time_arr.sort();
                // alert(time_arr.sort())
                //alert(time_arr.length);





                //Chart 4 (LUWA 2B )
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
                       
                        labels: Luwa_2B_Start_Time,
                        datasets:
                            [{
                                label: 'Start',
                                data: Luwa_2B_Start_Data,
                                borderColor: 'rgb(255, 255, 255)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            },
                           
                            {
                                label: 'End',
                                data: Luwa_2B_End_Data,
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
                                text: 'Luwa 2B', // Title text
                                position: 'top',
                                font: {
                                    size: 13 ,// Font size for the title
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
                                                size: 11 // Optional: Change font size
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
                                        size: 12// Optional: Change font size
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
                                    ctx.font = '15px Arial';
                                    ctx.fillStyle = 'white';
                                    ctx.textAlign = 'right';
                                    ctx.fontWeight = 'bold'; // corrected
                                    ctx.fillText(Luwa_2B_Start_lastValue+' Pa', chart.width -100, 20); // Adjust position as needed

                                    // Additional Drawing
                                    ctx.fillStyle = 'rgb(0, 255, 8)'; // Change color for distinction
                                    ctx.fillText(New_2B_End_lastValue + ' Pa', chart.width -10, 20); // Adjust position

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

                        //Chart 5 (Luwa 3A)
                        const ctx5 = document.getElementById('myChart5');
                                        ctx5.style.backgroundColor = 'rgba(24, 24, 24, 0.71)';

    
                    if (lineChart5) {
                        lineChart5.destroy(); // Destroy existing chart
                    }
                     lineChart5 = new Chart(ctx5, {
                    type: 'line', // Line chart type
                    data:
                    {
                        labels: Luwa_3A_Start_Time, // X-axis labels
                        datasets:
                            [{
                                label: 'Start',
                                data: Luwa_3A_Start_Data,
                                borderColor: 'rgb(255, 255, 255)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:0.1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            },
                            {
                                label: 'End',
                                data: Luwa_3A_End_Data,
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
                                text: 'Luwa 3A', // Title text
                                position: 'top',
                                font: {
                                    size: 13 ,// Font size for the title
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
                                                size: 11 // Optional: Change font size
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
                                        size: 12// Optional: Change font size
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
                                    ctx.font = '15px Arial';
                                    ctx.fillStyle = 'white';
                                    ctx.textAlign = 'right';
                                    ctx.fontWeight = 'bold'; // corrected
                                    ctx.fillText(Luwa_3A_Start_lastValue+' Pa', chart.width - 100, 20); // Adjust position as needed

                                    // Additional Drawing
                                    ctx.fillStyle = 'rgb(0, 255, 8)'; // Change color for distinction
                                    ctx.fillText(New_3A_End_lastValue + ' Pa', chart.width -10, 20); // Adjust position
                                    
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




                //Chart 6 (Luwa 3B)
                const ctx6 = document.getElementById('myChart6');
                    ctx6.style.backgroundColor = 'rgba(24, 24, 24, 0.71)';

    
                    if (lineChart6) {
                        lineChart6.destroy(); // Destroy existing chart
                    }
                     lineChart6 = new Chart(ctx6, {
                    type: 'line', // Line chart type
                    data:
                    {
                        labels: Luwa_3B_Start_Time, // X-axis labels
                        datasets:
                            [{
                                label: 'Start',
                                data: Luwa_3B_Start_Data,
                                borderColor: 'rgb(255, 255, 255)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:0.1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            },
                            {
                                label: 'End',
                                data: Luwa_3B_End_Data,
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
                                text: 'Luwa 3B', // Title text
                                position: 'top',
                                font: {
                                    size: 13 ,// Font size for the title
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
                                                size: 11 // Optional: Change font size
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
                                        size: 12// Optional: Change font size
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
                                    ctx.font = '15px Arial';
                                    ctx.fillStyle = 'white';
                                    ctx.textAlign = 'right';
                                    ctx.fontWeight = 'bold'; // corrected
                                    ctx.fillText(Luwa_3B_Start_lastValue+' Pa', chart.width - 100, 20); // Adjust position as needed
                                    // Additional Drawing
                                    ctx.fillStyle = 'rgb(0, 255, 8)'; // Change color for distinction
                                    ctx.fillText(New_3B_End_lastValue + ' Pa', chart.width -10, 20); // Adjust position
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



                //Chart 7 (Luwa 4A)
                
                    const ctx7 = document.getElementById('myChart7');
                    ctx7.style.backgroundColor = 'rgba(24, 24, 24, 0.71)';
    
                    if (lineChart7) {
                        lineChart7.destroy(); // Destroy existing chart
                    }

                     lineChart7 = new Chart(ctx7, {
                    type: 'line', // Line chart type
                    data:
                    {
                        labels: Luwa_4A_Start_Time, // X-axis labels
                        datasets:
                            [{
                                label: 'Start',
                                data: Luwa_4A_Start_Data,
                                borderColor: 'rgb(255, 255, 255)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:0.1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            },
                            {
                                label: 'End',
                                data: Luwa_4A_End_Data,
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
                                text: 'Luwa 4A', // Title text
                                position: 'top',
                                font: {
                                    size: 13 ,// Font size for the title
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
                                                size: 11 // Optional: Change font size
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
                                        size: 10// Optional: Change font size
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
                                    ctx.font = '15px Arial';
                                    ctx.fillStyle = 'white';
                                    ctx.textAlign = 'right';
                                    ctx.fontWeight = 'bold'; // corrected
                                    ctx.fillText(Luwa_4A_Start_lastValue+' Pa', chart.width - 100, 20); // Adjust position as needed
                                    // Additional Drawing
                                    ctx.fillStyle = 'rgb(0, 255, 8)'; // Change color for distinction
                                    ctx.fillText(New_4A_End_lastValue + ' Pa', chart.width -10, 20); // Adjust position
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




                //Chart 8 (Luwa 4B)
                const ctx8 = document.getElementById('myChart8');
                    ctx8.style.backgroundColor = 'rgba(24, 24, 24, 0.71)';
    
                    if (lineChart8) {
                        lineChart8.destroy(); // Destroy existing chart
                    }

                     lineChart8 = new Chart(ctx8, {
                    type: 'line', // Line chart type
                    data:
                    {
                        labels: Luwa_4B_Start_Time, // X-axis labels
                        datasets:
                            [{
                                label: 'Start',
                                data: Luwa_4B_Start_Data,
                                borderColor: 'rgb(255, 255, 255)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:0.1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            },
                            {
                                label: 'End',
                                data:Luwa_4B_End_Data ,
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
                                text: 'Luwa 4B', // Title text
                                position: 'top',
                                font: {
                                    size: 13 ,// Font size for the title
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
                                                size: 11 // Optional: Change font size
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
                                        size: 12// Optional: Change font size
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
                                    ctx.font = '15px Arial';
                                    ctx.fillStyle = 'white';
                                    ctx.textAlign = 'right';
                                    ctx.fontWeight = 'bold'; // corrected
                                    ctx.fillText(Luwa_4B_Start_lastValue+' Pa', chart.width -100, 20); // Adjust position as needed
                                    // Additional Drawing
                                    ctx.fillStyle = 'rgb(0, 255, 8)'; // Change color for distinction
                                    ctx.fillText(New_4B_End_lastValue + ' Pa', chart.width -10, 20); // Adjust position
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
                        labels: Luwa_5A_Start_Time, // X-axis labels
                        datasets:
                            [{
                                label: 'Start',
                                data: Luwa_5A_Start_Data,
                                borderColor: 'rgb(255, 255, 255)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:0.1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            },
                            {
                                label: 'End',
                                data: Luwa_5A_End_Data,
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
                                text: 'Luwa 5A', // Title text
                                position: 'top',
                                font: {
                                    size: 13 ,// Font size for the title
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
                                                size: 11 // Optional: Change font size
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
                                        size: 12// Optional: Change font size
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
                                    ctx.font = '15px Arial';
                                    ctx.fillStyle = 'white';
                                    ctx.textAlign = 'right';
                                    ctx.fontWeight = 'bold'; // corrected
                                    ctx.fillText(Luwa_5A_Start_lastValue+' Pa', chart.width - 100, 20); // Adjust position as needed
                                    // Additional Drawing
                                    ctx.fillStyle = 'rgb(0, 255, 8)'; // Change color for distinction
                                    ctx.fillText(New_5A_End_lastValue + ' Pa', chart.width -10, 20); // Adjust position
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
                        labels: Luwa_5B_Start_Time, // X-axis labels
                        datasets:
                            [{
                                label: 'Start',
                                data: Luwa_5B_Start_Data,
                                borderColor: 'rgb(255, 255, 255)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:0.1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            },
                            {
                                label: 'End',
                                data: Luwa_5B_End_Data,
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
                                    size: 13 // Optional: Change font size
                                    }

                                   
                                }
                            },

                            title:
                            {
                                display: true, // Display the title
                                text: 'Luwa 5B', // Title text
                                position: 'top',
                                font: {
                                    size: 13 ,// Font size for the title
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
                                                size: 11 // Optional: Change font size
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
                                        size: 12// Optional: Change font size
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
                                    ctx.font = '15px Arial';
                                    ctx.fillStyle = 'white';
                                    ctx.textAlign = 'right';
                                    ctx.fontWeight = 'bold'; // corrected
                                    ctx.fillText(Luwa_5B_Start_lastValue+' Pa', chart.width - 100, 20); // Adjust position as needed
                                    // Additional Drawing
                                    ctx.fillStyle = 'rgb(0, 255, 8)'; // Change color for distinction
                                    ctx.fillText(New_5B_End_lastValue + ' Pa', chart.width -10, 20); // Adjust position
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
                        labels: Luwa_6A_Start_Time, // X-axis labels
                        datasets:
                            [{
                                label: 'Start',
                                data: Luwa_6A_Start_Data,
                                borderColor: 'rgb(255, 255, 255)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:0.1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            },
                            {
                                label: 'End',
                                data: New_6A_End,
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
                                text: 'Luwa 6A', // Title text
                                position: 'top',
                                font: {
                                    size: 13 ,// Font size for the title
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
                                                size: 11 // Optional: Change font size
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
                                        size: 12// Optional: Change font size
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
                                    ctx.font = '15px Arial';
                                    ctx.fillStyle = 'white';
                                    ctx.textAlign = 'right';
                                    ctx.fontWeight = 'bold'; // corrected
                                    ctx.fillText(res.Data_Ary41[last_index_line_6A_Start]+' Pa', chart.width - 100, 20); // Adjust position as needed
                                    // Additional Drawing
                                    ctx.fillStyle = 'rgb(0, 255, 8)'; // Change color for distinction
                                    ctx.fillText(New_6A_End_lastValue + ' Pa', chart.width -10, 20); // Adjust position
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
                        labels: Luwa_6B_Start_Time, // X-axis labels
                        datasets:
                            [{
                                label: 'Start',
                                data: Luwa_6B_Start_Data,
                                borderColor: 'rgb(255, 255, 255)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:0.1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            },
                            {
                                label: 'End',
                                data: New_6B_End,
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
                                text: 'Luwa 6B', // Title text
                                position: 'top',
                                font: {
                                    size: 13 ,// Font size for the title
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
                                                size: 11 // Optional: Change font size
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
                                        size: 12// Optional: Change font size
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
                                    ctx.font = '15px Arial';
                                    ctx.fillStyle = 'white';
                                    ctx.textAlign = 'right';
                                    ctx.fontWeight = 'bold'; // corrected
                                    ctx.fillText(res.Data_Ary45[last_index_line_6B_Start]+' Pa', chart.width - 100, 20); // Adjust position as needed
                                    // Additional Drawing
                                    ctx.fillStyle = 'rgb(0, 255, 8)'; // Change color for distinction
                                    ctx.fillText(New_6B_End_lastValue + ' Pa', chart.width -10, 20); // Adjust position
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
                        labels: Luwa_7A_Start_Time, // X-axis labels
                        datasets:
                            [{
                                label: 'Start',
                                data: Luwa_7A_Start_Data,
                                borderColor: 'rgb(255, 255, 255)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:0.1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            },
                            {
                                label: 'End',
                                data: New_7A_End,
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
                                text: 'Luwa 7A', // Title text
                                position: 'top',
                                font: {
                                    size: 13 ,// Font size for the title
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
                                                size: 11 // Optional: Change font size
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
                                        size: 12// Optional: Change font size
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
                                    ctx.font = '15px Arial';
                                    ctx.fillStyle = 'white';
                                    ctx.textAlign = 'right';
                                    ctx.fontWeight = 'bold'; // corrected
                                    ctx.fillText(Luwa_7A_Start_lastValue +' Pa', chart.width - 100, 20); // Adjust position as needed
                                    // Additional Drawing
                                    ctx.fillStyle = 'rgb(0, 255, 8)'; // Change color for distinction
                                    ctx.fillText(New_7A_End_lastValue + ' Pa', chart.width -10, 20); // Adjust position
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
                        labels: Luwa_7B_Start_Time, // X-axis labels
                        datasets:
                            [{
                                label: 'Start',
                                data: Luwa_7B_Start_Data,
                                borderColor: 'rgb(255, 255, 255)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:0.1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            },
                            {
                                label: 'End',
                                data: Luwa_7B_End_Data,
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
                                text: 'Luwa 7B', // Title text
                                position: 'top',
                                font: {
                                    size: 13 ,// Font size for the title
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
                                                size: 11 // Optional: Change font size
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
                                        size: 12// Optional: Change font size
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
                                    ctx.font = '15px Arial';
                                    ctx.fillStyle = 'white';
                                    ctx.textAlign = 'right';
                                    ctx.fontWeight = 'bold'; // corrected
                                    ctx.fillText(Luwa_7B_Start_lastValue +' Pa', chart.width - 100, 20); // Adjust position as needed
                                    // Additional Drawing
                                    ctx.fillStyle = 'rgb(0, 255, 8)'; // Change color for distinction
                                    ctx.fillText(New_7B_End_lastValue  + ' Pa', chart.width -10, 20); // Adjust position
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
                        labels: Luwa_8A_Start_Time, // X-axis labels
                        datasets:
                            [{
                                label: 'Start',
                                data: Luwa_8A_Start_Data,
                                borderColor: 'rgb(255, 255, 255)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:0.1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            },
                            {
                                label: 'End',
                                data: Luwa_8A_End_Data,
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
                                text: 'Luwa 8A', // Title text
                                position: 'top',
                                font: {
                                    size: 13 ,// Font size for the title
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
                                                size: 11 // Optional: Change font size
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
                                        size: 12// Optional: Change font size
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
                                    ctx.font = '15px Arial';
                                    ctx.fillStyle = 'white';
                                    ctx.textAlign = 'right';
                                    ctx.fontWeight = 'bold'; // corrected
                                    ctx.fillText(Luwa_8A_Start_lastValue +' Pa', chart.width - 100, 20); // Adjust position as needed
                                    // Additional Drawing
                                    ctx.fillStyle = 'rgb(0, 255, 8)'; // Change color for distinction
                                    ctx.fillText(New_8A_End_lastValue  + ' Pa', chart.width -10, 20); // Adjust position
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
                        labels: Luwa_8B_Start_Time, // X-axis labels
                        datasets:
                            [{
                                label: 'Start',
                                data: Luwa_8B_Start_Data,
                                borderColor: 'rgb(255, 255, 255)', // Line color
                                borderWidth: 3, // Line border width
                                backgroundColor: 'rgba(1, 1, 1, 0.06)', // Area under the line
                                tension: 0.4, // Curve effect on the line
                                pointRadius:0.1,
                                pointBorderColor: 'rgb(19, 141, 255)',
                            },
                            {
                                label: 'End',
                                data: Luwa_8B_End_Data,
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
                                text: 'Luwa 8B', // Title text
                                position: 'top',
                                font: {
                                    size: 13 ,// Font size for the title
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
                                                size: 11 // Optional: Change font size
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
                                        size: 12// Optional: Change font size
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
                                    ctx.font = '15px Arial';
                                    ctx.fillStyle = 'white';
                                    ctx.textAlign = 'right';
                                    ctx.fontWeight = 'bold'; // corrected
                                    ctx.fillText(Luwa_8B_Start_lastValue +' Pa', chart.width - 100, 20); // Adjust position as needed
                                    // Additional Drawing
                                    ctx.fillStyle = 'rgb(0, 255, 8)'; // Change color for distinction
                                    ctx.fillText(New_8B_End_lastValue + ' Pa', chart.width -10, 20); // Adjust position
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







</div>
</>
</html>


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
