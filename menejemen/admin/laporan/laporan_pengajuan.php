<?php
include '../../inc/inc-db.php';
session_start();
?>
<div id="content">
			<div class="inner">
				<div class="row" style="padding-top: 10px; padding-right: 10px; padding-left: 10px;">
                <div class="panel panel-primary" style="border-color: #1ab394;">
                    <div class="panel-heading">
                       <div class="row">
                            <div class="col-md-4">
                             <span class="fa fa-users"></span> LAPORAN PENGAJUAN
                        </div>
                        <div class="col-md-8">
                            <div class="text-right"><b><i><span class="fa fa-home"></span> Home / <span class="fa fa-list"></span> Laporan / <span class="fa fa-users"> </span> Operator</i></b></div>
                            
                        </div>
                       </div>
                    </div>
                    
                </div>
            </div>
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary" style="border-color:#f8f8f8;">
                        <div class="panel-heading">
                            <span class="fa fa-users"></span> Laporan Transaksi Pengajuan
                        </div>
                        <div class="panel-body dim_about">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>NO INVOICE</th>
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
                                            $show = mysql_query("SELECT * from trx_loan_application A join trx_loan_application_detail B on A.loan_app_id = B.loan_app_id_fk join tbl_member C on C.member_id = A.member_id_fk join ref_instrument D on D.instrument_id = B.instrument_id_fk");
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
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
