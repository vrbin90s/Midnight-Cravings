<?php //include_once 'admin/includes/helpers.inc.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Search Results</title>
  	<?php include_once "admin/includes/head.inc.html.php"; ?> 
</head>
<body>


	<div class="container-fluid header">

		<!--Start Single Page Header-->
		<div class="header-container">
			<div class="inner-container">
				<img src="assets/img/bg_single_page.jpg" class="img-fluid" alt="recipe-header-image" >
			</div>
		</div>
		<!--End Single Page Header-->

		<!--Start Header Content-->
		<div class="col-12 text-center page-header-caption">

			<h6>Search Results <?php //echo html( $author_name ); ?></h6>
			<h3><?php //echo html( $recipe_name ); ?></h3>

		</div>
		<!--End Header Content-->
	</div>



	<?php include 'search_form.html.php'; ?>

<!--====================================================-->
<!--================= RECIPE CARDS =====================-->
<!--====================================================-->

	<div class="container"> <!--Start Container-->

		<div class="row pt-3"> <!--Start Row-->

			<?php if (isset($recipes)): ?> <!--Start If Statment-->

			<?php foreach ($recipes as $recipe): ?>  <!--Start Foreach Loop-->
			
			<div class="col-sm-12 col-md-4 pb-3">
				<div class="card rounded-0 recipe_card">
					<img src="assets\img\upload\<?php echo $recipe[ 'recipe_image' ]; ?>" alt="" class="card-img-top rounded-0 max-height-100">
					<div class="card-body">
						<h5 class="mt-2 mb-3">by 
							<?php echo $recipe['author_name']; ?></h5>
						<h4><?php echo $recipe[ 'recipe_name' ]; ?></h4>

						<p class="lead border-top pt-3">
							<?php echo $recipe[ 'recipe_description' ]; ?></p>     

							<form action="?" method="post">
                            <input type="hidden" name="recipe_id" value="<?php echo $recipe['recipe_id']; ?>">
                            
                            
                        </div>
                        <div class="card-footer text-muted m-0 p-0 text-center">
                        	<input type="submit" name="action" value="get the recipe" class="card_input_link rounded-0">
                        </div>
                       </form>
                    </div>
                </div>
            <?php endforeach; ?> <!--End For Each Loop-->
	<?php endif; ?> <!--End If Statement-->

	</div> <!--End Row-->

	</div> <!--End Container-->

	<?php include_once 'admin/includes/footer.inc.html.php'; ?>

</body>
</html>