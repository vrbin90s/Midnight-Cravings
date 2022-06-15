<?php

$name = 'Kestutis Sebelskis';
$email = 'ks3319t@gre.ac.uk';

$headers = "From: $name $email" . PHP_EOL .
    "Replay-To: $name $email";


ini_set("SMTP", "smtp.gre.ac.uk");
ini_set("sendmail_from", "ks3319t@gre.ac.uk");

foreach ($authors as $author):
	mail ($author['author_email'], $_POST['subject'], $_POST['message'], $headers );
endforeach; 

include 'mail_success.html.php';



?> 





