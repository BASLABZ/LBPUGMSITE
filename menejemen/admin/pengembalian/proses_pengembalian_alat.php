<?php 
		$loan_app_id_fk = $_POST['loan_app_id_fk'];
		$tanggalharusdikembalikan = jin_date_sql($_POST['tanggalharusdikembalikan']);
		
		// $querypengembalian = "INSERT INTO trx_return (loan_app_id_fk,return_date_input,return_date)
		//  									VALUES ('".$loan_app_id_fk."',NOW(),'".$tanggalharusdikembalikan."')";
		// $queryupdatepengembalian = "UPDATE  trx_loan_application set loan_status = 'DIKEMBALIKAN' where loan_app_id = '".$loan_app_id_fk."'";

		$queryDetailPeminjaman = "SELECT count(*) as count_alat  FROM trx_loan_application_detail a JOIN ref_instrument r ON a.instrument_id_fk = r.instrument_id WHERE a.loan_app_id_fk = '".$loan_app_id_fk."'";
		$runExDetailPeminjaman = mysql_fetch_array(mysql_query($queryDetailPeminjaman));
		$banyak  = $runExDetailPeminjaman['count_alat'];

		$query = mysql_query("SELECT *  FROM trx_loan_application_detail a JOIN ref_instrument r ON a.instrument_id_fk = r.instrument_id WHERE a.loan_app_id_fk = '".$loan_app_id_fk."'");

		while ($x = mysql_fetch_array($query)) {
			 $jumlah_dipinjam = $x['loan_amount'];
			 $instrument_temp = $x['intrument_quantity_temp'];
			   $pengurangan_temp = $instrument_temp - $jumlah_dipinjam;
			  $querys= mysql_query("UPDATE ref_instrument set intrument_quantity_temp = '".$pengurangan_temp."' where instrument_id = '".$x['instrument_id_fk']."'");
		}
		$querypengembalian = mysql_query("INSERT INTO trx_return (loan_app_id_fk,return_date_input,return_date)
		 									VALUES ('".$loan_app_id_fk."',NOW(),'".$tanggalharusdikembalikan."')") ;
		$queryupdatepengembalian = mysql_query("UPDATE  trx_loan_application set loan_status = 'DIKEMBALIKAN' where loan_app_id = '".$loan_app_id_fk."'");

		if ($queryupdatepengembalian) {
			echo "<script>location.href='index.php?hal=pengembalian/list';</script>  ";exit; 
		}
 ?>