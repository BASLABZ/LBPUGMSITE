<?php
    include 'config/config.php';
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Library For Send Email</title>
  </head>
  <body>
        <?php
            $id = 8;
            $ency = base64_encode($id);
            $email = 'nsjm.cs@gmail.com';
            echo "<a href='sendEmailDebug.php?id=".$ency."&email=".$email."'>Send Email Now</a>";
         ?>

  </body>
</html>
