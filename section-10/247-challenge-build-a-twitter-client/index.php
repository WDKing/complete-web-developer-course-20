<?php
	
?>

<!DOCTYPE html>
<html>
<head>
	<!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

  <!-- jQuery CDN -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<title>API Project - Twitter Client</title>

	<link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>

	<div class="container" id="container">
		<h2 class="contrast-text-color">My Popular Tweets</h3>
		<p class="contrast-text-color">View the most popular tweets on your wall.</p>
		<div class="form-group row" id="tweet-form">
			<div class="input-group">
				<input type="text" class="form-control width100" name="tweet" id="tweet" placeholder="What would you like to say?">
				<span class="input-group-btn">
					<button class="btn btn-primary" id="submit-button">Tweet!</button>
				</span>
			</div>
		</div>
		<div id="submit-notice"></div>
		<button class="btn btn-light row" id="refresh-tweets-btn">Refresh tweets</button>
		<div class="form-control row" id="popular-tweets"></div>
	</div>

	<!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

  <script type="text/javascript">
  	var favoriteCount = 2;

  	function refreshTweetStorm() {
  		$.ajax({
  			url: "twitter-get-tweets.php",
  			type: "get",
  			success: function(data) {			
  				var tweetStorm = "";
  				var jsonTweets = JSON.parse(data);

  				for (tweet in jsonTweets) {
console.log(jsonTweets[tweet]);  					
  					if(jsonTweets[tweet]["favorite_count"] > favoriteCount) {
  						tweetStorm += '<blockquote class="tweet-body"><p>' + jsonTweets[tweet]["text"] + '</p>&mdash; ' + jsonTweets[tweet]["user"]["name"] + ' (@' + jsonTweets[tweet]["user"]["screen_name"] + ') <a href="https://twitter.com/realDonaldTrump/status/' + jsonTweets[tweet]["id_str"] + '">' + jsonTweets[tweet]["created_at"] + '</a></blockquote>' + '<br>';
  					}
  				}

  				$("#popular-tweets").html(tweetStorm);
  			}
  		}); 
  	}

  	$("#refresh-tweets-btn").click( refreshTweetStorm );

  	$("#submit-button").click(function() {
  		$.ajax({
  			url: "twitter-post-tweets.php",
  			type: "post",
  			data: {"status": $("#tweet").val()},
  			success: function(data) {
  				var jsonResults = JSON.parse(data);
  				if(jsonResults["errors"]) {
  					$("#submit-notice").html('<span class="row alert alert-danger" role="alert">An error occurred: ' + jsonResults["errors"][0]["message"] + '</span>');
  				} else {
  					$("#submit-notice").html('<span class="row alert alert-success" role="alert">Successfully submitted.</span>');
  				}
  			}
  		})
  	});

  	refreshTweetStorm();

  </script>

</body>
</html>