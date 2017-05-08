<?php  
    session_start();
    include '../inc/inc-db.php';
    if (isset($_GET['logout'])) 
      {
        session_destroy();
        echo "<script> alert('Anda Berhasil Keluar Aplikasi'); location.href='../index.php' </script>";exit;
      }



     // if ($_SESSION['level_name'] == "admin" OR $_SESSION['level_name']=='koordinator penelitian' OR $_SESSION['level_name']=='kepala laboratorium' OR $_SESSION['level_name']=='superadmin'){ 

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Laboratorium Bioantropologi dan Paleantropologi </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="assets/css/theme.css" />
    <link rel="stylesheet" href="assets/css/MoneAdmin.css" />
    <link rel="stylesheet" href="assets/plugins/Font-Awesome/css/font-awesome.css" />
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/autofill/2.1.3/css/autoFill.bootstrap.min.css"> -->
    <link rel="stylesheet" type="text/css" href="assets/plugins/dataTables/dataTables.bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/font-awesome/css/font-awesome.min.css">
    <style type="text/css">
             .dim_about {box-shadow: inset 0 0 0 rgba(30, 172, 174, 0.39), 0 10px 0 0 rgba(30, 172, 174, 0), 0 8px 10px rgba(123, 83, 83, 0.58);}
             .panel-primary .panel-heading {
                  color: #ffffff;
                  background-color: #1ab394;
                  border-color: #1ab394;
             }
              .widget {
                            border-radius: 5px;
                            padding: 15px 20px;
                            margin-bottom: 10px;
                            margin-top: 10px;
                              }
                              .lazur-bg, .bg-info {
                                  background-color: #23c6c8;
                                  color: #ffffff;
                              }

    </style>

    <script src="assets/plugins/jquery-2.0.3.min.js"></script>
     <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>
     <script src="assets/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="assets/plugins/dataTables/dataTables.bootstrap.js"></script>
</head>
        

        <?php include 'topmenu.php'; ?>
        <?php include 'sidebar.php'; ?>
         <?php 
              if(empty( $_GET['hal']) ||  $_GET['hal'] ==""){
                $_GET['hal'] = "content.php";
              }
              if(file_exists( $_GET['hal'].".php")){
                include  $_GET['hal'].".php";
              }else {
                include"content.php";
              }   
        ?> 
    </div>
    <div id="footer" style="background-color: #1ab394; border-color: #1ab394; color: white;"><p class="pull-right">@copyright <?php echo date('Y'); ?> Develope by Amanda</p></div>
    
    
    <script type="text/javascript">
      $(document).ready(function() {
          $('.table-operator').DataTable();
           $('#dataTables-example').dataTable({
              "pageLength": 5,
               "scrollX": true
           });
            $('.table-pengajuan').dataTable();
            $('#table-pengguna').dataTable();

      });
  </script>
  
</body>
</html>

<?php
    
//   }if (!isset($_SESSION['level_name'])){
//       header('location:../index.php');
// }
?>