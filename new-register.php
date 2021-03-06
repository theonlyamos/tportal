<?php

require_once 'functions.php';


if ($_POST){
  $name = sanitizeString($_POST['name']);
  $email = sanitizeString($_POST["email"]);
  $password = sanitizeString($_POST["password"]);
  $rpassword = sanitizeString($_POST["rpassword"]);
  $country = sanitizeString($_POST['country']);

  if ($rpassword != $password){
    http_response_code(403);
    echo "Passwords do not match";
  }
  else {
    $password = createHash($password, $email);
    $profession = sanitizeString($_POST['profession']);

    if ($profession == 'user'){
      $result = queryDB("SELECT email FROM users WHERE email = '$email'");
      if ($result->num_rows){
        http_response_code(401);
        echo "User already exists!";
      }
      else {
        if (queryDB("INSERT INTO users (id, email, password, fullname, country) VALUES (UUID(), '$email', '$password', '$name', '$country')")){
          $result = queryDB("SELECT id FROM users WHERE email = '$email'");
          $user = $result->fetch_array(MYSQLI_ASSOC);

          $mailBody = "<div><h3>Hi, <b>".$name."</b></h3><br>Click on the link below to complete your registration.<br><a href='http://tportal.epizy.com/account/verify.php?token=".$user["id"]."&pro=".$profession."s'>http://tportal.epizy.com/account/verify.php?token=".$user["id"]."&pro=".$profession."s</a></div>";

          sendMail("dummy@mysticmedia.in", "Tportal", $email, "Account Verification", $mailBody, $name);

          http_response_code(201);
          echo 'Registration Successful.';
        }
        else {
          http_response_code(400);
          echo "Registration failed! Try again later";
        }
      }
    }
    else if ($profession == 'state'){
      $result = queryDB("SELECT email FROM states WHERE email = '$email'");
      if ($result->num_rows){
        http_response_code(401);
        echo "User already exists!";
      }
      else {
        if (queryDB("INSERT INTO states (id, email, password, name, country) VALUES (UUID(), '$email', '$password', '$name', '$country')")){
          $result = queryDB("SELECT id FROM states WHERE email = '$email'");
          $user = $result->fetch_array(MYSQLI_ASSOC);

          $mailBody = "<div>Click on the link below to complete your registration.<br><a href='http://tportal.epizy.com/account/verify.php?token=".$user["id"]."&pro=".$profession."s'>http://tportal.epizy.com/account/verify.php?token=".$user["id"]."&pro=".$profession."s</a></div>";

          sendMail("dummy@mysticmedia.in", "Tportal", $email, "Account Verification", $mailBody, $name);


          http_response_code(201);
          echo 'Registration Successful.';
        }
        else {
          http_response_code(400);
          echo "Registration failed! Try again later";
        }
      }
    }
    else echo 'Who are you?';
  }
}
