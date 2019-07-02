<?php

/*  
@packge sunsettheme
    
    ===============================
        Image content template
    ===============================
*/

?>

<article id="post-<?php the_ID();?>" <?php post_class('sunset-image-formate');?>>
    <header class="post-header text-center background-image" style="background-image: url(<?php echo sunset_get_attachment(); ?>);">
        <?php the_title('<h1 calss="post-title">', '</h1>'); ?>
        <div class="post-meta text-center">
            <?php echo sunset_posted_meta(); ?>
        </div>
        <div class="image-caption"><?php the_content(); ?></div>
    </header>


    <footer class="post-footer-wrap text-center">
        <?php echo sunset_posted_footer(); ?>
    </footer>
</article>