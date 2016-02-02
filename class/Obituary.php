<?php
if(!defined('__ROOT__')){
	define('__ROOT__', dirname(dirname(__FILE__)));
}
require_once(__ROOT__.'/class/DB_connect.php'); 

class Obituary{
	private $obituaryId;
	private $name;
	private $lastname;
	private $location;
	private $dateOfDeath;
	private $dateOfBirth;
	private $datePublished;
	private $religion;
	private $text;
	private $image;
	private $music;
	
	public function __construct($obituaryId, $name=null, $lastname=null, $location=null, $dateOfDeath=null, $dateOfBirth=null, $religion=null, $text=null, $music=null){
		$this -> obituaryId = $obituaryId;
		$this -> name = $name;
		$this -> lastname = $lastname;
		$this -> location = $location;
		$this -> dateOfBirth = $dateOfBirth;
		$this -> dateOfDeath = $dateOfDeath;
		$this -> religion = $religion;
		$this -> text = $text;
		$this -> image = '';		
		$this -> music = $music;
		$this -> datePublished = date("Y-m-d");
	}

	public function create(){
		$connect= new DB_connect();
		$connect-> set_charset("utf8");

		$firstname = $connect->real_escape_string(trim($this->name));
		$lastname = $connect->real_escape_string(trim($this->lastname));
		$dateOfBirth = $connect->real_escape_string(trim($this->dateOfBirth));
		$dateOfDeath = $connect->real_escape_string(trim($this->dateOfDeath));
		$religion = $connect->real_escape_string(trim($this->religion));
		$location = $connect->real_escape_string(trim($this->location));
		$text = $connect->real_escape_string(trim($this->text));
		$url = $connect->real_escape_string(trim($this->music));	
		
		if(!empty($_FILES["photo"]["name"])) {
			if(($_FILES['photo']['size'] < 1024000 ) && getimagesize($_FILES['photo']['tmp_name'])) {
				$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']); 
				$uploadsDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . 'images/';
				$this->image = rand();
				move_uploaded_file($_FILES['photo']['tmp_name'], $uploadsDirectory.$this->image) ;
			}
			else echo 'This format of photo is unsupported or the photo is too big!';
		}
		else $this->image = 0;
		
		$query = "INSERT INTO obituaries(name, lastname, dateOfBirth, dateOfDeath, religion, location, text, image, music, datePublished) 
			VALUES(?,?,?,?,?,?,?,?,?,?)";

		$statment = $connect-> prepare($query);
		$statment->bind_param('ssssssssss',$this -> name, $this -> lastname, $this -> dateOfBirth, $this -> dateOfDeath, 
			$this -> religion, $this -> location, $this -> text, $this -> image, $this -> music, $this -> datePublished);
		$statment -> execute();
		$statment -> close();
		$connect->close();
	}
	
	public function read_all(){
	$connect= new DB_connect();
	$connect-> set_charset("utf8");
	
	$query = "SELECT name, lastname, dateOfDeath, location, datePublished FROM obituary WHERE valid=0 ORDER BY datePublished DESC";
	
	$statment = $connect-> prepare($query);
	$statment -> execute();
	$statment -> bind_result($this -> name, $this -> lastname, $this -> dateOfDeath, $this -> location, $this -> datePublished);
	$statment -> fetch();
	$statment -> close();
	$connect->close();
	}
	
	public function read_one(){
	
	$connect= new DB_connect();
	$connect-> set_charset("utf8");
	
	$query = "
		SELECT
			name, lastname, dateOfBirth, dateOfDeath, religion, location, text, image, music, datePublished
		FROM obituaries WHERE id=?";
	
	$statment = $connect->prepare($query);
	$statment -> bind_param('i', $this->obituaryId);
	$statment -> execute();
	$statment -> bind_result($this -> name, $this -> lastname, $this -> dateOfBirth, $this -> dateOfDeath, 
			$this -> religion, $this -> location, $this -> text, $this -> image, $this->music, $this -> datePublished);
	$statment -> fetch();
	$statment -> close();
	$connect->close();
	}
	
	
	public function update(){
		$connect= new DB_connect();
		$connect-> set_charset("utf8");
		
		$query = "UPDATE obituaries SET name, lastname, dateOfBirth, dateOfDeath, religion, location, text, image WHERE id=?";
		$statment = $connect-> prepare($query); 
		$statment -> bind_param('i', $this -> obituaryId);
		$statment -> execute();
		$statment -> close();
		$connect->close();
	}
	
	public function delete(){
		$connect= new DB_connect();
		$connect-> set_charset("utf8");
		
		$query = "DELETE FROM obituaries WHERE id=?";
		$statment = $connect-> prepare($query); 
		$statment -> bind_param('i', $this -> obituaryId);
		$statment -> execute();
		$statment -> close();
		$connect->close();
	}
	
	
	public function getId(){
		return $this -> obituaryId;
	}
	
	public function setId($value){
		$this -> obituaryId = $value;
	}

	public function getObituaryName(){
		return $this -> name;
	}
	
	public function setObituaryName($value){
		$this -> name = $value;
	}
	
	public function getObituaryLastName(){
		return $this -> lastname;
	}
	
	public function setObituaryLastName($value){
		$this -> lastname = $value;
	}
	
	public function getObituaryDateOfBirth(){
		return $this -> dateOfBirth;
	}	
	
	public function setObituaryDateOfBirth($value){
		$this -> dateOfBirth = $value;
	}
	
	public function getObituaryDateOfDeath(){
		return $this -> dateOfDeath;
	}	
	
	public function setObituaryDateOfDeath($value){
		$this -> dateOfDeath = $value;
	}
	
	public function getObituaryDatePublished(){
		return $this -> datePublished;
	}	
	
	public function setObituaryDatePublished($value){
		$this -> datePublished = $value;
	}
	
	public function getObituaryReligion(){
		return $this -> religion;
	}	
	
	public function setObituaryReligion($value){
		$this -> religion = $value;
	}
	
	public function getObituaryLocation(){
		return $this -> location;
	}	
	
	public function setObituaryLocation($value){
		$this -> location = $value;
	}
	
	public function getObituaryText(){
		return $this -> text;
	}	
	
	public function setObituaryText($value){
		$this -> text = $value;
	}
	
	public function getMusic(){
		return $this -> music;
	}	
	
	public function getObituaryImage(){
		return $this -> image;
	}	
	
	public function setObituaryImage($value){
		$this -> image = $value;
	}
	
}
?>