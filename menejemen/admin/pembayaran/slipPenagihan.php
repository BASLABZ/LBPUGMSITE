<?php 
		include '../../inc/inc-db.php';
		$invoice = $_POST['id'];
		$rowPenagihan = mysql_fetch_array(mysql_query("SELECT * FROM trx_payment a join tbl_member m ON a.member_id_fk = m.member_id join trx_loan_application p ON p.loan_app_id = a.loan_app_id_fk where p.loan_invoice = '".$invoice."' "));
		
		
 ?>
<div class="row">
<div class="col-md-12">
	<div class="form-group">
		<table>
			<tr>
				<td><b>No Invoice</b></td>
				<td>:</td>
				<td><?php echo $invoice; ?></td>
			</tr>
			<tr>
				<td><b>Nama Member</b></td>
				<td>:</td>
				<td><?php echo $rowPenagihan['member_name']; ?></td>
			</tr>
	</table>
</div> 

</div> 
  </div>
<table class="table table-responsive table-hover table-bordered">
		<thead>
			<th>No</th>
			<th>Nama Alat</th>
			<th>Jumlah</th>
			<th>Subtotal</th>
		</thead>
		<tbody>
		<?php 
					
				$sqldetail = mysql_query("SELECT * FROM trx_loan_application_detail d 
											JOIN trx_loan_application p
											 ON d.loan_app_id_fk = p.loan_app_id
											  JOIN ref_instrument i
											   ON d.instrument_id_fk = i.instrument_id
											   JOIN tbl_member m
											    where p.loan_invoice='".$invoice."' group by instrument_id");
				$no =1;
				while ($rowDetailPeminjaman = mysql_fetch_array($sqldetail)) {
		 ?>
			<tr>
				<td><?php echo $no++; ?></td>
				<td><?php echo $rowDetailPeminjaman['instrument_name']; ?></td>
				<td><?php echo $rowDetailPeminjaman['loan_amount']; ?></td>
				<td>Rp.<?php echo rupiah($rowDetailPeminjaman['loan_subtotal']); ?></td>
			</tr>
<?php } ?>
		</tbody>
		<tfoot>
			<?php 
				// total item
				$queryjumlah = mysql_query("SELECT sum(loan_total_item) as jumlahItem FROM trx_loan_application where loan_invoice='".$invoice."'");

				$jumlah = mysql_fetch_array($queryjumlah);
				$totalItem = $jumlah['jumlahItem'];
				// total biaya
				$queryTotalBayar = mysql_query("SELECT sum(loan_total_fee) as totalBiaya FROM trx_loan_application where loan_invoice='".$invoice."'");
				$biaya = mysql_fetch_array($queryTotalBayar);
				$totalBiaya = $biaya['totalBiaya'];
			 ?>

			<tr>
				<td colspan="3"><label>Jumlah</label></td>
				<td><label><?php echo $totalItem; ?> / Buah</label></td> 
			</tr>
			<tr>
				<td colspan="3"><label>Total </label></td>
				<td><label>Rp. <?php echo rupiah($totalBiaya); ?></label></td>	
			</tr>
			<tr>
				<td colspan="3"><label>Tagihan : </label></td>
				<td><label>Rp. <?php echo rupiah($rowPenagihan['payment_bill']); ?></label></td>
			</tr>
			<tr>
				<td colspan="3"><label>Jumlah Pembayaran</label></td>
				<td><label>Rp. <?php echo rupiah($rowPenagihan['payment_amount_transfer']); ?></label></td>
			</tr>
			<tr>
				<td colspan="3"><label>Kelebihan Pembayaran</label></td>
				<td><?php echo $rowPenagihan['payment_amount_saldo']; ?> * Sisa pembayaran akan dimasukkan ke dalam saldo member</td>
			</tr>
			<tr>
				<td colspan="3"><label>Kategori Pembayaran</label></td>
				<td><?php echo $rowPenagihan['payment_category']; ?></td>
			</tr>
			<tr>
				<td colspan="3"><label>Tanggal Konfirmasi</label></td>
				<td><?php echo $rowPenagihan['payment_date']; ?></td>
			</tr>
			<tr>
				<td colspan="3"><label>Dari Bank</label></td>
				<td><?php echo $rowPenagihan['payment_bankname']; ?></td>
			</tr>
			<tr>
				<td colspan="3"><label>STATUS</label></td>
				<td>
					<label>
						<?php 
								
								$tagihan  = $rowPenagihan['payment_bill'];
								$bayar  =$rowPenagihan['payment_amount_transfer'];
								$cekPembayaran = $bayar-$tagihan;
								if ($cekPembayaran == 0) {
									echo "VALID";
								}else if ($cekPembayaran > 0 ) {
									echo "VALID DAN SISA PEMBAYARAN DI MASUKKAN KE SALDO";
								}
								else if ($cekPembayaran < 0){
									echo "PEMBAYARAN TIDAK SESUAI : $cekPembayaran ";
								}
						 ?>
					</label>
				</td>
			</tr>
		</tfoot>
	</table>
	<div class="row well">
		<form class="role" method="POST" action="index.php?hal=pembayaran/verifikasi_status_pembayaran">
						<div class="col-md-12">
							<input type="hidden" name="idpayment" value="<?php echo $rowPenagihan['payment_id']; ?>" >
							<select class="form-control" name="payment_valid" required id="konfirmasivalidasi">
								<option value=""
                                                <?php if($rowPenagihan['payment_valid']=='MENUNGGU KONFIRMASI'){echo "selected=selected";}?>>MENUNGGU KONFIRMASI
                                            </option>
								<option value="VALID"
                                                <?php if($rowPenagihan['payment_valid']=='VALID'){echo "selected=selected";}?>>VALID
                                            </option>
                                            <option value="TIDAK VALID"
                                                <?php if($rowPenagihan['payment_valid']=='TIDAK VALID'){echo "selected=selected";}?>>TIDAK VALID
                                            </option>
								
							</select>

						</div>
						<div class="col-md-12" id="keterangan" hidden>
						<br>
							<label>Isi Alasan Tidak Valid</label>
							<textarea class="form-control" name="payment_notif">
								
							</textarea>
							
						<br>
						</div>
						<p>
								<?php echo $rowPenagihan['payment_notif']; ?>
							</p>
						<div class="col-md-3 pull-right" style="padding-top: 3px;">
							<button type="submit" class="btn btn-info btn-sm"><span class="fa fa-check
							"></span> VERIFIKASI</button>
						</div>

					</form>
	</div>
	
	<script type="text/javascript">
		  $('#konfirmasivalidasi').on('change',function () {
		  	if(this.value == "MENUNGGU KONFIRMASI") {
	          $('#keterangan').hide();
       		 }else if (this.value == 'VALID') {
       		 	 $('#keterangan').hide();
       		 	}else if (this.value == 'TIDAK VALID') {
       		 		$('#keterangan').show();
       		 	}
		  });
	</script>