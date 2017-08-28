
<?php
include 'config/config.php';
$invoice = $_GET['invoice'];
$emails = $_GET['email'];
date_default_timezone_set('Etc/UTC');
require 'PHPMailerAutoload.php';
$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 2;
$mail->Debugoutput = 'html';
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = "lbpugmsite@gmail.com";
$mail->Password = "k3d0kt3r4n";
$mail->setFrom('lbpugmsite@gmail.com', 'LBP UGM');
$namaPenerimaEmail  = "$emails";
$mail->addAddress($emails, 'John Doe');
function get_include_contents($filename) {

    if (is_file($filename)) {
        ob_start();
        include $filename;
        return ob_get_clean();
    }
    return false;
}
$mail->IsHTML(true);
$mail->Subject = "You have an event today";
$mail->Body = get_include_contents('content\invoice.php');
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "<script>  location.href='../../../index.php?hal=peminjaman/pengajuan/pengajuan_detail&invoice=".$invoice."' </script>";exit;

}
