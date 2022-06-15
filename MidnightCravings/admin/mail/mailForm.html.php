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
          <h1><?php html($formTitle); ?></h1>
          <form action="" method="post">
            <div class="form-group">
              <label class="control-label" for="subject">Email Subject</label></br> 
                <input class="form-control form_elements" type="text" name="subject" placeholder="Type email subject" required="required">
              </div>
              <div class="form-group">
                <textarea name="message" id="form-message" rows="10" class="form-control" required="required" placeholder="Your message..." required="required"></textarea>
              </div>
            <input type="hidden" name="id" value="<?php html($author_id); ?>">
                <input type="submit" name="submit" class="btn btn-success form_submit_button" value="<?php html($button); ?>">
                <a href="./" class="btn btn-outline-secondary rounded-0">Close</a>
              </form>
            </div>         
        </div>
      </div>
  </body>
</html>
