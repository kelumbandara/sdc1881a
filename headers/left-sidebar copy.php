<?php
    //session_start();
    $username = $_SESSION["user_name"];
    $roll_section   = $_SESSION["user_roll_sections"];
    //$roll_areas     = $_SESSION["user_roll_areas"];
    //print_r($section);   
?>
<style>
  #img_sidebar {
    background-image: url('../../myimg/mas_active.jpg');
    width: 200px;
    height: 50px;
    background-size: cover; /* or contain */
    background-repeat: no-repeat;
}

</style>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <div id="img_sidebar"></div>
            </div>
        </div>       
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->

                <?php if (in_array('10' , $roll_section)): ?>
                    <li class="nav-item menu-open">
                        <a href="../../pages/home/home.php" class="nav-link deactive">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>                   
                    </li> 

                    

                <?php endif; ?>
                <?php if (in_array('14' , $roll_section)): ?>
                    <li class="nav-item menu-open">
                        <a href="../../pages/diagnostic/diagnostic.php" class="nav-link deactive">
                        <i class="nav-icon fas fa-wrench"></i>
                            <p>Diagnostic</p>
                        </a>                   
                    </li> 

          

                    

                    
                <?php endif; ?>      
                <li class="nav-item">
                    <?php if (in_array('20' , $roll_section)): ?>
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-list"></i>
                            <p>Reports<i class="right fas fa-angle-left"></i></p>
                        </a>


                    <?php endif; ?>                    
                    <ul class="nav nav-treeview">
                        <?php if (in_array('201' , $roll_section)): ?>
                            <li class="nav-item">
                                <a href="../Detail_report/index.php" class="nav-link">
                                    <i class="nav-icon fas fa-chart-pie"></i>
                                    <p>Details Reports</p>
                                </a>
                            </li>
                        <?php endif; ?>
                        <!-- <?php if (in_array('202' , $roll_section)): ?>
                            <li class="nav-item">
                                <a href="../BTUH_Report/index.php" class="nav-link">
                                    <i class="nav-icon fas fa-chart-pie"></i>
                                    <p>Thermal Consumption</p>
                                </a>
                            </li>
                        <?php endif; ?> -->
                        
                    </ul>
                </li>
                   
                <li class="nav-item">
                    <?php if (in_array('30' , $roll_section)): ?>
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-user-cog"></i>
                            <p>User Management<i class="right fas fa-angle-left"></i></p>
                        </a>
                    <?php endif; ?>
                    <ul class="nav nav-treeview">
                        <?php if (in_array('301' , $roll_section)): ?>
                            <li class="nav-item">
                                <a href="../user_account/users.php" class="nav-link">
                                    <i class="nav-icon far fa-edit"></i>
                                    <p>User Account Management</p>
                                </a>
                            </li>
                        <?php endif; ?>                   
                        <?php if (in_array('302' , $roll_section)): ?>
                            <li class="nav-item disabled">
                                <a href="../user_role/users_role.php" class="nav-link">
                                    <i class="nav-icon far fa-edit"></i>
                                    <p>User Access Management</p>
                                </a>
                            </li>   
                        <?php endif; ?>
                    </ul>
                </li>  
 
                <li class="nav-item">                   
                        <a href="../user_profile/index.php" class="nav-link deactive">
                            <i class="nav-icon far fa-user"></i>
                            <p>User Profile</p>
                        </a>                     
                </li> 
                <li class="nav-item">                   
                        <a href="#" class="nav-link deactive">
                            <i class="nav-icon far fa-question-circle"></i>
                            <p>Help</p>
                        </a>                     
                </li> 
                <li class="nav-item">                    
                    <a href="../logout/logout.php" class="nav-link">
                        <i class="nav-icon fas fas fa-power-off"></i>
                        <p>
                            Logout
                            <span class="badge badge-info right"></span>
                        </p>
                    </a> 
                </li>  
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
      <!-- /.sidebar -->
</aside>
