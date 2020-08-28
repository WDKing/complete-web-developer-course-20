<?php
	require 'twitter-connect.php';
	
  $statuses = $connection->post("statuses/update", ["status" => $_POST["status"]]);

  print (json_encode($statuses));
?>