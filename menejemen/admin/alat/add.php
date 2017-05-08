<?php 
        if (isset($_POST['simpan'])) {
            if (!empty($_FILES) && $_FILES['gambar']['size'] >0 && $_FILES['gambar']['error'] == 0) {

                          $fileName = $_FILES['gambar']['name'];
                          $move = move_uploaded_file($_FILES['gambar']['tmp_name'], '../image/'.$fileName);
                     if ($move) {
                          $queryinsert = mysql_query("INSERT INTO ref_instrument ( instrument_name, instrument_brand, instrument_quantity, instrument_fee, instrument_description, instrument_length, instrument_weight, instrument_picture) VALUES ('".$_POST['instrument_name']."', '".$_POST['instrument_brand']."', '".$_POST['instrument_quantity']."', '".$_POST['instrument_fee']."','".$_POST['instrument_description']."','".$_POST['instrument_length']."', '".$_POST['instrument_weight']."', '".$fileName."','');
                            ");
                     }
                        
                     }else{
                          $queryinsert = mysql_query("INSERT INTO ref_instrument ( instrument_name, instrument_brand, instrument_quantity, instrument_fee, instrument_description, instrument_length, instrument_weight, instrument_picture) VALUES ('".$_POST['instrument_name']."', '".$_POST['instrument_brand']."', '".$_POST['instrument_quantity']."', '".$_POST['instrument_fee']."','".$_POST['instrument_description']."','".$_POST['instrument_length']."', '".$_POST['instrument_weight']."', '','');
                            ");
                          }
                     if ($queryinsert) {
                           echo "<script> alert('Terimakasih Data Berhasil Disimpan'); location.href='index.php?hal=alat/list' </script>";exit;
                     }else{
                           echo "<script> alert(' Data Gagal Disimpan'); location.href='index.php?hal=alat/add' </script>";exit;
                     } 
        }
 ?>
        <div id="content">
            <div class="container" style="padding-top:30px; ">
            <div class="row">
                <div class="col-md-12">
                <div class="panel panel-primary" style="border-color:white; ">
                    <div class="panel-heading dim_about">
                        <span class="fa fa-pencil"></span> Tambah Master Data Alat /<i>Instrument</i> 
                        <span class="fa fa-home pull-right"> <i>
                            Home / <span class="fa fa-list"></span> Master / <span class="fa fa-pencil">
                            </span>
                            Alat /<i>Instrument</i>
                        </i></span>
                    </div>
                </div>
                <div class="panel panel-primary" style="border-color:white; ">
                        <div class="panel-body dim_about">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-primary" style="border-color:white;">
                        <div class="panel-heading">Tambah Alat /<i>Instrument</i></div>
                        <div class="panel-body dim_about">

                            <div class="col-md-12">
                                <form  method="post"class="form-horizontal" enctype="multipart/form-data">
                                    <div class="form-group"> 
                                        <label class="control-label col-lg-4">Nama Alat</label>
                                        <div class="col-lg-8">
                                            <input type="text" placeholder="Nama Alat" class="form-control" name="instrument_name" required />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-lg-4">Merk Alat</label>
                                      <div class="col-lg-8">
                                        <input type="text" class="form-control" placeholder="Merk Alat" name="instrument_brand" required>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-lg-4">Jumlah Alat</label>
                                      <div class="col-lg-8">
                                        <input type="number" class="form-control" required placeholder="Jumlah Alat" name="instrument_quantity">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-lg-4">Biaya Sewa</label>
                                      <div class="col-lg-8">
                                        <div class="form-group input-group">
                                          <span class="input-group-addon">Rp</span>
                                              <input type="text" placeholder="Biaya Sewa" required class="form-control" name="instrument_fee">
                                      </div>
                                      </div>
                                    </div>
                                    <div class="form-group row"> 
                                      <label class="control-label col-lg-3">Panjang Alat</label>
                                      <div class="col-lg-3">
                                          <input type="text" placeholder="Panjang" class="form-control" name="instrument_length" required="">
                                      </div>
                                      <label class="control-label col-lg-3">Berat Alat</label>
                                      <div class="col-lg-3">
                                          <input type="text" placeholder="Berat" class="form-control" name="instrument_weight" required="">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label col-lg-4">Deskripsi Alat</label>
                                      <div class="col-md-8">
                                        <textarea class="form-control" placeholder="Deskripsi Alat" name="instrument_description" required> </textarea>
                                      </div>
                                  </div>
                                    <div class="form-group"> 
                                        <label class="control-label col-lg-4">upload Alat</label>
                                        <div class="col-lg-8">
                                            <input type="file" placeholder="Nama Alat" class="form-control" name="gambar" required />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-4">
                                            <button type="submit" name="simpan" class="btn btn-success pull-right dim_about"> <span class="fa fa-save"></span> Simpan</button>
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
