
        <div id="bodyleft">
          
            <?php if(!isset($_GET['cat_id'])){ ?>
              <h2>Deals Of The Day</h2>
           <div id="slider">
                <img name="sliderImgs" src="imgs/slider/leftslider0.jpg" alt="slider sale image">
                
            </div><!-- end of the slider -->
            <?php } ?>
        
                 <?php echo diaplay_categories(); ?>
          </ul>


        </div><!--end of the bodyleft -->
                