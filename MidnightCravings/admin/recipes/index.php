<?php

require_once '../includes/access.inc.php';

if(!userIsLoggedIn())
{
  include 'login.html.php';
  exit();
}

$content_editor = userHasRole('Content Editor');
$user = userHasRole('User');

if (!$content_editor && !$user)
{
  $error = 'Only Account Administrator and Content Editor may access this page.';
  include '../includes/access_denied.html.php';
  exit();
}


//error_reporting(0);

/*******************************************************************************/

	// THIS BLOCK OF CODE ACTIVATES ONCE ADD NEW RECIPE BUTTON IS CLICKED.

	// Selecting and asigning new values to add recepe form.

	if (isset($_GET['add']))
	{
	$pageTitle 				     = 'New Recipe';
	$action 				       = 'addform';
	$recipe_name 			     = '';
	$recipe_description 	 = '';
	$authorid 				     = '';
	$recipe_id 				     = '';
	$button 				       = 'Add Recipe';
	$prep_time 				     = '';
	$cook_time 				     = '';
	$servings 				     = '';
	$recipe_instructions 	 = '';
	$recipe_ingredients 	 = '';
  $author_name           = '';

	include '../includes/db.inc.php';

	// Build a list of authors.

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

	$authors[] = array(

		'author_id' 	  => $row['author_id'], 
		'author_name' 	=> $row['author_name'] 
		);
	}


	// Build list of categories.
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

	$categories[] = array(

		'category_id' => $row['category_id'], 
		'category_name' => $row['category_name'], 
		'selected' => FALSE );
	}

  if(!userHasRole('User'))
  {
    include 'recipe_form.html.php';
    exit();
  }
  else
  {
    include 'recipe_form_user.html.php';
    exit();
  }

	}

/*******************************************************************************/

	// THIS BLOCK OF CODE INSERTS NEW RECIPE DETAILS INTO DATABASE.

if (isset($_GET['addform']))

{
	include '../includes/db.inc.php';

	//if($_POST['author'] == '' or $_POST['categories'] == FALSE)

  // Don't check for selected author if it's a user. Since user form won't have author selection.
	if(!userHasRole('user'))
  {
    if($_POST['author'] == '')
    {
      $error = 'You must choose an author for this recipe, Click back and try again';
      include 'error.html.php';
      exit();
    }   
  }


  // Uploading image to the chosen file directory.

  $target_dir = "../../assets/img/upload/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Check if image file is a actual image or fake image

  // if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    // echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
  // }

  // Check if file already exists
  if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }

  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }

  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    
  // if everything is ok, try to upload file
  } else {

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

	// Insert record into recipes table.

      // Check role access level. If it's not a user than use a primary block to insert data into the table that includes selected author.
      if(!userHasRole('User'))
      {
        try 
        {
          require_once "../includes/HTMLPurifier.standalone.php";

          $purifier = new HTMLPurifier();
          $clean = $purifier->purify($_POST['recipe_description']);
          $sql = 'INSERT INTO recipes SET

          recipe_name         = :recipe_name,
          recipe_description  = :recipe_description,
          recipe_upload_date  = CURDATE(),
          recipe_image        = :fileToUpload,
          recipe_author_id    = :authorid';

          $s = $pdo->prepare($sql);
          $s->bindValue(':recipe_name', $_POST['recipe_name']);
          $s->bindValue(':recipe_description', $clean);
          //$s->bindValue(':recipe_description', $_POST['recipe_description']);
          $s->bindValue(':fileToUpload', $_FILES['fileToUpload']["name"]);
          $s->bindValue(':authorid', $_POST['author']);
          $s->execute();
        }
        catch (PDOException $e)
        {
          $error = 'Error adding submitted recipe data';
          include 'error.html.php';
          exit();
        }   
      }
      // Else if it user don't require to insert author into the db table since user won't have this option.
      else 
      {
        try 
        {
        require_once "../includes/HTMLPurifier.standalone.php";
    
        $purifier = new HTMLPurifier();
        $clean = $purifier->purify($_POST['recipe_description']);
        $sql = 'INSERT INTO recipes SET

        recipe_name         = :recipe_name,
        recipe_description  = :recipe_description,
        recipe_upload_date  = CURDATE(),
        recipe_image        = :fileToUpload,
        recipe_author_id    = :authorid';

        $s = $pdo->prepare($sql);
        $s->bindValue(':recipe_name', $_POST['recipe_name']);
        $s->bindValue(':recipe_description', $clean);
        //$s->bindValue(':recipe_description', $_POST['recipe_description']);
        $s->bindValue(':fileToUpload', $_FILES['fileToUpload']["name"]);
        $s->bindValue(':authorid', $_SESSION['aid']);
        $s->execute();

        }
        catch (PDOException $e)
        {
          $error = 'Error adding submitted recipe data';
          include 'error.html.php';
          exit();
        }
      }

  $recipeid = $pdo->lastInsertId();

	

	// Insert record into category table.

	if (isset($_POST['categories']))
  {
    try 
  	{
      $sql = 'INSERT INTO recipe_categories SET
  		recipeid = :recipeid,
  		categoryid = :categoryid';

  		$s = $pdo->prepare($sql);
  		
      foreach ($_POST['categories'] as $categoryid)
  		{
  			$s->bindValue(':recipeid', $recipeid);
  			$s->bindValue(':categoryid', $categoryid);
			$s->execute();
    }
  }
  catch (PDOException $e)
  {
    $error = 'Error inserting recipe into selected categories.';
    include 'error.html.php';
    exit();
  } 
  }

    // Insert record into prep_time table.

    try 
    {
    	$sql = 'INSERT INTO prep_time SET
      prep_time = :prep_time';
      $s = $pdo->prepare($sql);
      $s->bindValue(':prep_time', $_POST['prep_time']);
      $s->execute();
      $preptimeid = $pdo->lastInsertId();
    } 
    catch (Exception $e) 
    {
    	$error = 'Error inserting recipe prep times.';
    	include 'error.html.php';
    	exit();
    }

    // Insert record into cook_time table.

    try 
    {
    	$sql = 'INSERT INTO cook_time SET
      cook_time = :cook_time';

      $s = $pdo->prepare($sql);
      $s->bindValue(':cook_time', $_POST['cook_time']);
      $s->execute();

		$cooktimeid = $pdo->lastInsertId();
    } 
    catch (Exception $e) 
    {
    	$error = 'Error inserting recipe cook times.';
    	include 'error.html.php';
    	exit();
    }

    // Insert record into recipe_times relational table (prep_time & cook_time).

    if(isset($_POST['prep_time']) && isset($_POST['cook_time'])) 

    {

    	try 
    	{
        $sql = 'INSERT INTO recipe_times SET
        recipeid = :recipeid,
        preptimeid = :preptimeid,
        cooktimeid = :cooktimeid';

        $s = $pdo->prepare($sql);
  			$s->bindValue(':recipeid', $recipeid);
  			$s->bindValue(':preptimeid', $preptimeid);
  			$s->bindValue(':cooktimeid', $cooktimeid);
        $s->execute();
    	} 
    	catch (PDOException $e) 
    	{
    		$error = 'Error inserting recipe times.';
    		include 'error.html.php';
    		exit();
    	}
    }

    // Insert record into serves table.

    try 
    {
    	$sql = 'INSERT INTO serves SET
      serves = :serves';

      $s = $pdo->prepare($sql);
      $s->bindValue(':serves', $_POST['servings']);
      $s->execute();
      $servesid = $pdo->lastInsertId();
    } 
    catch (Exception $e) 
    {
    	$error = 'Error inserting recipe prep times.';
    	include 'error.html.php';
    	exit();
    }

    // Insert record into recipe_serves relational table (serves).

	if(isset($_POST['servings'])) 
    {
    	try 
    	{
        $sql = 'INSERT INTO recipe_serves SET
        recipeid = :recipeid,
        servesid = :servesid';

        $s = $pdo->prepare($sql);
  			$s->bindValue(':recipeid', $recipeid);
  			$s->bindValue(':servesid', $servesid);
        $s->execute();
    	} 
    	catch (PDOException $e) 
    	{
    		$error = 'Error inserting recipe servings.';
    		include 'error.html.php';
    		exit();
    	}
    }

     // Insert record into instructions table.

    try 
    {
      require_once "../includes/HTMLPurifier.standalone.php";
      $purifier = new HTMLPurifier();

      $clean = $purifier->purify($_POST['recipe_instructions']);

    	$sql = 'INSERT INTO instructions SET
      recipe_instructions = :recipe_instructions';

      $s = $pdo->prepare($sql);
      $s->bindValue(':recipe_instructions', $clean);
      //$s->bindValue(':recipe_instructions', $_POST['recipe_instructions']);
      $s->execute();

      $instructionsid = $pdo->lastInsertId();
    } 
    catch (PDOException $e) 
    {
    	$error = 'Error adding submitted recipe instructions into database.';
    	include 'error.html.php';
    	exit();
    }

    // Insert record into recipe_instructions relational table -> instructions.

	if(isset($_POST['recipe_instructions'])) 

    {
      try 
    	{
        $sql = 'INSERT INTO recipe_instructions SET
        recipeid = :recipeid,
        instructionsid = :instructionsid';

        $s = $pdo->prepare($sql);
        $s->bindValue(':recipeid', $recipeid);
  			$s->bindValue(':instructionsid', $instructionsid);
        $s->execute();
    	} 
    	catch (PDOException $e) 
    	{
    		$error = 'Error adding submitted recipe & instructions ids into database.';
    		include 'error.html.php';
    		exit();
    	}
    }


    // Insert record into ingredients table.

    try 
    {
      require_once "../includes/HTMLPurifier.standalone.php";
      $purifier = new HTMLPurifier();

      $clean = $purifier->purify($_POST['recipe_ingredients']);

    	$sql = 'INSERT INTO ingredient SET
      ingredients = :ingredients';

      $s = $pdo->prepare($sql);
      $s->bindValue(':ingredients', $_POST['recipe_ingredients']);
      //$s->bindValue(':ingredients', $_POST['recipe_ingredients']);
      $s->execute();

      $ingredientsid = $pdo->lastInsertId();
    } 
    catch (PDOException $e) 
    {
    	$error = 'Error adding submitted recipe ingredients into database.';
    	include 'error.html.php';
    	exit();
    }

     // Insert record into recipe_ingredients relational table -> ingredients.

    if(isset($_POST['recipe_ingredients'])) 

    {
      try 
      {
        $sql = 'INSERT INTO recipe_ingredients SET
        recipeid = :recipeid,
        ingredientid = :ingredientsid';
        
        $s = $pdo->prepare($sql);
        $s->bindValue(':recipeid', $recipeid);
  			$s->bindValue(':ingredientsid', $ingredientsid);
        $s->execute();
    	} 
    	catch (PDOException $e) 
    	{
    		$error = 'Error adding submitted recipe & ingredients ids into database.';
    		include 'error.html.php';
    		exit();
    	}
    }
  
    header('Location: .');
    exit();
  }
}
}


/********************************************************************************/

// THIS BLOCK OF CODE RUNS ONCE EDIT BUTTON IS CLICKED -> EDIT RECIPE.

if (isset($_POST['action']) and $_POST['action'] == 'Update')
{
  include '../includes/db.inc.php';

  try
  {
    $sql = 'SELECT recipe_id, recipe_name, recipe_description, recipe_author_id 
    FROM recipes 
    WHERE recipe_id = :recipe_id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':recipe_id', $_POST['recipe_id']);
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Error fetching recipe details from database.';
    include 'error.html.php';
    exit();
  }

  $row = $s->fetch();

  $pageTitle            = 'Edit Recipe';
  $action               = 'editform';
  $recipe_id            = $row['recipe_id'];
  $recipe_name          = $row['recipe_name'];
  $recipe_description   = $row['recipe_description'];
  // $recipe_image         = $row['recipe_image'];
  $authorid             = $row['recipe_author_id'];
  $button               = 'Update Recipe';




	// Build list of authors.
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
    $authors[] = array(

      'author_id'     => $row['author_id'], 
      'author_name'   => $row['author_name'] 
    );
  }

  // Get list of categories containing this recipe.
  try
  {
    $sql = 'SELECT categoryid FROM recipe_categories WHERE recipeid = :recipeid';
    $s = $pdo->prepare($sql);
    $s->bindValue(':recipeid', $recipe_id);
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Error fetching list of selected categories.';
    include 'error.html.php';
    exit();
  }
  foreach ($s as $row) {

    $selectedCategories[] = $row['categoryid'];
  }

  // Build list of categories.
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
    $categories[] = array(
      'category_id'     => $row['category_id'], 
      'category_name'   => $row['category_name'], 
      'selected'        => in_array($row['category_id'], $selectedCategories));
  }

  // Getting recipe prep and cook times.
  try 
  {
    $sql = 'SELECT prep_time, cook_time 
    FROM recipe_times 
    INNER JOIN prep_time ON prep_time_id = preptimeid 
    INNER JOIN cook_time ON cook_time_id = cooktimeid 
    WHERE recipeid = :recipe_id';
    $s = $pdo->prepare($sql);
    $s->bindvalue(':recipe_id', $_POST['recipe_id']);
    $s->execute();
  } 
  catch (PDOException $e) 
  {
    $error = 'Error fetching recipe times!';
    include 'error.html.php';
    exit();
  }

  //fetching recipe times
  $row = $s->fetch();

  $prep_time = $row['prep_time'];
  $cook_time = $row['cook_time'];


  // Getting recipe serve amounts.
  try 
  {
    $sql = 'SELECT serves
    FROM recipe_serves 
    INNER JOIN serves ON serves_id = servesid
    WHERE recipeid = :id';
    $s = $pdo->prepare($sql);
    $s->bindvalue(':id', $_POST['recipe_id']);
    $s->execute();
  } 
  catch (PDOException $e) 
  {
    $error = 'Error fetching serves from database!';
    include 'error.html.php';
    exit();  
  }

  // Fetching recipe serves
  $row = $s->fetch();

  $servings = $row['serves'];

  


  // Getting recipe ingredients.
  try 
  {
    $sql = 'SELECT ingredients FROM recipe_ingredients
    INNER JOIN ingredient ON ingredient_id = ingredientid
    WHERE recipeid = :recipeid';
    $s = $pdo->prepare($sql);
    $s->bindvalue(':recipeid', $_POST['recipe_id']);
    $s->execute();
  } 
  catch (PDOException $e) 
  {
    $error = 'Error fetching ingredients from database!';
    include 'error.html.php';
    exit(); 
  }

  // Fetching recipe ingredients
  $row = $s->fetch();

  $recipe_ingredients   = $row['ingredients'];



  // Getting recipe instructions.
  try 
  {
    $sql = 'SELECT recipe_instructions FROM recipe_instructions
    INNER JOIN instructions ON instructions_id = instructionsid
    WHERE recipeid = :recipeid';
    $s = $pdo->prepare($sql);
    $s->bindvalue(':recipeid', $_POST['recipe_id']);
    $s->execute();
  } 
  catch (PDOException $e) 
  {
    $error = 'Error fetching instructions from database!';
    include 'error.html.php';
    exit(); 
  }

  // Fetching recipe instructions
  $row = $s->fetch();

  $recipe_instructions  = $row['recipe_instructions'];




// Show the edit recipe version of the form.
include 'recipe_form.html.php';
exit();
}

/*****************************************************************************/

// THIS BLOCK OF CODE UPDATES THE EDITED RECIPE.

if (isset($_GET['editform']))
{
  include '../includes/db.inc.php';
  if ($_POST['author'] == '')
  {
    $error = 'You must choose an author for this joke. Click back and try again.';
    include 'error.html.php';
    exit(); 
  }

  if (empty($_FILES['fileToUpload']["name"])) {

    $sql = 'UPDATE recipes SET
    recipe_name         = :recipe_name,
    recipe_description  = :recipe_description,
    recipe_upload_date  = CURDATE(),
    recipe_author_id    = :authorid
    WHERE recipe_id     = :recipe_id';
 
    $s = $pdo->prepare($sql);
    $s->bindValue(':recipe_name',         $_POST['recipe_name']);
    $s->bindValue(':recipe_id',           $_POST['recipe_id']);
    $s->bindValue(':recipe_description',  $_POST['recipe_description']);
    $s->bindValue(':authorid',            $_POST['author']);
    $s->execute();
  }


  // Check if new recipe image has been selected.

  if (!empty($_FILES['fileToUpload']["name"])) {

  // Uploading a new selected image to the chosen file directory.

  $target_dir = "../../assets/img/upload/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Check if image file is a actual image or fake image

  // if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
  // echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
  // }

  // Check if file already exists
  if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }

  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }

  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0; }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    
  // if everything is ok, try to upload file
  } 
  else 
  {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

    // Delete old image from the server.
      try 
      {
        $sql ='SELECT recipe_image FROM recipes WHERE recipe_id = :recipe_id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':recipe_id', $_POST['recipe_id']);
        $s->execute();
      } 
      catch (PDOException $e) 
      {
        $error = 'Error deleting recipe image from the server.';
        include 'error.html.php';
        exit();    
      }

      $row = $s->fetch();

      unlink("../../assets/img/upload/" . $row['recipe_image']);

     // Update primary recipe records along with the new image.
      try 
      {
        require_once "../includes/HTMLPurifier.standalone.php";
        
        $purifier = new HTMLPurifier();
        $clean = $purifier->purify($_POST['recipe_description']);

        $sql = 'UPDATE recipes SET
        recipe_name         = :recipe_name,
        recipe_description  = :recipe_description,
        recipe_upload_date  = CURDATE(),
        recipe_image        = :fileToUpload,
        recipe_author_id    = :authorid
        WHERE recipe_id     = :recipe_id';
    
        $s = $pdo->prepare($sql);
        $s->bindValue(':recipe_name',         $_POST['recipe_name']);
        $s->bindValue(':recipe_id',           $_POST['recipe_id']);
        $s->bindValue(':recipe_description',  $clean);
        $s->bindValue(':fileToUpload',        $_FILES['fileToUpload']["name"]);
        $s->bindValue(':authorid',            $_POST['author']);
        $s->execute();
      }
      catch (PDOException $e)
      {
        $error = 'Error updating submitted joke.';
        include 'error.html.php';
        exit();
      }
    }
    // If image has not been selected than keep old image and update only relevent data.
    // Update primary recipe records without image.
}


}


  // Removing obsolete recipe category entries. 
  try
  {
    $sql = 'DELETE FROM recipe_categories WHERE recipeid = :recipeid';
    $s = $pdo->prepare($sql);
    $s->bindValue(':recipeid', $_POST['recipe_id']);
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Error removing obsolete recipe category entries.';
    include 'error.html.php';
    exit();
  }

  if (isset($_POST['categories']))
  {
    try
    {
      $sql = 'INSERT INTO recipe_categories SET
      recipeid = :recipeid,
      categoryid = :categoryid';

      $s = $pdo->prepare($sql);

      foreach ($_POST['categories'] as $categoryid)
      {
        $s->bindValue(':recipeid', $_POST['recipe_id']);
        $s->bindValue(':categoryid', $categoryid);
        $s->execute();
      }
    }
    catch (PDOException $e)
    {
      $error = 'Error inserting joke into selected categories.';
      include 'error.html.php';
      exit();
	 } 
  }

  //Updates recipe prep time records.
  try 
  {
    $sql = 'UPDATE recipe_times 
    INNER JOIN prep_time ON prep_time_id = preptimeid
    SET 
    prep_time = :preptime
    WHERE recipeid = :recipe_id';
    $s = $pdo->prepare($sql);
    $s->bindvalue(':recipe_id', $_POST['recipe_id']);
    $s->bindvalue(':preptime', $_POST['prep_time']);
    $s->execute();
  } 
  catch (PDOException $e) 
  {
    $error = 'Error adding submitted recipe servings record.';
    include 'error.html.php';
    exit();
  }

  //Updates recipe cook time records.
  try 
  {
    $sql = 'UPDATE recipe_times 
    INNER JOIN cook_time ON cook_time_id = cooktimeid
    SET 
    cook_time = :cooktime
    WHERE recipeid = :recipe_id';
    $s = $pdo->prepare($sql);
    $s->bindvalue(':recipe_id', $_POST['recipe_id']);
    $s->bindvalue(':cooktime', $_POST['cook_time']);
    $s->execute();
  } 
  catch (PDOException $e) 
  {
    $error = 'Error adding submitted recipe servings record.';
    include 'error.html.php';
    exit();
  }


  // Updates recipe servings records.
  try 
  {
    $sql = 'UPDATE recipe_serves 
    INNER JOIN serves ON serves_id = servesid
    SET 
    serves = :servings 
    WHERE recipeid = :recipe_id';
    $s = $pdo->prepare($sql);
    $s->bindvalue(':recipe_id', $_POST['recipe_id']);
    $s->bindvalue(':servings', $_POST['servings']);
    $s->execute();
  } 
  catch (PDOException $e) 
  {
    $error = 'Error adding submitted recipe servings record.';
    include 'error.html.php';
    exit();
  }


  // Updates recipe ingredients records.
  try 
  {
    $sql = 'UPDATE recipe_ingredients 
    INNER JOIN ingredient ON ingredient_id = ingredientid
    SET 
    ingredients = :recipe_ingredients 
    WHERE recipeid = :recipe_id';
    $s = $pdo->prepare($sql);
    $s->bindvalue(':recipe_id', $_POST['recipe_id']);
    $s->bindvalue(':recipe_ingredients', $_POST['recipe_ingredients']);
    $s->execute();
  } 
  catch (PDOException $e) 
  {
    $error = 'Error adding submitted recipe ingredients record.';
    include 'error.html.php';
    exit();
  }

  // Updates recipe instructions record.
  try 
  {
    $sql = 'UPDATE recipe_instructions 
    INNER JOIN instructions ON instructions_id = instructionsid
    SET 
    recipe_instructions = :recipe_instructions 
    WHERE recipeid = :recipe_id';
    $s = $pdo->prepare($sql);
    $s->bindvalue(':recipe_id', $_POST['recipe_id']);
    $s->bindvalue(':recipe_instructions', $_POST['recipe_instructions']);
    $s->execute();
  } 
  catch (PDOException $e) 
  {
    $error = 'Error adding submitted recipe instructions record.';
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
      $sql = 'SELECT recipe_id, recipe_name , recipe_image
      FROM recipes WHERE recipe_id = :id';
      $s = $pdo->prepare($sql);
      $s->bindvalue(':id', $_POST['recipe_id']);
      $s->execute();

    } catch (Exception $e) {
      
      $error = 'Error fetching author!';
      include 'error.html.php';
      exit();
    }

    // Fetching author details from the sent author id.
    
    $row = $s->fetch();
      $recipe_id      = $row['recipe_id'];
      $recipe_name    = $row['recipe_name'];
      $recipe_image   = $row['recipe_image'];


    include 'confirm_delete.html.php';
    exit();
  }



/********************************************************************************/

  // THIS BLOCK OF CODE DELETES AUTHOR ALONG WITH ALL HIS RECIPES.

  if (isset($_POST['action']) and $_POST['action'] == 'Yes - Delete') 
  {

    include '../includes/db.inc.php';


    // Delete old image from the server.
    try 
    {
      $sql ='SELECT recipe_image FROM recipes WHERE recipe_id = :recipe_id';
      $s = $pdo->prepare($sql);
      $s->bindValue(':recipe_id', $_POST['recipe_id']);
      $s->execute();
    } 
    catch (PDOException $e) 
    {
      $error = 'Error deleting recipe image from the server.';
      include 'error.html.php';
      exit();    
    }

    $row = $s->fetch();

    unlink("../../assets/img/upload/" . $row['recipe_image']);
    // Selecting and deleting author from the database.

    try 
    {
      $sql = 'DELETE FROM recipes WHERE recipe_id = :id';
      $s = $pdo->prepare($sql);
      $s->bindvalue(':id', $_POST['recipe_id']);
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

// THIS BLOCK OF CODE DELETES SPECIFIED RECORDS FROM THE DATABASE.

if (isset($_POST['action']) and $_POST['action'] == 'Delete')
{
  include '../includes/db.inc.php';

  // Delete image file from the server.
  try 
  {
    $sql ='SELECT recipe_image FROM recipes WHERE recipe_id = :recipe_id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':recipe_id', $_POST['recipe_id']);
    $s->execute();
    
  } 
  catch (PDOException $e) 
  {
    
    $error = 'Error deleting recipe image from the server.';
    include 'error.html.php';
    exit();    
  }
  $row = $s->fetch();

  unlink("../../assets/img/upload/" . $row['recipe_image']);

  // Delete recipe record from the table.
  try
  {
    $sql = 'DELETE FROM recipes WHERE recipe_id = :recipe_id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':recipe_id', $_POST['recipe_id']);
    $s->execute();
  }

  catch (PDOException $e)
  {
    $error = 'Error deleting recipe record from the server.';
    include 'error.html.php';
    exit();
  }

  header('Location: .');
  exit();
}




/******************************************************************************/

//build search query and show results

if(isset($_GET['action']) and $_GET['action'] == 'search')
{
	include '../includes/db.inc.php';

$select = 'SELECT id, joketext';
$from = ' FROM joke';
$where = ' WHERE TRUE';
$placeholders = array();

if ($_GET['author'] != '') //An author is selected
{
	$where .= " AND authorid = :authorid";
	$placeholders[':authorid'] = $_GET['author'];
}

if ($_GET['category'] != '') //A category is selected
{
	$from .= ' INNER JOIN jokecategory ON id = jokeid';
	$where .= " AND categoryid = :categoryid";
	$placeholders[':categoryid'] = $_GET['category'];
}

if ($_GET['text'] != '') //Some search text was specified
{
	$where .= " AND joketext LIKE :joketext";
	$placeholders[':joketext'] = '%' . $_GET['text'] . '%';
}
//run search query
try
{
	$sql =  $select . $from . $where;
	$s = $pdo->prepare($sql);
	$s->execute($placeholders);
}
catch (PDOException $e)
{
	$error = 'Error fetching jokes.';
	include 'error.html.php';
	exit();
}

foreach ($s as $row) 
{
	$jokes[] = array('id' =>$row['id'], 'text' =>$row['joketext']);
}
// show search results
include 'jokes.html.php';
exit();

}

/******************************************************************/


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

if(userHasRole('User'))
{
try 
{
   $sql = 'SELECT recipes.recipe_id, recipe_name, recipe_description, recipe_upload_date, recipe_image, author_name 
    FROM recipes 
    INNER JOIN author ON author_id = recipe_author_id
    WHERE author_id = :user_id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':user_id', $_SESSION['aid']);
    $s->execute();
  
} catch (PDOException $e) {
  
  $error = 'Error fetching recipe data from database!';
  include 'error.html.php';
  exit();
}

foreach ($s as $row) {
  $recipes[]  = array(

    'recipe_id'            => $row['recipe_id'],
    'recipe_name'          => $row['recipe_name'], 
    'recipe_description'   => $row['recipe_description'],
    'recipe_upload_date'   => $row['recipe_upload_date'],
    'recipe_image'         => $row['recipe_image'],
    'author_name'          => $row['author_name']
    

  );
}
include "recipes.html.php";
exit(); 
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
}

include "recipes.html.php";
