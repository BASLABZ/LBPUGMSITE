<table class="table table-responsive table-hover table-striped" >
	<thead>
		<th>No</th>
		<th>Tanggal</th>
		<th>INVOICE</th>
		<th>Saldo Masuk</th>
		<th>Saldo Keluar</th>
		<th>Status</th>
		<th>Nama Bank</th>
		<th>Rekening Bank </th>
	</thead>
		<tbody>	
			<?php 
				include '../../inc/inc-db.php';

				$nourut = 1;
				$id = $_POST['id'];
				$query_saldo = mysql_query("SELECT * FROM trx_saldo s JOIN tbl_member m ON s.member_id_fk = m.member_id  where m.member_id = '".$id."' ");
				while ($row_history = mysql_fetch_array($query_saldo)) {
					
			 ?>
			 <tr>
			 	<td><?php echo $nourut++; ?></td>
			 	<td><?php echo $row_history['saldo_cashout_date']; ?></td>
			 	<td>
			 	<?php 
			 		if ($row_history['loan_app_id_fk'] == '') {
						// echo "TIDAK ADA NOMOR INVOICE";
					}elseif ($row_history['loan_app_id_fk'] != 0) {
						
						$row_cek_invove = mysql_fetch_array(mysql_query("SELECT * FROM trx_loan_application where loan_app_id = '".$row_history['loan_app_id_fk']."'"));
						echo $row_cek_invove['loan_invoice'];
					}
			 	 ?>
			 	 </td>
			 	
			 	<td><?php echo $row_history['saldo_total']; ?></td>
			 	<td><?php echo $row_history['saldo_cashout_amount']; ?></td>
			 	<td><?php echo $row_history['saldo_status']; ?></td>
			 	<td><?php echo $row_history['saldo_bankname']; ?></td>
			 	<td><?php  echo $row_history['saldo_accountnumber']; ?></td>
			 </tr>
			 <?php } ?>
		</tbody>
</table>

