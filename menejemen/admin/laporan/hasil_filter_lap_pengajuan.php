<?php 
		if (isset($_POST['filter'])) {

			 $per1=$_POST['periode1'];
  			 $per2=$_POST['periode2'];
  			 $query = "SELECT * from trx_loan_application A join trx_loan_application_detail B on A.loan_app_id = B.loan_app_id_fk join tbl_member C on C.member_id = A.member_id_fk join ref_instrument D on D.instrument_id = B.instrument_id_fk 
  			 		 WHERE A.loan_date_start BETWEEN '$per1' AND '$per2' 
  			 ";
		}
 ?>
<div id="content">
			<div class="inner">
				<div class="row" style="padding-top: 10px; padding-right: 10px; padding-left: 10px;">
                <div class="panel panel-primary" style="border-color: #1ab394;">
                    <div class="panel-heading">
                       <div class="row">
                            <div class="col-md-4">
                             <span class=""></span>
                        </div>
                        <div class="col-md-8">
                            <div class="text-right"><b><i><span class="fa fa-home"></span> Home / <span class="fa fa-list"></span> Laporan / <span class="fa fa-users"> </span> Pengajuan</i></b></div>
                            
                        </div>
                       </div>
                    </div>
                    
                </div>
            </div>
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary" style="border-color:#f8f8f8;">
                        <div class="panel-heading">
                            <span class=""></span> Laporan Peminjaman
                        </div>
                        <div class="panel-body dim_about">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>INVOICE</th>
                                            <th>NAMA</th>
                                            <th>INSTANSI</th>
                                            <th>TANGGAL PINJAM</th>
                                            <th>TANGGAL KEMBALI</th>
                                            <th>NAMA ALAT</th>
                                            <th>JUMLAH</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $no =1;
                                            $show = mysql_query($query);
                                            while ($runshow = mysql_fetch_array($show)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $runshow['loan_invoice']; ?></td>
                                                <td><?php echo $runshow['member_name']; ?></td>
                                                <td><?php echo $runshow['member_institution']; ?></td>
                                                <td><?php echo $runshow['loan_date_start']; ?></td>
                                                <td><?php echo $runshow['loan_date_return']; ?></td>
                                                <td><?php echo $runshow['instrument_name']; ?></td>
                                                <td><?php echo $runshow['loan_amount']; ?></td>
                                            </tr> 
                                            <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                                <div align="center">
                                    <table  class="table table-responsive table-borderd">
                                        
                                            <tr>
                                                <td><b>Nama Alat</b></td>
                                                <td>:</td>
                                                <td></td>
                                            </tr>
                                            <?php 
                                                $query_jumlah_alat_dipinjam = mysql_query("SELECT * from trx_loan_application A join trx_loan_application_detail B on A.loan_app_id = B.loan_app_id_fk join tbl_member C on C.member_id = A.member_id_fk join ref_instrument D on D.instrument_id = B.instrument_id_fk where A.loan_status='DIPINJAM'");
                                                while ($row_alat = mysql_fetch_array($query_jumlah_alat_dipinjam)) {
                                                    $jumlah_alat = mysql_fetch_array(mysql_query("SELECT count(loan_amount) as jumlah_alat from trx_loan_application A join trx_loan_application_detail B on A.loan_app_id = B.loan_app_id_fk join tbl_member C on C.member_id = A.member_id_fk join ref_instrument D on D.instrument_id = B.instrument_id_fk where A.loan_status='DIPINJAM' AND B.instrument_id_fk = '".$row_alat['instrument_id']."' "));

                                             ?>
                                             <tr>
                                                 <td><?php echo $row_alat['instrument_name']; ?></td>
                                                 <td>:</td>
                                                 <td><?php echo $jumlah_alat['jumlah_alat']; ?></td>
                                             </tr>
                                             <?php } ?>
                                        
                                    </table>

                                </div>
                            <div align="center">
                                <a href="laporan/hasil_filter_lap_pengajuan_excel.php&periode1=<?php echo $per1; ?>&periode2=<?php echo $per2; ?>" class="btn btn-success"><span class="fa fa-file-excel-o"></span> Export to Excel</a>
                                <a href="laporan/hasil_filter_lap_pengajuan_pdf.php&periode1=<?php echo $per1; ?>&periode2=<?php echo $per2; ?>" target="_BLANK" class="btn btn-warning"><span class="fa fa-file-pdf-o"></span> Export to PDF</a>
                            </div>
                        </div>   
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
