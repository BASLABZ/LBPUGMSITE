<?php

// load query database

$email = $_GET['email'];
$pertanyaan = $_GET['member_hint_question'];
$jawaban = $_GET['member_answer_question'];
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
	<p>Konfirmasi Reset Password </p>
	<?php 
		$querymember  = mysql_query("SELECT * FROM tbl_member where member_email='".$email."' and member_answer_question='".$jawaban."' and member_hint_question='".$pertanyaan."'");
		$row  = mysql_fetch_array($querymember);
		$id = $row['kode'];
	 ?>
	 <h3>Email : <?php echo $row['member_email']; ?></h3>
	 <h3>Password Baru : <?php echo substr($row['member_name'], 2); ?></h3>
</body>
</html>