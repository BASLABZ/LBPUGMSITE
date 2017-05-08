<?php

// load query database
$ency = $_GET['id'];
$email = $_GET['email'];
// $id = base64_decode($ency);

$querymember  = mysql_query("SELECT member_email,kode from tbl_member where member_email='".$email."'");
$row  = mysql_fetch_array($querymember);
$id = $row['kode'];
$emails = $row['member_email'];

 ?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
	<center><h3>Laboratorium Bioantropologi 
				Paleantropologi LBP
				Universitas Gajah Mada [LBP-UGM]
			</h3>
	</center>
	<p>Terima Kasih Telah Bergabung Dengan Kami </p>
	<p>untuk <b>Aktifasi</b> Silahkan Klik Link Berikut <a href="http://localhost/LBPUGM/member/SENDEMAIL/konfirmasi.php?id=<?php echo $id; ?>&email=<?php echo $emails; ?>">Aktifasi Akun</a> </p>
</body>
</html>