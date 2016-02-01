<?php 
	if(!defined('__ROOT__')){
	define('__ROOT__', dirname(dirname(__FILE__)));
	}
	
	if(!isset($_SESSION)) session_start();
?>
<html>
<head>
	<meta charset="utf-8" />
	<title>Obituary</title>
	<!-- <link rel="stylesheet" type="text/css" href="css/topics_list.css" />	 -->
</head>
<body>
	<?php 
	$obituaryId = $_GET['obituaryid'];
	
	require_once(__ROOT__.'/class/Obituary.php');
	$obituary = new Obituary($obituaryId);
	$obituary -> read_one();

	$name = $obituary -> getObituaryName();
	$lastname = $obituary -> getObituaryLastName();
	$dateOfBirth = date("d.m.Y", strtotime($obituary -> getObituaryDateOfBirth()));
	$dateOfDeath = date("d.m.Y", strtotime($obituary -> getObituaryDateOfDeath()));
	$datePublished = $obituary -> getObituaryDatePublished();
	$religion = $obituary -> getObituaryReligion();
	$location = $obituary -> getObituaryLocation();
	$text = $obituary -> getObituaryText();
	$image = $obituary -> getObituaryImage();
	$music = $obituary -> getMusic();
	
	//$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']); 
	//$uploadsDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . 'images/';
	echo "<h1>".$name." ".$lastname." from ".$location."</h1><h2>".$dateOfBirth." - ". $dateOfDeath."</h2>";
	if ($image != 0) echo "<img src='http://localhost/obituaries2/images/".$image."' height=300 />";
	echo "<p>".$text."</p>";
	echo "<iframe width='1' height='1' src='https://www.youtube.com/embed/".$music."?autoplay=1' wmode='transparent' frameborder='0'></iframe>";
	?>


	</body>
</html>