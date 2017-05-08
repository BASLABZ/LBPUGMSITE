<?php  
				$id = $_POST['instrument_id'];
				$kembalikan_alat = $_POST['intrument_quantity_temp'];
				$queryTampil   = mysql_query("SELECT * ref_instrument where instrument_id = '".$id."'");
				$rowTampil  = mysql_fetch_array($queryTampil);
				$jumlahsementara = $rowTampil['intrument_quantity_temp'];
				$jumlahDikembalikan = $jumlahsementara-$kembalikan_alat;
				$query = mysql_query("UPDATE ref_instrument set intrument_quantity_temp='".$jumlahDikembalikan."' where instrument_id='".$id."'");
				$query_Update = mysql_query("UPDATE trx_loan_application set loan_status='DIKEMBALIKAN' 
													where loan_app_id='".$idloan."'  ");
					$query_Update_kembali = mysql_query("UPDATE trx_loan_application_detail set loan_status='DIKEMBALIKAN' 
													where loan_app_id='".$idloan."'  ");
							
 ?>