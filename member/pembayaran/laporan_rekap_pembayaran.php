<?php 
        include '../../menejemen/inc/inc-db.php';
        $id  = $_POST['member_id'];
         $querypreviewrekap = mysql_query("SELECT * FROM trx_loan_application p JOIN trx_payment_temp t ON t.loan_app_id_fk = p.loan_app_id where p.loan_invoice = '".$id."'");
        $row = mysql_fetch_array($querypreviewrekap);
 ?>
<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAPORAN REKAP | PEMBAYARAN</title>
    <link href="../../includes/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../includes/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../../includes/css/animate.css" rel="stylesheet">
    <link href="../../includes/css/style.css" rel="stylesheet">

</head>

<body class="white-bg">
                <div class="wrapper wrapper-content p-xl">
                    <div class="ibox-header">
                        <center>
                            <h2>LBP - UGM </h2>
                            <h3>LAPORAN REKAP TRANSAKSI PER INVOICE : <?php echo $row['loan_invoice']; ?></h3>
                        </center>
                    </div>
                    <div class="ibox-content p-xl">

                             <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="ibox-content p-xl">

                            <div class="table-responsive m-t">
                                <table class="table table-responsive table-hover table-bordered">
        <thead>
            <th>NO</th>
            <th>NAMA INSTRUMENT</th>
            <th>JUMLAH</th>
            <th>SUBTOTAL</th>
        </thead>
        <tbody>
            <?php 

                    
                    $sqldetail = mysql_query("SELECT * FROM trx_loan_application_detail d join ref_instrument i on d.instrument_id_fk = i.instrument_id join trx_loan_application a on d.loan_app_id_fk = a.loan_app_id where a.loan_invoice = '".$id."'");
                    $no =1;
                    while ($rowDetailPeminjaman = mysql_fetch_array($sqldetail)) {
                        $status = $rowDetailPeminjaman['loan_status_detail'];
             ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $rowDetailPeminjaman['instrument_name']; ?></td>
                            <td class="text-right"><?php echo $rowDetailPeminjaman['loan_amount']; ?></td>
                            <td class="text-right">Rp.<?php echo $rowDetailPeminjaman['loan_subtotal']; ?></td>
                        </tr>
            <?php } ?>
        </tbody>
         </table>
    </div>  
    <table class="table invoice-total">
        <tbody>
          <?php 
                    $rowjumlahsubtotal = mysql_query("SELECT sum(loan_subtotal) as sub FROM trx_loan_application_detail d join trx_loan_application x 
                          on d.loan_app_id_fk = x.loan_app_id  where x.loan_invoice ='".$id."' ");
                    $xs = mysql_fetch_array($rowjumlahsubtotal);
                    $sub = $xs['sub'];
                    $queryTotal = mysql_query("SELECT loan_total_item,loan_total_fee, long_loan FROM trx_loan_application where loan_invoice ='".$id."'");
                    while ($roTotal = mysql_fetch_array($queryTotal)){  
             ?>
                <tr>
                    <td><strong>Jumlah Item :</strong></td>
                    <td><?php echo $roTotal['loan_total_item']; ?> / Item</td>
                </tr>
                <tr>
                    <td><strong>Lama Pinjam:</strong></td>
                    <td><?php echo $roTotal['long_loan']; ?>/Minggu</td>
                </tr>
                <tr>
                    <td><strong>Jumlah Subtotal  :</strong></td>
                    <td>Rp. <?php echo $sub; ?></td>
                </tr>
                <tr>
                    <td><strong>Total = Lama Pinjam x Jumlah Subtotal :</strong></td>
                    <td>Rp. <?php echo $roTotal['loan_total_fee']; ?></td>
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
    <script src="../../includes/js/jquery-2.1.1.js"></script>
    <script src="../../includes/js/bootstrap.min.js"></script>
    <script src="../../includes/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="../../includes/js/inspinia.js"></script>
    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>
