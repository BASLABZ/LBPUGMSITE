<?php
	$querySaldo = mysql_query("SELECT sum(saldo_total) as total_saldo FROM trx_saldo where member_id_fk='".$_SESSION['member_id']."'");
	$querySaldo_penarikan = mysql_query("SELECT sum(saldo_cashout_amount) penarikan FROM trx_saldo where member_id_fk= '".$_SESSION['member_id_fk']."'");
	$total_penarikan_saldo = mysql_fetch_array($querySaldo_penarikan);

	    $total_saldo = mysql_fetch_array($querySaldo);

	    $query_saldo_terakhir = mysql_fetch_array(mysql_query("SELECT * FROM trx_saldo where member_id_fk = '".$_SESSION['member_id']."' ORDER BY member_id_fk DESC"));
	    $saldo_terakhir = $query_saldo_terakhir['saldo_total']; 
	    $sisa_saldo_member = $saldo_terakhir - $total_penarikan_saldo['penarikan'];
	    
	if (isset($_POST['simpan'])) {
		$total_saldo_cek = $total_saldo['total_saldo'];
		$passwordakun = md5($_POST['password_account']);
		$password = $_SESSION['member_password'];
		$jumlah_penarikan = $_POST['cashout_amount'];

		if ($jumlah_penarikan <= $total_saldo_cek ) {
			if ($passwordakun == $password) {
				
				$querySubmit = mysql_query("INSERT INTO trx_saldo (saldo_bankname, saldo_accountnumber, saldo_cashout_amount, saldo_status,member_id_fk) VALUES ('".$_POST['bank_name']."', '".$_POST['bank_account']."', '".$_POST['cashout_amount']."','REQUEST','".$_SESSION['member_id']."')");
				if ($querySubmit) {
					echo "<script> alert('Silahkan Tunggu Konfirmasi dari Admin'); location.href='index.php?hal=saldo/saldo' </script>";exit;	
				}
				

			}else{
				echo "<script> alert('PASSWORD AKUN ANDA SALAH'); location.href='index.php?hal=saldo/saldo' </script>";exit;
			}
		}else{
			echo "<script> alert('SALDO ANDA TIDAK CUKUP UNTUK PENARIKAN SALDO'); location.href='index.php?hal=saldo/saldo' </script>";exit;
		}


		// $password = md5($_POST['password_account']);
		// $queryPassword = (mysql_query("SELECT member_password from tbl_member where member_id = '".$_SESSION['member_id'].""));
		// while ($run_query = mysql_fetch_array($queryPassword)) {
		// 	$pass = $run_query['member_password'];
	
		// if ($pass != $password) { // LOGIKANE PIE
		// 	echo "<script> alert('Password anda salah'); location.href='index.php?hal=saldo/saldo' </script>";exit;
		// } else {
		// 	insert table ke trx_saldo
		// print_r("INSERT INTO tbl_saldo (bank_name, bank_account, cashout_amount,member_id_fk) VALUES ('".$_POST['bank_name']."', '".$_POST['bank_account']."', '".$_POST['cashout_amount']."','".$_SESSION['member_id']."')");
		// print_r("INSERT INTO trx_saldo (saldo_cashout_amount,saldo_cashout_date,member_id_fk) VALUES ('".$_POST['cashout_amount']."',NOW(),'".$_SESSION['member_id']."')");
		// die();
		// $querySubmit = mysql_query("INSERT INTO trx_saldo (saldo_bankname, saldo_accountnumber, saldo_cashout_amount, member_id_fk) VALUES ('".$_POST['bank_name']."', '".$_POST['bank_account']."', '".$_POST['cashout_amount']."','".$_SESSION['member_id']."')");
		// if ($querySubmit) {
		// 	 echo "<script> alert('Data Berhasil Disimpan'); location.href='index.php?hal=saldo/saldo' </script>";exit; 
		// } else {
		// 	 echo "<script> alert('Data Gagal Disimpan'); location.href='index.php?hal=saldo/saldo' </script>";exit;
		// }
		

	}
 ?> 
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>SALDO</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index-2.html">Home</a>
            </li>
            <li>
                <a>Saldo</a>
            </li>
            <li class="active">
                <strong>Saldo Member</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row animated fadeInRight">
        <div class="col-md-4">
            <div class="ibox">
				<div class="panel panel-primary dim_about">
					<div class="panel-heading">SALDO ANDA</div>
					<div class="panel-body">
					<center>
						 <?php 
			    
			    if ($total_saldo['total_saldo']=='') {
			      echo "Rp.0";
			    }
			    echo "<h1>Rp ".rupiah($sisa_saldo_member)."</h1>";
			 ?></center>
					</div>
				</div>
            
			</div>
		</div>
		<div class="col-md-8">
			 <div class="col-md-12">
            <div class="ibox">
				<div class="panel panel-primary dim_about">
					<div class="panel-heading">Pencairan Saldo</div>
					<div class="panel-body">
						<form class="role" method="POST" enctype="multipart/form-data">
							<div class="form-group row">
								<label class="col-md-4">Nama Member</label>
								<div class="col-md-6">
									<input type="text" class="form-control" value="<?php echo $_SESSION['member_name']; ?>" disabled>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-4">Total Saldo</label>
								<div class="col-md-6">
									<input type="text" class="form-control" value="<?php echo  rupiah ($sisa_saldo_member); ?>" disabled>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-4">Nama Bank</label>
								<div class="col-md-6">
									<input type="text" name="bank_name" class="form-control">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-4">Nomor Rekening</label>
								<div class="col-md-6">
									<input type="text"  name="bank_account" class="form-control">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-4">Jumlah Penarikan</label>
								<div class="col-md-6">
									<input type="text" name="cashout_amount" class="form-control">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-4">Password Akun</label>
								<div class="col-md-6">
									<input type="text" name="password_account" class="form-control">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-4"></label>
								<div class="col-md-6">
									<?php 
									 $query_profilmember= mysql_query("SELECT * from tbl_member where member_id = '".$_SESSION['member_id']."'");
						                  $peringatan_lengkapi_identitas = mysql_fetch_array($query_profilmember);
						                      $member_birth_date_cek          = $peringatan_lengkapi_identitas['member_birth_date'];
						                      $member_gender_cek              = $peringatan_lengkapi_identitas['member_gender'];
						                      $member_phone_number_cek        = $peringatan_lengkapi_identitas['member_phone_number'];
						                      $member_address_cek             = $peringatan_lengkapi_identitas['member_address'];
						               
						                  if ($member_birth_date_cek  != '0000-00-00' OR $member_gender_cek  != '' OR 
						                        $member_phone_number_cek !='' OR $member_address_cek  != '') {
											if ($total_saldo['total_saldo'] < 50000) {
												echo "<button type='button' name='simpan' disabled class='btn btn-primary dim_about'>KONFIRMASI PENCAIRAN</button>";
												echo "<p>Maaf Saldo Anda Tidak Dapat Dicairkan Dikarenakan Nominal Kurang Dari Rp. 50.000,<br> SALDO ANDA SEKARANG SENILAI : <b> Rp. ".rupiah($total_saldo['total_saldo'])."</b></p>";
											}else{
												echo "<button type='submit' name='simpan' class='btn btn-primary dim_about'>KONFIRMASI PENCAIRAN</button>";
											}
										}else{
											echo "<a href='index.php?hal=akun/profil' class='btn btn-danger'><span class='fa fa-check'></span> Lengkapi Data Diri Anda </a>";
											
										}
									 ?>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		</div>
	</div>

</div>
