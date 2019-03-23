<?php
require_once 'functions.php';

if (isset($_POST['email']) && isset($_POST['password'])) {
  $email = sanitizeString($_POST['email']);
  $pass = sanitizeString($_POST['password']);

  if ($email == "" || $pass == ""){
    http_response_code(402);
    echo "Not all fields are entered;";
  }
  else {
    $pass = createHash($pass, $email);
    $result = queryDB("SELECT * FROM users WHERE email='$email' AND  password='$pass'");
    
    if ($result->num_rows == 0) {
      http_response_code(402);
      echo "User does not exists";
    }
    else {
      $row = $result->fetch_array(MYSQLI_ASSOC);
      header("Location: /home");
      session_start();
      $_SESSION["loggedIn"] = "true";
      $_SESSION["user_email"] = $row['email'];
    }
  }
  
}
else {
  http_response_code(401);
  echo json_encode($_POST);
}

?>