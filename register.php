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

          $subject = "Email Verification";
          $body = "<div><h3>Hi, <b>".$name."</b></h3><br>Click on the link below to complete your registration.<br><a href='http://tportal.epizy.com/account/verify.php?token=".$user["id"]."&pro=".$profession."s'>http://tportal.epizy.com/account/verify.php?token=".$user["id"]."&pro=".$profession."s</a></div>";
          
          sendPHPMail($email, $name, $subject, $body); 
          setLog('user', $user['id'], 'new user registration', $country);

          http_response_code(201);
          echo 'Registration Successful.';
        }
        else {
          http_response_code(500);
          echo "Registration failed! Try again later";
        }
      }
    }
    else if ($profession == 'state'){
      $result = queryDB("SELECT email FROM states WHERE email = '$email'");
      if ($result->num_rows){
        http_response_code(401);
        echo "Organization already exists!";
      }
      else {
        if (queryDB("INSERT INTO states (id, email, password, name, country) VALUES (UUID(), '$email', '$password', '$name', '$country')")){
          $result = queryDB("SELECT id FROM states WHERE email = '$email'");
          $user = $result->fetch_array(MYSQLI_ASSOC);

          $subject = "Account Verification";
          $body = "<div><h3>$name</h3><br>Click on the link below to complete your registration.<br><a href='http://tportal.epizy.com/account/verify.php?token=".$user["id"]."&pro=".$profession."s'>http://tportal.epizy.com/account/verify.php?token=".$user["id"]."&pro=".$profession."s</a></div>";

          setLog('organization', $user['id'], 'new organization registration', $country);

          http_response_code(201);
          echo 'Registration Successful.';
        }
        else {
          http_response_code(500);
          echo "Registration failed! Try again later";
        }
      }
    }
    else if ($profession == 'academy'){
      $result = queryDB("SELECT email FROM academies WHERE email = '$email'");
      if ($result->num_rows){
        http_response_code(401);
        echo "Academy already exists!";
      }
      else {
        if (queryDB("INSERT INTO academies (id, email, password, name, country) VALUES (UUID(), '$email', '$password', '$name', '$country')")){
          $result = queryDB("SELECT id FROM states WHERE email = '$email'");
          $user = $result->fetch_array(MYSQLI_ASSOC);

          $subject = "Account Verification";
          $body = "<div><h3>$name</h3><br>Click on the link below to complete your registration.<br><a href='http://tportal.epizy.com/account/verify.php?token=".$user["id"]."&pro=".$profession."s'>http://tportal.epizy.com/account/verify.php?token=".$user["id"]."&pro=".$profession."s</a></div>";

          setLog('academy', $user['id'], 'new academy registration', $country);

          http_response_code(201);
          echo 'Registration Successful.';
        }
        else {
          http_response_code(500);
          echo "Registration failed! Try again later";
        }
      }
    }
    else echo 'Who are you?';
  }
}
