<!DOCTYPE html>
<html>
<head>

	<title>PHP - Mini-Project - Contact Form</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</head>
<body>
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

	<div class="container">
		<h1>Contact Us</h1>
		<div id="validation-error" class="alert alert-danger" role="alert"></div>
		<div id="validation-success" class="alert alert-success" role="alert">
			Your message has been sent, we will get in touch with you as quickly as we can.
		</div>	
		<form id="submit-form" method="post">
			<div class="form-group">
				<label for="email-address">Email Address</label>
				<input type="text" class="form-control" id="email-address" name="emailAddress" placeholder="email@example.com">
			</div>
			<div class="form-group">
				<label for="contact-name">Name:</label>
				<input type="text" class="form-control" id="contact-name" name="contactName" placeholder="Please enter your name">
			</div>
			<div class="form-group">
				<label for="contact-subject">Subject:</label>
				<input type="text" class="form-control" id="contact-subject" name="contactSubject" placeholder="Summary of the contact reason">
			</div>
			<div class="form-group">
				<label for="contact-body" class="form-control-plaintext">How can we help you?</label>
				<textarea class="form-control" id="contact-body" name="contactBody" rows="3"></textarea>
			</div>
			<button type="submit" class="btn btn-primary mb-2">Submit</button>
		</form>
	</div>

	

	<script type="text/javascript">

		$("#validation-error").hide();
		$("#validation-success").hide();

		// Instructor copied from stack overflow
		function isEmail(email) {
			var regex = /^[a-zA-Z0-9_.+-]+\@+[a-zA-Z0-9-]+\.+[a-zA-Z0-9]{2,4}$/;
			return regex.test(email);
		}

		$("#submit-form").submit(function() {
			var errorMessage = "";
			var fieldsMissing = "";

			$("#validation-error").html("");

			if($("#email-address").val() == "") {
				fieldsMissing += "<p>Email Address</p>";
			}

			if($("#contact-name").val() == "") {
				fieldsMissing += "<p>Contact Name</p>";
			}

			if($("#contact-subject").val() == "") {
				fieldsMissing += "<p>Subject</p>";
			}

			if($("#contact-body").val() == "") {
				fieldsMissing += "<p>Message Body</p>";
			}

			if(fieldsMissing != "") {
				errorMessage += "<p>The following fields are missing:</p>" + fieldsMissing;
			} else {

				if(!isEmail($("#email-address").val())) {
					errorMessage += "Your email address is not valid.";
				}
			}

			if(fieldsMissing != "") {
				$("#validation-error").html(errorMessage);
				$("#validation-error").show();
				return false;
			} else if(errorMessage != "") {
			  $("#validation-error").html(errorMessage);
				$("#validation-error").show();
				return false;
			} else { 
				$("#validation-success").show();
			}
		});

	</script>
</body>
</html>

<?php
	include 'phpmailer-with-vitals.php';

	try {

		if(isset($_POST['emailAddress'])
				&& filter_var($_POST['emailAddress'], FILTER_VALIDATE_EMAIL)
				&& isset($_POST['contactName'])
			  && isset($_POST['contactSubject'])
			  && isset($_POST['contactBody'])) {

			// Function Using PHPMail to send email.  Saved in second file to prevent email and password information from being submitted to GitHub.
		  usePHPMailer($_POST['emailAddress'],
								   $_POST['contactName'],
								   $_POST['contactSubject'],
								   $_POST['contactBody']);
?>

<script type="text/javascript">
  $("#validation-success").show();
</script>

<?php 
		} else {

		}
  } catch (exception $e) {
?>

<script type="text/javascript">
	$("#validation-error").html("Message failed to send.  Please try again. <br />If issue continue to occur please try to contact us another way.");
	$("#validation-error").show();
</script>

<?php
  }

?>