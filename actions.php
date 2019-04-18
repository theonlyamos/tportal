<?php
/**
 * Description
 * @authors Amos Amissah (amosamissah@outlook.com)
 * @date    2019-03-24 22:19:13
 * @version 1.0.0
 */
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
  else if ($action = 'edit'){
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
          $result = queryDB("SELECT * FROM sheets WHERE id=LAST_INSERT_ID()");
          if ($result->num_rows){
            echo json_encode($result->fetch_array(MYSQLI_ASSOC));
          }
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
  else if ($action == 'approve'){
    $uid = sanitizeString($_GET['target']);
    $field = sanitizeString($_GET['field']);

    if ($field == 'users'){
      if (queryDB("UPDATE users SET approved = TRUE WHERE id = '$uid'")){
        echo "ok";
      }
    }
    else if ($field == 'tournaments'){
      if (queryDB("UPDATE posts SET approved = TRUE WHERE type = 'tournament' AND id = '$uid'")){
        echo "ok";
      }
    }
    else if ($field == 'organizations'){
      if (queryDB("UPDATE states SET approved = TRUE WHERE id = '$uid'")){
        echo "ok";
      }
    }
  }
  else if ($action == 'delete'){
    $field = sanitizeString($_GET['field']);
    if ($field == 'sheets'){
      $target = sanitizeString($_GET['target']);
      $query = "DELETE FROM sheets WHERE id='$target'";
      if (queryDB($query)){
        echo json_encode($_GET);
      }
      else echo "Deletion failed!";
    }
  }
}


?>