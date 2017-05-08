<?php
	require_once("inc-db.php");
	$query = "UPDATE tbl_member set member_status = 'active' WHERE id='" . $_GET["id"]. "'";
	$result = mysql_query($query)
		if(!empty($result)) {
			$message = "Your account is activated.";
		} else {
			$message = "Problem in account activation.";
		}
?>
<html>
<head>
<title>PHP User Registration Form</title>
<link href="style.css" type="text/css" rel="stylesheet" />
</head>
<body>
<?php if(isset($message)) { ?>
<div class="message"><?php echo $message; ?></div>
<?php } ?>
</body></html>
		