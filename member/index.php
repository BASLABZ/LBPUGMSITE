<?php 
    session_start();
    include '../menejemen/inc/inc-db.php';
    if (isset($_GET['logout'])) {

        $updateLogin = mysql_query("UPDATE tbl_member set member_login = 'N' where member_id = '".$_SESSION['member_id']."' ");
        session_destroy();
        echo "<script> alert('Anda Berhasil Keluar Aplikasi'); location.href='../index.php' </script>";exit;}
    if ($_SESSION['member_id']&&$_SESSION['member_name']) {
 ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MEMBER AREA | LBPUGM</title>
    <link href="../includes/css/bootstrap.min.css" rel="stylesheet">
    <link href="../includes/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../includes/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <link href="../includes/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
    <link href="../includes/css/animate.css" rel="stylesheet">
    <link href="../includes/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../menejemen/admin/assets/css/bootstrap-fileupload.min.css" /> 
        <link rel="stylesheet" type="text/css" href="../includes/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="../includes/css/plugins/datapicker/datepicker3.css">
    <style type="text/css">
        .dim_about {box-shadow: inset 0 0 0 rgba(30, 172, 174, 0.39), 0 10px 0 0 rgba(30, 172, 174, 0), 0 8px 10px rgba(123, 83, 83, 0.58);}
        .ui-datepicker-month{
          color: black;
        }
        .ui-datepicker-year{
          color: black;
        }
    </style>
</head>
<body class="md-skin">
    <div id="wrapper">
      <?php include 'sidebar-memberarea.php'; ?>

        
        <div id="page-wrapper" class="gray-bg dashbard-1">
        <?php include 'topmenu-memberarea.php'; ?>
        <!-- main members -->
        <?php 
            if(empty( $_GET['hal']) ||  $_GET['hal'] ==""){
                $_GET['hal'] = "content-memberarea.php";
              }
              if(file_exists( $_GET['hal'].".php")){
                include  $_GET['hal'].".php";
              }
              else {
                include"content-memberarea.php";
              }
         ?>
    </div>
    <script src="../includes/js/jquery-2.1.1.js"></script>
    <script src="../includes/js/bootstrap.min.js"></script>
    <script src="../includes/js/plugins/datapicker/bootstrap-datepicker.js"></script>
    <script src="../includes/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="../includes/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="../includes/js/plugins/flot/jquery.flot.js"></script>
    <script src="../includes/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="../includes/js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="../includes/js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="../includes/js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="../includes/js/plugins/peity/jquery.peity.min.js"></script>
    <script src="../includes/js/demo/peity-demo.js"></script>
    <script src="../includes/js/inspinia.js"></script>
    <script src="../includes/js/plugins/pace/pace.min.js"></script>
    <script src="../includes/js/plugins/jquery-ui/jquery-ui.min.js"></script>

<script type="text/javascript" src="../includes/jquery-ui.js"></script>

    <script src="../includes/js/plugins/gritter/jquery.gritter.min.js"></script>
    <script src="../includes/js/plugins/sparkline/jquery.sparkline.min.js"></script>
    <script src="../includes/js/demo/sparkline-demo.js"></script>
    <script src="../includes/js/plugins/toastr/toastr.min.js"></script>
    <script src="../menejemen/admin/assets/plugins/jasny/js/bootstrap-fileupload.js"></script>
   <script type="text/javascript">
     $('[data-toggle="tooltip"]').tooltip();
       $(document).ready(function(){
        $('#myModal').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : 'detail_instrument.php',
                data :  'id='+ rowid,
                success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });
    });
    // keranjang belanja
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
     // detail peminjaman member untuk di pengajuan
     $(document).ready(function(){
        $('#detail_peminjaman').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : 'pengajuan-member/detail_peminjaman.php',
                data :  'id='+ rowid,
                success : function(data){
                $('.peminjaman-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });
    });

     
   </script>
   <script type="text/javascript">
     // Calendar Dates
    /* create an array of days which need to be disabled */
    var disabledDays = ["11-13-2012","11-14-2012","11-15-2012","11-29-2012","11-30-2012"];

    /* utility functions */
    function nationalDays(date) {
      var m = date.getMonth(), d = date.getDate(), y = date.getFullYear();
      //console.log('Checking (raw): ' + m + '-' + d + '-' + y);
      for (i = 1; i < disabledDays.length; i++) {
        if($.inArray((m+1) + '-' + d + '-' + y,disabledDays) != -1 || new Date() > date) {
          return [false];
        }
      }
      return [true];
    }
      //Block the Weekends
      function noWeekendsOrHolidays(date) {
         var noWeekend = $.datepicker.noWeekends(date);
          if (noWeekend[0]) {
              return nationalDays(date);
          } else {
              return noWeekend;
          }
      }
        function days() {
                    var a = $("#tgl_pinjams").datepicker('getDate').getTime(),
                        b = $("#tgl_kembalis").datepicker('getDate').getTime(),
                        c = 24*60*60*1000,
                        diffDays = Math.round(Math.abs((a - b)/(c)));
                    if (diffDays < 0) {
                      alert('data tidak valid');

                    }else{
                      $("#totaldays").val(diffDays)
                       var bagi = diffDays/7;
                       var hasilconversi = bagi.toFixed();
                      $("#Minggu").val(hasilconversi)
                    }
        }


        $(document).ready(function () {
        $.datepicker.setDefaults({dateFormat: 'mm/dd/yy',minDate: +1,changeMonth: true,changeYear: true,numberOfMonths: 2,constrainInput:true,beforeShowDay:nationalDays,});
                var selector = function (dateStr) {
                    var d1 = $('#tgl_pinjams').datepicker('getDate');
                    var d2 = $('#tgl_kembalis').datepicker('getDate');
                    var diff = 0;
                    var totalhari = 0;
                    if (d1 && d2) {
                        diff = Math.floor((d2.getTime() - d1.getTime()) / 86400000); // ms per day

                        totalhari = diff+1;
                    }
                   if (totalhari<0) {
                    alert('data tidak valid');
                    
                    $('#tgl_pinjams').val("");
                    $('#tgl_kembalis').val("");
                    
                    $('#totaldays').value("");
                    $('#Minggu').value("");
                   }else{
                    
                    var bagi = totalhari/7;
                    var hasilconversi = bagi.toFixed();
                    // minggu pertama
                    if (bagi < 1) {
                      $("#Minggu").val(1);
                    }else if(bagi > 1){
                      var hasiljumlah = bagi+1;
                      var hasilakhir = Math.floor(hasiljumlah);
                      $("#Minggu").val(hasilakhir);
                    }

                     $('#totaldays').val(totalhari);
                     // $("#Minggu").val(hasilconversi);
                   }
                }
        $('#tgl_pinjams').datepicker({
                    onSelect: function(selectedDate) {
            var minDate = $(this).datepicker('getDate');
            if (minDate) {minDate.setDate(minDate.getDate() + 3);}//min days requires
            $('#tgl_kembalis').datepicker('option', 'minDate', minDate || 1); // Date + 1 or tomorrow by default
            days();
        }});
        $('#tgl_kembalis').datepicker({minDate: 1, onSelect: function(selectedDate) {
            var maxDate = $(this).datepicker('getDate');    
            if (maxDate) {maxDate.setDate(maxDate.getDate() - 1);}
            $('#tgl_pinjams').datepicker('option', 'maxDate', maxDate); // Date - 1    
            days();
        }});
            $('#tgl_pinjams,#tgl_kembalis').change(selector)
                });

   </script>
   <script type="text/javascript">
     // keranjang
     $("#keranjang").on('input', '.txtCal', function () {
       var calculated_total_sum = 0;
       var lamapinjam = document.getElementById('totaldays').value;
       $("#keranjang .txtCal").each(function () {
           var get_textbox_value = $(this).val();
           if ($.isNumeric(get_textbox_value)) {
              calculated_total_sum += parseFloat(get_textbox_value);
              
              }                  
            });
              $("#total_sum_value").html(calculated_total_sum);
       });   
     // datepinjam
     var yesterday = new Date((new Date()).valueOf()-1000*60*60*24);
     $('#tgl_pinjams').datepicker(
        {
          minDate: 0,
          beforeShowDay: $.datepicker.noWeekends
        }
      );
     // date kembali
     $('#tgl_kembalis').datepicker(
     {
          minDate: 0,
          beforeShowDay: $.datepicker.noWeekends
          
     }
      );
     // tanggal konfirmasi pembayaran 
     $('#tanggal_konfirmasi_pembayaran_member').datepicker(
        {
          minDate: 0,
          beforeShowDay: $.datepicker.noWeekends
        }
      );
   </script>
   <script type="text/javascript">
     window.onload = hitung(1)
   </script>
</body>
</html>
<?php }else{
    include 'error404.php';
    } ?>

