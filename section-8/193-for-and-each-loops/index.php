<?php
  for($i = 0; $i < 10; $i++) {
  	echo $i."<br />";
  }

  for($i = 2; $i <= 30; $i = $i + 2) {
  	echo $i."<br />";
  }

  for($i = 10; $i >= 0; $i--) {
  	echo $i."<br />";
  }

  $food = array("Pizza","Hamburger","Pasta");
  for($i = 0; $i < sizeof($food); $i++) {
  	echo $food[$i]."<br \>";
  }
  foreach($food as $key => $value) {
  	$food[$key] = $value." per Civil.";
  	echo "Array item $key is $value.<br />";
  }
  unset($value);
  print_r($food);
?>