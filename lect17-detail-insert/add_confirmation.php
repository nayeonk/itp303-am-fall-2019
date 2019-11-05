<?php
// Check that user has filled out required fields
if ( !isset($_POST['track_name']) || 
	empty($_POST['track_name']) || 
	!isset($_POST['media_type']) || 
	empty($_POST['media_type']) || 
	!isset($_POST['genre']) || 
	empty($_POST['genre']) || 
	!isset($_POST['milliseconds']) || 
	empty($_POST['milliseconds']) || 
	!isset($_POST['price']) || 
	empty($_POST['price']) ) {

	// Set $error variable
	$error = "Please fill out all required fields.";
}
else {
	// Connect to the database and ADD this track to the database
	$host = "303.itpwebdev.com";
	$user = "nayeon_db_user";
	$pass = "uscItp2019!";
	$db = "nayeon_song_db";

	$mysqli = new mysqli($host, $user, $pass, $db);
	if ( $mysqli->errno ) {
		echo $mysqli->error;
		exit();
	}

	// Handle optional fields
	if( isset($_POST["album"]) && !empty($_POST["album"]) ) {
		// User has chosen an album
		$album_id = $_POST["album"];

	}
	else {
		// User has not chosen an album, so leave album id as null
		$album_id = "null";
	}

	if( isset($_POST["composer"]) && !empty($_POST["composer"]) ) {
		// User has filled out a composer
		$composer = "'" . $_POST["composer"]. "'";

	}
	else {
		// User has not filled out a composer, so leave composer as null
		$composer = "null";
	}

	if( isset($_POST["bytes"]) && !empty($_POST["bytes"]) ) {
		// User has filled out bytes
		$bytes = $_POST["bytes"];

	}
	else {
		// User has not filled out bytes, so leave bytes id as null
		$bytes = "null";
	}

	// Escape any special characters for track name
	$track_name = $mysqli->real_escape_string($_POST["track_name"]);

	// SQL statement to ADD to the database
	$sql = "INSERT INTO tracks (name, media_type_id, genre_id, milliseconds, unit_price, album_id, composer, bytes)
		VALUES(
			'" . $track_name  . "', "
			. $_POST["media_type"]
			. ", "
			. $_POST["genre"]
			. ", "
			. $_POST["milliseconds"]
			. ", "
			. $_POST["price"]
			. ", "
			. $album_id
			. ", "
			. $composer
			." ,"
			. $bytes
		. ");";

	// Echo out sql statement before running the query to double check it looks good
	echo "<hr>" . $sql . "<hr>";

	// Run the query
	$results = $mysqli->query($sql);
	if( !$results) {
		echo $mysqli->error;
		exit();
	}

	// affected_rows contains the number of rows inserted, updated, ord deleted by the cmomand
	echo "Inserted: " . $mysqli->affected_rows;
	if( $mysqli->affected_rows == 1) {
		$isInserted = true;
	}

	$mysqli->close();
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Confirmation | Song Database</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item"><a href="add_form.php">Add</a></li>
		<li class="breadcrumb-item active">Confirmation</li>
	</ol>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">Add a Song</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">
		<div class="row mt-4">
			<div class="col-12">

				<?php if( isset($error) && !empty($error) ) : ?>
					<div class="text-danger">
						<?php echo $error; ?>
					</div>
				<?php endif; ?>


				<?php if( $isInserted ) :?> 
					<div class="text-success">
						<span class="font-italic"><?php echo $_POST["track_name"]?></span> was successfully added.
					</div>
				<?php endif; ?>

			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="add_form.php" role="button" class="btn btn-primary">Back to Add Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->
</body>
</html>