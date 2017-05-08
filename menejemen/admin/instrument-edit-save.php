<?php
	error_reporting(0);
	include '../inc/inc-db.php'; 
	// menangkap value yg dikirim dr form
	$var_id 		= $_POST['frm_id']; 
	$var_name 		= $_POST['frm_nama'];
	$var_brand		= $_POST['frm_merk'];
	$var_qtty		= $_POST['frm_jumlah'];
	$var_fee		= $_POST['frm_harga'];
	$var_desc		= $_POST['frm_spek'];
	$var_length		= $_POST['frm_panjang'];

	$check 	= "SELECT instrument_id, instrument_name, instrument_brand, instrument_quantity, instrument_fee, instrument_description, instrument_length, instrument_picture FROM ref_instrument WHERE instrument_id !='".$var_id."'";
	$runcheck = mysql_query($check);
	$checkRow = mysql_num_rows($runcheck); 


	$var_folder='../image/'; // folder penyimpanan file
	$var_fileType= array('jpg','jpeg','png','gif'); //tipe file yang bisa diupload
	$var_maxSize=5000000; //standar ukuraan maksimum untuk file yg bisa diupload

	// menangkap nama dan ukuran file dr ins edit
	$var_fileName=$_FILES['frm_picture']['name'];
	$var_fileSize=$_FILES['frm_picture']['size'];


	//cari extensii file dengan fungsi explode
	$var_explode=explode('.', $var_fileName);
	//--buat menjadi huruf kecil semua
	$var_extensi=strtolower($var_explode[count($var_explode)-1]); //
	$var_picture=$var_fileName;
	

	if (isset($_POST['btn_simpan']) or $_POST['btn_simpan']!='' or $_POST['frm_picture']!='') {

		if ($var_fileName!="") { ?>
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

					$update ="UPDATE ref_instrument set instrument_name='".$instrument_name."', instrument_brand='".$var_brand."', instrument_quantity='".$var_qtty."', instrument_fee='".$var_fee."', instrument_description='".$var_desc."', instrument_length='".$var_length."', instrument_picture='".$var_picture."' where instrument_id='".$var_id."'";

					$runSave = mysql_query($save); ?>
					<script type="text/javascript">alert('Data berhasil disimpan!');document.location="instrument.php"</script><?php		 
			} // insert
	} //else
} //isset
?>