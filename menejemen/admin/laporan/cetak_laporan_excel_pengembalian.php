  <?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=laporan_data_pengembalian.xls");
    include '../../inc/inc-db.php';
    session_start();        

?>
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
          <table border="1">
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
