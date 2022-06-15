<?php 

$name = $_REQUEST['name'];
$email = $_REQUEST['email'];
$message = $_REQUEST['message'];
$subject = $_REQUEST['subject'];
$headers = "From: $name $email" . PHP_EOL .
    "Replay-To: $name $email";


ini_set("SMTP", "smtp.gre.ac.uk");
ini_set("sendmail_from", "ks3319t@gre.ac.uk");

mail ("ks3319t@gre.ac.uk", $subject, $message, $headers );

include 'mail_success.html.php';

?>