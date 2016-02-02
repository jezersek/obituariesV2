<?php
if(!defined('__ROOT__')){
	define('__ROOT__', dirname(dirname(__FILE__)));
}
require_once(__ROOT__.'/class/DB_connect.php'); 

class Users{
	private $name;
	private $firstname;
	private $lastname;
	private $address;
	private $phone;
	private $email;
	private $pass;
	private $rank;
	
	public function __construct($id=null, $name=null, $lastname=null, $address=null, $phone=null, $email=null, $pass=null, $rank=null) {
		$this->id = $id;
		$this->name = $name;
		$this->lastname = $lastname;
		$this->address = $address;
		$this->phone = $phone;
		$this->email = $email;
		$this->pass = $pass;
		$this->rank = $rank;
	}
	
	public function signup() {
		$connect= new DB_connect();
		$connect-> set_charset("utf8");
		$name = $connect->real_escape_string(trim($this->name));
		$lastname = $connect->real_escape_string(trim($this->lastname));
		$phone = $connect->real_escape_string(trim($this->phone));
		$address = $connect->real_escape_string(trim($this->address));
		$email = $connect->real_escape_string(trim($this->email));
		$pass = md5($connect->real_escape_string(trim($this->pass)));
		
		$query = "INSERT INTO users(name, lastname, address, phone, email, password) VALUES(?,?,?,?,?,?)";

		$statment = $connect-> prepare($query);
		$statment->bind_param('ssssss',$name, $lastname, $address, $phone, $pass);
		$statment -> execute();
		$statment -> close();
		$connect->close();
	}
		
	public function read() {
		$connect= new DB_connect();
		$connect-> set_charset("utf8");
	
		$query = "SELECT name, lastname, address, phone, email, rank FROM users WHERE id=?";
	
		$statment = $connect-> prepare($query);
		$statment -> bind_param('i',$_SESSION['id_user']);
		$statment -> execute();
		$statment -> bind_result($this -> name, $this -> lastname, $this -> address, $this -> phone, $this -> email, $this -> rank);
		$statment -> fetch();
		$statment -> close();
		$connect->close();
	}
	
	public function update() {
		$connect= new DB_connect();
		$connect-> set_charset("utf8");
		
		$address = $connect->real_escape_string(trim($this->address));
		$phone = $connect->real_escape_string(trim($this->phone));
		$email = $connect->real_escape_string(trim($this->email));
		
		if($this->pass == '') {
			$query = "UPDATE users SET address=?, phone=?, email=? WHERE id=?";
			$statment = $connect -> prepare($query); 
			$statment -> bind_param('sssi',$address, $phone, $email, $this->id);
		} else {
			$query = "UPDATE users SET address=?, phone=?, email=?, password=? WHERE id=?";
			$statment = $connect -> prepare($query); 
			$statment -> bind_param('ssssi', $address, $phone, $email, $this->pass, $this->id);
		}
		$statment -> execute();
		$statment -> close();
		$connect->close();
		
	}
	public function getId(){
		return $this -> id;
	}
	public function getName(){
		return $this -> name;
	}
	public function getLastName(){
		return $this -> lastname;
	}
	public function getAddress(){
		return $this -> address;
	}
	public function getPhone(){
		return $this -> phone;
	}
	public function getMail(){
		return $this -> email;
	}
}