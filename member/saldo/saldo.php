<?php 
	if (isset($_POST['simpan'])) {
		$querySubmit = mysql_query("INSERT INTO trx_saldo (bank_name, bank_account, cashout_amount) VALUES ('".$_POST['bank_name']."', '".$_POST['bank_account']."', '".$_POST['cashout_amount']."')");
		if ($querySubmit) {
			 echo "<script> alert('Data Berhasil Disimpan'); location.href='index.php?hal=saldo/saldo' </script>";exit; 
		} else {
			 echo "<script> alert('Data Gagal Disimpan'); location.href='index.php?hal=saldo/saldo' </script>";exit;
		}
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
			    $querySaldo = mysql_query("SELECT sum(saldo_total) as total_saldo FROM trx_saldo where member_id_fk='".$_SESSION['member_id']."'");
			    $total_saldo = mysql_fetch_array($querySaldo);
			    $query_saldo_terakhir = mysql_fetch_array(mysql_query("SELECT * FROM trx_saldo where member_id = '".$_SESSION['member_id']."' ORDER BY member_id DESC"));
			    $saldo_terakhir = $query_saldo_terakhir['saldo_total'];
			    
			    if ($total_saldo['total_saldo']=='') {
			      echo "Rp.0";
			    }
			    echo "<h1>Rp.".rupiah($saldo_terakhir)."</h1>";
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
									<input type="text" class="form-control" value="<?php echo $total_saldo['total_saldo']; ?>" disabled>
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
