<?php

if (isset($_POST["reset-request-submit"])) {
	
	$selector = bin2hex(random_bytes(8));
	$token = random_bytes(32);

	$url = "http://localhost/midnightCravings/admin/user/create-new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);

	$expires = date("U") + 1800;

	include "../db.inc.php";

	$userEmail = $_POST["email"];

	try 
	{
		$sql = "SELECT * FROM author WHERE author_email = :author_email";
		$s = $pdo->prepare($sql);
		$s->bindValue(':author_email', $userEmail);
		$s->execute();

	} 
	catch (PDOException $e) 
	{
		$error = 'Error loacating user email address...';
		include 'error.html.php';
		exit();
	}

	$row = $s->fetch(PDO::FETCH_ASSOC);

	if(!$row['author_email'])
	{
		header("Location: ../../user/reset-password.php?reset=error");
	}

	else
	{
	try
	{
		$sql = "DELETE FROM pwdreset WHERE pwdResetEmail = :pwdResetEmail";
		$s = $pdo->prepare($sql);
		$s->bindValue(':pwdResetEmail', $userEmail);
		$s->execute();
	}
	catch (PDOException $e)
	{
		$error = 'Error deleting password reset values.';
		include 'error.html.php';
		exit();
	}

	try
	{
		$sql = "INSERT INTO pwdreset SET
		pwdResetEmail 		= :pwdResetEmail,
		pwdResetSelector 	= :pwdResetSelector,
		pwdResetToken 		= :pwdResetToken,
		pwdResetExpires 	= :pwdResetExpires";

		$hashedToken = password_hash($token, PASSWORD_DEFAULT);

		$s = $pdo->prepare($sql);
		$s->bindValue(':pwdResetEmail', $userEmail);
		$s->bindValue(':pwdResetSelector', $selector);
		$s->bindValue(':pwdResetToken', $hashedToken);
		$s->bindValue(':pwdResetExpires', $expires);
		$s->execute();
	}
	catch (PDOException $e)
	{
		$error = 'Error inserting password reset values.';
		include 'error.html.php';
		exit();
	}

	$to = $userEmail;

	$subject = 'Password reset request - MidnightCravings';

	$message = '<p>We received a password reset request. The link to reset your password is below. If you did not make this request, you can ignore this email.</p>';

	$message .= '<p>Here is your password reset link: <br />';

	$message .= '<a href="' . $url . '">' . $url . '</a></p>';

	$headers = "From: MidnighCravings <ks3319t@gre.ac.uk>\r\n>";
	$headers .= "Replay-To: ks3319t@gre.ac.uk\r\n";
	$headers .= "Content-type: text/html\r\n";

	mail($to, $subject, $message, $headers);

	header("Location: ../../user/reset-password.php?reset=success");		
	}
	


}
else
{
	header("Location: ../../../");
}