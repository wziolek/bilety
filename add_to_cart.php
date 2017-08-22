<?php
	session_start();
	print_r($_POST);
	//echo();
	$_SESSION["test"] = 1;
	$_SESSION["tickets"]=$_POST["ticket"];
	print_r($_SESSION["tickets"]);
?>