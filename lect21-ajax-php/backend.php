<?php
	$php_array = [
		"first_name" => "Tommy",
		"last_name" => "Trojan",
		"age" => 21,
		"phone" => [
			"cell" => "123-123-1234",

			"home" => "456-456-4567"
		],
	];

	// json_encode converts assoc. array into a STRING that is in JSON format
	// echo json_encode($php_array);

	// Backend can get what frontend passed them using superglobals like $_GET or $_POST
	// echo json_encode($_POST["firstName"]);

	// var_dump("dumping");

	$host = "303.itpwebdev.com";
	$user = "nayeon_db_user";
	$pass = "uscItp2019!";
	$db = "nayeon_song_db";

	$mysqli = new mysqli($host, $user, $pass, $db);
	if ( $mysqli->errno ) {
		echo $mysqli->error;
		exit();
	}

	// Get the search term using $_GET
	$searchTerm = $_GET["term"];

	$sql = "SELECT * FROM tracks WHERE name LIKE '%" . $searchTerm . "%' LIMIT 10;";

	$results = $mysqli->query($sql);
	if ( !$results ) {
		echo $mysqli->error;
		exit();
	}
	$mysqli->close();

	// Create an empty array that will be passed to frontend.html
	$results_array = [];

	// Run through results, store them in the $results_array
	while( $row = $results->fetch_assoc() ) {
		array_push( $results_array, $row );
	}

	// Convert this associative array to JSON string and echo it back to frontend.html
	echo json_encode($results_array);



?>




