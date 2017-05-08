<?php  
        // ganti password akun member
        if (isset($_POST['gantipassword'])) {
          $password_baru =$_POST['password_baru'];
          $queryganti_password  = mysql_query("UPDATE tbl_member 
                                                  set 
                                                  member_username = '".$_POST['member_username']."',
                                                  member_hint_question='".$_POST['member_hint_question']."' , 
                                                  member_answer_question = '".$_POST['member_answer_question']."', 
                                                  member_password = md5('".$password_baru."') where member_id  = '".$_SESSION['member_id']."'");
          if ($queryganti_password) {
             echo "<script> alert('Akun Berhasil Diubah'); location.href='index.php?hal=akun/profil' </script>";exit;
          }
        }
        // ganti photo profil
        if (isset($_POST['ubahphotoprofil'])) {
           if (!empty($_FILES) && $_FILES['member_photo']['size'] >0 && $_FILES['member_photo']['error'] == 0) {
                         $member_photo = $_FILES['member_photo']['name'];
                          $move = move_uploaded_file($_FILES['member_photo']['tmp_name'], '../img/'.$member_photo);
                          if ($move) {
                            $updatePhoto  = mysql_query("UPDATE tbl_member set member_photo='".$member_photo."' where member_id = '".$_SESSION['member_id']."'");
                          }
                        }
                        if ($updatePhoto) {
                           echo "<script> alert('Profil Berhasil Di ubah'); location.href='index.php?hal=akun/profil' </script>";exit;
                     }else{
                           echo "<script> alert(' Data Gagal Disimpan'); location.href='index.php?hal=akun/profil' </script>";exit;
                     } 

        }
        // hapus phot
        if (isset($_POST['hapusphoto'])) {
          $queryHapusPHoto = mysql_query("UPDATE tbl_member set member_photo = '' where member_id = '".$_SESSION['member_id']."' ");
          if ($queryHapusPHoto) {
            echo "<script> alert('Poto diganti default'); location.href='index.php?hal=akun/profil' </script>";exit;
          }
        }
          // ganti profil akun member
        if (isset($_POST['gantiprofil'])) {
          $member_name                = $_POST['member_name'];
          $member_birth_date          = $_POST['member_birth_date'];
          $member_gender              = $_POST['member_gender'];
          $member_phone_number        = $_POST['member_phone_number'];
          $member_address             = $_POST['member_address'];
          $member_institution         = $_POST['member_institution'];
          $member_faculty             = $_POST['member_faculty'];
          $member_email               =  $_POST['member_email'];
          
          // ganti idcard : 
             if (!empty($_FILES) && $_FILES['member_idcard_photo']['size'] >0 && $_FILES['member_idcard_photo']['error'] == 0) {
                  $member_idcard_photo = $_FILES['member_idcard_photo']['name'];
                          $move = move_uploaded_file($_FILES['member_idcard_photo']['tmp_name'], '../img/'.$member_idcard_photo);
                          if ($move) {
                              $queryUpdate_Profil = "UPDATE tbl_member SET 
                                                                member_name = '".$member_name."',
                                                                member_birth_date = '".$member_birth_date."',
                                                                member_gender = '".$member_gender."',
                                                                member_phone_number = '".$member_phone_number."',
                                                                member_address = '".$member_address."',
                                                                member_institution = '".$member_institution."',
                                                                member_faculty = '".$member_faculty."',
                                                                member_email = '".$member_email."',
                                                                member_idcard_photo = '".$member_idcard_photo."'
                                                          WHERE 
                                                              member_id = '".$_SESSION['member_id']."'";
                                
                              $runUpdate = mysql_query($queryUpdate_Profil);

                          }
             }
             else{

                $queryUpdate_Profil = "UPDATE tbl_member SET 
                                                  member_name             = '".$member_name."',
                                                  member_birth_date       = '".$member_birth_date."',
                                                  member_gender           = '".$member_gender."',
                                                  member_phone_number     = '".$member_phone_number."',
                                                  member_address          = '".$member_address."',
                                                  member_institution      = '".$member_institution."',
                                                  member_faculty          = '".$member_faculty."',
                                                  member_email            = '".$member_email."'
                                            WHERE 
                                                member_id                 = '".$_SESSION['member_id']."'";
                $runUpdate = mysql_query($queryUpdate_Profil);
                          }
              if ($runUpdate) {
                           echo "<script> alert('Profil Berhasil Di ubah'); location.href='index.php?hal=akun/profil' </script>";exit;
                     }else{
                           echo "<script> alert(' Data Gagal Disimpan'); location.href='index.php?hal=akun/profil' </script>";exit;
                     } 
        }

 ?>
  <?php 
  $sqlMember  = mysql_query("SELECT * FROM tbl_member m JOIN ref_category c on m.category_id_fk = c.category_id where m.member_id='".$_SESSION['member_id']."'");
  $rowMember = mysql_fetch_array($sqlMember);
 ?>
 <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Profil Pengguna</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index-2.html">Home</a>
                        </li>
                        <li>
                            <a>Setting</a>
                        </li>
                        <li class="active">
                            <strong>Profil Pengguna</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
            <div class="wrapper wrapper-content">
            <div class="row animated fadeInRight">
                <div class="col-md-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Informasi Akun</h5>
                        </div>
                        <div>
                            <div class="ibox-content no-padding border-left-right">
                                <center> 
                                <?php 
                                          if ($rowMember['member_photo'] !='') {
                                            echo "<center>
                                            <img src='../img/".$rowMember['member_photo']."' class='img-circle dim_about img-responsive' style='width:100px; height:100px;'>
                                            </center>";

                                          }else{
                                            echo "<img src='../img/user.png' class='img-circle dim_about' width='100px;'>";
                                          }
                                       ?>
                                </center>
                               <!--  -->
                            </div>
                            <div class="ibox-content profile-content">
                                <div class="user-button">
                                    <div class="row">
                                        <form class="role" method="POST" enctype="multipart/form-data">
                                            <div class="col-md-12">
                                            <center> <input type="file" name="member_photo" required class="btn btn-info form-control">
                                            <hr></center>
                                            <button type="submit"  name="ubahphotoprofil" class="btn btn-primary btn-sm btn-block"><i class="fa fa-picture-o"></i> Ubah Foto</button>
                                           
                                        </div>
                                         </form>
                                         <form method="POST">
                                             <?php  
                                                  if ($rowMember['member_photo'] !='') {
                                                    echo "<button type='submit' name='hapusphoto' class='btn btn-danger btn-sm btn-block'><i class='fa fa-trash'></i> Hapus</button>";
                                                  }
                                             ?>
                                          </form>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                    </div>
                <div class="col-md-8">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Activites</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                <div class="col-lg-12 m-b-md">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-1"><span class="fa fa-edit"></span> Ubah Profil</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-2"><span class="fa fa-gear"></span> Setting Akun</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                                <div class="panel-body">
                                    <strong>Ubah Profil </strong>
                                    <form class="role" method="POST" enctype="multipart/form-data">
                                      <div class="form-group row">
                                        <div class="col-md-12 text-center">
                                          <?php 
                                              if ($rowMember['member_photo'] !='') {
                                                echo "<center>
                                                <img src='../img/".$rowMember['member_photo']."' class='img-circle dim_about img-responsive' style='width:100px; height:100px;'>
                                                </center>";

                                              }else{
                                                echo "<img src='../img/user.png' class='img-circle dim_about' width='100px;'>";
                                              }
                                           ?>
                                           <br>
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label class="col-md-4">Nama Lengkap</label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" name="member_name" value="<?php echo $rowMember['member_name']; ?>" required >
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label class="col-md-4">Instansi / Umum</label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" name="member_institution"  value="<?php echo $rowMember['member_institution']; ?>" >
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label class="col-md-4">Fakultas / Bidang </label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" name="member_faculty" value="<?php echo $rowMember['member_faculty']; ?>" >
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label class="col-md-4">Tanggal Lahir</label>
                                        <div class="col-md-4">
                                          <input type="date" class="form-control" name="member_birth_date" value="<?php echo $rowMember['member_birth_date']; ?>" required>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" disabled="" class="form-control" value="<?php echo $rowMember['member_birth_date']; ?>">
                                         </div>
                                      </div>
                                      <div class="form-group row">
                                        <label class="col-md-4">Gender</label>
                                        <div class="col-md-6">
                                         <select class="form-control" required name="member_gender">
                                            <option value=""> Pilih Gender</option>
                                             <option value="Laki-laki"
                                                <?php if($rowMember['member_gender']=='Laki-laki'){echo "selected=selected";}?>>Laki-laki 
                                            </option>
                                            <option value="Perempuan"
                                                <?php if($rowMember['member_gender']=='Perempuan'){echo "selected=selected";}?>>Perempuan
                                            </option>
                                         </select>
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label class="col-md-4">No. Telp</label>
                                        <div class="col-md-6">
                                          <input type="number" class="form-control" name="member_phone_number"  value="<?php echo $rowMember['member_phone_number']; ?>" required >
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label class="col-md-4">Alamat</label>
                                        <div class="col-md-6">
                                          <textarea class="form-control" name="member_address"  placeholder="Alamat"><?php echo $rowMember['member_address']; ?></textarea> 
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label class="col-md-4">Email</label>
                                        <div class="col-md-6">
                                          <input type="text" name="member_email" class="form-control" value="<?php echo $rowMember['member_email']; ?>" required>
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label class="col-md-4">STATUS MEMBER</label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" value="<?php echo $rowMember['member_status']; ?>" disabled >
                                        </div>
                                      </div>  
                                      <div class="form-group row">
                                        <label class="col-md-4">ID CARD</label>
                                        <div class="col-md-6">
                                          <input type="file" name="member_idcard_photo" >
                                          <hr>
                                          <img src="../img/<?php echo $rowMember['member_idcard_photo']; ?>" class="ig-responsive img-thumbnail" width='100' height='100'>
                                        </div>
                                      </div>
                                        <div class="form-group row">
                                        
                                        <div class="col-md-12">
                                          <button type="submit" name="gantiprofil" class="btn btn-primary btn-block"><span class="fa fa-edit"></span> Ubah Profil</button>
                                        </div>
                                      </div>
                                    </form>
                                </div>
                            </div>
                            <div id="tab-2" class="tab-pane">
                                <div class="panel-body">
                                     <form class="role" method="POST">
                                      <div class="form-group row">
                                          <label class="col-md-4 pu"><center>Username</center></label>
                                          <div class="col-md-6">
                                              <input type="text" class="form-control" name="member_username" required value="<?php echo $rowMember['member_username']; ?>">
                                          </div>
                                      </div>
                                      <div class="form-group row">
                                          <label class="col-md-4 pu"><center>Password Lama</center></label>
                                          <div class="col-md-6">
                                              <input type="password" class="form-control" name="password" required>
                                          </div>
                                      </div>
                                      <div class="form-group row">
                                          <label class="col-md-4 pu"><center>Password Baru</center></label>
                                          <div class="col-md-6">
                                              <input type="password" class="form-control" name="password_baru" maxlength="8" minlength="6" required>
                                          </div>
                                      </div>
                                       <div class="form-group row">
                                      <label class="col-md-4 pu"><center> Hint Questions</center></label>
                                      <div class="col-md-6">
                                        <select class="form-control" required name="member_hint_question" reqiured>
                                          <option value="">Pilih Pertanyaan</option>
                                             <option value="Dimana Kota Anda Dilahirkan ?"
                                                <?php if($rowMember['member_hint_question']=='Dimana Kota Anda Dilahirkan ?'){echo "selected=selected";}?>>Dimana Kota Anda Dilahirkan ? 
                                            </option>
                                            <option value="Siapakah Nama Ayah Kandung Anda ?"
                                                <?php if($rowMember['member_hint_question']=='Siapakah Nama Ayah Kandung Anda ?'){echo "selected=selected";}?>>Siapakah Nama Ayah Kandung Anda ? 
                                            </option>
                                              <option value="Siapa Penyanyi Favorit Anda?"
                                                <?php if($rowMember['member_hint_question']=='Siapa Penyanyi Favorit Anda?'){echo "selected=selected";}?>>Siapa Penyanyi Favorit Anda? 
                                            </option>
                                              <option value="Apa Makanan Favorit Anda ?"
                                                <?php if($rowMember['member_hint_question']=='Apa Makanan Favorit Anda ?'){echo "selected=selected";}?>>Apa Makanan Favorit Anda ? 
                                                </option>
                                        </select>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                        <label class="col-md-4 pu"><center> Answers</center></label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" required name="member_answer_question" placeholder="Hint Answers" reqiured value="<?php echo $rowMember['member_answer_question']; ?>">
                                        </div>    
                                  </div>
                                      <div class="form-group col-md-10">
                                          <button class="btn btn-primary dim_about pull-right" name="gantipassword"><span class="fa fa-gear"></span> Ubah</button>
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
        </div>