<?php
require_once 'database.php';
session_start();
if(!array_key_exists('name', $_SESSION)) {
	header('Location: /login.php');
	exit;
}

echo "Welcome";


require_once 'logout.php';
?>




