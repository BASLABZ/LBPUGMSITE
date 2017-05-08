<?php
	// error_reporting(0);
	include '../inc/inc-db.php'; //memanggil file agar terhubung ke server

	//tangkap data dr form
	$var_id 		= $_POST['frm_id']; // menangkap value yg dikirim dr form
	$var_name 		= $_POST['frm_nama'];
	$var_brand		= $_POST['frm_merk'];
	$var_qtty		= $_POST['frm_jumlah'];
	$var_fee		= $_POST['frm_harga'];
	$var_length		= $_POST['frm_panjang'];
	$var_weight		= $_POST['frm_berat'];
	$var_desc		= $_POST['frm_spek'];
	


	$var_folder='../image/';
	//tentuan tipe file yang bisa diupload :
	$var_fileType= array('jpg','jpeg','png','gif');
	//buat standar ukuraan maksimum untuk file yg bisa diupload
	$var_maxSize=5000000; //1/2mb untuk foto

	//proses data
	//if(isset($_POST['btn_submit'])){
	$var_fileName=$_FILES['frm_picture']['name'];
	$var_fileSize=$_FILES['frm_picture']['size'];
	// echo $var_fileName;
	

	//cari extensii file dengan fungsi explode
	$var_explode=explode('.', $var_fileName);
	//--buat menjadi huruf besar semua
	$var_extensi=strtolower($var_explode[count($var_explode)-1]); //
	// exit();
	$var_picture=$var_fileName;
	// echo  $var_extensi;
	// exit();
	//--cek apakah tipe file sesuai yang diijinkan

	if (isset($_POST['btn_simpan']) or $_POST['btn_simpan']!='') {

		if ($var_fileName=="") { ?>
            <script type="text/javascript">alert('Silahkan upload gambar alat terlebih dahulu!');history.go(-1);</script> <?php
           
       } 

		elseif (!in_array($var_extensi, $var_fileType)){ ?>
		<script type="text/javascript">alert('Maaf, ekstensi file anda tidak sesuai!');history.go(-1);</script><?php
		 
		} //if 
	
		elseif 
			//--Check melebihi kapasitas atau tidak
			($var_fileSize > $var_maxSize){ ?>
			<script type="text/javascript">alert('Ukuran file terlalu besar!');history.go(-1);</script> <?php
	

		} //elseif
	
		else{  
				//salah==============================
				 date_default_timezone_set('Asia/Jakarta'); //setting waktu


    			if(move_uploaded_file($_FILES['frm_picture']['tmp_name'], $var_folder.$var_fileName)) {	

					$save ="INSERT INTO ref_instrument (instrument_name, instrument_brand, instrument_quantity, instrument_fee, 
					instrument_description, instrument_length, instrument_weight, instrument_picture) values 
					('$var_name','$var_brand','$var_qtty','$var_fee','$var_desc','$var_length','$var_weight','$var_picture')";

					$runSave = mysql_query($save); ?>
					<script type="text/javascript">alert('Data berhasil disimpan!');document.location="instrument.php"</script><?php		 
			} // insert
	} //else
} //isset
?>