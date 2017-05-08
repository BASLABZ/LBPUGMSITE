        <div id="content">
            <div class="inner">
            <div class="row" style="padding-top: 10px; padding-right: 10px; padding-left: 10px;">
                <div class="panel panel-primary" style="border-color: #1ab394;">
                    <div class="panel-heading">
                       <div class="row">
                            <div class="col-md-4">
                             <span class=""></span> 
                        </div>
                        <div class="col-md-8">
                            <div class="text-right"><b><i>  Home / <span class="fa fa-list"></span> Konfirmasi / <span class="fa fa-pencil">
                            </span>
                            Pengajuan Pinjaman</i></b></div>
                        </div>
                       </div>
                    </div>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary" style="border-color: white;">
                        <div class="panel-heading"><span class="fa fa-list"></span> Data Pengajuan</div>
                        <div class="panel-body dim_about">
                             <table class="table table-striped table-hover"  id="dataTables-example">
                                                <thead>
                                                    <th>NO</th>
                                                    <th>Tanggal Pengajuan</th>
                                                    <th>No Invoice</th>
                                                    <th>Nama Member</th>
                                                    <th>File Pengajuan</th>
                                                    <th>Status</th>
                                                    <th>Aksi</th>
                                                </thead>
                                                <tbody>
                                                <?php 
                                                    $no = 1;
                                                    $querypengajuan = mysql_query("SELECT * FROM trx_loan_application a  JOIN tbl_member m on a.member_id_fk = m.member_id where a.loan_status != 'DIBATALKAN'   ORDER BY a.loan_app_id DESC");
                                                    while ($roPeminjaman = mysql_fetch_array($querypengajuan)) {
                                                 ?>
                                                    <tr>
                                                        <td><?php echo $no++; ?></td>
                                                        <td><?php echo $roPeminjaman['loan_date_input']; ?></td>
                                                        <td><?php echo $roPeminjaman['loan_invoice']; ?></td>
                                                        <td><?php echo $roPeminjaman['member_name']; ?></td>
                                                        <td><a target="_BLANK" href="../../surat/<?php echo $roPeminjaman['loan_file']; ?>" class="btn btn-primary btn-sm dim_about"> <span class="fa fa-download"></span> 
                                                        Download File Pengajuan
                                                        </a></td>
                                                        <td><button class="btn btn-warning btn-xs dim_about"><?php echo $roPeminjaman['loan_status']; ?></button></td>
                                                        <td>
                                                        <a href="index.php?hal=peminjaman/pengajuan/pengajuan_detail&invoice=<?php echo $roPeminjaman['loan_invoice']; ?>" class='btn btn-info btn-sm dim_about'><span class="fa fa-eye"></span> Detail Pangajuan</a>
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
<div class="modal fade modal-lg" id="detail_pengajuan" role="dialog" >
        <div class="modal-dialog" role="document" style="width:900px; ">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #1ab394; color:white;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><span class="fa fa-flask"></span> Detail Pengajuan</h4>
                </div>
                <div class="modal-body" style="padding-top:10px; ">
                    <div class="detail_pengajuan-data"></div>
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
        $('#detail_pengajuan').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : 'peminjaman/pengajuan/detail_pengajuan.php',
                data :  'id='+ rowid,
                success : function(data){
                $('.detail_pengajuan-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });
    });
</script>