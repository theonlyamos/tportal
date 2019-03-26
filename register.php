<?php

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
      $name = sanitizeString($_POST["name"]);
      $organization = sanitizeString($_POST["organization"]);
      $contact = sanitizeString($_POST["contact"]);
      $phone = sanitizeString($_POST["phone"]);
      $password = sanitizeString($_POST["password"]);
      $website = sanitizeString($_POST["website"]);
      $organizer = sanitizeString($_POST["organizer"]);
      $regNo = sanitizeString($_POST["regNo"]);
      $pan = sanitizeString($_POST["pan"]);
      $objectives = sanitizeString($_POST["objectives"]);
      $contactPerson = sanitizeString($_POST["contactPerson"]);
      $contactPhone = sanitizeString($_POST["contactPhone"]);
      $contactUrl = sanitizeString($_POST["contactUrl"]);

      $filename = $_FILES['image']['name'];
      $image = $email.$filename;

      move_uploaded_file($_FILES['image']['tmp_name'], 'assets/data/profiles/'.$image);

      $query = "INSERT INTO states (email, password, name, organization, contact, phone,
      website, organizer, regNo, pan, objectives, contactPerson, contactPhone, contactUrl, image) VALUES (
      '$email', '$password', '$name', '$organization', '$contact', '$phone', '$website', '$organizer', '$regNo', 
      '$pan', '$objectives', '$contactPerson', '$contactPhone', '$contactUrl', '$image')";

      if (queryDB($query)) {
        $user = queryDB("SELECT * FROM states WHERE email='$email' AND  password='$password'");
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
      $address = sanitizeString($_POST["address"]);
      $district = sanitizeString($_POST["district"]);
      $city = sanitizeString($_POST["city"]);
      $state = sanitizeString($_POST["state"]);
      $country = sanitizeString($_POST["country"]);
      $adhar = sanitizeString($_POST["adhar"]);
      $pan = sanitizeString($_POST["pan"]);
      $communication = serialize($_POST["communication"]);

      $filename = $_FILES['pic']['name'];
      $picture = $email.$filename;
      move_uploaded_file($_FILES['pic']['tmp_name'], "assets/data/profiles/$picture");
      
      if ($profession == "player"){
        //$blindness = sanitizeString($_POST["blindness"]);
        $national = sanitizeString($_POST["national"]);
        $fideid = sanitizeString($_POST["fideid"]);
        $fiderating = sanitizeString($_POST["fiderating"]);
        $aicfbid = sanitizeString($_POST["aicfbid"]);

        $query = "INSERT INTO users (email, password, username, fullname, profession, address, dob, picture, 
        gender, city, phone, state, district, adhar, pan, communication, country, postal, fideid, fiderating, aicfbid, national) 
        VALUES('$email', '$password', '$username', '$fullname', '$profession', '$address', '$dob', '$picture', '$gender', '$city', '$phone', 
        '$state', '$district', '$adhar', '$pan', '$communication', '$country', '$postal', '$fideid', '$fiderating', '$aicfbid', '$national')";

        if (queryDB($query)) {
          $user = queryDB("SELECT * FROM users WHERE email='$email' AND  password='$password'");
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
        else {
          http_response_code(500);
          echo "There was an error during the operation. Try again later!";
        }
      }
      else if ($profession == "arbiter"){
        $trainertitle = sanitizeString($_POST["trainertitle"]);
        $experience = sanitizeString($_POST["experience"]);
        $address = sanitizeString($_POST["address"]);

        $query = "INSERT INTO users (email, password, username, fullname, profession, trainertitle, dob, picture,
        gender, city, phone, state, district, adhar, pan, experience, address, postal, communication, country) 
        VALUES('$email', '$password', '$username', '$fullname', '$profession', '$trainertitle', '$dob', '$picture', '$gender', '$city', 
        '$phone', '$state', '$district', '$adhar', '$pan', '$experience', '$address', '$postal', '$communication', '$country')";

        if (queryDB($query)) {
          $user = queryDB("SELECT * FROM users WHERE email='$email' AND  password='$password'");
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
        else {
          http_response_code(500);
          echo "There was an error during the operation. Try again later!";
        }
      }
      else if ($profession == "coach"){
        $experience = sanitizeString($_POST["experience"]);

        $query = "INSERT INTO users (email, password, username, fullname, profession, dob, picture,
        gender, city, phone, state, district, adhar, pan, experience, address, postal, communication, country) 
        VALUES('$email', '$password', '$username', '$fullname', '$profession', '$dob', '$picture', '$gender', '$city', '$phone', 
        '$state', '$district', '$adhar', '$pan', '$experience', '$address', '$postal', '$communication', '$country')";

        if (queryDB($query)) {
          $user = queryDB("SELECT * FROM users WHERE email='$email' AND  password='$password'");
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
        else {
          http_response_code(500);
          echo "There was an error during the operation. Try again later!";
        }
      }
    }
  }
}

?>