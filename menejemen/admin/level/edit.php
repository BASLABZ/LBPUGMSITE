<?php 
        // showing data 
        $id  = $_GET['id'];
        $row = mysql_fetch_array(mysql_query("SELECT * FROM ref_level where  level_id  = '".$id."'"));
        if (isset($_POST['update'])) {
            $querylevel = mysql_query("UPDATE ref_level set level_name = '".$_POST['level_name']."' where level_id = '".$id."' ");   
            if ($querylevel) {
                    echo "<script> alert('Data Berhasil Diubah'); location.href='index.php?hal=level/list' </script>";exit; 
            }else{
                echo "<script> alert('Data Gagal Diubah'); location.href='index.php?hal=level/edit&id=$id' </script>";exit; 
            }
        }
 ?>
        <div id="content">
            <div class="container" style="padding-top:30px; ">
            <div class="row">
                <div class="col-md-12">
                <div class="panel panel-primary" style="border-color:white; ">
                    <div class="panel-heading dim_about">
                        <span class="fa fa-pencil"></span> Tambah Master Data Level 
                        <span class="fa fa-home pull-right"> <i>
                            Home / <span class="fa fa-list"></span> Master / <span class="fa fa-pencil">
                            </span>
                            Level
                        </i></span>
                    </div>
                </div>
                <div class="panel panel-primary" style="border-color:white; ">
                        <div class="panel-body dim_about">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-primary" style="border-color:white;">
                        <div class="panel-heading">Tambah Level</div>
                        <div class="panel-body dim_about">

                            <div class="col-md-12">
                                <form  method="post"class="form-horizontal">
                                    <div class="form-group"> 
                                        <label class="control-label col-lg-4">Nama Level</label>
                                        <div class="col-lg-8">
                                            <input type="text" placeholder="Nama Level" class="form-control" name="level_name" required value="<?php echo $row['level_name']; ?>" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-4">
                                            <button type="submit" name="update" class="btn btn-success pull-right dim_about"> <span class="fa fa-save"></span> Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
             </div>
            </div>
        </div>
    </div>
</div>
</div>
