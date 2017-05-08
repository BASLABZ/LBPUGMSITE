<?php
error_reporting(0);
	include '../inc/inc-db.php';

	$var_levelid = ($_GET['id']);
	

	//$jumlah = 0; // kondisi normal ketika blm memilih (nol), utk mengecek yg dicentang

	// record dibersihkan dulu agar tidak terjadi penyimpanan ganda ketika henda di-update
	$bersih = "DELETE FROM ref_level_menu WHERE level_id='".$var_levelid."'";
	$runbersih = mysql_query($bersih);

	//menampilkan menu sesuai database
	$show = "SELECT menu_id, menu_name, menu_parent from ref_menu";
	$runshow = mysql_query($show);
	$runshowcheck = mysql_num_rows($runshow);

	 for($i=1; $i<=$runshowcheck; $i++){ // menampilkan menu
	 	$menu = ($_POST['menu'.$i]); // menampilkan menu1, menu2, menu

   	 if($menu!=''){ // jika $menu tidak kosong
   	 	//$jumlah++; // maka $jumlah diincrementkan utk menampilkan menu1, menu2 dan menu3	 

		
			$save = "INSERT into ref_level_menu (level_id, menu_id) VALUES ('$var_levelid','$menu')";
			
			$sql = mysql_query($save); 
			?>
			<script type="text/javascript">alert('Selamat, anda berhasil!');
			document.location="level.php"</script> <?php
	}
} 	
	if ($jumlah==0) { ?> 
	<script type="text/javascript">alert('Maaf, anda harus memilih fasilitas!');
	document.location="level-menu-edit.php"</script> 
	<?php	
	}
?>