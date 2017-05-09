
            <div id="content" style="height: auto;">
			<div class="container" style="padding-top:30px; ">
            <div class="row">
                  
            	<div class="col-md-12">
            		<div class="panel panel-success">
            			<div class="panel-heading  dim_about" style="background-color:#1ab394; border-color: #1ab394; ">
            				<img src="assets/img/logo-ugm.png" class="img-responsive" >
            				<br>
            				<p style="color:white;" align="center"> <b>Sistem Informasi Peminjaman Alat Penelitian Antropometri Laboratorium 
            					Bio- & Paleantropologi 
								Fakultas Kedokteran 
								Universitas Gadjah Mada <br/> 
                                </b></p>
            			</div>
            		</div>            
                        
                  </div> 
                  <div class="col-md-12">
<<<<<<< HEAD
                        <?php 
                            if ($_SESSION['level_name'] != 'admin' && $_SESSION['level_name'] != 'kepala laboratorium') {
                                
                         ?>
=======
                                
>>>>>>> c6aa247ab51f4f6635205760c75136c9852709de
                                    <div class="col-lg-3">
                                        <div class="widget style1 lazur-bg dim_about" style="background-color: #f8ac59;">
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <i class="fa fa-file-text fa-5x"></i>
                                                </div>
                                                <div class="col-xs-8 text-right">
                                                    
<<<<<<< HEAD
                                                    <h5 class="font-bold">TRANSAKSI PENGAJUAN</h5>
=======
                                                    <h5 class="font-bold">  TARNSAKSI PENGAJUAN </h5>
>>>>>>> c6aa247ab51f4f6635205760c75136c9852709de
                                                    <a href="index.php?hal=peminjaman/pengajuan/list" style="color: white;">Lihat Data <span class="fa fa-arrow-right"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
<<<<<<< HEAD

                                    <?php } ?>
                                    <?php 
                                        if ($_SESSION['level_name'] == 'admin' ||  $_SESSION['level_name'] == 'super admin') {
                                            
                                       
                                     ?>
=======
                                
                                    
>>>>>>> c6aa247ab51f4f6635205760c75136c9852709de
                                     <div class="col-lg-3">
                                        <div class="widget style1 lazur-bg dim_about">
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <i class="fa fa-calculator fa-5x"></i>
                                                </div>
                                                <div class="col-xs-8 text-right">
                                                    <h5>TRANSAKSI PEMBAYARAN </h5>
                                                    <a href="index.php?hal=pembayaran/list" style="color: white;">Lihat Data <span class="fa fa-arrow-right"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php  } ?>
                                    <?php 
                                        if ($_SESSION['level_name'] != 'kepala laboratorium') {
                                            
                                        
                                     ?>
                                     <div class="col-lg-3">
                                        <div class="widget style1 lazur-bg dim_about" >
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <i class="fa fa-mail-forward fa-5x"></i>
                                                </div>
                                                <div class="col-xs-8 text-right">
                                                      <h5>TRANSAKSI PENGEMBALIAN </h5>
                                                    <a href="index.php?hal=pengembalian/list" style="color: white;">Lihat Data <span class="fa fa-arrow-right"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-lg-3">
                                        <div class="widget style1 lazur-bg dim_about" style="background-color: #ed5565;">
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <i class="fa fa-users fa-5x"></i>
                                                </div>
                                               <div class="col-xs-8 text-right">
                                                      <h5>INFORMASI DATA MEMBER </h5>
                                                    <a href="index.php?hal=member/list" style="color: white;">Lihat Data <span class="fa fa-arrow-right"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } else {?>
                                    <div class="col-lg-3">
                                        <div class="widget style1 lazur-bg dim_about">
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <i class="fa fa-users fa-5x"></i>
                                                </div>
                                               <div class="col-xs-8 text-right">
                                                      <h5>PENGAJUAN FINAL </h5>
                                                    <a href="index.php?hal=peminjaman/pengajuan/list" style="color: white;">Lihat Data <span class="fa fa-arrow-right"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                        
                  </div>    
                  
            </div>
            </div>
		</div>