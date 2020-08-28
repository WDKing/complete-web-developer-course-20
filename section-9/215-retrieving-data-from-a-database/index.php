<?php
	$link = mysqli_connect("localhost", "root", "", "users");

	if(mysqli_connect_error()) {
		die('Connection unsuccessful.');
	} 

	$query = "SELECT * FROM users";

	if($result = mysqli_query($link, $query)) {
		$row = mysqli_fetch_array($result);
		// print_r($row);
		echo 'Your email is: '.$row['email'].', and your password is: '.$row['password'].'<br />';
	}
?>