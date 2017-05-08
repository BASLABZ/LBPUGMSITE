        <div id="content">
            <div class="inner">
            <div class="row" style="padding-top: 10px; padding-right: 10px; padding-left: 10px;">
                <div class="panel panel-primary" style="border-color: #1ab394;">
                    <div class="panel-heading">
                       <div class="row">
                            <div class="col-md-4">
                             <span class="fa fa-pencil"></span> Transaksi Konfirmasi Pembayaran
                        </div>
                        <div class="col-md-8">
                        <span class="fa fa-home pull-right"> 
                        <i>Home / <span class="fa fa-list"></span> Transaksi / <span class="fa fa-pencil"> </span>
                            Konfirmasi Pembayaran
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
                            <span class="fa fa-list"></span> Transaksi Konfirmasi Pembayaran
                        </div>
                        <div class="panel-body dim_about">
                            <table class="table table-striped table-bordered table-hover"  id="dataTables-example">
                                                <thead>
                                                    <th>NO</th>
                                                    <th>INVOIVCE</th>
                                                    <th>NAMA</th>
                                                    <th>TANGGAL INPUT</th>
                                                    <th>TANGGAL KONFIRMASI</th>
                                                    <th>NAMA BANK</th>
                                                    <th>STATUS</th>
                                                    <th>FOTO BUKTI BAYAR</th>
                                                    <!-- <th>AKSI</th> -->
                                                </thead>
                                                <tbody>
                                                <?php 
                                                    $no =1;
                                                    $queryPembayaran = 
                                                        mysql_query("SELECT * FROM trx_payment_temp p JOIN trx_loan_application pe on p.loan_app_id_fk = pe.loan_app_id 
                                                        JOIN tbl_member m on pe.member_id_fk = m.member_id 
                                                        WHERE p.payment_status = 'TANPA SALDO & MEMBAYAR DENDA' OR p.payment_status = 'SALDO & MEMBAYAR DENDA' 
                                                        ORDER by p.payment_temp_id DESC
                                                        ");
                                                        
                                                    while ($roWPembayaran = mysql_fetch_array($queryPembayaran)) { ?>
                                                    <tr>
                                                        <td><?php echo $no++; ?></td>
                                                        <td><?php echo $roWPembayaran['loan_invoice']; ?></td>
                                                        <td><?php echo $roWPembayaran['member_name']; ?></td>
                                                        <td><?php echo $roWPembayaran['payment_temp_date']; ?></td>
                                                        <td><?php echo $roWPembayaran['payment_temp_confirm_date']; ?></td>
                                                        <td><?php echo $roWPembayaran['bankname']; ?></td>
                                                         <td><?php echo $roWPembayaran['payment_status']; ?></td>
                                                        <td><a href="../../surat/<?php echo $roWPembayaran['payment_temp_photo']; ?>"><img width="100" src="../../surat/<?php echo $roWPembayaran['payment_temp_photo']; ?>" class="img-thumbnail img-responsive"></a></td>
                                                       <!--  <td><a href="#detail_peminjaman_yangdibayar" data-toggle='modal' data-id='<?php //echo $roWPembayaran['loan_invoice']; ?>' class="btn btn-info dim_about"> <span class="fa fa-eye"></span> LIHAT DATA</a></td> -->
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
<div class="modal fade" id="detail_peminjaman_yangdibayar" role="dialog" >
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
    $(document).ready(function(){
        $('#detail_peminjaman_yangdibayar').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : 'pembayaran/slipPenagihan.php',
                data :  'id='+ rowid,
                success : function(data){
                $('.slipPenagihan-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });
    });
</script>
