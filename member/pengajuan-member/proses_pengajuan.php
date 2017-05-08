<?php 
   // simpan data ke table peminjaman & detail peminjaman 
    $category_member = $_SESSION['category_id_fk'];
    $tahun      = date('Y');
    $subtahun   = substr($tahun, 2);
    $kode       = buatkode("trx_loan_application","");
    $invoice    = "".$kode."/INV/".$subtahun."";      
    $total_loan = $_POST['totaljumlahSEMUAITEM'];
    $totalFee   = $_POST['totalpenyewaanBayar'];
      $konversitgl_pinjam = jin_date_sql($_POST['tgl_pinjam']);
      $konversitgl_kembali = jin_date_sql($_POST['tanggal_kembali']);

      $tgl_pjm = date('Y-m-d',strtotime($_POST['tgl_pinjam']));
      $tgl_kmb = date('Y-m-d',strtotime($_POST['tanggal_kembali']));
   if (!empty($_FILES) && $_FILES['frm_file']['error'] == 0) {
              $fileName = $_FILES['frm_file']['name'];
              $move = move_uploaded_file($_FILES['frm_file']['tmp_name'], '../surat/'.$fileName);
            if ($move) {

                 // insert to table trx_loan_application
                if ($category_member == 1) {
                    $hasil_akhir = $totalFee*0.5;
                    $queryInsert_loan_app = "INSERT INTO trx_loan_application 
                                            (loan_app_id,loan_invoice,
                                            loan_date_input,loan_date_start,
                                            loan_date_return,loan_file,
                                            loan_total_item,loan_total_fee,
                                            long_loan,
                                            loan_status,member_id_fk
                                            ) 
                              VALUES ('".$kode."','".$invoice."',NOW(),'". $tgl_pjm ."','". $tgl_kmb ."',
                                      '".$fileName."','".$total_loan."','".$hasil_akhir."','".$_POST['totalbayarpenajuan']."','MENUNGGU','".$_SESSION['member_id']."')";
                                       
                      $runSQLINSERT = mysql_query($queryInsert_loan_app);
                  // insert to trx_loan_application_detail
                  $kodealats  = $_POST['instrument_id_fk'];
                  $jumlahalats = $_POST['jumlah'];
                  $subtotalpinjams = $_POST['subtotal'];

                  $banyaks        = count($kodealats);
                    for ($ulang=0; $ulang <  $banyaks ; $ulang++) { 
                   $kodeInstruments = $kodealats[$ulang];
                   $jumlahalatinstruments = $jumlahalats[$ulang];
                   $suv = $subtotalpinjams[$ulang];
                   $queryInsertDetail_loan = "INSERT INTO trx_loan_application_detail 
                                                        (loan_app_id_fk,instrument_id_fk,loan_amount,loan_subtotal,loan_status_detail)
                                             VALUES 
                                             ('".$kode."','".$kodeInstruments."',
                                             '".$jumlahalatinstruments."','".$suv."','MENUNGGU')";
                                             $runSQLINSERT_detail = mysql_query($queryInsertDetail_loan);
                  }
                }else if ($category_member == 5) {
                    $potongan_s2 = $totalFee*0.25;
                    $hasil_akhir_s2 = $totalFee-$potongan_s2;
                    $queryInsert_loan_app = "INSERT INTO trx_loan_application 
                                            (loan_app_id,loan_invoice,
                                            loan_date_input,loan_date_start,
                                            loan_date_return,loan_file,
                                            loan_total_item,loan_total_fee,
                                            long_loan,
                                            loan_status,member_id_fk
                                            ) 
                              VALUES ('".$kode."','".$invoice."',NOW(),'". $tgl_pjm ."','". $tgl_kmb ."',
                                      '".$fileName."','".$total_loan."','".$hasil_akhir_s2."','".$_POST['totalbayarpenajuan']."','MENUNGGU','".$_SESSION['member_id']."')";
                                       
                      $runSQLINSERT = mysql_query($queryInsert_loan_app);
                  // insert to trx_loan_application_detail
                  $kodealats  = $_POST['instrument_id_fk'];
                  $jumlahalats = $_POST['jumlah'];
                  $subtotalpinjams = $_POST['subtotal'];

                  $banyaks        = count($kodealats);
                    for ($ulang=0; $ulang <  $banyaks ; $ulang++) { 
                   $kodeInstruments = $kodealats[$ulang];
                   $jumlahalatinstruments = $jumlahalats[$ulang];
                   $suv = $subtotalpinjams[$ulang];
                   $queryInsertDetail_loan = "INSERT INTO trx_loan_application_detail 
                                                        (loan_app_id_fk,instrument_id_fk,loan_amount,loan_subtotal,loan_status_detail)
                                             VALUES 
                                             ('".$kode."','".$kodeInstruments."',
                                             '".$jumlahalatinstruments."','".$suv."','MENUNGGU')";
                                             $runSQLINSERT_detail = mysql_query($queryInsertDetail_loan);
                  }
                } else if ($category_member == 6) {
                    $potongan_s3 = $totalFee*0.25;
                    $hasil_akhir_s3=  $totalFee-$potongan_s3;
                    $queryInsert_loan_app = "INSERT INTO trx_loan_application 
                                            (loan_app_id,loan_invoice,
                                            loan_date_input,loan_date_start,
                                            loan_date_return,loan_file,
                                            loan_total_item,loan_total_fee,
                                            long_loan,
                                            loan_status,member_id_fk
                                            ) 
                              VALUES ('".$kode."','".$invoice."',NOW(),'". $tgl_pjm ."','". $tgl_kmb ."',
                                      '".$fileName."','".$total_loan."','".$hasil_akhir_s3."','".$_POST['totalbayarpenajuan']."','MENUNGGU','".$_SESSION['member_id']."')";
                                       
                      $runSQLINSERT = mysql_query($queryInsert_loan_app);
                  // insert to trx_loan_application_detail
                  $kodealats  = $_POST['instrument_id_fk'];
                  $jumlahalats = $_POST['jumlah'];
                  $subtotalpinjams = $_POST['subtotal'];

                  $banyaks        = count($kodealats);
                    for ($ulang=0; $ulang <  $banyaks ; $ulang++) { 
                   $kodeInstruments = $kodealats[$ulang];
                   $jumlahalatinstruments = $jumlahalats[$ulang];
                   $suv = $subtotalpinjams[$ulang];
                   $queryInsertDetail_loan = "INSERT INTO trx_loan_application_detail 
                                                        (loan_app_id_fk,instrument_id_fk,loan_amount,loan_subtotal,loan_status_detail)
                                             VALUES 
                                             ('".$kode."','".$kodeInstruments."',
                                             '".$jumlahalatinstruments."','".$suv."','MENUNGGU')";
                                             $runSQLINSERT_detail = mysql_query($queryInsertDetail_loan);
                  }
                }else {
                   $queryInsert_loan_app = "INSERT INTO trx_loan_application 
                                            (loan_app_id,loan_invoice,
                                            loan_date_input,loan_date_start,
                                            loan_date_return,loan_file,
                                            loan_total_item,loan_total_fee,
                                            long_loan,
                                            loan_status,member_id_fk
                                            ) 
                              VALUES ('".$kode."','".$invoice."',NOW(),'". $tgl_pjm ."','". $tgl_kmb ."',
                                      '".$fileName."','".$total_loan."','".$totalFee."','".$_POST['totalbayarpenajuan']."','MENUNGGU','".$_SESSION['member_id']."')";
                                       
                      $runSQLINSERT = mysql_query($queryInsert_loan_app);
                  // insert to trx_loan_application_detail
                  $kodealats  = $_POST['instrument_id_fk'];
                  $jumlahalats = $_POST['jumlah'];
                  $subtotalpinjams = $_POST['subtotal'];

                  $banyaks        = count($kodealats);
                    for ($ulang=0; $ulang <  $banyaks ; $ulang++) { 
                   $kodeInstruments = $kodealats[$ulang];
                   $jumlahalatinstruments = $jumlahalats[$ulang];
                   $suv = $subtotalpinjams[$ulang];
                   $queryInsertDetail_loan = "INSERT INTO trx_loan_application_detail 
                                                        (loan_app_id_fk,instrument_id_fk,loan_amount,loan_subtotal,loan_status_detail)
                                             VALUES 
                                             ('".$kode."','".$kodeInstruments."',
                                             '".$jumlahalatinstruments."','".$suv."','MENUNGGU')";
                                             $runSQLINSERT_detail = mysql_query($queryInsertDetail_loan);
                  }
                }
                 

                  


                   
            }

   }

     $queryDeleteLoan_temp = "DELETE FROM trx_loan_temp where member_id_fk='".$_SESSION['member_id']."' ";
     // hapus data di temporary keranjang
     $runSQLDELETE = mysql_query($queryDeleteLoan_temp);
    if ($runSQLDELETE) {
      echo "<script> alert('Terimakasih Data Berhasil Disimpan & Tunggu Konfirmasi Dari Kami'); location.href='index.php?hal=pengajuan-member/pengajuan-alat' </script>";exit;
    }
        

 ?>