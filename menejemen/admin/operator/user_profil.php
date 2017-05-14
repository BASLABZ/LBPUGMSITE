<?php 
    $id  = $_GET['id'];
        $row = mysql_fetch_array(mysql_query("SELECT * from ref_operator 
                                                    where operator_id ='".$id."' "));
        if (isset($_POST['update'])) {
        $queryupdate  = mysql_query("UPDATE ref_operator set 
                                                    operator_name = '".$_POST['operator_name']."',
                                                    operator_gender = '".$_POST['operator_gender']."',
                                                    operator_username = '".$_POST['operator_username']."',
                                                    operator_password = md5('".$_POST['operator_password']."'),
                                                    operator_hint_question = '".$_POST['operator_hint_question']."',
                                                    operator_answer_question = '".$_POST['operator_answer_question']."',level_id_fk = '".$_POST['level_id_fk']."' WHERE operator_id = '".$id."'");
            if ($queryupdate) {
                echo "<script> alert('Data Berhasil Diubah'); location.href='index.php?hal=operator/user_profil&id=".$id."' </script>";exit; 
            }else{
                echo "<script> alert('Data Gagal Diubah'); location.href='index.php?hal=operator/operator/user_profil&id=".$id."' </script>";exit; 
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
                             <span class="fa fa-edit"></span> SETTING PROFIL
                        </div>
                        <div class="col-md-8">
                            <div class="text-right"><b><i><span class="fa fa-home"></span> Home / <span class="fa fa-gear"></span> Profil Pengguna / <span class="fa fa-user"> </span> Setting</i></b></div>
                            
                        </div>
                       </div>
                    </div>
                    
                </div>
            </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="panel panel-primary" style="border-color: white;">
                            <div class="panel-heading">
                                <h5><span class="fa fa-edit"></span> Ubah Profil Pengguna</h5>
                            </div>
                            <div class="panel-body dim_about" >
                                <form class="role" method="POST">
                                    <div class="form-group row">
                                        <label class="col-md-4">Nama </label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="operator_name" value="<?php echo $row['operator_name']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4" >Jenis Kelamin</label>
                                        <div class="col-md-8">
                                            <label class="radio-inline">
                                                <input type="radio" name="operator_gender" value="Laki-laki"; <?php if ($row['operator_gender']=='Laki-laki') {echo "checked=checked";} ?> required  />Laki-laki
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="operator_gender" value="Perempuan"; <?php if ($row['operator_gender']=='Perempuan') { echo "checked=checked";} ?> required />Perempuan
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Username</label>
                                        <div class="col-md-8">
                                            <input type="text" name="operator_username" placeholder="Username" class="form-control" required value="<?php echo $row['operator_username']; ?>" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Pertanyaan Keamanan</label>
                                        <div class="col-lg-8">
                                         <select class="form-control" name="operator_hint_question">
                                            <option value="Apa warna favorit anda?"
                                                <?php if($row['operator_hint_question']=='Apa warna favorit anda?'){echo "selected=selected";}?>>Apa warna favorit anda?
                                            </option>
                                            <option value="Apa makanan favorit anda?"
                                                <?php if($row['operator_hint_question']=='Apa makanan favorit anda?'){echo "selected=selected";}?>>
                                                Apa makanan favorit anda?
                                            </option>
                                            <option value="Siapa nama ayah kandung anda?"
                                                <?php if($row['operator_hint_question']=='Siapa nama ayah kandung anda?'){echo "selected=selected";}?>>
                                                Siapa nama ayah kandung anda?
                                            </option>
                                            <option value="Siapa nama penyanyi kesukaan anda?"
                                                <?php if($row['operator_hint_question']=='Siapa nama penyanyi kesukaan anda?'){echo "selected=selected";}?>>
                                                Siapa nama penyanyi kesukaan anda?
                                            </option>
                                        </select>
                                     </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Jawaban Keamanan</label>
                                        <div class="col-md-8">
                                             <input type="text" placeholder="Answer Question" class="form-control" name="operator_answer_question" required value="<?php echo $row['operator_answer_question']; ?>" />
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

