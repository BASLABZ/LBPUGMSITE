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
			    $querySaldo = mysql_query("SELECT sum(saldo_nominal) as total_saldo FROM tbl_saldo where member_id_fk='".$_SESSION['member_id']."'");
			    $total_saldo = mysql_fetch_array($querySaldo);
			    if ($total_saldo['total_saldo']=='') {
			      echo "Rp.0";
			    }
			    echo "<h1>Rp.".rupiah($total_saldo['total_saldo'])."</h1>";
			 ?></center>
					</div>
				</div>
            
			</div>
		</div>
		<div class="col-md-8">
			 <div class="col-md-12">
            <div class="ibox">
				<div class="panel panel-primary dim_about">
					<div class="panel-heading">Pengajuan Pencairan Saldo</div>
					<div class="panel-body">
						<form class="role" method="POST" enctype="multipart/form-data">
							<div class="form-group row">
								<label class="col-md-4">NAMA LENGKAP</label>
								<div class="col-md-6">
									<input type="text" class="form-control" value="<?php echo $_SESSION['member_name']; ?>" disabled>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-4">TOTAL SALDO</label>
								<div class="col-md-6">
									<input type="text" class="form-control" value="<?php echo $total_saldo['total_saldo']; ?>" disabled>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-4">NOMILNAL SALDO YANG DICAIRKAN</label>
								<div class="col-md-6">
									<input type="text" class="form-control">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-4">FILE PENGAJUAN</label>
								<div class="col-md-6">
									<input type="file">
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
												echo "<button type='button' disabled class='btn btn-primary dim_about'>AJUKAN PENCAIRAN</button>";
												echo "<p>Maaf Saldo Anda Tidak Dapat Dicairkan Dikarenakan Nominal Kurang Dari Rp. 50.000,<br> SALDO ANDA SEKARANG SENILAI : <b> Rp. ".rupiah($total_saldo['total_saldo'])."</b></p>";
											}else{
												echo "<button type='submit' class='btn btn-primary dim_about'>AJUKAN PENCAIRAN</button>";
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
a675[;66666666666666666666666666[[[uuuuu56hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh76ht[[[[[[[[[[[[[[[[[kkuuuuuuuuuuuuuu-ukkm-uhpljk.l]]]]]]]]]]]]]]]]]]]]]00000000kkkkkmmmk