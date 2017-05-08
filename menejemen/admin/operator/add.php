<?php 
        if (isset($_POST['simpan'])) {
            $querysimpan = mysql_query("INSERT INTO ref_operator (operator_name,operator_gender,
                                                      operator_username,operator_password,
                                                      operator_login,operator_hint_question,
                                                      operator_answer_question,level_id_fk)

                            VALUES ('".$_POST['operator_name']."','".$_POST['operator_gender']."',
                                    '".$_POST['operator_username']."',md5('".$_POST['operator_password']."'),'Y','".$_POST['operator_hint_question']."',
                                    '".$_POST['operator_answer_question']."','".$_POST['level_id_fk']."') ");
                                    // var_dump($querysimpan); die();
            if ($querysimpan) {
                echo "<script> alert('Data Berhasil Disimpan'); location.href='index.php?hal=operator/list' </script>";exit; 
            }else{
                echo "<script> alert('Data Gagal Disimpan'); location.href='index.php?hal=operator/add' </script>";exit; 
            }
        }
 ?>
        <div id="content">
            <div class="container" style="padding-top:30px; ">
            <div class="row">
                <div class="col-md-12">
                <div class="panel panel-primary" style="border-color:white; ">
                    <div class="panel-heading dim_about">
                        <span class="fa fa-pencil"></span> Tambah Master Data Operator 
                        <span class="fa fa-home pull-right"> <i>
                            Home / <span class="fa fa-list"></span> Master / <span class="fa fa-users">
                            </span>
                            Operator
                        </i></span>
                    </div>
                </div>
                <div class="panel panel-primary" style="border-color:white; ">
                        <div class="panel-body dim_about">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-primary" style="border-color:white;">
                        <div class="panel-heading">Tambah Operator</div>
                        <div class="panel-body dim_about">

                            <div class="col-md-12">
                                <form class="role" method="POST">
                                    <div class="form-group row">
                                        <label class="col-md-4">NAMA OPERATOR</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="operator_name" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Jenis Kelamin</label>
                                        <div class="col-md-8">
                                            <label class="radio-inline">
                                                <input type="radio" name="operator_gender" value="Laki-laki" required  />Laki-laki
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="operator_gender" value="Perempuan" required />Perempuan
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Username</label>
                                        <div class="col-md-8">
                                            <input type="text" name="operator_username" placeholder="Username" class="form-control" required/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">
                                            Password
                                        </label>
                                        <div class="col-md-8">
                                            <input class="form-control" type="password" name="operator_password" placeholder="Password"
                                           data-original-title="Please use your secure password" data-placement="top" required/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Hint Question</label>
                                        <div class="col-lg-8">
                                         <select class="form-control" name="operator_hint_question">
                                            <option value="Choose Hint Question">
                                            Choose Hint Question</option>
                                            <option value="Apa warna favorit anda?">
                                            Apa warna favorit anda?</option>
                                            <option value="Apa makanan favorit anda?">
                                            Apa makanan favorit anda?</option>
                                            <option value="Siapa nama ayah kandung anda?">
                                            Siapa nama ayah kandung anda?</option>
                                            <option value="Siapa nama penyanyi kesukaan anda?">
                                            Siapa nama penyanyi kesukaan anda?</option>
                                        </select>
                                     </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Answer Question</label>
                                        <div class="col-md-8">
                                             <input type="text" placeholder="Answer Question" class="form-control" name="operator_answer_question" required/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Level Operator</label>
                                        <div class="col-md-8">
                                             <select class="form-control" name="level_id_fk">
                                                    <?php
                                                        $tampil = "SELECT level_id, level_name from ref_level";
                                                        $sql    = mysql_query($tampil);
                                                        while ($showlevel = mysql_fetch_array($sql)){
                                                            $levelid    = $showlevel['level_id'];
                                                            $levelname  = $showlevel['level_name'];?>

                                                            <option value="<?php echo $levelid ?>"><?php echo $levelname ?></option>
                                                    <?php } //tutup while?>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-12">
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