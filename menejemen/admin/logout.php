<?php
session_start();
session_destroy();
header("location:admin-login-form.php?init=logout");
?>