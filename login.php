<?php
require_once 'functions.php';

if (isset($_POST['email']) && isset($_POST['password'])) {
  $email = sanitizeString($_POST['email']);
  $pass = sanitizeString($_POST['password']);

  if ($email == "" || $pass == ""){
    $result["json"] = "Not all fields were entered!";
    echo $result;
  }
  else {
    $pass = createHash($pass, $email);
    $result = queryDB("SELECT * FROM users WHERE email='$email' AND  password='$pass'");
    
    if ($result->num_rows == 0) {
      $result["json"] = "Invalid Login!";
      echo $result;
    }
    else {
      $row = $result->fetch_array(MYSQLI_ASSOC);
      session_start();
      echo $row;
    }
  }
  
}

?>