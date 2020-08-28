<?php
	include("functions.php");

	if (array_key_exists('action', $_GET) && $_GET['action'] == "loginSignup") {

		$error = "";

		if(!$_POST['email']) {
			$error .= "<p>An email address is required.</p>";
		} else if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
			$error .= "<p>A properly formatted email address is required.</p>";
		}
		if(!$_POST['password']) {
			$error .= "<p>A password is required.</p>";
		}
		if($error != "") {
			$error = "<p>There are some problems with your submission, please check your entry and try again:</p>" . $error;
			echo $error;
			exit();
		}

		if($_POST['loginActive'] == "0") {
			$query = "SELECT * FROM users WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";		
			$result = mysqli_query($link, $query);

			if(mysqli_num_rows($result) > 0) {
				$error = "That email address is already taken.";
			} else {
				$query = "INSERT INTO users (email, password) VALUES ('".mysqli_real_escape_string($link, $_POST['email'])."','".password_hash($_POST['password'], PASSWORD_DEFAULT)."')";

				if(mysqli_query($link, $query)) {
					echo 1;

					$_SESSION['id'] = mysqli_insert_id($link);
				} else {
					$error = "Couldn't create user - please try again later.";
				}
			} 
		} else {
			$query = "SELECT * FROM users WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";		
			$result = mysqli_query($link, $query);
			$row = mysqli_fetch_assoc($result);

			if(password_verify($_POST['password'], $row['password'])) {
				echo 1;

				$_SESSION['id'] = $row['id']; 
			} else {
				$error .= "Could not find that username/password combination. Please try again.";
			}
		}

		if($error != "") {
			echo $error;
			exit();
		}
	}

	if(array_key_exists('action', $_GET) && $_GET['action'] == "toggleFollow") {
		$query = "SELECT * FROM isfollowing WHERE follower = ".mysqli_real_escape_string($link, $_SESSION['id'])." AND isFollowing = ".mysqli_real_escape_string($link, $_POST['userId'])." LIMIT 1";
		$result = mysqli_query($link, $query);
		if(mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			mysqli_query($link, "DELETE FROM isfollowing WHERE id = ".mysqli_real_escape_string($link, $row['id'])." LIMIT 1");
			echo "1";
		} else {
			mysqli_query($link, "INSERT INTO isfollowing (follower, isFollowing) Values(".mysqli_real_escape_string($link, $_SESSION['id']).", ".mysqli_real_escape_string($link, $_POST['userId']).")");
			echo "2";
		}
	}

?>