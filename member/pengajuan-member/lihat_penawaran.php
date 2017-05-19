<?php 
    $idpengajuan = $_GET['idpengajuan'];
    $idloandetail = $_GET['id'];
    $query = "SELECT * FROM trx_rejected_detail de join trx_rejected re 
                                        ON de.rejected_id_fk = re.rejected_id
                                        JOIN trx_loan_application_detail dl 
                                        ON re.loan_app_detail_id_fk = dl.loan_app_detail_id
                                        JOIN ref_instrument i
                                        ON dl.instrument_id_fk = i.instrument_id
                                         where dl.loan_app_detail_id = '".$idloandetail."'";
                                         $rowdetail = mysql_fetch_array(mysql_query($query));
    if (isset($_POST['hapuspenawaran'])) {
        $queryupdatestatus_pengajuan = mysql_query("UPDATE trx_loan_application set loan_status = 'MENUNGGU ACC FINAL' where loan_app_id = '".$rowdetail['loan_app_id_fk']."' ");
        $queryInstrument = mysql_query("DELETE FROM trx_loan_application_detail where loan_app_detail_id = '".$rowdetail['loan_app_detail_id']."' ");
        $queryHapusPenawaran = mysql_query("DELETE FROM trx_rejected where rejected_id='".$rowdetail['rejected_id']."'");
        $queryHapusPenawaran_detail = mysql_query("DELETE FROM trx_rejected_detail where rejected_detail_id='".$_POST['idreject']."'");
        if ($queryHapusPenawaran_detail) {
             echo "<script>alert ('Data Penawaran Telah Dihapus'); location.href='index.php?hal=pengajuan-member/pengajuan-alat'</script>";
        }
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
                <a>Penawaran Pengajuan</a>
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
                <div class="ibox-title dim_about" style="background-color: #1ab394; border-color: #1ab394; color: white;"><span class=""></span> Data Penolakan Dan Penawaran Alat</div>
                <div class="ibox-content">
                   <div class="row">
                       <div class="col-md-6">
                           <label>Data Alat Yang Di Tolak</label>
                         
                       </div>
                       <div class="col-md-12">
                           <table class="table table-bordered table-responsive table-hover">
                               <thead>
                                    <th>Nama Instrument</th>
                                    <th>Status Peminjaman</th>
                                    <th>Alat Yang Diminta</th>
                                    <th>Subtutotal</th>
                               </thead>
                               <tbody>
                                   <?php 
                                        $queryPermintaan = mysql_query("SELECT * FROM trx_rejected_detail de join trx_rejected re 
                                        ON de.rejected_id_fk = re.rejected_id
                                        JOIN trx_loan_application_detail dl 
                                        ON re.loan_app_detail_id_fk = dl.loan_app_detail_id
                                        JOIN ref_instrument i
                                        ON dl.instrument_id_fk = i.instrument_id
                                         where dl.loan_app_detail_id = '".$idloandetail."'");
                                            while ($rowPenolakan = mysql_fetch_array($queryPermintaan)) {
                                         ?>
                                         <tr>
                                            <td><?php echo $rowPenolakan['instrument_name']; ?></td>
                                            <td><?php echo $rowPenolakan['loan_status_detail']; ?></td>
                                            <td><?php echo $rowPenolakan['loan_amount']; ?></td>
                                            <td><?php echo $rowPenolakan['loan_status_detail']; ?></td>
                                         </tr>

                                        <?php } ?>
                               </tbody>
                           </table>

                       </div>
                       <hr>

                       <div class="col-md-12">
                       
                       <label>Data Alat Yang ditawarkan</label>
                         <form class="role" method="POST">          
                        <input type="hidden" name="idreject" value="<?php echo $rowdetail['rejected_detail_id']; ?>">
                    <button type="submit" class="btn btn-warning"><span class="fa fa-save"></span> Setujui Penawaran</button>
                    <button type="submit" name="hapuspenawaran" class="btn btn-danger"><span class="fa fa-trash"></span> Hapus Alat Yang Ditolak  Dan Alat yang ditawarkan</button>
                           </form>
                           <br>
                           <table class="table table-responsive table-bordered table-stripped">
                                    <thead>
                                        <th>Nama Instrument</th>
                                        <th>Jumlah Ketersediaan Alat</th>
                                        <th>Jumlah Alat Yang Ditawarkan</th>
                                        <th>Sub total</th>
                                        <th>Keterangan</th>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $queryPenawaran = mysql_query("SELECT de.rejected_text,de.rejected_detail_id,i.instrument_quantity,x.instrument_name,x.instrument_fee,de.rejected_detail_loan_amount ,de.rejected_detail_loan_subtotal FROM trx_rejected_detail de join trx_rejected re 
                                        ON de.rejected_id_fk = re.rejected_id
                                        JOIN trx_loan_application_detail dl 
                                        ON re.loan_app_detail_id_fk = dl.loan_app_detail_id
                                        JOIN ref_instrument i
                                        ON dl.instrument_id_fk = i.instrument_id
                                        JOIN ref_instrument x
                                        ON de.instrument_id_rejected_fk = x.instrument_id
                                       where dl.loan_app_detail_id = '".$idloandetail."' ");
                                            while ($rowpenawaran = mysql_fetch_array($queryPenawaran)) {
                                         ?>

                                         <tr>
                                            <td><?php echo $rowpenawaran['instrument_name']; ?></td>
                                            <td><?php echo $rowpenawaran['instrument_quantity']-$rowpenawaran['intrument_quantity_temp']; ?></td>
                                            <td><?php echo $rowpenawaran['rejected_detail_loan_amount']; ?></td>
                                            <td><?php echo $rowpenawaran['rejected_detail_loan_subtotal']; ?></td>
                                            <td><?php echo $rowpenawaran['rejected_text']; ?></td>
                                            
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
  