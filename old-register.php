<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

require_once 'functions.php';

if (isset($_POST["profession"])){
  if ($_POST['role'] == 'admin' && $_POST['profession'] == 'state'){
    $email = sanitizeString($_POST["email"]);

    $result = queryDB("SELECT email FROM states WHERE email='$email'");
    if ($result->num_rows >= 1) {
      http_response_code(402);
      echo $email."already exists!";
    }
    else {
      $country = sanitizeString($_POST["country"]);
      $name = sanitizeString($_POST["name"]);
      $contact = sanitizeString($_POST["contact"]);
      $phone = sanitizeString($_POST["phone"]);
      $password = sanitizeString($_POST["password"]);
      $password = createHash($pass, $email);
      $website = sanitizeString($_POST["website"]);
      $organizer = sanitizeString($_POST["organizer"]);
      $regNo = sanitizeString($_POST["regNo"]);
      $pan = sanitizeString($_POST["pan"]);
      $objectives = sanitizeString($_POST["objectives"]);
      $contactPerson = sanitizeString($_POST["contactPerson"]);
      $contactPhone = sanitizeString($_POST["contactPhone"]);

      $filename = $_FILES['image']['name'];
      $document = $email.$filename;

      move_uploaded_file($_FILES['image']['tmp_name'], 'assets/data/documents/'.$document);

      $query = "INSERT INTO states (id, email, password, country, name, contact, phone,
      website, organizer, regNo, pan, objectives, contactPerson, contactPhone, contactUrl, document) VALUES (UUID(),
      '$email', '$password', '$country', '$organization', '$contact', '$phone', '$website', '$organizer', '$regNo', 
      '$pan', '$objectives', '$contactPerson', '$contactPhone', '$document')";

      if (queryDB($query)) {
        $user = queryDB("SELECT * FROM states WHERE organization='$organization' AND  password='$password'");
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
      else {
        http_response_code(500);
        echo "There was an error during the operation. Try again later!";
      }
    }
  }
  else{
    $email = sanitizeString($_POST["email"]);
    $profession = sanitizeString($_POST["profession"]);

    $result = queryDB("SELECT email FROM users WHERE email='$email'");
    if ($result->num_rows >= 1) {
      http_response_code(402);
      echo $email."already exists!";
    }
    else {
      $fullname = sanitizeString($_POST["fullname"]);
      $username = sanitizeString($_POST["username"]);
      $password = sanitizeString($_POST["password"]);
      $password = createHash($password, $email);
      $dob = $_POST["dob"];
      $gender = sanitizeString($_POST["gender"]);
      $phone = sanitizeString($_POST["phone"]);
      $city = sanitizeString($_POST["city"]);
      $state = sanitizeString($_POST["state"]);
      $country = sanitizeString($_POST["country"]);
      $adhar = sanitizeString($_POST["adhar"]);
      $pan = sanitizeString($_POST["pan"]);
      
      $picture = NULL;
      if ($_FILES['picture']){
        $filename = $_FILES['picture']['name'];
        $picture = $email.$filename;
        move_uploaded_file($_FILES['medcert']['tmp_name'], "assets/data/medical/$picture");
      }
    
      
      if ($profession == "player"){
        $blindness = sanitizeString($_POST["blindness"]);
        $rating = sanitizeString($_POST["rating"]);
        $fideid = sanitizeString($_POST["fideid"]);
        $fiderating = sanitizeString($_POST["fiderating"]);
        $communication = serialize($_POST["communication"]);

        $medcert = NULL;
        if ($_FILES['medcert']){
          $filename = $_FILES['medcert']['name'];
          $medcert = $email.$filename;
          move_uploaded_file($_FILES['medcert']['tmp_name'], "assets/data/medical/$medcert");
        }

        $query = "INSERT INTO users (id, email, password, username, fullname, profession, dob, medcert, picture,
        gender, city, phone, state, country, adhar, pan, communication, postal, fideid, fiderating, rating, blindness) 
        VALUES(UUID(),'$email', '$password', '$username', '$fullname', '$profession', '$dob', '$medcert', '$picture', '$gender', '$city',
        '$phone', '$state', '$country', '$adhar', '$pan', '$communication', '$postal', '$fideid', '$fiderating', '$rating', '$blindness')";

        if (queryDB($query)) {
          $result = queryDB("SELECT id FROM users WHERE email = '$email'");
          $user = $result->fetch_array(MYSQLI_ASSOC);

          $mail = new PHPMailer(TRUE);
          $mail->setFrom("dummy@mysticmedia.in", "Tportal");
          $mail->addAddress($email, $fullname);
          $mail->Subject ="Account Verification";
          $mail->isHTML(TRUE);
          $mail->Body = "<div>Click on the link below to complete your registration.<br><a href='http://tportal.epizy.com/account/verify.php?token=".$user["id"]."'>http://tportal.epizy.com/account/verify.php?token=".$user["id"]."</a></div>";
          $mail->isSMTP();
          $mail->Host = "smtp.zoho.com";
          $mail->SMTPAuth = TRUE;
          $mail->Username = "dummy@mysticmedia.in";
          $mail->Password = "Dummymystic04#";
          $mail->Port = 587;
          $mail->send();

          http_response_code(201);
          echo 'Registration Successful.';
        }
        else {
          http_response_code(500);
          echo "There was an error during the operation. Try again later!";
        }
      }
      else if ($profession == "arbiter"){
        $address = sanitizeString($_POST["address"]);
        $experience = sanitizeString($_POST["experience"]);
        $type = sanitizeString($_POST["type"]);

        $query = "INSERT INTO users (id, email, password, username, fullname, profession, dob, 
        gender, phone, city, state, country, adhar, pan, experience, address, type) 
        VALUES(UUID(), '$email', '$password', '$username', '$fullname', '$profession', '$dob', '$gender', 
        '$phone', '$city', '$state', '$country', '$adhar', '$pan', '$experience', '$address', '$type')";

        if (queryDB($query)) {
          $result = queryDB("SELECT id FROM users WHERE email = '$email'");
          $user = $result->fetch_array(MYSQLI_ASSOC);

          $mail = new PHPMailer(TRUE);
          $mail->setFrom("dummy@mysticmedia.in", "Tportal");
          $mail->addAddress($email, $fullname);
          $mail->Subject ="Account Verification";
          $mail->isHTML(TRUE);
          $mail->Body = "<div>Click on the link below to complete your registration.<br><a href='http://tportal.epizy.com/account/verify.php?token=".$user["id"]."'>http://tportal.epizy.com/account/verify.php?token=".$user["id"]."</a></div>";
          $mail->isSMTP();
          $mail->Host = "smtp.zoho.com";
          $mail->SMTPAuth = TRUE;
          $mail->Username = "dummy@mysticmedia.in";
          $mail->Password = "Dummymystic04#";
          $mail->Port = 587;
          $mail->send();

          http_response_code(201);
          echo 'Registration Successful.';
        }
        else {
          http_response_code(500);
          echo "There was an error during the operation. Try again later!";
        }
      }
      else if ($profession == "coach"){
        $experience = sanitizeString($_POST["experience"]);
        $address = sanitizeString($_POST["address"]);
        $trainertitle = sanitizeString($_POST["trainertitle"]);


        $query = "INSERT INTO users (id, email, password, username, fullname, profession, dob, picture,
        gender, city, phone, state, adhar, pan, experience, postal, communication, country, address) 
        VALUES(UUID(), '$email', '$password', '$username', '$fullname', '$profession', '$dob', '$picture', '$gender', '$city', 
        '$phone', '$state', '$adhar', '$pan', '$experience', '$postal', '$communication', '$country', '$address')";

        if (queryDB($query)) {
          $result = queryDB("SELECT id FROM users WHERE email = '$email'");
          $user = $result->fetch_array(MYSQLI_ASSOC);

          $mail = new PHPMailer(TRUE);
          $mail->setFrom("dummy@mysticmedia.in", "Tportal");
          $mail->addAddress($email, $fullname);
          $mail->Subject ="Account Verification";
          $mail->isHTML(TRUE);
          $mail->Body = "<div>Click on the link below to complete your registration.<br><a href='http://tportal.epizy.com/account/verify.php?token=".$user["id"]."'>http://tportal.epizy.com/account/verify.php?token=".$user["id"]."</a></div>";
          $mail->isSMTP();
          $mail->Host = "smtp.zoho.com";
          $mail->SMTPAuth = TRUE;
          $mail->Username = "dummy@mysticmedia.in";
          $mail->Password = "Dummymystic04#";
          $mail->Port = 587;
          $mail->send();

          http_response_code(201);
          echo 'Registration Successful.';
        }
        else {
          http_response_code(500);
          echo "There was an error during the operation. Try again later!";
        }
      }
    }
  }
}

?>