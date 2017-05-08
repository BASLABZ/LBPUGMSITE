<?php 
        // funtion for hapus
        if (isset($_GET['hapus'])) {
            $queryhapus = mysql_query("DELETE FROM ref_operator where operator_id='".$_GET['hapus']."' ");
            if ($queryhapus) {
                echo "<script> alert('Data Berhasil DiHapus'); location.href='index.php?hal=operator/list' </script>";exit; 
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
                             <span class="fa fa-users"></span> MASTER OPERATOR
                        </div>
                        <div class="col-md-8">
                            <div class="text-right"><b><i><span class="fa fa-home"></span> Home / <span class="fa fa-list"></span> Master Data / <span class="fa fa-users"> </span> Operator</i></b></div>
                            
                        </div>
                       </div>
                    </div>
                    
                </div>
            </div>
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary" style="border-color:#f8f8f8;">
                        <div class="panel-heading">
                            <span class="fa fa-users"></span> Master Operator <a href="index.php?hal=operator/add" class="btn btn-sm btn-success dim_about"><span class="fa fa-plus"></span> Tambah Data</a>
                        </div>
                        <div class="panel-body dim_about">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
						                    <th>NAMA</th>
						                    <th>JENIS KELAMIN</th>
						                    <th>USERNAME</th>
                                            <th>LEVEL OPERATOR</th>
						                    <th>AKSI</th>
						                    
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    	$no = 1;
                                    	$query = mysql_query("SELECT * from ref_operator join ref_level on ref_operator.level_id_fk=ref_level.level_id");
                                    	while ($row = mysql_fetch_array($query)) {
                                            $level_operator = $row['level_name'];
                                     ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $row['operator_name']; ?></td>
                                            <td class="center"><?php echo $row['operator_gender']; ?></td>
                                            <td class="center"><?php echo $row['operator_username']; ?></td>
                                            <td char="center"><?php echo $row['level_name']; ?></td>
                                            <td>
                                            	<a href="index.php?hal=operator/edit&id=<?php echo $row['operator_id']; ?>" class="btn btn-warning btn-xs dim_about"><span class="fa fa-edit"></span> Ubah</a>
                                            	<?php if ($level_operator == 'admin') { ?>
                                                <a disabled class="btn btn-danger btn-xs dim_about"><span class="fa fa-trash"></span> Hapus</a>
                                                 <?php }else{ ?>
                                                 <a href="index.php?hal=operator/list&hapus=<?php echo $row['operator_id']; ?>" class="btn btn-danger btn-xs dim_about"><span class="fa fa-trash"></span> Hapus</a>
                                                 <?php } ?>
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
