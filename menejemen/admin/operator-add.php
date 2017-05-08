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
    <title>OPERATOR ADD</title>
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
           
                    </div>
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
            <h5>Tambah Data Operator</h5>
                <div class="toolbar">   
                </div>
        </header>

        <!-- DIV UNTUK OPERATOR ADD -->
        <div id="div-1" class="accordion-body collapse in body">
            <form action="operator-add-save.php" method="post"class="form-horizontal">

                <div class="form-group"> 
                    <label for="text1" class="control-label col-lg-4">Nama</label>

                    <div class="col-lg-8">
                        <input type="text" placeholder="Nama" class="form-control" name="frm_nama" required />
                    </div>
                </div>
                 <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Jenis Kelamin</label>
                        <label class="radio-inline">
                            <input type="radio" name="frm_jk" value="Laki-laki" required  />Laki-laki
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="frm_jk" value="Perempuan" required />Perempuan
                        </label>
                </div>    
                 <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Username</label>

                    <div class="col-lg-8">
                        <input type="text" name="frm_user" placeholder="Username" class="form-control" required/>
                    </div>
                </div>  
                <div class="form-group">
                    <label for="pass1" class="control-label col-lg-4">Password</label>
                    <div class="col-lg-8">
                        <input class="form-control" type="password" name="frm_pass" placeholder="Password"
                               data-original-title="Please use your secure password" data-placement="top" required/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-4">Hint Question</label>
                         <div class="col-lg-8">
                             <select class="form-control" name="frm_hint">
                                <option>Choose Hint Question</option>
                                <option>Apa warna favorit anda?</option>
                                <option>Apa makanan favorit anda?</option>
                                <option>Siapa nama ayah kandung anda?</option>
                                <option>Siapa nama penyanyi kesukaan anda?</option>
                            </select>
                         </div>
                </div>
                <div class="form-group">
                    <label for="text2" class="control-label col-lg-4">Answer Question</label>

                    <div class="col-lg-8">
                        <input type="text" placeholder="Answer Question" class="form-control" name="frm_answer"
                        value="<?php echo $var_answer ?>" required/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-4">Level</label>
                        <div class="col-lg-8">
                             <select class="form-control" name="frm_level">
                             <!-- <option value="0">Pilih Level</option>  -->
                                <?php
                            $tampil = "SELECT level_id, level_name from ref_level";
                            $sql    = mysql_query($tampil);
                            while ($showlevel = mysql_fetch_array($sql)){
                                $levelid    = $showlevel['level_id'];
                                $levelname  = $showlevel['level_name'];?>

                                <option value="<?php echo $levelid ?>"><?php echo $levelname ?></option>
                        <?php
                            } //tutup while
                        ?>
                            </select>
                 
                        </div>
                        &nbsp

                          <!-- DIV BUTTON SAVE -->
                          <div class="form-group">
                         	<div class="col-sm-8 col-sm-offset-4">
                               <input type="submit" name="btn_submit" class="btn btn-success" value="Simpan" align="right">
                            </div>
                          </div>
                </div> <!-- form group -->

               
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

   <!-- FOOTER -->
    <div id="footer">
        <p>&copy;  binarytheme &nbsp;2014 &nbsp;</p>
    </div>
    <!--END FOOTER -->


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
