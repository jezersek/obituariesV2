<?php
	echo "<header>";
	if(isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
		echo '<p>Welcome '. $_SESSION['name'] . '! <a href="?logout=yes">Logout!</a>';
	}
	else {
		echo 'Please <a href=?action=login>login</a> or <a href=?action=signup>signup</a>.';
	}
	echo "<h1>Obituaries</h1>";
	echo "<div class=meni>";
	echo " <a href=index.php>Home</a>"; 
	if(isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
		echo '<a class=meni href="?action=addobituary">Add obituary</a> <a class=meni href=?action=control>Control panel</a>';
	}
	echo " <a class=meni href=index.php?action=about>About</a>"; 
	echo "</div>";
	echo "</header>";
?>


