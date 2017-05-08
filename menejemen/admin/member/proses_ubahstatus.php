<?php 
		if (isset($_POST['ubahstatustolak'])) {
			  $updatestatus = mysql_query("UPDATE tbl_member set member_status='Ignore'
                WHERE member_id = '".$_POST['idmember']."'
             ");
             
             if ($updatestatus) {
             echo "<script> alert('Status Berhasil Diubah'); location.href='index.php?hal=member/list' </script>";exit;

             }
		}
		if (isset($_POST['ubahstatusterima'])) {
			  $updatestatus_terima = mysql_query("UPDATE tbl_member set member_status='Actived'
                WHERE member_id = '".$_POST['idmember']."'
             ");
             
             if ($updatestatus_terima) {
             echo "<script> alert('Status Berhasil Diubah'); location.href='index.php?hal=member/list' </script>";exit;

             }
		}
 ?>