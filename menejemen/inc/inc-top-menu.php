

<nav class="navbar navbar-inverse navbar-fixed-top " style="padding-top: 10px;">
        <a data-original-title="Show/Hide Menu" data-placement="bottom" data-tooltip="tooltip" class="accordion-toggle btn btn-primary btn-sm visible-xs" data-toggle="collapse" href="#menu" id="menu-toggle">
        <i class="icon-align-justify"></i>
        </a>
        <!-- HEADER -->
        <header class="navbar-header">
            <a href="admin-area.php" class="navbar-brand">
                <h4>
                    <?php echo "Selamat datang di halaman ".$_SESSION['levelName']."!"; ?>
                </h4>
                   	<img src="" alt="" /></a>
        </header>

	<ul class="nav navbar-top-links navbar-right">

 		<li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="icon-user "></i>&nbsp; <i class="icon-chevron-down "></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
            	<li><a href="#"><i class="icon-user"></i> User Profile </a></li>
           		<li><a href="#"><i class="icon-gear"></i> Settings </a></li>
                <li class="divider"></li>
                <li>
                	<a href="logout.php"><i class="icon-signout"></i> Logout </a>
                </li>
            </ul>
        </li>
	
	</ul> <!-- tutup ul navbar dropdown -->
</nav>