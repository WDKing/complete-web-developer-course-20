<?php

	// Variables that will be used
	$errorMessage = "";  // Record error messages
	$successMessage = "";  // Record success messages
	$websiteScrape = ""; // Record content of website scraped

	if($_POST) {

		try {
		  // Set error handling to catch 'Warnings' that occur 
			set_error_handler(function() {
				if(error_reporting() === 0) {
					return false;
				}

				throw new Exception("An error occurred. Please check your city name and try again.");
			});

			// Acquire the name of the city
			$cityName = $_POST['cityName'];

			// Convert spaces to dashes
			$cityNameDash = str_replace(' ', '-', $cityName);

			// Acquire website contents
			$websiteScrape = file_get_contents("http://www.weather-forecast.com/locations/{$cityNameDash}/forecasts/latest");

      // Delay 3 seconds, increases changed of having the site scrapped successfully.
			sleep(3);

			// Remove tags from website content, establish boundaries for content sought
			$strippedSite = strip_tags($websiteScrape);
			$startBoundary = $cityName.' Weather Today (1–3 days)';
			$endBoundary = $cityName.' Weather (4–7 days)';

  	  // For some reason, even thought the $strippedSite variable contains the expected
  	  // value, it is not always found.  I have not located why, but put accomodation in 
  	  // for this issue.
			if((stripos($strippedSite, $startBoundary) === false) || (stripos($strippedSite, $startBoundary) === false)) {
				throw new Exception("Error Processing Request", 1);
			}

			// Set up success message when beginning and ending boundaries are found
			$successMessage = substr(
				$strippedSite,
				stripos($strippedSite, $startBoundary) + strlen($startBoundary), 
				stripos($strippedSite, $endBoundary) - stripos($strippedSite, $startBoundary) - strlen($startBoundary)
			);
			$successMessage = '<div class="alert alert-success" role="alert">'.$successMessage.'</div>';

			restore_error_handler();
		} catch (Exception $e) {
  	  // Catch errors when issues arise, such as boundaries not found or scraping failed
			$errorMessage = $e->getMessage();
			$errorMessage = '<div class="alert alert-danger" role="alert">'.$errorMessage.'</div>';
			restore_error_handler();
		}
	}
?>

<!DOCTYPE html>
<html>
<head>

	<title>PHP Project - Weather Scraper</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<style type="text/css">
		body {
			background-image: url('./images/sharissa-johnson-oQqUucIxcz0-unsplash.jpg') !important;
			background-repeat: no-repeat;
			background-size: cover;
			height: 100%;
		}

		#header {
			margin-top: 40px;
		}
	</style>

</head>
<body>
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

  <div class="container text-center alighn-middle">
  	<br /> <br /> <br />
  	<h1 id="header">What is the Current Weather?</h1><br />
  	<p>Enter the name of a city.</p>
  	<form method="post">
  		<div class="form-group">
				<label for="contact-subject"></label>
				<input type="text" class="form-control" id="city-name" name="cityName">
			</div>
  		<button type="submit" class="btn btn-primary">Submit</button>
  	</form>
  	<br /> <br />
  	<div id="alert-box" class="alert"><?php echo $successMessage.$errorMessage; ?></div>
  </div>

</body>
</html>