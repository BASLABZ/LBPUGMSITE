<?php 
		include '../../../inc/inc-db.php';
		$invoice = $_POST['id'];
		$query = mysql_query("SELECT loan_amount,instrument_id_fk,loan_status_detail,loan_app_detail_id,loan_app_id_fk,loan_invoice FROM trx_loan_application_detail JOIN trx_loan_application on trx_loan_application_detail.loan_app_id_fk = trx_loan_application.loan_app_id WHERE trx_loan_application_detail.loan_app_detail_id = '".$invoice."' ");

		$rowsatus = mysql_fetch_array($query);
		$jumlahInstrument = $rowsatus['loan_amount'];
		$QueryInstrument  = mysql_query("SELECT instrument_quantity FROM ref_instrument where instrument_id = '".$rowsatus['instrument_id_fk']."' ");
		$runQueryInstrument = mysql_fetch_array($QueryInstrument);
		$kolomInstrument = $runQueryInstrument['instrument_quantity'];  
		// $selisiPengurangan_instrumentv = $kolomInstrument - $jumlahInstrument;
		
 ?>
 <div class="row">
 	<form class="role" method="POST" action="index.php?hal=peminjaman/pengajuan/proses_ubah_status">
 	<!-- hidden id detail loan -->
 	<input type="hidden" value="<?php echo $rowsatus['loan_app_detail_id']; ?>" name='loan_app_detail_id'>
 	<input type="hidden" value="<?php echo $rowsatus['loan_app_id_fk']; ?>" name='loan_app_id_fk'>
 	<input type="hidden" value="<?php echo $rowsatus['loan_invoice']; ?>" name='loan_invoice'>
 	
 		<div class="row well">
 			<label class="col-md-4">UBAH STATUS <?php echo $rowsatus['loan_invoice']; ?></label>
 			<div class="col-md-6">
 				<!-- seleisi jumlah yang akan dikurangi dengan nilai yang ada di instrument -->
 				<input type="hidden" value="<?php echo $jumlahInstrument; ?>" name='selisih'>
 				<input type="hidden" value="<?php echo $rowsatus['instrument_id_fk']; ?>"
 				 name='instrument_id_fk'>
 				<input type="hidden" value="<?php echo $rowsatus['loan_app_detail_id']; ?>" 
 					name='loan_app_detail_id'>
 				<select class="form-control" id="status"  onchange="StatusPenawaran()" name="status_loan">
 					<option value="MENUNGGU"
							<?php if($rowsatus['loan_status_detail']=='MENUNGGU'){echo "selected=selected";}?>>
								MENUNGGU
						</option>
						<option value="ACC"
							<?php if($rowsatus['loan_status_detail']=='ACC'){echo "selected=selected";}?>>
								ACC
						</option>
						<option value="DITOLAK"
							<?php if($rowsatus['loan_status_detail']=='DITOLAK'){echo "selected=selected";}?>>
								DITOLAK
						</option> 
 				</select> 
 			</div>
 		</div>
 		<div class="row">
 			<div class="col-md-12">
 				<br>
 				<?php 
 					if ($status == 'DITOLAK') {
 						echo "<div id='hiddenStatusTolak'>";
 					}else if ($status != 'DITOAL') {
 						echo "<div id='hiddenStatusTolak' hidden>";
 					}
 				 ?>
 					<label>Alasan Penolakan</label>
 					<textarea class="form-control" style="height: 200px;" placeholder="Isi Dengan Keterangan Penolakan" name="reject_note"></textarea>
 					<br>
 					<div class="panel-group">
					  <div class="panel panel-primary">
					    <div class="panel-heading">
					      <h4 class="panel-title">
					        <a data-toggle="collapse" href="#collapse1"><span class="fa fa-list"></span> Pilih Penawaran Alat</a>
					      </h4>
					    </div>
					    <div id="collapse1" class="panel-collapse collapse">
					      <div class="panel-body">
					      	<table class="table table-bordered table-hover table-striped" id="tablePenawaran">
	 					<thead>
	 						<th>Pilih</th>
	 						<th>No</th>
	 						<th>Nama Instrument</th>
	 						<th>Jumlah Stok</th>
	 						<th>Ketersediaan</th>
	 						<th>Gambar</th>
	 						
	 					</thead>
	 					<tbody>
	 					<?php 
	 						$no = 0;
	 						$queryAlat = mysql_query("SELECT * FROM ref_instrument where instrument_id != '".$rowsatus['instrument_id_fk']."' order by instrument_id ASC");
	 						while ($rowAlat = mysql_fetch_array($queryAlat)) {
	 					 ?>
	 						<tr>
	 							<?php echo "<td><input type='radio' onchange='radio($no)'  value='".$rowAlat['instrument_id']."' name='cek' id='cekEd".$no."'></td>"; ?>
	 							<!-- hidden id loan_app -->

	 							<td><?php echo ++$no; ?></td>
	 							<td><?php echo $rowAlat['instrument_name']; ?></td>
	 							<td><?php echo $rowAlat['instrument_quantity']; ?><input type="hidden" name="instrument_fee" value="<?php echo $rowAlat['instrument_fee']; ?>"></td>
	 							<td>
	 								<?php $jumlah_sementara = $rowAlat['instrument_quantity'];
	                                                            $jumlah_temp = $rowAlat['intrument_quantity_temp'];
	                                                            $ketersediaan = $jumlah_sementara-$jumlah_temp;
	                                                            echo $ketersediaan;   ?>
	 							</td>
	 							<td><img src="../image/<?php echo $rowAlat['instrument_picture']; ?>" class='img-responsive' width='200px'></td>
	 						</tr>
	 						<?php } ?>
	 					</tbody>
 					</table>
					      </div>
					      	
					      
					    </div>
					  </div>
					</div>
 				</div>
 				<button class="btn btn-sm btn-primary dim_about pull-right" name="ubahstatus"><span class="fa fa-check"></span> SIMPAN</button>
 			</div>
 		</div>
 	</form>
 </div>
 <script type="text/javascript">
 	function StatusPenawaran() {
 		   var selectStatus = document.getElementById('status').value;
 		   if (selectStatus == 'DITOLAK') {
 		   		$('#hiddenStatusTolak').show();
 		   }else{
				$('#hiddenStatusTolak').hide();
 		   }
 	}
 	
 	

 	
 	
 </script>