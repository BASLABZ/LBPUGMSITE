<?php
include 'function.php';
session_start();
error_reporting(0);
include '../inc/inc-db.php';
?>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>DAFTAR PENGAJUAN PEMINJAMAN ALAT</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" href="assets/css/main.css" />
        <link rel="stylesheet" href="assets/css/theme.css" />
        <link rel="stylesheet" href="assets/css/MoneAdmin.css" />
        <link rel="stylesheet" href="assets/plugins/Font-Awesome/css/font-awesome.css" />
        <link href="assets/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    </head>
    <body class="padTop53 " >
        <div id="wrap">
            <div id="top">
                <nav class="navbar navbar-inverse navbar-fixed-top " style="padding-top: 10px;">
                    <a data-original-title="Show/Hide Menu" data-placement="bottom" data-tooltip="tooltip" class="accordion-toggle btn btn-primary btn-sm visible-xs" data-toggle="collapse" href="#menu" id="menu-toggle">
                    <i class="icon-align-justify"></i>
                    </a>
                    <header class="navbar-header">
                        <a href="bs-admin-area.php" class="navbar-brand">
                            <h4> 
                                <?php echo "Selamat datang di halaman ".$_SESSION['levelName']."!"; ?>
                            </h4>
                        </a>
                    </header>
                    <ul class="nav navbar-top-links navbar-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="icon-user "></i>&nbsp; <i class="icon-chevron-down "></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li>
                                    <a href="#"><i class="icon-user"></i> User Profile </a>
                                </li>
                                <li>
                                    <a href="#"><i class="icon-gear"></i> Settings </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="logout.php"><i class="icon-signout"></i> Logout </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
            <div id="left">
                <div class="media user-media well-small">
                    <a class="user-link" href="#">
                        <img class="media-object img-thumbnail user-img" alt="User Picture" src="assets/img/user.gif" />
                    </a>
                    <br />
                    <div class="media-body">
                        <h5 class="media-heading"><?php echo $_SESSION['userName']?></h5>
                        <ul class="list-unstyled user-info">
                            <li>
                                <a class="btn btn-success btn-xs btn-circle" style="width: 10px;height: 12px;"></a> Online
                            </li>
                        </ul>
                    </div>
                    <br />
                </div>
                <ul id="menu" class="collapse">
                    <?php 
                         include '../inc/inc-menu.php';
                    ?> 
                </ul>
            </div>
            <div id="content">
                <div class="inner">
                    <div class="row">
                        <div class="col-lg-12">
                            <center>
                                <h4 style="line-height:1.5em">                       
                                    <?php 
                                    echo"Laboratorium Bioantropologi dan Paleoantropologi </br>Fakultas Kedokteran </br> Universitas Gadjah Mada";
                                    echo "</br></br>";                       
                                    ?>
                                </h4>
                            </center>
                        </div> <!-- tutup col lg -->
                    </div> <!-- tutup row -->
                    <hr />

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    Daftar Pengajuan
                                </div>
                                <div class="panel-body">
                                    <form action="bs-loan-cart.php" method="post">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover" id="dataTables-example" width="100%">
                                                <?php
                                                $per_hal = 10;
                                                $_SESSION['limit']=$per_hal;
                                                $page = $_GET['page'];
                                                if(empty($page)){ //cek halaman kosong atau
                                                    $page = 1;
                                                }
                                                $start = ($page-1)*$per_hal;

                                                $var_check = "SELECT * from trx_loan_application JOIN tbl_member ON trx_loan_application.member_id_fk=tbl_member.member_id";
                                                $var_runcheck = mysql_query($var_check);
                                                $var_jml_baris = mysql_num_rows($var_runcheck);
                                                ?>
                                                <thead>
                                                    <tr>
                                                        <th>NO</th>
                                                        <th>Tanggal Pengajuan</th>
                                                        <th>No Nota</th>
                                                        <th>Nama</th>
                                                        <th>Tanggal Pinjam</th>
                                                        <th>Tanggal Kembali</th>
                                                        <th>Status</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <?php
                                                if($var_jml_baris==0){?> 
                                                <tr>
                                                    <td align="center" colspan="8">Belum ada data</td>
                                                </tr>
                                                <?php
                                                }else{
                                                    $var_nomer=$start+1;    while($var_data=mysql_fetch_array($var_runcheck)){ 
                                                        $var_id         = $var_data['loan_app_id'];
                                                        $var_date       = $var_data['loan_app_date'];
                                                        $var_inv        = $var_data['loan_invoice'];
                                                        $var_member     = $var_data['member_name'];
                                                        $var_loan       = $var_data['loan_date'];
                                                        $var_return     = $var_data['return_date'];
                                                        $var_status     = $var_data['loan_status'];
                                                ?> 
                                                <tbody>             
                                                    <tr>
                                                        <td><?php echo $var_nomer++ ?></td>
                                                        <td><?php echo $var_date ?></td>
                                                        <td><?php echo $var_inv?></td>
                                                        <td><?php echo $var_member?></td>
                                                        <td><?php echo $var_loan?></td>
                                                        <td><?php echo $var_return?></td>
                                                        <td><i class="btn btn-warning btn-xs"><?php echo $var_status?></i></td>
                                                <!-- <td><?php //echo $var_item?></td> -->
                                                <!-- <td><?php //echo $var_amount?></td> -->
                                                <!--<td><img style='width:130px; height=150px;'src="<?php //echo $var_foto?>"></td>
                                               <!-- <td><?php //echo $var_status;?></td>-->
                                                        <td>
                                                            <a href="" data-toggle="modal" href="#formModal" data-target="#formModal">Lihat Detail</a>
                                                        </td>			
                                                    </tr>  
                                                </tbody>     
                                                <?php
                                                    }//while
                                                }//if
                                                ?>  
                                            </table> <!-- table class -->
                                        </div> <!-- table responsive -->
                                    </form> <!-- form action -->
                                </div> <!-- divclass panel body -->
                            </div> <!-- div class panel2 primary -->
                        </div> <!-- div class row ketersediaan alat -->  
                    </div> <!-- div classs inner -->
                </div> <!-- tutup div id content -->
            </div>
        </div>
        <div id="footer">
            <p>&copy;  binarytheme &nbsp;2014 &nbsp;</p>
        </div>
        <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" style="width:1000px">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="H2">Detail Pengajuan</h4>
                    </div>
                    <div class="modal-body" style="margin:20px;padding:0px">
                        <form role="">
                            <?php 
                            $show_detail = "SELECT * from trx_loan_application JOIN trx_loan_application_detail ON trx_loan_application.loan_app_id=trx_loan_application_detail.loan_app_id_fk JOIN ref_instrument ON ref_instrument.instrument_id=trx_loan_application_detail.instrument_id_fk ORDER BY loan_app_id";
                            echo "$show_detail";
                            $run_show   = mysql_query($show_detail);
                            $show_rows  = mysql_num_rows($run_show); 
                            ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-info">
                                <div class="panel-heading">
                            AKJFKAFJAKFAJAFKAGAKGA
                                </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" >
                                    <thead>
                                        <th>NO</th>
                                        <th>GAMBAR</th>
                                        <th>NAMA ALAT</th>
                                        <th><center>LAMA PEMINJAMAN</center></th>
                                        <th>JUMLAH</th>
                                        <th>HARGA</th>
                                        <th>AKSI</th>
                                        <th>KETERANGAN</th>
                                    </thead>
                                    <tbody>
                                        <?php     
                                        $var_nomer=$start+1; 
                                        while($var_data=mysql_fetch_array($run_show)){ 
                                            $var_id         = $var_data['instrument_id'];
                                            $var_nama       = $var_data['instrument_name'];
                                            $var_total      = $var_data['loan_total_item'];
                                            $var_harga      = $var_data['instrument_fee'];
                                        ?>          
                                        <tr>
                                            <td><?php echo $var_nomer++ ?></td>
                                            <td><img style='width:130px; height=150px;'src="<?php echo $var_gambar?>"></td> 
                                            <td><?php echo $var_nama?></td>
                                            <td><?php echo $var_total?></td>
                                            <td><?php echo $var_harga?></td>
                                            <td><?php echo $var_nama?></td>
                                            <td><?php echo $var_total?></td>
                                            <td><?php echo $var_harga?></td>
                                        </tr>
                                        <?php
                                        } //while 
                                        ?>
                                    </tbody>
                                </table> 
                            </div> <!-- table responsive -->
                        </div> <!-- panel2 info -->
                    </div> <!-- col-lg-12 -->
                 </div> <!-- row -->
            </form>
        </div> <!-- modal body -->
    </div><!--  modal content -->
</div><!--  modal dialog -->
        </div> <!-- modal fade -->
        <script src="assets/plugins/jquery-2.0.3.min.js"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <script src="assets/plugins/dataTables/jquery.dataTables.js"></script>
        <script src="assets/plugins/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
        </script>
    </body>
    <!-- END BODY -->
    <?php 
    if ($_SESSION['pesan_peringatan']!='') 
    { 
    ?>
    <script>alert('<?php echo $_SESSION['pesan_peringatan']; ?>')</script>
    <?php
        unset($_SESSION['pesan_peringatan']);
        exit();
    }
    ?>
</html>
