<?php
/**
 * Description
 * @Amos Amissah (anosamissah@outlook.com)
 * @date    2019-03-20 14:37:00
 * @version 1.0.0
 */


$db_server = 'localhost';
$username = 'dev';
$password = 'developer';
$database = 'tportal';

echo "Starting";

$connection = new mysqli($db_server, $username, $password, $database);

echo "Connection Started";

if ($connection->connect_error) die($connection->connect_error);
echo "Connection established";

function queryDB ($query){
  global $connection;
  $result = $connection->query($query);
  if (!$result) die($connection->error);
  return $result;
}

function createTable($name, $query) {
  queryDB("CREATE TABLE IF NOT EXISTS $name($query)");
  echo "<div class='alert-primary'>Table <strong>$name<strong> created successfully</div>";
}

createTable('users',
  "email VARCHAR(50),
  password VARCHAR(100),
  country VARCHAR(50)"
);

echo "Table created";

?>