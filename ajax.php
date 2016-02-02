<?php
require_once('/class/ObituariesList.php');
$osmrtnice = array();
$listOfObituaries = new ObituariesList();
for($i = $_POST['start']; $i < ($_POST['start']+$_POST['limit']); $i++) {
	$tmp = $listOfObituaries -> getObituaryByIndex($i);
	
	if (!is_object($tmp) && $tmp == -1) { break; }

	$osmrtnice[] = array(
		'id' => $tmp->getId(),
		'name' => $tmp->getObituaryName(),
		'lastname' => $tmp->getObituaryLastName(),
		'religion' => $tmp->getObituaryReligion(),
		'dateOfBirth' => date("d.m.Y", strtotime($tmp->getObituaryDateOfBirth())),
		'dateOfDeath' => date("d.m.Y", strtotime($tmp->getObituaryDateOfDeath()))
	);
	
}
echo json_encode($osmrtnice);
?>
