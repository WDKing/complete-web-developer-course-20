<?php
  $greetings = "Greetings!<br />";

  echo $greetings;

  $string1 = "Welcome &";
  $string2 = "Salutations.<br />";
  echo $string1." ".$string2;

  $myNumber = 45;
  $calculation = $myNumber * 31 / 97 + 4;
  echo "The result of the calcuation: ".$calculation."<br />";

  $myBool = true;
  echo "<p>This statement is true? ".$myBool."</p>"; 

  $variable = "greetings";
  echo $$variable;
?>