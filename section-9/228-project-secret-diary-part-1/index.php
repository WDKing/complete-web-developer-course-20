<?php
	session_start();
	// Checks status of provided key to check if present in $_POST and not an empty string
	function postKeyAccept($key) {		
		if(array_key_exists($key, $_POST) && $_POST[$key] != '') {
			return true;
		} else {
			return false;
		}
	}

	// Check for Cookies - Auto-login
	if(array_key_exists("secretDiary", $_COOKIE) || array_key_exists('diary', $_SESSION)) {
		header("Location: diary.php");
	}

	### Check conditions of Registration and Login Email and Passwords
  // Acceptable Login Credentials
	if(postKeyAccept('emailLogin') && postKeyAccept('passwordLogin')) {
		// Create connection to the database and confirm successful connection.
		$link = mysqli_connect("localhost", "root", "", "secret-diary");

		if(mysqli_connect_error()) {
			die('Connection unsuccessful.');
		} 

		$query = "SELECT * FROM users WHERE email = '".mysqli_real_escape_string($link, $_POST['emailLogin'])."'";

		$result = mysqli_query($link, $query);

		// If there are query results, the email address exists
		if(mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_array($result);

			if(password_verify($_POST['passwordLogin'], $row['password'])) {
				// If the login is successful, and the user wants to be remembered, create a cookie
				if(array_key_exists('rememberLogin', $_POST)) {
					setcookie("secretDiary", '"'.$_POST['emailLogin'].'"', time() + 60 * 60 * 24);
				}
				$_SESSION['secretDiary'] = $_POST['emailLogin'];
				header("Location: diary.php");
			} else {
				echo "Invalid email address or password, please try again.";
			}
		// Else no email address found
		} else {
			echo "Invalid email address or password, please try again.";
		}
	// Acceptable Registration Credentials  
	} elseif(postKeyAccept('emailRegister') && postKeyAccept('passwordRegister')) {
		// Create connection to the database and confirm successful connection.
		$link = mysqli_connect("localhost", "root", "", "secret-diary");

		if(mysqli_connect_error()) {
			die('Connection unsuccessful.');
		} 

		$query = "SELECT * FROM users WHERE email = '".mysqli_real_escape_string($link, $_POST['emailRegister'])."'";
		$result = mysqli_query($link, $query);

		if(mysqli_num_rows($result) == 0) {

			$query = "INSERT INTO users (email, password) VALUES ('".mysqli_real_escape_string($link, $_POST['emailRegister'])."', '".password_hash($_POST['passwordRegister'], PASSWORD_DEFAULT)."');";

			if(mysqli_query($link, $query)) {
			    // If the login is successful, and the user wants to be remembered, create a cookie
				if(array_key_exists('rememberRegister', $_POST)) {
					setcookie("secretDiary", '"'.$_POST['emailLogin'].'"', time() + 60 * 60 * 24);
				}
				$_SESSION['secretDiary'] = $_POST['emailLogin'];
				header("Location: diary.php");
			} else {
				echo 'A problem occurred creating the account.  Please try again later.';
			}
		}	else {
			echo 'Email address is already taken.';	  	
		}
	}
	### If no acceptable login or registration entered provide error message
	### Note: All items check because entry of Login and Registration is 
	###   currently available. Intensive checks not needed as much when login and
	###   registration screens will be flipped in next step of the project.
	// If no acceptable password
	elseif ( ( postKeyAccept('emailLogin') && !postKeyAccept('passwordLogin') )
	    || ( postKeyAccept('emailRegister') && !postKeyAccept('passwordRegister') ) ) {
		echo "There was an error with your form:<br>Password is Required.<br>";
	} 
  // If no acceptable email address
	elseif ( ( !postKeyAccept('emailLogin') && postKeyAccept('passwordLogin') )
	    || ( !postKeyAccept('emailRegister') && postKeyAccept('passwordRegister') ) ) {
		echo 	"There was an error with your form:<br>Email Address is Required.<br>";
	} 
  // If no valid email address or passwords
	elseif( ( !postKeyAccept('emailLogin') && !postKeyAccept('passwordLogin') )
	    || ( !postKeyAccept('emailRegister') && !postKeyAccept('passwordRegister') ) ) {
		echo "There was an error with your form:<br>Email Address is Required.<br>Password is Required.<br>";
	} 
?>

<!DOCTYPE html>
<html>
<head>
	<title>mySQL Project - Secret Diary 1</title>
</head>
<body>

	<form method="post">
		<input type="email" name="emailLogin" placeholder="Email Address">
		<input type="password" name="passwordLogin" placeholder="Password">
		<input type="checkbox" name="rememberLogin">
		<input type="submit" value="Login">
	</form>
	<form method="post">
		<input type="email" name="emailRegister" placeholder="Email Address">
		<input type="password" name="passwordRegister" placeholder="Password">
		<input type="checkbox" name="rememberRegister">
		<input type="submit" name="submitRegister" value="Register">
	</form>

</body>
</html>