<p>Enter your name:</p>
<form method="post">
  <input name="name" type="text">
  <input type="submit" value="Submit Name">
</form>
<br />

<?php
  $authPerson = array("Michaela Johnson", "James Peterson", "Phillip Jacobson", "Victor Bradley");

  if ($_POST) {
  	$invalid = true;
  	$i = 0;

    //echo print_r($_POST);

  	/*
  	// While we do not have a match
  	while($invalid && $i < sizeof($authPerson)) {
  	  if($_POST['name'] == $authPerson[$i]) {
  	  	$invalid = false;
  	  }
  	  $i++;
  	}
  	*/

  	foreach($authPerson as $value) {
  		if($value == $_POST['name']) {
  			$invalid = false;
  		}
  	}

  	if($invalid) {
  		echo "<p>I do not recognize your authorization entry.</p>";
  	} else {
  		echo "<p>Welcome ".$_POST['name']."!</p>";
  	}

  }
?>

