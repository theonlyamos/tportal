<?php

session_start();

require_once 'functions.php';

if (strtolower($_SERVER['REQUEST_METHOD']) == 'post'){
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
}
?>