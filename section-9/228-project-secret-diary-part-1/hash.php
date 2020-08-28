<?php

	//echo password_hash("password", PASSWORD_DEFAULT);

	// Generate a hash of the password "mypassword"
	$hash = password_hash("admin", PASSWORD_DEFAULT);
	 
	// Echoing it out, so we can see it:
	echo $hash;
	echo "<br /><br />";
	echo password_hash("Admin", PASSWORD_DEFAULT);
	 

?>