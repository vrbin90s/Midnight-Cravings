<?php

require_once '../includes/access.inc.php';

if(!userIsLoggedIn())
{
	include '../login.html.php';
	exit();
}

if (!userHasRole('Account Administrator'))
{
	$error = 'Only Account Administrator may access this page.';
	include '../includes/access_denied.html.php';
	exit();
}
/******************************************************************************/


	// THIS BLOCK OF CODE LOADS AND ASIGNS NEW VALUES TO ADD AUTHOR FORM.

	if (isset($_GET['add']))
	{
		include '../includes/db.inc.php';
		$pageTitle 		= 'New Author';
		$action 		= 'addform';
		$author_name 	= '';
		$author_email 	= '';
		$author_id 		= '';
		$button 		= 'Add Author';

	
	//build list of roles
	try
	{
		$result = $pdo->query('SELECT id, description FROM role');
	}
	catch (PDOException $e)
	{
		$error = 'Error fetching list of roles.';
		include 'error.html.php';
		exit();
	}
	foreach ($result as $row)
	{
		$roles[] = array('id' => $row['id'], 'description' => $row['description'], 'selected' => FALSE);
	}


	include 'form.html.php';
	exit();

	}

/******************************************************************************/

	// THIS BLOCK OF CODE ADDS NEW AUTHOR TO THE DATABASE.

	if (isset($_GET['addform']))
	{
		include '../includes/db.inc.php';

		try 
		{
			$sql = 'INSERT INTO author 
			SET author_name = :author_name, author_email = :author_email';
			$s = $pdo->prepare($sql);
			$s->bindvalue(':author_name', $_POST['author_name'] );
			$s->bindvalue(':author_email', $_POST['author_email'] );
			$s->execute();

		} catch (PDOException $e) {
			
			$error = 'Error adding submited author!';
			include 'error.html.php';
			exit();
		}

		$authorid = $pdo->lastInsertId();

		if ($_POST['password'] != '')
		{

		$password = md5($_POST['password']. 'mdb');

		try
		{
			$sql = 'UPDATE author SET
				password = :password
				WHERE author_id = :id';
			$s = $pdo->prepare($sql);
			$s->bindvalue(':password', $password);
			$s->bindvalue(':id', $authorid);
			$s->execute();
		}
		catch (PDOException $e)
		{
			$error = 'Error setting author password.';
			include 'error.html.php';
			exit();
		}
	}

	if (isset($_POST['roles']))
	{
		foreach ($_POST['roles'] as $role) {
			try
			{
				$sql = 'INSERT INTO author_role SET
				authorid = :authorid,
				roleid = :roleid';
				$s = $pdo->prepare($sql);
				$s->bindValue(':authorid', $authorid);
				$s->bindValue(':roleid', $role);
				$s->execute();
				}
			catch (PDOException $e)
			{
				$error = 'Error assigning selected role to author.';
				include 'error.html.php';
				exit();
			}
		}
	}

	header('Location: .');
	exit();

	}

/******************************************************************************/

	// THIS BLOCK OF CODE DISPLAYS AND POPULATES EDIT AUTHOR FORM.

	if (isset($_POST['action']) and $_POST['action'] == 'Update' )
	{
		include '../includes/db.inc.php';
		
		// Selecting author details from the database.
		try 
		{
			$sql = 'SELECT author_id, author_name, author_email 
			FROM author WHERE author_id = :id';
			$s = $pdo->prepare($sql);
			$s->bindvalue(':id', $_POST['id']);
			$s->execute();

		} catch (PDOException $e) {
			$error = 'Error fetching author details!';
			include 'error_html.php';
			exit();
		}
		
		// Fetching author details from the database.
		$row = $s->fetch();

			$pageTitle 		= 'Edit Author';
			$action 		= 'editform';
			$author_name 	= $row['author_name'];
			$author_email 	= $row['author_email'];
			$author_id 		= $row['author_id'];
			$button 		= 'Update Author';
		//get list of roles assigned to this author
		try
		{
			$sql = 'SELECT roleid FROM author_role WHERE authorid = :id';
    		$s = $pdo->prepare($sql);
    		$s->bindValue(':id', $author_id);
    		$s->execute();
  		}
  		catch (PDOException $e)
  		{
    		$error = 'Error fetching list of assigned roles.';
    		include 'error.html.php';
    		exit();
  		}

  		$selectedRoles = array();
  		foreach ($s as $row)
  		{
    		$selectedRoles[] = $row['roleid'];
  		}

  		// Build the list of all roles
  		try
  		{
    		$result = $pdo->query('SELECT id, description FROM role');
  		}
  		catch (PDOException $e)
  		{
    		$error = 'Error fetching list of roles.';
    		include 'error.html.php';
    		exit();
  		}

  		foreach ($result as $row)
  		{
    		$roles[] = array(
      		'id' 			=> $row['id'],
      		'description' 	=> $row['description'],
      		'selected' 		=> in_array($row['id'], $selectedRoles));
 		 }

		include 'form.html.php';
		exit();
	}

/******************************************************************************/

	// THIS BLOCK OF CODE UPDATES AUTHOR DETAILS STORED IN THE DATABASE.

	if (isset($_GET['editform'])) 
	{
		include '../includes/db.inc.php';

		// Updating author details with the data from the input fields.
		try 
		{
			$sql = 'UPDATE author SET 
			author_name = :author_name, 
			author_email = :author_email 
			WHERE author_id = :author_id';
			$s = $pdo->prepare($sql);
			$s->bindvalue(':author_id', 	$_POST['author_id'] );
			$s->bindvalue(':author_name', 	$_POST['author_name'] );
			$s->bindvalue(':author_email', 	$_POST['author_email'] );
			$s->execute();


		} catch (PDOException $e) {
			
			$error = 'Error updating submitted author!';
			include 'error.html.php';
			exit();
		}

		if ($_POST['password'] != '')
		{
			$password = md5($_POST['password'] . 'mdb');
			try
			{
				$sql = 'UPDATE author SET
          		password = :password
          		WHERE author_id = :id';
          		$s = $pdo->prepare($sql);
      			$s->bindValue(':password', $password);
      			$s->bindValue(':id', $_POST['id']);
      			$s->execute();
    		}
    		catch (PDOException $e)
    		{
      		$error = 'Error setting author password.';
      		include 'error.html.php';
      		exit();
    		}
  		}

  		try
  		{
    		$sql = 'DELETE FROM author_role WHERE authorid = :id';
    		$s = $pdo->prepare($sql);
   		 	$s->bindValue(':id', $_POST['author_id']);
    		$s->execute();
  		}
  		catch (PDOException $e)
  		{
    		$error = 'Error removing obsolete author role entries.';
    		include 'error.html.php';
    		exit();
  		}

  		if (isset($_POST['roles']))
  		{
    		foreach ($_POST['roles'] as $role)
    	{
    		try
    		{
    			$sql = 'INSERT INTO author_role SET
            	authorid = :authorid,
            	roleid = :roleid';
        		$s = $pdo->prepare($sql);
        		$s->bindValue(':authorid', $_POST['author_id']);
        		$s->bindValue(':roleid', $role);
        		$s->execute();
        	}
      		catch (PDOException $e)
      		{
      			$error = 'Error assigning selected role to author.';
      			include 'error.html.php';
        		exit();
      		}
    	}
  		}
  	header('Location: .');
  	exit();
  }

/******************************************************************************/

	// THIS BLOCK OF CODE LOADS AND DISPLAYS CONFIRM DELETE FORM.


	if (isset($_POST['action']) and $_POST['action'] == 'Delete') 
	{
	 	include '../includes/db.inc.php';

	 	// Selecting author details from the database.

	 	try 
	 	{
	 		$sql = 'SELECT author_id, author_name 
	 		FROM author WHERE author_id = :id';
	 		$s = $pdo->prepare($sql);
	 		$s->bindvalue(':id', $_POST['id']);
	 		$s->execute();

	 	} catch (Exception $e) {
	 		
	 		$error = 'Error fetching author!';
	 		include 'error.html.php';
	 		exit();
	 	}

	 	// Fetching author details from the sent author id.
	 	
	 	$row = $s->fetch();

	 		$name 	= $row['author_name'];
	 		$id 	= $row['author_id'];

	 	include 'confirm_delete.html.php';
	 	exit();
	}

/******************************************************************************/ 

	// THIS BLOCK OF CODE DELETES AUTHOR ALONG WITH ALL HIS RECIPES.

	if (isset($_POST['action']) and $_POST['action'] == 'Yes - Delete') 
	{

		include '../includes/db.inc.php';

		// Delete role assignments for this author
		try
		{
			$sql = 'DELETE FROM author_role WHERE authorid = :id';
		    $s = $pdo->prepare($sql);
		    $s->bindValue(':id', $_POST['id']);
		    $s->execute();
  		}
  		catch (PDOException $e)
  		{
    		$error = 'Error removing author from roles.';
    		include 'error.html.php';
    		exit();
  		}

		// Selecting and deleting author from the database.

	 	try 
	 	{
	 		$sql = 'DELETE FROM author WHERE author_id = :id';
	 		$s = $pdo->prepare($sql);
	 		$s->bindvalue(':id', $_POST['id']);
	 		$s->execute();

	 	} catch (Exception $e) {
	 		
	 		$error = 'Error deleting author!';
	 		include 'error.html.php';
	 		exit();
	 	}
	 	header('Location: .');
	 	exit();

	}


/******************************************************************************/


	// THIS IS A GLOBAL LINE OF CODE THAT INCLUDES DATABASE CONNECTION PAGE.

	include '../includes/db.inc.php';

/******************************************************************************/

	// THIS BLOCK OF CODE FETCHES ALL AUTHOR RECORDS FROM THE DATABASE.

	try 
	{
		$result = $pdo->query('SELECT author_id, author_name, author_email FROM author');
		
	} catch (PDOException $e) {
		
		$error = 'Error fetching authors from database';
		include 'error.html.php';
		exit();
	}

	foreach ($result as $row)
	{
		$authors[] = array(

			'author_id' 	=> $row['author_id'],
			'author_name' 	=> $row['author_name'],
			'author_email' 	=> $row['author_email']
		);
	}

	include 'authors.html.php';



 ?>