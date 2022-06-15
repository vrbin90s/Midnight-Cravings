<div class="container"> <!--Start Container-->


    <h2 class="text-uppercase font-weight-bold text-center" id="recipes">Recipes</h2>

            <div class="row pt-3">

            <?php 

            foreach ($recipes as $recipe): ?> 
                    
                <div class="col-sm-12 col-md-4 pb-3">
                    <div class="card rounded-0 recipe_card">
                        <img src="assets\img\upload\<?php echo $recipe[ 'recipe_image' ]; ?>" alt="" class="card-img-top rounded-0 max-height-100">
                        <div class="card-body">
                            <h5 class="mt-2 mb-3 recipe_cards_author_name">by <?php echo html($recipe['author_name']) ?></h5>
                            <h4><?php echo  $recipe[ 'recipe_name' ]; ?></h4>
                            <p class="lead border-top pt-3"><?php echo $recipe[ 'recipe_description' ]; ?></p>
                            <!-- <button type="button" class="btn btn-dark text-uppercase">Get the Recipe</button> -->
                            
                            <form action="" method="POST">
                            <input type="hidden" name="recipe_id" value="<?php echo $recipe['recipe_id']; ?>"> </br>
                            
                        </div>
                        <div class="card-footer text-muted m-0 p-0 text-center">
                            <input type="submit" name="action" value="get the recipe" class="card_input_link rounded-0">
                        </div>
                    </form>
                    </div>
                </div>
           
            <?php endforeach; ?>

            </div> <!-- End Row -->

      

</div> <!--End Container-->

