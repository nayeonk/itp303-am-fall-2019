<?php
	// Syntax of creating cookies
	setCookie(name, value, expire, path, domain, security);

	$expiration = time() + 1000;
	// setCookie("username", "john doe", $expiration);
	// setCookie("user_age", "18", $expiration);

	// Get the cookie and display its values	
	echo "<hr>";
	echo "This user's username is: " . $_COOKIE["username"] . " and his age is " . $_COOKIE["user_age"];

?>