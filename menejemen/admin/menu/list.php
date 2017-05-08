<?php 
        if (isset($_GET['hapus'])) {
            $queryhapus  = mysql_query("DELETE FROM ref_menu where menu_id = '".$_GET['hapus']."'");
            if ($queryhapus) {
               echo "<script> alert('Data Berhasil Dihapus'); location.href='index.php?hal=menu/list' </script>";exit;
            }else{
                echo "<script> alert('Data Gagal Dihapus'); location.href='index.php?hal=menu/list' </script>";exit;
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
                             <span class="fa fa-list"></span> MASTER MENU
                        </div>
                        <div class="col-md-8">
                            <div class="text-right"><b><i><span class="fa fa-home"></span> Home / <span class="fa fa-list"></span> Master Data / <span class="fa fa-list"> </span> Menu</i></b></div>
                            
                        </div>
                       </div>
                    </div>
                    
                </div>
            </div>
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary" style="border-color:#f8f8f8;">
                        <div class="panel-heading">
                            <span class="fa fa-list"></span> Master Operator <a href="index.php?hal=menu/add" class="btn btn-sm btn-success dim_about"><span class="fa fa-plus"></span> Tambah Data</a>
                        </div>
                        <div class="panel-body dim_about">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th width="10%">NO</th>
                                            <th width="10%">NAMA MENU</th>
                                            <th width="10%">LINK MENU</th>
                                            <th width="10%">PARENT MENU</th>
                                            <th width="10%">AKSI</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $no = 1;
                                        $query = mysql_query("SELECT menu_id, menu_name, menu_url, menu_parent from ref_menu");
                                        while ($row = mysql_fetch_array($query)) {
                                                $var_parent     = $row['menu_parent'];
                                     ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $no++; ?></td>
                                            <td class="center"><?php echo $row['menu_name']; ?></td>
                                            <td class="center"><?php echo $row['menu_url']; ?></td>
                                            <?php
                                                $parent = "SELECT menu_name from ref_menu where menu_id='".$var_parent."'";
                                                $runparent = mysql_query($parent);
                                                $ambildata = mysql_fetch_array($runparent);
                                                    $varmenu_parent = $ambildata ['menu_name'];
                                                  ?>
                                            <td><?php echo $varmenu_parent;; ?></td>
                                            <td>
                                                <a href="index.php?hal=menu/edit&id=<?php echo $row['menu_id']; ?>" class="btn btn-warning btn-xs dim_about"><span class="fa fa-edit"></span> Ubah</a>
                                                <a href="index.php?hal=menu/list&hapus=<?php echo $row['menu_id']; ?>" class="btn btn-danger btn-xs dim_about"><span class="fa fa-trash"></span> Hapus</a>
                                                
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
