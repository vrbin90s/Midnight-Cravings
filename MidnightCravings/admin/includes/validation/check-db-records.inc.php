<?php 

//--------------------------------------------------------------------
//--- [1] ------- PASSWORD RESET - EMAIL VALIDATION ------------------
//--------------------------------------------------------------------

if (isset($_GET["reset"])) 
{
  if($_GET["reset"] == "success")
  {

    $successMessage = "<div class='alert alert-success alert-dismissible'>";
    $successMessage .= "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
    $successMessage .= "<strong>Success!</strong>";
    $successMessage .= " Check your email to reset your password.</div>";

    echo $successMessage;

  }
  else if ($_GET["reset"] == "error") 
  {

    $errorMessage = "<div class='alert alert-danger alert-dismissible'>";
    $errorMessage .= "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
    $errorMessage .= "<strong>Error!</strong>";
    $errorMessage .= " The email that you've entered is incorrect or don't exist... Please try again...</div>";
      
    echo $errorMessage;
  }
    
}



