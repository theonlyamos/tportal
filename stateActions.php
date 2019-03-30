<?php

require_once 'functions.php';

if ($_POST){
  $action = sanitizeString($_POST['action']);
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
  else if ($action == 'post'){
    $type = sanitizeString($_POST['field']);
    $title = sanitizeString($_POST['title']);
    $description = sanitizeString($_POST['description']);
    $address = sanitizeString($_POST['address']);
    $city = sanitizeString($_POST['city']);
    $venue = sanitizeString($_POST['venue']);
    $startDates = serialize($_POST['startDates']);
    $endDates = serialize($_POST['endDates']);
    $price = sanitizeString($_POST['price']);
    $contactName = sanitizeString($_POST['contactName']);
    $contactPhone = sanitizeString($_POST['contactPhone']);
    $contactEmail = sanitizeString($_POST['contactEmail']);
    $organizerName = sanitizeString($_POST['organizerName']);
    $organizerPhone = sanitizeString($_POST['organizerPhone']);
    $organizerEmail = sanitizeString($_POST['organizerEmail']);
    $userid = $_SESSION['user']['id'];
    $user_role = $_SESSION['user']['profession'];
    $author = $_SESSION['user']['name'];
    $country = $_SESSION['user']['country'];

    $image = NULL;
    if ($_FILES){
      $filename = $_FILES['image']['name'];
      $image = $email.$filename;

      move_uploaded_file($_FILES['image']['tmp_name'], 'assets/data/tournaments/'.$image);
    }

    $query = "INSERT INTO posts (id, type, title, description, address, city, venue, startDates, endDates, price, country,
    contactName, contactPhone, contactEmail, organizerName, organizerPhone, organizerEmail, userid, user_role, image, author) VALUES (
    UUID(), '$type', '$title', '$description', '$address', '$city', '$venue', '$startDates', '$endDates', '$price', '$country', '$contactName',
    '$contactPhone', '$contactEmail', '$organizerName', '$organizerPhone', '$organizerEmail', '$userid', '$user_role', '$image', '$author')";

    if (queryDB($query)){
      $result = queryDB("SELECT * FROM posts ORDER BY createdAt DESC LIMIT 1");
      $tournament = $result->fetch_array(MYSQLI_ASSOC);
      http_response_code(202);
      echo json_encode($tournament);
    }
    else {
      http_response_code(500);
      echo "Error during operation.";
    }
  }
}
?>