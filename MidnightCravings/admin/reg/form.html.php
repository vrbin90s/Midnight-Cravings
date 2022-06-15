<?php include_once '../includes/helpers.inc.php'; ?>


<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit-cover">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous"><link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../assets/css/style.css">
    <script src="https://www.google.com/recaptcha/api.js"></script>
  
  </head>
  <body class="text-center">
    <header class="masthead">
      <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center">
          <div class="form_wrapper">
            

            <form class="form-signin" action="?addform" method="post">
              <h1 class="h3 mb-3 font-weight-normal form_title">Create Account</h1>
              
              <!-- Fancy jquary and bootstrap form validation output -->
              <span id="error-creating-account"></span>

              <!-- Embedded backend form validation in case HTML and jQuary fails -->
              <?php if (isset($_GET['error'])) 
              {
                if($_GET["error"] == "regError") {
                  echo "<p>Some fields were empty. Please fill in all required information and try again.</p>";
                }
                else if ($_GET['error'] == "pwdError"){
                  echo "<p>Entered password don't match</p>";
                }
                else if ($_GET['error'] == "capError"){
                  echo "<p>Captcha is required</p>";
                }
                // else if ($_GET['error'] == "capFailed"){
                //   echo "<p>Captcha verification failed</p>";
                // }
              } 
              ?>
              <!-- End of Embedded form validation / -->

             <!--  Embedded backend successful registration messagge -->
              <?php if (isset($_GET['success'])) 
              {
                if($_GET["success"] == "registered") {
                  $messagge = "<div class='alert alert-success alert-dismissible'>";
                  $messagge .= "<strong>Success!</strong>";
                  $messagge .= "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
                  $messagge .= " Thank you for registering. You should receive a welcome email soon.";
                  $messagge .= "</div>";

                  echo $messagge;
                }
              } 
              ?>
              <!--  Successful registration messagge -->

              <div class="form-group">
                <label for="name" class="sr-only">Name</label>
                <input type="text" id="name" name="name" class="form-control rounded-0 form_elements" placeholder="Your name">
              </div>   
              <div class="form-group">
                <label for="email" class="sr-only">Email</label>
                <input type="email" id="email" name="email" class="form-control rounded-0 form_elements" placeholder="Your email address">
              </div>            

              <div class="form-group">
                <label for="password" class="sr-only">Password</label>
                <input type="password" id="pwd" name="pwd" class="form-control rounded-0 form_elements" placeholder="Create password"> 
              </div>

              <div class="form-group">
                <label for="password" class="sr-only">Confirm Password</label>
                <input type="password" id="pwd-repeat" name="pwd-repeat" class="form-control rounded-0 form_elements" placeholder="Repeat password"> 
              </div>
              <div class="form-group">
                <div class="g-recaptcha" data-sitekey="6LcMYYcaAAAAAA-gw-RgMA5bTVh-KCKlDsPvC1Yj"></div>
                <span id="captcha-error" class="text-danger"></span>
              </div>              
              <div  class="form-group">
                <!-- <input type="hidden" name="action" value="create-new-account"> -->
                <input class="form-control btn btn-dark rounded-0 outline_buttons login_btn" id="reg_form" type="submit" name="action" value="Register">
              </div>
              <div class="form-group">
                <hr> 
                <span>Take me back to the <a href="../user/">login</a> page</span> 
                 
                <!-- <span>&copy; 2020&ndash;<?php //echo date( 'Y' ); ?> by Kestutis Sebelskis</span> -->
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
