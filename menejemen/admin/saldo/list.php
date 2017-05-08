
<div id="content">
            <div class="inner">
                <div class="row" style="padding-top: 10px; padding-right: 10px; padding-left: 10px;">
                <div class="panel panel-primary" style="border-color: #1ab394;">
                    <div class="panel-heading">
                       <div class="row">
                            <div class="col-md-4">
                             <span class="fa fa-wrench"></span>TRANSAKSI SALDO MEMBER
                        </div>
                        <div class="col-md-8">
                            <div class="text-right"><b><i><span class="fa fa-home"></span> Home / <span class="fa fa-list"></span> Transaksi / <span class="fa fa-check"> </span> Sakdo</i></b></div>
                            
                        </div>
                       </div>
                    </div>
                    
                </div>
            </div>
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary" style="border-color:#f8f8f8;">
                        <div class="panel-heading">
                            <span class="fa fa-list"></span> Transaksi Saldo 
                        </div>
                        <div class="panel-body dim_about">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>NAMA MEMBER</th>
                                            <th>SISA SALDO</th>
                                            <th>NOMINAL PENARIKAN</th>
                                            <th>FILE PENGAJUAN</th>
                                            <th>STATUS</th>
                                            <th>KETERANGAN</th>
                                            <th width="20%">AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                                $no =0;
                                                $query = mysql_query("SELECT s.saldo_nominal,m.member_name FROM tbl_saldo s JOIN tbl_member m ON s.member_id_fk = m.member_id 
                                                    JOIN trx_loan_saldo ss ON
                                                    ss.saldo_id_fk = s.saldo_id
                                                    group by m.member_id");
                                                while ($row = mysql_fetch_array($query)) {    
                                         ?>
                                         <tr>
                                             <td><?php echo ++$no; ?></td>
                                             <td><?php echo $row['member_name']; ?></td>
                                             <td><?php echo $row['saldo_nominal']; ?></td>
                                             <td><?php echo $row['nominal_penarikan']; ?></td>
                                             <td><?php echo $row['file_saldo']; ?></td>
                                             <td><?php echo $row['saldo_status']; ?></td>
                                             <td><?php echo $row['keterangan']; ?></td>
                                             <td width="20%">
                                                 <button class="btn btn-warning btn-sm dim_about"> KONFIRMASI PENCAIRAN</button>
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
