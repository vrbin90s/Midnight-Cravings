<?php 
require "../includes/validation/check-db-records.inc.php";
require_once '../includes/access.inc.php';
	





/******************************************************************************/

	// THIS BLOCK OF CODE ADDS NEW USER INTO DATABASE.

	if (isset($_POST["action"]) and $_POST['action'] == 'Register')
	{
		$name           = $_POST["name"];
		$email          = $_POST["email"];
		$captcha		= $_POST['g-recaptcha-response'];
		$password       = md5($_POST["pwd"] . 'mdb');
		$passwordRepeat = md5($_POST["pwd-repeat"] . 'mdb');

		if(empty($password) || empty($passwordRepeat) || empty($email) || empty($name))
		{
			header("Location: ?error=regError");

		}
		else if ($password != $passwordRepeat)
		{
			header("Location: ?error=pwdError");
		}
		else if (empty($captcha)){
			header("Location: ?error=capError");
		}


		include '../includes/db.inc.php';

		$secret = '6LcMYYcaAAAAAEkl3Lbu8nic936GJ_-mpwqm1AnL';
		$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
		$responseData = json_decode($verifyResponse);

		if (!$responseData->success) 
		{
			// header("Location: ?error=capfailed");
		}
		else 
		{
			try 
			{
				$sql = 'INSERT INTO author 
				SET author_name = :user_name, author_email = :author_email, password = :password';
				$s = $pdo->prepare($sql);
				$s->bindvalue(':user_name', $_POST['name'] );
				$s->bindvalue(':author_email', $_POST['email'] );
				$s->bindvalue(':password', md5($_POST['pwd'] . 'mdb'));
				$s->execute();

			} 
			catch (PDOException $e) 
			{
			
				$error = 'Error creating new user account!';
				include 'error.html.php';
				exit();
			}

			$authorid = $pdo->lastInsertId();

			try 
			{
				$sql = 'INSERT INTO author_role
				SET authorid = :authorid, roleid = :roleid';
				$s = $pdo->prepare($sql);
				$s->bindValue(':authorid', $authorid);
				$s->bindValue(':roleid', 'User');
				$s->execute();
			
			} 
			catch (PDOException $e) 
			{
				$error = 'Error asigning a role to the new account user!';
				include 'error.html.php';
				exit();			
			}

			include "welcome.html.php";
			//header("Location: ?success=registered");
		}
	}



include "form.html.php"; 

/******************************************************************************/



?>