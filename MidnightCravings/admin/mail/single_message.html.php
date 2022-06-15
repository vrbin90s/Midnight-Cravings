<?php  

$name = 'Kestutis Sebelskis';
$email = 'ks3319t@gre.ac.uk';

$headers = "From: $name $email" . PHP_EOL .
    "Replay-To: $name $email";



ini_set("SMTP", "smtp.gre.ac.uk");
ini_set("sendmail_from", "ks3319t@gre.ac.uk");

mail ($author_email, $_POST['subject'], $_POST['message'], $headers );

include 'mail_success.html.php';

?>