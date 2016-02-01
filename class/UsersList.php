<?php
if(!defined('__ROOT__')){
	define('__ROOT__', dirname(dirname(__FILE__)));
}
require_once(__ROOT__.'/class/DB_connect.php'); 
require_once(__ROOT__.'/class/Users.php'); 


class UsersList{
	private $usersList;
	
	public function __construct(){
		$connect = new DB_connect();
		$connect->set_charset("utf8");
		
		$query = "SELECT id, name, lastname, address, phone, email, rank FROM users";
		$statment = $connect->prepare($query);
		$statment -> execute();
		$statment->bind_result($id_user,$name,$lastname,$address,$phone,$email, $rank);
		
		while ($statment->fetch()) {
			$this -> addUser(new Users($id_user, $name, $lastname, $address, $phone, $email, null, $rank));
		}
		$statment -> close();
		$connect->close();
	}
	
	public function addUser(Users $user){
		$this -> usersList[] = $user;
	}
	
	public function getUsersList(){
		return $this -> usersList;
	}

}

?>