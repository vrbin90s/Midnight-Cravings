<?php 

$name = $_POST['name'];
$userEmail = $_POST['email'];
$url = "http://localhost/midnightcravings/admin/user/";


$to = $userEmail;

	$subject = 'MidnightCravings - account confirmation.';

	$message = '<p>Hello, ' . $name .'.'.'</p>';
	$message .= '<p>Thank you for registering for MidnightCravings account. Now you can login and start posting your recipe ideas.</p>';
	$message .= '<p>You can follow the link below to login to your account.<br />';
	$message .= '<a href="' . $url . '">' . $url . '</a></p><br />';
	$message .= 'Kind Regards <br />';
	$message .= 'MidnightCravings Administration';

	$headers = "From: MidnighCravings <agreement.doc@gmail.com>\r\n>";
	$headers .= "Replay-To: ks3319t@gre.ac.uk\r\n";
	$headers .= "Content-type: text/html\r\n";

	mail($to, $subject, $message, $headers);

	header("Location: ?success=registered");		
	