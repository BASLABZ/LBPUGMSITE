<?php 
		include '../../../inc/inc-db.php';
		$invoice = $_POST['id'];
		// simpan konfirmasi status pengajuan
 ?>
 <?php 
	
	if (isset($_POST['updatePengajuan'])) {
			$nomor = $_POST['cek'];
			$banyak = count($nomor);
			$loan_status = $_POST['loan_status'];
			$status = $_POST['status_pinjam'];
			$queryUpdatepinjaman  = mysql_query("UPDATE trx_loan_application set loan_status ='".$loan_status."' where loan_invoice='".$_POST['invoice']."' ");
			for ($i=0; $i < $banyak ; $i++) { 

			
				$updateStatus = $status[$i];
				$kodePengajuan = $nomor[$i];
					$query = mysql_query("UPDATE trx_loan_application_detail set loan_status_detail = '".$updateStatus."' where instrument_id_fk = '".$kodePengajuan."'");
				}
				if ($query) {
                           echo "<script> alert('Data Berhasil DI Konfirmasi'); location.href='index.php?hal=peminjaman/pengajuan/list' </script>";exit;
                        }
		}
 ?>
 
<div class="row">
	
	<form class="role" method="POST" action="index.php?hal=peminjaman/pengajuan/detail_pengajuan">
	<?php 
			$rowStatusLoan = mysql_fetch_array(mysql_query("SELECT loan_status FROM trx_loan_application where loan_invoice = '".$invoice."'"));
		 ?>
		<div class="form-group row well">
			<label class="col-md-3">STATUS PENGAJUAN </label>
			<div class="col-md-8">
				<select class="form-control" name="loan_status">
				<option value="MENUNGGU"
							<?php if($rowStatusLoan['loan_status']=='MENUNGGU'){echo "selected=selected";}?>>
								MENUNGGU
						</option>
						<option value="ACC"
							<?php if($rowStatusLoan['loan_status']=='ACC'){echo "selected=selected";}?>>
								ACC
						</option>
						<option value="DIKONFORMASI"
							<?php if($rowStatusLoan['loan_status']=='DIKONFORMASI'){echo "selected=selected";}?>>
								DIKONFORMASI DAN ADA INSTRUMEN YANG DI TOLAK
						</option>
			</select>
			</div>
		</div>
	
		<table class="table table-responsive table-striped table-hover table-bordered table-pengajuan">
		<thead>
			<th>AKSI</th>
			<th>NO</th>
			<th>NAMA INSTRUMENT</th>
			<th>STATUS PEMINJAMAN</th>
			<th>JUMLAH</th>
			<th>SUBTOTAL</th>
			<th>PENAWARAN</th>
		</thead>
		<tbody>
<?php 
		
		$sqldetail = mysql_query("SELECT * FROM trx_loan_application_detail d join ref_instrument i on d.instrument_id_fk = i.instrument_id join trx_loan_application a on d.loan_app_id_fk = a.loan_app_id where a.loan_invoice = '".$invoice."'");
		$no =1;
		while ($rowDetailPeminjaman = mysql_fetch_array($sqldetail)) {
 ?>
			<tr>
				<td>
					<?php echo "<center><input type='checkbox' onchange='cekLis(".$no.");' id='cek".$no."' name='cek[]' value='".$rowDetailPeminjaman['instrument_id']."' checked></center>"; ?>
				</td>
				<td><?php echo $no++; ?></td>
				<td><?php echo $rowDetailPeminjaman['instrument_name']; ?></td>
				<td width="60%">
					<?php echo "<select class='form-control' name='status_pinjam[]' onchange='myFunction(".$no.")' id='status".$no."'>"; ?>
						<option value="MENUNGGU"
							<?php if($rowDetailPeminjaman['loan_status_detail']=='MENUNGGU'){echo "selected=selected";}?>>
								MENUNGGU
						</option>
						<option value="ACC"
							<?php if($rowDetailPeminjaman['loan_status_detail']=='ACC'){echo "selected=selected";}?>>
								ACC
						</option>
						<option value="DITOLAK"
							<?php if($rowDetailPeminjaman['loan_status_detail']=='DITOLAK'){echo "selected=selected";}?>>
								DITOLAK
						</option>  
					</select>
				</td>
				<td><?php echo $rowDetailPeminjaman['loan_amount']; ?></td>
				<td><?php echo $rowDetailPeminjaman['loan_subtotal']; ?></td>
				<td>
					<?php echo "<div id='formPenawaran".$no."'>"; ?>
					<form class='role' method='POST'>
						<table class="table table-responsive table-hover table-striped table-bordered">
							<thead>
								<th>No</th>
								<th>Instrument</th>
								<th>Jumlah</th>
								<th>Tersedia</th>
							</thead>
							<tbody>
								<tr>
									<td>1</td>
									<td>1</td>
									<td>1</td>
									<td>1</td>
								</tr>
							</tbody>
						</table>
					</form>
					<?php echo "</div>"; ?>
				</td>
				
			</tr>
<?php } ?>
		</tbody>
		<tfoot>
			<?php 
				$queryTotal = mysql_query("SELECT * FROM trx_loan_application where loan_invoice ='".$invoice."'");
				while ($roTotal = mysql_fetch_array($queryTotal)){	
		 ?>
		<tfoot>
			<tr>
				<td colspan="4">Jumlah Item</td>
				<td><?php echo $roTotal['loan_total_item']; ?> /Buah</td>
				<td></td>
			</tr>
			<tr>
				<td colspan="5">Total</td>
				<td><?php echo $roTotal['loan_total_fee']; ?></td>
			</tr>
		</tfoot>
		<?php } ?>
		</tfoot>
	</table>
		<button type="submit" name="updatePengajuan" class="btn btn-info dim_about pull-right"  style="margin-bottom: 30px;"> <span class="fa fa-save"> </span> SIMPAN</button>
		
	</form>
</div>
<script>
	
	function cekLis(no) {
	 	var cekKlis = document.getElementById('cek'+no);
	 	var Text_keterangan = document.getElementById('keterangan'+no);
	 	

	}
	 function myFunction(no) {
		    var selectStatus = document.getElementById('status'+no).value;
		    if (selectStatus == 'DITOLAK') {
		    	$('#formPenawaran'+no).show();
		    }else if (selectStatus == 'ACC'){
		    		$('#formPenawaran'+no).hide();
		    }else if (selectStatus == 'MENUNGGU') {
		    		$('#formPenawaran'+no).hide();
		    } else{
		    		$('#formPenawaran'+no).hide();
		    }
		}
</script>
