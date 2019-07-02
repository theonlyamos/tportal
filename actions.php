<?php
/**
 * Description
 * @authors Amos Amissah (amosamissah@outlook.com)
 * @date    2019-03-24 22:19:13
 * @version 1.0.0
 */

session_start();

require_once 'functions.php';

if (strtolower($_SERVER['REQUEST_METHOD']) == 'post'){
  $action = sanitizeString(strtolower($_POST['action']));

  if ($action == 'post'){
    $field = sanitizeString(strtolower($_POST['field']));
    if ($field == 'tournaments'){
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
      else {
        http_response_code(500);
        echo "Error posting tournament!";
      }
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
    $user = $_SESSION['user'];
    destroySession();
    setLog($user['role'], $user['id'], $user['email']." logged out", $user['country']);
    if ($user['role'] == 'admin'){
      header("Location: /admin/login.php");
    }
    else {
      header("Location: /login.html");
    }
  }
  else if ($action == 'getUsers' && $_SESSION['user']['role'] == 'admin') {
    $result = queryDB("SELECT fullname, email, profession, picture FROM users");
    echo json_encode($result->fetch_array(MYSQLI_ASSOC));
  }
  else if ($action == 'approve' && $_SESSION['user']['role'] == 'admin'){
    $target = sanitizeString($_GET['target']);
    $field = sanitizeString($_GET['field']);
    $done = FALSE;

    if ($field == 'users'){
      if (queryDB("UPDATE users SET approved = TRUE, rejected = FALSE WHERE id = '$target'")){
        $result = queryDB("SELECT fullname, email FROM users WHERE id = '$target'");
        if ($result->num_rows){
          $user = $result->fetch_array(MYSQLI_ASSOC);
          $email = $user['email'];
          $name = $user['fullname'];
        }
        $done = TRUE;
        setLog('admin', $target, $email.' has been approved.', 'admin');
      }
    }
    else if ($field == 'tournaments'){
      if (queryDB("UPDATE posts SET approved = TRUE, rejected = FALSE WHERE type = 'tournament' AND id = '$target'")){
        $result = queryDB("SELECT title, organizerEmail FROM posts WHERE id = '$target'");
        if ($result->num_rows){
          $tournament = $result->fetch_array(MYSQLI_ASSOC);
        }
        $done = TRUE;
        setLog('admin', $target, $tournament['title'].' has been approved.', 'tournament');
      }
    }
    else if ($field == 'organizations'){
      if (queryDB("UPDATE states SET approved = TRUE, rejected = FALSE WHERE id = '$target'")){
        $result = queryDB("SELECT name, email FROM states WHERE id = '$target'");
        if ($result->num_rows){
          $user = $result->fetch_array(MYSQLI_ASSOC);
          $email = $user['email'];
          $name = $user['name'];
        }
        $done = TRUE;
        setLog('admin', $target, $name.' has been approved.', 'organization');
      }
    }

    if ($done) {
      $subject ="Account Approval";
      $body = "<h3>Hi, <strong>".$name."</strong></h3><br><h3>Your account has been approved.<br><a href='http://tportal.epizy.com/login'>Login to register for tournaments.</a></h3>";
      
      sendPHPMail($email, $name, $subject, $body);
      http_response_code(201);
    }
  }
  else if ($action == 'reject' && $_SESSION['user']['role'] == 'admin'){
    $target = sanitizeString($_GET['target']);
    $field = sanitizeString($_GET['field']);
    $done = FALSE;

    if ($field == 'users'){
      if (queryDB("UPDATE users SET approved = FALSE, rejected = TRUE WHERE id = '$target'")){
        $result = queryDB("SELECT fullname, email FROM users WHERE id = '$target'");
        if ($result->num_rows){
          $user = $result->fetch_array(MYSQLI_ASSOC);
          $email = $user['email'];
          $name = $user['fullname'];
        }
        $done = TRUE;
        setLog('admin', $target, $email.' has been rejected.', 'admin');
      }
    }
    else if ($field == 'tournaments'){
      if (queryDB("UPDATE posts SET approved = FALSE, rejected = TRUE WHERE type = 'tournament' AND id = '$target'")){
        $result = queryDB("SELECT title, organizerEmail FROM posts WHERE id = '$target'");
        if ($result->num_rows){
          $user = $result->fetch_array(MYSQLI_ASSOC);
          $email = $user['organizerEmail'];
          $name = $user['title'];
        }
        $done = TRUE;
        setLog('admin', $target, $name.' has been reject.', 'tournament');
      }
    }
    else if ($field == 'organizations'){
      if (queryDB("UPDATE states SET approved = FALSE, rejected = TRUE WHERE id = '$target'")){
        $result = queryDB("SELECT name, email FROM states WHERE id = '$target'");
        if ($result->num_rows){
          $user = $result->fetch_array(MYSQLI_ASSOC);
          $email = $user['email'];
          $name = $user['name'];
        }
        $done = TRUE;
        setLog('admin', $target, $name.' has been rejected.', 'organization');
      }
    }

    if ($done) {
      $subject ="Account Approval";
      $body = "<h3>Hi, <strong>".$name."</strong></h3><br><h3>Your account has been rejected.<br><a href='http://tportal.epizy.com/login'>Login to learn why.</a></h3>";
      
      sendPHPMail($email, $name, $subject, $body);
      http_response_code(201);
    }
  }
  else if ($action == 'delete'){
    $field = sanitizeString($_GET['field']);
    $target = sanitizeString($_GET['target']);
    if ($field == 'sheets'){
      $query = "DELETE FROM sheets WHERE id='$target'";
      if (queryDB($query)){
        setLog("admin", $_SESSION['user']['id'], "deleted : ".$target, "admin");
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
        setLog("admin", $_SESSION['user']['id'], "deleted tournament: ".$target, "tournament");
        echo "ok";
      }
      else {
        setLog("admin", $_SESSION['user']['id'], "failed to delete tournament: ".$target, "tournament");
        http_response_code(400);
        echo "Deletion failed";
      }
    }
  }
  else if ($action == 'details'){
    $field = sanitizeString($_GET['field']);
    $target = sanitizeString($_GET['target']);
    $users = [];
    if ($field == 'tournaments'){
      $result = queryDB("SELECT * FROM posts WHERE id = '$target'");
      if ($result->num_rows){
        $tournament = $result->fetch_array(MYSQLI_ASSOC);
        setLog('admin', $_SESSION['user']['id'], "get tournament: ".$target, "tournament");
        $tournament['tentativeDates'] = unserialize($tournament['tentativeDates']);
        $tournament['arbiters'] = unserialize($tournament['arbiters']);
        $tournament['coaches'] = unserialize($tournament['coaches']);
        $country = $tournament['country'];
        $result = queryDB("SELECT id, fullname, profession FROM users WHERE (profession = 'arbiter' OR profession = 'coach') AND country='$country'");
        if ($result->num_rows){
          for ($j = 0; $j < $result->num_rows; ++$j){
            $result->data_seek($j);
            $user = $result->fetch_array(MYSQLI_ASSOC);
            $users[$user['id']] = $user;
          }
          $tournament['users'] = $users;
        }
        echo json_encode(array("success" => TRUE, "tournament" => $tournament));
      }
    }
  }
}


?>