<?php
	$link = mysqli_connect("localhost", "root", "", "users");

	if(mysqli_connect_error()) {
		die('Connection unsuccessful.');
	} 

	//$query = "SELECT * FROM users WHERE email LIKE '%@gmail.com' ";
  //$query = "SELECT * FROM users WHERE email LIKE '%p%' ";
  //$query = "SELECT * FROM users WHERE ID >= 2 ";
  //$query = "SELECT email FROM users";
  //$query = "SELECT * FROM users WHERE id >= 2 AND email LIKE '%t%' ";
  //$name = "Robert O'Grady";
  //$query = "SELECT * FROM users where name = '".mysqli_real_escape_string($link, $name)."'";
  /*
	if($result = mysqli_query($link, $query)) {
		while($row = mysqli_fetch_array($result)) {
		  print_r($row);
	  }
	}
	*/
	// Protect against empty strings and null values
	function hasValue($needle, $haystack) {
		if(array_key_exists($needle, $haystack) && isset($haystack[$needle]) && $haystack[$needle] != "" ) {
			return true;
		} else {
			return false;
		}
	}

	if(array_key_exists('emailAddress', $_POST) && hasValue('password', $_POST)) {
		$query = "SELECT * FROM users WHERE email = '".mysqli_real_escape_string($link, $_POST['emailAddress'])."'";

		if($array = mysqli_query($link, $query)) {
			// mysqli_num_rows($result) // Checks how many rows, if any exists, it was found
			if($row = mysqli_fetch_array($array)) {
				echo 'User found, welcome back';
				echo print_r($array);
				echo print_r($row);
			} else {
				echo 'Email address not found, creating new account.';
				$query = "INSERT INTO users (email, password) VALUES ('".mysqli_real_escape_string($link, $_POST['emailAddress'])."', '".mysqli_real_escape_string($link, $_POST['password'])."')";
				mysqli_query($link, $query);
			// TODO Create new entry in database
			}
		}
	}

	

?>

<!DOCTYPE html>
<html>
<head>
	<title>mySQL - Looping through Data</title>
</head>
<body>
	<form method="post">
		<label>Enter Email Address:</label>
		<input type="email" name="emailAddress"><br>
		<label>Enter Password:</label>
		<input type="password" name="password">
		<button id="submit">Submit</button>
	</form>
</body>
</html>