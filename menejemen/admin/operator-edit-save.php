<?php
error_reporting(0);
	include "../inc/inc-db.php";

	//$var_id = $_GET['id']; //method yg digunakan sesuai dg yg di request dr member.php

	//field yg dijemput yg akan di update
	
	$var_opid		= $_POST['frm_id'];
	$var_nama 		= $_POST['frm_nama'];
	$var_username 	= $_POST['frm_user'];
	$var_password 	= md5($_POST['frm_pass']);
	$var_hint		= $_POST['frm_hint'];
	$var_answer 	= $_POST['frm_answer'];
	

	$check = "SELECT operator_username from ref_operator where operator_username='".$var_username."' AND operator_id<>'".$var_opid."'";
	
	$sql = mysql_query($check); 
	$result = mysql_num_rows($sql);

	if ($result>0) { ?>
		<script type="text/javascript">alert('Opps, username yang anda input sudah terdaftar');
		document.location="operator-edit.php"</script>
		
	<?php	
	}

	else{
		$edit = "UPDATE ref_operator set operator_name='".$var_nama."', operator_username='".$var_username."', operator_password='".$var_password."' where operator_id='".$var_opid."'";
		$sql = mysql_query($edit); 
		?>
		<script type="text/javascript">alert('Data berhasil diperbarui!')
		document.location="operator.php"</script>
		<?php
	}
		
?>