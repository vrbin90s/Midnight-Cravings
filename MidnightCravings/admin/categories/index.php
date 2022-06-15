<?php


require_once '../includes/access.inc.php';

if(!userIsLoggedIn())
{
	include '../login.html.php';
	exit();
}

if (!userHasRole('Site Administrator'))
{
	$error = 'Only Account Administrator may access this page.';
	include '../includes/access_denied.html.php';
	exit();
}

/******************************************************************************/

	// THIS BLOCK OF CODE ASIGNS NEW VALUES TO THE CATEGORY FORM ONCE ITS LOADED.

	if (isset($_GET['add']))
	{
		$pageTitle 		= 'New Category';
		$action 		= 'addform';
		$category_name 	= '';
		$category_id 	= '';
		$button 		= 'Add Category';

		include 'form.html.php';
		exit();
	}

/******************************************************************************/

	// THIS BLOCK OF CODE ADDS NEW CATEGORY TO THE DATABASE.

	if (isset($_GET['addform']))
	{
		include '../includes/db.inc.php';
		try 
		{
			$sql = 'INSERT INTO category SET category_name = :name';
			$s = $pdo->prepare($sql);
			$s->bindvalue(':name', $_POST['category_name'] );
			$s->execute();

		} catch (PDOException $e) {
			
			$error = 'Error adding submited recipe category!';
			include 'error.html.php';
			exit();
		}
		header('Location: .');
		exit();

	}

/******************************************************************************/

	// THIS BLOCK OF CODE EXTRACTS AND DISPLAY EXISTING CATEGORY DETAILS.

	if (isset($_POST['action']) and $_POST['action'] == 'Update' )
	{
		include '../includes/db.inc.php';
		
		// Select category details from the database.

		try 
		{
			$sql = 'SELECT category_id, category_name 
			FROM category 
			WHERE category_id = :id';
			$s = $pdo->prepare($sql);
			$s->bindvalue(':id', $_POST['id']);
			$s->execute();

		} catch (PDOException $e) {
			$error = 'Error fetching category details!';
			include 'error.html.php';
			exit();
		}
		
		// Fetching category details to populate the edit form.

		$row = $s->fetch();

			$pageTitle 		= 'Edit Category';
			$action 		= 'editform';
			$category_id 	= $row['category_id'];
			$category_name 	= $row['category_name'];
			$button 		= 'Update Category';

		include 'form.html.php';
		exit();
	}

/******************************************************************************/

	
	// THIS BLOCK OF CODE UPDATES CATEGORY DETAILS.

	if (isset($_GET['editform'])) 
	{
		include '../includes/db.inc.php';


		// Update selected category details.

		try 
		{
			
			$sql = 'UPDATE category 
			SET category_name = :name 
			WHERE category_id = :id';
			$s = $pdo->prepare($sql);
			$s->bindvalue(':id', $_POST['category_id'] );
			$s->bindvalue(':name', $_POST['category_name'] );
			$s->execute();


		} catch (PDOException $e) {
			
			$error = 'Error updating submitted category!';
			include 'error.html.php';
			exit();
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
	 		$sql = 'SELECT category_id, category_name 
	 		FROM category WHERE category_id = :id';
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

	 		$category_id 	= $row['category_id'];
	 		$category_name 	= $row['category_name'];

	 	include 'confirm_delete.html.php';
	 	exit();
	}

/******************************************************************************/ 

	// THIS BLOCK OF CODE DELETES AUTHOR ALONG WITH ALL HIS RECIPES.

	if (isset($_POST['action']) and $_POST['action'] == 'Yes - Delete') 
	{
	 	include '../includes/db.inc.php';

	 	// Delete selected category from the database.
	 	try 
	 	{
	 		$sql = 'DELETE FROM category WHERE category_id = :id';
	 		$s = $pdo->prepare($sql);
	 		$s->bindvalue(':id', $_POST['id']);
	 		$s->execute();

	 	} catch (Exception $e) {
	 		
	 		$error = 'Error fetching recipe category!';
	 		include 'error.html.php';
	 		exit();
	 	}
	 	header('Location: .');
	 	exit();

	} 


/******************************************************************************/

	// THIS LINE OF CODE INCLUDES THE PAGE THAT CONECTS WITH DATABASE (GLOBALY).

	include '../includes/db.inc.php';

/******************************************************************************/

	// THIS BLOCK OF CODE FETCHES LIST OF ALL CATEGORIES FROM DATABASE.

	try 
	{
		$result = $pdo->query('SELECT category_id, category_name FROM category');
		
	} catch (PDOException $e) {
		
		$error = 'Error fetching categories from database';
		include 'error.html.php';
		exit();
	}

	foreach ($result as $row)
	{
		$categories[] = array(
			'category_id' 	=> $row['category_id'], 
			'category_name' => $row['category_name']);
	}
	
	include 'category.html.php';

 ?>