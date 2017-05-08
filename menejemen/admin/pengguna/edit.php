<?php 
    $var_id = $_GET['id'];
    $show = mysql_query("SELECT * from ref_operator where operator_id = '".$var_id."'");
    $runshow = mysql_fetch_array($show);

    // if (isset($_POST['update'])) {
        // $nama = $_POST['operator_name'];
        // print_r($nama);
        // die();
    // $update = mysql_query("UPDATE ref_operator set operator_name='".$_POST['operator_name']."',
    //                                                 operator_gender='".$$_POST['operator_gender']."',
    //                                                 operator_username='".$_POST['operator_username']."',
    //                                                 operator_password= md5('".$_POST['operator_password']."'),
    //                                                 operator_hint_question='".$_POST['operator_hint_question']."',
    //                                                 operator_answer_question='".$_POST['operator_answer_question']."',
    //                                                 level_id_fk='".$_POST['level_id_fk']."'
    //                                                 where operator_id='".$var_id."'");
    // if ($update) {
    //     echo "<script>alert ('Data berhasil diubah'); location.href='index.php?hal=pengguna/list'</script>"; exit;
    // } else {
    //     echo "<script>alert ('Data gagal diubah'); location.href='index.php?hal=pengguna/edit&id=$var_id'</script>"; exit;
    // }
    }
?>

<div id="content">
            <div class="container" style="padding-top:30px; ">
            <div class="row">
                <div class="col-md-12">
                <div class="panel panel-primary" style="border-color:white; ">
                    <div class="panel-heading dim_about">
                        <span class="fa fa-pencil"></span> Ubah Master Data Operator 
                        <span class="fa fa-home pull-right"> <i>
                            Home / <span class="fa fa-list"></span> Master / <span class="fa fa-users">
                            </span>Operator
                             / <span class="fa fa-pencil"></span> <?php echo $runshow['operator_name']; ?></i>
                        </span>

                    </div>
                </div>
                <div class="panel panel-primary" style="border-color:white; ">
                        <div class="panel-body dim_about">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-primary" style="border-color:white;">
                        <div class="panel-heading">Ubah Operator</div>
                        <div class="panel-body dim_about">

                            <div class="col-md-12">
                                <form class="role" method="POST">
                                    <div class="form-group row">
                                        <label class="col-md-4">NAMA OPERATOR</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="operator_name" value="<?php echo $runshow['operator_name']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4" >Jenis Kelamin</label>
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
                                            <input type="text" name="operator_username" placeholder="Username" class="form-control" required value="<?php echo $runshow['operator_username']; ?>" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">
                                            Password
                                        </label>
                                        <div class="col-md-8">
                                            <input class="form-control" type="password" name="operator_password" placeholder="Password"
                                           data-original-title="Please use your secure password" data-placement="top" required value="<?php echo $runshow['operator_password']; ?>" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Hint Question</label>
                                        <div class="col-lg-8">
                                         <select class="form-control" name="operator_hint_question">
                                            <option value="Apa warna favorit anda?"
                                                <?php if($runshow['operator_hint_question']=='Apa warna favorit anda?'){echo "selected=selected";}?>>Apa warna favorit anda?
                                            </option>
                                            <option value="Apa makanan favorit anda?"
                                                <?php if($runshow['operator_hint_question']=='Apa makanan favorit anda?'){echo "selected=selected";}?>>
                                                Apa makanan favorit anda?
                                            </option>
                                            <option value="Siapa nama ayah kandung anda?"
                                                <?php if($runshow['operator_hint_question']=='Siapa nama ayah kandung anda?'){echo "selected=selected";}?>>
                                                Siapa nama ayah kandung anda?
                                            </option>
                                            <option value="Siapa nama penyanyi kesukaan anda?"
                                                <?php if($runshow['operator_hint_question']=='Siapa nama penyanyi kesukaan anda?'){echo "selected=selected";}?>>
                                                Siapa nama penyanyi kesukaan anda?
                                            </option>
                                        </select>
                                     </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Answer Question</label>
                                        <div class="col-md-8">
                                             <input type="text" placeholder="Answer Question" class="form-control" name="operator_answer_question" required value="<?php echo $runshow['operator_answer_question']; ?>" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Level Operator</label>
                                        <div class="col-md-8">
                                             <select class="form-control" name="level_id_fk">
                                                    <?php
                                                        $tampil = mysql_query("SELECT level_id, level_name from ref_level");
                                                        while ($level = mysql_fetch_array($tampil)){ ?>
                                                            <option value="<?php echo $level['level_id'] ?>"><?php echo $level['level_name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-12">
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