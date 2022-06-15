<?php include_once 'includes\helpers.inc.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <title>Web CMS</title>
  <?php include 'includes/head.inc.html.php'; ?>
  <link href="../assets/css/dashboard.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
</head>
<body>
  
  <!--Start Top Navigation-->
  <nav class="navbar navbar-dark sticky-top flex-md-nowrap p-0 top-navbar">
  <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3 logo" href="../">Midnight Cravings</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="custom-toggler-icon"><i class="fas fa-bars"></i></span>
  </button>

  <!-- Start Sign Out Button -->
  <div class="admin_desktop_toolbar">
    <form action="" method="post">
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <input type="hidden" name="action" value="logout">
          <input type="hidden" name="goto" value="../">
          <div class="input-container">
            <button class="btn btn-link sign_out_btn" type="submit"><i class="fas fa-sign-out-alt fa-fw"></i>&nbsp;Sign Out</button>
          </div>
        </li>
      </ul>
    </form>
  </div>
  <!-- End Signt Out Button -->
</nav>
<!--End Top Navigation-->

<!-- Start Sidebar Section -->
<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="sidebar-sticky pt-3 side_bar_links">
        <ul class="nav flex-column">

          <li class="nav-item "><a href="" class="nav-link active"><i class="fas fa-tachometer-alt fa-fw" aria-hidden="true"></i>&nbsp;Dashboard</a></li>

          <?php 
          if(userHasRole('Account Administrator'))
          {
            echo "<li class='nav-item'>
            <a href='authors/' class='nav-link'>
            <i class='fas fa-user-alt fa-fw dashboard-user-icon' aria-hidden='true'></i>&nbsp;Authors</a></li>";
          }
          ?>

          <?php 
          if(userHasRole('Site Administrator'))
          {
            echo "<li class='nav-item'>
            <a class='nav-link' href='categories/'><i class='fas fa-sitemap fa-fw' aria-hidden='true'></i>&nbsp;Categories</a></li>";
          }
          ?>

          <?php
          if(userHasRole('Content Editor'))
          { 
            echo "<li class='nav-item'>
            <a class='nav-link' href='recipes/'><i class='fas fa-book fa-fw' aria-hidden='true'></i>&nbsp;Recipes</a></li>";
          }
          ?>

          <?php 
          if(userHasRole('Account Administrator'))
          {            
            echo "<li class='nav-item'>
            <a class='nav-link' href='mail/'><i class='fas fa-envelope fa-fw' aria-hidden='true'></i>&nbsp;Send Mail</a></li></li>";
          }
          ?>

          <li class="nav-item mobile_toolbar_nav">
            <form action="" method="post">
              <input type="hidden" name="action" value="logout">
              <input type="hidden" name="goto" value="..">
              <button class="btn btn-link mobile_logout_btn" type="submit"><i class='fas fa-sign-out-alt mobile_signout_icon fa-fw' aria-hidden='true'></i>&nbsp;Sign Out</button>
            </form>
          </li>
        </ul>
      </div> <!-- Start Sidebar Nav /-->
    </nav>
  </div> <!-- End Row /-->
</div>
<!-- End Sidebar Navigation /-->

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4" id="page-conent">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <div class="dashboard-title">
          <h1 class="content-title">Dashboard</h1>
          <h5>Welcome <?php echo $authorName; ?></h5>
        </div>
      </div>

      <!-- Start Breadcrumbs -->
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="">Dashboard</a></li>
          <li class="breadcrumb-item active" aria-current="page">Data</li>
        </ol>
      </nav>
      <!-- SEnd Breadcrumbs -->

      <div class="content" id="content"> <!-- Start card wrapper-->
        <div class="row row-cols-1 row-cols-md-2"> <!-- Start Row -->

          <?php 
            if (userHasRole('Account Administrator') || userHasRole('Content Editor'))
            {
            $output = "<div class='col mb-4'>";
            $output .= "<div class='card bg-light admin_cards'>";
            $output .= "<div class='card-header'>";
            $output .= "<h2>Total Recipes</h2></div>";
            $output .= "<div class='card-body admin_card_body'>";
            $output .= "<p class='card-text'>";
            $output .= "$recipe_count</p>";
            $output .= "</div>";
            $output .= "</div>";
            $output .= "</div>";
            
            echo $output;
            }
          ?>


          <?php 
            if (userHasRole('Account Administrator'))
            {
            $output = "<div class='col mb-4'>";
            $output .= "<div class='card bg-light admin_cards'>";
            $output .= "<div class='card-header'>";
            $output .= "<h2>Total Authors</h2></div>";
            $output .= "<div class='card-body admin_card_body'>";
            $output .= "<p class='card-text'>";
            $output .= "$author_count</p>";
            $output .= "</div>";
            $output .= "</div>";
            $output .= "</div>";
            
            echo $output;
            }
          ?>
               

          <?php if(userHasRole('Account Administrator') || userHasRole('Site Administrator'))
          {
            
            $output = "<div class='col mb-4'>";
            $output .= "<div class='card admin_cards'>";
            $output .= "<div class='card-header'>";
            $output .= "<h2>Total Categories</h2></div>";
            $output .= "<div class='card-body admin_card_body'>";
            $output .= "<p class='card-text'>";
            $output .= "$category_count</p>";
            $output .= "</div>";
            $output .= "</div>";
            $output .= "</div>";
            
            echo $output;
          
          } 

          ?>
          <?php if(userHasRole('Account Administrator') || userHasRole('Content Editor'))
          {
            
            $output = "<div class='col mb-4'>";
            $output .= "<div class='card admin_cards'>";
            $output .= "<div class='card-header'>";
            $output .= "<h2>Latest Recipe Upload</h2></div>";
            $output .= "<div class='card-body admin_card_body'>";
            $output .= "<div class='recipe_text'>";
            $output .= "$recipe_name</br> by";
            $output .= " $author_name</br>";
            $output .= " on $rec_upload_date</div>";
            $output .= "</div>";
            $output .= "</div>";
            $output .= "</div>";
            
            echo $output;
          
          } 

          ?>
        </div> <!-- End Row -->
      </div> <!-- End card wrapper-->

    </main>
  </div>
</div>


<?php include 'includes/scripts.inc.html.php'; ?>

</body>
</html>

<script src="../assets/js/my_plugins.js"></script>