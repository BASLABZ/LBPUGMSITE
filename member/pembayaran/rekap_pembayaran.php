<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>PENGAJUAN ALAT</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index-2.html">Home</a>
            </li>
            <li>
                <a>PENGAJUAN-ALAT</a>
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
                <div class="ibox-title dim_about" style="background-color: #1ab394; border-color: #1ab394; color: white;"><span class="fa fa-list"></span> Daftar Transaksi Pengajuan Alat</div>
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
                        <h2>PEMBAYARAN PEMINJAMAN</h2>
                        <table class="table table-responsive table-bordered table-striped table-hover">    
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
                                    $query_rekap_pembayaran = mysql_query("SELECT * FROM trx_loan_application p JOIN trx_payment_temp t ON t.loan_app_id_fk = p.loan_app_id where t.payment_status != 'TANPA SALDO & MEMBAYAR DENDA' AND t.payment_status != 'SALDO & MEMBAYAR DENDA' AND p.member_id_fk = '".$_SESSION['member_id']."'");
                                    while ($rowRekap = mysql_fetch_array($query_rekap_pembayaran)) {
                                 ?>
                                        <tr>
                                            <td><?php echo ++$no; ?></td>
                                            <td><?php echo $rowRekap['loan_invoice']; ?></td>
                                            <td><?php echo $rowRekap['payment_temp_date']; ?></td>
                                            <td><?php echo $rowRekap['payment_temp_confirm_date']; ?></td>
                                            <td><?php echo $rowRekap['bankname']; ?></td>
                                            <td><a href="../surat/<?php echo $rowRekap['payment_temp_photo']; ?>" class="label label-primary"><span class="fa fa-download"></span> BUKTI TRANSAFER</a></td>
                                            <td>Rp. <?php echo rupiah($rowRekap['payment_temp_amount_transfer']); ?></td>
                                            <td><?php echo $rowRekap['payment_temp_info']; ?></td>
                                            <td><?php echo $rowRekap['loan_status']; ?></td>
                                            <td><?php echo $rowRekap['payment_status']; ?></td>
                                            
                                            <td>
                                               <?php 
                                                    if ($rowRekap['payment_notif']=='VALID') {
                                                        
                                                ?>
                                                 <a href="index.php?hal=pembayaran/preview_rekappembayaran_perinvoice&id=<?php echo $rowRekap['loan_invoice']; ?>" class="btn btn-primary dim_about" target="_BLANK">
                                                    <span class="fa fa-print"></span> Cetak
                                                </a>
                                                <?php }else if  ($rowRekap['payment_notif']=='TIDAK VALID'){
                                                        echo "PEMBAYARAN ANDA TIDAK VALID ATAU TIDAK SESUAI, SILAHKAN CEK PEMBAYARAN,TAGIHAN/FILE POTO PEMBAYARAN ANDA
                                                        <a href='#' class='btn btn-info dim_about'>Ubah Konfirmasi Pembayaran</a>
                                                        ";
                                                    } ?>
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
                                    $query_rekap_pembayaran = mysql_query("SELECT * FROM trx_loan_application p JOIN trx_payment_temp t ON t.loan_app_id_fk = p.loan_app_id where t.payment_status = 'SALDO & MEMBAYAR DENDA'  AND p.member_id_fk = '".$_SESSION['member_id']."'");
                                   
                                    while ($rowRekap = mysql_fetch_array($query_rekap_pembayaran)) {
                                 ?>
                                        <tr>
                                            <td><?php echo ++$no; ?></td>
                                            <td><?php echo $rowRekap['loan_invoice']; ?></td>
                                            <td><?php echo $rowRekap['payment_temp_date']; ?></td>
                                            <td><?php echo $rowRekap['payment_temp_confirm_date']; ?></td>
                                            <td><?php echo $rowRekap['bankname']; ?></td>
                                            <td><a href="../surat/<?php echo $rowRekap['payment_temp_photo']; ?>" class="label label-primary"><span class="fa fa-download"></span> BUKTI TRANSAFER</a></td>
                                            <td>Rp. <?php echo rupiah($rowRekap['payment_temp_amount_transfer']); ?></td>
                                            <td><?php echo $rowRekap['payment_temp_info']; ?></td>
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
                                    $query_rekap_pembayaran = mysql_query("SELECT * FROM trx_loan_application p JOIN trx_payment_temp t ON t.loan_app_id_fk = p.loan_app_id where t.payment_status = 'TANPA SALDO & MEMBAYAR DENDA'  AND p.member_id_fk = '".$_SESSION['member_id']."'");
                                   
                                    while ($rowRekap = mysql_fetch_array($query_rekap_pembayaran)) {
                                 ?>
                                        <tr>
                                            <td><?php echo ++$no; ?></td>
                                            <td><?php echo $rowRekap['loan_invoice']; ?></td>
                                            <td><?php echo $rowRekap['payment_temp_date']; ?></td>
                                            <td><?php echo $rowRekap['payment_temp_confirm_date']; ?></td>
                                            <td><?php echo $rowRekap['bankname']; ?></td>
                                            <td><a href="../surat/<?php echo $rowRekap['payment_temp_photo']; ?>" class="label label-primary"><span class="fa fa-download"></span> BUKTI TRANSAFER</a></td>
                                            <td>Rp. <?php echo rupiah($rowRekap['payment_temp_amount_transfer']); ?></td>
                                            <td><?php echo $rowRekap['payment_temp_info']; ?></td>
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