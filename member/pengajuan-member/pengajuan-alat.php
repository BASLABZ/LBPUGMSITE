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
        <br/>
        <ol class="breadcrumb">
            <li>
                <a href="index-2.html">Home</a>
            </li>
            <li>
                <a>Pengajuan</a>
            </li>
            <li class="active">
                <strong>Daftar Pengajuan Peminjaman Alat</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row animated fadeInRight">
        <div class="col-md-12">
            <div class="ibox">
                <div class="ibox-title dim_about" style="background-color: #1ab394; border-color: #1ab394; color: white;"><span class=""></span> Data Pengajuan</div>
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
                        <table class="table table-responsive table-bordered table-striped table-hover" id="instrument">    
                        <thead>
                            <th><center>NO</center></th>
                            <th><center>INVOICE</center></th>
                            <th><center>TANGGAL PENGAJUAN</center></th>
                            <th><center>TANGGAL PINJAM</center></th>
                            <th><center>TANGGAL HARUS KEMBALI</center></th>
                            <th><center>STATUS</center></th>
                            <th><center>DETAIL PENGAJUAN</center></th>
                        </thead>
                        <tbody>
                           <?php 
                            $queryPeminjaman = mysql_query("SELECT * FROM trx_loan_application where member_id_fk  = '".$_SESSION['member_id']."' ORDER BY loan_app_id desc");
                            $no=0;
                            while ($rowPeminjaman = mysql_fetch_array($queryPeminjaman)) {
                                $status_peminjaman = $rowPeminjaman['loan_status'];
                              ?>
                                <tr>
                                        <td><center><?php echo ++$no; ?></center></td>
                                        <td><center><?php echo $rowPeminjaman['loan_invoice']; ?></center></td>
                                        <td><center><?php echo $rowPeminjaman['loan_date_input']; ?></center></td>
                                        <td><center><?php echo $rowPeminjaman['loan_date_start']; ?></center></td>
                                        <td><center><?php echo $rowPeminjaman['loan_date_return']; ?></center></td>
                                        <td>
                                          <center>
                                              <?php if ($status_peminjaman == 'MENUNGGU') {
                                                  echo "<label class='label label-warning'>MENUNGGU</label>";
                                              } elseif ($status_peminjaman == 'DIBATALKAN') {
                                                  echo "<label class='label label-danger'>DIBATALKAN</label>";
                                              } elseif ($status_peminjaman == 'MENUNGGU ACC FINAL') {
                                                  echo "<label class='label label-default'>MENUNGGU ACC FINAL</label>";
                                              } elseif ($status_peminjaman == 'ACC FINAL') {
                                                  echo "<label class='label label-info'>ACC FINAL</label>";                                         
                                              } elseif ($status_peminjaman == 'MEMBAYAR TAGIHAN') {
                                                  echo "<label class='label label-primary'>MEMBAYAR TAGIHAN</label>";
                                              } elseif ($status_peminjaman == 'DIPINJAM') {
                                                  echo "<label class='label label-success'>DIPINJAM</label>";
                                              }
                                              ?>
                                          </center>

                                          <?php 
                                                if ($rowPeminjaman['loan_status'] == 'PERPANJANG') {
                                                    $queryPerpanjang = mysql_fetch_array(mysql_query("SELECT * FROM  trx_longtime WHERE loan_app_id_fk = '".$rowPeminjaman['loan_app_id']."'"));
                                                    echo "Tanggal Perpanjang Awal : "; echo $queryPerpanjang['longtime_date_start'];
                                                    echo "<br>";
                                                    echo "Tanggal Akhir Perpanjang"; echo $queryPerpanjang['longtime_date_return'];
                                                }
                                           ?>
                                        </td>  
                                        <?php echo "<td><center><a href='#detail_peminjaman'  class='' id='custId' data-toggle='modal' data-id='".$rowPeminjaman['loan_invoice']."'><span class=''></span> Lihat Detail</a></center></td>"; ?>
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
                    <h4 class="modal-title"><span class=""></span> Detail Peminjaman</h4>
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