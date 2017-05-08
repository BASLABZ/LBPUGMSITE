<?php 
	$status = $_POST['payment_valid'];
	$id = $_POST['idpayment'];
	$keterangan  = $_POST['payment_notif'];
	$queryPay = mysql_query("SELECT * FROM trx_payment where payment_id = '".$id."'");
	$runqu = mysql_fetch_array($queryPay);
	$idmember = $runqu['member_id_fk'];
	$loan_app_id = $runqu['loan_app_id_fk'];
	$selectQuery = mysql_query("SELECT * FROM tbl_member where member_id = '".$idmember."'");
            $runq = mysql_fetch_array($selectQuery);
            $email = $runq['member_email'];
	if ($status == 'TIDAK VALID') {
		$query_update_tidak_valid = "UPDATE trx_payment set payment_notif = '".$keterangan."', payment_valid='".$status."' where payment_id='".$id."'";
		$runQuery_tidak_valid = mysql_query($query_update_tidak_valid);
		  echo "<script>  location.href='pembayaran/SENDEMAIL/sendEmailDebug.php?loan_app_id=".$loan_app_id."&email=".$email."' </script>";exit;
	}else if ($status == 'VALID') {
		$query_update_valid = "UPDATE trx_payment set payment_valid='".$status."' where payment_id='".$id."'";
	$runQuery_valid = mysql_query($query_update_valid);
	  echo "<script>  location.href='pembayaran/SENDEMAIL/sendEmailDebug.php?loan_app_id=".$loan_app_id."&email=".$email."' </script>";exit;
	}else if ($status == 'MENUNGGU KONFIRMASI') {
		$query_update_menunggu = "UPDATE trx_payment set  payment_valid='".$status."' where payment_id='".$id."'";
		$runQuery_menunggu = mysql_query($query_update_menunggu);
		  echo "<script>  location.href='pembayaran/SENDEMAIL/sendEmailDebug.php?loan_app_id=".$loan_app_id."&email=".$email."' </script>";exit;
	}
	
 ?>