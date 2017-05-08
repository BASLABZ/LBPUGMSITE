<!-- simpan data  -->

<?php 
    if (isset($_POST['simpan'])) {
      $queryInsert = mysql_query("INSERT INTO ref_level (level_name) VALUES ('".$_POST['level_name']."')");
      if ($queryInsert) {
         echo "<script> alert('Data Berhasil simpan'); location.href='index.php?hal=levels/list' </script>";exit; 
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
                             <span class="fa fa-users"></span> Tambah level belajar
                        </div>
                        <div class="col-md-8">
                            <div class="text-right"><b><i><span class="fa fa-home"></span> Home / <span class="fa fa-list"></span> Tambah Data / <span class="fa fa-users"> </span> level belajar</i></b></div>
                            
                        </div>
                       </div>
                    </div>
                    
                </div>
            </div>
                <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-primary" style="border-color:#f8f8f8;">
                        <div class="panel-heading">
                            <span class="fa fa-users"></span> Tambah level belajar 
                        </div>
                        <div class="panel-body dim_about">
                            <div class="table-responsive">
                              <form method="POST" class="role">
                                  <div class="form-group row">
                                    <label class="col-md-4">Level</label>
                                    <div class="col-md-8">
                                      <input type="text" name="level_name" class="form-control">

                                    </div>
                                  </div>
                                  <div class="form-group row">
                                   <div class="col-md-12">
                                      <button type="submit" name="simpan" class="btn btn-success btn-sm pull-right"><span class="fa fa-save"></span> simpan</button>
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
