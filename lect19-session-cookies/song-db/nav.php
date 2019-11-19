<nav class="container-fluid bg-light p-2">
	<div class="row">
		<div class="col-12 d-flex">

	<!-- If user is NOT logged in, show the login link. -->
	<?php if(!isset($_SESSION["logged_in"]) || !$_SESSION["logged_in"] ) :?>

		<a class="text-center p-2 ml-auto" href="../login/login.php">Login</a>

	<!-- Else it means user is logged in so show the username and logout link. -->
	<?php else: ?>

			<div class="text-center p-2 ml-auto">Hello <?php echo $_SESSION["username"]; ?> !</div>

			<a class="text-center p-2" href="../login/logout.php">Logout</a>

	<?php endif; ?>

		</div>
	</div> <!-- .row -->
</nav>