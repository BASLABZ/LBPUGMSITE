<?php 
    session_start();
    include 'menejemen/inc/inc-db.php'; 
    if (isset($_GET['logout'])) {
         session_destroy();
         echo "<script> alert('Anda Berhasil Keluar Aplikasi'); location.href='index.php' </script>";exit;
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LBP - UGM : HOME</title>
    <link href="includes/css/bootstrap.min.css" rel="stylesheet">
    <link href="includes/css/animate.css" rel="stylesheet">
    <link href="includes/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="includes/css/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style-bas.css">
    <link rel="stylesheet" type="text/css" href="includes/css/plugins/steps/jquery.steps.css">
    <link rel="stylesheet" type="text/css" href="includes/css/plugins/datapicker/datepicker3.css">
    <link rel="stylesheet" type="text/css" href="includes/css/plugins/dataTables/datatables.min.css">
     <link rel="stylesheet" href="menejemen/admin/assets/css/bootstrap-fileupload.min.css" /> 
     <link href="includes/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <style type="text/css">
             .dim_about {box-shadow: inset 0 0 0 rgba(30, 172, 174, 0.39), 0 10px 0 0 rgba(30, 172, 174, 0), 0 8px 10px rgba(123, 83, 83, 0.58);}

    </style>
</head>
<body id="page-top" class="landing-page">
<?php include 'topmenu.php'; ?>
<?php 
        if(isset($_GET['hal']))
            {
                if($_GET['hal'] == 'logins')
                {
                    if(isset($_SESSION['member_id'])
                     && isset($_SESSION['member_name'])) 
                        {include($_GET['hal'].'.php');}
                    else
                    { include('content.php'); }
                }else{ include($_GET['hal'].'.php');}
            }
            else{ include('content.php'); }
 ?>
<?php include 'contact.php'; ?>
<!-- modal load data detail instrument -->
<div class="modal fade" id="myModal" role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #1ab394; color:white;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><span class="fa fa-flask"></span> Detail Instrument</h4>
                </div>
                <div class="modal-body">
                    <div class="fetched-data"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger dim_about" data-dismiss="modal"><span class="fa fa-times"></span> Keluar</button>
                </div>
            </div>
        </div>
</div>
<!-- modal detail peminjaman -->
<div class="modal fade" id="detail_peminjaman" role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #1ab394; color:white;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><span class="fa fa-flask"></span> Detail Peminjaman</h4>
                </div>
                <div class="modal-body">
                    <div class="peminjaman-data"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger dim_about" data-dismiss="modal"><span class="fa fa-times"></span> Keluar</button>
                </div>
            </div>
        </div>
</div>
<!-- modal show slip penagihan -->
<div class="modal fade" id="slipPenagihan" role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #1ab394; color:white;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><span class="fa fa-flask"></span> DETAIL PEMINJAMAN & KONFIRMASI PEMINJAMAN</h4>
                </div>
                <div class="modal-body">
                    <div class="slipPenagihan-data"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger dim_about" data-dismiss="modal"><span class="fa fa-times"></span> Keluar</button>
                </div>
            </div>
        </div>
</div>
<div class="modal fade" id="pengembalian" role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #1ab394; color:white;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><span class="fa fa-flask"></span> Detail Peminjaman</h4>
                </div>
                <div class="modal-body">
                    <div class="pengembalian-data"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger dim_about" data-dismiss="modal"><span class="fa fa-times"></span> Keluar</button>
                </div>
            </div>
        </div>
</div>

<script src="includes/js/jquery-2.1.1.js"></script>
<script src="includes/js/bootstrap.min.js"></script>
<script src="includes/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="includes/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="includes/js/inspinia.js"></script>
<script src="includes/js/plugins/pace/pace.min.js"></script>
<script src="includes/js/plugins/wow/wow.min.js"></script>
<script src="includes/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script src="includes/js/plugins/dataTables/datatables.min.js"></script>
<script src="includes/js/plugins/staps/jquery.steps.min.js"></script>
<script src="includes/js/plugins/validate/jquery.validate.min.js"></script>
<script src="menejemen/admin/assets/plugins/jasny/js/bootstrap-fileupload.js"></script>
<script src="includes/notify.min.js"></script>
<script src="js-bas.js"></script>
<script src="includes/js/plugins/toastr/toastr.min.js"></script>
<script>

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>
<script type="text/javascript">
    $(document).ready(function(){

        $("#keranjang").on('input', '.txtCal', function () {

               var calculated_total_sum = 0;
               $("#keranjang .txtCal").each(function () {
                   var get_textbox_value = $(this).val();
                   if ($.isNumeric(get_textbox_value)) {
                      calculated_total_sum += parseFloat(get_textbox_value);
                      }                  
                    });
                      $("#total_sum_value").html(calculated_total_sum);
               });
});
// datatables for all bas-style-table
$(document).ready(function() {
          $('.table-alat').DataTable({
            "scrollX": true
          });
          $('#instrument').DataTable( {
            "sScrollX": "100%",
            // "sScrollXInner": "110%",
            "bScrollCollapse": true,
            "pageLength": 5,
             "fixedHeader": true
        } );
          $('#rekappembayaran').DataTable( {
              "scrollX": true
        } );
          $('#keranjang').dataTable();
      });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#myModal').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : 'detail_alat.php',
                data :  'id='+ rowid,
                success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });
    });
</script>


    

</body>
</html>

<?php include 'modal-login.php'; ?>
<?php include 'registrasi_member.php'; ?>
<?php include 'modal-lupa-password.php'; ?>