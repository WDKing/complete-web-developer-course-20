<?php
	require "twitteroauth-1.0.1/autoload.php";

	use Abraham\TwitterOAuth\TwitterOAuth;

	define ('CONSUMER_KEY', "");
	define ('CONSUMER_SECRET', ""); 
	define ('ACCESS_TOKEN', "");
	define ('ACCESS_TOKEN_SECRET', "");  

	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
  $content = $connection->get("account/verify_credentials");

  $statues = $connection->post("statuses/update", ["status" => "This tweet created by a very simplistic php file so called Application."]);

  print_r($statues);

  $statuses = $connection->get("statuses/home_timeline", ["count" => 25, "exclude_replies" => true]);

  print_r($statuses);
?>