<?php 
        $id = $_GET['id'];
        $querypreviewrekap = mysql_query("SELECT * FROM trx_loan_application p JOIN trx_payment_temp t ON t.loan_app_id_fk = p.loan_app_id where p.member_id_fk = '".$_SESSION['member_id']."' and p.loan_invoice = '".$id."'");
        $row = mysql_fetch_array($querypreviewrekap);
        $idmember = $row['member_id_fk'];
 ?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Invoice</h2>
        <ol class="breadcrumb">
            <li>
                <a href="#">Home</a>
            </li>
            <li>
                Transaksi Pembayaran
            </li>
            <li>
                Rekap Transaksi
            </li>
            <li class="active">
                <strong>Invoice : <?php echo $row['loan_invoice']; ?></strong>
            </li>
        </ol>
    </div>
</div>
 <div class="row">
  <?php $queryPeminjam = mysql_query("SELECT * from tbl_member where member_id='".$idmember."'");
                            $rowmember = mysql_fetch_array($queryPeminjam);
                             ?>
                             
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="ibox-content p-xl">
                            <table>
                                 <tr>
                                     <td>Invoice : </td>
                                     <td></td>
                                     <td><?php echo $row['loan_invoice']; ?></td>
                                 </tr>
                                 <tr>
                                     <td>Nama Peminjam :</td>
                                     <td></td>
                                     <td><?php echo $rowmember['member_name']; ?></td>
                                 </tr>
                                  <tr>
                                     <td>Institusi :</td>
                                     <td></td>
                                     <td><?php echo $rowmember['member_institution']; ?></td>
                                 </tr>
                                  <tr>
                                     <td>Tgl Pinjam :</td>
                                     <td></td>
                                     <td><?php echo $row['loan_date_start']; ?></td>
                                 </tr>
                                 <tr>
                                     <td>Tgl Kembali :</td>
                                     <td></td>
                                     <td><?php echo $row['loan_date_return']; ?></td>
                                 </tr>
                             </table>
                            <div class="table-responsive m-t">
                                <table class="table table-responsive table-hover table-bordered">
        <thead>
            <th>NO</th>
            <th>NAMA INSTRUMENT</th>
            <th>JUMLAH</th>
            <th>SUBTOTAL</th>
        </thead>
        <tbody>
            <?php 

                    
                    $sqldetail = mysql_query("SELECT * FROM trx_loan_application_detail d join ref_instrument i on d.instrument_id_fk = i.instrument_id join trx_loan_application a on d.loan_app_id_fk = a.loan_app_id where a.loan_invoice = '".$id."'");
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
        <?php 
                $rowjumlahsubtotal = mysql_query("SELECT sum(loan_subtotal) as sub   FROM trx_loan_application_detail d join trx_loan_application x 
                      on d.loan_app_id_fk = x.loan_app_id  where x.loan_invoice ='".$id."' ");
                $xs = mysql_fetch_array($rowjumlahsubtotal);
                $sub = $xs['sub'];
                $queryTotal = mysql_query("SELECT a.loan_total_item,a.loan_total_fee, a.long_loan,m.category_id_fk FROM trx_loan_application a
                                        JOIN tbl_member m ON a.member_id_fk = m.member_id
                    where a.loan_invoice ='".$id."'");
                while ($roTotal = mysql_fetch_array($queryTotal)){  
                    $potongan = $roTotal['loan_total_fee'];
                    $hasil_akhirs1 = $potongan+$potongan;
                    // hitung potongan/diskon s2 
                    $lama =  $roTotal['long_loan'];
                    $totals2 = $sub *  $lama;
                    $diskons2 = $totals2*0.25;
                    $hasil_akhirs2 = $potongan-$diskons2;
                    // hasil akhir s3
                    $totals3 = $sub *  $lama;
                    $diskons3= $totals3*0.25;
                    $hasil_akhirs3 = $totals3-$diskons3;
         ?>
        <tfoot>
            <tr>
                <td colspan="2">Jumlah Item</td>
                <td><?php echo $roTotal['loan_total_item']; ?> /Buah</td>
                
            </tr>
            <tr>
                <td colspan="2"> Lama Pinjam</td>
                <td><?php echo rupiah($roTotal['long_loan']); ?>/Minggu  </td>
                
            </tr>
            <tr>
                <td colspan="2"> Jumlah Subtotal : </td>
                
                <td>Rp.<?php echo rupiah($sub); ?></td>
            </tr>
            <?php 
                    if ($roTotal['category_id_fk']==1) {
                        
                    
             ?>
            
            <tr>
                <td colspan="2">Total </td>
                <td>Rp.<?php echo rupiah($hasil_akhirs1); ?></td>
            </tr>
            <tr>
                <td colspan="2">Potongan (50%)</td>
                <td>Rp.<?php echo rupiah($potongan);  ?></td>
            </tr>
            <tr>
                <td colspan="2">Total Bayar = (Lama Pinjam x Jumlah Subtotal)x 50 %</td>
                <td>Rp.<?php echo rupiah($roTotal['loan_total_fee']); ?></td>
            </tr>
            <?php } else if ($roTotal['category_id_fk']==5) {
                
            ?>
            
            <tr>
                <td colspan="2">Total </td>
                <td>Rp.<?php echo rupiah($totals2); ?></td>
            </tr>
            <tr>
                <td colspan="2">Potongan (25%)</td>
                <td>Rp.<?php echo rupiah($diskons2);  ?></td>
            </tr>
            <tr>
                <td colspan="2">Total Bayar </td>
                <td>Rp.<?php 
                echo rupiah($roTotal['loan_total_fee']); ?></td>
            </tr>
            <?php }elseif ($roTotal['category_id_fk']==6) {
                
             ?>
            <tr>
                <td colspan="2">Total </td>
                <td>Rp.<?php echo rupiah($totals3); ?></td>
            </tr>
            <tr>
                <td colspan="3">Potongan (25%)</td>
                <td>Rp.<?php echo rupiah($diskons3);  ?></td>
            </tr>
            
            <tr>
                <td colspan="2">Total Bayar </td>
                <td>Rp.<?php echo rupiah($hasil_akhirs3); ?></td>
            </tr> 
             <?php }else {
                ?>
                <tr>
                <td colspan="2">Total </td>
                <td>Rp.<?php echo rupiah($roTotal['loan_total_fee']); ?></td>
            </tr>
                <?php
             } ?>
        </tfoot>
        <?php } ?>
         </table>
         <p>
             Keterangan : Silahkan Bawa Identitas Anda, KTP/KTM/SIM Anda Saat Pengambilan Alat
         </p>
    </div>  
    
                    <div class="text-right">
                        <!-- <a href="pembayaran/cetak_rekap_per_invoivce.php" target="_BLANK" class="btn btn-primary"><i class="fa fa-print"></i> Cetak</a> -->
                        <form method="post" action="pembayaran/cetak_rekap_per_invoivce.php">
                            <input type="hidden" name="id" value="<?php echo $row['loan_invoice']; ?>" >
                            <button type="submit" class="btn btn-primary dim_about"><span class="fa fa-print"></span> Cetak</button>
                        </form>
                    </div> 
                </div>
                </div>
            </div>
        </div>