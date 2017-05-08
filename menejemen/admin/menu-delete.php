<?php
error_reporting(0);
	include "../inc/inc-db.php";

	$var_id = ($_GET['id']); 

	$delete = "DELETE from ref_menu where menu_id='".$var_id."'";
	$sql = mysql_query($delete);?>
	<script type="text/javascript">alert('Data berhasil dihapus!');
	document.location="menu.php"</script>
