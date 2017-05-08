<?php
error_reporting(0);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Forgot Password</title>
</head>
<body>
<div align="center" class="login-container">
		<form action="validasi-forgot-password.php" method="post">
			<table width="500" border="0" cellpadding="5" cellspacing="3">
				<tr>
					<td height="21" colspan="3" align="center">
						<strong>Forgot Password?</strong>
					</td>
				</tr>
			<tr>
				<td>Username</td>
				<td>:</td>
				<td><input type="text" name="frm_user" required/></td>
			</tr>
			<tr>
				<td>Pertayaan Sandi</td>
				<td>:</td>
				<td>
					<select name="frm_hintquestion">
							<option>Pilih</option>
							<option>Apa warna favorit anda?</option>
							<option>Apa makanan favorit anda?</option>
							<option>Siapa nama ayah kandung anda?</option>
							<option>Siapa nama penyanyi kesukaan anda?</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Jawaban Sandi</td>
				<td>:</td>
				<td><input type="text" name="frm_answerquestion" required/></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td><input type="submit" name="submit" value="submit"></td>
			</tr>
		</table>
</body>
</html>