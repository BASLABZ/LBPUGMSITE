<?php 
	$rejected_id = $_GET['rejected_id'];
	
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
                            	<label>INSTRUMENT YANG DITOLAK</label>
                            	<hr>
                            	
                                <table class="table table-responsive table-stripped table-bordered">
                                	<thead>
                                		<th>Nama Instrument</th>
                                		<th>Status Peminjaman</th>
                                		<th>Alat Yang Diminta</th>
                                		<th>Subtutotal</th>
                                	</thead>
                                	<tbody>
                                		<?php 
                                			$queryPermintaan = mysql_query("SELECT * FROM trx_rejected_detail de join trx_rejected re 
										ON de.rejected_id_fk = re.rejected_id
										JOIN trx_loan_application_detail dl 
										ON re.loan_app_detail_id_fk = dl.loan_app_detail_id
										JOIN ref_instrument i
										ON dl.instrument_id_fk = i.instrument_id
										 where re.rejected_id= '".$rejected_id."'");
                                			while ($rowPenolakan = mysql_fetch_array($queryPermintaan)) {
                                		 ?>
                                		 <tr>
                                		 	<td><?php echo $rowPenolakan['instrument_name']; ?></td>
                                		 	<td><?php echo $rowPenolakan['loan_status_detail']; ?></td>
                                		 	<td><?php echo $rowPenolakan['loan_amount']; ?></td>
                                		 	<td><?php echo $rowPenolakan['loan_status_detail']; ?></td>
                                		 </tr>

                                		<?php } ?>
                                	</tbody>
                                </table>
                            </div>
                            <div class="col-md-12">
                            	<label>PENAWARAN ALAT</label>
                            	<hr>
                            	<table class="table table-responsive table-bordered table-stripped">
                            		<thead>
                            			<th>Nama Instrument</th>
                            			<th>Jumlah Ketersediaan Alat</th>
                            			<th>Jumlah Alat Yang Ditawarkan</th>
                            			<th>Sub total</th>
                            		</thead>
                            		<tbody>
                            			<?php 
                            				$queryPenawaran = mysql_query("SELECT i.instrument_quantity,x.instrument_name,de.rejected_detail_loan_amount ,de.rejected_detail_loan_subtotal FROM trx_rejected_detail de join trx_rejected re 
										ON de.rejected_id_fk = re.rejected_id
										JOIN trx_loan_application_detail dl 
										ON re.loan_app_detail_id_fk = dl.loan_app_detail_id
										JOIN ref_instrument i
										ON dl.instrument_id_fk = i.instrument_id
										JOIN ref_instrument x
										ON de.instrument_id_rejected_fk = x.instrument_id
	 									where re.rejected_id= '".$rejected_id."' ");
                            				while ($rowpenawaran = mysql_fetch_array($queryPenawaran)) {
                            			 ?>

                            			 <tr>
                            			 	<td><?php echo $rowpenawaran['instrument_name']; ?></td>
                            			 	<td><?php echo $rowpenawaran['instrument_quantity']-$rowpenawaran['intrument_quantity_temp']; ?></td>
                            			 	<td><input type="number" value="<?php echo $rowpenawaran['rejected_detail_loan_amount']; ?>"></td>
                            			 	<td><?php echo $rowpenawaran['rejected_detail_loan_subtotal']; ?></td>
                            			 	
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