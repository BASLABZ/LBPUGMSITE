
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
                            <div class="text-right"><b><i><span class="fa fa-home"></span> Home / <span class="fa fa-list"></span> Laporan / <span class="fa fa-users"> </span> Member</i></b></div>
                            
                        </div>
                       </div>
                    </div>
                    
                </div>
                 <div class="row">
                      <div class="col-lg-12">
                    <div class="panel panel-primary" style="border-color:#f8f8f8;">
                        <div class="panel-heading">
                            <span class=""></span>
                        </div>
                        <div class="panel-body dim_about">
                            <div class="row">
                                <form method="POST" action="index.php?hal=laporan/hasil_filter_lap_member">
                                    <div class="col-md-4">
                                        <div class="from-group">
                                            <label>Periode (Dari)</label>
                                            <input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" name='periode1'>
                                        </div> 
                                    </div>
                                    <div class="col-md-4">
                                        <div class="from-group">
                                            <label>Periode(Sampai)</label>
                                            <input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" name='periode2'>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="from-group">
                                        <br>
                                            <button type="submit" name="filter" class="btn btn-primary"> 
                                            <span class="fa fa-search"></span> Filter
                                            </button>
                                        </div>
                                    </div>
                                </form>

                            </div>    
                        </div>
                </div>
            </div>
                </div>
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary" style="border-color:#f8f8f8;">
                        <div class="panel-heading">
                            <span class=""></span> Laporan Data Member
                        </div>
                        <div class="panel-body dim_about">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="dataTables-example">
                                    <thead>
                                        <th>NO</th>
                                        <th>NAMA</th>
                                        <th>TANGGAL DAFTAR</th>
                                        <th>INSTANSI</th>
                                        <th>FAKULTAS / BIDANG</th>
                                        <th>EMAIL</th>
                                        <th>STATUS</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $no =1;
                                            $show = print_r("SELECT count(member_id) as total_member from tbl_member A join ref_category B on A.category_id_fk = B.category_id");
                                            $total = $show['total_member'];
                                            while ($runshow = mysql_fetch_array($show)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $runshow['member_name']; ?></td>
                                                <td><?php echo $runshow['member_register_date']; ?></td>
                                                <td><?php echo $runshow['member_institution']; ?></td>
                                                <td><?php echo $runshow['member_faculty']; ?></td>
                                                <td><?php echo $runshow['member_email']; ?></td>
                                                <td><?php echo $runshow['member_status']; ?></td>
                                            </tr> 
                                            <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                                Total : <?php echo $total; ?>
                             <div align="center">
                                <a href="laporan/export_laporan_rekap_data_member_exel.php" class="btn btn-success"><span class="fa fa-file-excel-o"></span> Export to Excel</a>
                                <a class="btn btn-warning" href="laporan/cetak_laporan_member_pdf.php" target="_BLANK"><span class="fa fa-file-pdf-o"></span> Export to PDF</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
