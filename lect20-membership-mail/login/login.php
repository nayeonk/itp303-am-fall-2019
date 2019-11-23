<?php
require '../config/config.php';

// If user is logged in, redirect user to home page. Don't allow them to see the login page.
if( isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {

	header('Location: ../song-db/index.php');
}
else {

	// If user attempted to log in (aka submitted the form)
	if( isset($_POST['username']) && isset($_POST['password']) ){
			
		if( empty($_POST['username']) || empty($_POST['password']) ) {

			$error = "Please enter a username and password ";
		}
		
		else {
			// Authenticate this user by connection to the DB
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

			if($mysqli->connect_errno) {
				echo $mysqli->connect_error;
				exit();
			}

			$usernameInput = $_POST["username"];
			// hash the password that user typed in
			$passwordInput = hash("sha256", $_POST["password"]);

			// Look up the user table, see if there is a username/password match
			$sql = "SELECT * FROM users 
				WHERE username = '" . $usernameInput . "' AND password = '" . $passwordInput . "';";

			echo "<hr>";
			echo $sql;

			$results = $mysqli->query($sql);
			if(!$results) {
				echo $mysqli->error;
				exit();
			}

			if($results->num_rows > 0) {
				// Log them in
				$_SESSION['logged_in'] = true;
				$_SESSION['username'] = $usernameInput;

				// Redirect user to the homepage
				header('Location: ../song-db/index.php');
			}
			else {
				$error = "Invalid username or password";
			}
		}
		
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login | Song Database</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<?php include '../song-db/nav.php'; ?>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4 mb-4">Login</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->

	<div class="container">

		<form action="login.php" method="POST">

			<div class="row mb-3">
				<div class="font-italic text-danger col-sm-9 ml-sm-auto">
					<!-- Show errors here. -->
					<?php
						if ( isset($error) && !empty($error) ) {
							echo $error;
						}
					?>
				</div>
			</div> <!-- .row -->
			

			<div class="form-group row">
				<label for="username-id" class="col-sm-3 col-form-label text-sm-right">Username:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="username-id" name="username">
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<label for="password-id" class="col-sm-3 col-form-label text-sm-right">Password:</label>
				<div class="col-sm-9">
					<input type="password" class="form-control" id="password-id" name="password">
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<div class="col-sm-3"></div>
				<div class="col-sm-9 mt-2">
					<button type="submit" class="btn btn-primary">Login</button>
					<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" role="button" class="btn btn-light">Cancel</a>
				</div>
			</div> <!-- .form-group -->
		</form>

		<div class="row">
			<div class="col-sm-9 ml-sm-auto">
				<a href="register_form.php">Create an account</a>
			</div>
		</div> <!-- .row -->

	</div> <!-- .container -->
</body>
</html>