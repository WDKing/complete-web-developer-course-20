<?php
	require "apikey.php";

	// Variables that will be used
	$error = "";  // Record error messages
	$success = "";  // Record success messages
	$weather = "";  // Returned Json response

	// Default error message
	$errorMessage = '<div class="alert alert-danger" role="alert">There was an error trying to get the weather for your city.<br>Please check your spelling, or try again later.</div>';

	if(array_key_exists('cityName', $_GET)) {
		$webLocation = "http://api.openweathermap.org/data/2.5/weather?q=".urlencode($_GET['cityName'])."&appid=".$apikey."";

		// Test to see if the file exists before trying to acquire
		// Had to add the try-catch block, because while in the video the 
		// file_get_contents did not thrown a warning when there is no valid 
		// address, it now is throwing warnings. 
		try {
			set_error_handler(
		    function ($severity, $message, $file, $line) {
		   		throw new ErrorException($message, $severity, $severity, $file, $line);
		    }
			);

			// Acquire source material to work with
			$weatherJson = file_get_contents($webLocation);
			$weatherArray = json_decode($weatherJson, true);

				if($weatherArray['cod'] == 200) {

				// Acquire components of the weather to be displayed.
				$farenheit = round(1.8 * ($weatherArray['main']['temp'] - 273.15) + 32);
				$windSpeed = round($weatherArray['wind']['speed'] / .621371, 2);
				$windDirection = $weatherArray['wind']['deg'];

				// Create the weather display.
				$weather .= "The weather in ".$_GET['cityName']." is currently '".$weatherArray['weather'][0]['description']."'.<br> The temperature is ".round($farenheit)."&deg;F.<br> Wind speed is ".$windSpeed." mph, heading ".$windDirection."&deg;.";

				$success .= '<div class="alert alert-success" role="alert">'.$weather.'</div>';
			} else {
				$error = $errorMessage;
			}

		} catch (exception $e) {
			$error = $errorMessage;
		}
	
		restore_error_handler();
	}
?>

<!DOCTYPE html>
<html>
<head>

	<title>API Lesson - What's the Weather?</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<style type="text/css">
		body {
			background-image: url('./images/sharissa-johnson-oQqUucIxcz0-unsplash.jpg') !important;
			background-repeat: no-repeat;
			background-size: cover;
			background-position: center;
			background-attachment: fixed;
			height: 100%;
			display: flex;
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
  	<form method="get">
  		<div class="form-group">
				<label for="contact-subject"></label>
				<input type="text" class="form-control" id="city-name" name="cityName">
			</div>
  		<button type="submit" class="btn btn-primary">Submit</button>
  	</form>
  	<br /> <br />
  	<div id="alert-box" class="alert"><?php echo $success.$error; ?></div>
  </div>

</body>
</html>