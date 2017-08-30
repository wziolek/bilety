<?php
	if(session_id() == '' || !isset($_SESSION)) {
	    // session isn't started
	    session_start();
	}
	unset($_SESSION["login"]);
	unset($_SESSION["is_admin"]);
	header("Location: indexg.php");
	die();

?>