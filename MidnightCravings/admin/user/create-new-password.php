<?php include_once '../includes/helpers.inc.php'; ?>


<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit-cover">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous"><link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../assets/css/style.css">
  
  </head>
  <body class="text-center">
    <header class="masthead">
      <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center">
          <div class="form_wrapper">
            <form class="" action="../includes/forgottenpwd/reset-password.inc.php" method="post">
              
              <?php 
                
                $selector   = $_GET["selector"];
                $validator  = $_GET["validator"];

                if (empty($selector) || empty($validator)){
                  echo "Could not validate your request!";
                }
                else
                {
                  if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
                    ?>

                    <form action="../includes/forgottenpwd/reset-request.inc.php" method="post">

                      <input type="hidden" name="selector" value="<?php echo $selector; ?>">
                      <input type="hidden" name="validator" value="<?php echo $validator; ?>">
                      <div class="form-group">
                        <input class="form-control rounded-0 form_elements" type="password" name="pwd" placeholder="Enter a new password...">
                      </div>
                      <div class="form-group">
                        <input class="form-control rounded-0 form_elements" type="password" name="pwd-repeat" placeholder="Repeat new password...">
                      </div>
                      <button class="form-control btn btn-dark rounded-0 outline_buttons login_btn" type="submit" name="reset-password-submit">Reset password</button>
                    </form>

                    <?php

                  }
                }
              ?>
        </div>
      </div>
    </header>
        <?php include "../includes/scripts.inc.html.php"; ?>
    <script src="../../assets/js/my_plugins.js"></script>
  </body>
</html>
