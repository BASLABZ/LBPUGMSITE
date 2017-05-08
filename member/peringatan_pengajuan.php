<?php 
		$queryPerngatan_penagjuan  = mysql_query("SELECT count(loan_status) as peringatan_status,loan_status FROM trx_loan_application where member_id_fk = '".$_SESSION['member_id']."' and loan_status='ACC' order by loan_app_id DESC limit 1");
		$peringatan_status = mysql_fetch_array($queryPerngatan_penagjuan);
		$peringatan_status_acc = $peringatan_status['peringatan_status'];
		if ($peringatan_status_acc > 0) {			
 ?>
 <span class="label label-warning pull-right"><span class="fa fa-exclamation-triangle"></span> <?php echo $peringatan_status_acc; ?></span>
 <?php } ?>
