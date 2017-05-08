<?php 
	error_reporting(0);
	session_start();

	function pagging($count) {
		$tampil = $_SESSION['tampil'];
		$limit = $_SESSION['limit'];
		
			$runpagging = mysql_query($tampil);
			$jum_rec = mysql_num_rows($runpagging);
			$_SESSION['jum_rec'] = $jum_rec;
		
		$count = ceil($jum_rec/$limit);
		$_SESSION['newtampil'] = $tampil; //bikin tampil baru yg sesuai persyaratan
		return $count;
	}
unset($_SESSION['tampil']);
unset($_SESSION['limit']);
unset($_SESSION['jum_rec']);
unset($_SESSION['newtampil']);

?>