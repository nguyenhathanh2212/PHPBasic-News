<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/header.php";
	session_destroy();
	header("location:login.php");
	require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/footer.php";
?>