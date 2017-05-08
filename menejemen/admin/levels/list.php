<!-- fungsi hapus data -->
<?php 
        if (isset($_GET['hapus'])) {
            $queryHapus = mysql_query("DELETE FROM ref_level where level_id = '".$_GET['hapus']."' ");
            if ($queryHapus) {
                echo "<script> alert('Data Berhasil DiHapus'); location.href='index.php?hal=levels/list' </script>";exit; 
            }
        }
 ?>
<div id="content">
			<div class="inner">
				<div class="row" style="padding-top: 10px; padding-right: 10px; padding-left: 10px;">
                <div class="panel panel-primary" style="border-color: #1ab394;">
                    <div class="panel-heading">
                       <div class="row">
                            <div class="col-md-4">
                             <span class="fa fa-users"></span> MASTER level belajar
                        </div>
                        <div class="col-md-8">
                            <div class="text-right"><b><i><span class="fa fa-home"></span> Home / <span class="fa fa-list"></span> Master Data / <span class="fa fa-users"> </span> level belajar</i></b></div>
                            
                        </div>
                       </div>
                    </div>
                    
                </div>
            </div>
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary" style="border-color:#f8f8f8;">
                        <div class="panel-heading">
                            <span class="fa fa-users"></span> Master level belajar <a href="index.php?hal=levels/add" class="btn btn-sm btn-success dim_about"><span class="fa fa-plus"></span> Tambah Data</a>
                        </div>
                        <div class="panel-body dim_about">
                            <div class="table-responsive">
                               <table class="table table-responsive table-bordered table-hover">
                                   <thead>
                                       <th>No</th>
                                       <th>Level</th>
                                       <th>Aksi</th>
                                   </thead>
                                   <tbody>
                                       <?php 
                                            $no = 1;
                                            $queryLevel = mysql_query("SELECT * from ref_level order by level_id asc");
                                            while ($rowLevel = mysql_fetch_array($queryLevel)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $rowLevel['level_name']; ?></td>
                                            <td>
                                                <a href="" class="btn btn-warning"><span class="fa fa-pencil"></span> Edit</a>
                                                <a href="index.php?hal=levels/list&hapus=<?php echo $rowLevel['level_id']; ?>" class="btn btn-danger"><span class="fa fa-trash"></span> Hapus</a>
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
