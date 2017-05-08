<?php 
		include '../menejemen/inc/inc-db.php';
		$email = $_POST['email'];
		$pertanyaan = $_POST['member_hint_question'];
		$jawaban = $_POST['member_answer_question'];

		
		$querycekakun  = mysql_query("SELECT * FROM tbl_member where member_email='".$email."' and member_answer_question='".$jawaban."' and member_hint_question='".$pertanyaan."'");
		$runquery = mysql_fetch_array($querycekakun);
		$id = $runquery['member_id'];

		if ($id != '') {
			$eny  = $runquery['member_name'];
			$passwordbaruhasil = substr($eny, 2);
			$newpassword = md5($passwordbaruhasil);
			  $queryUpdatePassword = mysql_query("UPDATE tbl_member set member_password='".$newpassword."' where member_email='".$email."'");
			  echo "<script> alert('Anda Berhasil Reset Password, Silahkan Cek Email'); location.href='reset/sendEmailDebug.php?email=".$email."&member_hint_question=".$pertanyaan."&member_answer_question=".$jawaban."' </script>";exit;
		}else{
			 echo "<script> alert('Maaf Data Anda Tidak Ada'); location.href='../../index.php' </script>";exit;
		}
		

 ?>