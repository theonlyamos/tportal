<?php
/**
 * Description
 * @Amos Amissah (anosamissah@outlook.com)
 * @date    2019-03-20 14:37:00
 * @version 1.0.0
 */

$dbhost = '	sql304.epizy.com';
$dbuser = 'epiz_23637101';
$dbpass = '0fBCiC73v';
$dbname = 'epiz_23637101_tportal';

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
  return hash($pass, $salt.$email);
}

?>