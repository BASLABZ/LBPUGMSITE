<?php
include '../inc/inc-db.php';
session_start();
error_reporting(0);



?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

 <!-- BEGIN HEAD -->
<head>
      <meta charset="UTF-8" />
    <title>MENU EDIT</title>
     <meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
     <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <!-- GLOBAL STYLES -->
    <!-- GLOBAL STYLES -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="assets/css/theme.css" />
    <link rel="stylesheet" href="assets/css/MoneAdmin.css" />
    <link rel="stylesheet" href="assets/plugins/Font-Awesome/css/font-awesome.css" />
    <!--END GLOBAL STYLES --> 

    <!-- PAGE LEVEL STYLES -->
    
 <link href="assets/css/jquery-ui.css" rel="stylesheet" />
<link rel="stylesheet" href="assets/plugins/uniform/themes/default/css/uniform.default.css" />
<link rel="stylesheet" href="assets/plugins/inputlimiter/jquery.inputlimiter.1.0.css" />
<link rel="stylesheet" href="assets/plugins/chosen/chosen.min.css" />
<link rel="stylesheet" href="assets/plugins/colorpicker/css/colorpicker.css" />
<link rel="stylesheet" href="assets/plugins/tagsinput/jquery.tagsinput.css" />
<link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker-bs3.css" />
<link rel="stylesheet" href="assets/plugins/datepicker/css/datepicker.css" />
<link rel="stylesheet" href="assets/plugins/timepicker/css/bootstrap-timepicker.min.css" />
<link rel="stylesheet" href="assets/plugins/switch/static/stylesheets/bootstrap-switch.css" />
   
    <!-- END PAGE LEVEL  STYLES -->
   <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

</head>
     <!-- END HEAD -->
     <!-- BEGIN BODY -->
<body class="padTop53 " >

       <!-- MAIN WRAPPER -->
    <div id="wrap">


          <!-- HEADER SECTION -->
        <div id="top">

            <nav class="navbar navbar-inverse navbar-fixed-top " style="padding-top: 10px;">
                <a data-original-title="Show/Hide Menu" data-placement="bottom" data-tooltip="tooltip" class="accordion-toggle btn btn-primary btn-sm visible-xs" data-toggle="collapse" href="#menu" id="menu-toggle">
                    <i class="icon-align-justify"></i>
                </a>
                <!-- LOGO SECTION -->
                <header class="navbar-header">

                    <a href="index.html" class="navbar-brand">
                     <h4>
                    <?php echo "Selamat datang di halaman ".$_SESSION['levelName']."!"; ?>
                    </h4>
                </header>
                <!-- END LOGO SECTION -->
                <ul class="nav navbar-top-links navbar-right">

                    
                           
                    <!--ADMIN SETTINGS SECTIONS -->

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="icon-user "></i>&nbsp; <i class="icon-chevron-down "></i>
                        </a>

                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#"><i class="icon-user"></i> User Profile </a>
                            </li>
                            <li><a href="#"><i class="icon-gear"></i> Settings </a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="logout.php"><i class="icon-signout"></i> Logout </a>
                            </li>
                        </ul>

                    </li>
                    <!--END ADMIN SETTINGS -->
                </ul>

            </nav>

        </div>
        <!-- END HEADER SECTION -->



        <!-- MENU SECTION -->
       <div id="left">
            <div class="media user-media well-small">
                <a class="user-link" href="#">
                    <img class="media-object img-thumbnail user-img" alt="User Picture" src="assets/img/user.gif" />
                </a>
                <br />
                <div class="media-body">
                    <h5 class="media-heading"><?php echo $_SESSION['userName'];?></h5>
                    <ul class="list-unstyled user-info">
                        
                        <li>
                             <a class="btn btn-success btn-xs btn-circle" style="width: 10px;height: 12px;"></a> Online
                           
                        </li>
                       
                    </ul>
                </div>
                <br />   
                    </div>
                        <!-- KONEKSI MENU DINAMIS -->
                         <ul id="menu" class="collapse">
                            <?php 
                             include '../inc/inc-menu.php';
                             ?> 
                     </ul>
           
                    </div>
        <!--END MENU SECTION -->

       <!--PAGE CONTENT -->
        <div id="content">
           
                <div class="inner">
                    <div class="row">
                <div class="col-lg-12">
                    <center>
                        <h4 style="line-height:1.5em">
                            <?php
                                echo "Laboratorium Bioantropologi dan Paleantropologi </br>
                                	Fakultas Kedokteran </br>
                                	Universitas Gadjah Mada";
                                echo "</br>";
                            ?>
                        </h4>
                        </center>
                </div>
            </div>
                     
                    
<!-- Header Menu -->
<div class="row">
<div class="col-lg-12">
    <div class="box dark">
        <header>
            <h5>Perbarui Menu</h5>
            <div class="toolbar"></div>
        </header>
        <!-- Show data dr tabel menu -->
        <?php
            $var_id = ($_GET['id']);
            if($var_id>0){
            $edit       = "SELECT menu_id, menu_name, menu_url, menu_parent from ref_menu where menu_id = '".$var_id."'";  
            $sql        = mysql_query($edit);
            $var_data   = mysql_fetch_array($sql);
            
            $var_menu   = $var_data['menu_name'];
            $var_url    = $var_data['menu_url'];
            $var_link   = $var_data['menu_parent'];
        }

        ?>
        <!-- DIV UNTUK MENU EDIT -->
        <div id="div-1" class="accordion-body collapse in body">
            <form action="menu-edit-save.php" method="post" class="form-horizontal">

                <div class="form-group"> 
                    <label class="control-label col-lg-4">Nama Menu</label>
                    <div class="col-lg-8">
                        <input type="text" placeholder="Menu Name" class="form-control" name="frm_menu" value="<?php echo $var_menu ?>" required />
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-4">URL Link</label>
                    <div class="col-lg-8">
                        <input type="text" name="frm_url" placeholder="URL Link" class="form-control" value="<?php echo $var_url?>" required/>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label col-lg-4">Menu Parent</label>
                        <div class="col-lg-8">
                            <select class="form-control" name="frm_parent"> 
                                <?php
                                // perbandingan utk menampilkan menu parent dr menu name

                                // 1. menampilkan menu parent berdasarkan id yg dilempar dr menu name yg akan diedit
                                    $showanak = "SELECT menu_parent FROM ref_menu WHERE menu_id='".$_GET['id']."' ";
                                    $run_showanak = mysql_query($showanak);
                                    $data_anak = mysql_fetch_array($run_showanak);
                                        $var_menusimbok = $data_anak['menu_parent'];

                                // 2. menampilkan semua menu name yg memiliki menu parent 0
                                    $show="SELECT menu_id, menu_name from ref_menu where menu_parent=0 order by menu_id ASC";
    
                                    $run=mysql_query($show);
                                    while ($var_data=mysql_fetch_array($run)) {
                                        $var_menuid = $var_data ['menu_id'];
                                        $var_menuname = $var_data['menu_name'];

                                        // jika menu id yg diambil dr database sama dengan 
                                        // id menu name yg diambil (dr get) maka echo menu name yg cocok idnya
                                        if ($var_menuid==$var_menusimbok) { ?>
                                            <option value="<?php echo $var_menuid;?>" selected=""><?php echo $var_menuname; ?></option> <?php
                                        } else { ?>
                                            <option value="<?php echo $var_menuid;?>"><?php echo $var_menuname; ?></option> <?php

                                        } // tutup else

                                        ?>
                                       <!--  <option value="<?php //echo $var_menuid; ?>"><?php //echo $var_menuname; ?></option> -->
                                  <?php
                                   } // tutup while
                                ?>       
                            </select>
                        </div>    
                </div>
                <div class="form-group">
                	<div class="col-sm-8 col-sm-offset-4">
                    	<input type="hidden" name="frm_id" value="<?php echo $var_id ?>">
                    	<input type="submit" name="submit" class="btn btn-success" value="SAVE" align="right">
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>



     <!-- GLOBAL SCRIPTS -->
    <script src="assets/plugins/jquery-2.0.3.min.js"></script>
     <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <!-- END GLOBAL SCRIPTS -->


      <!-- PAGE LEVEL SCRIPT-->
 <script src="assets/js/jquery-ui.min.js"></script>
 <script src="assets/plugins/uniform/jquery.uniform.min.js"></script>
<script src="assets/plugins/inputlimiter/jquery.inputlimiter.1.3.1.min.js"></script>
<script src="assets/plugins/chosen/chosen.jquery.min.js"></script>
<script src="assets/plugins/colorpicker/js/bootstrap-colorpicker.js"></script>
<script src="assets/plugins/tagsinput/jquery.tagsinput.min.js"></script>
<script src="assets/plugins/validVal/js/jquery.validVal.min.js"></script>
<script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
<script src="assets/plugins/daterangepicker/moment.min.js"></script>
<script src="assets/plugins/datepicker/js/bootstrap-datepicker.js"></script>
<script src="assets/plugins/timepicker/js/bootstrap-timepicker.min.js"></script>
<script src="assets/plugins/switch/static/js/bootstrap-switch.min.js"></script>
<script src="assets/plugins/jquery.dualListbox-1.3/jquery.dualListBox-1.3.min.js"></script>
<script src="assets/plugins/autosize/jquery.autosize.min.js"></script>
<script src="assets/plugins/jasny/js/bootstrap-inputmask.js"></script>
       <script src="assets/js/formsInit.js"></script>
        <script>
            $(function () { formInit(); });
        </script>
        
     <!--END PAGE LEVEL SCRIPT-->
     
</body>
     <!-- END BODY -->
</html>
