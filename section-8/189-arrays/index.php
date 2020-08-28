<?php
  $myArray = array("Alpha","Bravo","Charlie","Delta");
  $myArray[] = "Echo";
  print_r($myArray);

  echo "<br />";
  echo $myArray[0];

  $yourArray[0] = "Pastrami";
  $yourArray[1] = "Manacoti";
  $yourArray[5] = "Ravioli";
  $yourArray["My Favorite Food"] = "Pizza";
  $yourArray[] = "Hamburger";
  echo "<br />";
  print_r($yourArray);

  $mantArray = array(
  	  "France" => "French", 
  	  "Japan" => "Japanese", 
  	  "Spain" => "Spanish", 
  	  "United States of America" => "English");
  echo "<br />";
  print_r($mantArray);
  unset($mantArray["France"]);

  echo sizeof($mantArray);
?>