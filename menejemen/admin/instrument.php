<?php
include 'function.php';
include '../inc/inc-db.php';
error_reporting(0);
session_start(); // utk menyalakan session
?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

 <!-- BEGIN HEAD -->
<head>
     <meta charset="UTF-8" />
    <title>ALAT</title>
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

            <hr />

            <!-- DIV TAMBAH DATA ALAT -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">    
                        <a href="instrument-add.php" class="btn btn-primary" align="right"><i class="icon-plus"> Tambah Alat</i></a></br>
                    </div>
                </div>
            </div>

            <div class="row"> <!-- row table -->
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Data Alat
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
       <?php
        $per_hal = 3;
        $_SESSION['limit']=$per_hal;
        $page = $_GET['page'];
            if(empty($page)){ //cek halaman kosong atau tidak
                
                $page = 1;
            } else { //jika hal tidak kosong makan tentukan nilai posisi page
                        //contoh jika di pade 2 maka (2-1)*
                
            }

            $start = ($page-1)*$per_hal;

        $var_check = "SELECT * from ref_instrument";
        $var_data = $_POST['instrument_name'];

        if (isset($_POST['search']) and $_POST['instrument_name']!=""){
            $var_check = $var_check." where instrument_name LIKE '%$var_data%'";
        } else if ($_SESSION['newtampil']!="" and !isset($_POST['refresh'])){
            $var_check = $_SESSION['newtampil'];
        } else if (isset($_POST['refresh'])){
            $var_check = $var_check;
        } else{
            $var_check = $var_check;
        }
        $_SESSION['tampil'] = $var_check; 
            $var_check = $var_check. " ORDER BY instrument_id LIMIT $start, $per_hal";

    
        $var_runcheck = mysql_query($var_check);
        $var_jml_baris = mysql_num_rows($var_runcheck);
        ?>
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            
                                            <!-- <th>SPESIFIKASI</th> -->
                                            <th>GAMBAR</th>
                                            <th>NAMA ALAT</th>
                                            <th>MERK</th>  
                                            <th><center>HARGA SEWA</center></th>
                                            <th>JUMLAH</th>
                                            <th>STATUS</th>
                                            <th>LIHAT ALAT</th>
                                            <th>EDIT</th>
                                            <th width="5%">HAPUS</th>
                                        </tr>
                                    </thead>

        <?php
        include '../inc/inc-db.php';
        if($var_jml_baris==0){?> <!--jika jumlah baris 0 maka >> belum ada data-->
            <tr>
                <td align="center" colspan="8">Belum ada data</td>
            </tr>
        <?php
        }
        else{
            //Looping data
            
            $var_nomer=$start+1; //menampilkan urutan angka
            while($var_data=mysql_fetch_array($var_runcheck)){ //melakukan perulangan yg belum diketahui jumlah recordnya
            //fetch array: mengambil data dr db

                $var_id         = $var_data['instrument_id'];
                $var_nama       = $var_data['instrument_name'];
                $var_merk       = $var_data['instrument_brand'];
                $var_jumlah     = $var_data['instrument_quantity'];
                $var_harga      = $var_data['instrument_fee'];
                // $var_spek       = $var_data['instrument_spec'];
                $var_gambar     = "../image/".$var_data['instrument_picture'];
               
                //Buat counter
                
                //--Perihal tabel taruh disini
                ?> 
                <tbody>             
                    <tr>
                        <td><?php echo $var_nomer++?></td>
                       
                        <!-- <td><?php //echo $var_spek?></td> -->
                        <td><img style='width:130px; height=150px;' src="<?php echo $var_gambar?>"></td>
                         <td><?php echo $var_nama?></td>
                        <td><?php echo $var_merk?></td>
                        <td align="center"><?php echo $var_harga?></td>
                        <td align="center"><?php echo $var_jumlah?></td>
                        <td><a href="" class="btn btn-success">Tersedia</a></td>
                        <td>
                            <a href="#" data-toggle="modal" href="#formModal" data-target="#formModal" class="btn btn-info btn-line">Lihat Detail</a>
                        </td>
                        <td>
                            <a href="instrument-edit.php?id=<?php  echo $var_id?>" class="btn btn-warning btn-rect"><i class="icon-pencil icon-white"></i>
                            </a>
                        </td>
                        <td>
                            <a href="instrument-delete.php?id=<?php  echo $var_id?>" class="btn btn-danger btn-rect"><i class="icon-trash icon-white"></i>
                            </a>
                        </td>
                    </tr>  
                </tbody>     
            <?php
            }//while

        }//if
    ?>  
                                </table> <!-- table2 striped -->
                            </div> <!-- table responsive -->
                        </div> <!--panel body -->
                    </div> <!-- panel2 primary -->
                </div> <!--col-lg-12--> 

        </div> <!-- row table -->
       <!--END PAGE CONTENT -->
<?php
        $jml_pagging=pagging($count);
        echo "<br/>"."Page : ";
        for($x=1; $x<=$jml_pagging; $x++){
            if($x != $page){
                echo "<a href=$_SERVER[PHP_SELF]?page=$x>$x</a> | ";
            } else {
                echo "<b>".$x."</b>"." | ";
            }

        }
        echo "Total Record : "."<b>".$_SESSION['jum_rec']."</b>";
        ?>

    </div>

     <div class="col-lg-12">
                        <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="H2">Modal Form</h4>
                                        </div>
                                        <div class="modal-body">
                                           <form role="form">
                                        <div class="form-group">
                                            <label>Text Input</label>
                                            <input class="form-control" />
                                            <p class="help-block">Example block-level help text here.</p>
                                        </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                        </div>
    </div>

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
