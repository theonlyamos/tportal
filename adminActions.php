<?php

session_start();

require_once 'functions.php';

if (strtolower($_SERVER['REQUEST_METHOD']) == 'post' && $_SESSION['user']['role'] == 'admin'){
  $field = sanitizeString($_POST['field']);
  $uid = $_SESSION['id'];
  
  if ($field == 'tournaments'){
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
        setLog('admin', $_SESSION['user']['id'], "updated tournament: $target", 'tournament');
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
        setLog('admin', $_SESSION['user']['id'], "get user: ".$target, "user");
        echo json_encode(array("success" => TRUE, "user" => $user));
      }
    }

    else if ($action == 'approve'){
      $target = sanitizeString($_GET['target']);
      $done = FALSE;

      if (queryDB("UPDATE users SET approved = TRUE, rejected = FALSE WHERE id = '$target'")){
        $result = queryDB("SELECT email, fullname FROM users WHERE id = '$target'");
        if ($result->num_rows){
          $user = $result->fetch_array(MYSQLI_ASSOC);
          $email = $user['email'];
          $name = $user['fullname'];
        }
        $done = TRUE;
        setLog('admin', $target, $email.' has been approved.', 'user');
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
        $result = queryDB("SELECT fullname, email FROM users WHERE id = '$target'");
        if ($result->num_rows){
          $user = $result->fetch_array(MYSQLI_ASSOC);
          $email = $user['email'];
          $name = $user['fullname'];
        }
        $done = TRUE;
        setLog('admin', $target, $email.' has been rejected.', 'admin');
      }

      if ($done) {
        $subject ="Account Approval";
        $body = "<h3>Hi, <strong>".$name."</strong></h3><p>Your account has been rejected.</p><p><a href='http://tportal.epizy.com/login'>Login to learn more....</a></p>";
        
        sendPHPMail($email, $name, $subject, $body);
        http_response_code(201);
      }
    }

    else if ($action == 'delete'){
      $target = sanitizeString($_GET['target']);

      if (queryDB("DELETE FROM users WHERE id = '$target'")){
        setLog("admin", $target, "user $target has been deleted", "user");
        echo "ok";
      }
      else {
        setLog("admin", $target, "failed to delete user ".$target, "user");
        http_response_code(400);
        echo "Deletion failed";
      }
    }
  }

  else if ($field == 'organizations'){
    $action = sanitizeString($_GET['action']);

    if ($action == 'details'){
      $target = sanitizeString($_GET['target']);

      $result = queryDB("SELECT * FROM states WHERE id = '$target'");
      if ($result->num_rows){
        $org = $result->fetch_array(MYSQLI_ASSOC);
        $org['bearerNames'] = unserialize($org['bearerNames']);
        $org['bearerPhones'] = unserialize($org['bearerPhones']);
        $org['bearerEmails'] = unserialize($org['bearerEmails']);
        $org['bearerPans'] = unserialize($org['bearerPans']);
        $org['bearerDesignations'] = unserialize($org['bearerDesignations']);
        setLog('admin', $_SESSION['user']['id'], "get organization: ".$target, $org['country']);
        echo json_encode(array("success" => TRUE, "orgs" => $org));
      }
    }

    else if ($action == 'approve'){
      $target = sanitizeString($_GET['target']);
      $done = FALSE;
  
      if (queryDB("UPDATE states SET approved = TRUE, rejected = FALSE WHERE id = '$target'")){
        $result = queryDB("SELECT email, name FROM states WHERE id = '$target'");
        if ($result->num_rows){
          $org = $result->fetch_array(MYSQLI_ASSOC);
          $email = $org['email'];
          $name = $org['name'];
        }
        $done = TRUE;
        setLog('admin', $target, $name.' has been approved.', 'admin');
      }
  
      if ($done) {
        $subject ="Account Approval";
        $body = "<h3><strong>".$name."</strong></h3><p>Your account has been approved.</p><p>You can now participate in tournaments.</p><p><a href='http://tportal.epizy.com/login'>Login to register for tournaments.</a></p>";
        
        sendPHPMail($email, $name, $subject, $body);
        http_response_code(201);
      }
    }
  
    else if ($action == 'reject'){
      $target = sanitizeString($_GET['target']);
      $done = FALSE;
      
      if (queryDB("UPDATE states SET approved = FALSE, rejected = TRUE WHERE id = '$target'")){
        $result = queryDB("SELECT name, email FROM states WHERE id = '$target'");
        if ($result->num_rows){
          $org = $result->fetch_array(MYSQLI_ASSOC);
          $email = $org['email'];
          $name = $org['name'];
        }
        $done = TRUE;
        setLog('admin', $target, $name.' has been rejected.', 'admin');
      }
  
      if ($done) {
        $subject ="Account Approval";
        $body = "<h3><strong>".$name."</strong></h3><p>Your account has been rejected.</p><p><a href='http://tportal.epizy.com/login'>Login to learn more....</a></p>";
        
        sendPHPMail($email, $name, $subject, $body);
        http_response_code(201);
      }
    }
  
    else if ($action == 'delete'){
      $target = sanitizeString($_GET['target']);
  
      if (queryDB("DELETE FROM states WHERE id = '$target'")){
        setLog("admin", $target, "organization $target has been deleted", "admin");
        echo "ok";
      }
      else {
        setLog("admin", $target, "failed to delete organization ".$target, "admin");
        http_response_code(400);
        echo "Deletion failed";
      }
    }
  }
}
?>