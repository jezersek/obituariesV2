<?php 
if(!isset($_SESSION)) session_start();

if(isset($_POST['login']))
{
	require_once 'class/DB_connect.php';
	
	$connect = new DB_connect();
	$connect->set_charset("utf8");
		
	$email = $connect->real_escape_string(trim($_POST["email"]));
	$pass = md5($connect->real_escape_string(trim($_POST["pass"])));
	
	$query = "SELECT id, name, lastname, password, rank FROM users WHERE email=?";
	$statement = $connect->prepare($query);
	$statement->bind_param('s', $email);
	$statement->execute();
	$statement->bind_result($id_user,$name, $lastname, $passwd, $rank);
	$statement->fetch();
	$statement->close();
	$connect->close();
	
	if($pass == $passwd)
	{
		$_SESSION['name'] = $name . " " .$lastname;
		$_SESSION['email'] = $email;
		$_SESSION['id_user'] = $id_user;
		$_SESSION['rank'] = $rank;
		$_SESSION['logged'] = true;
		header("Location: index.php");
	}
	else echo '<p>Username and password do not match!</p>';
}

?>