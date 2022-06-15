<?php include_once "includes/helpers.inc.php";?>


<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit-cover">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous"><link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
  
  </head>
  <body class="text-center">
    <header class="masthead">
      <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center">
          <div class="form_wrapper">
            
            <form class="form-signin" action="" method="post">
              <h1 class="h3 mb-3 font-weight-normal form_title">Account Login</h1>
              <span id="errorLogin"></span>

              <?php if (isset($_GET['newpwd'])) {
                if($_GET["newpwd"] == "passwordupdated") {
                  echo "<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>Success!</strong> Your password is reset!</div>";
                }
              } ?>
              
              <div>
              <!-- Embedded form validation in case HTML and jQuary fails -->
              <?php if(isset($loginError)): ?>
                <p><?php echo($loginError); ?></p>
              <?php endif; ?>
              <!-- Embedded form validation in case HTML and jQuary fails / -->
              </div>

              <div class="form-group">
                <label for="email" class="sr-only">Email</label>
                <input type="email" id="email" name="email" class="form-control rounded-0 form_elements" placeholder="Email address">   
              </div>          
              <div class="form-group">
                <label for="password" class="sr-only">Password</label>
                <input type="password" id="password" name="password" class="form-control rounded-0 form_elements" placeholder="Password">
              </div>
              <div class="form-group">
                <input type="hidden" name="action" value="login">
                <input type="hidden" name="author" value="<?php echo html($_SESSION['aid']);?>">
                <input class="form-control btn btn-dark rounded-0 outline_buttons login_btn" id="login_form" type="submit" value="Sign in">
              </div>
              <div class="form-group text-left">
                <!-- Here we have a form that starts the password recovery process -->
                <a href="reset-password.php">Forgot your password?</a>
                <hr>
              </div>

              <a class="reg-hype-link" href="reg/">
                <div class="form-group new-account-btn">
                  Create New Account
                </div>
              </a>
               
            </form>
            <span>&copy; 2020&ndash;<?php echo date( 'Y' ); ?> by Kestutis Sebelskis</span> 
          </div>
        </div>
      </div>
    </header>
        <?php include "includes/scripts.inc.html.php"; ?>
    <script src="../assets/js/my_plugins.js"></script>
  </body>
</html>
