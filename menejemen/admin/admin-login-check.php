<?php
error_reporting(0);
include '../inc/inc-db.php';

session_start();

$var_user 		= ($_POST['frm_user']);
$var_password	= md5($_POST['frm_password']); //password fi form maupun didatabase harus di md5

$tampil	= "SELECT operator_username, operator_password, operator_name, operator_id, ref_level.level_id, level_name FROM ref_operator";
$tampil	= $tampil  . " left join ref_level on ref_level.level_id=ref_operator.level_id_fk"; //sql=sql: perintah utk melanjutkan syntax diatas(utk memotong) agar tiak terlalu panjang
$tampil	= $tampil  . " WHERE operator_username='".$var_user."' AND operator_password='".$var_password."' "; 
$sql	= mysql_query($tampil); //menjalankan perintah sql
$ambil	= mysql_fetch_array($sql); //utk mengambil data
$baris	= mysql_num_rows($sql); // utk menghitung baris pada tabel di database
if($baris==0){ // jika data yg diinput tidak sesuai(tidak ada dlm databse=0) maka 
	header("location:login-form.php?init=failed"); //mengarahkan kembali lg ke form login
	//echo "maad login anda gagal!";

}
else
{
	$_SESSION['opId']		= $ambil['operator_id']; //
	$_SESSION['levelId']	= $ambil['level_id'];
	$_SESSION['levelName']	= $ambil['level_name'];
	$_SESSION['userName']	= $ambil['operator_username'];
	$_SESSION['login_time'] = date('Y-m-d');
	header("location:admin-area.php");
	
}
?>