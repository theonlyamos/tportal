<?php
if (strtolower($_SERVER['REQUEST_METHOD']) == 'post'){
  echo json_encode($_POST);
}
else if (strtolower($_SERVER['REQUEST_METHOD']) == 'get'){
  echo json_encode($_GET);
}

?>