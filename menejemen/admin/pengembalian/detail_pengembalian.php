<?php 
			include '../../inc/inc-db.php';
		$invoice = $_POST['id'];
		
		$detail = mysql_query("SELECT * FROM trx_loan_application_detail d join ref_instrument i on d.instrument_id_fk = i.instrument_id join trx_loan_application a on d.loan_app_id_fk = a.loan_app_id where  a.loan_invoice = '".$invoice."'");
		$no =1;
		$row = mysql_fetch_array($detail);
		$status_loan = $row['loan_status'];

		$tanggal_dikembaliakan = mysql_fetch_array(mysql_query("SELECT * from trx_return where loan_app_id_fk='".$row['loan_app_id']."'"));


?>
<form class="role" method="POST" action="index.php?hal=pengembalian/proses_pengembalian_alat">
<div class="row">
<div class="col-md-12">
	<?php 
		
		$query_notifikasi_pengembalian  = mysql_query("SELECT trx_loan_application.* , current_date tanggal , datediff(current_date,loan_date_return) selisih , case when datediff(current_date,loan_date_return)>0 then 'Habis' else 'aktif' end status from trx_loan_application where loan_invoice = '".$invoice."'");
		$row_notif = mysql_fetch_array($query_notifikasi_pengembalian);
		$selisih = $row_notif['selisih'];
		if ($selisih > 0 ) {
			echo "Terlambat ";
			echo $selisih;
			echo "Hari";
		}
	 ?>
	
</div>
	<div class="col-md-12">
		
			<div class="form-group row">
				<label class="col-md-8">INVOICE</label>
				<div class="col-md-4">
					<input type="text" readonly="" class="form-control"  
						value="<?php echo $row['loan_invoice']; ?>">
					<input type="hidden" name="loan_app_id_fk" value="<?php echo $row['loan_app_id_fk']; ?>">
				</div>
			</div>

		
		</div>
		<div class="col-md-12">
			<div class="form-group row">
				<label class="col-md-8">TANGGAL HARUS KEMBALI  </label>
				<div class="col-md-4">
					<input type="text" readonly="" class="form-control" name="tanggalharusdikembalikan"  value="<?php echo $row['loan_date_return']; ?>" >
				</div>
			</div>
			<?php 
				if ($status_loan =='DIKEMBALIKAN') {
				
			 ?>
			<div class="form-group row">
				<label class="col-md-8">TANGGAL DIKEMBALIKAN  </label>
				<div class="col-md-4">
					<input type="text" readonly="" class="form-control"  value="<?php echo $tanggal_dikembaliakan['return_date_input']; ?>" >
				</div>
			</div>
			<?php 
				}else{ ?>
				<div class="form-group row">
				<label class="col-md-8">TANGGAL DIKEMBALIKAN  </label>
				<div class="col-md-4">
					<input type="text" readonly="" class="form-control"  value="<?php echo date('d-m-Y'); ?>" >
				</div>
			</div>
			<?php } ?>
			
			
		</div>
		<div class="col-md-12">
			<?php 
				if ($status_loan =='DIKEMBALIKAN') {
					echo "ALAT TELAH DIKEMBALIKAN";
				}else{
				echo "	<button type='submit'  class='btn btn-success btn-block'>
			<span class='fa fa-arrow-right'></span> KEMBALIKAN ALAT
		</button>";
				}
			 ?>
		</div>
		<br>
	</div>
	</form>
<table class="table table-responsive table-hover table-bordered">
		<thead>
			<th>NO</th>
			<th>NAMA INSTRUMENT</th>
			<th>JUMLAH</th>
			
		</thead>
		<tbody>

		
<?php
		$sqldetail = mysql_query("SELECT * FROM trx_loan_application_detail d join ref_instrument i on d.instrument_id_fk = i.instrument_id join trx_loan_application a on d.loan_app_id_fk = a.loan_app_id where  a.loan_invoice = '".$invoice."'");
		while ($rowDetailPeminjaman = mysql_fetch_array($sqldetail)) {
			$status = $rowDetailPeminjaman['loan_status_detail'];
 ?>

			<tr>
				<td><?php echo $no++; ?></td>
				<td><?php echo $rowDetailPeminjaman['instrument_name']; ?></td>
				<td><?php echo $rowDetailPeminjaman['loan_amount']; ?></td>
			</tr>
<?php } ?>

		</tbody>
	</table>
	