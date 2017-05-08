<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8" />
     <title>SIM PENYEWAAN ALAT LABIRATORIUM | Login</title>
     <meta content="width=device-width, initial-scale=1.0" name="viewport" />
     <link rel="stylesheet" href="admin/assets/plugins/bootstrap/css/bootstrap.css" />
     <link rel="stylesheet" href="admin/assets/css/login.css" />
     <link rel="stylesheet" href="admin/assets/plugins/magic/magic.css" />
     <!-- <script src="https://use.fontawesome.com/39176f913b.js"></script> -->
     <link rel="stylesheet" type="text/css" href="admin/assets/font-awesome/css/font-awesome.min.css">
     <style type="text/css">
             .dim_about {box-shadow: inset 0 0 0 rgba(30, 172, 174, 0.39), 0 10px 0 0 rgba(30, 172, 174, 0), 0 8px 10px rgba(123, 83, 83, 0.58);}
    </style>
</head>
<body style="background-color: white;">
    <div class="container">
    <div class="row" style="padding-top:120px; ">
      <div class="col-md-4"></div>
      <div class="col-md-4">
        <div class="panel panel-success dim_about " style="background-color:#1ab394; border-color: #1ab394; ">
          <div class="panel-heading " style="background-color: #f8ac59; border-color: #f8ac59;">
            <center><img src="admin/assets/img/logo-ugm.png" id="logoimg" class="img-responsive" /></center>
          </div>
            <form action="inc/proses_login.php" method="POST">
          <div class="panel-body dim_about">
          
                <div class="row" style="padding-top: 30px; padding-bottom: 15px;">
                  <label class="col-md-4" style="padding-top:12px; color: white;">Username</label>
                  <div class="col-md-8">
                    <input type="text" placeholder="Username" class="form-control dim_about" name="username" />
                  </div>
                </div>
                <div class="row" style="padding-bottom: 50px;">
                  <label class="col-md-4" style="padding-top:12px; color: white;">Password</label>
                  <div class="col-md-8">
                    <input type="password" placeholder="Password" class="form-control dim_about" name="password" />
                    <div class="col-md-12">
                    <a href="#"><label class="col-md-10 pull-right" style="padding-top:12px; color: white;">Lupa Password?</label></a>
                    </div>
                  </div>
                </div>                       
          </div>
          <div class="panel-footer dim_about" style="background-color: #f8ac59; border-color: #f8ac59;">
            <div class="row">
                  <div class="col-md-4 pull-right">
                    <button class="btn btn-warning btn-md dim_about" type="submit"><span class="fa fa-sign-in"></span> Login</button>
                  </div>
                </div>
          </div>
            </form> 
        </div>
      </div>
    </div>
</div>
      <script src="admin/assets/plugins/jquery-2.0.3.min.js"></script>
      <script src="admin/assets/plugins/bootstrap/js/bootstrap.js"></script>
      <script src="admin/assets/js/login.js"></script>
</body>
</html>
