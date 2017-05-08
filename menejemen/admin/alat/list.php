<?php 
    if (isset($_GET['hapus'])) {
        $hapusalat = mysql_query("DELETE from ref_instrument where instrument_id = '".$_GET['hapus']."'");
        if ($hapusalat) {
            echo "<script> alert(' Data Berhasil Dihapus'); location.href='index.php?hal=alat/list' </script>";exit;
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
                             <span class="fa fa-wrench"></span> MASTER ALAT
                        </div>
                        <div class="col-md-8">
                            <div class="text-right"><b><i><span class="fa fa-home"></span> Home / <span class="fa fa-list"></span> Master Data / <span class="fa fa-wrench"> </span> Alat</i></b></div>
                            
                        </div>
                       </div>
                    </div>
                    
                </div>
            </div>
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary" style="border-color:#f8f8f8;">
                        <div class="panel-heading">
                            <span class="fa fa-list"></span> Master Alat <a href="index.php?hal=alat/add" class="btn btn-sm btn-success dim_about"><span class="fa fa-plus"></span> Tambah Data</a>
                        </div>
                        <div class="panel-body dim_about">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>GAMBAR</th>
                                            <th>NAMA ALAT</th>
                                            <th>MERK</th>  
                                            <th><center>HARGA SEWA</center></th>
                                            <th>JUMLAH</th>
                                            <th>STATUS</th>
                                            <th>AKSI</th>
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
                                            <td><img style="width:130px; height:150px;" src="<?php echo $var_gambar; ?>"></td>
                                            <td><?php echo $row['instrument_name']; ?></td>
                                            <td><?php echo $row['instrument_brand']; ?></td>
                                            <td>Rp.<?php echo rupiah($row['instrument_fee']); ?></td>
                                            <td><?php echo $row['instrument_quantity']; ?></td>
                                            <td>
                                            <?php 
                                                $jumlah = $row['instrument_quantity'];
                                                if ($jumlah > 0) {
                                                    echo " <button class='btn btn-success btn-xs dim_about'><span class='fa fa-check'></span> Tersedia</button>";
                                                }else{
                                                    echo " <button class='btn btn-danger btn-xs dim_about'><span class='fa fa-times'></span> Tidak Tersedia</button>";
                                                }
                                             ?>
                                           </td>
                                            <td>
                                                <a href="index.php?hal=alat/edit&id=<?php echo $row['instrument_id']; ?>" class="btn btn-warning btn-xs dim_about"><span class="fa fa-edit"></span> Ubah</a><br><br>
                                                <a href="index.php?hal=alat/list&hapus=<?php echo $row['instrument_id']; ?>" class="btn btn-danger btn-xs dim_about"><span class="fa fa-trash"></span> Hapus</a>
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
