<?php

	session_start();

  if(array_key_exists('email', $_POST) OR array_key_exists('password', $_POST)) {
	  $link = mysqli_connect("localhost", "root", "", "users");

	  if(mysqli_connect_error()) {
		  die('Connection unsuccessful.');
	  } 

	  if($_POST['email'] == '') {
	  	echo 'Email address is required.';
	  } else if ($_POST['password'] == '') {
	  	echo 'Password is required.';
	  } else {
	  	$query = "SELECT id FROM users WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."'";

	  	$result = mysqli_query($link, $query);

	  	if(mysqli_num_rows($result) > 0) {
	  		echo 'That email address has already been used.  Please choose another.';
	  	} else {
	  		$query = "INSERT INTO users (email, password) VALUES ('".mysqli_real_escape_string($link, $_POST['email'])."', '".mysqli_real_escape_string($link, $_POST['password'])."');";

	  		if(mysqli_query($link, $query)) {
	  			echo "Account created. Rerouting to account page.";
	  			$_SESSION['email'] = $_POST['email'];
	  			header("Location: session.php");
	  		} else {
	  			echo "There was a problem creating your account. Please try again later.";
	  		}
	  	}
	  }
  }
?>

<!DOCTYPE html>
<html>
<head>
	<title>mySQL - Session Variables</title>
</head>
<body>
  <form method="post">
  	<input type="email" name="email" placeholder="Email Address">
  	<input type="password" name="password" placeholder="Password">
  	<input type="submit" name="Submit">
  </form>
</body>
</html>