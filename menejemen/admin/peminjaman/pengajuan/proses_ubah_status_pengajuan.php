<?php 
				 $queryUpdateStatusLoanAPP = mysql_query("UPDATE trx_loan_application set loan_status = '".$_POST['loan_status']."' where loan_app_id = '".$_POST['loan_app_id']."'");
                 echo "<script>  location.href='index.php?hal=peminjaman/pengajuan/pengajuan_detail&invoice=$invoice' </script>";exit;
 ?>