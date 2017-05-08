<?php
	error_reporting(0);
	include '../inc/inc-db.php'; //memanggil file agar terhubung ke server

	//tangkap data dr form
	// menangkap value yg dikirim dr form
	$var_id 		= $_POST['frm_id']; 
	$var_nama 		= $_POST['frm_level'];
	

	$var_pass = strlen($var_nama);//menghitung jumlah karakter

	// utk mengambil dan mencocokkan inputan&data di database
	$tampil ="SELECT level_id from ref_level where level_name = '".$var_nama."' "; // permintaan
	$run1 	= mysql_query($tampil); // menampung eksekusi
	$baris	= mysql_num_rows($run1); // mengetahui jumlah baris
	

		if ($var_nama==""){ ?>
			<script type="text/javascript">alert('Nama level tidak boleh kosong!');
			history.go(-1);</script> <?php
		}
		elseif ($baris>0) {  //utk mengecek jumlah record (>0=jangan disimpan jika lebih dr 0-username lebih dr 1)
		?>
			<script type="text/javascript">alert('Maaf, Nama level yang anda gunakan sudah terdaftar!');history.go(-1);</script> <?php		
		}
		
		else{
			//menyimpan data ke database
			//mysql_query: utk menjalankan script sql
			//utk mengecek query, buat fungsi echo $simpan	
			$simpan	="INSERT INTO ref_level (level_name) values ('$var_nama')"; //nama field tidak boleh dipetik
			$run2	= mysql_query($simpan);	?>
				<script type="text/javascript">alert('Data berhasil disimpan!');
				document.location="level.php"</script> <?php
						
			}

?>
<p><a href="level.php">View Data</a></p>
