<?php 
			include '../../inc/inc-db.php';
		$invoice = $_POST['id'];
		
		$detail = mysql_query("SELECT * FROM trx_loan_application_detail d join ref_instrument i on d.instrument_id_fk = i.instrument_id join trx_loan_application a on d.loan_app_id_fk = a.loan_app_id where  a.loan_invoice = '".$invoice."'");
		$no =1;
		$row = mysql_fetch_array($detail);
		$status_loan = $row['loan_status'];

?>
<form class="role" method="POST" action="index.php?hal=pengembalian/proses_pengembalian_alat">
<div class="row">
	<div class="col-md-12">
		
			<div class="form-group row">
				<label class="col-md-4">INVOICE : </label>
				<div class="col-md-8">
					<input type="text" readonly="" class="form-control"  
						value="<?php echo $row['loan_invoice']; ?>">
					<input type="hidden" name="loan_app_id_fk" value="<?php echo $row['loan_app_id_fk']; ?>">
				</div>
			</div>

		
		</div>
		<div class="col-md-12">
			<div class="form-group row">
				<label class="col-md-8">TANGGAL HARUS DIKEMBALIKAN  </label>
				<div class="col-md-4">
					<input type="text" readonly="" class="form-control" name="tanggalharusdikembalikan"  value="<?php echo $row['loan_date_return']; ?>" >
				</div>
			</div>
			
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
	