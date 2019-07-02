<?php
session_start();

if (!$_SESSION['loggedIn'] && $_SESSION['user']['profession'] != "academy") {
	header("Location: /login.html");
}
$academy_id = $_SESSION['user']['id'];
$user_id = $_GET['id'];

require_once '../functions.php';

$result = queryDB("INSERT INTO players_map (user_id, academy_id) VALUES ('$user_id', '$academy_id')");
header('Location: users.php');

?>