<?php

require_once 'functions.php';
session_start();

$lastLog = 0;

while (1) {
  $logs = getLogs($lastLog);
  if ($logs){
    header('Cache-Control: no-cache');
    header("Content-Type: text/event-stream\n\n");
    echo "event: log\n";
    echo "data: ".json_encode($logs);
    echo "\n\n";
  }
  ob_end_flush();
  flush();
  sleep(3);
}



?>