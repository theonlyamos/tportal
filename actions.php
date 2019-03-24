<?php
/**
 * Description
 * @authors Amos Amissah (amosamissah@outlook.com)
 * @date    2019-03-24 22:19:13
 * @version 1.0.0
 */
require_once 'functions.php';

$action = $_GET['name'];
if ($action == 'logout') {
  destroySession();
  header("Location: /login.html");
}
else if ($action == 'getUsers') {
  $result = queryDB("SELECT fullname, email, profession FROM users");
  echo json_encode($result->fetch_array(MYSQLI_ASSOC));
}


?>