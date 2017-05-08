<div id="lupapassword" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"  style="background-color: #1ab394;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color:white;"><span class="fa fa-key"></span> Lupa Password</h4>
      </div>
      <div class="modal-body">
        <center><h1 style="color:#1ab394; "><span class="fa fa-key fa-2x"></span></h1></center>
        <form class="role" method="POST" action="member/forgot_password.php">
          <div class="form-group row">
            <label class="col-md-2">Email</label>
             <div class="col-md-10">
              <input type="email" class="form-control" name="email" required>
             </div>
          </div>
          <div class="form-group row">
                <label class="col-md-2">Hint Questions</label>
                <div class="col-md-10">
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
                  <div class="col-md-10">
                    <input type="text" class="form-control" required name="member_answer_question" placeholder="Hint Answers" reqiured>
                  </div>    
            </div>
          <div class="form-group row">
            
            <div class="col-md-4">
              <button type="submit" name="login" class="btn btn-info dim_about pull-right"><span class="fa fa-key"></span> Cek</button>
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