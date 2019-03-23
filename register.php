<?php

require_once 'functions.php';

if (isset($_POST["profession"])){
  $email = sanitizeString($_POST["email"]);
  $profession = sanitizeString($_POST["profession"]);

  $result = queryDB("SELECT email FROM users WHERE email='$email'");
  if ($result->num_rows >= 1) {
    http_response_code(402);
    echo "User with ".$email."already exists!";
  }
  else {
    $fullname = sanitizeString($_POST["fullname"]);
    $username = sanitizeString($_POST["username"]);
    $password = sanitizeString($_POST["password"]);
    $password = createHash($password, $email);
    $dob = $_POST["dob"];
    $gender = sanitizeString($_POST["gender"]);
    $cell = sanitizeString($_POST["cell"]);
    $phone = sanitizeString($_POST["phone"]);
    $state = sanitizeString($_POST["state"]);
    $district = sanitizeString($_POST["district"]);
    $adhar = sanitizeString($_POST["adhar"]);
    $pan = sanitizeString($_POST["pan"]);
    
    if ($profession == "player"){
      $blindness = sanitizeString($_POST["blindness"]);
      $communication = sanitizeString($_POST["communication"]);
      $city = sanitizeString($_POST["city"]);
      $postal = sanitizeString($_POST["postal"]);
      $fideid = sanitizeString($_POST["fideid"]);
      $fiderating = sanitizeString($_POST["fiderating"]);
      $aicfbid = sanitizeString($_POST["aicfbid"]);

      $query = "INSERT INTO users (email, password, username, fullname, profession, blindness, dob, 
      gender, cell, phone, state, district, adhar, pan, communication, city, postal, fideid, fiderating, aicfbid) 
      VALUES('$email', '$password', '$username', '$fullname', '$profession', '$blindness', '$dob', '$gender', '$cell', '$phone', 
      '$state', '$district', '$adhar', '$pan', '$communication', '$city', '$postal', '$fideid', '$fiderating', '$aicfbid')";

      if (queryDB($query)) {
        echo "Registration Completed";
      }
      else {
        http_response_code(500);
        echo "There was an error during the operation. Try again later!";
      }
    }
    else if ($profession == "arbiter"){

    }
    else if ($profession == "coach"){

    }
  }
}

?>