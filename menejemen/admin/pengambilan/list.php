        <div id="content">
            <div class="inner">
            <div class="row" style="padding-top: 10px; padding-right: 10px; padding-left: 10px;">
                <div class="panel panel-primary" style="border-color: #1ab394;">
                    <div class="panel-heading">
                       <div class="row">
                            <div class="col-md-4">
                             <span class="fa fa-pencil"></span> Transaksi Pengambilan Alat
                        </div>
                        <div class="col-md-8">
                        <span class="fa fa-home pull-right"> 
                        <i>Home / <span class="fa fa-list"></span> Transaksi / <span class="fa fa-pencil"> </span>
                            Pengambilan Alat
                        </i></span> 
                        </div>
                       </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary" style="border-color: white;">
                        <div class="panel-heading">
                            <span class="fa fa-list"></span> Transaksi Pengambilan Alat
                        </div>
                        <div class="panel-body dim_about">
                         <table class="table table-striped table-bordered table-hover"  id="dataTables-example">
                                                <thead>
                                                    <th>NO</th>
                                                    <th>Tanggal Pengajuan</th>
                                                    <th>No Nota / INVOICE</th>
                                                    <th>Nama</th>
                                                    <th>Tanggal Pinjam</th>
                                                    <th>Tanggal Kembali</th>
                                                    <th>Status</th>
                                                    <th>Aksi</th>
                                                </thead>
                                                <tbody>
                                                <?php 
                                                    $no = 1;
                                                    $querypengambilan = mysql_query("SELECT * FROM trx_loan_application a  JOIN tbl_member m on a.member_id_fk = m.member_id 
                                                        JOIN trx_payment p ON p.loan_app_id_fk = a.loan_app_id
                                                        where p.payment_valid = 'VALID'   ORDER BY a.loan_app_id DESC");
                                                    while ($roPengambilan_alat = mysql_fetch_array($querypengambilan)) {
                                                 ?>
                                                    <tr>
                                                        <td><?php echo $no++; ?></td>
                                                        <td><?php echo $roPengambilan_alat['loan_date_input']; ?></td>
                                                        <td><?php echo $roPengambilan_alat['loan_invoice']; ?></td>
                                                        <td><?php echo $roPengambilan_alat['member_name']; ?></td>
                                                        <td><?php echo $roPengambilan_alat['loan_date_start']; ?></td>
                                                        <td><?php echo $roPengambilan_alat['loan_date_return']; ?></td>
                                                        <td>
                                                            <label class="label label-warning"><?php echo $roPengambilan_alat['loan_status']; ?></label>
                                                            <label class="label label-primary"><?php echo $roPengambilan_alat['payment_notif']; ?></label>
                                                        </td>
                                                        <td>
                                                            <a href="#detail_pengamnilan_alat" data-toggle='modal' data-id='<?php echo $roPengambilan_alat['loan_invoice']; ?>' class="btn btn-info dim_about"> <span class="fa fa-eye"></span> LIHAT DATA</a>
                                                        </td>
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
<div class="modal fade" id="detail_pengamnilan_alat" role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #1ab394; color:white;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><span class="fa fa-flask"></span> DETAIL ALAT</h4>
                </div>
                <div class="modal-body">
                    <div class="pengambilan-data"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger dim_about" data-dismiss="modal"><span class="fa fa-times"></span> Keluar</button>
                </div>
            </div>
        </div>
</div>
<!-- show peminjaman modal -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#detail_pengamnilan_alat').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : 'pengambilan/detail_pengambilan.php',
                data :  'id='+ rowid,
                success : function(data){
                $('.pengambilan-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });
    });
</script>
