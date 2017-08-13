<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>PEMBAYARAN</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index-2.html">Home</a>
            </li>
            <li>
                <a>DATA PEMBAYARAN</a>
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
                <div class="ibox-title dim_about" style="background-color: #1ab394; border-color: #1ab394; color: white;"><span class=""></span> Daftar Transaksi Pembayaran</div>
                <div class="ibox-content">
                    <form class="role well" method="POST">
                        <div class="form-group row">
                            <div class="col-md-4 pull-right">
                                <form method="POST" action="pembayaran/laporan_rekap_pembayaran.php">

                                <button type="submit" class="btn btn-primary dim_about btn-block"><span class="fa fa-print"></span> Cetak Riwayat Pembayaran</button>
                                </form>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                        <table class="table table-responsive table-bordered table-striped table-hover">    
                        <thead>
                            <th><center>NO</center></th>
                            <th><center>INVOICE</center></th>
                            <th><center>TANGGAL KONFIRMASI</center></th>
                            <th><center>BUKTI TRANSFER</center></th>
                            <th><center>JUMLAH BAYAR</center></th>
                            <th><center>STATUS PEMBAYARAN</center></th>
                            <th><center>KETERANGAN</center></th>
                            <th><center>AKSI</center></th>
                        </thead>
                            <tbody>
                                <?php 
                                    $no = 0;
                                    $query_rekap_pembayaran = mysql_query("SELECT * FROM trx_loan_application p JOIN trx_payment t ON t.loan_app_id_fk = p.loan_app_id where t.payment_status != 'TANPA SALDO & MEMBAYAR DENDA' AND t.payment_status != 'SALDO & MEMBAYAR DENDA' AND p.member_id_fk = '".$_SESSION['member_id']."'");
                                    while ($rowRekap = mysql_fetch_array($query_rekap_pembayaran)) {
                                        $invoice = $rowRekap['loan_invoice'];
                                 ?>
                                        <tr>
                                            <td><?php echo ++$no; ?></td>
                                            <td><center><?php echo $rowRekap['loan_invoice']; ?></center></td>
                                            <td><center><?php echo $rowRekap['payment_confirm_date']; ?></center></td>
                                            <td><center><a href="../surat/<?php echo $rowRekap['payment_photo']; ?>" class=""><span class="fa fa-download"></span> Lihat Slip</a></center></td>
                                            <td><center>Rp <?php echo rupiah($rowRekap['payment_amount_transfer']); ?></center></td>
                                            <td><center>
                                                <?php 
                                                if ($rowRekap['payment_valid'] == 'VALID') {
                                                     echo "<label class='label label-primary'>VALID</label>";
                                                 } elseif ($rowRekap['payment_valid'] == 'TIDAK VALID') {
                                                      echo "<label class='label label-danger'>TIDAK VALID</label>";
                                                 } elseif ($rowRekap['payment_valid'] == 'MENUNGGU KONFIRMASI') {
                                                     echo "<label class='label label-warning'>MENUNGGU KONFIRMASI</label>";
                                                 } ?>
                                                 </center>
                                            </td>
                                            <td><?php echo $rowRekap['payment_notif']; ?></td>
                                            <td><center>
                                               <?php 
                                                    if ($rowRekap['payment_valid']=='VALID') {
                                                        
                                                echo "<a href='index.php?hal=pembayaran/preview_rekappembayaran_perinvoice&id=<?php echo ".$rowRekap['loan_invoice']."; ?>' class='btn btn-default dim_about' target='_BLANK'>
                                                    <span class='fa fa-print'></span> Cetak</a>";
                                                 }else if  ($rowRekap['payment_valid']=='TIDAK VALID'){
                                                        echo "<a class='btn btn-info dim_about' href='index.php?hal=pembayaran/konfirmasi_kekurangan&id=$invoice' >Konfirmasi Ulang</a>";
                                                    } ?>
                                                </center>
                                            </td>
                                        </tr>
                                 <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                        <h2>PEMBAYARAN DENDA DENGAN SALDO</h2>
                        <table class="table table-responsive table-bordered table-striped table-hover id="instrument">    
                        <thead>
                            <th>NO</th>
                            <th>INVOICE</th>
                            <th>TANGGAL INPUT</th>
                            <th>TANGGAL KONFIRMASI</th>
                            <th>NAMA BANK</th>
                            <th>BUKTI TRANSFER</th>
                            <th>JUMLAH</th>
                            <th>KETERANGAN</th>
                            <th>STATUS</th>
                            <th>STATUS PEMBAYARAN</th>
                            <th>CETAK</th>
                        </thead>
                            <tbody>
                                <?php 
                                    $no = 0;

                                    $query_rekap_pembayaran = mysql_query("SELECT * FROM trx_loan_application p JOIN trx_payment t ON t.loan_app_id_fk = p.loan_app_id where t.payment_status = 'SALDO & MEMBAYAR DENDA'  AND p.member_id_fk = '".$_SESSION['member_id']."'");
                                   
                                    while ($rowRekap = mysql_fetch_array($query_rekap_pembayaran)) {
                                 ?>
                                        <tr>
                                            <td><?php echo ++$no; ?></td>
                                            <td><?php echo $rowRekap['loan_invoice']; ?></td>
                                            <td><?php echo $rowRekap['payment_date']; ?></td>
                                            <td><?php echo $rowRekap['payment_confirm_date']; ?></td>
                                            <td><?php echo $rowRekap['payment_payment_bankname']; ?></td>
                                            <td><a href="../surat/<?php echo $rowRekap['payment_photo']; ?>" class="label label-primary"><span class="fa fa-download"></span> BUKTI TRANSAFER</a></td>
                                            <td>Rp. <?php echo rupiah($rowRekap['payment_amount_transfer']); ?></td>
                                            <td><?php echo $rowRekap['loan_status']; ?></td>
                                            <td><?php echo $rowRekap['payment_status']; ?></td>
                                            <td>
                                                <a href="index.php?hal=pembayaran/preview_rekappembayaran_perinvoice&id=<?php echo $rowRekap['loan_invoice']; ?>" class="btn btn-primary dim_about" target="_BLANK">
                                                    <span class="fa fa-print"></span> Cetak
                                                </a>
                                            </td>
                                        </tr>
                                 <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    </div>
                     <hr>
                    <div class="row">
                        <div class="col-md-12">
                        <h2>PEMBAYARAN DENDA TANPA SALDO</h2>
                        <table class="table table-responsive table-bordered table-striped table-hover"id="instrument">    
                        <thead>
                            <th>NO</th>
                            <th>INVOICE</th>
                            <th>TANGGAL INPUT</th>
                            <th>TANGGAL KONFIRMASI</th>
                            <th>NAMA BANK</th>
                            <th>BUKTI TRANSFER</th>
                            <th>JUMLAH</th>
                            <th>KETERANGAN</th>
                            <th>STATUS</th>
                            <th>STATUS PEMBAYARAN</th>
                            <th>CETAK</th>
                        </thead>
                            <tbody>
                                <?php 
                                    $no = 0;
                                    $query_rekap_pembayaran = mysql_query("SELECT * FROM trx_loan_application p JOIN trx_payment t ON t.loan_app_id_fk = p.loan_app_id where t.payment_status = 'TANPA SALDO & MEMBAYAR DENDA'  AND p.member_id_fk = '".$_SESSION['member_id']."'");
                                   
                                    while ($rowRekap = mysql_fetch_array($query_rekap_pembayaran)) {
                                 ?>
                                        <tr>
                                            <td><?php echo ++$no; ?></td>
                                            <td><?php echo $rowRekap['loan_invoice']; ?></td>
                                            <td><?php echo $rowRekap['payment_date']; ?></td>
                                            <td><?php echo $rowRekap['payment_confirm_date']; ?></td>
                                            <td><?php echo $rowRekap['payment_bankname']; ?></td>
                                            <td><a href="../surat/<?php echo $rowRekap['payment_photo']; ?>" class="label label-primary"><span class="fa fa-download"></span> BUKTI TRANSAFER</a></td>
                                            <td>Rp. <?php echo rupiah($rowRekap['payment_amount_transfer']); ?></td>
                                            <td><?php echo $rowRekap['payment_info']; ?></td>
                                            <td><?php echo $rowRekap['loan_status']; ?></td>
                                            <td><?php echo $rowRekap['payment_status']; ?></td>
                                            <td>
                                                <a href="index.php?hal=pembayaran/preview_rekappembayaran_perinvoice&id=<?php echo $rowRekap['loan_invoice']; ?>" class="btn btn-primary dim_about" target="_BLANK">
                                                    <span class="fa fa-print"></span> Cetak
                                                </a>
                                            </td>
                                        </tr>
                                 <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>