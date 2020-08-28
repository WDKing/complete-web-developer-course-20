<?php
	function postKeyAccept($key) {    
    if(array_key_exists($key, $_POST) && $_POST[$key] != '') { 
      return true;
    } else {    
      return false;    
    }
  }

  session_start();

  // Check if user wants to log out
  if(postKeyAccept('logout')) {
  	setcookie("secretDiary", "", time() - 60);
  	unset($_SESSION['secretDiary']);
    header("Location: index.php");
  }

  // Check if user has a cookie, or a session variable
  if(array_key_exists("secretDiary", $_COOKIE) && $_COOKIE['secretDiary']) {
  	$_SESSION['secretDiary'] = $_COOKIE['secretDiary'];
  } elseif (!array_key_exists('secretDiary', $_SESSION) || !$_SESSION['secretDiary']) {
  	header("Location: index.php");
  }

  $link = mysqli_connect("","","","");

  if(mysqli_connect_error()) {
    die('Connection unsuccessful.');
  } 

  $error = "";
  $diary = "";

  // Get existing diary entry
  $query = "SELECT diary FROM users WHERE email = '".mysqli_real_escape_string($link, $_SESSION['secretDiary'])."';";

  $result = mysqli_query($link, $query);

  if(mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);

    $diary .= $row['diary'];
  }

  // Insert new diary entry
  if(postKeyAccept('insertDiary')) {
		$query = "UPDATE users SET diary = '".mysqli_real_escape_string($link, $_POST['insertDiary'])."' WHERE email = '".mysqli_real_escape_string($link, $_SESSION['secretDiary'])."';";

  	if(!mysqli_query($link, $query)) {
  		$error .= "An error has occurred saving your entry.";
  	}
  }
?>

<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap Style Sheet -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <title>mySQL - Secret Diary Project - Part 2</title>

  <link rel="stylesheet" type="text/css" href="diary.css">
  <link rel="stylesheet" type="text/css" href="body.css">
</head>
<body>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <div class="container-fluid">
  	<nav class="navbar fixed-top navbar-light bg-light">
		  <a class="navbar-brand" href="">Secret Diary</a>
			<form class="form-inline" method="post">
		    <button class="btn btn-outline-success" type="submit" name="logout" value="True">Logout</button>
		  </form>
		</nav>
		<div class="form-group alert-warning" id="error-alert"><?php echo $error; ?></div>
		<div class="form-group" id="diary-entry">
	    <textarea class="form-control" id="diary-textarea" rows="15"><?php echo $diary ?></textarea>
	  </div>
  </div>

  <script type="text/javascript">
  	
  	$("#diary-textarea").keyup(function() {
      $.ajax({
        method: "post",
        url: "diary.php",
        data: { insertDiary: $("#diary-textarea").val() }
        });
  	});

  </script>

</body>
</html>