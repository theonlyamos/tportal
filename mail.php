<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

$mail = new PHPMailer(TRUE);

try {
  $mail->setFrom('donotreply@barthwal.com', "Tportal");
  $mail->addAddress("amosamissah@outlook.com", "Amos Amissah");
  $mail->Subject ="Email Verification";
  $mail->isHTML(TRUE);
  $mail->Body = "<div>Click on the link below to complete your registration.<br><a href='google.com'>https://google.com</a></div>";

  $mail->isSMTP();
  $mail->Host = "mail.barthwal.com";
  $mail->SMTPAuth = TRUE;
  $mail->Username = "donotreply@barthwal.com";
  $mail->Password = 'gZV$PL(J$rxW';
  $mail->Port = 465;

  $mail->send();
}
catch (Exception $e) {
  echo $e-> errorMessage();
}
catch (\Exception $e){
   echo $e->getMessage();
}


?>