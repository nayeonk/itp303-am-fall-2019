<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Intro to PHP</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">Intro to PHP</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->

<div class="container">
<div class="row">

<h2 class="col-12 mt-4 mb-3">PHP Output</h2>

<div class="col-12">
<!-- Display Test Output Here -->
<?php
	// Write PHP here

	echo "<strong>Hello World</strong>";
	echo "<hr>";

	// Variables
	$name = "Tommy";
	$age = 18;

	echo $name;
	echo "<hr>";

	// Check if a variable exists or is empty
	if( isset($name) && !empty($name) ) {
		echo $name;
	}
	else {
		echo "No name";
	}

	echo "<hr>";

	// var_dump is useful when debugging - tells you more info about the variable
	var_dump($name);
	echo "<hr>";

	// To concatenate use period (.)
	echo "My name is " . $name . ".";
	echo "<hr>";

	// With double quotes you could do this - variable interpolation.
	echo "My name is $name";
	echo "<hr>";


	// Single quotes turn OFF variable interpolation
	echo 'My name is $name';
	echo "<hr>";

	// With double quotes you can escape sequences
	echo "Double quotes \" ";

	// Date/time
	// set time zone
	date_default_timezone_set('America/Los_Angeles');

	echo "<hr>";
	echo date("m-d-y g:i:s");
	echo "<hr>";

	// Arrays
	$colors = ["red", "blue", "green"];
	var_dump($colors);
	echo "<hr>";

	// For loop
	for( $i = 0; $i < sizeof($colors); $i++ ) {
		echo $colors[$i] . ", " ;
	}

	echo "<hr>";

	// Associative Arrays - arrays with string keys
	$courses = [
		"ITP 303" => "Full-Stack Web Development",
		"ITP 404" => "Advanced Front-End",
		"ITP 405" => "Advanced Back-End"
	];

	$states = [
		"CA" => "California",
		"WA" => "Washington",
		"NY" => "New York"
	];

	// Instead of accessing array elements using indexes like this:
	// echo $courses[0];

	// Use the keys 
	echo $courses["ITP 303"];

	$tmpCourseName = "ITP 404";

	echo "<hr>";
	echo $courses[$tmpCourseName];
	echo "<hr>";

	// To loop through associative arrays, use foreach
	foreach( $courses as $courseNumber => $courseName ) {
		echo $courseNumber . ": " . $courseName;
		echo "<br>";
	}
	echo "<hr>";
	// Also common, echo out only the values (not the keys)
	foreach ($courses as $courseName) {
		echo $courseName;
		echo "<br>";
	}
	// Older syntax to create arrays
	$numbers = array(1,2,3,4);
	$numbers = [1,2,3,4];


	// Superglobal - a variable that is always available
	echo "<hr>";
	var_dump($_SERVER);
	echo "<hr>";
	echo $_SERVER["HTTP_USER_AGENT"];

	// $_GET & $_POST
	echo "<hr>";
	echo "<strong>GET superglobal:</strong> <br/>";
	var_dump($_GET);

	echo "<hr>";
	echo "<strong>POST superglobal:</strong> <br/>";
	var_dump($_POST);

?>


</div>

</div> <!-- .row -->
</div> <!-- .container -->

	<div class="container">
		<div class="row">

			<h2 class="col-12 mt-4">Form Data</h2>

		</div> <!-- .row -->

		<div class="row mt-3">
			<div class="col-3 text-right">Name:</div>
			<div class="col-9">
<!-- Display Form Data Here -->
<?php 
	// Validate and make sure user submitted Name
	if( isset($_POST["name"]) && !empty($_POST["name"]) ) {

		echo $_POST["name"];

	}
	else {
		echo "Not provided.";
	}
?>

			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-3 text-right">Email:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
<?php 
	// Validate and make sure user submitted Name
	if( isset($_POST["email"]) && !empty($_POST["email"]) ) {

		echo $_POST["email"];
		
	}
	else {
		echo "<div class='text-danger'>Not provided.</div>";
	}
?>
				

			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-3 text-right">Current Student:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
				

			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-3 text-right">Subscribe:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
				
		<?php 
			// validate first
			foreach( $_POST['subscribe'] as $subscribe) {

				echo $subscribe . ", ";
			}
		?>

			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-3 text-right">Subject:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
				
			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-3 text-right">Message:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
				
			</div>
		</div> <!-- .row -->

		<div class="row mt-4 mb-4">
			<a href="form.php" role="button" class="btn btn-primary">Back to Form</a>
		</div> <!-- .row -->

	</div> <!-- .container -->
	
</body>
</html>