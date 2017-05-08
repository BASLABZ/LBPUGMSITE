<?php
	error_reporting(0);
	include '../inc/inc-db.php'; //memanggil file agar terhubung ke server

	//tangkap data dr form
	$var_id 		= $_POST['frm_id']; // menangkap value yg dikirim dr form
	$var_nama 		= $_POST['frm_nama'];
	$var_kategori	= $_POST['frm_kategori'];
	$var_ins		= $_POST['frm_instansi'];
	$var_prodi		= $_POST['frm_prodi'];
	$var_tempat		= $_POST['frm_tempat'];
	$var_tahun		= $_POST['frm_tahun'];
	$var_bulan		= $_POST['frm_bulan'];
	$var_tanggal	= $_POST['frm_tanggal'];
	$var_jk			= $_POST['frm_jk'];
	$var_telf		= $_POST['frm_telf'];
	$var_email		= $_POST['frm_mail'];
	$var_alamat		= $_POST['frm_alamat'];
	$var_user		= $_POST['frm_user'];
	
	
	$var_lahir 		= $var_tahun."-".$var_bulan."-".$var_tanggal;

	$var_error=0;
	$save_file=true;
	$var_folder='../upload/';
	//tentuan tipe file yang bisa diupload :
	$var_fileType= array('jpg','jpeg','png','gif');
	//buat standar ukuraan maksimum untuk file yg bisa diupload
	$var_maxSize=500000; //1/2mb untuk foto

	//proses data
	//if(isset($_POST['btn_submit'])){
	$var_fileName=$_FILES['frm_picture']['name'];
	$var_fileSize=$_FILES['frm_picture']['size'];

	//cari extensii file dengan fungsi explode
	$var_explode=explode('.',$var_fileName);
	//--buat menjadi huruf besar semua
	$var_extensi=strtoupper($var_explode[count($var_explode)-1]); //
	$var_picture=$var_fileName;
	//echo  $var_extensi;
	//--cek apakah tipe file sesuai yang diijinkan
	 if($var_extensi!='JPG' && $var_extensi!='JPEG' && $var_extensi!='PNG' && $var_extensi!='GIF'){
	 	$var_error=1;
	 	$save_file=false;
	 }
	 else{
		//--Check melebihi kapasitas atau tidak
		 if($var_fileSize > $var_maxSize){
		 	$var_error=2;
		 	$save_file=false;
		 }
		 else{
			$var_error=0;
			$save_file=true;	
		}		
	}
	
	 if(!$save_file && $var_error==1){
	 	echo "Format file tidak sesuai<br>";
	 	echo "<a href=javascript:history.back()>Ulangi</a>"; //utk kembali 1 level ke form agar inputan yg belum disimpan tidak hilang
	 } 
	 else
	 {
		 if(!$save_file && $var_error==2){
		 	echo "Ukuran file tidak sesuai<br>";
		 	echo "<a href=javascript:history.back()>Ulangi</a>";
		 }
		else{
			if($save_file && $var_error==0){
				date_default_timezone_set('Asia/Jakarta'); //setting waktu
    			if(move_uploaded_file($_FILES['frm_picture']['tmp_name'], $var_folder.$var_fileName)){	
	

	$simpan ="INSERT INTO tbl_member (member_name, category_id_fk, member_institution, member_faculty, member_birth_place, 
			  member_birth_date, member_gender, member_phone_number, member_email, member_address, member_username, 
			  member_password, member_idcard_photos, member_status, level_id_fk) values 
			 	('$var_nama','$var_kategori','$var_ins','$var_prodi','$var_tempat','$var_lahir','$var_jk',
				'$var_telf','$var_email','$var_alamat','$var_user','','$var_picture','N','4')";

				//nama field tidak boleh dipetik
				//utk mengecek query, buat fungsi echo $simpan
			$hasil = mysql_query($simpan);		
				echo "Data has been saved!";
			}
		} // tutup if
	} // tutup else
 }			
				
			
?>