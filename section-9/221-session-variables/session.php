<?php
	session_start();

	if(array_key_exists('email', $_SESSION)) {
		echo "You are logged in.";
	} else {
		header("Location: index.php");
	}
?>