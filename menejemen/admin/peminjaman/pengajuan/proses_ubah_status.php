<?php 
		
		$iddetail_instrumen = $_POST['instrument_id_fk'];
		$status = $_POST['status_loan'];
		$invoice = $_POST['loan_invoice'];
		$selisih = $_POST['selisih'];
		if ($status == 'ACC') {
			$queryambil_jumlah_quantity_temp = "SELECT sum(intrument_quantity_temp) as jumlahtersedia  FROM ref_instrument where instrument_id = '".$iddetail_instrumen."'";

			$runquery_qty_temp = mysql_fetch_array(mysql_query($queryambil_jumlah_quantity_temp));
			$total_qty_temp = $runquery_qty_temp['jumlahtersedia']+$selisih;
			$query_detail_status = mysql_query("SELECT loan_status_detail from trx_loan_application_detail where instrument_id_fk = '".$iddetail_instrumen."' AND loan_app_detail_id='".$_POST['loan_app_detail_id']."' ");
			$rowStatus_detail = mysql_fetch_array($query_detail_status);
			$status_loan_detail = $rowStatus_detail['loan_status_detail'];
			// query update intrument_quantity sebagai penguarang jumlah dan update status pinjam= booked dari proses loan_detail-> query saya jadikan satu
			if ($status_loan_detail == 'MENUNGGU') {
				$query = "UPDATE trx_loan_application_detail INNER JOIN ref_instrument 
							ON trx_loan_application_detail.instrument_id_fk = ref_instrument.instrument_id 
								SET trx_loan_application_detail.loan_status_detail = '".$status."',
									ref_instrument.intrument_quantity_temp = '".$total_qty_temp."' 
										where trx_loan_application_detail.loan_app_detail_id = '".$_POST['loan_app_detail_id']."' and ref_instrument.instrument_id = '".$_POST['instrument_id_fk']."'";
			
				$queryUpdateStatus = mysql_query($query);		
				echo "<script>  location.href='index.php?hal=peminjaman/pengajuan/pengajuan_detail&invoice=".$invoice."' </script>";exit;
			}else if ($status_loan_detail == 'ACC') {
				echo "<script> alert('Anda Telah Merubah Status Menjadi ACC');  location.href='index.php?hal=peminjaman/pengajuan/pengajuan_detail&invoice=".$invoice."' </script>";exit;
			}
			
		}else if ($status == 'MENUNGGU') {


			$queryambil_jumlah_quantity_temp_menunggu = "SELECT sum(intrument_quantity_temp) as jumlahtersedia  FROM ref_instrument where instrument_id = '".$iddetail_instrumen."'";

			$runquery_qty_temp_menunggu = mysql_fetch_array(mysql_query($queryambil_jumlah_quantity_temp_menunggu));
			$total_qty_temp_menunggu = $runquery_qty_temp_menunggu['jumlahtersedia']-$selisih;
			$query_detail_status_menunggu = mysql_query("SELECT loan_status_detail from trx_loan_application_detail where instrument_id_fk = '".$iddetail_instrumen."' AND loan_app_detail_id='".$_POST['loan_app_detail_id']."' ");
			$rowStatus_detail_menunggu = mysql_fetch_array($query_detail_status_menunggu);
			$status_loan_detail_menunggu = $rowStatus_detail_menunggu['loan_status_detail'];


			$querymenunggu = "UPDATE trx_loan_application_detail INNER JOIN ref_instrument 
							ON trx_loan_application_detail.instrument_id_fk = ref_instrument.instrument_id 
								SET trx_loan_application_detail.loan_status_detail = '".$status."',
									ref_instrument.intrument_quantity_temp = '".$total_qty_temp_menunggu."' 
										where trx_loan_application_detail.loan_app_detail_id = '".$_POST['loan_app_detail_id']."' and ref_instrument.instrument_id = '".$_POST['instrument_id_fk']."'";
			
			$queryUpdateStatusmenunggu = mysql_query($querymenunggu);	
			echo "<script>  location.href='index.php?hal=peminjaman/pengajuan/pengajuan_detail&invoice=".$invoice."' </script>";exit;



		}else if ($status == 'DITOLAK') {

				$reject_note = $_POST['reject_note'];
			 	$cek = $_POST['cek'];
			 	$idDetail_loans = $_POST['loan_app_detail_id'];
			 	$idPeminjaman = $_POST['loan_app_id_fk'];



			 	$insertPenawarans = "INSERT INTO trx_rejected(loan_app_detail_id_fk,instrument_id_fk,rejected_text) VALUES ('".$idDetail_loans."','".$iddetail_instrumen."','".$reject_note."')";
			 		$querys = mysql_query($insertPenawarans);
			 	 	$queryAmbil_idreject = "SELECT rejected_id from trx_rejected where loan_app_detail_id_fk = '".$idDetail_loans."'  AND instrument_id_fk='".$iddetail_instrumen."'";
						 	 $rowIDreject = mysql_fetch_array(mysql_query($queryAmbil_idreject));
						 	 $idreject = $rowIDreject['rejected_id'];
						 	 
			 	 		// detail reject dengan alat yang ditawarkan
						$queryInsert_detail_reject = mysql_query("INSERT INTO trx_rejected_detail
															 (rejected_id_fk,instrument_id_rejected_fk,rejected_detail_loan_amount,rejected_detail_loan_subtotal) 
															 VALUES
															 ('".$idreject."','".$cek."',
															 '1','".$_POST['instrument_fee']."')");
			 	
            
			$update_detail_loan = "UPDATE trx_loan_application_detail SET loan_status_detail='DITOLAK'  WHERE loan_app_detail_id = '".$idDetail_loans."' AND instrument_id_fk='".$iddetail_instrumen."'";
			$run_query_update_status = mysql_query($update_detail_loan);
			 
			 if ($run_query_update_status) {
			 	echo "<script>alert ('Data berhasil disimpan'); location.href='index.php?hal=peminjaman/pengajuan/penawaran&rejected_id=".$idreject."'</script>";
			 }
		}
 ?>