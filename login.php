<?php 
if(!isset($_SESSION)) session_start();
header("Refresh: 2; url=index.php");

if(isset($_POST['login']))
{
	require_once 'class/DB_connect.php';
	
	$connect = new DB_connect();
	$connect->set_charset("utf8");
		
	$email = $connect->real_escape_string(trim($_POST["email"]));
	$pass = md5($connect->real_escape_string(trim($_POST["pass"])));
	
	$query = "SELECT id, password, rank FROM users WHERE email=?";
	$statement = $connect->prepare($query);
	$statement->bind_param('s', $email);
	$statement->execute();
	$statement->bind_result($id_user, $passwd, $rank);
	$statement->fetch();
	$statement->close();
	$connect->close();
	
	if($pass == $passwd)
	{
		$_SESSION['email'] = $email;
		$_SESSION['id_user'] = $id_user;
		$_SESSION['rank'] = $rank;
		$_SESSION['logged'] = true;
		
		echo 'Welcome '.$_SESSION['email'];
		
	}
	else echo 'Username and password do not match!';
}

?>