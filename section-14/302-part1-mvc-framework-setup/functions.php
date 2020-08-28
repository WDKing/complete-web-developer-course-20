<?php
	session_start();

	include("../../database-credentials.php");

	$link = mysqli_connect(DATABASE_PATH, DATABASE_USER, DATABASE_PASSWORD, DATABASE_NAME);
        
  if (mysqli_connect_error()) {
    print_r("Database Connection Error");
    exit();
  }

  if(array_key_exists('function', $_GET) && $_GET['function'] == "logout") {
  	session_unset();
  }

?>