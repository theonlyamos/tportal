<?php
/**
 * Description
 * @authors Amos Amissah (theonlyamos.github.io)
 * @date    2019-03-28 17:16:32
 * @version 1.0.0
 */

require_once '../functions.php';

$uid = sanitizeString($_GET['token']);
$table = sanitizeString($_GET['pro']);

$query = "UPDATE $table SET verified = TRUE WHERE id = '$uid'";

if (queryDB($query)){
  $result = queryDB("SELECT * FROM $table WHERE id = '$uid'");
  $user = $result->fetch_array(MYSQLI_ASSOC);
  session_start();
  $_SESSION["loggedIn"] = "true";
  $_SESSION['user'] = $user;

  if ($table == 'users') header("Location: /home");
  else if ($table == 'states') header("Location: /state");
}
echo 'Token has expired.';

?>