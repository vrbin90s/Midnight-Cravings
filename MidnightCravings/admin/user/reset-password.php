<?php include_once '../includes/helpers.inc.php'; ?>


<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit-cover">
    <title>Reset password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous"><link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../assets/css/style.css">
  
  </head>
  <body class="text-center">
    <header class="masthead">
      <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center">
          <div class="form_wrapper">
            <form class="form-signin" action="../includes/forgottenpwd/reset-request.inc.php" method="post">
              <h1 class="h3 mb-3 font-weight-normal form_title">Forgot Password</h1>
              <!-- Include email validation to check if email exist in the db records -->
              <?php require "../includes/validation/check-db-records.inc.php" ?>
              <div class="form-group">
                <small>Please enter your email address below and we will send you an e-mail with instructions on how to reset your password.</small>
              </div>

              <span id="errorLogin"></span>

              <div class="form-group">
                <input class="form-control rounded-0 form_elements" type="email" name="email" placeholder="Enter your email address...">
              </div>

              <div class="form-group">
                <input class="form-control btn btn-dark rounded-0 outline_buttons login_btn" id="login_form" type="submit" name="reset-request-submit" value="Reset Password">         
              </div>

              <div class="form-group">
                <hr>
                <span>Take me back to the <a href="./">login</a> page</span>   
              </div>               
            </form>
          </div>
        </div>
      </div>
    </header>
        <?php include "../includes/scripts.inc.html.php"; ?>
    <script src="../../assets/js/my_plugins.js"></script>
  </body>
</html>
