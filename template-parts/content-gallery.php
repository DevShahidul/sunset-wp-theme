<?php

/*  
@packge sunsettheme
    
    ==================================
    	Gallery content template
    ==================================
*/

?>

<article id="post-<?php the_ID();?>" <?php post_class('sunset-gallery-formate');?>>
    <?php if (sunset_get_attachment()) : 
        $attachments = sunset_get_attachment(3);
    ?>

        <div class="post-gallery-wrap" id="post-gallery-<?php the_ID();?>">
            <?php 
                $i = 0;
                foreach ($attachments as $attachment) : 
                $active = ( $i == 0 ? 'active' : '');
            ?>
                <div class="gallery-item background-image <?php echo $active; ?>" style="background-image: url(<?php echo wp_get_attachment_url( $attachment->ID ); ?>);">
                    
                </div>
            <?php $i++; endforeach; ?>
        </div>
    <?php endif; ?>
    <header class="post-header text-center">
        <?php the_title('<h1 calss="post-title">', '</h1>'); ?>
    </header>
    <div class="post-meta text-center">
        <?php echo sunset_posted_meta(); ?>
    </div>
    <div class="post-content-wrap">
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