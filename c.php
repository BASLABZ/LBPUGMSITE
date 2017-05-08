<?php 
    if (isset($_POST['simpanregistrasi'])) {
      
      $tanggallahir = jin_date_sql($_POST['member_birth_date']);
      $member_institution = $_POST['member_institution'];
      $member_faculty = $_POST['member_faculty'];
      if ($member_institution =='' && $member_faculty=='') {
      $querySimpan = mysql_query("INSERT INTO tbl_member (
                                          member_name,member_birth_date,member_gender,
                                          member_phone_number,member_address,member_username,
                                          member_password,member_hint_question,member_answer_question,
                                          member_institution,member_faculty,member_email,
                                          member_idcard_photo,member_photo,member_status,
                                          member_login,member_register_date,
                                          member_confirm_date,category_id_fk
                                         ) 
                                VALUES (
                                    '".$_POST['member_name']."','".$tanggallahir."','".$_POST['member_gender']."','".$_POST['member_phone_number']."','".$_POST['member_address']."','".$_POST['member_username']."',md5('".$_POST['member_password']."'),'".$_POST['member_hint_question']."','".$_POST['member_answer_question']."','UGM','S1 KEDOKTERAN UGM','".$_POST['member_email']."','".$_POST['member_idcard_photo']."','','PENDING','N',NOW(),'','".$_POST['category_id_fk']."')");  
      }else{
      $querySimpan = mysql_query("INSERT INTO tbl_member (
                                          member_name,member_birth_date,member_gender,
                                          member_phone_number,member_address,member_username,
                                          member_password,member_hint_question,member_answer_question,
                                          member_institution,member_faculty,member_email,
                                          member_idcard_photo,member_photo,member_status,
                                          member_login,member_register_date,
                                          member_confirm_date,category_id_fk
                                         ) 
                                VALUES (
                                    '".$_POST['member_name']."','".$tanggallahir."','".$_POST['member_gender']."','".$_POST['member_phone_number']."','".$_POST['member_address']."','".$_POST['member_username']."',md5('".$_POST['member_password']."'),'".$_POST['member_hint_question']."','".$_POST['member_answer_question']."','".$_POST['member_institution']."','".$_POST['member_faculty']."','".$_POST['member_email']."','".$_POST['member_idcard_photo']."','','PENDING','N',NOW(),'','".$_POST['category_id_fk']."')");  
      }
      
      if ($querySimpan) {
                         echo "<script> alert('Terimakasih Data Berhasil Disimpan'); location.href='index.php' </script>";exit;
                   }else{
                         echo "<script> alert(' Data Gagal Disimpan'); location.href='index.php' </script>";exit;
                   }
                   
    }
 ?>
<div id="registrasi" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header"  style="background-color: #1ab394;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color:white;"><span class="fa fa-user-plus"></span> REGISTRASI SISTEM LBP - UGM</h4>
      </div>
      <div class="modal-body" style="height: 500px;">
        <form id="form" action="#" class="wizard-big">
                                <h1>Account</h1>
                                <fieldset>
                                    <h2>Account Information</h2>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Username *</label>
                                                <input id="userName" name="member_username" type="text" class="form-control required">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Password *</label>
                                                <input id="password" name="member_password" type="text" class="form-control required">
                                            </div>
                                              
                                        </div>
                                        <div class="col-lg-6">
                                        <label>Hint Questions</label>
                                          <select class="form-control required" id="member_hint_question" name="member_hint_question" reqiured>
                                          <option value="">Pilih Pertanyaan</option>
                                          <option value="Dimana Kota Anda Dilahirkan ?">Dimana Kota Anda Dilahirkan ?</option>
                                          <option value="Siapakah Nama Ayah Kandung Anda ?"> Siapakah Nama Ayah Kandung Anda ?</option>
                                          <option value="Siapa Penyanyi Favorit Anda ?">Siapa Penyanyi Favorit Anda?</option>
                                          <option value="Apa Makanan Favorit Anda ?">Apa Makanan Favorit Anda ?</option>
                                        </select>
                                        </div>
                                        <div class="col-lg-6"> 
                                        <label>Hint Answers</label>
                                          <input id="hnt" name="member_answer_question" type="text" class="form-control required">
                                        <br>
                                        </div>
                                        <div class="col-lg-6">
                                           <div class="form-group">
                                                <label>Email *</label>
                                                <input id="email" name="member_email" type="text" class="form-control required email">
                                            </div>
                                         </div>
                                    </div>
                                </fieldset>
                                <h1>Profile</h1>
                                <fieldset>
                                    <h2>Profile Information</h2>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>First name *</label>
                                                <input id="member_name" name="member_name" type="text" class="form-control required" >
                                            </div>
                                         
                                                <label>Gender *</label>
                                                <select class="form-control required" id="gen" name="member_gender" reqiured>
                                                <option value="">PILIH GENDER</option>
                                                <option value="Laki-laki">LAKI - LAKI</option>
                                                <option value="Perempuan">PEREMPUAN</option>
                                              </select>
                                            
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Birt Day *</label>
                                                <input type="date" id="bt" name="member_birth_date" class="form-control required">
                                            </div>
                                            <div class="form-group">
                                            <label>NO TELP</label>
                                        <input id="notelp" name="member_phone_number" type="text" class="form-control required" >
                                         </div>

                                        </div>
                                        <div class="col-md-6">
                                         
                                                <label>Address *</label>
                                               <textarea class="form-control reqiured" id="alamat" name="member_address" ></textarea>
                                            </div>
                                        
                                    </div>
                                </fieldset>

                                <h1>INSTITUSI</h1>
                                <fieldset>
                                   <div class="row" id="selow">
                                     <div class="col-md-6">
                                       <label>* KATEGORI</label>
                                        <select id="cat_id" class="form-control reqiured" name="category_id_fk"  >
                                        <option value="">Pilih Kategori</option>
                                        <?php 
                                            $queryKategori  = mysql_query("SELECT * FROM ref_category order by category_id");
                                            while ($rowCategory = mysql_fetch_array($queryKategori)) {
                                              echo "<option value='".$rowCategory['category_id']."'>".$rowCategory['category_name']."</option>";
                                            }
                                         ?>
                                      </select>
                                     </div>
                                     <div class="col-md-6">
                                       <div class="row" id="kat1" style="display: none;">
                                         <div class="form-group row">
                                        <label class="col-md-2">NAMA INSTITUSI</label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" name="member_institution" placeholder="NAMA INSTITUSI" name="intitusi" reqiured>
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label class="col-md-2">FAKULTAS</label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" name="member_faculty" placeholder="FAKULTAS" name="fakultas" reqiured>
                                        </div>
                                      </div>
                                      </div>
                                      <div class="row" id="kat2" style="display: none;">
                                        <div class="form-group row">
                                        <label class="col-md-2">NAMA INSTITUSI</label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" name="member_institution" placeholder="NAMA INSTITUSI" name="intitusi" reqiured>
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label class="col-md-2">BIDANG</label>
                                        <div class="col-md-6">
                                          <input type="text" class="form-control" name="member_faculty" placeholder="BIDANG" name="fakultas" reqiured>
                                        </div>
                                      </div>
                                      </div>
                                      <div class="form-group row">
                                      <label class="col-md-2">ID CARD</label>
                                      <div class="well">
                                        upoad id card
                                      </div>
                                      <div class="col-md-6">
                                      <input type="text" id="tes" class="form-control reqiured"  name="member_idcard_photo" >
                                      </div>
                                    </div>
                                     </div>
                                   </div>
                                </fieldset>

                                <h1>Finish</h1>
                                <fieldset>
                                    <h2>Terms and Conditions</h2>
                                    <input id="acceptTerms" name="acceptTerms" type="checkbox" class="required"> <label for="acceptTerms">I agree with the Terms and Conditions.</label>
                                </fieldset>
                            </form>
      </div>
       
        
      
      <div class="modal-footer">
        <button type="button" class="btn btn-danger dim_about" data-dismiss="modal"><span class="fa fa-times"></span> TUTUP</button>
      </div>
    </div>

  </div>
</div>
 <!-- end step -->
          <div class="wizard">
            <div class="wizard-inner">
                <div class="connecting-line"></div>
                <ul class="nav nav-tabs" role="tablist">

                    <li role="presentation" class="active">
                        <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </span>
                        </a>
                    </li>

                    <li role="presentation" class="disabled">
                        <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-user"></i>
                            </span>
                        </a>
                    </li>
                    <li role="presentation" class="disabled">
                        <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-education"></i>
                            </span>
                        </a>
                    </li>

                    <li role="presentation" class="disabled">
                        <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-ok"></i>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>

            <form role="form" method="POST" enctype="multipart/form-data">
                <div class="tab-content">
                    <div class="tab-pane active" role="tabpanel" id="step1">
                        <h3>IDENTITAS MEMBER</h3>
                        <hr>
                         <div class="form-group row">
                          <label class="col-md-2">NAMA LENGKAP</label>
                          <div class="col-md-6">
                            <input type="text" class="form-control" name="member_name" placeholder="NAMA LENGKAP" reqiured>
                          </div>
                        </div> 
                        <div class="form-group row">
                          <label class="col-md-2">GENDER</label>
                          <div class="col-md-6">
                            <select class="form-control" name="member_gender" reqiured>
                              <option value="Laki-laki">LAKI - LAKI</option>
                              <option value="Perempuan">PEREMPUAN</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-md-2">TANGGAL LAHIR</label>
                          <div class="col-md-3"><input type="text" name="member_birth_date" class="form-control datepicker" reqiured></div>
                        </div>
                         <div class="form-group row">
                          <label class="col-md-2">ALAMAT</label>
                          <div class="col-md-6">
                            <textarea class="form-control" name="member_address" placeholder="ALAMAT MEMBER" reqiured></textarea>
                          </div>
                        </div>
                         <div class="form-group row">
                          <label class="col-md-2">NO TELP</label>
                          <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="NO TELP." name="member_phone_number" reqiured>
                          </div>
                        </div>
                         
                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-primary next-step dim_about">SELANJUTNYA <span class="fa fa-arrow-right"></span></button></li>
                        </ul>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="step2">
                        <h3>AKUN</h3>
                        <hr>
                         <div class="form-group row">
                          <label class="col-md-2">USERNAME</label>
                          <div class="col-md-6">
                            <input type="text" class="form-control" name="member_username" placeholder="USERNAME" reqiured>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-md-2">PASSWORD</label>
                          <div class="col-md-6">
                            <input type="password" class="form-control" name="member_password" placeholder="PASSWORD" reqiured>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-md-2">EMAIL</label>
                          <div class="col-md-6">
                            <input type="email" class="form-control" name="member_email" placeholder="EMAIL" reqiured>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-md-2">Hint Questions</label>
                          <div class="col-md-6">
                            <select class="form-control" name="member_hint_question" reqiured>
                              <option value="NULL">Pilih Pertanyaan</option>
                              <option value="Dimana Kota Anda Dilahirkan ?">Dimana Kota Anda Dilahirkan ?</option>
                              <option value="Siapakah Nama Ayah Kandung Anda ?"> Siapakah Nama Ayah Kandung Anda ?</option>
                              <option value="Siapa Penyanyi Favorit Anda ?">Siapa Penyanyi Favorit Anda?</option>
                              <option value="Apa Makanan Favorit Anda ?">Apa Makanan Favorit Anda ?</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-md-2">Hint Answers</label>
                          <div class="col-md-6">
                            <input type="text" class="form-control" name="member_answer_question" placeholder="Hint Answers" reqiured>
                          </div>
                        </div>
                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-primary prev-step dim_about"><span class="fa fa-arrow-left"></span> KEMBALI</button></li>
                            <li><button type="button" class="btn btn-primary next-step dim_about">SELANJUTNYA <span class="fa fa-arrow-right"></span></button></li>
                        </ul>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="step3">
                        <h3>INSTITUSI</h3>
                        <hr>
                        <div class="row">
                          <div class="form-group row">
                          <label class="col-md-2">KATEGORI</label>
                         <div class="col-md-4">
                            <select class="form-control" name="category_id_fk" id="cat_id" reqiured>
                              <?php 
                                  $queryKategori  = mysql_query("SELECT * FROM ref_category order by category_id");
                                  while ($rowCategory = mysql_fetch_array($queryKategori)) {
                                    echo "<option value='".$rowCategory['category_id']."'>".$rowCategory['category_name']."</option>";
                                  }
                               ?>
                            </select>
                         </div>
                        </div>
                        </div>
                        <div class="row" id="kat1" style="display: none;">
                           <div class="form-group row">
                          <label class="col-md-2">NAMA INSTITUSI</label>
                          <div class="col-md-6">
                            <input type="text" class="form-control" name="member_institution" placeholder="NAMA INSTITUSI" name="intitusi" reqiured>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-md-2">FAKULTAS</label>
                          <div class="col-md-6">
                            <input type="text" class="form-control" name="member_faculty" placeholder="FAKULTAS" name="fakultas" reqiured>
                          </div>
                        </div>
                        </div>
                        <div class="row" id="kat2" style="display: none;">
                          <div class="form-group row">
                          <label class="col-md-2">NAMA INSTITUSI</label>
                          <div class="col-md-6">
                            <input type="text" class="form-control" name="member_institution" placeholder="NAMA INSTITUSI" name="intitusi" reqiured>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-md-2">BIDANG</label>
                          <div class="col-md-6">
                            <input type="text" class="form-control" name="member_faculty" placeholder="BIDANG" name="fakultas" reqiured>
                          </div>
                        </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-md-2">ID CARD</label>
                          <div class="well">
                            upoad id card
                          </div>
                          <div class="col-md-6">
                            <input type="text" class="form-control" name="member_idcard_photo" placeholder="ID CARD / KTM" reqiured>
                          </div>
                        </div>
                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-primary prev-step dim_about"><span class="fa fa-arrow-left"></span> KEMBALI</button></li>
                            <li><button type="button" class="btn btn-primary btn-info-ful dim_aboutl next-step">SELANJUTNYA <span class="fa fa-arrow-right"></span></button></li>
                        </ul>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="complete">
                        <center>
                        <div class="form-group row">
                          <div class="col-md-2"><input type="checkbox" class="form-control" required></div>
                          <div class="col-md-10">
                            <p>
                              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                              consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                              cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                              proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </p>
                          </div>
                        </div>
                       <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-primary prev-step dim_about"><span class="fa fa-arrow-left"></span> KEMBALI</button></li>
                            <li><button type="submit" name="simpanregistrasi" class="btn btn-primary btn-info-ful dim_aboutl next-step">SIMPAN <span class="fa fa-arrow-right"></span></button></li>
                        </ul>
                        </center>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </form>

        </div>
<script type="text/javascript">
 $(document).ready(function(){
  // $('.datepicker').datepicker({autoclose:true});
            $("#wizard").steps();
            $("#form").steps({

                bodyTag: "fieldset",
                onStepChanging: function (event, currentIndex, newIndex)
                {
                    // Always allow going backward even if the current step contains invalid fields!
                    if (currentIndex > newIndex)
                    {
                        return true;
                    }

                    // Forbid suppressing "Warning" step if the user is to young
                    if (newIndex === 3 && Number($("#age").val()) < 18)
                    {
                        return false;
                    }

                    var form = $(this);

                    // Clean up if user went backward before
                    if (currentIndex < newIndex)
                    {
                        // To remove error styles
                        $(".body:eq(" + newIndex + ") label.error", form).remove();
                        $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
                    }

                    // Disable validation on fields that are disabled or hidden.
                    form.validate().settings.ignore = ":disabled,:hidden";

                    // Start validation; Prevent going forward if false
                    return form.valid();
                },
                onStepChanged: function (event, currentIndex, priorIndex)
                {
                    // Suppress (skip) "Warning" step if the user is old enough.
                    if (currentIndex === 2 && Number($("#age").val()) >= 18)
                    {
                        $(this).steps("next");
                    }

                    // Suppress (skip) "Warning" step if the user is old enough and wants to the previous step.
                    if (currentIndex === 2 && priorIndex === 4)
                    {
                        $(this).steps("previous");
                    }
                },
                onFinishing: function (event, currentIndex)
                {
                    var form = $(this);

                    // Disable validation on fields that are disabled.
                    // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
                    form.validate().settings.ignore = ":disabled";

                    // Start validation; Prevent form submission if false
                    return form.valid();
                },
                onFinished: function (event, currentIndex)
                {
                    var form = $(this);
                     alert("Submitted!");
                    form.submit();
                }
            }).validate({
                        errorPlacement: function (error, element)
                        {
                            element.before(error);
                        },
                        rules: {
                            confirm: {
                                equalTo: "#password"
                            },
                            ignore: ":hidden:not(#member_hint_question)"
                        },
                        rules:{ ignore: ":hidden:not(#gen)" },
                        rules: { ignore: ":hidden:not(#cat_id)"}


                    });
       });
    

</script>