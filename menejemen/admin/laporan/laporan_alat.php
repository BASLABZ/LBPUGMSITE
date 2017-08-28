
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
                            <div class="text-right"><b><i><span class="fa fa-home"></span> Home / <span class="fa fa-list"></span> Laporan / <span class="fa fa-users"> </span> Alat</i></b></div>
                            
                        </div>
                       </div>
                    </div>
                    
                </div>
            </div>
            
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary" style="border-color:#f8f8f8;">
                        <div class="panel-heading">
                            <span class=""></span> Laporan Data Alat
                        </div>
                        <div class="panel-body dim_about">
                            <div class="table-responsive">
                               <table class="table table-striped table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>NAMA ALAT</th>
                                            <th>MERK</th>  
                                            <th>HARGA SEWA</th>
                                            <th>JUMLAH</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $no = 1;
                                        $query = mysql_query("SELECT * from ref_instrument order by instrument_id DESC");
                                        while ($row = mysql_fetch_array($query)) {
                                                $var_gambar     = "../image/".$row['instrument_picture'];
                                     ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $row['instrument_name']; ?></td>
                                            <td><?php echo $row['instrument_brand']; ?></td>
                                            <td>Rp.<?php echo rupiah($row['instrument_fee']); ?></td>
                                            <td><?php echo $row['instrument_quantity']; ?></td>
                                            
                                        </tr>
                                       <?php } ?>
                                    </tbody>
                                </table>
                             <div align="center">
                                <a href="laporan/cetak_laporan_alat_excel.php" class="btn btn-success"><span class="fa fa-file-excel-o"></span> Export to Excel</a>
                                <a class="btn btn-warning" href="laporan/cetak_laporan_alat_pdf.php" target="_BLANK"><span class="fa fa-file-pdf-o"></span> Export to PDF</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
