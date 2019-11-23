<?php
require '../config/config.php';

// Second line of defense, PHP also validates user input. Makes sure that all required fields are filled out.
if ( !isset($_POST['email']) || empty($_POST['email'])
	|| !isset($_POST['username']) || empty($_POST['username'])
	|| !isset($_POST['password']) || empty($_POST['password']) ) {
	$error = "Please fill out all required fields.";
}
else {
	// Let's add this user to the new user table!
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if($mysqli->connect_errno) {
		echo $mysqli->connect_error;
		exit();
	}

	// Sanitize user input
	$username = $mysqli->real_escape_string($_POST['username']);
	$email = $mysqli->real_escape_string($_POST['email']);
	$password = hash("sha256", $_POST['password']);

	// Hashing strings

	// $string = "usc1";
	// $string2 = "usc";
	// $string = hash("sha256", $string);
	// $string2 = hash("sha256", $string2);
	// var_dump($string);
	// var_dump($string2);

	// exit();

	// Check if this user already exists in the database
	$sql_registered = "SELECT * FROM users
		WHERE username = '" . $username . "' OR email = '" . $email . "';";
	echo $sql_registered;
	echo "<hr>";

	$results_registered = $mysqli->query($sql_registered);
	if(!$results_registered) {
		echo $mysqli->error;
		exit();
	}

	// var_dump($results_registered);

	// If more than 0 result came back, it means the username or email already exists in the users table.
	if($results_registered->num_rows > 0) {
		$error = "Username or email has been already taken. Please choose another one.";
	}
	else {
		// Otherwise, insert this user into the users table.
		$sql = "INSERT INTO users(username, email, password)
				VALUES('" . $username . "','" . $email . "','" . $password . "');";
		echo $sql;
		echo "<hr>";

		$results = $mysqli->query($sql);
		if(!$results) {
			echo $mysqli->error;
		}	
	}

	$mysqli->close();	
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registration Confirmation | Song Database</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">User Registration</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->

	<div class="container">

		<div class="row mt-4">
			<div class="col-12">
				<?php if ( isset($error) && !empty($error) ) : ?>
					<div class="text-danger"><?php echo $error; ?></div>
				<?php else : ?>
					<div class="text-success"><?php echo $_POST['username']; ?> was successfully registered.</div>
				<?php endif; ?>
		</div> <!-- .col -->
	</div> <!-- .row -->

	<div class="row mt-4 mb-4">
		<div class="col-12">
			<a href="login.php" role="button" class="btn btn-primary">Login</a>
			<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" role="button" class="btn btn-light">Back</a>
		</div> <!-- .col -->
	</div> <!-- .row -->

</div> <!-- .container -->

</body>
</html>