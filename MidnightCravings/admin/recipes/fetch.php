<?php 

// THIS BLOCK OF STORES RECIPE DETAILS IN ARREYS AND POPULATES ADD RECIPE FORM.
include '../includes/db.inc.php';

// Build authors array
try
{
	$result = $pdo->query('SELECT author_id, author_name FROM author');
}
catch (PDOException $e)
{
	$error = 'Error fetching authors from database!';
	include 'error.html.php';
	exit();
}

foreach ($result as $row) {
	$authors[]  = array('author_id' => $row['author_id'], 'author_name' => $row['author_name'] );
}

// Build categories array
try
{
	$result = $pdo->query('SELECT category_id, category_name FROM category');
}
catch (PDOException $e)
{
	$error = 'Error fetching categories from database!';
	include 'error.html.php';
	exit();
}

foreach ($result as $row) {
	$categories[]  = array('category_id' => $row['category_id'], 'category_name' => $row['category_name'] );
}

// Build Recipes Arrey

try 
{
	$result = $pdo->query('SELECT recipes.recipe_id, recipe_name, recipe_description, recipe_upload_date, recipe_image, author_name 
    FROM recipes 
    INNER JOIN author ON author_id = recipe_author_id');
	
} catch (PDOException $e) {
	
	$error = 'Error fetching recipe data from database!';
	include 'error.html.php';
	exit();
}

foreach ($result as $row) {
	$recipes[]  = array(

		'recipe_id' 			     => $row['recipe_id'],
		'recipe_name' 			   => $row['recipe_name'], 
		'recipe_description'   => $row['recipe_description'],
		'recipe_upload_date'   => $row['recipe_upload_date'],
		'recipe_image' 			   => $row['recipe_image'],
    	'author_name'          => $row['author_name']

	);
} ?>