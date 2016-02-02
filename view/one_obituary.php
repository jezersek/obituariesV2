<?php 
	if(!defined('__ROOT__')){
	define('__ROOT__', dirname(dirname(__FILE__)));
	}
	
	if(!isset($_SESSION)) session_start();
?>

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
	
	echo "<div class='single'>";
	echo "<img src='images/".$religion.".png' height=150/><br />";
	echo "<h2>".$name." ".$lastname." from ".$location."</h2><h3>".$dateOfBirth." - ". $dateOfDeath."</h3>";
	if ($image != 0) echo "<img src='http://localhost/obituaries2/images/".$image."' height=300 />";
	echo "<p>".nl2br($text)."</p>";
	echo "<iframe width='1' height='1' src='https://www.youtube.com/embed/".$music."?autoplay=1' wmode='transparent' frameborder='0'></iframe>";
	echo "</div>";
	?>


	</body>
</html>