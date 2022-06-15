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


// THIS BLOCK OF CODE RETRIEVES AUTHOR RECORDS FROM DB AND SENDS A MASS MESSAGE.


$pageTitle 		= 'Send email';
$formTitle 		= 'Form title';
$button 		= 'Default';



// Loading message form once "Send Mass Email" button is clicked.

if (isset($_POST ['mass']) ){



	include '../includes/db.inc.php';
     
    

    // Selecting total number of authors.
    try {
    	
    	$sql = 'SELECT COUNT(*) FROM author';
    	$res = $pdo->query($sql);
    } 
	catch (PDOException $e) 
	{
		$error = 'Erro fetching total count of authors in the database.' . $e->getMessage();
		include 'error.html.php';
		exit();
	}

	$author_count = $res->fetchColumn();


    try
    {
        $result = $pdo->query("SELECT * FROM author");    
    }
    catch (PDOException $e)
    {
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


    $formTitle		= 'Send email to : ';
    $formTitle 		.= $author_count .= ' authors' ;
	$pageTitle 		= 'Send Email';
	$author_name 	= $row['author_name'];
	$author_email 	= $row['author_email'];
	$author_id 		= $row['author_id'];
	$button 		= 'Send Mass Email';
	$formTarget		= 'multi_message.html.php';


	include 'mailForm.html.php';
	exit();

    
}

if (isset($_POST ['submit']) and $_POST['submit']  == 'Send Mass Email' ){
	
    include '../includes/db.inc.php';

try
    {
        $result = $pdo->query("SELECT * FROM author");    
    }
    catch (PDOException $e)
    {
        $error = 'Error sending mass email';
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
    


    include 'multi_message.html.php';
    exit();

	}


/******************************************************************************/

	// THIS BLOCK OF CODE FETCHES AUTHOR DETAILS AND LOAD MAILING FORM FOR A SINGLE AUTHOR.

	if (isset($_POST['single']) )
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

			$formTitle		= 'Send email to : ';
			$formTitle 		.= $row['author_name'];
			$pageTitle 		= 'Send Email';
			$author_name 	= $row['author_name'];
			$author_email 	= $row['author_email'];
			$author_id 		= $row['author_id'];
			$button 		= 'Send Email';

		include 'mailForm.html.php';
		exit();
	}



    if (isset($_POST['submit']) and $_POST['submit'] == 'Send Email'){
        
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

			$formTitle		= 'Send email to : ';
			$formTitle 		.= $row['author_name'];
			$pageTitle 		= 'Send Email';
			$author_name 	= $row['author_name'];
			$author_email 	= $row['author_email'];
			$author_id 		= $row['author_id'];
			$button 		= 'Send Email';

		include 'single_message.html.php';
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

include 'mail.html.php';
    
    
 ?>