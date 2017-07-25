<?php 
	$rejected_id = $_GET['rejected_id'];
        if (isset($_POST['ubahnilaialat'])) {
                    $subtotal = $_POST['jumlahalat'] * $_POST['rejected_detail_loan_subtotal'];
                $queryubahnilaialat = mysql_query("UPDATE  trx_rejected_detail SET rejected_detail_loan_subtotal = '".$subtotal."', rejected_detail_loan_amount = '".$_POST['jumlahalat']."' WHERE rejected_detail_id = '".$_POST['rejected_detail_id']."'");
                if ($queryubahnilaialat) {
                    echo "<script>  location.href='index.php?hal=peminjaman/pengajuan/penawaran&rejected_id=".$rejected_id."' </script>";exit;

                }
            }	
            $row_query = mysql_fetch_array(mysql_query("SELECT * FROM trx_rejected_detail de join trx_rejected re 
                                        ON de.rejected_id_fk = re.rejected_id
                                        JOIN trx_loan_application_detail dl 
                                        ON re.loan_app_detail_id_fk = dl.loan_app_detail_id
                                        JOIN ref_instrument i
                                        ON dl.instrument_id_fk = i.instrument_id
                                        JOIN trx_loan_application lp ON
                                        dl.loan_app_id_fk = lp.loan_app_id
                                         where re.rejected_id= '".$rejected_id."'"));
     
            $invoice = $row_query['loan_invoice'];

 ?>
 <div id="content">
            <div class="container" style="padding-top:30px; ">
            <div class="row">
                <div class="col-md-12">
                <div class="panel panel-primary" style="border-color:white; ">
                    <div class="panel-heading dim_about">
                        <span class="fa fa-pencil"></span> Detail Penawaran
                        <span class="fa fa-home pull-right"> <i>
                            Home / <span class="fa fa-list"></span> Master / <span class="fa fa-users">
                            </span>
                            Operator
                        </i></span>
                    </div>
                </div>
                <div class="panel panel-primary" style="border-color:white; ">
                        <div class="panel-body ">
                    
                    <div class="col-md-12">
                        <div class="panel panel-primary" style="border-color:white;">
                        <div class="panel-heading">Data Penolakan Dan Penawaran Alat</div>
                        <div class="panel-body dim_about">

                            <div class="col-md-12">
                                <a href="index.php?hal=peminjaman/pengajuan/pengajuan_detail&invoice=<?php echo $invoice; ?>" class="btn btn-warning"><span class=" fa fa-arrow-circle-o-left"> Kembali</span></a><br/><br/>
                            	<label>Data Alat Ditolak</label>
                            	<hr>
                            	
                                <table class="table table-responsive table-stripped table-bordered">
                                	<thead>
                                		<th>Nama Alat</th>
                                		<th>Status Alat</th>
                                        <th>Biaya Alat</th>
                                		<th>Jumlah Pinjam</th>
                                		<th>Subtotal</th>
                                		<th>Keterangan Penolakan</th>
                                	</thead>
                                	<tbody>
                                		<?php 
                                			$queryPermintaan = mysql_query("SELECT * FROM trx_rejected_detail de join trx_rejected re ON de.rejected_id_fk = re.rejected_id JOIN trx_loan_application_detail dl ON re.loan_app_detail_id_fk = dl.loan_app_detail_id JOIN ref_instrument i ON dl.instrument_id_fk = i.instrument_id where re.rejected_id= '".$rejected_id."'");
                                			while ($rowPenolakan = mysql_fetch_array($queryPermintaan)) {
                                		 ?>
                                		 <tr>
                                		 	<td><?php echo $rowPenolakan['instrument_name']; ?></td>
                                		 	<td><span class="label label-danger"><?php echo $rowPenolakan['loan_status_detail']; ?></span></td>
                                            <td>Rp <?php echo rupiah($rowPenolakan['instrument_fee']); ?></td>
                                		 	<td><?php echo $rowPenolakan['loan_amount']; ?></td>
                                		 	<td>Rp <?php echo rupiah($rowPenolakan['loan_subtotal']); ?></td>
                                		 	<td><?php echo $rowPenolakan['rejected_text']; ?></td>
                                		 </tr>

                                		<?php } ?>
                                	</tbody>
                                </table>
                            </div>
                            <div class="col-md-12">
                            	<label>Data Alat Yang Disarankan</label>
                            	<hr>
                            	<table class="table table-responsive table-bordered table-stripped">
                            		<thead>
                            			<th>Nama Alat</th>
                                        <th>Biaya Alat</th>
                            			<th>Jumlah Alat Tersedia</th>
                            			<th>Jumlah Alat</th>
                            			<th>Subtotal</th>
                            		</thead>
                            		<tbody>
                            			<?php 
                            				$queryPenawaran = mysql_query("SELECT de.rejected_text,de.rejected_detail_id,i.instrument_quantity,x.intrument_quantity_temp,x.instrument_name,x.instrument_fee,de.rejected_detail_loan_amount ,de.rejected_detail_loan_subtotal,dl.loan_status_detail FROM trx_rejected_detail de join trx_rejected re 
										ON de.rejected_id_fk = re.rejected_id
										JOIN trx_loan_application_detail dl 
										ON re.loan_app_detail_id_fk = dl.loan_app_detail_id
										JOIN ref_instrument i
										ON dl.instrument_id_fk = i.instrument_id
										JOIN ref_instrument x
										ON de.instrument_id_rejected_fk = x.instrument_id
	 									where re.rejected_id= '".$rejected_id."' AND dl.loan_status_detail != 'DITOLAK TANPA PENAWARAN'  ");
                            				while ($rowpenawaran = mysql_fetch_array($queryPenawaran)) {
                            			 ?>

                            			 <tr>
                            			 	<td><?php echo $rowpenawaran['instrument_name']; ?></td>
                                            <td>Rp <?php echo rupiah($rowpenawaran['instrument_fee']); ?></td>
                            			 	<td><?php echo $rowpenawaran['instrument_quantity']-$rowpenawaran['intrument_quantity_temp']; ?> </td>
                            			 	<td>
                                                    <form method="POST" >
                                                            <div class="form-group row">
                                                                    <div class="col-md-8">
                                                                            <input type="hidden" value="<?php echo $rowpenawaran['rejected_detail_id'] ; ?>" name='rejected_detail_id'> 
                                                                            <input type="hidden" value="<?php echo $rowpenawaran['instrument_fee'] ; ?>" name='rejected_detail_loan_subtotal'> 

                                                                            <input type="number" class='form-control' value="<?php echo $rowpenawaran['rejected_detail_loan_amount']; ?>" name='jumlahalat' min="1" max="<?php echo $rowpenawaran['instrument_quantity']-$rowpenawaran['intrument_quantity_temp']; ?>"> 
                                                                    </div>
                                                                    <div class="col-md-4"><p align="left"><button name="ubahnilaialat" type="submit" class="btn btn-sm btn-primary"><span class="fa fa-pencil"> </span> </button> </p></div>
                                                                    
                                                             </div>
                                                     </form>           
                                            </td>
                            			 	<td>Rp <?php echo rupiah($rowpenawaran['rejected_detail_loan_subtotal']); ?></td>
                            			 </tr>
                            			<?php } ?>
                            		</tbody>
                            	</table>
                            </div>
                        </div>
                    </div>
                </div>
             </div>
            </div>
        </div>
    </div>
</div>
</div>