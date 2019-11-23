<?php

// Sending emails
$to = "nykim92@gmail.com";
$subject = "Email from ITP 303!";
$message = "Hello from ITP 303. Your final project is due on <strong>12/13</strong>.";
$headers = "Content-Type: text/html" . "\r\n" . "From:nayeon@gmail.com"; 

// Mail 
if( mail( $to, $subject, $message, $headers ) ) {
	// mail() doesnt guarnatee email has been received.
	echo "Mail sent";
}
else {
	echo "There was a problem with your email";
}

?>