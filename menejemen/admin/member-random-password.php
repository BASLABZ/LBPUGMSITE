<?php
include '../inc/inc-db.php';
error_reporting(0);

	$character	= "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWQYZ1234567890";
	$len 		= strlen($character); // utk mengetahui panjang karakter


	$var_id 	= $_GET['id'];
	$var_status = $_GET['status'];
	if(isset($var_id) && isset($var_status)){
		if($var_status=="Y"){
			$var_password = mt_rand($len). "\n";

			$update 	= "UPDATE tbl_member set member_status='Y', member_password='".$var_password."' where 
						   member_id='".$var_id."'";
						   // echo $update;
						   // exit();
			$runupdate	= mysql_query($update);
		} // tutup if
		else  {
			$update 	= "UPDATE tbl_member set member_status='N' where member_id='".$var_id."'";
			$runupdate	= mysql_query($update);
		} // tutup else
	header("location: member.php?init=$var_status");
	} // tutup isset

	// function randpass ($length){
	// 	//karakter yg bisa digunakan sebagai password
	
	// 	// menggenerate password
	// 	for ($i=1; $i <= $length ; $i++) { 
	// 	$pos = mt_rand(0, ($len)-1);
	// 	$string .= $character {$pos};
	// 	} // tutup for

	// 	return $string;
	// } // tutup function

	// $save = "UPDATE tbl_member set member_password="
?>