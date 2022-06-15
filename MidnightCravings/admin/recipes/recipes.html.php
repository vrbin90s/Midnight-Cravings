<?php include_once '../includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <title>Manage Recipes</title>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>  
  <?php include "../includes/admin_head.inc.html.php"; ?>

  <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">

</head>
<body>

  <!-- Custom styles for this template -->


  <!--Start Top Navigation-->
  <nav class="navbar navbar-dark sticky-top flex-md-nowrap p-0 top-navbar">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3 logo" href="..">Midnight Cravings</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="custom-toggler-icon"><i class="fas fa-bars"></i></span>
    </button>

    <!-- Start Sign Out Button -->
  <div class="admin_desktop_toolbar">
    <form action="" method="post">
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <input type="hidden" name="action" value="logout">
          <input type="hidden" name="goto" value="../../">
          <div class="input-container">
            <button class="btn btn-link sign_out_btn" type="submit"><i class="fas fa-sign-out-alt fa-fw"></i>&nbsp;Sign Out</button>
          </div>
        </li>
      </ul>
    </form>
  </div>
    <!-- End Signt Out Button -->
  </nav>
  <!-- End Top Navigation -->

  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="sidebar-sticky pt-3 side_bar_links">
          <ul class="nav flex-column">
            <?php 
            if(userHasRole('User'))
            {
              echo "<li class='nav-item'><a href='../user/' class='nav-link'><i class='fas fa-tachometer-alt fa-fw' aria-hidden='true'></i>&nbsp;Dashboard</a></li>";
            }
            else
            {
              echo "<li class='nav-item'><a href='../' class='nav-link'><i class='fas fa-tachometer-alt fa-fw' aria-hidden='true'></i>&nbsp;Dashboard</a></li>";
            } 
            ?>
            
            <?php 
            if(userHasRole('Account Administrator'))
            {
              echo "<li class='nav-item'>
              <a href='../authors/' class='nav-link'>
              <i class='fas fa-user-alt fa-fw' aria-hidden='true'></i>&nbsp;Authors</a></li>";
            }
            ?>

            <?php 
            if(userHasRole('Site Administrator'))
            {
              echo "<li class='nav-item'>
              <a class='nav-link' href='../categories/'><i class='fas fa-sitemap fa-fw' aria-hidden='true'></i>&nbsp;Categories</a></li>";
            }
            ?>

            <?php
            if(userHasRole('Content Editor') || userHasRole('User'))
            { 
              echo "<li class='nav-item'>
              <a class='nav-link active' href=''><i class='fas fa-book fa-fw' aria-hidden='true'></i>&nbsp;Recipes</a></li>";
            }
            ?>

            <?php 
            if(userHasRole('Account Administrator'))
            {            
              echo "<li class='nav-item'>
              <a class='nav-link' href='../mail/'><i class='fas fa-envelope fa-fw' aria-hidden='true'></i>&nbsp;Send Mail</a></li></li>";
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
        </div>
      </nav>

  <!-- Start Content Wrapper -->
  <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
      
      <h1 class="content-title">Manage Recipes</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
          <a class="btn btn-sm btn-outline-secondary outline_buttons" href="?add">Add New Recipe</a>
          </div>
        </div>
      </div>

      <!-- Start Breadcrumbs -->
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="..">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="">Recipes</a></li>
          <li class="breadcrumb-item active" aria-current="page">Data</li>
        </ol>
      </nav>
      <!-- SEnd Breadcrumbs -->

      <!-- Start Content -->
      <div class="content">
        <div class="table-responsive">
          <table class="table table-bordered table-stripped display m-0" id="rec_table_id">
            <thead>
              <tr>
                <th width="20%">Name</th>
                <th class="recipes_data" width="40%">Description</th>
                <th class="recipes_data" width="10%">Author</th>
                <th class="recipes_data" width="10%">Date</th>
                <th width="10%">Edit</th>
                <th width="10%">Delete</th>
              </tr>
            </thead>
            <tbody>
              <?php if (empty($recipes)): ?>
                  
                  <p>No recipes yet...</p>
                
                <?php else: ?>

                <?php foreach ($recipes as $recipe): ?>
                  <tr>
                    <td><?php html($recipe['recipe_name']); ?></td>
                    <td class="recipes_data"><?php echo $recipe['recipe_description']; ?></td>
                    <td class="recipes_data"><?php html($recipe['author_name']); ?></td>
                    <td class="recipes_data"><?php html($recipe['recipe_upload_date']); ?></td>
                    <td>
                      <form action="?" method="post">
                        <div class="input-group">
                          <input type="hidden" name="recipe_id" value="<?php echo $recipe['recipe_id']; ?>">
                          <input class="form-control btn-outline-dark outline_buttons" type="submit" name="action" value="Update">
                        </div>
                    </td>
                    <td class="mobile_table_data">
                      <div class="input-group">
                        <input class="form-control btn-outline-danger rounded-0" type="submit" name="action" value="Delete">
                      </div>
                    </td>
                  </form>
                </tr>
              <?php endforeach; ?>
              <?php endif ?>
            </tbody>
          </table>
        </div>
      </div>
      <!-- End Content -->
    </main>
<!-- Start Content Wrapper -->


</body>
</html>

<script src="../../assets/js/my_plugins.js"></script>
<script src="https://kit.fontawesome.com/7cd9ab2ef8.js" crossorigin="anonymous"></script>