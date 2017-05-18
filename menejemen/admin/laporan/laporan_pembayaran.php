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
                             <span class=""></span>
                        </div>
                        <div class="col-md-8">
                            <div class="text-right"><b><i><span class="fa fa-home"></span> Home / <span class="fa fa-list"></span> Laporan / <span class="fa fa-users"> </span> Pembayaran</i></b></div>
                            
                        </div>
                       </div>
                    </div>
                    
                </div>
            </div>
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary" style="border-color:#f8f8f8;">
                        <div class="panel-heading">
                            <span class=""></span> Laporan Data Pembayaran
                        </div>
                        <div class="panel-body dim_about">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="dataTables-example">
                                    <thead>
                                        <th>NO</th>
                                        <th>NO INVOICE</th>
                                        <th>NAMA MEMBER</th>
                                        <th>TANGGAL BAYAR</th>
                                        <th>JUMLAH TAGIHAN</th>
                                        <th>JUMLAH BAYAR</th>
                                        <th>KATEGORI PEMBAYARAN</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $no =1;
                                            $show = mysql_query("SELECT * from trx_payment A join trx_loan_application B on A.loan_app_id_fk = B.loan_app_id join tbl_member C on C.member_id = A.member_id_fk ");
                                            while ($runshow = mysql_fetch_array($show)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $runshow['loan_invoice']; ?></td>
                                                <td><?php echo $runshow['member_name']; ?></td>
                                                <td><?php echo $runshow['payment_date']; ?></td>
                                                <td><?php echo $runshow['payment_bill']; ?></td>
                                                <td><?php echo $runshow['payment_amount_transfer']; ?></td>
                                                <td><?php echo $runshow['payment_category']; ?></td>
                                            </tr> 
                                            <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            <div align="center">
                                <button class="btn btn-success"><span class="fa fa-file-excel-o"></span> Export to Excel</button>
                                <button class="btn btn-warning"><span class="fa fa-file-pdf-o"></span> Export to PDF</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
