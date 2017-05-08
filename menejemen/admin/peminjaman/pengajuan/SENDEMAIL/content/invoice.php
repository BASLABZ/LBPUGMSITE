<?php

  mysql_connect("localhost","root","") or die('sql error');
    mysql_select_db("penyewaan") or die('db not found');
$invoice = $_GET['invoice'];
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
		<b>Konfirmasi Pengajuan Anda : </b>
	</p>
	 <table class="table table-striped table-bordered table-hover"  id="dataTables-example" border="1">
                                                <thead>
                                                    <th>NO</th>
                                                    <th>Tanggal Pengajuan</th>
                                                    <th>No Nota / INVOICE</th>
                                                    <th>Nama</th>
                                                    <th>Tanggal Pinjam</th>
                                                    <th>Tanggal Kembali</th>
                                                    <th>Status</th>
                                                </thead>
                                                <tbody>
                                                <?php 
                                                    $no = 1;
                                                    $querypengajuan = mysql_query("SELECT * FROM trx_loan_application a  JOIN tbl_member m on a.member_id_fk = m.member_id where a.loan_invoice = '".$invoice."'");
                                                    while ($roPeminjaman = mysql_fetch_array($querypengajuan)) {
                                                 ?>
                                                    <tr>
                                                        <td><?php echo $no++; ?></td>
                                                        <td><?php echo $roPeminjaman['loan_date_input']; ?></td>
                                                        <td><?php echo $roPeminjaman['loan_invoice']; ?></td>
                                                        <td><?php echo $roPeminjaman['member_name']; ?></td>
                                                        <td><?php echo $roPeminjaman['loan_date_start']; ?></td>
                                                        <td><?php echo $roPeminjaman['loan_date_return']; ?></td>
                                                        <td><b><?php echo $roPeminjaman['loan_status']; ?></b></td>
                                                        <td>
                                                        	<?php 
                                            		if ($roPeminjaman['loan_status']=='ACC') {
                                            			echo "SILAHKAN MELAKUKAN PEMBAYARAN , WAKTU PEMBAYARAN HANYA 3 JAM  DARI DITERIMANYA EMAIL INI. JIKA TIDAK MELAKUKAN PEMBAYARAN MAKA TRANSAKSI PEMINJAMAN ANDA AKAN KAMI BATALKAN SECARA OTOMATIS";
                                            		} 
                                            		?>
                                                        </td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                            
                                             
                                            <p>Terima Kasih</p>
                                            <p><b>LBP UGM</b></p>
                                          
</body>
</html>