<?php //include_once 'admin\includes\helpers.inc.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Recipe</title>
  	<?php include_once "admin/includes/head.inc.html.php"; ?> 
</head>
<body>

	<?php include_once "admin/includes/nav_login.inc.html.php"; ?>
	


<!-- Start Header -->
	<div class="container-fluid header">

		<?php foreach ($recipes as $recipe): ?> <!-- Start Loop -->
		<div class="header-container"> <!-- Start Header Container -->
			<div class="inner-container">
				<img src="assets\img\upload\
				<?php echo $recipe['recipe_image']; ?>" class="img-fluid" alt="recipe-header-image" >
			</div>
		</div> <!-- End Header Container -->
		

		<!-- Start Header Caption -->
		<div class="col-12 text-center page-header-caption">

			<h6>by <?php echo $recipe['author_name']; ?></h6>
			<h3><?php echo $recipe['recipe_name']; ?></h3>

		</div>
		<!-- End Header Caption -->

		<?php endforeach; ?> <!-- End Loop -->
	</div>
<!-- End Header -->


<!-- Start Recipe Specification -->
	<div class="jumbotron text-center"> <!-- Start Jumbotron -->

		<div class="row d-flex justify-content-center">
		<div class="spec-padding">
			<div class="card spec specifications">
				<div class="card-body ">
					<div class="circle-icon"><i class="fas fa-mortar-pestle"></i></div>
					<h4 class="card-title spec">Prep</h4>
					<p class="card-text spec"><?php echo $prep_time; ?> minutes</p>
				</div>
			</div>
		</div>

		<div class="spec-padding">
			<div class="card spec specifications">
				<div class="card-body">
					<div class="circle-icon spec"><i class="fas fa-clock"></i></div>
					<h4 class="card-title spec">Cook</h4>
					<p class="card-text spec"><?php echo $cook_time; ?> minutes</p>
				</div>
			</div>
		</div>

		<div class="spec-padding">
			<div class="card spec specifications">
				<div class="card-body">
					<div class="circle-icon spec"><i class="fas fa-utensils"></i></div>
					<h4 class="card-title spec">Serves</h4>
					<p class="card-text spec"><?php echo $serves; ?> serves</p>
				</div>
			</div>
		</div>
</div>



	</div> <!-- End Jumbotron -->
<!-- End Recipe Specification -->

<!-- Start Recipe Page Content -->


		
	<div class="container content_wrapper"> <!-- Container Start -->
		<div class="row pt-6"> <!-- Row Start -->
			<div class="col-md-6">

					<h1>Description</h1>
				<p><?php
				echo $recipe['recipe_description'];  
				//html( $recipe['recipe_description'] ); 
				?></p>
				
				
			</div>
			<div class="col-md-6 right-wrapper">
				<div class="specifications">
					<h1>Ingredients</h1>
					<?php foreach ($ingredients as $ingredient): ?>
						<p><?php 
						echo $ingredient['ingredients'];
						//html( $ingredient['ingredients'] );

						?></p>
					<?php endforeach; ?>
				</div>

				<h1>Cooking Instructions</h1>
				<?php foreach ($instructions as $instruction): ?>
				<p><?php
				echo $instruction['recipe_instructions']; 
				//html( $instruction['recipe_instructions'] ); 
				?></p>
				<?php endforeach; ?>

			</div>
		</div> <!-- Row End -->
	</div> <!-- Container End -->

<!-- End Recipe Page Content -->



  <!--========================================-->
  <!--=== INCLUDE SCRIPTS AND SITE FOOTER ====-->
  <!--========================================-->

  <?php include_once "admin/includes/footer.inc.html.php"; ?>
  <?php include_once "admin/includes/scripts.inc.html.php"; ?>		

</body>
</html>