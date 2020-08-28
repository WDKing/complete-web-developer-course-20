<!doctype html>
<html lang="en" class="h-100">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

  <title>Tweeter, for Tweetering</title>

  <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body class="d-flex flex-column h-100">

	<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
		<a class="navbar-brand" href="http://localhost/section-14/306-part5-searching-and-viewing-profiles/">Tweeter</a>
		<ul class="navbar-nav mr-auto">
			<li class="nav-item">
				<a class="nav-link" href="?page=timeline">Your Timeline</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="?page=yourtweets">Your Tweets</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="?page=publicprofiles">Public Profiles</a>
			</li>
		</ul>
		<div class="form-inline my-2 my-lg-0">
			<?php if(array_key_exists('id',$_SESSION) && $_SESSION['id'] != '') { ?>
				<a class="btn btn-outline-success my-2 my-sm-0" href="?function=logout">Logout</a>
			<?php } else { ?>
				<button  class="btn btn-outline-success my-2 my-sm-0" data-toggle="modal" data-target="#login-modal">Login/Sign Up</button>
			<?php } ?>
		</div>
	</nav>


	