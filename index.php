<?php 
if(!isset($_SESSION)) session_start();
	include_once "view/header.php";
	require_once "class/Controller.php";
	$controller = new Controller();
?>