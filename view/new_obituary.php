<?php
if(!defined('__ROOT__')){
	define('__ROOT__', dirname(dirname(__FILE__)));
}

if(!isset($_SESSION)) session_start();

if(isset($_POST['post'])) {
	$firstname = mysql_real_escape_string($_POST['firstname']);
	$lastname = mysql_real_escape_string($_POST['lastname']);
	$dateOfBirth = mysql_real_escape_string($_POST['dateOfBirth']);
	$dateOfDeath = mysql_real_escape_string($_POST['dateOfDeath']);
	$religion = mysql_real_escape_string($_POST['religion']);
	$location = mysql_real_escape_string($_POST['location']);
	$text = mysql_real_escape_string($_POST['text']);
	$url = mysql_real_escape_string($_POST['music']);	
	
	if($url != '') $music = substr(strstr($url, 'v='), 2, 11);
	else $music = 0;
	
	require_once(__ROOT__.'/class/Obituary.php');
	
	$newObituary = new Obituary(null, $firstname, $lastname, $location, $dateOfDeath, $dateOfBirth, $religion, $text, $music);
	$newObituary -> create();
	
	echo "New obituary was published successfully!";
}
	

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf8">
<title>Post a new obituary</title>
</head>

<body>
<h1>Post a new obituary</h1>
<form method="post" enctype="multipart/form-data" accept-charset="latin2_general_ci" >
	First name: <input type="text" name="firstname" maxlength="25" pattern="[a-zA-Z ]+" oninvalid="this.setCustomValidity('Please enter valid first name')"
		oninput="setCustomValidity('')" required><br />
	Last name: <input type="text" name="lastname" maxlength="35" pattern="[a-zA-Z ]+" oninvalid="this.setCustomValidity('Please enter valid last name')"
		oninput="setCustomValidity('')" required><br />
	Photo: <input type="hidden" name="MAX_FILE_SIZE" value="1024000" /><input type="file" name="photo" accept="image/x-png, image/gif, image/jpeg"><br />
	Date of birth: <input type="date" name="dateOfBirth" max="<?php echo date("Y-m-d"); ?>" required><br />
	Date of death: <input type="date" name="dateOfDeath" max="<?php echo date("Y-m-d"); ?>" required><br />
	Religion: <br/>
		<input type="radio" name="religion" value="2" checked>Catholic<br/>
		<input type="radio" name="religion" value="3">Orthodox<br/>
		<input type="radio" name="religion" value="4">Jewish<br/>
		<input type="radio" name="religion" value="5">Islam<br/>
		<input type="radio" name="religion" value="1">None<br/>
	Region/city: <input type="text" name="location" maxlength="50" pattern="[a-zA-Z0-9 ]+" oninvalid="this.setCustomValidity('Please enter valid location')"
		oninput="setCustomValidity('')" required><br />
	Text: <textarea name="text" maxlength="300" pattern="[^<>\\|/]+" oninvalid="this.setCustomValidity('Please enter valid location')"
		oninput="setCustomValidity('')" required></textarea><br/>
	Background music (youtube link): <input type="text" name="music" maxlength="50" oninvalid="this.setCustomValidity('Please enter youtube link')"
		oninput="setCustomValidity('')"><br />
	<input type="submit" name="post" value="Publish it">
</form>
</body>
</html>