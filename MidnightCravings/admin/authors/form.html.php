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
              <label class="control-label" for="author_name">Name</label></br> 
                <input class="form-control form_elements" type="text" name="author_name" id="author_name" placeholder="Full Name e.g. John Smith" value="<?php html($author_name); ?>" required="required">
              </div>
              <div class="form-group ">
                <label class="control-label" for="author_email">Email</label></br> 
                  <input class="form-control form_elements" type="email" name="author_email" id="author_email" placeholder="Email address" value="<?php html($author_email); ?>" required="required">
              </div>
              <div class="form-group ">
                <label class="control-label" for="password">Password</label></br> 
                  <input class="form-control form_elements" type="password" name="password" id="password" placeholder="Set new password">
              </div>
              
              <fieldset>
                <legend>Roles:</legend>
                <?php for ($i = 0; $i < count($roles); $i++): ?>
                  <div>
                    <label for="role<?php echo $i; ?>"><input type="checkbox"
                      name="roles[]" id="role<?php echo $i; ?>"
                      value="<?php html($roles[$i]['id']); ?>"<?php
                      if ($roles[$i]['selected'])
                      {
                        echo ' checked';
                      }
                      ?>><?php html($roles[$i]['id']); ?></label>:
                      <?php html($roles[$i]['description']); ?>
                    </div>
                  <?php endfor; ?>
                </fieldset>

                <input type="hidden" name="author_id" value="<?php html($author_id); ?>">
                <input type="submit" name="submit" class="btn btn-success form_submit_button" value="<?php html($button); ?>">
                <a href="./" class="btn btn-outline-secondary rounded-0">Close</a>
              </form>
            </div>         
        </div>
      </div>
  </body>
</html>