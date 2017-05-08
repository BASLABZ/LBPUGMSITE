<?php
	$kode = $_GET['kode'];
	$username = $_GET['username'];

	$koneksi=mysql_connect('localhost','root','');
	mysql_select_db('penyewaan',$koneksi);

	$query = mysql_query("UPDATE tbl_member set member_status ='Actived' where kode='".$kode."'") or die (mysql_error());

	if($query) {
		echo "Member dengan username <strong>".$username."</strong> telah diaktifkan";
	} else {
		echo "Gagal diaktifkan";
	}
?>