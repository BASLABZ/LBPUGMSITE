<?php 
include '../../inc/inc-db.php';
            // preview tagihan
            $invoice = $_GET['id'];
            $rowPenagihan = mysql_fetch_array(mysql_query("SELECT * FROM trx_loan_application a JOIN tbl_member m on a.member_id_fk = m.member_id where loan_invoice = '".$invoice."'"));
            $kodePeminjaman = $rowPenagihan['loan_app_id'];
 ?>
 <?php 
        // post dr button simpan
        if (isset($_POST['simpanPembayaranAlat'])) {
                  $fileName = $_FILES['frm_file']['name'];
                  $paymentBill = $_POST['payment_bill'];
                  $Ceksaldo = $_POST['cekSaldos'];  
                  $transfer = $_POST['payment_amount_transfer'];
                  $penguranganSaldo = $transfer-$paymentBill; // saldo=jumlah transfer - jumlah hrsbayar
                  $saldoawal = $_POST['payment_amount_saldo']; // saldo awal
                  $tanggal_konfirmasi_pembayaran_member = date('Y-m-d',strtotime($_POST['payment_confirm_date']));
                  $move = move_uploaded_file($_FILES['frm_file']['tmp_name'], '../surat/'.$fileName);

             if ($move) {
                
                $cekPenggunaan_saldo = $_POST['paymensaldo_'];
                if ($cekPenggunaan_saldo == '') {
                  
                  if ($_POST['payment_amount_transfer'] < $_POST['payment_bill']) {

                       echo "<script> alert('Jumlah Transfer Anda Kurang Dari Tagihan'); location.href='index.php?hal=pembayaran/konfirmasi_pembayaran&id=".$invoice."' </script>";exit;

                  }else{
                     // kondisi ada saldo = jumlah transfer - total bayar
                    $hasilkondisi_sisa_saldo = $_POST['payment_amount_transfer'] - $_POST['payment_bill'];
                    
                    $querySimpanPayment1 = "INSERT INTO trx_payment (payment_bankname, payment_bill,
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
                             // $saldobertambah = $hasilkondisi_sisa_saldo+$saldoAwal; 
                             // saldo awal + sisa pembayaran (saldo baru)
                             // $querySimpanSaldo = "INSERT INTO trx_saldo (saldo_total,saldo_cashout_amount,saldo_cashout_date,saldo_photo,saldo_status,loan_app_id_fk,member_id_fk) VALUES
                             // ('".$saldobertambah."','','','','DEPOSIT','".$_POST['loan_app_id_fk']."','".$_SESSION['member_id']."')
                             // ";
                             $runquerysimpansaldo = mysql_query($querySimpanSaldo);
                             $updateStatusPeminjaman = "UPDATE trx_loan_application set loan_status = 'MEMBAYAR TAGIHAN' where loan_app_id='".$_POST['loan_app_id_fk']."'";
                             $runqueryupdatestatuspengajuan = mysql_query($updateStatusPeminjaman);

                             if ($runqueryupdatestatuspengajuan) {
                                 echo "<script> alert('Data Anda Berhasil Dan Tunggu Konfirmasi Dari Kami'); location.href='index.php?hal=pengajuan-member/pengajuan-alat' </script>";exit;
                             }

                    }

                }else if ($cekPenggunaan_saldo >= 0 ) {
                    if ($_POST['paymensaldo_'] > $_POST['payment_amount_saldo']) {
                      echo "<script> alert('SALDO ANDA TIDAK CUKUP'); location.href='index.php?hal=pembayaran/konfirmasi_pembayaran&id=".$invoice."' </script>";exit;
                    }else{
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


                             // $querySimpanSaldo2 = "INSERT INTO trx_saldo (saldo_total,saldo_cashout_amount,saldo_cashout_date,saldo_photo,saldo_status,loan_app_id_fk,member_id_fk) VALUES
                             // ('".$nominalkesaldo."','','','','DEPOSIT','".$_POST['loan_app_id_fk']."','".$_SESSION['member_id']."')
                             // ";
                             // $runquerysimpansaldo2 = mysql_query($querySimpanSaldo2);
                             $updateStatusPeminjaman2 = "UPDATE trx_loan_application set loan_status = 'MEMBAYAR TAGIHAN' where loan_app_id='".$_POST['loan_app_id_fk']."'";
                             $runqueryupdatestatuspengajuan2 = mysql_query($updateStatusPeminjaman2);
                             if ($runqueryupdatestatuspengajuan2) {
                               echo "<script> alert('Data Anda Berhasil Dan Tunggu Konfirmasi Dari Kami'); location.href='index.php?hal=pengajuan-member/pengajuan-alat' </script>";exit;
                             }
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
                <div class="ibox-title dim_about" style="background-color: #1ab394; border-color: #1ab394; color: white;"><span class="">Ringkasan Pembayaran</span> </div>
                <div class="ibox-content">
                    <div class="row">
                        

                        <div class="col-md-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading"><span class=""></span> Konfirmasi Pembayaran</div>
                                <div class="panel-body">
                                     <form class="role" method="POST" enctype="multipart/form-data">
                                        <div class="form-group row">
                                          <label class="col-md-3">INVOICE</label>
                                          <div class="col-md-9">
                                            <input type="text" class="form-control" name="invoice" value="<?php echo $invoice; ?>" readonly />
                                            <input type="hidden" class="form-control" name="loan_app_id_fk" value="<?php echo $kodePeminjaman; ?>" />
                                            
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <label class="col-md-3">JENIS PEMBAYARAN</label>
                                          <div class="col-md-9">
                                              <input type="text" class="form-control" name="payment_category" value="KEKURANGAN PEMBAYARAN" readonly>
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <label class="col-md-3">TOTAL TAGIHAN</label>
                                          <div class="col-md-9">
                                            <input type="text" name="totalTagihan"  class="form-control" value="<?php echo rupiah($rowPenagihan['loan_total_fee']); ?>" readonly  />
                                            <input type="hidden" id="tagihan" name="payment_bill" value="<?php echo $rowPenagihan['loan_total_fee']; ?>">
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <label class="col-md-3">KETERANGAN</label>
                                          <div class="col-md-9">
                                            <input type="text" class="form-control" name="payment_notif" value="<?php 
                                            $notif = mysql_query("SELECT payment_notif from trx_payment where loan_app_id_fk = '".$kodePeminjaman."'");
                                            $run_notif = mysql_fetch_array($notif);
                                            echo $run_notif['payment_notif'];
                                             ?>" readonly />
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <label class="col-md-3">BANK</label>
                                          <div class="col-md-9">
                                            <input type="text" class="form-control" name="payment_bankname"  required />
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                        <?php 
                                               $querySaldo = mysql_query("SELECT sum(saldo_total) as total_saldo FROM trx_saldo where member_id_fk='".$_SESSION['member_id']."'");
                                                 $rowsaldo = mysql_fetch_array($querySaldo);
                                        ?>
                                          <label class="col-md-3">MENGGUNAKAN SALDO </label>
                                          <div class="col-md-9">
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
                                          <label class="col-md-3"> JUMLAH TRANSFER</label>
                                          <div class="col-md-9">
                                            <input type="number" class="form-control" name="payment_amount_transfer"  id="nominaltransfer"  required />
                                          </div> <br/>
                                          <label class="col-md-5"></label>
                                          <div class="col-md-6"> 
                                          Inputlah sesuai dengan jumlah uang yang Anda transfer.
                                        </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                        <label class="control-label col-lg-3">UPLOAD BUKTI TRANSFER</label>
                                            <div class="col-md-9">
                                                <input type="file" name="frm_file" id="ifile" onchange="cekberkas()">
                                             </div>
                                        </div>
                                        <div class="form-group row">
                                          <label class="col-md-3">KETERANGAN</label> 
                                          <div class="col-md-9">
                                            <textarea class="form-control" name="payment_info"></textarea>
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <div class="col-md-11">
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
