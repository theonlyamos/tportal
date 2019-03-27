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

    if ($_POST['profession'] == "user"){
      $result = queryDB("SELECT email FROM users WHERE email='$email'");
      
      if ($result->num_rows == 0) {
        http_response_code(402);
        echo "User with email: $email does not exists";
      }
      else {
        $user = queryDB("SELECT * FROM users WHERE email='$email' AND  password='$pass'");
        if ($user->num_rows == 0) {
          http_response_code(402);
          echo "Wrong email/password. Try again!";
        }else{
          $row = $user->fetch_array(MYSQLI_ASSOC);
            header("Location: /home");
            session_start();
            $_SESSION["loggedIn"] = "true";
            $_SESSION["user"] = $row;
        }
      }
    }
    else {
      $result = queryDB("SELECT email FROM users WHERE email='$email'");
      
      if ($result->num_rows == 0) {
        http_response_code(402);
        echo "User with email: $email does not exists";
      }
      else {
        $user = queryDB("SELECT * FROM states WHERE email='$email' AND  password='$pass'");
        if ($user->num_rows == 0) {
          http_response_code(402);
          echo "Wrong email/password. Try again!";
        }else{
          $row = $user->fetch_array(MYSQLI_ASSOC);
            header("Location: /state");
            session_start();
            $_SESSION["loggedIn"] = "true";
            $_SESSION["user"] = $row;
        }
      }
    }
  }
  
}
else {
  http_response_code(401);
  echo json_encode($_POST);
}

?>