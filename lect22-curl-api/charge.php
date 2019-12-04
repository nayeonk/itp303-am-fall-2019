<?php
	if ( !isset($_POST['full-name']) || empty($_POST['full-name'])
		|| !isset($_POST['amount']) || empty($_POST['amount'])
		|| !isset($_POST['card-num']) || empty($_POST['card-num'])
		|| !isset($_POST['exp-month']) || empty($_POST['exp-month'])
		|| !isset($_POST['exp-year']) || empty($_POST['exp-year'])
		|| !isset($_POST['cvc']) || empty($_POST['cvc']) ) {
		$error = "Please fill out all required fields.";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Confirmation | USC Donations</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">Confirmation</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->

	<div class="container">

		<div class="row mt-4">
			<div class="col-12">

				<?php if ( isset($error) && !empty($error) ) : ?>
					<div class="text-danger"><?php echo $error; ?></div>
				<?php else : ?>
					<div class="text-success">Success</div>
				<?php endif; ?>

			</div> <!-- .col -->
		</div> <!-- .row -->

		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="donation_form.php" role="button" class="btn btn-primary">Submit Another Donation</a>
			</div> <!-- .col -->
		</div> <!-- .row -->

	</div> <!-- .container -->

</body>
</html>