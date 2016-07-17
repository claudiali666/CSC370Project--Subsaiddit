<?php
// Function for connecting to the saiddit database

function db_connect() {

    $host = "localhost:3306";
    $user = "root";
    $pass = "";
    $db = "csc370 Project";

    // Connect to mysql using subsaiddit_sys user
    $link= mysqli_connect($host, $user, $pass, $db);
    
    if (!$link) {
	    echo "Error: Unable to connect to MySQL." . PHP_EOL;
	    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
	    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
	    exit;
	}

       return $link;
	}

?>
