
<div id="left" style="" class="dim_about fixed">
            <div class="media user-media well-small"  style="background-color: #273a4a; border-color: #273a4a;">
                <a class="user-link" href="#">
                    <img class="media-object img-circle dim_about user-img" alt="User Picture" src="manda.jpg" height="100px" width="100px" />
                </a>
                <br />
                <div class="media-body">
                    <h5 class="media-heading" style="color:white; "> <?php echo $_SESSION['operator_username']; ?></h5>
                </div>
                <br />
            </div>
            <ul id="menu" class="collapse"  style="background-color: #273a4a; border-color: #273a4a;">
                <li class="panel">
                    <a href="index.php" style="color: white;"><i class="icon-table"></i> Dashboard</a>                   
                </li>
                <?php include '../inc/inc-menu.php'; ?>
                <li style="height:350px; "></li>
            </ul>
        </div>