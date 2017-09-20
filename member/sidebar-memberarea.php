<nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                            <?php 
                                    if ($_SESSION['member_photo']=='') {
                             ?>
                             <img alt="image" class="img-circle img-responsive" src="../img/user.png" style="width: 100px;" />
                             <?php }else{ ?>
                                <img alt="image" class="img-circle img-responsive dim_about" src="../img/<?php echo $_SESSION['member_photo']; ?>" style="width: 100px; height: 100px;" />
                             <?php } ?>
                             </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">
                            	<?php echo $_SESSION['member_name']; ?>
                            </strong>
                             </span> <span class="text-muted text-xs block">Akun <b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                
                                <li><a href="index.php?hal=akun/profil"><span class="fa fa-gear"></span> Pengaturan</a></li>
                                <li><a href="index.php?logout=1"><span class="fa fa-sign-out"></span> Keluar</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            LBP
                        </div>
                    </li>
                    <li>
                        <a href="index.php"><i class="fa fa-home"></i> <span class="nav-label">HOME</span></a>
                    </li>
                    <li>
                        <a href="index.php?hal=pengajuan-member/pengajuan-alat"><i class="fa fa-tags"></i> <span class="nav-label">PEMINJAMAN</span>
                        <!-- peringatan Pengajuan -->
                        <?php include 'peringatan_pengajuan.php'; ?>
                        </a>
                    </li>
                    <li>
                        <a href="layouts.html" ><i class="fa fa-tags"></i> <span class="nav-label">PEMBAYARAN</span>
                        <?php 
                            
                            $per_peminjaman_pembayaran_valid = mysql_fetch_array(mysql_query("SELECT count(*) as jumlah_peringatan_valid FROM trx_payment p join trx_loan_application l on p.loan_app_id_fk = l.loan_app_id where p.payment_valid = 'VALID' AND p.member_id_fk = '".$_SESSION['member_id']."' and l.loan_status='MEMBAYAR TAGIHAN'"));
                            $per_peminjaman_pembayaran_tidak_valid = mysql_fetch_array(mysql_query("SELECT count(*) as jumlah_peringatan_valid FROM trx_payment p join trx_loan_application l on p.loan_app_id_fk = l.loan_app_id where p.payment_valid = 'TIDAK VALID' AND p.member_id_fk = '".$_SESSION['member_id']."' and l.loan_status='MEMBAYAR TAGIHAN'"));
                            if ($per_peminjaman_pembayaran_valid['jumlah_peringatan_valid'] > 0) {
                                
                         ?>
                        <span class="label label-warning pull-right" data-toggle="tooltip" title="<?php echo $per_peminjaman_pembayaran_valid['jumlah_peringatan_valid']; ?> KONFIRMASI PEMBAYARAN VALID"><span class="fa fa-exclamation-triangle" ></span> <?php echo $per_peminjaman_pembayaran_valid['jumlah_peringatan_valid']; ?> </span>
                        <?php } ?>
                        <?php
                            if ($per_peminjaman_pembayaran_tidak_valid['jumlah_peringatan_valid'] > 0) {
                                
                         ?>
                        <span class="label label-warning pull-right" data-toggle="tooltip" title="<?php echo $per_peminjaman_pembayaran_tidak_valid['jumlah_peringatan_valid']; ?> KONFIRMASI PEMBAYARAN VALID"><span class="fa fa-exclamation-triangle" ></span> <?php echo $per_peminjaman_pembayaran_tidak_valid['jumlah_peringatan_valid']; ?> </span>
                        <?php } ?>
                        
                        </a>
                         <ul class="nav nav-second-level collapse">
                            <li><a href="index.php?hal=pembayaran/rekap_pembayaran">REKAP PEMBAYARAN</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="index.php?hal=saldo/saldo"><i class="fa fa-tags"></i> <span class="nav-label">SALDO</span>
                        </a>
                    </li>
                    <li>
                        <a href="index.php?logout=1"><i class="fa fa-sign-out"></i> <span class="nav-label">KELUAR</span></a>
                    </li>
                  
                </ul>

            </div>
        </nav>