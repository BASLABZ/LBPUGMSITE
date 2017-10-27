<table class="table table-responsive table-hover table-bordered" >
		<thead>
			<th>NO</th>
			<th>NAMA ALAT</th>
			<th>STATUS ALAT</th>
			<th>BIAYA SEWA</th>
			<th>JUMLAH</th>
			<th>SUBTOTAL</th>
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
				<td><?php echo $rowDetailPeminjaman['instrument_name'];   ?></td>
				<td>
					<center>
						<?php if ($status == 'MENUNGGU') {
							echo "<span class='label label-warning'>MENUNGGU</span>";
						} elseif ($status == 'ACC') {
							echo "<span class='label label-primary'>ACC</span>";
						} elseif ($status =='PENAWARAN DISETUJI') {
							echo "<span class='label label-info'>PENAWARAN DISETUJUI</span>";
						} else if($status == 'DITOLAK'){
							echo "<span class='label label-default'>DIKONFIRMASI</span>";
						} elseif ($status == 'DITOLAK TANPA PENAWARAN') {
							echo "<span class='label label-danger'>DITOLAK</span>";
						} ?>
					</center>
				</td>
				<td>Rp <?php echo rupiah($rowDetailPeminjaman['instrument_fee']); ?></td>
				<td><center><?php echo $rowDetailPeminjaman['loan_amount']; ?></center></td>
				<td>Rp <?php echo rupiah($rowDetailPeminjaman['loan_subtotal']); ?></td>

				<td>
					<?php if ($status == 'DITOLAK' ) {

						echo "<a style='margin-left:10px;' href='index.php?hal=pengajuan-member/lihat_penawaran&id=".$rowDetailPeminjaman['loan_app_detail_id']."&idpengajuan=".$rowDetailPeminjaman['loan_invoice']."' class='btn btn-info btn-xs dim_about'><span class='fa fa-eye'> Lihat Detail</span></a>";
						// echo "<a style='margin-left:10px;' href='index.php?hal=members/list&hapus=".$rowDetailPeminjaman['loan_app_detail_id']."&jumlah=".$rowDetailPeminjaman['loan_amount']."&subtotal=".$rowDetailPeminjaman['loan_subtotal']."&invoice=".$rowDetailPeminjaman['loan_invoice']."' class='btn btn-danger'><span class='fa fa-trash'></span></a>";
						
						
					}else if ($status == 'PENAWARAN') {
						echo "<a href='index.php?hal=members/list&hapus=".$rowDetailPeminjaman['loan_app_detail_id']."&jumlah=".$rowDetailPeminjaman['loan_amount']."&subtotal=".$rowDetailPeminjaman['loan_subtotal']."&invoice=".$rowDetailPeminjaman['loan_invoice']."' class='btn btn-danger dim_about'><span class='fa fa-trash'></span></a>";
					}elseif ($status == 'DITOLAK TANPA PENAWARAN') {
	                        $queryPermintaan = mysql_query("SELECT * FROM trx_rejected_detail de join trx_rejected re 
	                        ON de.rejected_id_fk = re.rejected_id
	                        JOIN trx_loan_application_detail dl 
	                        ON re.loan_app_detail_id_fk = dl.loan_app_detail_id
	                        JOIN ref_instrument i
	                        ON dl.instrument_id_fk = i.instrument_id
	                        where dl.loan_app_detail_id = '".$rowDetailPeminjaman['loan_app_detail_id']."'");

                            while ($rowPenolakan = mysql_fetch_array($queryPermintaan)) {
                            	
                            	echo "Ket : "; echo $rowPenolakan['rejected_text'];
                            }
                                         
					}
					else{
						echo "<center><button class='btn btn-success dim_about btn-xs'><span class='fa fa-check'></span></button></center>";
						} ?>
				</td>
			</tr>
<?php } ?>
		</tbody>
		<?php 	// query utk tfoot
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
					$lama =  $roTotal['long_loan']; // lama pinjam
					$totals2 = $sub *  $lama; 
					$diskons2 = $totals2*0.25;
					$hasil_akhirs2 = $potongan-$diskons2;
					// hasil akhir s3
					$totals3 = $sub *  $lama;
					$diskons3= $totals3*0.25;
					$hasil_akhirs3 = $totals3-$diskons3;

					$totals1 = $sub *  $lama;
					$diskons1= $totals1*0.25;
					$hasil_akhirs1 = $totals1-$diskons1;
							
		 ?>
	
		<tfoot>		 
			<tr>
				<td colspan="4"><b>Jumlah Alat</b></td>
				<td><center><b><?php echo $roTotal['loan_total_item']; ?></b></center></td>
				<td></td>
			</tr> </br>
			<tr>
				<td colspan="4"><b>Lama Pinjam</b></td>
				<td><center><b><?php echo $roTotal['long_loan']; ?> Minggu</b></center></td>
				<td></td><br/>
			</tr>
			<tr>
				<td colspan="5"><b>Subtotal </b></td>
				<td>Rp <?php echo rupiah($sub); ?></td>
			</tr> <br/>
			<?php 
					if ($roTotal['category_id_fk']==1) { // Mhs s1 kedokteran ugm
						
					
			 ?>
			
			<tr>
				<td colspan="5"><b>Total = (Lama Pinjam x Subtotal)</b> </td>
				<td>Rp <?php echo rupiah($roTotal['long_loan'] * $sub ); ?></td>
			</tr> <br/>
			<tr>
				<td colspan="5"><b>Potongan (50%)</b></td>
				<td>Rp <?php echo rupiah($roTotal['long_loan'] * $sub/2);  ?></td>
			</tr> <br/>
			<tr>
				<td colspan="5"><b>Total Bayar = (Total - Potongan)</b></td>
				<td><b>Rp <?php echo  rupiah ($roTotal['long_loan'] * $sub/2); ?></b></td>
			</tr> <br/>
			<?php } else if ($roTotal['category_id_fk']==5) { // mhs s2 ugm
				
			?>
			
			<tr>
				<td colspan="5"><b>Total = (Lama Pinjam x Subtotal)</b></td>
				<td>Rp <?php echo rupiah($totals2);?></td>
			</tr>
			<tr>
				<td colspan="5"><b>Potongan (25%)</b></td>
				<td>Rp.<?php echo rupiah($diskons2);  ?></td>
			</tr>
			<tr>
				<td colspan="5"><b>Total Bayar = (Total - Potongan)</b></td>
				<td><b>Rp <?php echo rupiah($roTotal['loan_total_fee']); ?></b></td>
			</tr>
			<?php }elseif ($roTotal['category_id_fk']==6) { // mhs s3 ugm
				
			 ?>
			<tr>
				<td colspan="5"><b>Total = (Lama Pinjam x Subtotal)</b></td>
				<td>Rp <?php echo rupiah($totals3); ?></td>
			</tr>
			<tr>
				<td colspan="5"><b>Potongan (25%)</b></td>
				<td>Rp <?php echo rupiah($diskons3);  ?></td>
			</tr>
			
			<tr>
				<td colspan="5"><b>Total Bayar = (Total - Potongan)</b></td>
				<td><b>Rp <?php echo rupiah($hasil_akhirs3); ?></b></td>
			</tr> 
			<?php  }elseif ($roTotal['category_id_fk']==7) { ?>
			<tr>
				<td colspan="5"><b>Total = (Lama Pinjam x Subtotal)</b></td>
				<td>Rp <?php echo rupiah($totals1); ?></td>
			</tr>
			<tr>
				<td colspan="5"><b>Potongan (25%)</b></td>
				<td>Rp <?php echo rupiah($diskons1);  ?></td>
			</tr>
			
			<tr>
				<td colspan="5"><b>Total Bayar = (Total - Potongan)</b></td>
				<td><b>Rp <?php echo rupiah($hasil_akhirs1); ?></b></td>
			</tr> 
			 <?php }else {
			 	?>
			 	<tr>
					<td colspan="5"><b>Total = (Lama Pinjam x Subtotal)</b></td>
					<td>Rp <?php echo rupiah($roTotal['loan_total_fee']); ?></td>
				</tr>
			 	<?php
			 } ?>
		</tfoot>
		<?php } ?>
	</table>
	
	<div class="row">
		<div class="col-md-12">
			<p align="right">
				<?php  
				$queryUbahstatus = "SELECT loan_invoice, loan_status, loan_date_return, member_id_fk, loan_total_fee, loan_app_id FROM trx_loan_application where loan_invoice  = '".$invoice."' ";
				$ubahstatus = mysql_fetch_array(mysql_query($queryUbahstatus));
					$statusKonfirmasi = $ubahstatus['loan_status'];
					// $statusPembayaran = 
					$querystatuspembayaran = mysql_fetch_array(mysql_query("SELECT * FROM trx_payment where loan_app_id_fk = '".$ubahstatus['loan_app_id']."'"));

									// jika status peminjaman membayar tagihan & status pembayaran valid maka muncul button untuk cetak invoice
                                   if ($statusKonfirmasi == 'MEMBAYAR TAGIHAN') {
                    					if ($querystatuspembayaran['payment_valid'] == 'VALID') {
                    						echo "<a href='index.php?hal=pembayaran/preview_rekappembayaran_perinvoice&id=".$invoice."' h class='btn  btn-info dim_about'><span class='fa fa-print'></span> CETAK INVOICE</a>";
                    					}                 
                                  
                                   }else if ($statusKonfirmasi == 'PERPANJANG') {
                    					$query_cek_status_perpanjangan = mysql_query("SELECT longtime_status from trx_longtime where loan_app_id_fk= '".$ubahstatus['loan_app_id']."'");
                    					while ($status_perpanjangan = mysql_fetch_array($query_cek_status_perpanjangan)) {
                    					             	if ($status_perpanjangan['longtime_status'] == 'ACC PERPANJANGAN') {
                    					             		echo "<a href='index.php?hal=perpanjang/list&id=".$invoice."' h class='btn  btn-info dim_about'><span class='fa fa-print'></span> CETAK INVOICE</a>"; 
                    					             	}
                    					             }             
                                  
                                   } 
                                   // jika status peminjaman acc final -> button konfirm pmbayaran
                                   else if ($statusKonfirmasi == 'ACC FINAL') {
                                   	echo "<div class='well'><b>KETERANGAN : <br/>Silahkan klik button Konfirmasi Pembayaran untuk dapat melanjutkan proses selanjutnya. Waktu yang diberikan untuk Konfirmasi Pembayaran adalah 3 Jam setelah Anda mendapat konfirmasi ACC FINAL. Apabila dalam waktu 3 jam Anda tidak melakukan konfirmasi pembayaran maka pengajuan peminjaman alat akan dibatalkan secara otomatis. </b></div>";
                                     echo " <a href='index.php?hal=pembayaran/konfirmasi_pembayaran&id=".$ubahstatus['loan_invoice']."' class='btn btn-info btn-xl pull-right dim_about'
                                    ><span class=''></span> Konfirmasi Pembayaran</a>";
                                   } 
                                   // jika status peminjaman dibatalkan -> button ajukan peminjaman
                                   else if ($statusKonfirmasi == 'DIBATALKAN') {
                                        // echo "<a href='index.php?hal=pengajuan-member/pengajuan-alat&batalkan=".$ubahstatus['loan_invoice']."' class='btn btn-success dim_about'> <span class='fa fa-share'> </span>
                                        //  KIRIM PENGAJUAN</a>";                            
                                   }else if ($statusKonfirmasi == 'DITOLAK'){
                                      	$query_alasan  = mysql_query("SELECT * FROM trx_rejected_detail de join trx_rejected re 
                                        ON de.rejected_id_fk = re.rejected_id
                                        JOIN trx_loan_application_detail dl 
                                        ON re.loan_app_detail_id_fk = dl.loan_app_detail_id
                                        JOIN ref_instrument i
                                        ON dl.instrument_id_fk = i.instrument_id
                                        JOIN trx_loan_application lp ON
                                        dl.loan_app_id_fk = lp.loan_app_id
                                         where lp.loan_invoice= '".$invoice."'");
                                         while ($row_alasan = mysql_fetch_array($query_alasan)) {
                                         	echo "<ul>";
                                         	echo "<li>";
                                         	echo "<b>Alat Yang Ditolak :";
                                         	echo $row_alasan['instrument_name'];
                                         	echo "</b>-";
                                         	echo $row_alasan['rejected_text'];
                                         	echo "</li>";
                                         	echo "</ul>";
                                         }
                                   }else if ($statusKonfirmasi == 'DIKONFIRMASI') {
                                   	echo " <a href='index.php?hal=members/peminjaman/pembayaran&id=".$ubahstatus['loan_invoice']."' class='btn btn-info btn-xs dim_about'
                                    ><span class='fa fa-check'></span> KONFIRMASI <br>PEMBAYARAN</a>";
                                   } 
                                   // jika status peminjaman menunggu = ( kondisi blm dikonfirmasi koordinator penelitian) -> button batalkan pengajuan
                                   else if($statusKonfirmasi == 'MENUNGGU'){
                                   		echo "<a href='index.php?hal=pengajuan-member/pengajuan-alat&konfirmasi=".$ubahstatus['loan_invoice']."' class='btn btn-danger dim_about'> <span class='fa fa-share'> </span>
                                         BATALKAN PENGAJUAN</a>";   
                                   }else if($statusKonfirmasi == 'DIPINJAM'){
                                   		
                                   		 // jika time limit 
                                   		 	$queryLamaPinjam = mysql_query("SELECT trx_loan_application.* , current_date tanggal , datediff(current_date,loan_date_return) selisih , case when datediff(current_date,loan_date_return)>0 then 'Habis' else 'aktif' end status from trx_loan_application where member_id_fk= '".$ubahstatus['member_id_fk']."' AND loan_app_id = '".$ubahstatus['loan_app_id']."' ");
                                   		 	$hariH = mysql_fetch_array($queryLamaPinjam);
                                   		 	
                                   		 	$sisaHari  = $hariH['selisih']; 
                                   		 	// hasil dari sishari digunakan untuk crosscek perpanjang,denda,dan pengembalian
                                   		 	if ($sisaHari == 0) {
                                   		 		echo "<a href='index.php?hal=perpanjang/list&id=".$ubahstatus['loan_invoice']."'>INGIN PERPANJANG ALAT ? </a> <br><p>Hari Ini Adalah Waktu Pengembalian Alat, <br>Silahkan Melakukan Pengembalian/Perpanjang Alat, Jika Anda Melewatkan Waktu <br>Pengembalian Alat Maka Anda Akan Dikenakan Denda Sebesar 25% dari Total Peminjaman <br> Dan Kartu Identitas Anda Akan Kami Tahan Sebelum Melakukan Pembayaran Denda,</p>";  	
                                   		 	}else if ($sisaHari < 0 AND $sisaHari == -2 OR $sisaHari == -1 AND $hariH['status'] != 'Habis') {
                                   		 		echo "<a href='index.php?hal=perpanjang/list&id=".$ubahstatus['loan_invoice']."'>INGIN PERPANJANG ALAT ? </a><br>
                                   		 		<p>Waktu Pengembalian Anda Kurang Dari ".-($sisaHari)." Hari,Yaitu Pada Tanggal :".$hariH['loan_date_return'].", Lakukan Pengembalian / Perpanjang Dan Jika Pengembalian Melewati Batas Waktu Pengembalian Akan Dikenakan Denda 25% dari Total Peminjaman,<br>Dan Kartu Identitas Anda Akan Kami Tahan Sebelum Melakukan Pembayaran Denda</p>";
                                   		 	}
                                   		 	else if ($sisaHari > 0 AND $hariH['status'] == 'Habis') {
                                   		 		$totalBayarPeminjaman = $ubahstatus['loan_total_fee'];
                                   		 		$denda = $totalBayarPeminjaman * 0.25;
                                   		 		$query_pembayaran_denda = mysql_fetch_array(mysql_query("SELECT * FROM trx_payment where loan_app_id_fk = '".$querystatuspembayaran['loan_app_id_fk']."' AND payment_category = 'PEMBAYARAN DENDA' AND payment_valid= 'MENUNGGU KONFIRMASI' "));

                                   		 		if ($query_pembayaran_denda['payment_category'] == 'PEMBAYARAN DENDA' and $query_pembayaran_denda['payment_valid'] == 'MENUNGGU KONFIRMASI') {
                                   		 			echo "<center><b>DATA PEMBAYARAN ANDA SEDANG KAMI PROSES</b></center>";
                                   		 		}else{
                                   		 		echo "
                                   		 		<div class='well'> <b> KETERANGAN :</b>
                                   		 		<p>Anda terlambat melakukan pengembalian alat selama <b>".$hariH['selisih']."</b> hari dihitung sejak tanggal jatuh tempo tanggal pengembalian yaitu pada tanggal <b>".$hariH['loan_date_return'].".</b> ";
                                   		 		echo "Anda dikenakan denda 
                                   		 		sebesar 25% per hari dari total pembayaran peminjaman. Jumlah denda yang harus Anda bayar adalah <b>Rp ".rupiah($total_denda = $denda * $hariH['selisih'])."</b>. Untuk dapat melakukan pengembalian alat dan pengambilan Kartu Identitas Anda diwajibkan membayar denda keterlambatan dan melakukan konfirmasi pembayaran melalui button dibawah ini..</p></div>
                                   		 		<a href='index.php?hal=pembayaran/pembayaran_denda&id=".$ubahstatus['loan_invoice']."' class='btn btn-warning btn-xl pull-right dim_about' >Konfirmasi Pembayaran Denda </a>";
                                   		 		} // else
                                   		 	}
                                   }
                                     ?>
                                   
			</p>
		</div>
	</div>

