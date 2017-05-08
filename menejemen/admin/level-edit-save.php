<?php
error_reporting(0);
	include "../inc/inc-db.php";

	//field yg dijemput yg akan di update
	$var_id = $_POST['id'];
	$var_nama = $_POST['frm_level'];

	

	$tampil = "SELECT level_name from ref_level where level_name='".$var_nama."'";
	$run1 	= mysql_query($tampil);
	$baris	= mysql_num_rows($run1);



	if ($baris>0) { ?>
	<script type="text/javascript">alert('Opps, pangkat tidak boleh sama!');
	document.location="level-edit.php</script> <?php
	 
	}

	else{
		$edit 	= "UPDATE ref_level set level_name='".$var_nama."' where level_id='".$var_id."'";
		$run2	= mysql_query($edit); ?>
		<script type="text/javascript">alert('Data berhasil diperbarui');document.location="level.php"</script>
	}
?>
