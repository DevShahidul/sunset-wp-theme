<?php 

/*  
@packge sunsettheme
    
    ==================
      index template
    ================= */

?>



<?php echo get_header(); ?>
       
       <!-- =============================
            Beginning main conent section -->
       <main class="main-content-section">
          <div class="common-wrap clear">
                <div class="posts-wrap">
                    <?php if( have_posts() ): 

                        while( have_posts() ) : the_post();
                            get_template_part("template-parts/content", get_post_format());
                        endwhile;
                    endif;
                    ?>
                </div>
          </div>
       </main>
       <!-- //End main content section -->


       
<?php echo get_footer(); ?>