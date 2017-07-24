<?php 
        $idMemberLogin  = $_SESSION['member_id'];
        $query = "SELECT member_id,member_name,member_institution,member_faculty,category_name,category_id FROM tbl_member JOIN ref_category ON tbl_member.category_id_fk = ref_category.category_id where tbl_member.member_id='".$idMemberLogin."'";
                    
        $identitasMember = mysql_fetch_array(mysql_query($query));
 ?>
      <br/>
        <div class="row">
          <div class="col-md-12"> 
       <?php 
            // Notifikasi peminjaman setelah login
              $queryPeringatan = mysql_query("SELECT loan_status, loan_invoice, loan_app_id, member_name from trx_loan_application join tbl_member on trx_loan_application.member_id_fk=tbl_member.member_id where member_id_fk='".$_SESSION['member_id']."' order by loan_app_id DESC  limit 1");
              //$rowWarning_noValid = mysql_fetch_array($queryPeringatan);
            while ($rowPeringatan = mysql_fetch_array($queryPeringatan)) {
                 $statusKonfirmasi = $rowPeringatan['loan_status'];
                 $idPeminjaman = $rowPeringatan['loan_app_id'];
                 

                 if ($statusKonfirmasi == 'MENUNGGU') {
                   echo "<div class='alert alert-success alert-dismissable dim_about yellow-bg' style='border-color: #f8ac59; color: white;'>
                        <button aria-hidden='true' data-dismiss='alert' class='close' type='button' style='color: white;'>×</button>
                      <span class='fa fa-bookmark'></span> <b>STATUS PEMINJAMAN ALAT</b></br>
                          Hi ".$rowPeringatan['member_name'].", status pengajuan peminjaman alat penelitian dengan No Invoice ".$rowPeringatan['loan_invoice']." adalah <b>: Menunggu Konfirmasi dari Koordinator Penelitian.</b> <br><b><a href='index.php?hal=pengajuan-member/pengajuan-alat'>Lihat Data Selengkapnya</a></b>
                      </div> ";
                 } else if ($statusKonfirmasi == 'MENUNGGU ACC FINAL') {
                      echo " <div class='alert alert-success alert-dismissable dim_about navy-bg' style='border-color: #f8ac59; color: white;'>
                              <button aria-hidden='true' data-dismiss='alert' class='close' type='button' style='color: white;'>×</button>
                                <span class='fa fa-bookmark'></span> <b>STATUS PEMINJAMAN ALAT</b></br>
                                Hi ".$rowPeringatan['member_name'].", status pengajuan peminjaman alat penelitian dengan No Invoice ".$rowPeringatan['loan_invoice']." adalah <b> : Menunggu ACC Final</b> <br/>Pengajuan Anda telah dikonfirmasi oleh Koordinator Penelitian, proses selanjutnya adalah menunggu persetujuan akhir dari Kepala Laboratorium. <b><a href='index.php?hal=pengajuan-member/pengajuan-alat'>Lihat Data Selengkapnya</a></b> 
                             </div>";
                  } elseif ($statusKonfirmasi == 'DIBATALKAN') {
                        echo "<div class='alert alert-success alert-dismissable dim_about red-bg' style='border-color: #f8ac59; color: white;'>
                          <button aria-hidden='true' data-dismiss='alert' class='close' type='button' style='color: white;'>×</button>
                            <span class='fa fa-bookmark'></span> <b>STATUS PEMINJAMAN ALAT</b></br> 
                            Hi ".$rowPeringatan['member_name'].", pengajuan peminjaman alat dengan No Invoice ".$rowPeringatan['loan_invoice']." telah Anda batalkan. Untuk dapat melakukan peminjaman silahkan melakukan pengajuan ulang. 
                         </div>";
                  } elseif ($statusKonfirmasi == 'ACC FINAL') {
                        echo " <div class='alert alert-success alert-dismissable dim_about navy-bg' style='border-color: #f8ac59; color: white;'>
                              <button aria-hidden='true' data-dismiss='alert' class='close' type='button' style='color: white;'>×</button>
                                <span class='fa fa-bookmark'></span> <b>STATUS PEMINJAMAN ALAT</b></br>
                                Hi ".$rowPeringatan['member_name'].", status pengajuan peminjaman alat penelitian dengan No Invoice ".$rowPeringatan['loan_invoice']." adalah <b>: ACC FINAL</b> <br/>Pengajuan Anda telah disetujui oleh Kepala Laboratorium. Silahkan melakukan pembayaran dan konfirmasi pembayaran dalam waktu 3 jam setelah pengajuan Anda disetujui. Apabila dalam waktu tempo yang diberikan Anda belum melakukan konfirmasi pembayaran maka pengajuan peminjaman alat Anda dibatalkan secara otomatis. <b><a href='index.php?hal=pengajuan-member/pengajuan-alat'>Lihat Data Selengkapnya</a></b> 
                             </div>";
                    } elseif ($statusKonfirmasi == 'MEMBAYAR TAGIHAN') {
                          echo "<div class='alert alert-success alert-dismissable dim_about lazur-bg' style='border-color: #f8ac59; color: white;'>
                               <button aria-hidden='true' data-dismiss='alert' class='close' type='button' style='color: white;'>×</button>
                                  <span class='fa fa-bookmark'></span> <b>KETERANGAN PEMBAYARAN</b></br>
                                Hi ".$rowPeringatan['member_name'].", data pembayaran peminjaman alat penelitian dengan No Invoice ".$rowPeringatan['loan_invoice']." telah terkirim. <br/>Mohon tunggu verifikasi pembayaran dari kami. Pembayaran yang sudah diverifikasi akan mengarahkan Anda menuju langkah selanjutnya. 
                                </div> ";
                        $pembayaran = mysql_query("SELECT payment_valid, payment_notif from trx_payment where loan_app_id_fk ='".$idPeminjaman."' AND member_id_fk ='".$_SESSION['member_id']."' ");
                        $run_pembayaran = mysql_fetch_array($pembayaran);
                        $keterangan = $run_pembayaran['payment_valid'];
                        if ($keterangan == 'VALID') {
                          echo "<div class='alert alert-success alert-dismissable dim_about lazur-bg' style='border-color: #f8ac59; color: white;'>
                               <button aria-hidden='true' data-dismiss='alert' class='close' type='button' style='color: white;'>×</button>
                                  <span class='fa fa-bookmark'></span> <b>STATUS PEMBAYARAN</b></br>
                                Hi ".$rowPeringatan['member_name'].", status pembayaran peminjaman alat penelitian dengan No Invoice ".$rowPeringatan['loan_invoice']." adalah <b>: VALID</b> <br/>Silahkan cetak invoice untuk melakukan pengambilan alat.<b><a href='index.php?hal=pengajuan-member/pengajuan-alat'> Lihat Data Selengkapnya</a></b> 
                                </div> ";
                        } elseif ($keterangan == 'TIDAK VALID'){
                            echo "<div class='alert alert-success alert-dismissable dim_about lazur-bg' style='border-color: #f8ac59; color: white;'>
                               <button aria-hidden='true' data-dismiss='alert' class='close' type='button' style='color: white;'>×</button>
                                  <span class='fa fa-bookmark'></span> <b>STATUS PEMBAYARAN</b></br>
                                Hi ".$rowPeringatan['member_name'].", status pembayaran peminjaman alat penelitian dengan No Invoice ".$rowPeringatan['loan_invoice']." adalah <b>: TIDAK VALID</b> <br/>Keterangan Tidak Valid : <b>".$run_pembayaran['payment_notif']."</b><br/>Pembayaran yang dinyatakan tidak valid tidak bisa melanjutkan proses selanjutnya. Silahkan melakukan pembayaran kekurangan dan konfirmasi ulang.<b><a href='index.php?hal=pengajuan-member/pengajuan-alat'> Lihat Data Selengkapnya</a></b> 
                                </div> ";
                        } else{

                        }
                    } elseif ($statusKonfirmasi == 'DIPINJAM') {
                        echo "<div class='alert alert-success alert-dismissable dim_about lazur-bg' style='border-color: #f8ac59; color: white;'>
                               <button aria-hidden='true' data-dismiss='alert' class='close' type='button' style='color: white;'>×</button>
                                  <span class='fa fa-bookmark'></span> <b>STATUS PEMINJAMAN</b></br>
                                Hi ".$rowPeringatan['member_name'].", status peminjaman alat penelitian dengan No Invoice ".$rowPeringatan['loan_invoice']." adalah : <b>Sedang Dipinjam</b> <br/>Mohon melakukan pengembalian alat tepat pada waktunya untuk menghindari denda.<a href='index.php?hal=pengajuan-member/pengajuan-alat'> Lihat Data Selengkapnya</a></b> 
                                </div> ";
                    } elseif ($statusKonfirmasi == 'DIKEMBALIKAN') {
                         echo "<div class='alert alert-success alert-dismissable dim_about navy-bg' style='border-color: #f8ac59; color: white;'>
                               <button aria-hidden='true' data-dismiss='alert' class='close' type='button' style='color: white;'>×</button>
                                  <span class='fa fa-bookmark'></span> <b>STATUS PEMINJAMAN</b></br>
                                Hi ".$rowPeringatan['member_name'].", status peminjaman alat penelitian dengan No Invoice ".$rowPeringatan['loan_invoice']." adalah : <b>Sudah Dikembalikan</b> <br/> Transaksi peminjaman Anda telah selesai.<a href='index.php?hal=pengajuan-member/pengajuan-alat'> Lihat Data Selengkapnya</a></b> 
                                </div> ";
                    }
                    elseif ($statusKonfirmasi == 'DITOLAK') {
                        echo "<div class='alert alert-success alert-dismissable dim_about red-bg' style='border-color: #f8ac59; color: white;'>
                          <button aria-hidden='true' data-dismiss='alert' class='close' type='button' style='color: white;'>×</button>
                            <span class='fa fa-check'></span> <b>STATUS PENGAJUAN ALAT :</b></br> 
                            Hi ".$rowPeringatan['member_name'].", mohon maaf pengajuan peminjaman alat penelitian dengan  NO INVOICE ".$rowPeringatan['loan_invoice']." untuk saat ini tidak dapat kami setujui karena adanya kendala teknis pada alat di Laboratorium. 
                         </div>";
                    } else if($statusKonfirmasi != 'ACC FINAL' && $statusKonfirmasi != 'DITOLAK' && $statusKonfirmasi != 'MENUNGGU' && $statusKonfirmasi != 'MENUNGGU ACC FINAL' && $statusKonfirmasi != 'DIBATALKAN' && $statusKonfirmasi != 'MEMBAYAR TAGIHAN' && $statusKonfirmasi != 'DIPINJAM' && $statusKonfirmasi != 'DIKEMBALIKAN'){
                        echo "<div class='alert alert-success alert-dismissable dim_about lazur-bg' style='border-color: #f8ac59; color: white;'>
                          <button aria-hidden='true' data-dismiss='alert' class='close' type='button' style='color: white;'>×</button>
                            <span class=''></span> Selamat Datang Di Website Peminjaman Alat Penelitian Antropologi Laboratorium Bio- & Paleoantropologi UGM
                         </div> ";
                    }
             ?>
        <?php } ?> 
        <!-- peringatan pembayaran -->
        <?php 
            $queryPeringatanPembayaran  = mysql_query("SELECT payment_valid, payment_notif, loan_app_id_fk from trx_payment where member_id_fk = '".$_SESSION['member_id']."' AND loan_app_id_fk = '".$rowPeringatan['loan_app_id']."'");
            $runperingatanpembayaran = mysql_fetch_array($queryPeringatanPembayaran);
            $valid = $runperingatanpembayaran['payment_valid'];

            
            if ($valid == 'VALID') {
              if ($rowPeringatan['loan_status']=='DIPINJAM') {
                }else{
                  echo " <div class='alert alert-success alert-dismissable dim_about yellow-bg' style='border-color: #f8ac59; color: white;'>
                              <button aria-hidden='true' data-dismiss='alert' class='close' type='button' style='color: white;'>×</button>
                                <span class='fa fa-check'></span> <b>STATUS PENGAJUAN ALAT:</b></br>
                                Hi ".$rowPeringatan['member_name'].", Pembayaran anda VALID silahkan lakukan pengambilan alat </br>
                             </div>";
                }
              
             }elseif ($valid == 'TIDAK VALID') {
                  echo " <div class='alert alert-success alert-dismissable dim_about yellow-bg' style='border-color: #f8ac59; color: white;'>
                              <button aria-hidden='true' data-dismiss='alert' class='close' type='button' style='color: white;'>×</button>
                                <span class='fa fa-check'></span> <b>STATUS PENGAJUAN ALAT:</b></br>
                                Hi ".$rowPeringatan['member_name'].", Pembayaran anda TIDAK VALID dan ".$runperingatanpembayaran['payment_notif']." INVOICE : ".$rowWarning_noValid['loan_invoice']."silahkan lakukan Cek Pembayaran Anda </br>
                             </div>";
             } 
         ?>
       </div>
        </div>
<div class="row  border-bottom navy-bg dashboard-header">
           <div class="col-md-6">
                <div class="profile-image">
                    <img src="../img/user.png" class="img-circle circle-border m-b-md dim_about" alt="profile">
                </div>
                <div class="profile-info">
                    <div class="">
                        <div>
                            <h2 class="no-margins">
                                <?php echo $identitasMember['member_name']; ?>
                            </h2>
                           
                            <small>
                               <b> Kategori Member : <?php echo $identitasMember['category_name']; ?><br/>
                               Fakultas / Bidang : <?php echo $identitasMember['member_faculty']; ?><br/>
                                Instansi : <?php echo $identitasMember['member_institution']; ?></b>
                            </small>
                        </div>
                    </div>
                </div>
             </div>
             <div class="col-md-6">
                 <p align="right"> <img src="../img/logo-ugm.png" class="img-responsive " style="border-radius:50px 1px 1px 1px; "></p>
             </div> 
       <div class="row">
            <div class="col-sm-12">
            <div class="row text-left">
               <div class="col-lg-3 ">
                <div class="widget style1 lazur-bg dim_about">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-cloud fa-5x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <span> Data Transaksi</span>
                            <h3 class="font-bold">PEMINJAMAN</h3>
                            <br>
                            <a href="" class="btn btn-xs btn-primary" > lihat data <span class="fa fa-arrow-right"></span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="widget style1 yellow-bg dim_about">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-cloud fa-5x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <span> Data Rekap </span>

                            <h3 class="font-bold">PEMBAYARAN</h3>
                            <br>
                            <a href="" class="btn btn-xs btn-info" > lihat data <span class="fa fa-arrow-right"></span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="widget style1 lazur-bg dim_about">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-cloud fa-5x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <span> Informasi Data </span>

                            <h3 class="font-bold">SALDO</h3>
                            <br>
                            <a href="" class="btn btn-xs btn-primary" > lihat data <span class="fa fa-arrow-right"></span></a>
                        </div>
                    </div>
                </div>
            </div>
             <div class="col-lg-3">
                <div class="widget style1 yellow-bg dim_about">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-cloud fa-5x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <span>Data Transaksi  </span>

                            <h3 class="font-bold">PENGEMBALIAN</h3>
                            <br>
                            <a href="" class="btn btn-xs btn-info" > lihat data <span class="fa fa-arrow-right"></span></a>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
       </div>
</div>
<div class="row" style="padding-top: 10px;">
    <div class="col-md-12">
      
       <?php  
                $query_profilmember= mysql_query("SELECT * from tbl_member where member_id = '".$_SESSION['member_id']."'");
                  $peringatan_lengkapi_identitas = mysql_fetch_array($query_profilmember);
                     $member_birth_date_cek          = $peringatan_lengkapi_identitas['member_birth_date'];
                     $member_gender_cek              = $peringatan_lengkapi_identitas['member_gender'];
                     $member_phone_number_cek        = $peringatan_lengkapi_identitas['member_phone_number'];
                     $member_address_cek             = $peringatan_lengkapi_identitas['member_address'];
               
                  if ($member_birth_date_cek  != '' AND $member_gender_cek  != '' AND 
                        $member_phone_number_cek !='' AND $member_address_cek  != '') {
                         echo "
                                  <div class='col-md-4'>
                                       <a href='index.php?hal=pengajuan-member/pengajuan' class='btn btn-danger btn-lg dim_about'><span class='fa fa-search'></span> DAFTAR KOLEKSI ALAT</a>
                                   </div>
                              ";
                          echo "<div class='col-md-8'>
                          <div class='alert alert-success alert-dismissable dim_about navy-bg' style='border-color: #f8ac59; color: white;'>
                              <button aria-hidden='true' data-dismiss='alert' class='close' type='button' style='color: white;'>×</button>
                                <span class='fa fa-check'></span>
                                SILAHKAN MELAKUKAN PENGAJUAN PEMINJAMAN ALAT
                                </b>
                             </div>
                        </div>";
                       }else{
                          echo "
                                  <div class='col-md-4'>
                                       <div class='panel-group'>
                                          <div class='panel panel-warning dim_about'>
                                            <div class='panel-heading'>
                                              <h4 class='panel-title'>
                                                <a data-toggle='collapse' href='#peringatan'>
                                                        <span class='fa fa-search'></span> DAFTAR KOLEKSI ALAT
                                                </a>
                                              </h4>
                                            </div>
                                            <div id='peringatan' class='panel-collapse collapse'>
                                              <div class='panel-body'>
                                                    <p>Silahkan Lengkapi Data Anda Terlebih Dahulu Sebelum Melakukan Pengajuan Alat Agar Data Pengajuan Anda Segera Di ACC Oleh Petugas Kami, </p><br>
                                                        Terima Kasih
                                              </div>
                                              <div class='panel-footer dim_about'><span class='fa fa-arrow-right'></span> <a href='index.php?hal=akun/profil'>LENGAKAPI IDENTITAS</a></div>
                                            </div>
                                          </div>
                                        </div>
                                   </div>
                              ";
                        echo "<div class='col-md-8'>
                          <div class='alert alert-danger alert-dismissable dim_about red-bg' style='border-color: #f8ac59; color: white;'>
                              <button aria-hidden='true' data-dismiss='alert' class='close' type='button' style='color: white;'>×</button>
                                <span class='fa fa-times'></span>
                               LENGKAPI DATA
                                </b>
                             </div>
                        </div>";
                       }                  

                
        ?>

    </div>
</div>