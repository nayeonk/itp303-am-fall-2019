<?php
	if( !isset($_GET["track_id"]) || empty($_GET["track_id"]) ) {
		// A track id is not given, show error message. Don't do anything else.
		$error = "Invalid Track ID";
	}
	else {
		// A track id is given so continue to connect to the DB.
		$host = "303.itpwebdev.com";
		$user = "nayeon_db_user";
		$pass = "uscItp2019!";
		$db = "nayeon_song_db";

		// DB connection stuff, create an instance of mysqli.
		$mysqli = new mysqli($host, $user, $pass, $db);
		if( $mysqli->connect_errno ) {
			echo $mysqli->connect_error;
			exit();
		}
		// Set character set
		$mysqli->set_charset("utf8");

		// SQL to get information about this specific track
		$sql = "SELECT tracks.name AS track, artists.name AS artist, composer, 
albums.title AS album, genres.name AS genre, milliseconds, bytes, unit_price
FROM tracks
	JOIN albums
		ON albums.album_id = tracks.album_id
	JOIN artists
		ON artists.artist_id = albums.artist_id
	JOIN genres
		ON genres.genre_id = tracks.genre_id
WHERE track_id =" . $_GET["track_id"]  . ";";

		// Print out the sql statement to double check the syntax looks good
		echo "<hr>" . $sql . "<hr>";

		// Run the SQL query
		$results = $mysqli->query($sql);
		if( !$results ) {
			echo $mysqli->error;
			exit();
		}

		// Get only ONE result back since this is a detail page of ONE track.
		$row = $results->fetch_assoc();

		var_dump($row);


		// close connection
		$mysqli->close();
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Song Details | Song Database</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item"><a href="search_form.php">Search</a></li>
		<li class="breadcrumb-item"><a href="search_results.php">Results</a></li>
		<li class="breadcrumb-item active">Details</li>
	</ol>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">Song Details</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">
		<div class="row mt-4">
			<div class="col-12">

				<!-- If $error variable is set and isn't empty, show the div that contains the error message. Below uses the alternat syntax. -->
				<?php if( isset($error) && !empty($error) ) : ?>
					<div class="text-danger">
						<?php echo $error; ?>
					</div>
				<?php endif; ?>
				
<table class="table table-responsive">
	<tr>
		<th class="text-right">Track Name:</th>
		<td><?php echo $row["track"] ?></td>
	</tr>
	<tr>
		<th class="text-right">Artist Name:</th>
		<td>A<?php echo $row["artist"] ?></td>
	</tr>
	<tr>
		<th class="text-right">Composer:</th>
		<td><?php echo $row["composer"] ?></td>
	</tr>
	<tr>
		<th class="text-right">Album:</th>
		<td><?php echo $row["album"] ?></td>
	</tr>
	<tr>
		<th class="text-right">Genre:</th>
		<td><?php echo $row["genre"] ?></td>
	</tr>
	<tr>
		<th class="text-right">Milliseconds:</th>
		<td>Milliseconds</td>
	</tr>
	<tr>
		<th class="text-right">Bytes:</th>
		<td>Bytes</td>
	</tr>
	<tr>
		<th class="text-right">Price:</th>
		<td>Price</td>
	</tr>
</table>

			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="search_results.php" role="button" class="btn btn-primary">Back to Search Results</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->
</body>
</html>