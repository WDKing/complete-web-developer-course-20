<?php
	require 'twitter-connect.php';

  $statuses = $connection->get("statuses/home_timeline", ["count" => 25, "exclude_replies" => true]);

  print (json_encode($statuses));
?>