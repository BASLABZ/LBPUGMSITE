<?php 

        $tgl_pjm = date('Y-m-d',strtotime($_POST['tgl_pinjam']));
        $tgl_kmb = date('Y-m-d',strtotime($_POST['tanggal_kembali']));

        $tanggawalperpanjang = jin_date_sql($_POST['tgl_pinjam']);
        $tanggalperpanjang = jin_date_sql($_POST['tanggal_kembali']);
        $lamapinjam = $_POST['lamapinjam'];
        $totalitem = $_POST['totaljumlahSEMUAITEM'];
        $totalbayar  = $_POST['totalpenyewaanBayar'];
        $invoice = $_POST['invoice_perpanjang'];
        
        $queryInserPerpanjang = "INSERT INTO trx_longtime (loan_app_id_fk,
        																longtime_status,
        																longtime_date_start,
        																longtime_date_return,
        																longtime_total_item,
        																longtime_total_fee,
        																longtime_long,
        																longtime_date_input)
        													 VALUES ('".$invoice."',
        													 			'MENUNGGU KONFIRMASI',
        													 		'".$tgl_pjm."',
        													 		'".$tgl_kmb."',
        													 		'".$totalitem."',
        													 		'".$totalbayar."',
        													 		'".$lamapinjam."',
        													 		NOW())";

       mysql_query($queryInserPerpanjang);

       $queryupdatestatusloan = mysql_query("UPDATE trx_loan_application set loan_status = 'PERPANJANG' where loan_invoice = '".$invoice."'");
       
        if ($queryupdatestatusloan) {
            echo "<script> alert('Terimakasih Data Berhasil Disimpan & Tunggu Konfirmasi Dari Kami'); location.href='index.php?hal=pengajuan-member/pengajuan-alat ' </script>";exit;
        }

 ?>