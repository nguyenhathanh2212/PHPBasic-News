<?php require_once $_SERVER['DOCUMENT_ROOT'].'/functions/dbconnect.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/functions/checkuser.php" ?>
<?php
	$slide = $_POST['act'];
	$id = $_POST['aid'];
	$query = "UPDATE news SET is_slide={$slide} WHERE id='{$id}'";
	$mySQLI->query($query);
	$mySQLI->close();
	echo $id;
?>