<?php 	
	include '../../inc/inc-db.php';
    session_start();	 
?>
<!DOCTYPE html>
<html>
<head>
	<title>LAPORAN PEMINJAMAN ALAT</title>
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
	<h2>LAPORAN TRANSAKSI PEMINJAMAN ALAT</h2>
   <table border="1">
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
                $show = mysql_query("SELECT * from trx_loan_application A join trx_loan_application_detail B on A.loan_app_id = B.loan_app_id_fk join tbl_member C on C.member_id = A.member_id_fk join ref_instrument D on D.instrument_id = B.instrument_id_fk where A.loan_status='DIPINJAM'");
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
    </center>
    <div align="left">
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

</body>
</html>