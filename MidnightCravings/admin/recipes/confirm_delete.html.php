<?php include_once '../includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Confirm Delete Recipe</title>
	<?php include "../includes/admin_head.inc.html.php"; ?>
</head>
<body>
	<div class="container confirm_delete_author">
		<div class="card text-center">
			<div class="card-header">

				<h3 class="card-title">Confimr Delete Recipe ?</h3>
			</div>
			<div class="card-body">

				<form class="delete_form_recipe"  action="" method="post">
					<div class="form-group">
						<p>Do you really want to delete <b class="text-uppercase"> <?php html($recipe_name); ?> </b> recipe from the server ?</p>
						<img src="../../assets/img/upload/<?php html($recipe_image); ?>" alt="" class="max-height-300">
						<input type="hidden" name="recipe_id" value="<?php echo $recipe_id; ?>">
					</div>
					<div class="form-group">
						<input class="btn btn-outline-danger rounded-0 btn-lg text-uppercase" type="submit" name="action" value="Yes - Delete">
						<input class="btn btn-outline-secondary rounded-0 btn-lg" type="submit" name="action" value="Close">
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>