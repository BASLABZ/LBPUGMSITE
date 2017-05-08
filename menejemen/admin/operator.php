<?php
include 'function.php';
error_reporting(0);
session_start(); // utk menyalakan session
include '../inc/inc-db.php';
?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

 <!-- BEGIN HEAD -->
<head>
     <meta charset="UTF-8" />
    <title>OPERATOR</title>
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
    <link href="assets/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
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
                    include "../inc/inc-top-menu.php";
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
                    <!-- MENU DINAMIS -->
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
        </div> <!-- tutup row -->

    <hr />
        <!-- DIV TAMBAH OPERATOR -->
            <div class="row"> 
                <div class="col-sm-6">
                    <div class="form-group">	
               			<a href="operator-add.php" class="btn btn-primary" align="right"><i class="icon-plus"> Tambah Operator</i></a></br>
               		</div>
                </div>
            </div> <!-- tutup row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Data Operator
                        </div>
                            <div class="panel-body">
                            <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="dataTables-example" width="100%">

        <?php 
        // pagination
        $per_hal = 10;
        $_SESSION['limit']=$per_hal;
        $page = $_GET['page'];
            if(empty($page)){ //cek halaman kosong atau tidak
                
                $page = 1;
            } else { //jika hal tidak kosong makan tentukan nilai posisi page
                        //contoh jika di pade 2 maka (2-1)*
                
            }

        $start = ($page-1)*$per_hal;

        $var_check = "SELECT * from ref_operator join ref_level on ref_operator.level_id_fk=ref_level.level_id";

        $var_runcheck   = mysql_query($var_check);
        $var_jml_baris  = mysql_num_rows($var_runcheck);

        ?>
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NAMA</th>
                    <th>JENIS KELAMIN</th>
                    <th>USERNAME</th>
                    <th>PASSWORD</th>
                    <th>EDIT</th>
                    <th>HAPUS</th>
                </tr>
            </thead>

        <?php

       
        if($var_jml_baris==0){?> <!--jika jumlah baris 0 maka >> belum ada data-->
            <tr>
                <td align="center" colspan="8">Belum ada data</td>
            </tr>
        <?php
    }
        else{
            //Looping data
        ?>
        <tbody> 
        <?php
            $var_nomer=$start+1; //menampilkan urutan angka
            while($var_data=mysql_fetch_array($var_runcheck)){ //melakukan perulangan yg belum diketahui jumlah recordnya
            //fetch array: mengambil data dr db

                $var_id         = $var_data['operator_id'];
                $var_nama       = $var_data['operator_name'];
                $var_jk         = $var_data['operator_gender'];
                $var_username   = $var_data['operator_username'];
                $var_password   = $var_data['operator_password'];
                //Buat counter
                
                //--Perihal tabel taruh disini
                ?> 
                           
                    <tr>
                        <td><?php echo $var_nomer++?></td>
                        <td><?php echo $var_nama?></td>
                        <td><?php echo $var_jk?></td>
                        <td><?php echo $var_username?></td>
                        <td><?php echo $var_password?></td>
                        <td>
                            <a href="operator-edit.php?id=<?php  echo $var_id?>" class="btn btn-warning btn-rect"><i class="icon-pencil icon-white"></i>
                            </a>
                        </td>
                        <td>
                            <a href="operator-delete.php?id=<?php  echo $var_id?>" class="btn btn-danger btn-rect"><i class="icon-trash icon-white"></i>
                            </a>
                        </td>
                    </tr>           
            <?php
                } //while 
            ?>
        </tbody>
<?php
    } //else
?>  
                                    </table> <!-- tutup table2 stripped -->
                                </div> <!--  table responsive -->
                            </form> <!-- form action -->
                        </div> <!--  panel body -->
                    </div> <!--  panel2 primary -->
                </div> <!-- col-lg-12-->   
            </div> <!-- row-->
        </div> <!-- inner -->
       <!--END PAGE CONTENT -->

    </div> <!-- id content -->

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
        <!-- PAGE LEVEL SCRIPTS -->
    <script src="assets/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="assets/plugins/dataTables/dataTables.bootstrap.js"></script>
     <script>
         $(document).ready(function () {
             $('#dataTables-example').dataTable();
         });
    </script>
     <!-- END PAGE LEVEL SCRIPTS -->
</body>
     <!-- END BODY -->
</html>
