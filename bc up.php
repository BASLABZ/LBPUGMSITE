
<?php 
        if (isset($_POST['pinjam'])) {
            $cek = $_POST['cek'];
            foreach ($cek as $key => $value) {
                if (!empty($value)) {
                    $query  = mysql_query("INSERT into trx_loan_temp(instrument_id_fk, member_id_fk) values ('".$value."','".$_SESSION['member_id']."')");
                }
            }
            if ($query) { echo "<script>location.href='index.php?hal=members/peminjaman/keranjang';</script>  ";exit;   }
        }
 ?>
 
<section class="features dim_about" style="background-color:#1ab394;">
    <div class="container" style="padding-top: 18px;">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="navy-line"></div>
                <h1 style="color:white; "><span class="fa fa-file"></span> Pengajuan Peralatan BIO-PALEONTROPOLOGI - UGM</h1>
                
            </div>
        </div>
    </div>
</section>
<section  class="container features">
	<div class="row">
        <div class="col-lg-12 text-center">
            <div class="navy-line"></div>
            <h1><i>Selamat Datang : </i> <?php echo $_SESSION['member_name']; ?></h1>
            <p><i>Informasi Data Instrument yang anda sewa, sebelum melakukan transaksi silahkan baca terlebih dahulu prosedur penyewaan alat/instrument </i></p>
        </div>
    </div>
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
                         <form method="POST">
                             <table class="table table-striped table-bordered table-hover table-responsive table-fixed" id="instrument" >
                    <thead>
                        <tr>
                            <th width="30px">AKSI</th>
                            <th width="30px">NO</th>
                            <th width="10%">Gambar</th>
                            <th width="10%">NAMA ALAT</th>
                            <th width="6%">JUMLAH</th>
                            <th width="6%">DIPINJAM</th>
                            <th width="6%">TERSEDIA</th>
                            <th width="10%"><center>HARGA SEWA</center></th>
                            <th width="10%">STATUS</th>
                            
                        </tr> 
                    </thead>
                    <tbody>
                    <?php 
                        $no = 1;
                        $query = mysql_query("SELECT * from ref_instrument order by instrument_id DESC");
                        $array = array();
                        while ($row = mysql_fetch_array($query)) {
                                $id = $row['instrument_id'];
                                $var_gambar     = "menejemen/image/".$row['instrument_picture'];
                                // $x = "SELECT d.loan_amount,i.instrument_name from trx_loan_application_detail  d join ref_instrument i on d.instrument_id_fk = i.instrument_id  join trx_loan_application t d.loan_app_id_fk = t.loan_app_id  where i.instrument_id = '".$id."'";
                                // print_r($x);
                                // $queryLoaditem  = mysql_query("SELECT d.loan_amount,i.instrument_name from trx_loan_application_detail  d join ref_instrument i on d.instrument_id_fk = i.instrument_id join trx_loan_application t d.loan_app_id_fk = t.loan_app_id JOIN tbl_member m ON t.member_id_fk = m.member_id where i.instrument_id = '".$id."'");
                                // while ($rowAfter  =  mysql_fetch_array($queryLoaditem)) {
                                $querYs = mysql_query("SELECT  * from trx_loan_application_detail t join trx_loan_application a ON t.loan_app_id_fk = a.loan_app_id join tbl_member m on a.member_id_fk = m.member_id JOIN ref_instrument r on t.instrument_id_fk = r.instrument_id");
                                while ($rowAfter = mysql_fetch_array($querYs)) {
                                      $kodeIns = $rowAfter['instrument_id_fk'];

                                      if ($id == $kodeIns) {
                     ?>

                        <tr>
                            <td width="30px">
                             <input type="checkbox" value="<?php echo $row['instrument_id']; ?>" name='cek[]'>
                           </td>
                            <td width="30px"><?php //echo $rowAfter['instrument_name']; ?><?php echo $no++; ?></td>
                            <td width="12%"><img style="width:130px; height:150px;" src="<?php echo $var_gambar; ?>" class="dim_about"></td>
                            <td width="12%"><?php echo $row['instrument_name']; ?></td>
                            <td width="6%"><?php echo $row['instrument_quantity']; ?></td>
                            <td width="6%">
                                  <?php echo $rowAfter['loan_amount']; ?> 
                                  <?php 
                                    echo "<button type='button'  class='btn btn-info btn-xs' data-toggle='collapse' data-target='#".$no."'>
                                    <span class='fa fa-users'></span>
                                  </button>    
                                  <div id='".$no."' class='collapse'>
                                        
                                        ".$rowAfter['member_institution']."
                                  </div>";
                                   ?>
                                
                            </td>
                            <td width="6%"><?php echo $row['instrument_quantity']; ?></td>
                            <td width="6%"><?php echo $row['instrument_fee']; ?></td>
                            <td width="10%">
                            <?php 
                                $jumlah = $row['instrument_quantity'];
                                if ($jumlah > 0) {
                                    echo " <a href='#' class='btn btn-success btn-sm dim_about'><span class='fa fa-check'></span> Tersedia</a>";
                                }else{
                                    echo " <a href='#' class='btn btn-success btn-sm dim_about'><span class='fa fa-times'></span> Tidak Tersedia</a>";
                                }
                             ?>
                             <a href='#myModal' class='btn btn-info btn-sm dim_about' id='custId' data-toggle='modal' data-id="<?php echo $row['instrument_id']; ?>"><span class='fa fa-eye'></span> Detail</a>
                           </td>
                        </tr>
                       <?php }
                        }
                       }?>
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
</section>
