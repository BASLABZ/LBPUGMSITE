<?php 
            // preview tagihan
            $invoice = $_GET['id'];
            $rowPenagihan = mysql_fetch_array(mysql_query("SELECT * FROM trx_loan_application a JOIN tbl_member m on a.member_id_fk = m.member_id where loan_invoice = '".$invoice."'"));
            $kodePeminjaman = $rowPenagihan['loan_app_id'];
 ?>
 <?php 
        if (isset($_POST['simpanPembayaranAlat'])) {
                  $fileName = $_FILES['frm_file']['name'];
                  $paymentBill = $_POST['payment_bill'];
                  $Ceksaldo = $_POST['cekSaldos'];  
                  $transfer = $_POST['payment_amount_transfer'];
                  $penguranganSaldo = $transfer-$paymentBill;
                  $saldoawal = $_POST['payment_amount_saldo'];
                  $tanggal_konfirmasi_pembayaran_member = date('Y-m-d',strtotime($_POST['payment_confirm_date']));
                  $move = move_uploaded_file($_FILES['frm_file']['tmp_name'], '../surat/'.$fileName);

             if ($move) {
                
                $cekPenggunaan_saldo = $_POST['paymensaldo_'];
                if ($cekPenggunaan_saldo == '') {
                  
                  if ($_POST['payment_amount_transfer'] < $_POST['payment_bill']) {

                       echo "<script> alert('Jumlah Transfer Anda Kurang Dari Tagihan'); location.href='index.php?hal=pembayaran/konfirmasi_pembayaran&id=".$invoice."' </script>";exit;

                  }else{
                    
                    $hasilkondisi_sisa_saldo = $_POST['payment_amount_transfer'] - $_POST['payment_bill'];
                    
                    $querySimpanPayment1 = "INSERT INTO trx_payment (payment_bankname,payment_bill,
                                                                  payment_amount_transfer,
                                                                  payment_amount_saldo,payment_date,
                                                                  payment_confirm_date,payment_photo,
                                                                  payment_info,loan_app_id_fk,
                                                                  member_id_fk,payment_notif,payment_status,
                                                                  payment_category,payment_verification_date,
                                                                  payment_valid)
                                                 VALUES
                                                        ('".$_POST['payment_bankname']."',
                                                        '".$_POST['payment_bill']."',
                                                        '".$_POST['payment_amount_transfer']."',
                                                        '".$hasilkondisi_sisa_saldo."',
                                                        NOW(),NOW(),
                                                        '".$fileName."',
                                                        '".$_POST['payment_info']."',
                                                        '".$_POST['loan_app_id_fk']."',
                                                        '".$_SESSION['member_id']."',
                                                        '',
                                                        'TANPA SALDO',
                                                        '".$_POST['payment_category']."',
                                                        '','MENUNGGU KONFIRMASI')";
                                                        
                             $runQueryPayment = mysql_query($querySimpanPayment1);
                             $saldobertambah = $hasilkondisi_sisa_saldo+$saldoAwal;

                             $querySimpanSaldo = "INSERT INTO trx_saldo (saldo_total,saldo_cashout_amount,saldo_cashout_date,saldo_photo,saldo_status,loan_app_id_fk,member_id_fk) VALUES
                             ('".$saldobertambah."','','','','DEBIT','".$_POST['loan_app_id_fk']."','".$_SESSION['member_id']."')
                             ";
                             $runquerysimpansaldo = mysql_query($querySimpanSaldo);
                             $updateStatusPeminjaman = "UPDATE trx_loan_application set loan_status = 'MEMBAYAR TAGIHAN' where loan_app_id='".$_POST['loan_app_id_fk']."'";
                             $runqueryupdatestatuspengajuan = mysql_query($updateStatusPeminjaman);

                             if ($runqueryupdatestatuspengajuan) {
                                 echo "<script> alert('Data Anda Berhasil Dan Tunggu Konfirmasi Dari Kami'); location.href='index.php?hal=pengajuan-member/pengajuan-alat' </script>";exit;
                             }

                    }

                }else if ($cekPenggunaan_saldo >= 0 ) {
                    
                    $tagihan =  $_POST['payment_bill'];
                    $transfer_pembayaran =  $_POST['payment_amount_transfer'];
                    $transfer_saldo = $_POST['paymensaldo_'];
                    $hasiljumlahSaldoDanTransfer = $_POST['payment_amount_transfer'] + $_POST['paymensaldo_'];
                    if ($hasiljumlahSaldoDanTransfer < $tagihan) {
                      echo "<script> alert('Jumlah Transfer Anda Kurang Dari Tagihan'); location.href='index.php?hal=pembayaran/konfirmasi_pembayaran&id=".$invoice."' </script>";exit;

                    }else if ($hasiljumlahSaldoDanTransfer >= $tagihan ) {
                       $nominalkesaldo = $hasiljumlahSaldoDanTransfer-$tagihan;
                       
                       $querySimpanPayment2 = "INSERT INTO trx_payment (payment_bankname,payment_bill,
                                                                  payment_amount_transfer,
                                                                  payment_amount_saldo,payment_date,
                                                                  payment_confirm_date,payment_photo,
                                                                  payment_info,loan_app_id_fk,
                                                                  member_id_fk,payment_notif,payment_status,
                                                                  payment_category,payment_verification_date,
                                                                  payment_valid)
                                                 VALUES
                                                        ('".$_POST['payment_bankname']."',
                                                        '".$_POST['payment_bill']."',
                                                        '".$_POST['payment_amount_transfer']."',
                                                        '".$nominalkesaldo."',
                                                        NOW(),NOW(),
                                                        '".$fileName."',
                                                        '".$_POST['payment_info']."',
                                                        '".$_POST['loan_app_id_fk']."',
                                                        '".$_SESSION['member_id']."',
                                                        '',
                                                        'SALDO',
                                                        '".$_POST['payment_category']."',
                                                        '','MENUNGGU KONFIRMASI')";

                             $runQueryPayment2 = mysql_query($querySimpanPayment2);


                             $querySimpanSaldo2 = "INSERT INTO trx_saldo (saldo_total,saldo_cashout_amount,saldo_cashout_date,saldo_photo,saldo_status,loan_app_id_fk,member_id_fk) VALUES
                             ('".$nominalkesaldo."','','','','DEBIT','".$_POST['loan_app_id_fk']."','".$_SESSION['member_id']."')
                             ";
                             $runquerysimpansaldo2 = mysql_query($querySimpanSaldo2);
                             $updateStatusPeminjaman2 = "UPDATE trx_loan_application set loan_status = 'MEMBAYAR TAGIHAN' where loan_app_id='".$_POST['loan_app_id_fk']."'";
                             $runqueryupdatestatuspengajuan2 = mysql_query($updateStatusPeminjaman2);
                             if ($runqueryupdatestatuspengajuan2) {
                               echo "<script> alert('Data Anda Berhasil Dan Tunggu Konfirmasi Dari Kami'); location.href='index.php?hal=pengajuan-member/pengajuan-alat' </script>";exit;
                             }
                    }
                   
                  //  if ($totalPembayarandgSaldo < $_POST['payment_bill']) {
                  //    echo "KURANG";
                  //    print_r($totalPembayarandgSaldo);
                  //    print_r($_POST['payment_bill']);
                  //     // echo "<script> alert('Jumlah Transfer Anda Kurang Dari Tagihan'); location.href='index.php?hal=pembayaran/konfirmasi_pembayaran&id=".$invoice."' </script>";exit;

                  // }else if ($totalPembayarandgSaldo > $_POST['payment_bill']){
                  //   echo "PAS DAN LEBIH";
                  //   print_r($totalPembayarandgSaldo);
                  //   print_r($_POST['payment_bill']);
                   
                  //   $querySimpanPayment = "INSERT INTO trx_payment (payment_bankname,payment_bill,
                  //                                                 payment_amount_transfer,
                  //                                                 payment_amount_saldo,payment_date,
                  //                                                 payment_confirm_date,payment_photo,
                  //                                                 payment_info,loan_app_id_fk,
                  //                                                 member_id_fk,payment_notif,payment_status,
                  //                                                 payment_category,payment_verification_date,
                  //                                                 payment_valid)
                  //                                VALUES
                  //                                       ('".$_POST['payment_bankname']."',
                  //                                       '".$_POST['payment_bill']."',
                  //                                       '".$_POST['payment_amount_transfer']."',
                  //                                       '".$hasilkondisi_sisa_saldo."',
                  //                                       NOW(),NOW(),
                  //                                       '".$fileName."',
                  //                                       '".$_POST['payment_info']."',
                  //                                       '".$_POST['loan_app_id_fk']."',
                  //                                       '".$_SESSION['member_id']."',
                  //                                       '',
                  //                                       'TANPA SALDO',
                  //                                       '".$_POST['payment_category']."',
                  //                                       '','MENUNGGU KONFIRMASI')";
                  //                                       print_r($querySimpanPayment); die();
                  // }
                }
               
             }
             
        }
  ?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>KONFIRMASI PEMBAYARAN</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.php">Home</a>
            </li>
            <li>
                <a>Pembayaran</a>
            </li>
            <li class="active">
                <strong>Konfirmasi Transaksi Pembayaran</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row animated fadeInRight">
        <div class="col-md-12">
            <div class="ibox">
                <div class="ibox-title dim_about" style="background-color: #1ab394; border-color: #1ab394; color: white;"><span class="fa fa-list"></span> Konfirmasi Transaksi Pembayaran</div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading"><span class="fa fa-file"></span> Tagihan Transaksi Peminjaman Alat</div>
                                <div class="panel panel-body">
                                 <?php 
                                    $invoice = $_GET['id'];
                                    $rowPenagihan = mysql_fetch_array(mysql_query("SELECT * FROM trx_loan_application a JOIN tbl_member m on a.member_id_fk = m.member_id where loan_invoice = '".$invoice."'"));
                                    $kodePeminjaman = $rowPenagihan['loan_app_id'];
                                 ?>
                                <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label>NO INVOICE     : <?php echo $invoice; ?></label><br>
                                    <label>NAMA MEMBER    : <?php echo $rowPenagihan['member_name']; ?></label><br>
                                    <label>TANGGAL PINJAM : <?php echo jin_date_str($rowPenagihan['loan_date_start']);?></label>
                                  </div> 
                                </div> 
                                  </div>
                                <table class="table table-responsive table-hover table-bordered">
                                    <thead>
                                      <th>NO</th>
                                      <th>NAMA INSTRUMENT</th>
                                      <th>JUMLAH</th>
                                      <th>SUBTOTAL</th>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        
                                        $sqldetail = mysql_query(
                                                                  "SELECT a.loan_invoice,i.instrument_name,
                                                                          d.loan_amount,d.loan_subtotal 
                                                                    FROM trx_loan_application a
                                                                    JOIN trx_loan_application_detail d 
                                                                    ON a.loan_app_id = d.loan_app_id_fk
                                                                    JOIN ref_instrument i 
                                                                    ON d.instrument_id_fk = i.instrument_id
                                                                  WHERE a.loan_invoice = '".$invoice."'");
                                        $no =1;
                                        while ($rowDetailPeminjaman = mysql_fetch_array($sqldetail)) {
                                     ?>
                                      <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $rowDetailPeminjaman['instrument_name']; ?></td>
                                        <td><?php echo $rowDetailPeminjaman['loan_amount']; ?></td>
                                        <td>Rp.<?php echo rupiah($rowDetailPeminjaman['loan_subtotal']); ?></td>
                                      </tr>
                                <?php } ?>
                                    </tbody>
                                    <?php 
                                            $rowjumlahsubtotal = mysql_query("SELECT sum(loan_subtotal) as sub FROM trx_loan_application_detail d join trx_loan_application x 
                                                  on d.loan_app_id_fk = x.loan_app_id  where x.loan_invoice ='".$invoice."' ");
                                            $xs = mysql_fetch_array($rowjumlahsubtotal);
                                            $sub = $xs['sub'];
                                            $queryTotal = mysql_query("SELECT loan_total_item,loan_total_fee, long_loan FROM trx_loan_application where loan_invoice ='".$invoice."'");
                                            while ($roTotal = mysql_fetch_array($queryTotal)){  
                                     ?>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2">Jumlah Item</td>
                                            <td><?php echo $roTotal['loan_total_item']; ?> /Buah</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"> Lama Pinjam</td>
                                            <td><?php echo $roTotal['long_loan']; ?>/Minggu  </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"> Jumlah Subtotal : </td>
                                            <td></td>
                                            <td>Rp.<?php echo rupiah($sub); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">Total = Lama Pinjam x Jumlah Subtotal</td>
                                            <td>Rp.<?php echo rupiah($roTotal['loan_total_fee']); ?></td>
                                        </tr>
                                    </tfoot>
                                    <?php } ?>
                                  </table>
                                  
                                  </div>
                            </div>             
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading"><span class="fa fa-check"></span> Konfirmasi Pembayaran</div>
                                <div class="panel-body">
                                     <form class="role" method="POST" enctype="multipart/form-data">
                                        <div class="form-group row">
                                          <label class="col-md-4">INVOICE</label>
                                          <div class="col-md-6">
                                            <input type="text" class="form-control" name="invoice" value="<?php echo $invoice; ?>" readonly />
                                            <input type="hidden" class="form-control" name="loan_app_id_fk" value="<?php echo $kodePeminjaman; ?>" />
                                            
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <label class="col-md-4">TANGGAL PEMBAYARAN</label>
                                          <div class="col-md-6">
                                            <select class="form-control" name="payment_category">
                                              <option value="">PILIH JENIS PEMBAYARAN</option>
                                              <option value="PEMINJAMAN">PEMINJAMAN ALAT</option>
                                              <option value="PERPANJANGAN">PERPANJANGAN ALAT</option>
                                            </select>
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <label class="col-md-4">TOTAL TAGIHAN</label>
                                          <div class="col-md-6">
                                            <input type="text" name="totalTagihan"  class="form-control" value="<?php echo rupiah($rowPenagihan['loan_total_fee']); ?>" readonly  />
                                            <input type="hidden" id="tagihan" name="payment_bill" value="<?php echo $rowPenagihan['loan_total_fee']; ?>">
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <label class="col-md-4">BANK</label>
                                          <div class="col-md-6">
                                            <input type="text" class="form-control" name="payment_bankname"  required />
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                        <?php 
                                               $querySaldo = mysql_query("SELECT sum(saldo_total) as total_saldo FROM trx_saldo where member_id_fk='".$_SESSION['member_id']."'");
                                                 $rowsaldo = mysql_fetch_array($querySaldo);
                                        ?>
                                          <label class="col-md-4">MENGGUNAKAN SALDO </label>
                                          <div class="col-md-6">
                                            <?php 
                                            if ($rowsaldo['total_saldo'] == '' OR $rowsaldo['total_saldo'] < 1 ) {
                                              echo "ANDA TIDAK MEMILIKI SALDO";
                                            }else{
                                           ?>
                                            <div class="input-group">
                                            <span class="input-group-addon">
                                               <input type="hidden" onclick="disabledSaldo(this)"   id="cek">
                                               <input type="checkbox" onclick="disabledSaldo(this)" id="cek">
                                            </span> 
                                            <input type="text" class="form-control"  id="txtSaldo" disabled="disabled" name="paymensaldo_" >
                                            <input type="hidden" name="cekSaldos" value="0">
                                            <input type="hidden" class="form-control"   name="payment_amount_saldo" value="<?php echo $rowsaldo['total_saldo']; ?>" id="paymentsaldo">
                                          </div>
                                      
                                          <!-- INFROMASI SALDO MEMBER -->
                                           <label id="saldosementara" hidden>
                                            <?php 
                                                if ($rowsaldo['total_saldo'] <= 0) {
                                                  echo "Rp.0";
                                                }else{
                                                   echo "Rp.".rupiah($rowsaldo['total_saldo'])."";
                                                }
                                             ?>
                                          </label>
                                              <?php } ?>
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <label class="col-md-4"> JUMLAH TRANSFER</label>
                                          <div class="col-md-6">
                                            <input type="number" class="form-control" name="payment_amount_transfer"  id="nominaltransfer"  required />
                                          </div>
                                        </div>  
                                          Inputlah sesuai dengan jumlah uang yang Anda transfer.
                                        <div class="form-group row">
                                        <label class="control-label col-lg-4">UPLOAD FILE</label>
                                            <div class="col-md-8">
                                                <input type="file" name="frm_file" id="ifile" onchange="cekberkas()">
                                             </div>
                                        </div>
                                        <div class="form-group row">
                                          <label class="col-md-4">KETERANGAN</label>
                                          <div class="col-md-6">
                                            <textarea class="form-control" name="payment_info"></textarea>
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <div class="col-md-12">
                                            <button type="submit" id="simpanPembayaran"  class="btn btn-primary dim_about pull-right" name="simpanPembayaranAlat" disabled>
                                            <span class="fa fa-save"> SIMPAN</span>
                                          </button>
                                          </div>
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
<script type="text/javascript">
      function cekberkas() {
        var filesaya = document.getElementById('ifile').value;
        var btn = document.getElementById('simpanPembayaran');
        if (filesaya=='') {
            btn.disabled = true;
        } else {
            btn.disabled = false;
        }
    }
    // pembayran via saldo / transfer
        function disabledSaldo(cek) {
            var Saldo = document.getElementById("txtSaldo");
            Saldo.disabled = cek.checked ? false : true;
            if (!Saldo.disabled) {
                Saldo.focus();
                $('#saldosementara').show();
                
            }else{
                $('#saldosementara').hide();

            }
        }


</script>
