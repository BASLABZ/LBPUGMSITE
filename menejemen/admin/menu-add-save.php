<?php
	error_reporting(0);
	include '../inc/inc-db.php'; //memanggil file agar terhubung ke server

	//tangkap data dr form
	$var_id 		= $_POST['frm_id']; // menangkap value yg dikirim dr form
	$var_nama 		= $_POST['frm_menu'];
	$var_link 		= $_POST['frm_link'];
	$var_parent		= $_POST['frm_parent'];
	

	$var_len = strlen($var_nama);//menghitung jumlah karakter

	// utk mengambil dan mencocokkan inputan&data di database
	$check 	="SELECT menu_id from ref_menu where menu_name = '".$var_nama."' AND menu_url='".$var_link."' "; // permintaan
	$result = mysql_query($check); // menampung eksekusi
	$jumlah_baris = mysql_num_rows($result);
	

		if ($var_nama==""){ ?>
			<script type="text/javascript">alert('Nama menu tidak boleh kosong!');
			document.location='menu.php'</script>
			
		<?php
		}
		//utk mengecek jumlah record (>0=jangan disimpan jika lebih dr 0-username lebih dr 1)
		elseif ($jumlah_baris>0) {  ?>
			<script type="text/javascript">alert('Maaf, nama menu yang anda gunakan sudah terdaftar!');
			document.location='menu.php'</script>
		<?php
		}
		
		else{
			//menyimpan data ke database
			// mysql_query: utk menjalankan script sql
			$simpan ="INSERT INTO ref_menu (menu_name, menu_url, menu_parent) values ('$var_nama','$var_link','$var_parent')";
				//nama field tidak boleh dipetik
				//utk mengecek query, buat fungsi echo $simpan
		
			$hasil = mysql_query($simpan); ?>
				<script type="text/javascript">alert('Data berhasil disimpan!');
				document.location='menu.php'</script>	
				<?php			
			}

?>

