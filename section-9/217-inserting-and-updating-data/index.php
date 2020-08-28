<?php
	$link = mysqli_connect("localhost", "root", "", "users");

	if(mysqli_connect_error()) {
		die('Connection unsuccessful.');
	} 

	// Insert into table
	//$query = "INSERT INTO users (email, password) VALUES ('stillunknown@gmail.com', 'andyetanotherunsecuredpassword')";

	// Update the table
	//$query = "UPDATE users SET email = 'nobodyknows@gmail.com' WHERE id = 1 LIMIT 1";

	// Update using email address
	$query = "UPDATE users SET password = 'hejjdhuqp773j3hiu!' WHERE email = 'nobodyknows@gmail.com' LIMIT 1";

	mysqli_query($link, $query);

	$query = "SELECT * FROM users";

	if($result = mysqli_query($link, $query)) {
		$row = mysqli_fetch_array($result);
		// print_r($row);
		echo 'Your email is: '.$row['email'].', and your password is: '.$row['password'].'<br />';
	}
?>