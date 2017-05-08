<?php
error_reporting(0);
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

<!-- BEGIN HEAD -->
		<?php
		$init=$_REQUEST['init']; //inisialisasi utk paramameter yg memberi kadm5_delete_principal(handle, principal)angan jika Gagal

		$varMessage=""; // utk membuat notif
		switch($init){ 
			case "failed": //jika gagal maka
			$varMessage="Login Gagal";
			break;

			case "logout": //jika logout maka
			$varMessage="Anda telah logout";
			break;
		}
		?>
		<!-- untuk mengeluarkan notif yg dibuat diatas -->
		<h2><center><?php echo $varMessage?></center></h2> 
		
<head>
	<meta charset="UTF-8" />
    	<title>Login Page</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
     <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <!-- GLOBAL STYLES -->
     <!-- PAGE LEVEL STYLES -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="assets/css/login.css" />
    <link rel="stylesheet" href="assets/plugins/magic/magic.css" />
     <!-- END PAGE LEVEL STYLES -->
   <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
	<!-- END HEAD -->

    <!-- BEGIN BODY -->
<body>
	<!-- PAGE CONTENT --> 
	<div class="container">
    <div class="text-center">
    </div>
    <div class="tab-content">
        <div id="login" class="tab-pane active">
            <form action="admin-login-check.php" class="form-signin" method="post">
                <p class="text-muted text-center btn-block btn btn-primary btn-rect">
                    LOGIN
                </p>
				<input type="text" name="frm_user" class="form-control" placeholder="Username" required/>
				<input type="password" name="frm_password" class="form-control" placeholder="Password" required/>
				<input type="submit" name="simpan" class="btn text-muted text-center btn-danger" value="Sign in" required /><br/>
			</form>
        </div>	
         <div id="forgot" class="tab-pane">
            <form action="index.html" class="form-signin">
                <p class="text-muted text-center btn-block btn btn-primary btn-rect">Enter your valid e-mail</p>
                <input type="email"  required="required" placeholder="Your E-mail"  class="form-control" />
                <br />
                <button class="btn text-muted text-center btn-success" type="submit">Recover Password</button>
            </form>
        </div>
        <div id="signup" class="tab-pane">
            <form action="index.html" class="form-signin">
                <p class="text-muted text-center btn-block btn btn-primary btn-rect">Please Fill Details To Register</p>
                 <input type="text" placeholder="First Name" class="form-control" />
                 <input type="text" placeholder="Last Name" class="form-control" />
                <input type="text" placeholder="Username" class="form-control" />
                <input type="email" placeholder="Your E-mail" class="form-control" />
                <input type="password" placeholder="password" class="form-control" />
                <input type="password" placeholder="Re type password" class="form-control" />
                <button class="btn text-muted text-center btn-success" type="submit">Register</button>
            </form>
        </div>
    </div>
    <div class="text-center">
        <ul class="list-inline">
            <li><a class="text-muted" href="#login" data-toggle="tab">Login</a></li>
            <li><a class="text-muted" href="#forgot" data-toggle="tab">Forgot Password</a></li>
            <li><a class="text-muted" href="#signup" data-toggle="tab">Signup</a></li>
        </ul>
    </div>
</div>    
 <!--END PAGE CONTENT -->     
	      
      <!-- PAGE LEVEL SCRIPTS -->
      <script src="assets/plugins/jquery-2.0.3.min.js"></script>
      <script src="assets/plugins/bootstrap/js/bootstrap.js"></script>
   <script src="assets/js/login.js"></script>
      <!--END PAGE LEVEL SCRIPTS -->
</body>
</html>