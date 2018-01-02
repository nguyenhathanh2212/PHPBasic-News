<?php
	if(!isset($_SESSION['arUser'])) {
		header("location:/admin/login.php");
	}
?>