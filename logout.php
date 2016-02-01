<?php 
	header("Refresh: 2; url=index.php");
	
	if(!isset($_SESSION)) session_start();
	$email = $_SESSION['email'];
	if(session_destroy()) $text= 'User with email '.$email.' was successfully logged out';
	else $text= 'Logout was unsuccessful';	
?>

<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8" />
	<title>Logout</title>
	</head>
	<body>
	<?php echo $text; ?>
	</body>
</html>