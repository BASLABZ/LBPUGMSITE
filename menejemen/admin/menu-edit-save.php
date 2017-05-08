<?php
error_reporting(0);
	include "../inc/inc-db.php";

	//field yg dijemput yg akan di update
	$var_id		= $_POST['frm_id'];
	$var_nama	= $_POST['frm_menu'];
	$var_link 	= $_POST['frm_url'];
	$var_parent	= $_POST['frm_parent'];
	// echo $var_parent."<br/>";

	$check = "SELECT menu_id from ref_menu where menu_name='".$var_nama."' 
	AND menu_url='".$var_link."' AND menu_id <>'".$var_id."'";
	$sql = mysql_query($check);
	$result = mysql_num_rows($sql);


	if ($result>0) { ?> 
	<script type="text/javascript">alert('Opps, menu yang anda input sudah terdaftar!');
	document.location="menu-edit.php"</script> <?php
	exit();	
	}

	else{
		$edit = "UPDATE ref_menu set menu_name='".$var_nama."', 
		menu_url='".$var_link."', menu_parent='".$var_parent."'
		where menu_id='".$var_id."'";
		// echo $edit;
		// exit();
		$runedit = mysql_query($edit); ?>
		
		<script type="text/javascript">alert('Data berhasil diperbaharui!');
		document.location="menu.php"</script> <?php

	}
?>
