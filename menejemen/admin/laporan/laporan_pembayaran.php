<?php
include '../../inc/inc-db.php';
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Laporan Pengajuan</title>
</head>
<body>
	<table border="1">
	<thead>
		<th>NO</th>
		<th>NO INVOICE</th>
		<th>NAMA MEMBER</th>
		<th>JUMLAH PINJAM</th>
		<th>JUMLAH BAYAR</th>
		<th>TANGGAL BAYAR</th>
	</thead>
		<tbody>
			<?php
				$no =1;
				$show = mysql_query("SELECT * from trx_payment A join trx_loan_application B on A.loan_app_id_fk = B.loan_app_id join tbl_member C on C.member_id = A.member_id_fk ");
				while ($runshow = mysql_fetch_array($show)) {
				?>
				<tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $runshow['loan_invoice']; ?></td>
					<td><?php echo $runshow['member_name']; ?></td>
					<td><?php echo $runshow['loan_total_item']; ?></td>
					<td><?php echo $runshow['payment']; ?></td>
					<td><?php echo $runshow['payment_date']; ?></td>
				</tr> 
				<?php
				}
			?>
		</tbody>
	</table>
</body>
</html>