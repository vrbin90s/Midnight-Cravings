<?php

require_once  "admin/includes/access.inc.php";

if(!userIsLoggedIn())
{
	include "login_reg.html.php";
	include "admin/includes/nav_login.inc.html.php";

}

else
{
	include "logout.html.php";
	include "admin/includes/nav_logout.inc.html.php";
}


/******************************************************************************/

	//THIS BLOCK OF CODE GLOBALY POPULATES SEARCH BAR'S DROPDOWN SELECTION.


if (isset($_GET['add']))
	{

	$pageTitle 	= 'New Recipe';
}

	
	include 'admin/includes/db.inc.php';

		try
	{
		$result =$pdo->query('SELECT author_id, author_name FROM author');
	}
	catch (PDOException $e)
	{
		$error = 'Error fetching list of authors';
		include 'error.html.php';
		exit();
	}

	foreach ($result as $row) {
		$authors[] = array('id' => $row['author_id'], 'name' => $row['author_name'] );
	}

	// Build list of recipe categories.
	try
	{
		$result =$pdo->query('SELECT category_id, category_name FROM category');
	}
	catch (PDOException $e)
	{
		$error = 'Error fetching list of categories';
		include 'error.html.php';
		exit();
	}

	foreach ($result as $row) {
		$categories[] = array('id' => $row['category_id'], 'name' => $row['category_name'], 'selected' => FALSE );
	}

/******************************************************************************/

	//THIS BLOCK OF CODE BUILDS A SEARCH QUERY AND DISPLAYS THE RESULTS.

	if(isset($_GET['action']) and $_GET['action'] == 'search')
	{

	$select = 'SELECT recipe_id, recipe_name, recipe_description, 
	recipe_image, author_name';
	$from = ' FROM recipes INNER JOIN author ON author_id = recipe_author_id';
	$where = ' WHERE TRUE';
	$placeholders = array();

	include 'admin/includes/db.inc.php';

	if ($_GET['author'] != '') //An author is selected
	{	
	
		$where .= " AND recipe_author_id = :authorid";
		$placeholders[':authorid'] = $_GET['author'];
	}

	if ($_GET['category'] != '') //A category is selected
	{
		$from .= ' INNER JOIN recipe_categories ON recipe_id = recipeid';
		$where .= " AND categoryid = :categoryid";
		$placeholders[':categoryid'] = $_GET['category'];
	}

	if ($_GET['text'] != '') //Some search text was specified
	{
		$where .= " AND recipe_name LIKE :recipename";
		$placeholders[':recipename'] = '%' . $_GET['text'] . '%';
	}
	
	// Run search query.
	try
	{
		$sql =  $select . $from . $where;
		$s = $pdo->prepare($sql);
		$s->execute($placeholders);
	}
	catch (PDOException $e)
	{
		$error = 'Error fetching recipes.';
		include 'error.html.php';
		exit();
	}

	foreach ($s as $row) 

	{
	 	$recipes[] = array(
		
		'recipe_id' 			=>	$row['recipe_id'],
		'recipe_name' 			=>	$row['recipe_name'],
		'recipe_description' 	=> 	$row['recipe_description'],
		'recipe_image' 			=> 	$row['recipe_image'],
		'author_name' 			=>  $row['author_name']
		);
	}

	
	
	// Display recipe search results in the new page.
	include 'template-parts/search_result_page.html.php';

	exit();

	}

/******************************************************************************/

	//THIS BLOCK OF CODE DISPLAY MORE INFORMATION ABOUT THE RECIPE IN A NEW PAGE. 

	if (isset($_POST['action']) and $_POST['action'] == 'get the recipe') 
	{

		include 'admin/includes/db.inc.php';

		// Selecting recipe and author data to populate page header.

	 	try 
	 	{
	 		$sql = 'SELECT recipe_id, 
	 		recipe_name, recipe_description, recipe_image, author_name
	 		FROM recipes
	 		INNER JOIN author ON recipe_author_id = author_id WHERE recipe_id = :id';
	 		$s = $pdo->prepare($sql);
	 		$s->bindvalue(':id', $_POST['recipe_id']);
	 		$s->execute();

	 	} catch (PDOException $e) {
	 		
	 		$error = 'Error fetching recipe details.';
	 		include 'error.html.php';
	 		exit();
	 	}

	 	// Fetching recipe and author data.
	 	
	 	foreach ($s as $row) 

	 	{
	 		$recipes[] = array(
			'recipe_id' 			=>	$row['recipe_id'],
			'recipe_name' 			=>	$row['recipe_name'],
			'recipe_description' 	=> 	$row['recipe_description'],
			'recipe_image' 			=> 	$row['recipe_image'],
			'author_name' 			=>  $row['author_name']
		);
		}

		// Selecting recipe prep times.

		try 
		{
			$sql = 'SELECT prep_time
			FROM recipe_times 
			INNER JOIN prep_time ON prep_time_id = preptimeid 
			WHERE recipeid = :id';
			$s = $pdo->prepare($sql);
	 		$s->bindvalue(':id', $_POST['recipe_id']);
	 		$s->execute();
			
		} catch (PDOException $e) {

			$error = 'Error fetching recipe prep times.';
	 		include 'error.html.php';
	 		exit();
			
		}

		//fetching recipe times

		$row = $s->fetch();

		$prep_time = $row['prep_time'];

		

		// Selecting recipe cook times.

		try 
		{
			$sql = 'SELECT cook_time 
			FROM recipe_times 
			INNER JOIN cook_time ON cook_time_id = cooktimeid 
			WHERE recipeid = :id';
			$s = $pdo->prepare($sql);
	 		$s->bindvalue(':id', $_POST['recipe_id']);
	 		$s->execute();
			
		} catch (PDOException $e) {

			$error = 'Error fetching recipe cook times';
	 		include 'error.html.php';
	 		exit();
			
		}

		//fetching recipe times

		$row = $s->fetch();

		$cook_time = $row['cook_time'];



		// Selecting recipe serves.

		try 
		{
			$sql = 'SELECT serves
			FROM recipe_serves 
			INNER JOIN serves ON serves_id = servesid
			WHERE recipeid = :id';
			$s = $pdo->prepare($sql);
	 		$s->bindvalue(':id', $_POST['recipe_id']);
	 		$s->execute();
			
		} catch (PDOException $e) {

			$error = 'Error fetching serves!';
	 		include 'error.html.php';
	 		exit();
			
		}

		// Fetching recipe serves

		$row = $s->fetch();

		$serves = $row['serves'];


		// Selecting ingredient data.

		try 
	 	{
	 		$sql = 'SELECT ingredients
	 		FROM recipe_ingredients
	 		INNER JOIN ingredient ON ingredient_id = ingredientid
	 		WHERE recipeid = :id';
	 		$s = $pdo->prepare($sql);
	 		$s->bindvalue(':id', $_POST['recipe_id']);
	 		$s->execute();

	 	} catch (PDOException $e) {
	 		
	 		$error = 'Error fetching ingredients!';
	 		include 'error.html.php';
	 		exit();
	 	}

	 	// Fetching recipe ingredient data.
	 	
	 	foreach ($s as $row) 

	 	{
	 		$ingredients[] = array( 'ingredients'	=>	$row['ingredients']);
		}

		// Selecting recipe cooking steps

		try {

			$sql = 'SELECT recipe_instructions
			FROM recipe_instructions
			INNER JOIN instructions ON instructions_id = instructionsid
			WHERE recipeid = :id';
	 		$results = $pdo->prepare($sql);
	 		$results->bindvalue(':id', $_POST['recipe_id']);
	 		$results->execute();			
			
		} catch (PDOException $e) {

			$error = 'Error fetching recipe instructions.';
	 		include 'error.html.php';
	 		exit();
			
		}

		// Fetching recipe cooking steps.

		foreach ($results as $row) 

	 	{
	 		$instructions[] = array( 'recipe_instructions'	=>	$row['recipe_instructions'] );
		}

		// Selecting and displaying related recipes from the same category.

		try 
		{
			$sql = 'SELECT recipe_id, 
			recipe_name, recipe_description, recipe_image, author_name
			FROM recipe_categories
			INNER JOIN recipes ON recipe_id = recipeid
			INNER JOIN author ON author_id = recipe_author_id';
			$results = $pdo->query( $sql );
		} catch (Exception $e) {

			$error = 'Error fetching related recipes.';
	 		include 'error.html.php';
	 		exit();
			
		}

		// Fetching related recipes data.

		foreach ($results as $row) 

	 	{
	 		$related_recipes[] = array(
			'recipe_id' 	=>	$row['recipe_id'],
			'recipe_name'	=> $row['recipe_name'],
			'recipe_description' => $row['recipe_description'],
			'recipe_image' => $row['recipe_image'],
			'author_name' => $row['author_name']
		);
		}




	 	include 'template-parts/single_recipe_page.html.php';	
	 	exit();
	}

	
/******************************************************************************/

	//THIS BLOCK OF CODE INCLUDES AND POPULATES WEBSITE CAROUSEL.

	include 'admin/includes/db.inc.php';

	try {

		$sql = 'SELECT recipes.recipe_id, recipe_name, recipe_image, author_name 
		FROM recipes INNER JOIN author 
		ON recipe_author_id = author_id ORDER BY recipe_upload_date DESC';
		$results = $pdo->query( $sql );
		
	} catch (PDOException $e) {

		$error = 'Erro fetching slides' . $e->getMessage();
		include 'error.html.php';
		exit();
		
	}

	foreach ($results as $row) {

		$slides[] = array(
  		'recipe_id'        		=> $row['recipe_id'],
		'recipe_name'     		=> $row['recipe_name'],
		'recipe_image'  		=> $row['recipe_image'],
		'author_name' 			=> $row['author_name'],
	);
	}

	include 'admin/includes/carousel.inc.html.php';

/******************************************************************************/

	//INCLUDES SEARCH BAR

	include_once "search_form.html.php";

/******************************************************************************/


	//THIS BLOCK OF CODE ADDS RECIPE CARDS TO THE PAGE IN RANDOM ORDER.
	
	include 'admin/includes/db.inc.php';

	// Joining recipe and author tables -> arrange data in random order -> limit to display only 6 cards in the page.
	try
	{
		$sql = 'SELECT recipes.recipe_id, recipe_name, recipe_description, 
		recipe_image, author_name, author_email
    	FROM recipes INNER JOIN author
   		ON recipe_author_id = author_id ORDER BY RAND() LIMIT 6';
		$result = $pdo->query( $sql );

	} catch (PDOException $e) {
		
		$error = 'Erro fetching recipe details to populate recipe cards in home page' . $e->getMessage();
		include 'error.html.php';
		exit();
	}

	// Foreach loop that extracts data from the tables to populate bootstrap cards.

	foreach ($result as $row) {
  	$recipes[] = array(
  		'recipe_id'        		=> $row['recipe_id'],
		'recipe_name'     		=> $row['recipe_name'],
		'recipe_description'  	=> $row['recipe_description'],
		'recipe_image'  		=> $row['recipe_image'],
		'author_name' 			=> $row['author_name'],
	);
  }

  include_once 'recipe_cards.html.php';


/******************************************************************************/

	//INCLUDING SITE HEADER AND NAVIGATION.
	$pageTitle = 'Home';
	include_once "admin/includes/head.inc.html.php";




/******************************************************************************/

	//INCLUDING SITE FOOTER AND SITE SCRIPTS.
	
	include_once "google_map.html.php";

	include_once "admin/includes/footer.inc.html.php";
  	include_once "admin/includes/scripts.inc.html.php";

  ?>

</body>
</html>