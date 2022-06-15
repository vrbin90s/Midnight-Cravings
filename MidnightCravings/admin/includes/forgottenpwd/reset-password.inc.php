<?php 

if (isset($_POST["reset-password-submit"])) {

	$selector 		= $_POST["selector"];
	$validator 		= $_POST["validator"];
	$password 		= md5($_POST["pwd"] . 'mdb');
	$passwordRepeat = md5($_POST["pwd-repeat"] . 'mdb');

	if (empty($password) || empty($passwordRepeat)) {
		
		header("Location: ../../user/create-new-password.php?newpwd=empty");
		exit();

	}
	else if ($password != $passwordRepeat)
	{
		header("Location: ../../user/create-new-password.php?newpwd=pwdnotsame");
		exit();
	}

	$currentDate = date("U");

	include '../db.inc.php';

	try
	{
		$sql = "SELECT * FROM pwdreset 
		WHERE pwdResetSelector = :pwdResetSelector 
		AND pwdResetExpires >= :currentDate";

		$s = $pdo->prepare($sql);
		$s->bindValue(':pwdResetSelector', $selector);
		$s->bindValue(':currentDate', $currentDate);
		$s->execute();
		
		
	}
	catch (PDOException $e)
	{
		$error = 'Error fetching user password reset details.';
		include 'error.html.php';
		exit();
	}

	$row = $s->fetch();

	$tokenEmail = $row['pwdResetEmail'];


	$tokenBin = hex2bin($validator);
	$tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);



	if ($tokenCheck === false) 
	{
		echo "You need to re-submit your reset request";
		exit();
	}
	else if ($tokenCheck === true) 
	{

		try 
		{
			$sql = "SELECT * FROM author
			WHERE author_email = :author_email";
			$s = $pdo->prepare($sql);
			$s->bindValue(':author_email', $tokenEmail);
			$s->execute();


		} 
		catch (PDOException $e) 
		{
			$error = 'Error fetching user email during password reset process.';
			include 'error.html.php';
			exit();
		}

		// incase we don't use md5 than we can use password_hash function to encrypt the password and pass into the update statement below.
		// $newPwdHash = password_hash($password, PASSWORD_DEFAULT); 
		
		try 
		{
			$sql = 'UPDATE author SET 
			password = :password 
			WHERE author_email = :author_email';
			$s = $pdo->prepare($sql);
			$s->bindvalue(':password', 	$password);
			$s->bindvalue(':author_email', 	$tokenEmail);
			$s->execute();

		} 
		catch (PDOException $e) 	
		{
			$error = 'Error updating user password.';
			include 'error.html.php';
			exit();
		}

		try
		{
		
			$sql = "DELETE FROM pwdreset WHERE pwdResetEmail = :pwdResetEmail";
			$s = $pdo->prepare($sql);
			$s->bindValue(':pwdResetEmail', $tokenEmail);
			$s->execute();
		}
		catch (PDOException $e)
		{
			$error = 'Error deleting temporary password reset values.';
			include 'error.html.php';
			exit();
		}

		header("Location: ../../user/?newpwd=passwordupdated");
	}

}
else
{
	header("Location: ../../../");
}
