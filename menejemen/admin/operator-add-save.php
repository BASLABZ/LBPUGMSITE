<?php
	error_reporting(0);
	include '../inc/inc-db.php'; 
	

	//tangkap data dr form
	// menangkap value yg dikirim dr form
	$var_id			= $_POST['frm_id'];
	$var_nama 		= $_POST['frm_nama']; 
	$var_jk			= $_POST['frm_jk'];
	$var_user		= $_POST['frm_user'];
	$var_password	= $_POST['frm_pass'];
	$var_hint		= $_POST['frm_hint'];
	$var_answer		= $_POST['frm_answer'];
	$var_level		= $_POST['frm_level'];

	$var_pass = strlen($var_password);//menghitung jumlah karakter

	// utk mengambil dan mencocokkan inputan&data di database
	$tampil ="SELECT operator_id, operator_name, operator_gender, operator_username, operator_password, operator_login,
			 operator_hint_question, operator_answer_question, level_id_fk 
			 from ref_operator where operator_username = '".$var_user."' "; // permintaan
	$sql 	= mysql_query($tampil); // menampung eksekusi
	$baris 	= mysql_num_rows($sql);
	
		// or:agar jika salah satu u/p kosong
		if ($var_pass=="" || $var_user=="") { ?>
			<script type="text/javascript">alert('Username dan Password tidak boleh kosong!');
			document.location='operator.php'</script>
			
		<?php
		}
		elseif ($var_pass <6) { ?>
			<script type="text/javascript">alert('Password minimal 6 karakter!');
			document.location="operator.php"</script>

		<?php
		}
		elseif ($var_pass >8) { ?>
			
			<script type="text/javascript">alert('Password tidak boleh lebih dari 8 karakter!');
			document.location="operator.php"</script> <?php
		}
		
		// >0 -- > data sudah ada sebelumnya
		elseif ($baris>0) { ?>
			
			<script type="text/javascript">alert('Username yang anda input sudah terdaftar!');
			document.location="operator.php"</script> <?php
		}
		
		else{
			//menyimpan data ke database
			// mysql_query: utk menjalankan script sql
			$save ="INSERT INTO ref_operator (operator_name, operator_gender, operator_username, operator_password, operator_login, operator_hint_question, operator_answer_question, level_id_fk) 
					values ('$var_nama','$var_jk','$var_user', md5('$var_password'),'N','$var_hint','$var_answer','$var_level')";
			$runsave = mysql_query($save);	?>

			<script type="text/javascript">alert('Data berhasil ditambahkan');
			document.location="operator.php"</script> <?php	
			
			}

?>