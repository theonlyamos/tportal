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
      $result = queryDB("SELECT * FROM users WHERE email='$email'");
      
      if ($result->num_rows == 0) {
        setLog('user', "", $email." invalid authentication", "user");
        http_response_code(402);
        echo "User with email: $email does not exist";
      }
      else {
        $user = $result->fetch_array(MYSQLI_ASSOC);
        if ($pass != $user['password']) {
          setLog('user', $user['id'], $user['email']." invalid authentication", $user['country']);
          http_response_code(402);
          echo "Wrong email/password. Try again!";
        }else{
          if (!$user['verified']){
            setLog('user', $user['id'], $user['email']." logged in", $user['country']);
            http_response_code(403);
            echo "Click on the link in the email we sent you to verify your account!";
          }
          else if (!$user['completed']){
            setLog('user', $user['id'], $user['email']." logged in", $user['country']);
            session_start();
            $_SESSION["loggedIn"] = "true";
            $_SESSION["user"] = $user;
            echo json_encode(array('profession'=>'user','completed'=>false));
          }
          else{
            setLog('user', $user['id'], $user['email']." logged in", $user['country']);
            session_start();
            $_SESSION["loggedIn"] = "true";
            $_SESSION["user"] = $user;
            echo json_encode(array('profession'=>'user','completed'=>true));
          }
        }
      }
    }
    else {
      $result = queryDB("SELECT email FROM states WHERE email='$email'");
      
      if ($result->num_rows == 0) {
        setLog('organization', "", $email." invalid authentication", "user");
        http_response_code(402);
        echo "User with email: $email does not exists";
      }
      else {
        $result = queryDB("SELECT * FROM states WHERE email='$email' AND  password='$pass'");
        if ($result->num_rows == 0) {
          setLog('organization', "", $email." invalid authentication", "");
          http_response_code(402);
          echo "Wrong email/password. Try again!";
        }else{
          $user = $result->fetch_array(MYSQLI_ASSOC);
          if (!$user['verified']){
            setLog('organization', $user['id'], $user['email']." logged in", $user['country']);
            http_response_code(403);
            echo "Click on the link in the email we sent you to verify your account!";
          }
          else if (!$user['completed']){
            setLog('organization', $user['id'], $user['email']." logged in", $user['country']);
            session_start();
            $_SESSION["loggedIn"] = "true";
            $_SESSION["user"] = $user;
            echo json_encode(array('profession'=>'state','completed'=>false));
          }
          else{
            setLog('organization', $user['id'], $user['email']." logged in", $user['country']);
            session_start();
            $_SESSION["loggedIn"] = "true";
            $_SESSION["user"] = $user;
            echo json_encode(array('profession'=>'state','completed'=>true));
          }
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