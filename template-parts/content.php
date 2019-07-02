<?php

/*  
@packge sunsettheme
    
    ========================
    	content template
    ========================
*/

?>

<article id="post-<?php the_ID();?>" <?php post_class();?>>
    <header class="post-header text-center">
        <?php the_title('<h1 calss="post-title">', '</h1>'); ?>
    </header>
    <div class="post-meta text-center">
        <?php echo sunset_posted_meta(); ?>
    </div>
    <div class="post-content-wrap">
        <?php if( sunset_get_attachment() ): ?>
            <a href="<?php the_permalink(); ?>" class="standard-featured-link">
                <div class="post-thumbnail background-image" style="background-image: url(<?php echo sunset_get_attachment(); ?>);"></div>
            </a>
        <?php endif; ?>
        <div class="post-content">
            <?php the_excerpt(); ?>
        </div>
        <div class="btn-wrap text-center">
            <a href="<?php the_permalink(); ?>" class="btn btn-default"><?php _e('Read More'); ?></a>
        </div>
    </div>
    <footer class="post-footer-wrap">
        <?php echo sunset_posted_footer(); ?>
    </footer>
</article>