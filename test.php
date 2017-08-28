<?php 
	include 'menejemen/inc/inc-db.php';
?>
<table border="1">
	<thead>
		<th>NO</th>
		<th>TANGGAL INPUT</th>
		<th>TANGGAL PINJAM</th>
		<th>TANGGAL KEMBALI</th>
		<th>STATUS</th>
	</thead>

	<tbody>
		<?php 
			$no = 1;
			$tampil = mysql_query("SELECT * from trx_loan_application");
			while ($run_tumpil = mysql_fetch_array($tampil)) {
		?>
			<tr>
				<td><?php echo $no++; ?></td>
				<td><?php echo $run_tumpil['loan_date_input']; ?></td>
				<td><?php echo $run_tumpil['loan_date_start']; ?></td>
				<td><?php echo $run_tumpil['loan_date_return']; ?></td>
				<td><?php echo $run_tumpil['loan_status']; ?></td>
			</tr>
	<?php	} ?>
	</tbody>
</table>


