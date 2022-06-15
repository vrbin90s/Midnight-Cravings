<?php include_once '../includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title><?php html($pageTitle); ?></title>
    <?php include "../includes/admin_head.inc.html.php"; ?>
    <script src="https://cdn.tiny.cloud/1/nyz0kgau4ri1l3ug01fw1eee0zzii80oxas1hj4sa7g6mqze/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
</head>
<body>

    <div class="container"> <!-- Start Container -->

        <h1><?php html($pageTitle); ?></h1>

        <form  class="add_recipe" action="?<?php html($action); ?>" method="post" enctype="multipart/form-data">
            
            <div class="form-group"> <!-- Start Recipe Name Field -->
                <label class="control-label" for="name" >Recipe Name</label>
                <input type="text" class="form-control form_elements" name="recipe_name" id="recipe_name" value="<?php html($recipe_name); ?>" placeholder="Enter your recipe name" required="required">
            </div> <!-- End Recipe Name Field -->

            <div class="form-group"> <!-- Start Recipe Decription Field -->
                <label class="control-label" for="description" >Short Description</label>
            </br>
                <textarea class="form-control form_elements" type="text" name="recipe_description" rows="3" id="recipe_description" placeholder="Write short description of your recipe (Max. 250 words)."><?php echo $recipe_description; ?></textarea>
            </div> <!-- End Recipe Description Field -->


            <div class="form-check form-check-inline"> <!-- Start Recipe Category Checkboxes -->

                <div class="row">
                    <div class="col-12">
                        <?php foreach ($categories as $category): ?>

                            <label class="form-check-label pr-3">
                                <input class="form-check-input pr-3 checky " type="checkbox" name="categories[]" value="<?php html($category['category_id']); ?>"
                                
                                <?php if ($category['selected'])
                                {
                                    echo ' checked';
                                } 
                                ?>><?php html($category['category_name']); ?>
                            </label>
                        <?php endforeach; ?>                        

                    </div>
                </div>
                   
            </div> <!-- End Recipe Category Checkboxes -->
            

            <div class="form-group"> <!-- Start Recipe Prep-Time -->
                <label class="control-label" for="prep_time" >Prep Time</label>
                <input class="form-control form_elements" type="number" name="prep_time"  id="prep_time" value="<?php html($prep_time); ?>" placeholder="How long to prepare ( in Minutes )" required="required">
            </div> <!-- End Recipe Prep-Time -->

            <div class="form-group"> <!-- Start Recipe Cook-Time -->
                <label class="control-label" for="cook_time" >Cooking Time</label>
                <input class="form-control form_elements" type="number" name="cook_time"  id="cook_time" value="<?php html($cook_time); ?>" placeholder="Cooking time ( in Minutes )" required="required">
            </div> <!-- End Recipe Cook-Time -->

            <div class="form-group"> <!-- Start Recipe Servings -->
                <label class="control-label" for="servings" >Servings</label>
                <input class="form-control form_elements" type="number" name="servings"  id="servings" value="<?php html($servings); ?>"placeholder="How many people will be served ( in numbers e.g. 4 )" required="required">
            </div> <!-- End Recipe Servings -->


            <div class="form-group"> <!-- Start Recipe Ingredients Field -->
                <label class="control-label" for="recipe_ingredients" >Ingredients</label>
            </br>
                <textarea class="form-control form_elements" type="text" name="recipe_ingredients" rows="3" id="recipe_ingredients" placeholder="Write the list of all ingredients (Max. 250 words)."><?php echo $recipe_ingredients; ?></textarea>
            </div> <!-- End Recipe Ingredients Field -->

             <div class="form-group"> <!-- Start Recipe Instructions Field -->
                <label class="control-label" for="recipe_instructions" >Instructions</label>
            </br>
                <textarea class="form-control form_elements" type="text" name="recipe_instructions" rows="3" id="recipe_instructions" placeholder="Write cooking instructions (Max. 500 words)."><?php echo $recipe_instructions; ?></textarea>
            </div> <!-- End Recipe Instructions Field -->           
            
            <div> <!-- Start Recipe Author Selection -->
                <label for="author">Author:</label>
                <select class="form-control form_elements" name="author" id="author">
                    <option value="">Select one</option>

                    <?php foreach ($authors as $author): ?>
                        <option value="<?php html($author['author_id']); ?>"<?php

                        if ($author['author_id'] == $authorid)
                        {
                            echo ' selected';
                        } ?>><?php html($author['author_name']); ?></option>

                        <?php endforeach; ?>
                </select>
            </div> <!-- End Recipe Author Selection -->

            </br>

            <div class="custom-file"> <!-- Start Recipe Image Upload -->
                <input class="custom-file-input rounded-0" type="file" id="fileToUpload" name="fileToUpload">
                <label class="custom-file-label pt-6" for="fileToUpload">Select the image of your dish</label>
            </div> <!-- End Recipe Image Upload -->

            

            <div class="sub-button"> <!-- Start Recipe Submit Button & Form Close Options -->
                <input type="hidden" name="recipe_id" value="<?php html($recipe_id); ?>"></br>
                <input type="submit" name="submit" class="btn btn-success form_submit_button" value="<?php html($button); ?>">
                <a href="./" class="btn btn-outline-secondary rounded-0">Close</a>
            </div></br> <!-- End Recipe Submit & Form Close Options -->


        </form>
        <script>
            tinymce.init({
                selector: 'textarea',
                plugins: ['advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'],
                toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
            });
        </script>
    </div> <!-- End Container -->

    
<?php include '../includes/scripts.inc.html.php' ?>
    

    <script>
            $('#fileToUpload').on('change',function(){
                //get the file name
                var fileName = $(this).val();
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(fileName);
            })
    </script>

</body>
</html>