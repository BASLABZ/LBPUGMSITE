<?php 
		$id = $_POST['invoice'];
		$query  = mysql_query("UPDATE trx_loan_application set loan_status = 'DIPINJAM' where loan_invoice='".$id."' ");
		echo "<script>location.href='index.php?hal=pengambilan/list';</script>  ";exit; 

 ?>