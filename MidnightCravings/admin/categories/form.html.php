<?php include_once '../includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?php html($pageTitle); ?></title>
    <?php include "../includes/admin_head.inc.html.php"; ?>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1><?php html($pageTitle); ?></h1>
          <form action="?<?php html($action); ?>" method="post">
            <div class="form-group">
              <label class="control-label" for="category_name">Category Name</label></br> 
                <input class="form-control form_elements" type="text" name="category_name" id="category_name" placeholder="Enter category name" value="<?php html($category_name); ?>" required="required">
              </div>
                <input type="hidden" name="category_id" value="<?php html($category_id); ?>" required="required">
                <input type="submit" name="submit" class="btn btn-success form_submit_button" value="<?php html($button); ?>">
                <a href="./" class="btn btn-outline-secondary rounded-0">Close</a>
              </form>
            </div>         
        </div>
      </div>
  </body>
</html>