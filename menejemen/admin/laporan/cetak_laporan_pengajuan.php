<?php 	
	include '../../inc/inc-db.php';
    session_start();	 
?>
<!DOCTYPE html>
<html>
<head>
	<title>LAPORAN PENGAJUAN</title>
</head>
<body onload="window.print()">
<center>
            <table width="100%">
            <th  ALIGN="RIGHT" WIDTH="20%">
                <img src="../assets/logo.png" style="width:50%;">
            </th >
                <th ALIGN="CENTER" WIDTH="60%">
                    <p align="left">
                        <center>
                            <h3>LABORATORIUM BIO & PALEONTROPOLOGI <br>FAKULTAS KEDOKTERAN UNIVERSITAS GADJAH MADA </h3>
                            <h3></h3>
                            <h5><i>Alamat : Jalan Medika Sekip , Yogyakarta , 55281, Indonesia</i><br>
                                Telp/ FAX: +62-274-552577; Email: lab-biopaleo.fk@ugm.ac.id<br> http://lab-biopaleoantropologi.fk.ugm.ac.id/
                            </h5>
                        </center>
                    </p>
                </th>
        </table>
       </center>
       <hr>
	<center>
	<h3>Laporan Pengajuan Peminjaman</h3>
   <table border="1">
        <thead>
            <tr>
                <th>NO</th>
                <th>INVOICE</th>
                <th>NAMA</th>
                <th>INSTANSI</th>
                <th>TANGGAL PENGAJUAN</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $no =1;
                $show = mysql_query("SELECT * from trx_loan_application A join trx_loan_application_detail B on A.loan_app_id = B.loan_app_id_fk join tbl_member C on C.member_id = A.member_id_fk join ref_instrument D on D.instrument_id = B.instrument_id_fk GROUP BY c.member_id ");
                while ($runshow = mysql_fetch_array($show)) {
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $runshow['loan_invoice']; ?></td>
                    <td><?php echo $runshow['member_name']; ?></td>
                    <td><?php echo $runshow['member_institution']; ?></td>
                    <td><?php echo $runshow['loan_date_input']; ?></td>
                <?php
                }
            ?>
        </tbody>
    </table>
    </center>
    <div align="left">

    <table  class="table table-responsive table-borderd">
        
            <tr>
                <td><b>Keterangan</b></td>
                <td>:</td>
                <td></td>
            </tr>
            <?php 
                // $query_jumlah_alat_dipinjam = mysql_query("SELECT * from trx_loan_application A join trx_loan_application_detail B on A.loan_app_id = B.loan_app_id_fk join tbl_member C on C.member_id = A.member_id_fk join ref_instrument D on D.instrument_id = B.instrument_id_fk");
                // while ($row_alat = mysql_fetch_array($query_jumlah_alat_dipinjam)) {
                //     $jumlah_alat = mysql_fetch_array(mysql_query("SELECT count(loan_status) as status_pengajuan from trx_loan_application A join tbl_member C on C.member_id = A.member_id_fk "));
            $query = mysql_query("SELECT * FROM trx_loan_application group by loan_status");
                while ($status = mysql_fetch_array($query)) {
                $row_count_status  = mysql_fetch_array(mysql_query("SELECT COUNT(*) as jumlah_status from trx_loan_application group by loan_status"));

             ?>
             <tr>
                 <td><?php echo $status['loan_status']; ?></td>
                 <td>:</td>
                 <td><?php echo $row_count_status['jumlah_status']; ?></td>
             </tr>
             <?php } ?>
        
    </table>

                                </div>

</body>
</html>