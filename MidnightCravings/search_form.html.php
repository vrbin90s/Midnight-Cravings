<?php include_once 'admin/includes/helpers.inc.php'; ?>

<!DOCTYPE html>
<html>
<head>
</head>
<body>


	<div class="jumbotron"> <!--Start Jumbotron-->

		<div class="container">
			<form class="form-inline search_tool" action="" method="get">
				<div class="row">	
					<div class="form-group col-sm-12 col-md-4 p-1">
						<input type="text" name="text" id="text" 
						placeholder="Enter your keyword" class="form-control form_elements">
					</div>

					<div class="form-group col-sm-12 col-md-3 p-1">	
						<select name="author" id="author" class="form-control form_elements">
							<option value="">Browse by author</option>

							<?php foreach ($authors as $author): ?>
							
							<option value="<?php html($author['id']); ?>">
								<?php html($author['name']); ?></option>
							<?php endforeach; ?>
						</select>
					</div>

					<div class="form-group col-sm-12  col-md-3 p-1">

						<select name="category" id="category" class="form-control form_elements">
							<option value="">Browse by category</option>
						
						<?php foreach ($categories as $category): ?>
							
							<option value="<?php html($category['id']); ?>">
								<?php html($category['name']); ?></option>
							<?php endforeach; ?>
						</select>
					</div>

					<div class="form-group col-sm-12 col-md-2 p-1">
						<input class="form-control search_button" 
						type="submit" name="action" value="search">
					</div>


				</div> <!--End of the Row -->
			</form>
		</div> <!--End of Container-->
	</div> <!--End Jumbotron-->

</body>
</html>