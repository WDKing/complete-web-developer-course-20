<?php
	// Set cookie
	setcookie("customerId", "1234", time() + 60 * 60 * 24);

	// Remove the cookie
	//setcookie("customerId", "", time() - 60 * 60);

	$_COOKIE["customerId"] = "test";

	echo $_COOKIE["customerId"];
?>