<?php

/*  
@packge sunsettheme
    
    =============================
        Audio content template
    =============================
*/

?>

<article id="post-<?php the_ID();?>" <?php post_class('sunset-audio-formate');?>>
    <header class="post-header">
        <?php the_title('<h1 calss="post-title">', '</h1>'); ?>
    </header>
    <div class="post-meta text-center">
        <?php echo sunset_posted_meta(); ?>
    </div>
    <div class="post-content-wrap">
        <div class="post-content">
            <?php echo the_embeded_media(array('audio', 'iframe')); ?>
        </div>
    </div>
    <footer class="post-footer-wrap">
        <?php echo sunset_posted_footer(); ?>
    </footer>
</article>