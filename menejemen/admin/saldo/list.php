
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
                                            <th>JUMLAH SALDO</th>
                                            <th>STATUS</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                                $no =0;
                                                $query = mysql_query("SELECT s.saldo_total, s.saldo_status, m.member_name FROM trx_saldo s JOIN tbl_member m ON s.member_id_fk = m.member_id group by m.member_id");
                                                while ($row = mysql_fetch_array($query)) {    
                                         ?>
                                         <tr>
                                             <td><?php echo ++$no; ?></td>
                                             <td><?php echo $row['member_name']; ?></td>
                                             <td><?php echo $row['saldo_total']; ?></td>
                                             <td><?php echo $row['saldo_status']; ?></td>
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
