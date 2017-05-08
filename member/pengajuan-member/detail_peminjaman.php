
<table class="table table-responsive table-hover table-bordered">
		<thead>
			<th>NO</th>
			<th>NAMA ALAT</th>
			<th>STATUS ALAT</th>
			<th>JUMLAH</th>
			<th>HARGA SEWA</th>
			<th>AKSI</th>
		</thead>
		<tbody>

	
<?php 
		include '../../menejemen/inc/inc-db.php';
		$invoice = $_POST['id'];
		
		$sqldetail = mysql_query("SELECT * FROM trx_loan_application_detail d join ref_instrument i on d.instrument_id_fk = i.instrument_id join trx_loan_application a on d.loan_app_id_fk = a.loan_app_id
			JOIN tbl_member m ON a.member_id_fk = m.member_id
		 where a.loan_invoice = '".$invoice."'");
		$no =1;
		while ($rowDetailPeminjaman = mysql_fetch_array($sqldetail)) {
			$status = $rowDetailPeminjaman['loan_status_detail'];
			

 ?>
			
			<tr>

				<td><?php echo $no++; ?></td>
				<td><?php echo $rowDetailPeminjaman['instrument_name']; ?></td>
				<td>
					<label class="label label-warning dim_about"><span class=""></span> <?php echo $rowDetailPeminjaman['loan_status_detail']; ?></label>
				</td>
				<td class="text-right"><?php echo $rowDetailPeminjaman['loan_amount']; ?></td>
				<td class="text-right">Rp.<?php echo rupiah($rowDetailPeminjaman['loan_subtotal']); ?></td>
				<td>
					<?php if ($status == 'DITOLAK' ) {
						echo "<a href='index.php?hal=members/list&hapus=".$rowDetailPeminjaman['loan_app_detail_id']."&jumlah=".$rowDetailPeminjaman['loan_amount']."&subtotal=".$rowDetailPeminjaman['loan_subtotal']."&invoice=".$rowDetailPeminjaman['loan_invoice']."' class='btn btn-danger dim_about'><span class='fa fa-trash'></span></a>";
					}else if ($status == 'PENAWARAN') {
						echo "<a href='index.php?hal=members/list&hapus=".$rowDetailPeminjaman['loan_app_detail_id']."&jumlah=".$rowDetailPeminjaman['loan_amount']."&subtotal=".$rowDetailPeminjaman['loan_subtotal']."&invoice=".$rowDetailPeminjaman['loan_invoice']."' class='btn btn-danger dim_about'><span class='fa fa-trash'></span></a>";
					}
					else{
						echo "<button class='btn btn-success dim_about btn-xs'><span class='fa fa-check'></span></button>";
						} ?>
				</td>
			</tr>
<?php } ?>
		</tbody>
		<?php 
				$rowjumlahsubtotal = mysql_query("SELECT sum(loan_subtotal) as sub   FROM trx_loan_application_detail d join trx_loan_application x 
					  on d.loan_app_id_fk = x.loan_app_id  where x.loan_invoice ='".$invoice."' ");
				$xs = mysql_fetch_array($rowjumlahsubtotal);
				$sub = $xs['sub'];
				$queryTotal = mysql_query("SELECT a.loan_total_item,a.loan_total_fee, a.long_loan,m.category_id_fk FROM trx_loan_application a
										JOIN tbl_member m ON a.member_id_fk = m.member_id
					where a.loan_invoice ='".$invoice."'");
				while ($roTotal = mysql_fetch_array($queryTotal)){	
					$potongan = $roTotal['loan_total_fee'];
					$hasil_akhirs1 = $potongan+$potongan;
					// hitung potongan/diskon s2 
					$lama =  $roTotal['long_loan'];
					$totals2 = $sub *  $lama;
					$diskons2 = $totals2*0.25;
					$hasil_akhirs2 = $potongan-$diskons2;
					// hasil akhir s3
					$totals3 = $sub *  $lama;
					$diskons3= $totals3*0.25;
					$hasil_akhirs3 = $totals3-$diskons3;
		 ?>
	</table>
		<tfoot>
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-6 pull-right">
				 
			<tr>
				<td colspan="3" class="pull-right"><b>Jumlah Item</b></td>
				<td><?php echo $roTotal['loan_total_item']; ?> /Buah</td>
				<td></td>
			</tr> </br>
			<tr>
				<td colspan="3"><b>Lama Pinjam</b></td>
				<td><?php echo $roTotal['long_loan']; ?>/Minggu  </td>
				<td></td> <br/>
			</tr>
			<tr>
				<td colspan="3"><b>Jumlah Subtotal : </b></td>
				<td></td>
				<td>Rp.<?php echo rupiah($sub); ?></td>
			</tr> <br/>
			<?php 
					if ($roTotal['category_id_fk']==1) {
						
					
			 ?>
			
			<tr>
				<td colspan="3"><b>Total</b> </td>
				<td>Rp.<?php echo rupiah($hasil_akhirs1); ?></td>
			</tr> <br/>
			<tr>
				<td colspan="3"><b>Potongan (50%)</b></td>
				<td>Rp.<?php echo rupiah($potongan);  ?></td>
			</tr> <br/>
			<tr>
				<td colspan="3"><b>Total Bayar = (Lama Pinjam x Jumlah Subtotal)x 50 %</b></td>
				<td>Rp.<?php echo rupiah($roTotal['loan_total_fee']); ?></td>
			</tr> <br/>
			<?php } else if ($roTotal['category_id_fk']==5) {
				
			?>
			
			<tr>
				<td colspan="3">Total </td>
				<td>Rp.<?php echo rupiah($totals2);?></td>
			</tr>
			<tr>
				<td colspan="3">Potongan (25%)</td>
				<td>Rp.<?php echo rupiah($diskons2);  ?></td>
			</tr>
			<tr>
				<td colspan="3">Total Bayar </td>
				<td>Rp.<?php 
				echo rupiah($roTotal['loan_total_fee']); ?></td>
			</tr>
			<?php }elseif ($roTotal['category_id_fk']==6) {
				
			 ?>
			<tr>
				<td colspan="3">Total </td>
				<td>Rp.<?php echo rupiah($totals3); ?></td>
			</tr>
			<tr>
				<td colspan="3">Potongan (25%)</td>
				<td>Rp.<?php echo rupiah($diskons3);  ?></td>
			</tr>
			
			<tr>
				<td colspan="3">Total Bayar </td>
				<td>Rp.<?php echo rupiah($hasil_akhirs3); ?></td>
			</tr> 
			 <?php }else {
			 	?>
			 	<tr>
				<td colspan="3">Total </td>
				<td>Rp.<?php echo rupiah($roTotal['loan_total_fee']); ?></td>
			</tr>
			 	<?php
			 } ?>
			</div>
		</div>
		</tfoot>
		<?php } ?>
	
	<div class="row">
		<div class="col-md-12">
			<p align="right">
				<?php  
				$queryUbahstatus = "SELECT loan_invoice,loan_status,loan_date_return,member_id_fk,loan_total_fee FROM trx_loan_application where loan_invoice  = '".$invoice."' ";
				$ubahstatus = mysql_fetch_array(mysql_query($queryUbahstatus));
					$statusKonfirmasi = $ubahstatus['loan_status'];
					
                                   if ($statusKonfirmasi == 'MEMBAYAR TAGIHAN') {
                                     echo "<a class='btn btn-info dim_about' href='index.php?hal=pembayaran/preview_rekappembayaran_perinvoice&id=".$invoice."'> <span class='fa fa-print'></span> Cetak<a>";
                                  
                                   }else if ($statusKonfirmasi == 'ACC FINAL') {
                                   	echo "<div class='well'><b>KETERANGAN : <br/>Silahkan klik button Konfirmasi Pembayaran untuk dapat melanjutkan proses selanjutnya. Waktu yang diberikan untuk Konfirmasi Pembayaran adalah 3 Jam setelah pengajuan Anda dinyatakan di ACC. Apabila dalam waktu 3 jam Anda tidak melakukan konfirmasi pembayaran maka pengajuan peminjaman alat akan dibatalkan secara otomatis. </b></div>";
                                     echo " <a href='index.php?hal=pembayaran/konfirmasi_pembayaran&id=".$ubahstatus['loan_invoice']."' class='btn btn-info btn-xl pull-right dim_about'
                                    ><span class=''></span> KONFIRMASI PEMBAYARAN</a>";
                                   }else if ($statusKonfirmasi == 'DIBATALKAN') {
                                        echo "<a href='index.php?hal=pengajuan-member/pengajuan-alat&batalkan=".$ubahstatus['loan_invoice']."' class='btn btn-success dim_about'> <span class='fa fa-share'> </span>
                                         KIRIM PENGAJUAN</a>";                            
                                   }else if ($statusKonfirmasi == 'DITOLAK'){
                                      echo " <a href='index.php?hal=members/peminjaman/pembayaran&id=".$ubahstatus['loan_invoice']."' class='btn btn-info btn-xs dim_about'
                                    ><span class='fa fa-check'></span> KONFIRMASI <br>PEMBAYARAN</a>";
                                   }else if($statusKonfirmasi == 'MENUNGGU'){
                                   		echo "<a href='index.php?hal=pengajuan-member/pengajuan-alat&konfirmasi=".$ubahstatus['loan_invoice']."' class='btn btn-danger dim_about'> <span class='fa fa-share'> </span>
                                         BATALKAN PENGAJUAN</a>";   
                                   }else if($statusKonfirmasi == 'DIPINJAM'){
                                   		 // jika time limit 
                                   		 	$queryLamaPinjam = mysql_query("SELECT trx_loan_application.* , current_date tanggal , datediff(current_date,loan_date_return) selisih , case when datediff(current_date,loan_date_return)>0 then 'Habis' else 'aktif' end status from trx_loan_application where member_id_fk= '".$ubahstatus['member_id_fk']."' ");
                                   		 	$hariH = mysql_fetch_array($queryLamaPinjam);
                                   		 	$sisaHari  = $hariH['selisih']; 
                                   		 	if ($sisaHari == 0) {
                                   		 		echo "<a href='index.php?hal=perpanjang/list&invoice=".$ubahstatus['loan_invoice']."'>INGIN PERPANJANG ALAT ? </a> <br><p>Hari Ini Adalah Waktu Pengembalian Alat, <br>Silahkan Melakukan Pengembalian/Perpanjang Alat, Jika Anda Melewatkan Waktu <br>Pengembalian Alat Maka Anda Akan Dikenakan Denda Sebesar 25% dari Total Peminjaman <br> Dan Kartu Identitas Anda Akan Kami Tahan Sebelum Melakukan Pembayaran Denda,</p>";  	
                                   		 	}else if ($sisaHari < 0 AND $sisaHari == -2 AND $hariH['status'] != 'Habis') {
                                   		 		echo "<a href='index.php?hal=members/pengembalian/lists&id=".$ubahstatus['loan_invoice']."'>INGIN PERPANJANG ALAT ? </a><br>
                                   		 		<p>Waktu Pengembalian Anda Kurang Dari ".-($sisaHari)." Hari,Yaitu Pada Tanggal :".$hariH['loan_date_return'].", Lakukan Pengembalian / Perpanjang Dan Jika Pengembalian Melewati Batas Waktu Pengembalian Akan Dikenakan Denda 25% dari Total Peminjaman,<br>Dan Kartu Identitas Anda Akan Kami Tahan Sebelum Melakukan Pembayaran Denda</p>";
                                   		 	}
                                   		 	else if ($sisaHari > 0 AND $hariH['status'] == 'Habis') {
                                   		 		$totalBayarPeminjaman = $ubahstatus['loan_total_fee'];
                                   		 		$denda = $totalBayarPeminjaman * 0.25;
                                   		 		echo "
                                   		 		<a class='btn btn-warning dim_about' href='index.php?hal=pembayaran/pembayaran_denda&id=".$ubahstatus['loan_invoice']."'>Bayar Denda </a>
                                   		 		<p>Anda Dikenakan Denda , <br>Karena Saat Ini Anda Belum Mengembalikan Alat,Anda Melewati Tanggal : ".$hariH['loan_date_return']." <br></p>";
                                   		 		echo "<p>Anda Terlambat Selama :<b> ".$hariH['selisih']." Dan Anda Dikenakan Denda 
                                   		 		Sebesar : Rp.".$denda." </b><br>Dan Kartu Identitas Anda Akan Kami Tahan Sebelum Melakukan Pembayaran Denda</p>";
                                   		 	}
                                   }
                                     ?>
                                   
			</p>
		</div>
	</div>

