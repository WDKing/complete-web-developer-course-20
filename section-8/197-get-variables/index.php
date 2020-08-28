<!--<?php
  print_r($_GET);
  echo "Greetings, ".$_GET['name'].".";
?>

<p>What's your name?</p>

<form>
	<input name="name" type="text">
	<input type="submit" value="Go!">
</form>
-->

<p>Enter a number:</p>
<form>
	<input name="number" type="text">
	<input type="submit" value="Determine Prime">
</form>
<br />


<?php
	/*
	$prime = true;

	$number = $_GET['number'];
	$i = $number - 1;

	while($i > 1 && $prime) {
		if($number % $i == 0) {
			$prime = false;
		}

		$i--;
	}

	if($prime) {
		echo "Yes, the number $number is prime.";
	} else {
		echo "No, the number $number is not prime.";
	}
	*/
	$isPrime = true;

	if(isset($_GET['number']) 
			&& is_numeric($_GET['number']) 
			&& $_GET['number'] > 0 
			&& $_GET['number'] == round($_GET['number'], 0)) {
		$i = 2;
		$number = $_GET['number'];

		while($i < $number && $isPrime) {
			if($number % $i == 0) {
				$isPrime  = false;
			}

			$i++;
		}

		if($isPrime) {
			echo "Yes, the number $number is prime.";
		} else {
			echo "No, the number $number is not prime.";
		}
	} else if($_GET) {
		// User submitted entry that is not positive whole number
		echo "Please enter positive whole number.";
	}

	unset($number);
?>

