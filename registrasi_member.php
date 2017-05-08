<?php 
        // sementara ditutup dahulu sebelum online
        // $secret = '6LeVCRkUAAAAAPFhq6nB47IsHcrEAdeixz3f-qKd';
        // //get verify response data
        // $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
        // $responseData = json_decode($verifyResponse);
 ?>
<div id="registrasi" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header"  style="background-color: #1ab394;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color:white;"><span class="fa fa-user-plus"></span> REGISTRASI SISTEM LBP - UGM </h4>
      </div>
      <div class="modal-body">
        <form class="role" method="POST" id="frmAjaxregis" action="member/proses_registrasi_member.php" enctype="multipart/form-data">
          <div class="well"> <b>*Semua Data Wajib diisi </b></br> </br>
            <div class="form-group row">
            <div class="col-md-6"> 
              <label class="col-md-4">Nama Lengkap</label>
              <div class="col-md-8">
                <input type="text" class="form-control" placeholder="Nama Lengkap"  name="member_name" id="nama"   required>
              </div>
            </div>
            <div class="col-md-6">
              <label class="col-md-2">Email</label>
                <div class="col-md-8">
                  <input type="email" class="form-control" required placeholder="Email"  name="member_email" >
                </div>  
              </div>
          </div>
           <hr>
            <div class="form-group row">
            <div class="col-md-6">
              <label class="col-md-4">Username</label>
              <div class="col-md-8">
                <input type="text" class="form-control" required placeholder="Username"  name="member_username">
              </div>
            </div>
            <div class="col-md-6">
               <div class="form-group row">
              <label class="col-md-2">Password</label>
              <div class="col-md-8">
                <input type="password" class="form-control" required placeholder="Password" maxlength="8" minlength="6" name="member_password" id="password1"> </br>
                <input type="password" class='form-control' id="password2" required placeholder="Re-Type Password" maxlength="8" minlength="6" name="member_re_password" onkeyup="checkPass(); return false;">
                <span id="confirmMessage" class="confirmMessage"></span><br>
                <i>Password Min 6 Karakter Max 8 Karakter</i>
              </div>
            </div>   
            </div>
            </div>
            <hr>
              <div class="form-group row">
              <label class="col-md-2">KATEGORI</label>
             <div class="col-md-5">
                <select class="form-control" required name="category_id_fk" id="cat_id" reqiured>
                  <option value="0">Pilih Kategori</option>
                  <?php 
                      $queryKategori  = mysql_query("SELECT * FROM ref_category order by category_id");
                      while ($rowCategory = mysql_fetch_array($queryKategori)) {
                        echo "<option value='".$rowCategory['category_id']."'>".$rowCategory['category_name']."</option>";
                      }
                   ?>
                </select>
             </div>
            </div>
            <div class="row" id="kat1" hidden>
               <div class="col-md-6">
              <label class="col-md-5">NAMA INSTITUSI</label>
              <div class="col-md-7">
                <input type="text" class="form-control"  name="member_institution_mahasiswa" placeholder="NAMA INSTITUSI" name="intitusi" reqiured>
              </div>
            </div>
            <div class="col-md-6">
              <label class="col-md-4">FAKULTAS</label>
              <div class="col-md-8">
                <input type="text" class="form-control"  name="member_faculty_mahasiswa" placeholder="FAKULTAS" name="fakultas" reqiured>
              </div>
            </div>
            </div>
            <div class="row" id="kat2" hidden>
              <div class="col-md-6">
              <label class="col-md-5">NAMA INSTITUSI</label>
              <div class="col-md-7">
                <input type="text" class="form-control"  name="member_institution_peneliti" placeholder="NAMA INSTITUSI" name="intitusi" reqiured>
              </div>
            </div>
            <div class="col-md-6">
              <label class="col-md-4">BIDANG</label>
              <div class="col-md-8">
                <input type="text" class="form-control"  name="member_faculty_peneliti" placeholder="BIDANG" name="fakultas" reqiured>
              </div>
            </div>
            </div>
            <div class="row" id="kat3" hidden>
            <div class="col-md-6">
              <label class="col-md-4">FAKULTAS</label>
              <div class="col-md-8">
                <input type="text" class="form-control"  name="member_s2" placeholder="FAKULTAS"  reqiured>
              </div>
            </div>
            <div class="col-md-6">
              <label class="col-md-4">JURUSAN</label>
              <div class="col-md-8">
                <input type="text" class="form-control"  name="member_jurusan" placeholder="JURUSAN"  reqiured>
              </div>
            </div>
            </div>
            
            <hr>
            <div class="form-group row">
                <label class="col-md-2">Hint Questions</label>
                <div class="col-md-6">
                  <select class="form-control" required name="member_hint_question" reqiured>
                    <option value="">Pilih Pertanyaan</option>
                    <option value="Dimana Kota Anda Dilahirkan ?">Dimana Kota Anda Dilahirkan ?</option>
                    <option value="Siapakah Nama Ayah Kandung Anda ?"> Siapakah Nama Ayah Kandung Anda ?</option>
                    <option value="Siapa Penyanyi Favorit Anda ?">Siapa Penyanyi Favorit Anda?</option>
                    <option value="Apa Makanan Favorit Anda ?">Apa Makanan Favorit Anda ?</option>
                  </select>
                </div>
            </div>
            <div class="form-group row">
                  <label class="col-md-2">Answers</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" required name="member_answer_question" placeholder="Hint Answers" reqiured>
                  </div>    
            </div>
          <hr>
            <div class="form-group row">
              <div class="col-md-6">
                <label class="col-md-4">FOTO KTM / IDENTITAS PRIBADI</label>
                <div class="col-md-8">
                  <input type="file" name="member_idcard_photo" required="true" accept="image/*">
                </div>
              </div>
              <div class="col-md-6">
                <!-- <div class="g-recaptcha" data-sitekey="6LeVCRkUAAAAAF9YlXrR8MPtkY6ehneWuc3VsfXr"></div> -->
              </div>
            </div>
          </div>
          <div class="form-group row well">
            <div class="col-md-10">
              <button type="submit" name="simpanregistrasi" class="btn btn-success btn-sm pull-right dim_about"><span class="fa fa-save"></span> SIMPAN</button>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger dim_about" data-dismiss="modal"><span class="fa fa-times"></span> TUTUP</button>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript">
    $('.datepicker').datepicker({autoclose:true});
    $('#cat_id').on('change',function () {
      if(this.value == "1") {
          $('#kat1').hide();
          $('#kat2').hide();
          $('#kat3').hide();
        }else if(this.value == "5") {
          $('#kat1').hide();
          $('#kat2').hide();
          $('#kat3').show();
        }else if(this.value == "6") {
          $('#kat1').hide();
          $('#kat2').hide();
          $('#kat3').show();
        }else if (this.value == "2") {
          $('#kat1').show();
          $('#kat2').hide();
          $('#kat3').hide();
        }else if (this.value == "3") {
          $('#kat2').show();
          $('#kat1').hide();
          $('#kat3').hide();
        }else if (this.value == "4") {
          $('#kat2').show();
          $('#kat1').hide();
          $('#kat3').hide();
        }else if (this.value == "0") {
          $('#kat1').hide();
          $('#kat2').hide();
          $('#kat3').hide();
        }  
    })
    // validate js required
    // valudate re-password js-bas
    function checkPass()
{

    var password1 = document.getElementById('password1');
    var password2 = document.getElementById('password2');
    var message = document.getElementById('confirmMessage');
    var goodColor = "#66cc66";
    var badColor = "#ff6666";
    if(password1.value == password2.value){
        password2.style.backgroundColor = goodColor;
        message.style.color = goodColor;
        message.innerHTML = "Passwords Match!"
    }else{
        password2.style.backgroundColor = badColor;
        message.style.color = badColor;
        message.innerHTML = "Passwords Do Not Match!"
    }
} 
    
</script>
<!-- <script src='https://www.google.com/recaptcha/api.js'></script> -->