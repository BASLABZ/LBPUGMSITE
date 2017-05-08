<?php
error_reporting(0);
	include "../inc/inc-db.php";

	$var_id = ($_GET['id']); 

	$hapus = "DELETE from ref_instrument where instrument_id='".$var_id."'";
	$run = mysql_query($hapus); ?>

	<script type="text/javascript">alert('Data berhasil dihapus!');
	document.location="instrument.php"</script>
