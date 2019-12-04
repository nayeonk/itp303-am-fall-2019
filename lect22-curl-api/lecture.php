<?php

/********************
 *
 * json_encode():	PHP Array => JSON String
 *
 ********************/

$php_array = [
	"first_name" => "Michael",
	"last_name" => "Scott",
	"age" => 40,
	"phone" => [
		"cell" => "123-123-1234",

		"home" => "456-456-4567"
	],
];

echo $php_array["first_name"];
echo "<hr>";
echo $php_array["phone"]["cell"];
echo "<hr>";


// Convert php array to JSON string
echo json_encode($php_array);
// Once it's convereted to string, JS can convert JSON string into JS objects



/********************
 *
 * json_decode():	JSON String => PHP Array / PHP Object
 *
 ********************/

$json = 
'{
	"first_name": "Michael",
	"last_name": "Scott",
	"age": 40,
	"phone": {
		"cell": "123-123-1234",
		"home": "456-456-4567"
	}
}';

echo "<hr>";
// Can't do this in PHP
// echo $json.first_name;

// To use this data in PHP, need to convert JSON string into something that PHP can read
// Two options 1) associative array OR 2) PHP objects (use second parameter to determine which)
$decoded = json_decode($json, true);
var_dump($decoded);
echo "<hr>";
echo $decoded["first_name"];
echo $decoded["age"];
echo $decoded["phone"]["cell"];

// Convert JSON to PHP objects
echo "<hr>";
$decoded_object = json_decode($json, false);
var_dump($decoded_object);
echo "<hr>";
echo $decoded_object->first_name;
echo $decoded_object->age;
echo $decoded_object->phone->cell;

/********************
 *
 * cURL & iTunes API
 *
 ********************/

// Create a constant to define the iTunes Endpoint
define("ITUNES_API_ENDPOINT", "https://itunes.apple.com/search");


// Initialize cURL
$curl = curl_init();

// Set curl options
curl_setopt($curl, CURLOPT_URL, ITUNES_API_ENDPOINT . "?term=beatles&limit=5");
// Verifies the authenticity of the peer's SSL certificate
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
// Returns the data instead of printing it to the page
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);


// Execute aka make the request to the API
$response = curl_exec($curl);

// Get a response and display it
// The response is JSON string
echo "<hr>";
var_dump($response);
echo "<hr>";

// Convert to array
$response = json_decode($response, true);
var_dump($response);
echo "<hr>";
echo $response["resultCount"];
echo $response["results"][0]["trackName"];

// Close curl
curl_close($curl);












?>








