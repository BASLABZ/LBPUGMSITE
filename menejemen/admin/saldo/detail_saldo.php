<table class="table table-responsive table-hover table-striped" >
	<thead>
		<th>No</th>
		<th>Tanggal</th>
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
				$query_saldo = mysql_query("SELECT * FROM trx_saldo s JOIN tbl_member m ON s.member_id_fk = m.member_id join trx_loan_application t on s.loan_app_id_fk=t.loan_app_id where m.member_id = '".$id."' ");
				while ($row_history = mysql_fetch_array($query_saldo)) {
			 ?>
			 <tr>
			 	<td><?php echo $nourut++; ?></td>
			 	<td><?php echo $row_history['saldo_cashout_date']; ?></td>
			 	<td><?php echo $row_history['saldo_total']; ?></td>
			 	<td><?php echo $row_history['saldo_cashout_amount']; ?></td>
			 	<td><?php echo $row_history['saldo_status']; ?></td>
			 	<td><?php echo $row_history['saldo_bankname']; ?></td>
			 	<td><?php  echo $row_history['saldo_accountnumber']; ?></td>
			 </tr>
			 <?php } ?>
		</tbody>
</table>

