<body class="padTop53 " >
    <div id="wrap">
    <div id="top" style="padding-top:10px; ">
        <nav class="navbar navbar-inverse navbar-fixed-top dim_about" style="padding-top: 10px; border-color:#1ab394;  background-color:#1ab394; " >
            <a data-original-title="Show/Hide Menu" data-placement="bottom" data-tooltip="tooltip" class="accordion-toggle btn btn-primary btn-sm visible-xs" data-toggle="collapse" href="#menu" id="menu-toggle">
                <i class="icon-align-justify"></i>
            </a>
            <header class="navbar-header">
                <a href="index.php" class="navbar-brand">
                <img src="assets/img/logo-ugm.png" class="img-responsive dim_about" style="width: 50%; height:auto;" /></a>
            </header>
            <ul class="nav navbar-top-links navbar-right" >
                <li class="dropdown  dim_about  ">
                    <a class="dropdown-toggle widget" data-toggle="dropdown" href="#" style="background-color:#1ab394; color: white;">
                        <i class=" fa fa-2x icon-chevron-down "></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user" style="background-color: #23c6c8; border-color: #23c6c8;">
                        <li><a style="background-color: #23c6c8; color: white;" href="index.php?hal=operator/user_profil&id=<?php echo $_SESSION['operator_id']; ?>"><i class="icon-user"></i> Profil Pengguna </a>
                        </li>
                        <li><a style="background-color: #23c6c8; color: white;" href="index.php?hal=operator/user_setting&id=<?php echo $_SESSION['operator_id']; ?>"><i class="icon-gear"></i> Pengaturan </a>
                        </li>
                        
                        <li><a style="background-color: #23c6c8; color: white;" href="index.php?logout=1"><i class="icon-signout"></i> Keluar </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>