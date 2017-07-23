
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
                            <div class="text-right"><b><i><span class="fa fa-home"></span> Home / <span class="fa fa-list"></span> Transaksi / <span class="fa fa-check"> </span> SaLdo</i></b></div>
                            
                        </div>
                       </div>
                    </div>
                    
                </div>
            </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-primary" style="border-color:#f8f8f8;">
                            <div class="panel-heading">
                                <span class=""></span> Data Saldo 
                            </div>
                            <div class="panel-body dim_about">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>NAMA MEMBER</th>
                                                <th>TOTAL SALDO</th>
                                                <th>AKSI</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                    $no =0;
                                                    $query = mysql_query("SELECT s.saldo_total, s.saldo_status, s.saldo_id, m.member_name, m.member_id FROM trx_saldo s JOIN tbl_member m ON s.member_id_fk = m.member_id group by m.member_id order by m.member_id DESC");
                                                    
                                                    while ($row = mysql_fetch_array($query)) {  
                                                        $saldo_status = $row ['saldo_status']; 
                                                        $query_saldo_total_permember = mysql_query("SELECT SUM(saldo_total) as total_saldo, sum(saldo_cashout_amount) as cashout FROM trx_saldo where member_id_fk = '".$row['member_id']."'");
                                                        $row_saldo_total = mysql_fetch_array($query_saldo_total_permember);
                                                        $saldo_total_member = $row_saldo_total['total_saldo']; 
                                                        $saldo_keluar = $row_saldo_total['cashout'];
                                                        $saldo_sekarang = $saldo_total_member - $saldo_keluar;
                                             ?>
                                             <tr>
                                                 <td><?php echo ++$no; ?></td>
                                                 <td><?php echo $row['member_name']; ?></td>
                                                 <td>Rp <?php echo rupiah($saldo_sekarang); ?></td>
                                                
                                                 <td>
                                                     <a  href="#detail-saldo" id='custId' data-toggle='modal' data-id='<?php echo $row['member_id']; ?>' class="btn btn-info btn-sm dim_about"> <span class=""> Lihat Detail</span>  </a> 
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
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-primary">
                        <div class="panel-heading">Data Permohonan Pencairan Saldo</div>
                        <div class="panel-body">
                            <div class="col-md-12">
                        <table class="table table-hover table-striped table-responsive">
                            <thead>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jumlah Penarikan</th>
                                <th>Status</th>
                                <th>Nama Bank</th>
                                <th>Rekening</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                                <?php 
                                    $nourut = 1;
                                    $query_penarikan_saldo = mysql_query("SELECT * FROM trx_saldo s JOIN tbl_member m ON s.member_id_fk = m.member_id  where s.saldo_status = 'REQUEST' ORDER by s.saldo_cashout_date DESC");
                                    while ($row_saldo_request = mysql_fetch_array($query_penarikan_saldo)) {
                                        $status_saldo = $row_saldo_request ['saldo_status']
                                 ?>
                                 <tr>
                                     <td><?php echo $nourut++; ?></td>
                                     <td><?php echo $row_saldo_request['member_name']; ?></td>
                                     <!-- <td><?php //echo $row_saldo_request['saldo_cashout_date']; ?></td> -->
                                     <td>Rp <?php echo rupiah($row_saldo_request['saldo_cashout_amount']); ?></td>
                                     <td><?php 
                                            if ($status_saldo == 'REQUEST') {
                                                echo "<label class='label label-warning'>Permohonan Penarikan Saldo</label>";
                                            } elseif ($status_saldo == 'DEPOSIT') {
                                                echo "<label class='label label-info'>Deposit</label>";
                                            } elseif ($status_saldo == 'DIKONFIRMASI') {
                                                echo "<label class='label label-success'>Konfirmasi Pencairan</label>";
                                            }
                                      ?></td>
                                     <td><?php echo $row_saldo_request['saldo_bankname']; ?></td>
                                     <td><?php echo $row_saldo_request['saldo_accountnumber']; ?></td>
                                     <!-- <td>
                                         <img src="" class="img-responsive">
                                     </td -->>
                                     <td>
                                      <a  href="index.php?hal=saldo/konfirmasi-saldo&id=<?php echo $row_saldo_request['saldo_id']; ?>" class="btn btn-primary btn-sm dim_about"> <span class=""> Konfirmasi Pencairan</span>  </a> 
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
</div>
<div class="modal fade" id="detail-saldo" role="dialog" >
        <div class="modal-dialog modal-lg" style="width: 900px" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #1ab394; color:white;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><span class=""></span> Detail Saldo</h4>
                </div>
                <div class="modal-body" style="padding-top:10px; ">
                    <div class="detail-saldo-data"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger dim_about" data-dismiss="modal"><span class="fa fa-times"></span> Keluar</button>
                </div>
            </div>
        </div>
</div>
 <script type="text/javascript">
    $(document).ready(function(){
        $('#detail-saldo').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            
            $.ajax({
                type : 'post',
                url : 'saldo/detail_saldo.php',
                data :  'id='+ rowid,
                success : function(data){
                $('.detail-saldo-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });
    });
</script>

