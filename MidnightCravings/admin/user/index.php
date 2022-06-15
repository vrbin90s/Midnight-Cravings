<?php 

require_once '../includes/access.inc.php';

if(!userIsLoggedIn())
{
	include 'login.html.php';
	exit();
}


/******************************************************************/

//GLOBAL DATABASE CONNECTION.


include '../includes/db.inc.php';


/******************************************************************/

//THIS BLOCK OF CODE DISPLAY A TOTAL NUMBER OF ROWS FROM THE SELECTED TABLES.

try 
{

	$sql = "SELECT author_name FROM author
	WHERE author_id = :author_id";
    $s = $pdo->prepare($sql);
    $s->bindValue(':author_id', $_SESSION['aid']);
    $s->execute();	

} catch (PDOException $e) {
	
	$error = 'Erro fetching author_name from the databse.' . $e->getMessage();
	include 'error.html.php';
	exit();	
}

$row = $s->fetch();

$authorName = $row['author_name'];

// Selecting total numer of recipes.
try {


	$sql = 'SELECT COUNT(*) FROM recipes
	INNER JOIN author on author_id = recipe_author_id
	WHERE recipe_author_id = :author_id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':author_id', $_SESSION['aid']);
    $s->execute();	

	
} catch (PDOException $e) {

		$error = 'Erro fetching total count of recipes in the databse.' . $e->getMessage();
		include 'error.html.php';
		exit();
}

	$recipe_count = $s->fetchColumn();


// Selecting total number of authors.
try {

	$sql = 'SELECT COUNT(*) FROM author';
	$res = $pdo->query($sql);

	
} catch (PDOException $e) {

		$error = 'Erro fetching total count of authors in the database.' . $e->getMessage();
		include 'error.html.php';
		exit();
}

	$author_count = $res->fetchColumn();

// Selecting total number of categories.
try {

	$sql = 'SELECT COUNT(*) FROM category';
	$res = $pdo->query($sql);

	
} catch (PDOException $e) {

		$error = 'Erro fetching total count of categories in the database.' . $e->getMessage();
		include 'error.html.php';
		exit();
}

	$category_count = $res->fetchColumn();

// Selecting latest recipe upload.



try {

	$sql = 'SELECT recipe_name, recipe_upload_date, author_name
	FROM recipes
	INNER JOIN author ON author_id = recipe_author_id
	WHERE recipe_author_id = :recipe_author_id 
	ORDER BY recipe_id DESC LIMIT 1';
	$s = $pdo->prepare($sql);
    $s->bindValue(':recipe_author_id', $_SESSION['aid']);
    $s->execute();	

	
} catch (PDOException $e) {

		$error = 'Erro fetching total count of categories in the database.' . $e->getMessage();
		include 'error.html.php';
		exit();
}

	$row = $s->fetch();

	$recipe_name 		= $row['recipe_name'];
	$rec_upload_date 	= $row['recipe_upload_date'];
	$author_name 		= $row['author_name'];







/******************************************************************/

// LOAD DASHBOARD TEMPLATE-PART

	if(userHasRole('Account Administrator') || userHasRole('Site Administrator') || userHasRole('Content Editor'))
	{
		header("Location: ../");
	}

	if(userHasRole('User')){
		include_once 'dashboard.html.php';
	}



/******************************************************************/


 ?>