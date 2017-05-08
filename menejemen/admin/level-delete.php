<?php
	include "../inc/inc-db.php";

	$var_id = ($_GET['id']); 

	$hapus 	= "DELETE from ref_level where level_id='".$var_id."'";
	$run	= mysql_query($hapus);?>

	<script type="text/javascript">alert('Data berhasil dihapus!');
	document.location="bs-level.php"</script>

	
