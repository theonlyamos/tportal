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
    
    echo json_encode($_POST);
  }
}
?>