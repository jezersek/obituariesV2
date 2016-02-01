<?php 
	if(!defined('__ROOT__')){
	define('__ROOT__', dirname(dirname(__FILE__)));
	}
	
	if(!isset($_SESSION)) session_start();
?>
<html>
<head>
	<meta charset="utf-8" />
	<title>All published obituaries</title>
	<!-- <link rel="stylesheet" type="text/css" href="css/topics_list.css" />	 -->
</head>
<body>
	<?php 
	require_once(__ROOT__.'/class/ObituariesList.php');
	$listOfObituaries = new ObituariesList();
	
	$array = $listOfObituaries -> getObituariesList();

	echo "<h2>Published obituaries ...</h2>";
	$length = count($array);
	for($i =0; $i<$length; $i++){
		echo "<p>";
		echo $array[$i] -> getObituaryName() . " " . $array[$i] -> getObituaryLastName();
		echo ' <a href="?obituaryid='.$array[$i]->getId().'">Read More</a>';
		echo "</p>";
	}
	?>
	</body>
</html>