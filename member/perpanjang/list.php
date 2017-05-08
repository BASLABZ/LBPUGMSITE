<?php 
    $query  = mysql_query("SELECT * FROM trx_loan_application where loan_invoice = '".$_GET['invoice']."'");
    $rows = mysql_fetch_array($query);
    $tanggalpengembalian = $rows['loan_date_return'];
    $tanggalawal = $rows['loan_date_start'];
    
 ?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>PENGAJUAN ALAT</h2>
        <ol class="breadcrumb">
            <li>
                <a href="../index.php">Home</a>
            </li>
            <li>
                <a>Perpanjang Alat</a>
            </li>
            <li class="active">
                <strong>Daftar Pengajuan</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row animated fadeInRight">
        <div class="col-md-12">
            <div class="ibox">
                <div class="ibox-title dim_about" style="background-color: #1ab394; border-color: #1ab394; color: white;"><span class="fa fa-list"></span> Daftar Perpanjang Peminjaman Alat</div>
                <div class="ibox-content">
                   <form class="role" method="POST" action="index.php?hal=perpanjang/proses_perpanjang">
                        <div class="row">
                        <div class="col-md-12" >
                            <div class="role dim_about col-md-6" style="background-color: #1ab394; color: white;">
                                 <div class="form-group row">
                                    <label class="col-md-3" align='right'>INVOICE</label>
                                    <input type="hidden" value="<?php echo $rows['loan_invoice']; ?>" name='invoice_perpanjang'>
                                    <div class="col-md-4"><label><?php echo $rows['loan_invoice']; ?></label></div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3" align='right'>Tanggal Awal Pinjam</label>
                                    <div class="col-md-4"><label><?php echo $tanggalawal; ?></label></div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3" align='right'>Tanggal Pengembalian</label>
                                    <div class="col-md-4"><label><?php echo $tanggalpengembalian; ?></label></div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3" align='right'>STATUS</label>
                                    <div class="col-md-4"><label><?php echo $rows['loan_status']; ?></label></div>
                                </div>
                            </div>
                        </div>
                   
                      <div class="row">
                            <div class="col-md-12 ">
                        
                        <table class="table table-responsive table-hover table-bordered">
                                <thead>
                                    <th>NO</th>
                                    <th>NAMA INSTRUMENT</th>
                                    <th>JUMLAH</th>
                                    <th>SUBTOTAL</th>
                                    
                                </thead>
                                <tbody>  
                        <?php 
                                
                                $invoice = $_GET['invoice'];
                                
                                $sqldetail = mysql_query("SELECT * FROM trx_loan_application_detail d join ref_instrument i on d.instrument_id_fk = i.instrument_id join trx_loan_application a on d.loan_app_id_fk = a.loan_app_id
                                    JOIN tbl_member m ON a.member_id_fk = m.member_id
                                 where a.loan_invoice = '".$invoice."'");
                                $no =1;
                                while ($rowDetailPeminjaman = mysql_fetch_array($sqldetail)) {
                                    $status = $rowDetailPeminjaman['loan_status_detail'];
                         ?>     
                                <tr>

                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $rowDetailPeminjaman['instrument_name']; ?></td>
                                    <td class="text-right"><?php echo $rowDetailPeminjaman['loan_amount']; ?></td>
                                    <td class="text-right">Rp.<?php echo rupiah($rowDetailPeminjaman['loan_subtotal']); ?></td>
                                    
                                </tr>
                        <?php } ?>
                                </tbody>
                                <tfoot>
                                    <?php 
                                         $querySum = mysql_query("SELECT sum(loan_amount) as jumlahs FROM trx_loan_application_detail where loan_app_id_fk='".$rows['loan_app_id']."'");
                                        $totalitem = mysql_fetch_array($querySum);
                                        $querysub = mysql_query("SELECT sum(loan_subtotal) as subtotalpengajuan FROM trx_loan_application_detail where loan_app_id_fk='".$rows['loan_app_id']."'");
                                        $totalsub = mysql_fetch_array($querysub);
                                     ?>
                                  <tr>
                                    <td colspan="2" class="text-right"><b>Jumlah :</b> </td>
                                    <td><input type="text" readonly id="totaljum" name="totaljumlahSEMUAITEM" value="<?php echo $totalitem['jumlahs']; ?>"> <b>/ Item</b></td>
                                    <td>Subtotal : Rp. <input type="text" readonly id="totalsus" value="<?php echo $totalsub['subtotalpengajuan']; ?>"></td>
                                  </tr>
                                  
                                </tfoot>
                            </table>
                        </div>
                      </div>
                       <div class="row">
                            <div class="col-md-12">
                             <div class="col-md-4 dim_about">
                              <div class="form-group row">
                                  <label class="col-md-6"><span class="fa fa-calendar"></span> Tanggal Pinjam</label>
                                  <div class="col-md-6">
                                      <input type="text" class="form-control" name="tgl_pinjam" readonly required id="tgl_pinjams" value="<?php echo $tanggalpengembalian; ?>" >
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
                                     <input type="text" id="totaldays" class="form-control" readonly="" name="lamapinjam">
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
                        <button type="button" data-toggle="tooltip" data-placement="top"
                         title="HITUNG PINJAMAN" onclick="hitungFIX()" class="btn btn-primary dim btn-small-dim" id="hitungsemua"><span class="fa fa-calculator"> </span> </button>
                         <br>
                        <label>Total Peminjaman (Rp.)</label>
                        <input type="text" readonly="" id="totalpenyewaan" name="totalpenyewaanBayar" class="form-control">
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
                            <div class="col-md-4 pull-right">
                                <button type="submit" name="updateperpanjang" class="btn btn-primary btn-block dim_about"><span class="fa fa-arrow-right"></span> Perpanjang Peminjaman</button>
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
<script type="text/javascript">
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
 