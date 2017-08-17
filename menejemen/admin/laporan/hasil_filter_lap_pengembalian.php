<?php 
		if (isset($_POST['filter'])) {

			 $per1=$_POST['periode1'];
  			 $per2=$_POST['periode2'];
  			 $query = "SELECT * FROM trx_loan_application a  JOIN tbl_member m on a.member_id_fk = m.member_id 
	                JOIN trx_payment p ON p.loan_app_id_fk = a.loan_app_id
	                where p.payment_valid = 'VALID' AND a.loan_status != 'MEMBAYAR TAGIHAN'  GROUP BY a.loan_app_id ORDER BY a.loan_app_id DESC
  			 		 WHERE A.loan_date_input BETWEEN '$per1' AND '$per2' 
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
                            <div class="text-right"><b><i><span class="fa fa-home"></span> Home / <span class="fa fa-list"></span> Laporan / <span class="fa fa-users"> </span> Pengembalian</i></b></div>
                            
                        </div>
                       </div>
                    </div>
                    
                </div>
            </div>
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary" style="border-color:#f8f8f8;">
                        <div class="panel-heading">
                            <span class=""></span> Laporan Data Pengembalian
                        </div>
                        <div class="panel-body dim_about">
                            <div class="table-responsive">
                                   <table class="table table-striped table-hover"  id="dataTables-example">
                                                <thead>
                                                    <th>NO</th>
                                                    <th>Tanggal Pengajuan</th>
                                                    <th>Invoice</th>
                                                    <th>Nama</th>
                                                    <th>Tanggal Pinjam</th>
                                                    <th>Tanggal Kembali</th>
                                                    <th>Status</th>
                                                    
                                                </thead>
                                                <tbody>
                                                <?php 
                                                    $no = 1;
                                                    $querypengembalian = mysql_query("SELECT * FROM trx_loan_application a  JOIN tbl_member m on a.member_id_fk = m.member_id 
                                                        JOIN trx_payment p ON p.loan_app_id_fk = a.loan_app_id
                                                        where p.payment_valid = 'VALID' AND a.loan_status != 'MEMBAYAR TAGIHAN'  GROUP BY a.loan_app_id ORDER BY a.loan_app_id DESC ");
                                                    while ($ropengembalian_alat = mysql_fetch_array($querypengembalian)) {
                                                 ?>
                                                    <tr>
                                                        <td><?php echo $no++; ?></td>
                                                        <td><?php echo $ropengembalian_alat['loan_date_input']; ?></td>
                                                        <td><?php echo $ropengembalian_alat['loan_invoice']; ?></td>
                                                        <td><?php echo $ropengembalian_alat['member_name']; ?></td>
                                                        <td><?php echo $ropengembalian_alat['loan_date_start']; ?></td>
                                                        <td><?php echo $ropengembalian_alat['loan_date_return']; ?></td>
                                                        <td>
                                                            <label class="label label-warning"><?php echo $ropengembalian_alat['loan_status']; ?></label>
                                                            <label class="label label-primary"><?php echo $ropengembalian_alat['payment_notif']; ?></label>
                                                        </td>
                                                        
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                             <div align="center">
                                <a href="laporan/cetak_laporan_excel_pengembalian.php" class="btn btn-success"><span class="fa fa-file-excel-o"></span> Export to Excel</a>
                                <a class="btn btn-warning" href="laporan/cetak_laporan_pengembalian_pdf.php" target="_BLANK"><span class="fa fa-file-pdf-o"></span> Export to PDF</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
