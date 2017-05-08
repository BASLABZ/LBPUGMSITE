<?php 
        if (isset($_POST['pinjam'])) {
            $cek = $_POST['cek'];
            if ($cek != '' ) {
                foreach ($cek as $key => $value) {
                if (!empty($value)) {
                    $query  = mysql_query("INSERT into trx_loan_temp(instrument_id_fk, member_id_fk) values ('".$value."','".$_SESSION['member_id']."')");
                }
            }
            if ($query) { echo "<script>location.href='index.php?hal=pengajuan-member/keranjang';</script>  ";exit;   }
            }else{
                echo "<script>alert('Silahkan Pilih Alat Terlebih Dahulu'); location.href='index.php?hal=pengajuan-member/pengajuan';</script>  ";exit;
            }
        }
        include 'style-bas-table.php';

 ?>
 <?php  
    $query_profilmember= mysql_query("SELECT * from tbl_member where member_id = '".$_SESSION['member_id']."'");
      $peringatan_lengkapi_identitas = mysql_fetch_array($query_profilmember);
         $member_birth_date_cek          = $peringatan_lengkapi_identitas['member_birth_date'];
         $member_gender_cek              = $peringatan_lengkapi_identitas['member_gender'];
         $member_phone_number_cek        = $peringatan_lengkapi_identitas['member_phone_number'];
         $member_address_cek             = $peringatan_lengkapi_identitas['member_address'];

      if ($member_birth_date_cek  != '' AND $member_gender_cek  != '' AND 
            $member_phone_number_cek !='' AND $member_address_cek  != '') {
            ?>
<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>INSTRUMENT</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index-2.html">Home</a>
                        </li>
                        <li>
                            <a>PENGAJUAN</a>
                        </li>
                        <li class="active">
                            <strong>INSTRUMENT</strong>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="wrapper wrapper-content">
            <div class="row animated fadeInRight">
                <div class="row">
                   <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title dim_about" style="background-color: #1ab394; border-color: #1ab394; color: white;">
                        <h5><span class="fa fa-list"></span> INSTRUMENT LBP UGM</h5>
                        <div class="ibox-tools" >
                            <a class="fullscreen-link">
                                <i class="fa fa-expand fa-3x"style="color: white;"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content dim_about">
                        <div class="row">
                            
                            <div class="col-md-8 well">
                                <div class="col-md-2"><p align="right" style="padding-top: 5px;">CARI ALAT</p></div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" placeholder="CARI ALAT">
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-info"><span class="fa fa-search"></span></button>
                                </div>

                            </div>
                            <div class="col-md-2">
                                 <br>
                                 <?php  
                                        $queryCekKeranjang  = mysql_query("SELECT count(member_id_fk) as jumlah FROM trx_loan_temp where member_id_fk='".$_SESSION['member_id']."'");
                                             $rowcekkeranjang = mysql_fetch_array($queryCekKeranjang);
                                             $cekJumlah = $rowcekkeranjang['jumlah'];
                                             if ($cekJumlah == 0) {
                                                 
                                             }else{
                                                 echo "<a href='index.php?hal=pengajuan-member/keranjang' class='btn btn-primary btn-lg dim_about'> <span class='fa fa-shopping-cart'></span> Kembali Keranjang</a>";
                                             }
                                  ?>
                            </div>
                        </div>
                         <form method="POST">
                             <table  id="myTable" class="table table-fixedheader table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th width="5%">AKSI</th>
                                        <th width="5%">NO</th>
                                        <th width="20%">Gambar</th>
                                        <th width="20%">NAMA ALAT</th>
                                        <th width="8%">JUMLAH</th>
                                        <th width="8%">DIPINJAM</th>
                                        <th width="8%">TERSEDIA</th>
                                        <th width="10%"><center>HARGA SEWA</center></th>
                                        <th width="10%">AKSI</th>    
                                    </tr> 
                                </thead>
                                <tbody>
                                    <?php 
                                            $queryI = mysql_query("SELECT instrument_id,instrument_name,instrument_quantity,intrument_quantity_temp,instrument_fee,instrument_picture FROM ref_instrument");
                                            
                                            while ($rowI = mysql_fetch_array($queryI)) {
                                            $var_gambar     = "../menejemen/image/".$rowI['instrument_picture'];
                                     ?>
                                        <tr>
                                            <td width="5%">
                                                <?php 
                                                $jumlah = $rowI['instrument_quantity'];
                                                $temp = $rowI['intrument_quantity_temp'];
                                                $cekDisable  = $jumlah-$temp;
                                                // $queryKeranjang = mysql_query("SELECT instrument_id_fk  from trx_loan_temp where member_id_fk = '".$_SESSION['member_id']."'");
                                                // while ($rowKeranang = mysql_fetch_array($queryKeranjang)) {
                                                //     $kodeinstrument = $rowKeranang['instrument_id_fk'];
                                                //     if ($rowI['instrument_id']==$kodeinstrument) {
                                                //     echo "<input type='checkbox'  
                                                //         value='".$rowI['instrument_id']."' name='cek[]' checked>";
                                                // }
                                                if ($jumlah == $temp) {
                                                    echo "<input type='checkbox'  
                                                        value='".$rowI['instrument_id']."' name='cek[]' disabled>";
                                                }
                                                else{
                                                    echo "<input type='checkbox'  
                                                        value='".$rowI['instrument_id']."' name='cek[]'>";    
                                                }
                                                

                                                
                                          ?>
                                            </td>
                                            <td width="5%"><?php echo ++$no; ?></td>
                                            <td width="20%"><img style="width:130px; height:150px;" src="<?php echo $var_gambar; ?>"></td>
                                            <td width="20%"><?php echo $rowI['instrument_name']; ?></td>
                                            <td width="8%"><center><h3><?php echo $rowI['instrument_quantity']; ?></h3></center></td>
                                            <td width="8%">
                                            <?php
                                                
                                                $queryBook = mysql_query("SELECT * FROM trx_loan_application_detail d 
                                                                        JOIN trx_loan_application p 
                                                                        ON d.loan_app_id_fk = p.loan_app_id 
                                                                        JOIN tbl_member m 
                                                                        on p.member_id_fk = m.member_id
                                                                        JOIN ref_category c 
                                                                        ON m.category_id_fk = c.category_id
                                                                        JOIN ref_instrument i 
                                                                        ON d.instrument_id_fk = i.instrument_id
                                                                        WHERE d.loan_status_detail = 'ACC' and d.instrument_id_fk='".$rowI['instrument_id']."'
                                                                        ");
                                                
                                            while ($runBooking = mysql_fetch_array($queryBook)) {
                                                 $idIN = $runBooking['instrument_id_fk'];
                                                    echo "
                                                        <button type='button' data-toggle='tooltip' title='".$runBooking['member_faculty']."' class='btn btn-success btn-xs dim_about'>
                                                            <span class='fa fa-user'></span>
                                                        <label>
                                                            ".$runBooking['member_institution']."
                                                        </label>
                                                        </button>
                                                        <br>
                                                        <br>
                                                    ";
                                            }
                                             ?>
                                            </td>
                                            <td width="8%">
                                                <?php 
                                                        $total_stok         = $rowI['instrument_quantity'];
                                                        $temp_instrument    = $rowI['intrument_quantity_temp'];
                                                        $stokTersedia       = $total_stok-$temp_instrument;
                                                        if ($stokTersedia != 0) {
                                                            echo "<h3>".$stokTersedia."</h3>";
                                                        }else{
                                                            echo "<button class='btn btn-warning btn-xs'>STOK <br>KOSONG</button>";
                                                        }
                                                 ?>
                                            </td>
                                            <td width="10%">Rp.<?php echo rupiah($rowI['instrument_fee']); ?></td>
                                            <td width="10%">
                                                <a href='#myModal' class='btn btn-info btn-sm dim_about' id='custId' data-toggle='modal' data-id="<?php echo $rowI['instrument_id']; ?>"><span class='fa fa-eye'></span> Detail</a>
                                            </td> 
                                        </tr>   
                                    <?php } ?>
                                </tbody>
                                </table>
                            <div class="form-group">
                                <button type="submit" name="pinjam" class="btn btn-info pull-right dim_about"> <span class="fa fa-shopping-cart"></span> Pinjam Alat</button>
                                <br>
                            </div>
                      </form>
                    </div>
                </div>
            </div>
                </div>
            </div>

            </div>
        </div>

    </div>
</div>
</div>

 <!-- modal load data detail instrument -->
    <div class="modal fade" id="myModal" role="dialog" >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #1ab394; color:white;">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><span class="fa fa-flask"></span> Detail Instrument</h4>
                    </div>
                    <div class="modal-body">
                        <div class="fetched-data"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger dim_about" data-dismiss="modal"><span class="fa fa-times"></span> Keluar</button>
                    </div>
                </div>
            </div>
    </div>
          

            <?php
           }else{
              echo "<script> alert('Lengkapi Data Anda Terlebih Dahulu'); location.href='index.php?hal=akun/profil';</script>  ";exit;
              }
?>
 
