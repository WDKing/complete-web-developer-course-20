<?php
	mysqli_connect("","","");

	if(mysqli_connect_error()) {
		echo 'Connection unsuccessful.';
	} else {
		echo 'Connection successful.';
	}
?>