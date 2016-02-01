<?php
if(!defined('__ROOT__')){
	define('__ROOT__', dirname(dirname(__FILE__)));
}

class DB_connect extends mysqli{
	private $host = 'localhost';
	private $login = 'admin';
	private $password = 'admin';
	private $database = 'obituaries';
	
	public function __construct(){
		 parent::__construct($this->host, $this->login, $this->password, $this->database);
	}
}
?>