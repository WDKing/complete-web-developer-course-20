<?php
  $user = "Myself";
  if($user == "Myself") {
    echo "Welcome, Myself!";
  } else {
  	echo "Who are you?";
  }

  echo "<br />";

  $age = 18;

  if($age >= 18 && $user = "Myself") {
  	echo "You may enter.";
  } else {
  	echo "You may not enter.";
  }
?>