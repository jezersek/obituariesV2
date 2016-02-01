<h1><b>Obituaries</b></h1>
<?php
	
	if(isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
		echo '<p>Welcome! <a href="?logout=yes">Logout!</a></p><a href="?action=addobituary">Add obituary</a> <a href=?action=control>Control panel</a>';
	}
	else if (!isset($_GET['action'])){
		echo 'Please <a href=?action=login>login</a> or <a href=?action=signup>signup</a>.';
	}
	if(isset($_GET['obituaryid'])) echo " <a href=index.php>Home</a>"; 
?>