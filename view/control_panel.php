<?php
if(!defined('__ROOT__')){
	define('__ROOT__', dirname(dirname(__FILE__)));
}

if(!isset($_SESSION)) session_start();

require_once(__ROOT__.'/class/Users.php');
require_once(__ROOT__.'/class/UsersList.php');

$user = new Users($_SESSION['id_user']);
$user -> read();

$id = $user->getId();
$name = $user->getName();
$lastname = $user->getLastName();
$address = $user->getAddress();
$phone = $user->getPhone();
$email = $user->getMail();

if(isset($_POST['update'])) {
	$newId = $_POST['id_update'];
	$newAddress = mysql_real_escape_string($_POST['address']);
	$newPhone = mysql_real_escape_string($_POST['phone']);
	$newEmail = mysql_real_escape_string($_POST['email']);
	$newPass = mysql_real_escape_string($_POST['pass']);
	
	if($newPass != '') {
		$newPass = md5($newPass);
		$updateUser = new Users($newId,null,null,$newAddress,$newPhone,$newEmail,$newPass);
		$updateUser -> update();
	}
	else{
		$updateUser = new Users($newId,null,null,$newAddress,$newPhone,$newEmail);
		$updateUser -> update();
	}
}
?>

<!DOCTYPE html>
<html>
<head>
</head>

<body>
<h1>Control panel</h1>
Here you can change your account settings.

<form method="post" accept-charset="utf8" >
	Name: 
	<?php 
	if ($_SESSION['rank'] == 2) {
		$listOfUsers = new UsersList();
		
		$usersArray = $listOfUsers -> getUsersList();
		$length = count($usersArray);
		
		echo "<select name='id_update'>";
		for($i=0; $i<$length; $i++) {
			echo "<option value='".$usersArray[$i]->getId()."'>".$usersArray[$i]->getName()." ".$usersArray[$i]->getLastName()."</option>";
		}
		echo "</select><br />";
	}
	else {
		echo $name." ".$lastname;
		echo "<input type='hidden' name='id_update' value='".$id."' /><br />";
	}
	?>
	
	
	Address: <input type="text" name="address" maxlength="50" pattern="[a-zA-Z0-9 ]+" oninvalid="this.setCustomValidity('Please enter valid address')"
		oninput="setCustomValidity('')" value="<?php echo $address ?>" required><br />
	Phone number: <input type="text" name="phone" maxlength="15" pattern="[0-9+]{6,15}" oninvalid="this.setCustomValidity('Please enter valid phone number')"
		oninput="setCustomValidity('')" value="<?php echo $phone ?>" required><br />
	Email address<input type="text" name="email" maxlength="30" pattern="^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$" oninvalid="this.setCustomValidity('Please enter valid email address')"
		oninput="setCustomValidity('')" value="<?php echo $email ?>" required><br />
	Password: <input type="password" name="pass"><br />
	<input type="submit" name="update" value="Update!">
</form>
</body>
</html>


