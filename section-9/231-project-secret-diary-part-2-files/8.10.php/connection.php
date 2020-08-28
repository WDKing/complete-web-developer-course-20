<?php

		$link = mysqli_connect("localhost", "root", "", "secret-diary");
        
        if (mysqli_connect_error()) {
            
            die ("Database Connection Error");
            
        }

?>