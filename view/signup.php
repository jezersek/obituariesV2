<?php
if(!defined('__ROOT__')){
	define('__ROOT__', dirname(dirname(__FILE__)));
}

if(!isset($_SESSION)) session_start();

if(isset($_POST['register'])) {
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$address = $_POST['address'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$pass = $_POST['pass'];
	
	require_once(__ROOT__.'/class/Users.php');
		
	$newUser = new Users(null, $firstname, $lastname, $address, $phone, $email, $pass);
	$newUser -> signup();
	
	echo '<script type="text/JavaScript">alert("Registration was successful!");</script>';
	header("Location: index.php");
	
}
?>

<body>
<form class="register" method="post" accept-charset="utf8" >
	<h2>User registration</h2>
	First name: <br /><input type="text" name="firstname" maxlength="25" pattern="[a-zA-Z ]+" oninvalid="this.setCustomValidity('Please enter valid first name')"
		oninput="setCustomValidity('')" required><br />
	Last name: <br /><input type="text" name="lastname" maxlength="35" pattern="[a-zA-Z ]+" oninvalid="this.setCustomValidity('Please enter valid last name')"
		oninput="setCustomValidity('')" required><br />
	Address: <br /><input type="text" name="address" maxlength="50" pattern="[a-zA-Z0-9 ]+" oninvalid="this.setCustomValidity('Please enter valid address')"
		oninput="setCustomValidity('')" required><br />
	Phone number: <br /><input type="text" name="phone" maxlength="15" pattern="[0-9+]{6,15}" oninvalid="this.setCustomValidity('Please enter valid phone number')"
		oninput="setCustomValidity('')" required><br />
	Email address: <br /><input type="text" name="email" maxlength="30" pattern="^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$" oninvalid="this.setCustomValidity('Please enter valid email address')"
		oninput="setCustomValidity('')" required><br />
	Password: <br /><input type="password" name="pass" required><br />
	<input type="submit" name="register" value="Register">
</form>
</body>
</html>