<?php
if(!defined('__ROOT__')){
	define('__ROOT__', dirname(dirname(__FILE__)));
}
require_once(__ROOT__.'/class/DB_connect.php'); 
require_once(__ROOT__.'/class/Obituary.php'); 


class ObituariesList{
	private $obituariesList = array();

	public function addObituary(Obituary $obituary){
		$this -> obituaryList[] = $obituary;
	}
	
	public function getObituariesList(){
		return $this -> obituaryList;
	}
	
	public function getObituaryByIndex($i){
		if(isset($this -> obituaryList[$i])){
			return $this -> obituaryList[$i];
		}else{
			return -1;
		}
	}
	
	public function __construct(){
		$connect = new DB_connect();
		$connect->set_charset("utf8");
		$query = "SELECT id, name, lastname, location, dateOfBirth, dateOfDeath, religion FROM obituaries ORDER BY datePublished DESC";
		$statment = $connect->prepare($query);
		$statment -> execute();
		$statment->bind_result($id_obituary,$name, $lastname, $location, $dateOfBirth, $dateOfDeath,  $religion);
	
		while ($statment->fetch()) {
			$this->addObituary(new Obituary($id_obituary,$name, $lastname, $location, $dateOfBirth, $dateOfDeath, $religion));
		}
		$statment -> close();
		$connect->close();
	}
}
?>