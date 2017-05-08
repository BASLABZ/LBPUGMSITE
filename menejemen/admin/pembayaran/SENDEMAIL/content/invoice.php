<?php

  mysql_connect("localhost","root","") or die('sql error');
    mysql_select_db("penyewaan") or die('db not found');
$invoice = $_GET['loan_app_id'];
$email = $_GET['email'];
 ?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
	<center><h3>Laboratorium Bioantropologi 
				Paleantropologi LBP
				Universitas Gajah Mada [LBP-UGM]
			</h3>
	</center>
	<p align="center">
		<b>Konfirmasi Pembayaran Anda : </b>
	</p>
	<table class="table table-striped table-bordered table-hover"  id="dataTables-example" border="1">
                                                <thead>
                                                    <th>NO</th>
                                                    <th>INVOIVCE</th>
                                                    <th>NAMA</th>
                                                    <th>TANGGAL INPUT</th>
                                                    <th>TANGGAL KONFIRMASI</th>
                                                    <th>NAMA BANK</th>
                                                    <th>STATUS</th>
                                                </thead>
                                                <tbody>
                                                <?php 
                                                    $no =1;
                                                    $queryPembayaran = 
                                                        mysql_query("SELECT * FROM trx_payment p JOIN trx_loan_application pe on p.loan_app_id_fk = pe.loan_app_id 
                                                        JOIN tbl_member m on pe.member_id_fk = m.member_id 
                                                        WHERE p.payment_status != 'TANPA SALDO & MEMBAYAR DENDA' AND p.payment_status != 'SALDO & MEMBAYAR DENDA' and p.loan_app_id_fk = '".$invoice."'
                                                      
                                                        ");
                                                        
                                                    while ($roWPembayaran = mysql_fetch_array($queryPembayaran)) { ?>
                                                    <tr>
                                                        <td><?php echo $no++; ?></td>
                                                        <td><?php echo $roWPembayaran['loan_invoice']; ?></td>
                                                        <td><?php echo $roWPembayaran['member_name']; ?></td>
                                                        <td><?php echo $roWPembayaran['payment_date']; ?></td>
                                                        <td><?php echo $roWPembayaran['payment_confirm_date']; ?></td>
                                                        <td><?php echo $roWPembayaran['payment_bankname']; ?></td>
                                                         <td><?php echo $roWPembayaran['payment_valid']; ?></td>
                                                    </tr>
                                                 <?php } ?>
                                                </tbody>
                                            </table>
                                             <p>
                                                 <i><b>Jika Pembayaran Anda Sudah Terverifikasi Valid SIlahkan Segera Ambil Alat Dan Print Slip Pengambilan alat dengan cetak Pembayaran Anda Dan Ke LBP UGM</b></i>
                                             </p>
                                            <p>Terima Kasih</p>
                                            <p><b>LBP UGM</b></p>
                                          
</body>
</html>