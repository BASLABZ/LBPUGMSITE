
<table class="table table-responsive table-hover table-bordered">
		<thead>
			<th>NO</th>
			<th>NAMA INSTRUMENT</th>
			<th>JUMLAH</th>
		</thead>
		<tbody>
<?php 
			include '../../inc/inc-db.php';
		$invoice = $_POST['id'];
		
		$sqldetail = mysql_query("SELECT * FROM trx_loan_application_detail d join ref_instrument i on d.instrument_id_fk = i.instrument_id join trx_loan_application a on d.loan_app_id_fk = a.loan_app_id where a.loan_invoice = '".$invoice."'");
		$no =1;
		while ($rowDetailPeminjaman = mysql_fetch_array($sqldetail)) {
			$status = $rowDetailPeminjaman['loan_status_detail'];
			$status_loan = $rowDetailPeminjaman['loan_status'];
 ?>
			<tr>
				<td><?php echo $no++; ?></td>
				<td><?php echo $rowDetailPeminjaman['instrument_name']; ?></td>
				<td><?php echo $rowDetailPeminjaman['loan_amount']; ?></td>
			</tr>
<?php } ?>
		</tbody>
	</table>
	<div class="row">
		<div class="col-md-12">
			<form class="role" method="POST" action="index.php?hal=pengambilan/proses_ambil_alat">
				<div class="form-group">
					<input type="hidden" name="invoice" value="<?php echo $invoice; ?>">
					<?php if ($status_loan == 'DIKEMBALIKAN' ) {
						echo "ALAT TELAH DIKEMBALIKAN";
					}else if ($status_loan == 'DIPINJAM') {
						echo "ALAT TELAH DI BERIKAN KEPADA MEMBER";
					} else{
						echo "<button type='submit' class='btn btn-block btn-info dim_about'> <span class='fa fa-check'></span> KONFIRMASI PEMBERIAN ALAT</button>";
						} ?>
				</div>
			</form>
		</div>
	</div>