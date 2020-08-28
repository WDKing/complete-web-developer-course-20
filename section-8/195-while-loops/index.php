<?php
  $i = 0;

  while($i < 10) {
  	echo $i."<br />";
  	$i++;
  }

  $j = 0;

  while($j < 10) {
  	$l = $j * 5;
  	echo $l."<br />";
  	$j++;
  }

  $k = 0;
  $mantArray = array("Stingray","Rajiformes","Batoids","Skate");

  while($k < sizeof($mantArray)) {
  	echo $mantArray[$k]."<br />";
  	$k++;
  }
?>