<!-- slider -->
<div id="inSlider" class="carousel carousel-fade" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#inSlider" data-slide-to="0" class="active"></li>
        <li data-target="#inSlider" data-slide-to="1"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <div class="container">
                <div class="carousel-caption">
                    <h2 style="font-size: 28px;">Laboratorium Bioantropologi  <br/>
                        Paleantropologi LBP<br/>
                        Universitas Gajah Mada [LBP-UGM]</h2>
                        <?php 
                            if (isset($_SESSION['member_name'])) {
                         ?>
                    <?php }else{ ?>
                    <p>
                        <a class="btn btn-lg btn-primary dim_about" href="#" data-toggle="modal" data-target="#registrasi" role="button"><span class="fa fa-user-plus"></span> Daftar</a>
                    </p>
                    <?php } ?>
                </div>
            </div>
            <!-- Set background for slide in css -->
            <div class="header-back one"></div>

        </div>
        <div class="item">
            <div class="container">
                <div class="carousel-caption blank">
                    <h2 style="font-size: 28px;">Laboratorium Bioantropologi <br/>
                        Paleantropologi LBP<br/>
                        Universitas Gajah Mada [LBP-UGM]</h2>
                         <?php 
                            if (isset($_SESSION['member_name'])) {
                         ?>
                    <?php }else{ ?>
                    <p><a class="btn btn-lg btn-primary dim_about" href="#" data-toggle="modal" data-target="#login" role="button"><span class="fa fa-sign-in"></span> Login</a></p>
                    <?php } ?>
                </div>
            </div>
            <!-- Set background for slide in css -->
            <div class="header-back two"></div>
        </div>
    </div>
    <a class="left carousel-control" href="#inSlider" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#inSlider" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<section class="features dim_about" style="background-color:#1ab394;">
    <div class="container" style="padding-top: 20px;">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 style="color:white; "><span class="fa fa-flask fa-2x"></span><br>Peralatan BIO-PALEONTROPOLOGI</h1>

                <p style="color: white;">Daftar Data Perlatan Laboratorium Bio-Paleontropologi UGM </p>
            </div>
        </div>
    </div>
</section>
<!-- daftar instument -->

<!-- prosedur -->
<section class="timeline gray-section" id="prosedur">
    <div class="container">
         <div class="row">
            <div class="col-lg-12 text-center">
                <div class="navy-line"></div>
                <h1>PROSEDUR PENDAFTARAN MEMBER</h1>
                <p>Berikut Prosedur Pendaftaran Member Lab. Bio-Paleoantropologi UGM </p>
            </div>
        </div>
        <div class="row features-block">

            <div class="col-lg-12">
                <div id="vertical-timeline" class="vertical-container light-timeline center-orientation">
                    <div class="vertical-timeline-block">
                        <div class="vertical-timeline-icon navy-bg">
                            <i class="fa fa-briefcase"></i>
                        </div>

                        <div class="vertical-timeline-content dim_about">
                            <div class="col-xs-12">
                            <style type="text/css">
                                    .step-number {
                                        display: inline-block;
                                        margin: 10px 0 0 20px;
                                        padding: 8px 14px;
                                        border-radius: 50%;
                                        color: white;
                                        font-size: 21px;
                                        background-color:#1ab394;
                                    }
                                </style>
                                 <div class="row">
                                     <div class="col-md-2">
                                         <span class="step-number">1</span> 
                                     </div>
                                     <div class="col-md-10">
                                       <h2 style="padding-top: 10px;"> Registrasi </h2>
                                         <p>Silahkan melihat alat-alat pada halaman daftar ketersediaan alat</p>
                                         <a href="#modal_registrasi_member" class="btn btn-xs btn-primary" data-toggle="modal">Info Selengkapnya</a>
                                     </div>
                                 </div>
                                  
                            </div> 
                            <div class="col-xs-12">
                            <span class="vertical-date"> Today <br/> <small>Dec 24</small> </span>
                            </div>
                        </div>
                    </div>

                    <div class="vertical-timeline-block">
                        <div class="vertical-timeline-icon navy-bg">
                            <i class="fa fa-file-text"></i>
                        </div>

                        <div class="vertical-timeline-content dim_about">
                        <div class="col-xs-12">
                            <div class="row">
                                <div class="col-md-2">
                                    <span class="step-number">2</span> 
                                </div>
                                <div class="col-md-10">
                                    <h2 style="padding-top: 10px">Aktivasi Akun</h2>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since.</p>
                                    <a href="#modal_aktivasi_member" class="btn btn-xs btn-primary" data-toggle="modal"> Info Selengkapnya</a>
                                </div>
                                     <span class="vertical-date"> Tomorrow <br/> <small>Dec 26</small> </span>
                            </div>
                        </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- prosedur peminjaman  -->
<section class="timeline gray-section" id="prosedur">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="navy-line"></div>
                <h1>PROSEDUR PEMINJAMAN</h1>
                <p>Berikut Prosedur Peminjaman Alat Penelitian Antropometri Pada Lab. Bio-Paleoantropologi UGM</p>
            </div>
        </div>
        <div class="row features-block">

            <div class="col-lg-12">
                <div id="vertical-timeline" class="vertical-container light-timeline center-orientation">
                    <div class="vertical-timeline-block">
                        <div class="vertical-timeline-icon navy-bg">
                            <i class="fa fa-briefcase"></i>
                        </div>

                        <div class="vertical-timeline-content dim_about">
                            <div class="col-xs-12">
                                <div class="row">
                                    <div class="col-md-2">
                                        <span class="step-number">1</span> 
                                    </div>
                                    <div class="col-md-10">
                                        <h2 style="padding-top: 10px">Cari Alat</h2>
                                        <p>Sebelum melakukan penyewaan alat, terlebih dahulu Anda diwajibkan melakukan pengajuan pinjaman dengan cara berikut : </p>
                                        <a href="#modal_cari_alat" class="btn btn-xs btn-primary" data-toggle="modal"> Info Selengkapnya</a>
                                    </div>
                                     <span class="vertical-date"> Tomorrow <br/> <small>Dec 26</small> </span>
                                </div>
                            </div>
                        </div>
                    </div>

                     <div class="vertical-timeline-block">
                        <div class="vertical-timeline-icon navy-bg">
                            <i class="fa fa-briefcase"></i>
                        </div>

                        <div class="vertical-timeline-content dim_about">
                            <div class="col-xs-12">
                                <div class="row">
                                    <div class="col-md-2">
                                        <span class="step-number">2</span> 
                                    </div>
                                    <div class="col-md-10">
                                        <h2 style="padding-top: 10px">Pengajuan Peminjaman Alat</h2>
                                        <p>Review ringkasan peminjaman melalui keranjang peminjaman.</p>
                                        <a href="#modal_pengajuan" class="btn btn-xs btn-primary" data-toggle="modal"> Info Selengkapnya</a>
                                    </div>
                                     <span class="vertical-date"> Tomorrow <br/> <small>Dec 26</small> </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="vertical-timeline-block">
                        <div class="vertical-timeline-icon navy-bg">
                            <i class="fa fa-file-text"></i>
                        </div>

                        <div class="vertical-timeline-content dim_about">
                           <div class="col-xs-12">
                                <div class="row">
                                    <div class="col-md-2">
                                        <span class="step-number">3</span> 
                                    </div>
                                    <div class="col-md-10">
                                        <h2 style="padding-top: 10px">Konfirmasi Admin</h2>
                                        <p>Admin akan memberikan konfirmasi pengajuan pinjaman melalui notifikasi email</p>
                                        <a href="#modal_konfirm_alat" class="btn btn-xs btn-primary" data-toggle="modal"> Info Selengkapnya</a>
                                    </div>
                                     <span class="vertical-date"> Tomorrow <br/> <small>Dec 26</small> </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="vertical-timeline-block">
                        <div class="vertical-timeline-icon navy-bg">
                            <i class="fa fa-cogs"></i>
                        </div>

                        <div class="vertical-timeline-content dim_about">
                            <div class="col-xs-12">
                                <div class="row">
                                    <div class="col-md-2">
                                        <span class="step-number">4</span> 
                                    </div>
                                    <div class="col-md-10">
                                        <h2 style="padding-top: 10px">Pembayaran</h2>
                                        <p>Pembayaran dapat dilakukan melalui transfer via ATM, setor tunai bank, maupun sms bangking</p>
                                        <a href="#modal_pembayaran" class="btn btn-xs btn-primary" data-toggle="modal"> Info Selengkapnya</a>
                                    </div>
                                     <span class="vertical-date"> Tomorrow <br/> <small>Dec 26</small> </span>
                                </div>
                            </div>
                        </div>
                    </div>

                     <div class="vertical-timeline-block">
                        <div class="vertical-timeline-icon navy-bg">
                            <i class="fa fa-cogs"></i>
                        </div>

                        <div class="vertical-timeline-content dim_about">
                            <div class="col-xs-12">
                                <div class="row">
                                    <div class="col-md-2">
                                        <span class="step-number">5</span> 
                                    </div>
                                    <div class="col-md-10">
                                        <h2 style="padding-top: 10px">Pengambilan alat</h2>
                                        <p>Pengambilan alat dilakukan dengan membawa kwitansi yang anda cetak melalui sistem setelah Anda melakukan konfirmasi pembayaran</p>
                                        <a href="#modal_pengambilan" class="btn btn-xs btn-primary" data-toggle="modal"> Info Selengkapnya</a>
                                    </div>
                                     <span class="vertical-date"> Tomorrow <br/> <small>Dec 26</small> </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="vertical-timeline-block">
                        <div class="vertical-timeline-icon navy-bg">
                            <i class="fa fa-cogs"></i>
                        </div>

                        <div class="vertical-timeline-content dim_about">
                            <div class="col-xs-12">
                                <div class="row">
                                    <div class="col-md-2">
                                        <span class="step-number">6</span> 
                                    </div>
                                    <div class="col-md-10">
                                        <h2 style="padding-top: 10px">Pengembalian Alat</h2>
                                        <li>Pengembalian dilakukan sesuai dengan jadwal tanggal kembali pada saat pengajuan</li>
                                        <li>Pengembalian alat yang melebihi tanggal jatuh tempo akan dikenakan denda.</li>
                                        <a href="#modal_pengembalian" class="btn btn-xs btn-primary" data-toggle="modal"> Info Selengkapnya</a>
                                    </div>
                                     <span class="vertical-date"> Tomorrow <br/> <small>Dec 26</small> </span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
    <section id="instrumen" class="pricing">
    <div class="container">
        <div class="row">
            <?php $query = mysql_query("SELECT * from ref_instrument  order by instrument_id ASC");
                                        while ($row = mysql_fetch_array($query)) {
                                                $var_gambar     = "menejemen/image/".$row['instrument_picture'];?>

            <div class="col-lg-4  wow fadeInRight" style="margin-top: 50px;" style="width:200px;">
                <ul class="pricing-plan list-unstyled selected dim_about">
                    <li class="pricing-title">
                        <h4><span class=""></span> <?php echo $row['instrument_name']; ?></h4>
                    </li>
                    <li class="pricing-desc">
                        <img src="<?php echo $var_gambar; ?>" class='img-responsive dim_about' style='width: 268px; height: 179px;'>
                    </li>
                    <li class="pricing-price">
                        <span>Harga : Rp. <?php echo $row['instrument_fee']; ?></span>
                    </li>
                    <li>
                        <span>Merk : <?php echo $row['instrument_brand']; ?></span>
                    </li>
                    <li>
                        <span>Jumlah : <?php echo $row['instrument_quantity']; ?></span>
                    </li>
                    <li>
                        <span class="dim_about">
                            <?php 
                                    $jumlah = $row['instrument_quantity'];
                                    if ($jumlah > 0) {
                                        echo " <a href='#' class='btn btn-warning btn-sm'><span class='fa fa-check'></span> Tersedia</a>";
                                    }else{
                                        echo " <a href='#' class='btn btn-warning btn-sm'><span class='fa fa-times'></span> Tidak Tersedia</a>";
                                    }
                                 ?>
                        </span>
                    </li>
                    <li>
                         <a href='#myModal' class='btn btn-primary btn-xs dim_about' id='custId' data-toggle='modal' data-id="<?php echo $row['instrument_id']; ?>"><span class="fa fa-eye"></span> DETAIL ALAT</a>
                    </li>

                </ul>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
    <section  class="container features" id="layanan">
    <div class="row">
        <div class="col-lg-12 text-center">
            <div class="navy-line"></div>
            <h1>Profil Laboratorium Bioantropologi dan Paleoantropologi<br/> <span class="navy"> Universitas Gadjah Mada</span> </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 text-center wow fadeInLeft">
            <div>
                <center><div class="icon"><i style="color:white; padding-top:18px; " class="fa fa-user-plus features-icon"></i></div></center>
                
                <h2>Registrasi Member</h2>
                <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus.</p>
            </div>
            <div class="m-t-lg">
                <center><div class="icon"><i style="color:white; padding-top:18px; " class="fa fa-shopping-cart features-icon"></i></div></center>
                <h2>Penyewaan</h2>
                <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus.</p>
            </div>
        </div>
        <br/><br/><br/></br>
        <div class="col-md-6 text-center  wow zoomIn">
            <img src="img/landing/DSC_0010.jpg" alt="dashboard" class="img-responsive">
        </div>
        <div class="col-md-3 text-center wow fadeInRight">
            <div>
<center id='layanan'>
    <div class="icon"><i style="color:white; padding-top:18px; " class="fa fa-gear features-icon"></i></div>
</center>
                <h2>Fasilitas LBP - UGM</h2>
                <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus.</p>
</div>
    <div class="m-t-lg">
        <center><div class="icon"><i style="color:white; padding-top:18px; " class="fa fa-tags features-icon"></i></div></center>
        <h2>Diskon Penyewaan</h2>
        <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus.</p>
        </div>
    </div>
</div>
</section>
<!-- registrasi & login -->

<?php 
        // jika sudah login halaman ini tidak akan tampil 
        if (isset($_SESSION['member_name'])) {?>
        
 <?php }else{ ?>
<section id="daftar" class="navy-section testimonials dim_about" style="background-color: #00CED1;">

    <div class="container">

        <div class="row">
            <div class="col-lg-12 text-center wow zoomIn">
                <i class=""></i>
                <h1>
                    
                </h1>
                <div class="testimonials-text" style="font-size:20px; ">
                    <br/>
                    <strong>
                    SELAMAT DATANG DI WEBSITE LAB. BIO- & PALEOANTROPOLOGI <br/>
                    FAKULTAS KEDOKTERAN<br/>
                    UNIVERSITAS GADJAH MADA 
                    </strong>
                </div>
                <small>
                    <strong style="font-size: 30px;">LBP - UGM</strong>
                </small>
                <h2>
                    <center>
                        <a href="#" data-toggle="modal" data-target="#login" class="btn btn-primary dim_about"><span class="fa fa-sign-in"></span> LOGIN</a>
                        <a href="#" data-toggle="modal" data-target="#registrasi" class="btn btn-primary dim_about"><span class="fa fa-user-plus"></span> DAFTAR</a>
                    </center>
                </h2>
            </div>
        </div>

    </div>
</section>
 <?php } ?>
<!-- contact LBP UGM -->
<?php include 'modal-prosedur.php'; ?>

