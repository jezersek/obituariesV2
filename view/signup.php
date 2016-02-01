<?php
if(!defined('__ROOT__')){
	define('__ROOT__', dirname(dirname(__FILE__)));
}

if(!isset($_SESSION)) session_start();

if(isset($_POST['register'])) {
	$firstname = mysql_real_escape_string($_POST['firstname']);
	$lastname = mysql_real_escape_string($_POST['lastname']);
	$address = mysql_real_escape_string($_POST['address']);
	$phone = mysql_real_escape_string($_POST['phone']);
	$email = mysql_real_escape_string($_POST['email']);
	$pass = md5(mysql_real_escape_string($_POST['pass']));
	
	require_once(__ROOT__.'/class/Users.php');
		
	$newUser = new Users(null, $firstname, $lastname, $address, $phone, $email, $pass);
	$newUser -> signup();
	
	header("Refresh: 2; url=index.php");
	echo "Registration was successful!";
	
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf8">
<title>User registration form</title>
</head>

<body>
<h1>User registration</h1>
<form method="post" accept-charset="utf8" >
	First name: <input type="text" name="firstname" maxlength="25" pattern="[a-zA-Z ]+" oninvalid="this.setCustomValidity('Please enter valid first name')"
		oninput="setCustomValidity('')" required><br />
	Last name: <input type="text" name="lastname" maxlength="35" pattern="[a-zA-Z ]+" oninvalid="this.setCustomValidity('Please enter valid last name')"
		oninput="setCustomValidity('')" required><br />
	Address: <input type="text" name="address" maxlength="50" pattern="[a-zA-Z0-9 ]+" oninvalid="this.setCustomValidity('Please enter valid address')"
		oninput="setCustomValidity('')" required><br />
	Phone number: <input type="text" name="phone" maxlength="15" pattern="[0-9+]{6,15}" oninvalid="this.setCustomValidity('Please enter valid phone number')"
		oninput="setCustomValidity('')" required><br />
	Email address<input type="text" name="email" maxlength="30" pattern="^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$" oninvalid="this.setCustomValidity('Please enter valid email address')"
		oninput="setCustomValidity('')" required><br />
	Password: <input type="password" name="pass" required><br />
	<input type="submit" name="register" value="Register">
</form>
</body>
</html>