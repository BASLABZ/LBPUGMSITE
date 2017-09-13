  <?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=laporan_data_pembayaran.xls");
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
<center>
<h2>LAPORAN DATA PEBAYARAN</h2>
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
</center>