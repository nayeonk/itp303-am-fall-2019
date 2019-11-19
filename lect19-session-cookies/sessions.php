<?php
	// session_start() needs to be at the top of file
	session_start();

	// Set a session - key/value pairs
	// $_SESSION["logged_in"] = true;
	// $_SESSION["username"] = "ttrojan";

	var_dump($_SESSION);

	// Display session variables using Session kys
	echo "<hr>";
	echo "Am I logged in?: " . $_SESSION["logged_in"];
	echo " Username is: " . $_SESSION["username"];

	// When done with session, 
	session_destroy();

?>