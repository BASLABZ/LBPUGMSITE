<?php 
		$loan_app_id_fk = $_POST['loan_app_id_fk'];
		$tanggalharusdikembalikan = jin_date_sql($_POST['tanggalharusdikembalikan']);
		$querypengembalian = mysql_query("INSERT INTO trx_return (loan_app_id_fk,return_date_input,return_date)
		 									VALUES ('".$loan_app_id_fk."',NOW(),'".$tanggalharusdikembalikan."')") ;
		$queryupdatepengembalian = mysql_query("UPDATE  trx_loan_application set loan_status = 'DIKEMBALIKAN' where loan_app_id = '".$loan_app_id_fk."'");
		if ($queryupdatepengembalian) {
			echo "<script>location.href='index.php?hal=pengembalian/list';</script>  ";exit; 
		}
 ?>