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
<?php 
        if (isset($_GET['hapusitem'])) {
            $queryhapusitem = mysql_query("DELETE FROM trx_loan_temp where member_id_fk = '".$_SESSION['member_id']."' and instrument_id_fk ='".$_GET['hapusitem']."'");
        }
        $tahun     = date('Y');
        $subtahun  = substr($tahun, 2);
        $kode      = buatkode("trx_loan_application","");
        $invoice   = "".$kode."/INV/".$subtahun."";
               $lamapinjam = $_POST['totalbayarpenajuan'];
                $kodealat  = $_POST['instrument_id_fk'];
                $jumlahalat = $_POST['jumlah'];
                $subtotalpinjam = $_POST['subtotal'];
                $banyak        = count($kodealat);
                for ($i=0; $i < $banyak ; $i++) { 
                    $jumlahalatinstrument = $jumlahalat[$i];
                    $$totalFee   = ($subtotalpinjam + $totalFee)*$lamapinjam;
                    $total_loan = $jumlahalatinstrument+$total_loan;
                }
       
 ?>


<!-- keranjang table -->

 <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>KERANJANG</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index-2.html">Home</a>
            </li>
            <li>
                <a>PENGAJUAN</a>
            </li>
            <li class="active">
                <strong>KERANJANG</strong>
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
                  <h5><span class="fa fa-list"></span> KERANJANG PEMINJAMAN ALAT</h5>
                  <div class="ibox-tools" >
                      <a class="fullscreen-link">
                          <i class="fa fa-expand fa-3x"style="color: white;"></i>
                      </a>
                  </div>
              </div>
              <div class="ibox-content">
                  <p><label class="btn btn-info dim_about"><span class="fa fa-tags"></span> Kode Peminjaman : #<?php echo $invoice; ?></label>
                              <a href="index.php?hal=pengajuan-member/pengajuan" class="btn btn-warning btn-sm dim_about"><span class="fa fa-arrow-left"></span> Kembali Ke Instrument</a>
                           </p><br><br>
          
            <form class="role" method="POST" enctype="multipart/form-data" action="index.php?hal=pengajuan-member/proses_pengajuan">
                    <input name="idpeminjaman"  type="hidden" value="<?php echo $invoice; ?>">
            <table class="table table-bordered table-responsive table-hover" id="keranjang" >
            <thead>
              <th>NO</th>
                        <th>NAMA ALAT</th>
                        <th>JUMLAH</th>
                        <th><center>BIAYA SEWA</center></th>
                        <th>SUBTOTAL</th>
                        <th>AKSI</th>
            </thead>
            <tbody>
                <?php 
                            $no = 0;
                            $query = mysql_query("SELECT instrument_id_fk, instrument_name, instrument_quantity,intrument_quantity_temp , instrument_fee, count(instrument_id) AS jumlah FROM ref_instrument LEFT JOIN trx_loan_temp ON ref_instrument.instrument_id=trx_loan_temp.instrument_id_fk WHERE member_id_fk='".$_SESSION['member_id']."' GROUP BY instrument_id_fk");
                                $number = 1;
                            while ($row = mysql_fetch_array($query)) {
                                    $biaya = $row['instrument_fee'];
                                    $jumlah = $row['jumlah'];
                                    $subtotal = $number*$biaya;
                                    $totaljumlah = $totaljumlah+$jumlah;
                                    $totalbayar = $totalbayar+($biaya*$jumlah);
                                    $batasQuantity = $row['instrument_quantity']-$row['intrument_quantity_temp'];
                                    echo "$batasQuantity";
                                    echo $row['intrument_quantity_temp'];
                                    echo "<tr>
                                            <td >".++$no."</td>
                                            <td><input type='hidden' name='instrument_id_fk[]' value='".$row['instrument_id_fk']."' />".$row['instrument_name']."</td>
                                            <td><input type='number' id='jumlah".$no."' onchange='hitung(".$no.")' onkeyup='hitung(".$no.")' value='1' name='jumlah[]' min='1' class='jumlahotomatis'  />
                                            <input type='hidden' id='stokTersedia".$no."' value='".$batasQuantity."'>
                                           
                                            </td>
                                            <td>
                                                <input type='hidden' id='biaya".$no."' value='".$row['instrument_fee']."'/>
                                                <label>".rupiah($row['instrument_fee'])."</label>
                                            </td>
                                            <td>
                                                <input type='hidden' name='subtotal[]' id='subtotal".$no."' 
                                                    value='".$subtotal."' class='subtotalz'/>
                                                <label id='subtotalf".$no."'>".rupiah($subtotal)."</label>
                                            </td>
                                            <td><a href='index.php?hal=pengajuan-member/keranjang&hapusitem=".$row['instrument_id_fk']."' class='btn btn-sm btn-danger dim_about'><span class='fa fa-trash'></span></a></td>
                                            
                                        </tr>";
                        }
                         ?>
                        
                        
            </tbody>
            <tfoot>
            
              <tr>
                <td colspan="2" class="text-right"><b>Jumlah :</b> </td>
                <td><input type="text" readonly id="totaljum" name="totaljumlahSEMUAITEM"> <b>/ Item</b></td>
                <td><b>Sub total :</b></td>
                <td>Rp. <input type="text" readonly id="totalsus"></td>
              </tr>
              
            </tfoot>
        </table>
          <hr>
              
          <div class="row">
            
            <div class="col-md-4 dim_about">
                              <div class="form-group row">
                                  <label class="col-md-6"><span class="fa fa-calendar"></span> Tanggal Pinjam</label>
                                  <div class="col-md-6">
                                      <input type="text" class="form-control" name="tgl_pinjam" required id="tgl_pinjams">
                                  </div>
                              </div>
                               <div class="form-group row">
                                  <label class="col-md-6"><span class="fa fa-calendar"></span> Tanggal Kembali</label>
                                  <div class="col-md-6">
                                      <input type="text" class="form-control" name="tanggal_kembali" required id="tgl_kembalis" onchange="hitungTotalNIlai()">
                                  </div>
                              </div>
                              <div class="form-group row">
                                 <div class="col-md-6">
                                     <label>Lama Pinjma (Hari)</label>
                                  </div>
                                   <div class="col-md-6">
                                     <input type="text" id="totaldays" class="form-control" disabled>
                                  </div>
                              </div>
                               <div class="form-group row">
                                 <div class="col-md-6">
                                     <label>Dihitung (Minggu)</label>
                                  </div>
                                   <div class="col-md-6">
                                     <input type="text" id="Minggu" readonly class="form-control" name="totalbayarpenajuan">
                                  </div>
                              </div>
                  </div>
                  
                  <div class="col-md-4">
                        <div hidden="">
                          <button type="button" data-toggle="tooltip" data-placement="top"
                         title="HITUNG PINJAMAN" onclick="hitungFIX()" class="btn btn-primary dim btn-small-dim" id="hitungsemua"><span class="fa fa-calculator"> </span> </button>
                        </div>
                         <br>
                        <label>Total Peminjaman (Rp.)</label>
                        <input type="text" readonly id="totalpenyewaan" name="totalpenyewaanBayar" class="form-control">
                        <br>
                        <!-- categori member -->
                        <?php 
                            $queryShowCategori = mysql_query("SELECT category_name,category_id from tbl_member m JOIN 
                                    ref_category c ON m.category_id_fk = c.category_id where member_id = '".$_SESSION['member_id']."'
                              ");
                            $kategori_member = mysql_fetch_array($queryShowCategori);
                         ?>
                         <label>Kategori Member : <?php echo $kategori_member['category_name']; ?> </label> 
                        <?php 
                            if ($kategori_member['category_id']=='1') {

                              echo "Anda Mendapat Potongan 50 %";
                              echo "<br>
                                    <label>Potongan : </label>
                                    <input type='hidden' name='category_member' value='".$kategori_member['category_id']."' id='mhs_s1'>
                                    <input type='text' disabled  class='form-control' id='potongan'>
                                    <br>
                                    <label>Total Bayar : </label>
                                    <input type='text' disabled  class='form-control' id='hasilakahir'>";
                            }elseif($kategori_member['category_id']=='5'){
                              echo "Anda Mendapat Potongan 25 %";
                              echo "<br>
                                    <label>Potongan : </label>
                                    <input type='hidden' name='category_member' value='".$kategori_member['category_id']."' id='mhs_s1'>
                                    <input type='text' disabled  class='form-control' id='potongan'>
                                    <br>
                                    <label>Total Bayar : </label>
                                    <input type='text' disabled  class='form-control' id='hasilakahir'>";
                            }else if($kategori_member['category_id']=='6'){
                              echo "Anda Mendapat Potongan 25 %";
                              echo "<br>
                                    <label>Potongan : </label>
                                    <input type='hidden' name='category_member' value='".$kategori_member['category_id']."' id='mhs_s1'>
                                    <input type='text' disabled  class='form-control' id='potongan'>
                                    <br>
                                    <label>Total Bayar : </label>
                                    <input type='text' disabled  class='form-control' id='hasilakahir'>";
                            }else if($kategori_member['category_id']=='2'){
                              echo "<br>
                                    <input type='hidden' name='category_member' value='".$kategori_member['category_id']."' id='mhs_s1'>
                                    <input type='hidden' disabled  class='form-control' id='hasilakahir'>";
                            }else if($kategori_member['category_id']=='3'){
                              echo "<br>
                                    <input type='hidden' name='category_member' value='".$kategori_member['category_id']."' id='mhs_s1'>
                                    <input type='hidden' disabled  class='form-control' id='hasilakahir'>";
                            }else if($kategori_member['category_id']=='4'){
                              echo "<br>
                                    <input type='hidden' name='category_member' value='".$kategori_member['category_id']."' id='mhs_s1'>
                                    <input type='hidden' disabled  class='form-control' id='hasilakahir'>";
                            }
                         ?>
                         
                 </div>
                  <div class="col-md-4">
                    <div class="panel panel-primary">
                      <div class="panel-heading"><label class="control-label">Upload File</label></div>
                      <div class="panel-body">
                        <div class="form-group row">
                                        <div class="col-lg-12">
                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <div class="input-group">

                                                        <span class="btn btn-file btn-info">
                                                            <span class="fileupload-new">Select file</span>
                                                            <span class="fileupload-exists"><span class="fa fa-refresh"></span> Change</span>

                                                            <input type="file" name="frm_file" accept="application/pdf" id="ifile" onchange="cekberkas()" />
                                                        </span>
                                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><span class="fa fa-times"></span> Remove</a>
                                                    <div class="col-lg-12">
                                                        <br>
                                                        <i class="fa fa-file fa-2x" ></i>
                                                        <span class="fileupload-preview" ></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                      </div>
                       
                    </div>
                    <div class="panel-footer">
                      <p align="right">
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
                                               <button type='submit' name='ajukanpeminjaman' class='btn btn-primary btn-sm dim_about' id='ibtn_bayar' disabled='> <span class='fa fa-check'></span> Ajukan Peminjaman</button>
                                            ";
                                           }else{
                                            echo "<div class='col-md-12'>
                                              <div class='alert alert-danger alert-dismissable dim_about red-bg' style='border-color: #f8ac59; color: white;'>
                                                  <button aria-hidden='true' data-dismiss='alert' class='close' type='button' style='color: white;'>×</button>
                                                    <span class='fa fa-times'></span>
                                                   LENGKAPI DATA ANDA TERLEBIH DAHULU 
                                                   <a href='index.php?hal=akun/profil' style='border-color: #f8ac59; color: white;'><span class='fa fa-arrow-right'></span> DISINI</a>
                                                   <h5><i>* Anda Dapat Menyimpan Data Pengajuan Setelah Melengkapi Identitas Anda</i></h5>
                                                    </b>
                                                 </div>
                                            </div>";
                                           }     
                               ?>
                              </p>
                    </div>
                  </div>
                  </div>
                  
              </div> 

            </form>
              </div>
        </div>
        </div>
      </div>
    </div>
</div>

<script>
    function cekberkas() {
    var filesaya = document.getElementById('ifile').value;
    var btn = document.getElementById('ibtn_bayar');
    if (filesaya=='') {
        btn.disabled = true;
    } else {
        btn.disabled = false;
    }
}
function hitung(no) {
        
        var stokTersedia = document.getElementById('stokTersedia'+no).value;
        var jumlah  = document.getElementById('jumlah'+no).value;
        var biaya   =  $('#biaya'+no).val();
        var subtotal = jumlah*biaya;
        var total = total+subtotal;
        document.getElementById('subtotalf'+no).innerHTML = subtotal;
        $('#subtotal'+no).val(subtotal);
        var subtotaljumlah = 0;
        var jumlahotomatis = 0;

        $('input.jumlahotomatis').each(function () {
           var jumx = parseInt(this.value, 10);

          if (!isNaN(jumx)) {
              jumlahotomatis += jumx;
          }
        })

        $('input.subtotalz').each(function () {
           var num = parseInt(this.value, 10);

          if (!isNaN(num)) {
              subtotaljumlah += num;
              console
          }
        })

        $('#totalsus').val(subtotaljumlah);
        $('#totaljum').val(jumlahotomatis);
        hitungTotalNIlai();
        var cekData  = stokTersedia-jumlah;
        if (cekData < 0) {
          alert('MAAF STOK TIDAK MENCUKUPI');
          document.getElementById('jumlah'+no).value='1';
          var biayas   =  $('#biaya'+no).val();
          var subtotals = 1*biaya;
          var totals = totals+subtotals;
          document.getElementById('subtotalf'+no).innerHTML = subtotals;
          $('#subtotal'+no).val(subtotals);
          hitung(1);

        }
          
}

// function for calculate total all trx_loan /penyewaaan
var hasilakahir = 0;
function hitungFIX() {
    var categori = document.getElementById('mhs_s1').value;
    var subtotalFIX = document.getElementById('totalsus').value;
    var lamapinjamFix = document.getElementById('Minggu').value; 
    var totalBayarFIX = subtotalFIX * lamapinjamFix;
    var hasilakahir = document.getElementById('hasilakahir').value;

    console.log(categori);   
     if (categori==1) {
        
        hitungdiskons1ugm = totalBayarFIX*0.5;  
        console.log(hitungdiskons1ugm);
        var potongan = totalBayarFIX*0.5;
        $('#hasilakahir').val(hitungdiskons1ugm);
        $('#potongan').val(potongan);
     }else if (categori==5) {
        hitungdiskons2ugm = totalBayarFIX*0.25;  
        var potongans2ugm = totalBayarFIX*0.25;
        hasilakahir_s2 = totalBayarFIX-potongans2ugm;
        $('#hasilakahir').val(hasilakahir_s2);
        $('#potongan').val(potongans2ugm);
     }else if (categori == 6) {
           hitungdiskons3ugm = totalBayarFIX*0.25;  
        var potongans3ugm = totalBayarFIX*0.25;
        hasilakahir_s3 = totalBayarFIX-potongans3ugm;
        $('#hasilakahir').val(hasilakahir_s3);
        $('#potongan').val(potongans3ugm);
      }else if (categori == 2) {
        
        $('#hasilakahir').val(totalBayarFIX);
        
      }else if (categori == 3) {
        
        $('#hasilakahir').val(totalBayarFIX);
        
      }else if (categori == 4) {
        
        $('#hasilakahir').val(totalBayarFIX);
        
      }
    $('#totalpenyewaan').val(totalBayarFIX);

}

function hitungTotalNIlai() {
  
  var hitungsemuaData = document.getElementById('hitungsemua');
  hitungsemuaData.click(); 
}
</script>
<?php }else{
              echo "<script> alert('Lengkapi Data Anda Terlebih Dahulu'); location.href='index.php?hal=akun/profil';</script>  ";exit;
              } ?>
 
