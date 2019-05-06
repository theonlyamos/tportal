<?php

session_start();

require_once 'functions.php';

if (strtolower($_SERVER['REQUEST_METHOD']) == 'post' && $_SESSION['user']['role'] == 'state'){
  $action = sanitizeString($_POST['action']);
  $field = sanitizeString($_POST['field']);
  $uid = $_SESSION['id'];
  
  if ($action == 'edit') {
    $field = sanitizeString($_POST['field']);
    $value = sanitizeString($_POST['value']);

    if (queryDB("UPDATE states SET $field = '$value' WHERE id='$uid'")){
      http_response_code(201);
      echo "Change successfully made.";
    }
    else {
      http_response_code(500);
      echo "Change not made.";
    }
  }
  
  else if ($field == 'tournaments'){
    $action = sanitizeString($_POST['action']);

    if ($action == 'post') {
      $type = sanitizeString($_POST['field']);
      $title = sanitizeString($_POST['title']);
      $author = sanitizeString($_POST['author']);
      $description = sanitizeString($_POST['description']);
      $address = sanitizeString($_POST['address']);
      $city = sanitizeString($_POST['city']);
      $country = sanitizeString($_POST['country']);
      $venue = sanitizeString($_POST['venue']);
      $tentativeDates = serialize($_POST['tentativeDates']);
      $price = sanitizeString($_POST['price']);
      $contactName = sanitizeString($_POST['contactName']);
      $contactPhone = sanitizeString($_POST['contactPhone']);
      $contactEmail = sanitizeString($_POST['contactEmail']);
      $organizerName = sanitizeString($_POST['organizerName']);
      $organizerPhone = sanitizeString($_POST['organizerPhone']);
      $organizerEmail = sanitizeString($_POST['organizerEmail']);
      $userid = $_SESSION['user']['id'];
      $user_role = $_SESSION['user']['profession'];

      $image = NULL;
      if ($_FILES){
        $filename = $_FILES['image']['name'];
        $image = $email.$filename;

        move_uploaded_file($_FILES['image']['tmp_name'], 'assets/data/tournaments/'.$image);
      }

      $query = "INSERT INTO posts (id, type, title, author, description, address, city, country, venue, tentativeDates, price, country,
      contactName, contactPhone, contactEmail, organizerName, organizerPhone, organizerEmail, userid, user_role, image) VALUES (
      UUID(), '$type', '$title', '$author', '$description', '$address', '$city', '$country', '$venue', '$tentativeDates', '$price', '$country', '$contactName',
      '$contactPhone', '$contactEmail', '$organizerName', '$organizerPhone', '$organizerEmail', '$userid', '$user_role', '$image')";

      if (queryDB($query)){
        setLog('organization', $_SESSION['user']['id'], "posted tournament: $title", $_SESSION['user']['country']);
        $result = queryDB("SELECT * FROM posts ORDER BY createdAt DESC LIMIT 1");
        $tournament = $result->fetch_array(MYSQLI_ASSOC);
        $tournament['tentativeDates'] = unserialize($tournament['tentativeDates']);
        http_response_code(202);
        echo json_encode($tournament);
      }
      else {
        http_response_code(500);
        echo "Error during operation.";
      }
    }
    else if ($action == 'update'){
      $target = sanitizeString($_POST['target']);
      $title = sanitizeString($_POST['title']);
      $author = sanitizeString($_POST['author']);
      $description = sanitizeString($_POST['description']);
      $address = sanitizeString($_POST['address']);
      $city = sanitizeString($_POST['city']);
      $country = sanitizeString($_POST['country']);
      $venue = sanitizeString($_POST['venue']);
      $tentativeDates = serialize($_POST['tentativeDates']);
      $price = sanitizeString($_POST['price']);
      $contactName = sanitizeString($_POST['contactName']);
      $contactPhone = sanitizeString($_POST['contactPhone']);
      $contactEmail = sanitizeString($_POST['contactEmail']);
      $organizerName = sanitizeString($_POST['organizerName']);
      $organizerPhone = sanitizeString($_POST['organizerPhone']);
      $organizerEmail = sanitizeString($_POST['organizerEmail']);
      $arbiters = serialize($_POST['arbiters']);
      $coaches = serialize($_POST['coaches']);

      $image = NULL;
      if ($_FILES){
        $filename = $_FILES['image']['name'];
        $image = $email.$filename;

        move_uploaded_file($_FILES['image']['tmp_name'], 'assets/data/tournaments/'.$image);
      }
      
      $query = "UPDATE posts SET title='$title',author='$author',description='$description',address='$address',
                city='$city',country='$country',venue='$venue',tentativeDates='$tentativeDates',price='$price',contactName='$contactName',
                contactPhone='$contactPhone',contactEmail='$contactEmail',organizerName='$organizerName',organizerPhone='$organizerPhone',
                organizerEmail='$organizerEmail',arbiters='$arbiters',coaches='$coaches' WHERE id='$target'";

      if (queryDB($query)){
        setLog('organization', $_SESSION['user']['id'], "updated tournament: $title", $_SESSION['user']['country']);
        $result = queryDB("SELECT * FROM posts ORDER BY updatedAt DESC LIMIT 1");
        $tournament = $result->fetch_array(MYSQLI_ASSOC);
        $tournament['tentativeDates'] = unserialize($tournament['tentativeDates']);
        http_response_code(202);
        echo json_encode($tournament);
      }
      else {
        http_response_code(400);
        echo "Error during operation.";
      }
    }
  }
  else if ($field == 'users'){
    
  }
}
else {
  $field = sanitizeString($_GET['field']);

  if ($field == 'users'){
    $action = sanitizeString($_GET['action']);

    if ($action == 'details'){
      $target = sanitizeString($_GET['target']);

      $result = queryDB("SELECT * FROM users WHERE id = '$target'");
      if ($result->num_rows){
        $user = $result->fetch_array(MYSQLI_ASSOC);
        setLog('organization', $target, "get user: ".$target, $_SESSION['user']['country']);
        echo json_encode(array("success" => TRUE, "user" => $user));
      }
    }

    else if ($action == 'approve'){
      $target = sanitizeString($_GET['target']);
      $done = FALSE;

      if (queryDB("UPDATE users SET approved = TRUE, rejected = FALSE WHERE id = '$target'")){
        $result = queryDB("SELECT email, fullname, country FROM users WHERE id = '$target'");
        if ($result->num_rows){
          $user = $result->fetch_array(MYSQLI_ASSOC);
          $email = $user['email'];
          $name = $user['fullname'];
        }
        $done = TRUE;
        setLog('organization', $target, $email.' has been approved.', $user['country']);
      }

      if ($done) {
        $subject ="Account Approval";
        $body = "<h3>Hi, <strong>".$name."</strong></h3><p>Your account has been approved.</p><p>You can now participate in tournaments.</p><p><a href='http://tportal.epizy.com/login'>Login to register for tournaments.</a></p>";
        
        sendPHPMail($email, $name, $subject, $body);  
        http_response_code(201);
      }
    }

    else if ($action == 'reject'){
      $target = sanitizeString($_GET['target']);
      $done = FALSE;
      
      if (queryDB("UPDATE users SET approved = FALSE, rejected = TRUE WHERE id = '$target'")){
        $result = queryDB("SELECT fullname, email, country FROM users WHERE id = '$target'");
        if ($result->num_rows){
          $user = $result->fetch_array(MYSQLI_ASSOC);
          $email = $user['email'];
          $name = $user['fullname'];
        }
        $done = TRUE;
        setLog('organization', $target, $email.' has been rejected.', $user['country']);
      }

      if ($done) {
        $subject ="Account Approval";
        $body = "<h3>Hi, <strong>".$name."</strong></h3><br><h3>Your account has been rejected.<br><a href='http://tportal.epizy.com/login'>Login to learn more....</a></h3>";
        
        sendPHPMail($email, $name, $subject, $body); 
        http_response_code(201);
      }
    }

    else if ($action == 'delete'){
      $target = sanitizeString($_GET['target']);

      if (queryDB("DELETE FROM users WHERE id = '$target'")){
        setLog("organization", $_SESSION['user']['id'], "user $target has been deleted", $_SESSION['user']['country']);
        echo "ok";
      }
      else {
        setLog("organization", $_SESSION['user']['id'], "failed to delete user ".$target, $_SESSION['user']['country']);
        http_response_code(400);
        echo "Deletion failed";
      }
    }
  }

  else if ($field == 'tournaments'){
    $action = sanitizeString($_GET['action']);
    
    if ($action == 'details'){
      $field = sanitizeString($_GET['field']);
      $target = sanitizeString($_GET['target']);
      $users = [];
      if ($field == 'tournaments'){
        $result = queryDB("SELECT * FROM posts WHERE id = '$target'");
        if ($result->num_rows){
          $tournament = $result->fetch_array(MYSQLI_ASSOC);
          setLog('organization', $_SESSION['user']['id'], "get tournament: ".$target, $_SESSION['user']['country']);
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
}
?>