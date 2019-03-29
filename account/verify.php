<?php
/**
 * Description
 * @authors Amos Amissah (theonlyamos.github.io)
 * @date    2019-03-28 17:16:32
 * @version 1.0.0
 */

require_once '../functions.php';

$uid = sanitizeString($_GET['token']);

$query = "UPDATE users SET verified = TRUE WHERE id = '$uid'";

if (queryDB($query)){
  $result = queryDB("SELECT * FROM users WHERE id = '$uid'");
  $user = $result->fetch_array(MYSQLI_ASSOC);
  header("Location: /home");
  session_start();
  $_SESSION["loggedIn"] = "true";
  $_SESSION['user'] = $user;
}
echo 'Token has expired.';

?>