<?php
class Controller
{
	public function __construct()
	{
		if(isset($_SESSION["logged"]) && $_SESSION["logged"] == true){			
			if(isset($_GET["logout"]) && $_GET["logout"] == "yes"){				
				include_once 'logout.php';
			}
			
			if(isset($_GET['action']) &&  $_GET['action'] == "addobituary" ) {
				include_once '/view/new_obituary.php';
			}
			if(isset($_GET['action']) && $_GET['action'] == 'control') {
				include_once "/view/control_panel.php"; 
			}
		}
		else {
			if(isset($_POST["login"])){			
				include_once "login.php";
			}
			if(isset($_GET['action']) &&  $_GET['action'] == "login" )	{						
				include_once "/view/login.html"; 
			}
			if(isset($_GET['action']) &&  $_GET['action'] == "signup" ) {
				include_once "/view/signup.php"; 
			}
		}
		
		if(!isset($_GET["obituaryid"])){ 			
			include_once "view/all_obituaries.php";
		} 
		else {										
			include_once "view/one_obituary.php";				
		}
	}
}
?>