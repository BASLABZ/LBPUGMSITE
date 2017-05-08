<div id="content">
            <div class="inner">
                <div class="row" style="padding-top: 10px; padding-right: 10px; padding-left: 10px;">
                <div class="panel panel-primary" style="border-color: #1ab394;">
                    <div class="panel-heading">
                       <div class="row">
                            <div class="col-md-4">
                             <span class="fa fa-sitemap"></span> MASTER LEVEL
                        </div>
                        <div class="col-md-8">
                            <div class="text-right"><b><i><span class="fa fa-home"></span> Home / <span class="fa fa-list"></span> Master Data / <span class="fa fa-sitemap"> </span> Level</i></b></div>
                            
                        </div>
                       </div>
                    </div>
                    
                </div>
            </div>
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary" style="border-color:#f8f8f8;">
                        <div class="panel-heading">
                            <span class="fa fa-list"></span> Master Level <a href="index.php?hal=level/add" class="btn btn-sm btn-success dim_about"><span class="fa fa-plus"></span> Tambah Data</a>
                        </div>
                        <div class="panel-body dim_about">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <th>NO</th>
                                        <th>NAMA LEVEL</th>
                                        <th>AKSI</th>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $no = 1;
                                            $show = mysql_query("SELECT a.level_id, a.level_name from ref_level a");
                                            while ( $row = mysql_fetch_array($show)) {
                                            ?> 
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $row ['level_name']; ?></td>
                                                <td>
                                                <a href="index.php?hal=tingkat/edit&id=<?php echo $row['level_id']; ?>">Ubah</a>
                                                <a href="index.php?hal=tingkat/list&hapus<?php  echo $row ['level_id'];?>">Hapus</td>
                                                <?php
                                                $query = mysql_query("SELECT level_id from ref_level_menu where level_id='".$row['level_id']."'");
                                                $baris = mysql_num_rows($query)
                                                if ($baris ==0) { ?>
                                                    <a href="" 
                                                }
                                                ?>
                                            </tr>
                                            </tbody>
                                            <?php
                                            }
                                         ?>
                                    </tbody>
                                </table>
                            
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
