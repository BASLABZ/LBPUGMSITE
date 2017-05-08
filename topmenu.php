<div class="navbar-wrapper">
        <nav class="navbar navbar-success navbar-fixed-top dim_about" role="navigation" style="background-color: #1ab394;">
            <div class="container">
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php" style="color: white; position: absolute;">
                        <img src="img/logo-ugm.png" class="img-responsive dim_about" style="width: 290px; ">
                    </a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a class="page-scroll" href="index.php" style="color:black; ">Home</a></li>
                         <li><a class="page-scroll" href="index.php#instrumen" style="color:black; ">Alat Penelitian</a></li>
                        <li><a class="page-scroll" href="index.php#prosedur" style="color:black; ">Prosedur</a></li>
                        <li><a class="page-scroll" href="index.php#layanan" style="color:black; ">Profil Lab</a></li>
                         <?php 
                            if (isset($_SESSION['member_name'])) {
                                echo "<li><a class='page-scroll' style='color:black; ' href='member/index.php?hal=akun/profil'>Userprofil</a></li>";
                                echo "<li><a class='page-scroll' style='color:black; ' href='index.php?logout=1'>Keluar</a></li>";
                            }else{
                                echo " <li><a class='page-scroll' style='color:black; ' href='index.php#daftar'>Daftar</a></li>";
                            }
                         ?>
                        <li><a class="page-scroll" href="index.php#contact" style="color:black; ">Kontak</a></li>
                    </ul>
                </div>
            </div>
        </nav>
</div>
