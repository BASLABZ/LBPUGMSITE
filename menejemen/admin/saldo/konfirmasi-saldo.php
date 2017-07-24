<?php 
		$id = $_GET['id'];
		$query_saldo = mysql_query("SELECT * FROM trx_saldo s JOIN tbl_member m ON s.member_id_fk = m.member_id where s.saldo_id = '".$id."' ");

		$row_request = mysql_fetch_array($query_saldo);
		if (isset($_POST['konfirmasi_saldo'])) {
              if(!empty($_FILES) && $_FILES['gambar']['size'] > 0 && $_FILES['gambar']['error'] == 0){
                    $fileName = $_FILES['gambar']['name'];
                    $move = move_uploaded_file($_FILES['gambar']['tmp_name'], 'transfer_member/'.$fileName);
                    if ($move) {
                        $query_update_transfer = mysql_query("UPDATE trx_saldo set saldo_cashout_date = NOW(), saldo_photo = '".$fileName."' , saldo_status = 'DIKONFIRMASI' where saldo_id = '".$id."'");
                        if ($query_update_transfer) {
                             echo "<script> alert('PENGAJUAN TELAH DI KONFIRMASI'); location.href='index.php?hal=saldo/list' </script>";exit;
                        }
                    }else{
                        echo "FAILED";
                    }
                }         
		}
 ?>
 
 <div id="content">
            <div class="inner">
                <div class="row" style="padding-top: 10px; padding-right: 10px; padding-left: 10px;">
                <div class="panel panel-primary" style="border-color: #1ab394;">
                    <div class="panel-heading">
                       <div class="row">
                            <div class="col-md-4">
                             <span class="fa fa-sitemap"></span> Data Konfirmasi Saldo
                        </div>
                        <div class="col-md-8">
                            <div class="text-right"><b><i><span class="fa fa-home"></span> Home / <span class="fa fa-list"></span> Konfirmasi Saldo / <span class="fa fa-sitemap"> </span> Konfirmasi Penarikan Saldo</i></b></div>
                        </div>
                       </div>
                    </div>
                    
                </div>
            </div>
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary" style="border-color:#f8f8f8;">
                        <div class="panel-heading">
                         </span> Konfirmasi Penarikan Saldo </div>
                        <div class="panel-body dim_about">
                    	 	<form class="role" method="POST" enctype="multipart/form-data">
						 		<div class="form-group col-md-6">
						 			<label>Nama</label>
						 			<input type="text" disabled="" value="<?php echo $row_request['member_name']; ?>" class='form-control'>
						 		</div>
						 		<div class="form-group col-md-6">
						 			<label>Nominal Penarikan</label>
						 			<input type="text" disabled="" value="Rp <?php echo rupiah($row_request['saldo_cashout_amount']); ?>" class='form-control'>
						 		</div>
                                <div class="col-md-3"></div>
						 		<div class="form-group col-md-3">
						 			<label>Bukti Transfer</label>
						 			<input type="file" name="gambar">
						 		</div>
						 		<div class="col-md-6">
                                    <div class="form-group">
                                    <button class="btn btn-primary col-md-8" name="konfirmasi_saldo" type="submit">Konfirmasi Penarikan</button>
                                </div>                       
                                </div>
						 	</form>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
