<?php
	require "twitteroauth-1.0.1/autoload.php";
	require "../../twitter-authentication.php";

	use Abraham\TwitterOAuth\TwitterOAuth; 

	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
  $content = $connection->get("account/verify_credentials");
?>