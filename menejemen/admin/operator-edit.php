<?php
include '../inc/inc-db.php';
session_start();
error_reporting(0);
    
    $var_id = ($_GET['id']);

    $showdata       = "SELECT operator_name, operator_username, operator_password from ref_operator where operator_id = '".$var_id."'";
    $runshow        = mysql_query($showdata);
    $var_data   = mysql_fetch_array($runshow);
    

    $var_nama       = $var_data['operator_name'];
    $var_username   = $var_data['operator_username'];
    $var_password   = $var_data['operator_password'];

?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

 <!-- BEGIN HEAD -->
<head>
    <meta charset="UTF-8" />
    <title>OPERATOR EDIT</title>
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
            <?php
                include '../inc/inc-top-menu.php';
            ?>
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
           
        </div> <!-- left -->
        <!--END MENU SECTION -->

       <!--PAGE CONTENT -->
        <div id="content">
           
                <div class="inner">
                    <div class="row">
                        <div class="col-lg-12">
                            <center>
                                <h4 style="line-height:2em">
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
                     
                    
<div class="row">
<div class="col-lg-12">
    <div class="box dark">
        <header>
            <h5>Perbarui Data Operator</h5>
                <div class="toolbar">   
                </div>
        </header>

        <!-- DIV UNTUK EDIT OPERATOR -->
        <div id="div-1" class="accordion-body collapse in body">
            <form action="operator-edit-save.php" method="post" class="form-horizontal">

                <div class="form-group"> 
                    <label for="text1" class="control-label col-lg-4">Nama</label>

                    <div class="col-lg-8">
                        <input type="text" class="form-control" name="frm_nama" 
                        value="<?php echo $var_nama ?> "required />
                    </div>
                </div>

                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Username</label>

                    <div class="col-lg-8">
                        <input type="text" name="frm_user" class="form-control"
                        value="<?php echo $var_username ?>" required/>
                    </div>
                </div>

                <div class="form-group">
                    <label for="pass1" class="control-label col-lg-4">Password</label>
                    <div class="col-lg-8">
                        <input type="hidden" name="frm_id" value="<?php echo $var_id ?>"/>
                        <input class="form-control" type="password" name="frm_pass" value="<?php echo $var_password; ?>" placeholder="Password"
                               data-original-title="Please use your secure password" data-placement="top" required/>
                    </div>
                </div>

                <!-- DIV BUTTON SIMPAN -->
                <div class="form-group">
                	<div class="col-sm-8 col-sm-offset-4">
                    	<input type="submit" name="btn_submit" class="btn btn-success" value="Simpan" align="right">
                	</div>
                </div>
                </form> <!-- form action -->
            </div> <!-- div-1 collapse in body -->
        </div> <!-- box dark -->
    </div> <!-- col-lg-12 -->
</div> <!-- row -->

</div> <!-- inner -->
        

    </div> <!-- content -->
    <!-- END PAGE CONTENT -->

                
     </div> <!-- wrap -->   
    <!--END MAIN WRAPPER -->



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
