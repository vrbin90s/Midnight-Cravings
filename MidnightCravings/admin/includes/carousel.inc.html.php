<?php include_once 'admin\includes\helpers.inc.php'; ?>

<!--====CAROUSELE INDICATORS====-->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
<!--==END CAROUSELE INDICATORS==-->
  
<!--===START CAROUSELE SLIDES===-->
  <div class="carousel-inner">

    <?php $active = true; ?>

  
    <?php 

      $i = 0;

      foreach($slides as $slide):
        if ($i >= 3) { break; } else{ ?> <!--If loop index increases to 3 than loop breaks -->

      <div class="carousel-item <?php echo ($active == true)?"active":"" ?>"> 

        <img src="assets\img\upload\<?php echo html( $slide['recipe_image'] ); ?>" class="d-block w-100" alt="...">
        
        <a href="#"> <!--Start Caption Field Link-->
          <div class="carousel-caption"> <!--Start Carousel Caption-->

              <h6 class="h6-responsive">by <?php echo html( $slide['author_name'] ); ?></h6>
              <h3 class="h3-responsive"><?php echo html( $slide['recipe_name'] ); ?></h3>

          </div> <!--End Carousel Caption-->
        </a> <!--End Caption Field Link-->
      </div>
    
    <?php $active = false; ?>

  <?php $i++; } endforeach; ?>

  </div>

<!--=== END CAROUSELE SLIDES ===-->

<!--====== START CONTROLS ======-->

  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<!--======= END CONTROLS =======-->