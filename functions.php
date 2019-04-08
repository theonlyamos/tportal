<?php
/**
 * Description
 * @Amos Amissah (anosamissah@outlook.com)
 * @date    2019-03-20 14:37:00
 * @version 1.0.0
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

require_once '.env.php';

$dbhost = "sql304.epizy.com";
$dbuser = "epiz_23637101";
$dbpass = "30fBCiC73v";
$dbname = "epiz_23637101_tportal";

$connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($connection->connect_error) die($connection->connect_error);

function queryDB ($query){
  global $connection;
  $result = $connection->query($query);
  if (!$result) die($connection->error);
  return $result;
}

function sanitizeString($var) {
  global $connection;
  $var = trim($var);
  $var = strip_tags($var);
  $var = htmlentities($var);
  $var = stripslashes($var);
  return $connection->real_escape_string($var);
}

function createTable($name, $query) {
  queryDB("CREATE TABLE IF NOT EXISTS $name($query)");
  echo "<div class='alert-primary'>Table <strong>$name<strong> created successfully</div>";
}

function createHash($pass, $email) {
  $salt = 'tportal';
  return hash("sha256", $salt.$email.$pass);
}

function destroySession(){
$_SESSION=array();
if (session_id() != "" || isset($_COOKIE[session_name()]))
setcookie(session_name(), '', time()-2592000, '/');
session_destroy();
}

function setLog($role, $userid, $message,$country){
  $query = "INSERT INTO logs (id, role, userid, message, country) VALUES (
    UUID(), $role, $userid, $message, $country
  )";
  queryDB($query);
}

function getLogs($lastLog){
  $result = queryDB("SELECT * FROM logs WHERE createdAt > '$lastLog'");
  if ($result->num_rows){
    return $result->fetch_array(MYSQLI_ASSOC);
  }
  else {
    return false;
  }
}

function sendMail($from, $name, $to, $subject, $body, $fullname=""){
  $mail = new PHPMailer(TRUE);
  $mail->setFrom($from, $name);
  $mail->addAddress($to, $fullname);
  $mail->Subject = $subject;
  $mail->isHTML(TRUE);
  $mail->Body = $body;
  $mail->isSMTP();
  $mail->Host = $smtpCreds["host"];
  $mail->SMTPAuth = TRUE;
  $mail->Username = $smtpCreds["username"];
  $mail->Password = $smtpCreds["password"];
  $mail->Port = 587;
  $mail->send();
}

?>