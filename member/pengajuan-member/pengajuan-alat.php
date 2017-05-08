<?php 
        if (isset($_GET['batalkan'])) {
                
              $queryPembatalanPengajuan = mysql_query("UPDATE trx_loan_application set loan_status ='MENUNGGU' where loan_invoice='".$_GET['batalkan']."' ");
            }
            if (isset($_GET['konfirmasi'])) {
                 
                $queryKonfirmasiSetelahbatal = mysql_query("UPDATE trx_loan_application set loan_status ='DIBATALKAN' where loan_invoice='".$_GET['konfirmasi']."' ");
            }
 ?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>PENGAJUAN ALAT</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index-2.html">Home</a>
            </li>
            <li>
                <a>PENGAJUAN-ALAT</a>
            </li>
            <li class="active">
                <strong>Daftar Pengajuan</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row animated fadeInRight">
        <div class="col-md-12">
            <div class="ibox">
                <div class="ibox-title dim_about" style="background-color: #1ab394; border-color: #1ab394; color: white;"><span class="fa fa-list"></span> Daftar Transaksi Pengajuan Alat</div>
                <div class="ibox-content">
                    <form class="role well" method="POST">
                        <div class="form-group row">
                            <label class="col-md-4 text-right" style="padding-top: 5px;">Filter</label>
                            <div class="col-md-4">
                                <select class="form-control">
                                <option value="">Filter Status</option>
                                <option value="MENUNGGU">MENUNGGU</option>
                                <option value="ACC">ACC</option>
                                <option value="DITOLAK">DITOLAK</option>
                                <option value="DIKONFIRMASI">DIKONFIRMASI</option>
                                <option value="PEMBATALAN">PEMBATALAN</option>
                            </select>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                        <table class="table table-responsive table-bordered table-striped table-hover"id="instrument">    
                        <thead>
                            <th>NO</th>
                            <th>INVOICE</th>
                            <th>TANGGAL PENGAJUAN</th>
                            <th>TANGGAL PINJAM</th>
                            <th>TANGGAL KEMBALI</th>
                            <th>STATUS</th>
                            <th>DETAIL PENGAJUAN</th>
                        </thead>
                        <tbody>
                           <?php 
                            $queryPeminjaman = mysql_query("SELECT * FROM trx_loan_application where member_id_fk  = '".$_SESSION['member_id']."' ORDER BY loan_app_id desc");
                            $no=0;
                            while ($rowPeminjaman = mysql_fetch_array($queryPeminjaman)) {
                              ?>
                                <tr>
                                        <td><?php echo ++$no; ?></td>
                                        <td><?php echo $rowPeminjaman['loan_invoice']; ?></td>
                                        <td><?php echo $rowPeminjaman['loan_date_input']; ?></td>
                                        <td><?php echo $rowPeminjaman['loan_date_start']; ?></td>
                                        <td><?php echo $rowPeminjaman['loan_date_return']; ?></td>
                                        <td>
                                          <button class='btn btn-info btn-sm dim_about'><span class="fa fa-check"></span> <?php echo $rowPeminjaman['loan_status']; ?></button>
                                        </td>  
                                        <?php echo "<td><a href='#detail_peminjaman'  class='btn btn-warning btn-sm dim_about' id='custId' data-toggle='modal' data-id='".$rowPeminjaman['loan_invoice']."'><span class=''></span> Detail Pengajuan</a></td>"; ?>
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
</div>
   <div class="modal fade" id="detail_peminjaman" role="dialog" >
        <div class="modal-dialog" style="width: 800px"  role="document">
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