<?php include_once '../includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Confirm Delete Authors</title>
	<?php include "../includes/admin_head.inc.html.php"; ?>
</head>
<body>
	<div class="container confirm_delete_author">
		<div class="card text-center">
			<div class="card-header py-3">
				<h3 class="card-title">Confirm Delete Category ?</h3>
			</div>
			<div class="card-body">

				<form class="delete_form"  action="" method="post">
					<div class="form-group">

						<div class="delete-text">Do you really want to delete: <b> <?php html($category_name); ?> </b> category record from the system ? </div>
						<i class="fas fa-exclamation-triangle warning-icon"></i>
						<input type="hidden" name="id" value="<?php echo $category_id; ?>">
					</div>
					<div class="form-group">
						<input class="btn btn-outline-danger btn-lg button text-uppercase rounded-0" type="submit" name="action" value="Yes - Delete">
						<input class="btn btn-outline-secondary btn-lg button rounded-0" type="submit" name="action" value="Close">
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php include '../includes/scripts.inc.html.php'; ?>
</body>
</html>