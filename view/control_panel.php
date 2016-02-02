<script>
$(document).ready(function() {
	$('#id_update').change(function() {
    selectedOption = $('option:selected', this);
    $('input[name=address]').val(selectedOption.data('address') );
    $('input[name=phone]').val(selectedOption.data('phone') );
    $('input[name=email]').val(selectedOption.data('email') );
})});
</script>
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
	$newAddress = $_POST['address'];
	$newPhone = $_POST['phone'];
	$newEmail = $_POST['email'];
	$newPass = $_POST['pass'];
	
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

<body>


<form method="post" accept-charset="utf8" >
	<h2>Control panel</h2>
	Name:  <br />
	<?php 
	if ($_SESSION['rank'] == 2) {
		$listOfUsers = new UsersList();
		
		$usersArray = $listOfUsers -> getUsersList();
		$length = count($usersArray);
		
		echo "<select name='id_update' id='id_update'>";
		echo "<option value=''>Please Select</option>";
		for($i=0; $i<$length; $i++) {
			echo "<option value='".$usersArray[$i]->getId()."' data-address='".$usersArray[$i]->getAddress()."' 
			data-phone='".$usersArray[$i]->getPhone()."' data-email='".$usersArray[$i]->getMail()."'>"
			.$usersArray[$i]->getName()." ".$usersArray[$i]->getLastName()."</option>";
			
		}
		echo "</select><br />";
	}
	else {
		echo $name." ".$lastname;
		echo "<input type='hidden' name='id_update' value='".$id."' /><br />";
	}
	?>
	
	
	Address:  <br /><input type="text" name="address" maxlength="50" pattern="[a-zA-Z0-9 ]+" oninvalid="this.setCustomValidity('Please enter valid address')"
		oninput="setCustomValidity('')" value="<?php echo $address; ?>" required><br />
	Phone number:  <br /><input type="text" name="phone" maxlength="15" pattern="[0-9+]{6,15}" oninvalid="this.setCustomValidity('Please enter valid phone number')"
		oninput="setCustomValidity('')" value="<?php echo $phone; ?>" required><br />
	Email address:  <br /><input type="text" name="email" maxlength="30" pattern="^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$" oninvalid="this.setCustomValidity('Please enter valid email address')"
		oninput="setCustomValidity('')" value="<?php echo $email; ?>" required><br />
	Password:  <br /><input type="password" name="pass"><br />
	<input type="submit" name="update" value="Update!">
</form>
</body>
</html>


