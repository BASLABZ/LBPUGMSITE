<!-- function for login system -->
<?php 
        if (isset($_POST['login'])) {
            $username   = $_POST['username'];
            $password   = md5($_POST['password']);
            $no = 0;
            $sqllogin = " SELECT * FROM tbl_member where member_username = '".$username."' and member_password= '".$password."' and member_status !='Pending' and member_status != 'Ignore' and member_status != 'Confirmed' AND member_login ='N' ";
            $hasil = mysql_query($sqllogin);
            while ($login=mysql_fetch_array($hasil)) {
                $member_id       = $login['member_id'];
                $username        = $login['member_username'];
                $password        = $login['member_password'];
                $namalengkap     = $login['member_name']; 
                $email     = $login['member_email']; 
                $phone     = $login['member_phone_number']; 
                $alamat     = $login['member_address']; 
                $idcard     = $login['member_idcard_photos']; 
                $foto = $login['member_photo'];
                $categori = $login['category_id_fk'];
                $no++;
            }
            if ($no>0) {
                $_SESSION['member_id'] = $member_id;
                $_SESSION['member_name']= $namalengkap;
                $_SESSION['member_username']= $username;
                $_SESSION['member_password'] = $password;
                $_SESSION['member_email'] = $email;
                $_SESSION['member_phone_number'] = $phone;
                $_SESSION['member_address'] = $alamat;
                $_SESSION['member_idcard_photos'] = $idcard;
                $_SESSION['member_photo']  = $foto;
                $_SESSION['category_id_fk'] = $categori;
                $AkuratLogin = mysql_query("UPDATE tbl_member set member_login='Y' where member_id='".$_SESSION['member_id']."'");
                
                echo "<script> alert('Login sukses'); location.href='member/index.php';</script>  ";exit;
            }else{
                echo "<script> alert('Login Gagal Ulangi'); location.href='index.php';  </script>";exit;
            }
        }
 ?>
<div id="login" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"  style="background-color: #1ab394;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color:white;"><span class="fa fa-key"></span> LOGIN SISTEM LBP - UGM</h4>
      </div>
      <div class="modal-body">
        <center><h1 style="color:#1ab394; "><span class="fa fa-key fa-2x"></span></h1></center>
        <form class="role" method="POST">
          <div class="form-group row">
            <label class="col-md-4">USERNAME</label>
            <div class="col-md-6">
              <input type="text" class="form-control" placeholder="USERNAME" name="username" required>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-4">PASSWORD</label>
            <div class="col-md-6">
              <input type="password" class="form-control" placeholder="PASSWORD" name="password" required>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
              <div class="input-group">
                <a href="#" data-toggle="modal" data-target="#lupapassword"><span class="fa fa-user-plus"></span> Lupa Password</a>
              </div>
            </div>
            <div class="col-md-2">
              <button type="submit" name="login" class="btn btn-info dim_about pull-right"><span class="fa fa-key"></span> LOGIN</button>
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