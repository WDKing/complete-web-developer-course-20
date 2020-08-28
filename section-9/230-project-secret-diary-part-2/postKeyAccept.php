<?php
	function postKeyAccept($key) {    
    if(array_key_exists($key, $_POST) && $_POST[$key] != '') {     
      return true;
    } else {
      return false;    
    }
  }
?>