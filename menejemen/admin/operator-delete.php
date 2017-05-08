<?php
	include "../inc/inc-db.php";

	$var_id = ($_GET['id']); 

	$delete = "DELETE from ref_operator where operator_id='".$var_id."'"; 
	$sql = mysql_query($delete); ?>
	
	<script type="text/javascript">alert('Data berhasil dihapus!');
	document.location="operator.php"</script>

?>