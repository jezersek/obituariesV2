<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<title>Obituaries</title>
	<link href='https://fonts.googleapis.com/css?family=Vollkorn:400,400italic,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="css/style.css" />	 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>

<?php 
if(!isset($_SESSION)) session_start();
	include_once "view/header.php";
	require_once "class/Controller.php";
	$controller = new Controller();
	include_once "view/footer.php";
?>

</html>