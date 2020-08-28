<?php

	// Level 3 password encryption
	//$salt = "wioididhfhidioslksskjdj";
  //echo md5($salt."password");

$row['id'] = 73;
echo md5(md5($row['id'])."password");

?>