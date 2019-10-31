<?php
// To connect with the DB using PHP, we are going to use an extension called MySQLi. 

// --- STEP 1: Establish a DB connection
$host = "303.itpwebdev.com";
$user = "nayeon_db_user";
$password = "uscItp2019!";
$db = "nayeon_song_db";

// Create instance of mysqli class
$mysqli = new mysqli($host, $user, $password, $db);

// Check for DB connection errors
if( $mysqli->connect_errno  ) {
	// Echo out the error message
	echo $mysqli->connect_error;
	// Exit the program. No need to continue on if no DB connection is made.
	exit();
}


// --- STEP 2: Generate & Submit SQL query
$sql = "SELECT * FROM genres;";
echo $sql . "<hr>";

// Submit the query via PHP MySQLi and save the results in $results
// Arrow notation -> to access an object's methods or properties vs brackets [] to access associative array
$results = $mysqli->query($sql);
// Check that no errors occurred when query is submtited. $results will return false if an error occureed
if( !$results ) {
	echo $mysqli->error;
	// Exit the program if there is an error. No reason to continue on.
	exit();
}

var_dump($results);
echo "<hr>";
echo "Number of results: " . $results->num_rows;
echo "<hr>";

// To get all the results, use a mysqli method called fetch_assoc()
// fetch_assoc() will return NULL when there are no more results
// var_dump($results->fetch_assoc());
// var_dump($results->fetch_assoc());
// var_dump($results->fetch_assoc());

while( $row = $results->fetch_assoc() ) {
	// Loop through all the results
	//var_dump($row);
	echo "id: " . $row["genre_id"];
	echo " name: " . $row["name"] . "<br/>";
}

// fetch_assoc() only gets run once, if need to reset, do the following
mysqli_data_seek($results, 0);

// Go get media types from database
$sql_media_types = "SELECT * FROM media_types;";
echo $sql_media_types . "<hr>";

// Submit the query via PHP MySQLi and save the results in $results
// Arrow notation -> to access an object's methods or properties vs brackets [] to access associative array
$results_media_types = $mysqli->query($sql_media_types);
// Check that no errors occurred when query is submitted. $results will return false if an error occureed
if( !$results_media_types ) {
	echo $mysqli->error;
	// Exit the program if there is an error. No reason to continue on.
	exit();
}


// --- STEP 3: Display Results on the web page


// --- STEP 4: Close DB connection
$mysqli->close();



?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Song Search Form</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<style>
		.form-check-label {
			padding-top: calc(.5rem - 1px * 2);
			padding-bottom: calc(.5rem - 1px * 2);
			margin-bottom: 0;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4 mb-4">Song Search Form</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">

		<form action="search_results.php" method="GET">

			<div class="form-group row">
				<label for="name-id" class="col-sm-3 col-form-label text-sm-right">Track Name:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="name-id" name="track_name">
				</div>
			</div> <!-- .form-group -->
			<div class="form-group row">
				<label for="genre-id" class="col-sm-3 col-form-label text-sm-right">Genre:</label>
				<div class="col-sm-9">
<select name="genre" id="genre-id" class="form-control">
	<option value="" selected>-- All --</option>

<?php
	
	// Putting all HTML / php in one php block can get really messy. Therefore when writing a lot of HTML w/ PHP, use alternate syntax below

	// while( $row = $results->fetch_assoc() ) {
	// 	echo "<option value=" . $row["genre_id"] . ">" . $row["name"] . "</option>";
	// }

?>
	<!-- Alternate php syntax -->
	<?php while( $row = $results->fetch_assoc() ) : ?>

		<option value="<?php echo $row['genre_id']; ?>"> <?php echo $row["name"]; ?> </option>

	<?php endwhile; ?>

	<!-- <option value="" selected>-- All --</option>

	<option value='1'>Rock</option>
	<option value='2'>Jazz</option>
	<option value='3'>Metal</option>
	<option value='4'>Alternative & Punk</option>
	<option value='5'>Rock And Roll</option> -->

</select>
				</div>
			</div> <!-- .form-group -->
			<div class="form-group row">
				<label for="media-type-id" class="col-sm-3 col-form-label text-sm-right">Media Type:</label>
				<div class="col-sm-9">
					<select name="media_type" id="media-type-id" class="form-control">
						<option value="" selected>-- All --</option>

						<option value='1'>MPEG audio file</option>
						<option value='2'>Protected AAC audio file</option>

					</select>
				</div>
			</div> <!-- .form-group -->
			<div class="form-group row">
				<div class="col-sm-3"></div>
				<div class="col-sm-9 mt-2">
					<button type="submit" class="btn btn-primary">Search</button>
					<button type="reset" class="btn btn-light">Reset</button>
				</div>
			</div> <!-- .form-group -->
		</form>
	</div> <!-- .container -->
</body>
</html>