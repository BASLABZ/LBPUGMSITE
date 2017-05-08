<?php 
    if (isset($_GET['hapus'])) {
        $hapus = mysql_query("DELETE from ref_operator where operator_id = '".$_GET['hapus']."'");
        if ($hapus) {
            echo "<script>alert ('Data berhasil dihapus'); location.href='index.php?hal=pengguna/list'</script>"; exit;
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
                             <span class="fa fa-users"></span> MASTER PENGGUNA
                        </div>
                        <div class="col-md-8">
                            <div class="text-right"><b><i><span class="fa fa-home"></span> Home / <span class="fa fa-list"></span> Master Data / <span class="fa fa-users"> </span> Pengguna</i></b></div>
                           
                        </div>
                       </div>
                    </div>
                    
                </div>
            </div>
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary" style="border-color:#f8f8f8;">
                        <div class="panel-heading">
                            <span class="fa fa-users"></span> Master Pengguna <a href="index.php?hal=pengguna/add" class="btn btn-sm btn-success dim_about"><span class="fa fa-plus"></span> Tambah Data</a>
                        </div>
                        <div class="panel-body dim_about">
                            <div class="table-responsive">
                                <table class="table table-hover" id="table-pengguna">
                                    <thead>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Username</th>
                                        <th>Level Operator</th>
                                        <th>Aksi</th>
                                    </thead>
                                    <tbody>
                                        <?php 
                                              $no=1;
                                              $querypengguna = mysql_query("SELECT o.operator_id, o.operator_name, o.operator_gender,
                                                                                    o.operator_username,l.level_name
                                                                                    FROM ref_operator o
                                                                                        JOIN ref_level l ON o.level_id_fk = l.level_id");
                                                while ($rowPengguna = mysql_fetch_array($querypengguna)) {
                                                      
                                         ?>
                                            <tr>
                                           
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $rowPengguna['operator_name']; ?></td>
                                                <td><?php echo $rowPengguna['operator_gender']; ?></td>
                                                <td><?php echo $rowPengguna['operator_username']; ?></td>
                                                <td><?php echo $rowPengguna['level_name']; ?></td>
                                                <td>
                                                    <a href="index.php?hal=pengguna/edit&id=<?php echo $rowPengguna['operator_id']; ?>" class="btn btn-warning btn-sm dim_about"><span class="fa fa-trash"></span>  Ubah</a>
                                                    <a href="index.php?hal=pengguna/list&hapus=<?php echo $rowPengguna['operator_id']; ?>" class="btn btn-danger btn-sm dim_about"><span class="fa fa-trash"></span>  hapus</a> 
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


