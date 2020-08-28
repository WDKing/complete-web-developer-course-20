<?php
	include("actions.php");
	include("views/header.php");
	if (array_key_exists('page', $_GET) && $_GET['page'] == 'timeline') {
		include("views/timeline.php");
	} else if (array_key_exists('page', $_GET) && $_GET['page'] == 'yourtweets') {
		include("views/your-tweets.php");
	} else if (array_key_exists('page', $_GET) && $_GET['page'] == 'publicprofiles') {
		include("views/public-profiles.php");
	} else if (array_key_exists('page', $_GET) && $_GET['page'] == 'search') {
		include("views/search.php");
	} else {
		include("views/home.php");
	}
	include("views/footer.php");
?>

