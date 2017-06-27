<?php 
            // preview tagihan
            $invoice = $_GET['id'];
            $rowPenagihan = mysql_fetch_array(mysql_query("SELECT * FROM trx_loan_application a JOIN tbl_member m on a.member_id_fk = m.member_id where loan_invoice = '".$invoice."'"));
            $kodePeminjaman = $rowPenagihan['loan_app_id'];

          
 ?>
 <?php 
        if (isset($_POST['simpanPembayaranAlat'])) {
                  $fileName = $_FILES['frm_file']['name'];
                  $tanggal_konfirmasi_pembayaran_member = date('Y-m-d',strtotime($_POST['payment_confirm_date']));
             $move = move_uploaded_file($_FILES['frm_file']['tmp_name'], '../surat/'.$fileName);
              $tagihan = $_POST['payment_bill'];
              $jumlah_transfer = $_POST['payment_amount_transfer']; 
              $saldo_sementara = $_POST['payment_amount_saldo']; 
              $total_pembayaran = $saldo_input + $jumlah_transfer; // total bayar = saldo yg dipakai+jumlah bayar
              $saldo_input = $_POST['paymensaldo_'];
             if ($move) {
              if ($saldo_input < 1 OR $saldo_total ='' ) { // jika tidak ada saldo
                
                  if ($total_pembayaran < $tagihan) { // jika total bayar kurang dari tagihan
                     echo "<script> alert('JUMLAH PEMBAYARAN YANG ANDA INPUTKAN KURANG DARI TAGIHAN'); location.href='index.php?hal=pembayaran/pembayaran_denda&id=".$invoice."' </script>";exit;
                  }else {
                    $hasil_pembayaran1 = $total_pembayaran - $tagihan; 
                      $querysimpanpembayaran_denda1 = mysql_query( "INSERT INTO trx_payment (payment_bankname,
                                                                               payment_bill,
                                                                               payment_amount_transfer,
                                                                               payment_amount_saldo,payment_date,
                                                                              payment_confirm_date,payment_photo,
                                                                              payment_info,loan_app_id_fk,
                                                                              member_id_fk,payment_notif,payment_status,
                                                                              payment_category,payment_verification_date,
                                                                              payment_valid)

                                                                VALUES ('".$_POST['bankname']."',
                                                                        '".$_POST['payment_bill']."',
                                                                        '".$_POST['payment_amount_transfer']."',
                                                                        '".$hasil_pembayaran1."',
                                                                        NOW(),NOW(),
                                                                        '".$fileName."',
                                                                        '".$_POST['payment_info']."',
                                                                        '".$_POST['loan_app_id_fk']."',
                                                                        '".$_SESSION['member_id']."',
                                                                        '',
                                                                        'DENGAN SALDO',
                                                                        'PEMBAYARAN DENDA',
                                                                        '',
                                                                        'MENUNGGU KONFIRMASI')");

                    $querySimpanSaldo2 = mysql_query("INSERT INTO trx_saldo (saldo_total,saldo_cashout_amount,saldo_cashout_date,saldo_photo,saldo_status,loan_app_id_fk,member_id_fk) VALUES
                             ('".$hasil_pembayaran1."','','','','DEBIT','".$_POST['loan_app_id_fk']."','".$_SESSION['member_id']."')
                             ");
                    if ($querySimpanSaldo2) {
                        echo "<script> alert('DATA PEMBAYARAN DENDA ANDA TELAH TERSIMPAN DAN KAMI AKAN KONFIRMASI PEMBAYARAN ANDA'); location.href='index.php?hal=pengajuan-member/pengajuan-alat' </script>";exit;
                    }
                  }

              }else{

             

                if ($total_pembayaran < $tagihan) {
                   echo "<script> alert('TOTAL TRANSFER YANG ANDA INPUTKAN KURANG DARI TAGIHAN'); location.href='index.php?hal=pembayaran/pembayaran_denda&id=".$invoice."' </script>";exit;
                   if ($saldo_input > $saldo_sementara) {
                     echo "<script> alert('SALDO YANG ANDA INPUTKAN MELEBIHI SALDO ANDA'); location.href='index.php?hal=pembayaran/pembayaran_denda&id=".$invoice."' </script>";exit;
                   }
                }else{
                   if ($saldo_input > $saldo_sementara) {
                     echo "<script> alert('SALDO YANG ANDA INPUTKAN MELEBIHI SALDO ANDA'); location.href='index.php?hal=pembayaran/pembayaran_denda&id=".$invoice."' </script>";exit;
                   }else{
                      $hasil_pembayaran2 = $total_pembayaran - $tagihan;
                      $querysimpanpembayaran_denda2 = mysql_query( "INSERT INTO trx_payment (payment_bankname,
                                                                               payment_bill,
                                                                               payment_amount_transfer,
                                                                               payment_amount_saldo,payment_date,
                                                                              payment_confirm_date,payment_photo,
                                                                              payment_info,loan_app_id_fk,
                                                                              member_id_fk,payment_notif,payment_status,
                                                                              payment_category,payment_verification_date,
                                                                              payment_valid)

                                                                VALUES ('".$_POST['bankname']."',
                                                                        '".$_POST['payment_bill']."',
                                                                        '".$_POST['payment_amount_transfer']."',
                                                                        '".$hasil_pembayaran2."',
                                                                        NOW(),NOW(),
                                                                        '".$fileName."',
                                                                        '".$_POST['payment_info']."',
                                                                        '".$_POST['loan_app_id_fk']."',
                                                                        '".$_SESSION['member_id']."',
                                                                        '',
                                                                        'DENGAN SALDO',
                                                                        'PEMBAYARAN DENDA',
                                                                        '',
                                                                        'MENUNGGU KONFIRMASI')");
                      $querySimpanSaldo = mysql_query("INSERT INTO trx_saldo (saldo_total,saldo_cashout_amount,saldo_cashout_date,saldo_photo,saldo_status,loan_app_id_fk,member_id_fk) VALUES
                             ('".$hasil_pembayaran2."','','','','DEBIT','".$_POST['loan_app_id_fk']."','".$_SESSION['member_id']."')
                             ");
                      if ($querysimpanpembayaran_denda2) {
                         echo "<script> alert('DATA PEMBAYARAN DENDA ANDA TELAH TERSIMPAN DAN KAMI AKAN KONFIRMASI PEMBAYARAN ANDA'); location.href='index.php?hal=pengajuan-member/pengajuan-alat' </script>";exit;
                      }

                   }
                }
                
              }
             }
             
        }
  ?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>KONFIRMASI PEMBAYARAN DENDA</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index-2.html">Home</a>
            </li>
            <li>
                <a>Pembayaran</a>
            </li>
            <li class="">
                <strong>Konfirmasi Pembayaran Denda</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row animated fadeInRight">
        <div class="col-md-12">
            <div class="ibox">
                <div class="ibox-title dim_about" style="background-color: #1ab394; border-color: #1ab394; color: white;"><span class=""></span> Konfirmasi Transaksi Pembayaran Denda</div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading"><span class="fa fa-file"></span> Tagihan Denda </div>
                                <div class="panel panel-body">
                                 <?php 
                                    $invoice = $_GET['id'];
                                    $rowPenagihan = mysql_fetch_array(mysql_query("SELECT * FROM trx_loan_application a JOIN tbl_member m on a.member_id_fk = m.member_id where loan_invoice = '".$invoice."'"));
                                    $kodePeminjaman = $rowPenagihan['loan_app_id'];
                                 ?>
                                <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <table>
                                      <tr>
                                        <td>NO INVOICE</td>
                                        <td>:&nbsp&nbsp</td>
                                        <td><?php echo $invoice; ?></td>
                                      </tr>
                                      <tr>
                                        <td>NAMA MEMBER&nbsp</td>
                                        <td>:</td>
                                        <td><?php echo $rowPenagihan['member_name']; ?></td>
                                      </tr>
                                    </table>
                                  </div> 
                                </div> 
                                  </div>
                                    <table class="table table-responsive table-bordered table-striped table-hover">
                                        <tr>
                                          <td>Lama Keterlambatan</td>
                                          <td><?php 
                                              $row_lama_terambat = mysql_fetch_array(mysql_query("SELECT trx_loan_application.* , current_date tanggal , datediff(current_date,loan_date_return) selisih , case when datediff(current_date,loan_date_return)>0 then 'Habis' else 'aktif' end status from trx_loan_application where member_id_fk= '".$_SESSION['member_id']."' AND loan_invoice = '".$invoice."'"));
                                              echo $row_lama_terambat['selisih']; ?> Hari
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>Total Peminjaman</td>
                                          <td>Rp.<?php echo rupiah($rowPenagihan['loan_total_fee']); ?></td>
                                        </tr>
                                        <tr>
                                          <td>Denda = 25% x Total Peminjaman</td>
                                          <td><?php 
                                              $total_pinjaman =  $rowPenagihan['loan_total_fee']; 
                                               $total_denda = $total_pinjaman*0.25;
                                               ?>Rp <?php echo rupiah($total_denda);
                                               ?>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>Total Bayar = Lama Keterlambatan x Denda </td>
                                          <td><?php 
                                                $total_pinjaman =  $rowPenagihan['loan_total_fee']; 
                                                 $total_denda = $total_pinjaman*0.25;
                                                 ?>Rp <?php echo rupiah($row_lama_terambat['selisih'] * $total_denda); ?>
                                          </td>
                                        </tr>
                                    </table>
                                  </div>
                            </div>
                            <!-- saldo anda -->
                            <div class="panel panel-primary">
                                <div class="panel-heading"><span class="fa fa-file-text"></span> Saldo</div>
                                <div class="panel-body">
                                    <p>Jumlah saldo yang Anda miliki saat ini adalah :  </p>
                                    <h2 class='btn btn-block btn-warning btn-lg'>
                                        <?php 

                                        $querySaldo = mysql_query("SELECT sum(saldo_total) as total_saldo FROM trx_saldo where member_id_fk='".$_SESSION['member_id']."'");
                                        $total_saldo = mysql_fetch_array($querySaldo);
                                        if ($total_saldo['total_saldo']=='') {
                                          echo "Rp.0";
                                        }
                                        echo "Rp ".rupiah($total_saldo['total_saldo'])."</h2>";
                                     ?>

                                    </h2>
                                    <p><i>*Anda Dapat Melakukan Pembayaran Dengan Menggunakan Saldo.</i></p>
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
                                          <label class="col-md-4">TANGGAL KONFIRMASI</label>
                                          <div class="col-md-6">
                                            <!-- <input type="date" class="form-control" name="payment_confirm_date" id="tanggal_konfirmasi_pembayaran_member" required /> -->
                                            <input type="text" class="form-control" disabled="" name="payment_confirm_date" required value="<?php echo date('d-m-Y'); ?>" />
                                            
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <label class="col-md-4">TOTAL TAGIHAN</label>
                                          <div class="col-md-6">
                                            <input type="text" name="totalTagihan"  class="form-control" value="<?php echo rupiah($row_lama_terambat['selisih'] * $total_denda); ?>" readonly  />
                                            <input type="hidden" id="tagihan" name="payment_bill" value="<?php echo $row_lama_terambat['selisih'] * $total_denda; ?>">
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <label class="col-md-4"> NAMA BANK</label>
                                          <div class="col-md-6">
                                            <input type="text" class="form-control" name="bankname"  required />
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
                                            <input type="number" class="form-control"  id="txtSaldo" disabled="disabled" name="paymensaldo_" >
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
                                          <label class="col-md-4">JUMLAH BAYAR</label>
                                          <div class="col-md-6">
                                            <input type="text" class="form-control" name="payment_amount_transfer"  id="nominaltransfer"  required/>
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                        <label class="control-label col-lg-4">UPLOAD BUKTI PEMBAYARAN</label>
                                            <div class="col-md-8">
                                                <input type="file" name="frm_file" id="ifile" onchange="cekberkas()">
                                             </div>
                                        </div>
                                        <div class="form-group row">
                                          <label class="col-md-4">KETERANGAN</label>
                                          <div class="col-md-6">
                                            <textarea class="form-control" name="payment_info" required></textarea>
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <div class="col-md-7">
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