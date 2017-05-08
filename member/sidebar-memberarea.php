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
                                <li><a href="index.php?hal=akun/profil"><span class="fa fa-user"></span> Profil</a></li>
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
                        <a href="index.php?hal=pengajuan-member/pengajuan-alat"><i class="fa fa-file-o"></i> <span class="nav-label">PENGAJUAN</span>
                        <!-- peringatan Pengajuan -->
                        <?php include 'peringatan_pengajuan.php'; ?>
                        </a>
                    </li>
                    <li>
                        <a href="layouts.html"><i class="fa fa-file-o"></i> <span class="nav-label">PEMBAYARAN</span>
                        <span class="label label-warning pull-right"><span class="fa fa-exclamation-triangle"></span> 1 </span>

                        </a>
                         <ul class="nav nav-second-level collapse">
                            <li><a href="index.php?hal=pembayaran/rekap_pembayaran">REKAP PEMBAYARAN</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="index.php?hal=saldo/saldo"><i class="fa fa-share"></i> <span class="nav-label">SALDO</span>
                        </a>
                    </li>
                    <li>
                        <a href="index.php?logout=1"><i class="fa fa-sign-out"></i> <span class="nav-label">KELUAR</span></a>
                    </li>
                  
                </ul>

            </div>
        </nav>