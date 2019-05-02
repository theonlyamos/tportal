<?php
/**
 * Description
 * @authors Amos Amissah (amosamissah@outlook.com)
 * @date    2019-03-24 22:19:13
 * @version 1.0.0
 */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

require_once 'functions.php';
session_start();

if (strtolower($_SERVER['REQUEST_METHOD']) == 'post'){
  $action = sanitizeString(strtolower($_POST['action']));

  if ($action == 'tournament'){
    $type = sanitizeString($_POST['tournament']);
    $title = sanitizeString($_POST['title']);
    $description = sanitizeString($_POST['description']);
    $address = sanitizeString($_POST['address']);
    $city = sanitizeString($_POST['city']);
    $venue = sanitizeString($_POST['venue']);
    $startDates = sanitizeString($_POST['startDates']);
    $endDates = sanitizeString($_POST['endDates']);
    $price = sanitizeString($_POST['price']);
    $contactName = sanitizeString($_POST['contactName']);
    $contactPhone = sanitizeString($_POST['contactPhone']);
    $contactEmail = sanitizeString($_POST['contactEmail']);
    $organizerName = sanitizeString($_POST['organizerName']);
    $organizerPhone = sanitizeString($_POST['organizerPhone']);
    $organizerEmail = sanitizeString($_POST['organizerEmail']);
    $userid = $_SESSION['user']['username'];
    $userpro = $_SESSION['user']['profession'];

    $filename = $_FILES['image']['name'];
    $image = $email.$filename;

    move_uploaded_file($_FILES['image']['tmp_name'], 'assets/data/profiles'.$image);

    $query = "INSERT INTO posts (type, title, description, address, city, venue, startDates, endDates, price, 
    contactName, contactPhone, contactEmail, organizerName, organizerPhone, organizerEmail, userid, userpro, image) VALUES (
    '$type', '$title', '$description', '$address', '$city', '$venue', '$startDates', '$endDates', '$price', '$contactName',
    '$contactPhone', '$contactEmail', '$organizerName', '$organizerPhone', '$organizerEmail', '$userid', '$userpro', '$image')";

    if (queryDB($query)){
      echo "Tournament posted successfully.";
    }
    else if ($action == 'post'){
      $type = sanitizeString($_POST['post']);
      $userid = $_SESSION['user']['username'];
      $userpro = $_SESSION['user']['profession'];
      $message = sanitizeString($_POST['message']);
      
      $filename = $_FILES['image']['name'];
      $image = $userid.'_'.$filename;

      if (queryDB("INSERT INTO posts (type, userid, message, image, userpro) VALUES ('$type', '$userid', '$message', '$image', '$userpro')")){
        echo "Post created successfully.";
      }
      else {
        http_response_code(500);
        echo "Error creating post!";
      }
    }
    else {
      http_response_code(500);
      echo "Error posting tournament!";
    }
  }
  else if ($action == 'ticket'){
    $userid = $_SESSION['user']['username'];
    $email = sanitizeString($_POST['email']);
    $query = sanitizeString($_POST['query']);

    if (queryDB("INSERT INTO tickets (userid, email, query) VALUES ('$userid', '$email', '$query')")){
      echo "Ticket created successfully.";
    }
    else {
      http_response_code(500);
      echo "Error submitting feedback!";
    }
  }
  else if ($action == 'feedback'){
    $userid = $_SESSION['user']['email'];
    $email = sanitizeString($_POST['email']);
    $message = sanitizeString($_POST['message']);

    if (queryDB("INSERT INTO feedbacks (userid, email, message) VALUES ('$userid', '$email', '$message')")){
      echo "Feedback submitted successfully.";
    }
    else {
      http_response_code(500);
      echo "Error submitting feedback!";
    }
  }
  else if ($action == 'bulk'){
    if ($_SESSION['loggedIn'] && $_SESSION['user']['role'] == "admin"){
      $type = sanitizeString($_POST['name']);
      if ($_FILES){
        $filename = $_FILES['bulkFile']['name'];
        $fullpath = date(DATE_ISO8601)."_".$filename;
        $userid = $_SESSION['user']['id'];
        // $ext = pathinfo($_FILES["bulkFile"]["name"])['extension'];

        if (move_uploaded_file($_FILES['bulkFile']['tmp_name'], 'assets/data/bulkuploads/'.$type."/".$fullpath)){
          $query = "INSERT INTO bulk_uploads (id, name, type, userid) VALUES (UUID(), '$fullpath', '$type', '$userid')";
          queryDB($query);
          echo "Upload successful";
        }
        else {
          http_response_code(400);
          echo "Upload unsuccessful";
        }
      }
    }
  }
  else if ($action == 'donation'){

  }
  else if ($action == 'sheet'){
    if ($_SESSION['loggedIn'] && $_SESSION['user']['role'] == "admin"){

      $type = sanitizeString($_POST['name']);
      $particular = sanitizeString($_POST['particular']);
      $amount = sanitizeString($_POST['amount']);
      $pan = sanitizeString($_POST['pan']);
      $userid = $_SESSION['user']['id'];

      $query = "INSERT INTO sheets (id, type, particular, amount, pan, userid) VALUES (
        UUID(), '$type', '$particular', '$amount', '$pan', '$userid')";
      if (queryDB($query)){
        $result = queryDB("SELECT * FROM sheets WHERE particular='$particular'");
        if ($result->num_rows){
          echo json_encode($result->fetch_array(MYSQLI_ASSOC));
        }
      }
      else {
        http_response_code(500);
        echo "Sheet wasn't added!";
      }
    }
  }
  else if ($action == 'edit'){
    if ($_SESSION['loggedIn'] && $_SESSION['user']['role'] == "admin"){
      $field = sanitizeString($_POST['field']);
      if ($field == 'sheets'){
        $type = sanitizeString($_POST['name']);
        $target = sanitizeString($_POST['target']);
        $particular = sanitizeString($_POST['particular']);
        $amount = sanitizeString($_POST['amount']);
        $pan = sanitizeString($_POST['pan']);

        $query = "UPDATE sheets SET particular='$particular', amount='$amount', pan='$pan' WHERE id='$target'";
        if (queryDB($query)){
          $result = queryDB("SELECT * FROM sheets WHERE id='$target'");
          if ($result->num_rows){
            echo json_encode($result->fetch_array(MYSQLI_ASSOC));
          }
          else {
            http_response_code(500);
            echo "Couldn't get sheet!";
          }
        }
        else {
          http_response_code(500);
          echo "Update unsuccessful";
        }
      }
    }
  }
}
else {
  $action = $_GET['name'];
  if ($action == 'logout') {
    destroySession();
    header("Location: /login.html");
  }
  else if ($action == 'getUsers' && $_SESSION['user']['role'] == 'admin') {
    $result = queryDB("SELECT fullname, email, profession, picture FROM users");
    echo json_encode($result->fetch_array(MYSQLI_ASSOC));
  }
  else if ($action == 'approve' && $_SESSION['user']['role'] == 'admin'){
    $uid = sanitizeString($_GET['target']);
    $field = sanitizeString($_GET['field']);
    $done = FALSE;

    if ($field == 'users'){
      if (queryDB("UPDATE users SET approved = TRUE WHERE id = '$uid'")){
        $result = queryDB("SELECT fullname, email FROM users WHERE id = '$uid'");
        if ($result->num_rows){
          $user = $result->fetch_array(MYSQLI_ASSOC);
          $email = $user['email'];
          $name = $user['fullname'];
        }
        $done = TRUE;
        setLog('admin', $uid, $email.' has been approved.', 'admin');
      }
    }
    else if ($field == 'tournaments'){
      if (queryDB("UPDATE posts SET approved = TRUE WHERE type = 'tournament' AND id = '$uid'")){
        $result = queryDB("SELECT title, organizerEmail FROM posts WHERE id = '$uid'");
        if ($result->num_rows){
          $user = $result->fetch_array(MYSQLI_ASSOC);
          $email = $user['organizerEmail'];
          $name = $user['title'];
        }
        $done = TRUE;
        setLog('admin', $uid, $name.' has been approved.', 'tournament');
      }
    }
    else if ($field == 'organizations'){
      if (queryDB("UPDATE states SET approved = TRUE WHERE id = '$uid'")){
        $result = queryDB("SELECT name, email FROM states WHERE id = '$uid'");
        if ($result->num_rows){
          $user = $result->fetch_array(MYSQLI_ASSOC);
          $email = $user['email'];
          $name = $user['name'];
        }
        $done = TRUE;
        setLog('admin', $uid, $name.' has been approved.', 'organization');
      }
    }

    if ($done) {
      echo "ok";

      $mail = new PHPMailer(TRUE);
      try {
        $mail->setFrom('donotreply@barthwal.com', "Tportal");
        $mail->addAddress($email, $name);
        $mail->isHTML(TRUE);
        if ($field == 'users' || $field == 'organizations'){
          $mail->Subject ="Account Approval";
          $mail->Body = "<h3>Hi, <b>".$name."</b></h3><br><h3>Your account has been approved.<br><a href='http://tportal.epizy.com/login'>Login to register for tournaments.</a></h3>";
        }
        else if ($field == 'tournaments'){
          $mail->Subject ="Tournament Approval";
          $mail->Body = "<h3>Your tournament <b>".$name."</b> has been approved.</h3>";
        }
        $mail->isSMTP();
        $mail->Host = "mail.barthwal.com";
        $mail->SMTPAuth = TRUE;
        $mail->Username = "donotreply@barthwal.com";
        $mail->Password = 'gZV$PL(J$rxW';
        $mail->Port = 587;
        $mail->send();
      }
      catch (Exception $e) {
        http_response_code(400);
        echo $e-> errorMessage();
      }
      catch (\Exception $e){
        http_response_code(400);
          echo $e->getMessage();
      }

      http_response_code(201);
    }
  }
  else if ($action == 'delete'){
    $field = sanitizeString($_GET['field']);
    $target = sanitizeString($_GET['target']);
    if ($field == 'sheets'){
      $query = "DELETE FROM sheets WHERE id='$target'";
      if (queryDB($query)){
        setLog("admin", $_SESSION['user']['id'], "deleted sheet: ".$target, "admin");
        echo json_encode("ok");
      }
      
      else {
        setLog("admin", $_SESSION['user']['id'], "failed to delete sheet: ".$target, "admin");
        http_response_code(400);
        echo "Deletion failed!";
      }
    }
    else if ($field == 'tournaments'){
      if (queryDB("DELETE FROM posts WHERE id = '$target'")){
        setLog("admin", $_SESSION['user']['id'], "deleted sheet: ".$target, "tournament");
        echo "ok";
      }
      else {
        setLog("admin", $_SESSION['user']['id'], "failed to delete sheet: ".$target, "tournament");
        http_response_code(400);
        echo "Deletion failed";
      }
    }
  }
  else if ($action == 'details'){
    $field = sanitizeString($_GET['field']);
    $target = sanitizeString($_GET['target']);

    if ($field == 'tournaments'){
      $result = queryDB("SELECT * FROM posts WHERE id = '$target' AND approved = TRUE");
      if ($result->num_rows){
        $tournament = $result->fetch_array(MYSQLI_ASSOC);
        setLog('admin', $_SESSION['user']['id'], "get tournament: ".$target, "tournament");
        $tournament['tentativeDates'] = unserialize($tournament['tentativeDates']);
        echo json_encode(array("success" => TRUE, "tournament" => $tournament));
      }
    }
  }
}


?>