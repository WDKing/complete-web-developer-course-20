<?php
	session_start();

  if(array_key_exists('logout', $_POST)) {
  	setcookie("secretDiary", "", time() - 60);
  	unset($_SESSION);
    header("Location: index.php");
  }

  if(array_key_exists("secretDiary", $_COOKIE)) {
  	$_SESSION['secretDiary'] = $_COOKIE['secretDiary'];
  } elseif (!array_key_exists('secretDiary', $_SESSION)) {
  	header("Location: index.php");
  }

  echo "You are logged in.";
?>

<!DOCTYPE html>
<html>
<head>
	<title>mySQL - Secret Diary 1 - Logged In</title>
</head>
<body>
	<form method="post">
		<input type="submit" name="logout" value="Logout">
	</form>
</body>
</html>
