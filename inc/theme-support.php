<?php 

/*
@package sunsettheme

    ===============================
        Theme support functions
    =============================== */

function sunset_theme_support(){
    // Custom header
    $defaults = array(
        'default-image'          => '',
        'width'                  => 0,
        'height'                 => 0,
        'flex-height'            => false,
        'flex-width'             => false,
        'uploads'                => true,
        'random-default'         => false,
        'header-text'            => true,
        'default-text-color'     => '',
        'wp-head-callback'       => '',
        'admin-head-callback'    => '',
        'admin-preview-callback' => '',
    );
    
    // Custom header option
    $header = get_option('custom_header');    
    if(@$header == 1 ){
        add_theme_support( 'custom-header', $defaults );
    }
    

    // Custom background
    $defaults = array(
        'default-image'          => '',
        'default-preset'         => 'default', // 'default', 'fill', 'fit', 'repeat', 'custom'
        'default-position-x'     => 'left',    // 'left', 'center', 'right'
        'default-position-y'     => 'top',     // 'top', 'center', 'bottom'
        'default-size'           => 'auto',    // 'auto', 'contain', 'cover'
        'default-repeat'         => 'repeat',  // 'repeat-x', 'repeat-y', 'repeat', 'no-repeat'
        'default-attachment'     => 'scroll',  // 'scroll', 'fixed'
        'default-color'          => '',
        'wp-head-callback'       => '_custom_background_cb',
        'admin-head-callback'    => '',
        'admin-preview-callback' => '',
    );
    
    
    // Custom background option
    $background = get_option('custom_background');    
    if(@$background == 1 ){
        add_theme_support( 'custom-background', $defaults );
    }

    // Post thumbnails
    add_theme_support( 'post-thumbnails' );
    //add_image_size( 'post-thumbnails', 'full', 'full', false );
    //add_theme_support( 'post-thumbnails' );
    /*add_theme_support( 'post-thumbnails', array( 'post' ) );          // Posts only
    add_theme_support( 'post-thumbnails', array( 'page' ) );          // Pages only
    add_theme_support( 'post-thumbnails', array( 'post', 'movie' ) ); // Posts and Movies*/

    //Custom logo
    add_theme_support( 'custom-logo', array(
        'default-image' => 'true',
        'uploads'      => 'true',
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    ) );

    //Title tage
    add_theme_support( 'title-tag' );

    // HTML 5
    add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
    

    // Post formates function
    $options = get_option('post_fromats');
    $formats = array('aside', 'gallery', 'video', 'link', 'image', 'quote', 'status', 'audio', 'chat');
    $output = array();
    foreach($formats as $format){
        $output[] = (@$options[$format] == 1 ? $format : '');
    }
    
    if(!empty( $options )){
        add_theme_support( 'post-formats', $output );
    }
    
}
add_action('after_setup_theme', 'sunset_theme_support');

/*  =========================
        Register nav menu
    ========================= */

function sunset_register_nav_menu(){
    register_nav_menus( array(
        'main-menu'     => 'Header menu',
        'footer-menu'     => 'Footer menu'
    ) );
}
add_action( 'after_setup_theme', 'sunset_register_nav_menu' );





// Posted meta function
function sunset_posted_meta(){    
    $postedOn = human_time_diff(get_the_time('U'), current_time('timestamp'));
    $categories = get_the_category();
    $separator = ', ';
    $output = '';
    $i = 1;
    if(!empty($categories)):
        foreach($categories as $category):
            if($i > 1) : $output .= $separator; endif;
            $output .= '<a href="'. esc_url(get_category_link($category->term_id)) .'">'. esc_html($category->name) .'</a>';
            $i++;
        endforeach;
    endif;
    
    return '<span class="posted-on"> Posted <a href="'. get_the_permalink() .'">'. $postedOn .'</a> ago</span> / <span class="posted-in">In '. $output .'</span>';
}


function sunset_posted_footer(){
    $comments_num = get_comments_number();
    if( comments_open() ){
        if($comments_num == 0){
            $comments = __('No comments');
        }elseif($comments_num > 1){
            $comments = $comments_num . __(' comments');
        }else{
            $comments = __('1 Comment');
        }
        $comments = '<a href="'. get_comments_link() .'">'. $comments .'</a>';
    }else{
        $comments = __('Comments are closed');
    }
    return '<div class="post-footer-inner clear">'. get_the_tag_list( '<div class="tags-list-wrap"><span class="sunset-icon icon-tag"></span>', ' ', '</div>') .'<div class="comments-wrap">'.$comments.'<span class="sunset-icon icon-comment"></span></div></div>';
}


function sunset_get_attachment($num = 1){
    $output = '';
    if( has_post_thumbnail() && $num == 1 ): 
        $output = wp_get_attachment_thumb_url( get_post_thumbnail_id( get_the_ID() ) );
    else:
        $attachments = get_posts(array(
            'post_type'     => 'attachment',
            'post_per_page' => $num,
            'post_parent'   => get_the_ID()
        ));
        if($attachments && $num == 1) :
            foreach ($attachments as $attachment):
                $output = wp_get_attachment_url( $attachment->ID );
            endforeach;
        elseif($attachments && $num > 1):
                $output = $attachments;
        endif;
        wp_reset_postdata();
    endif; 
    return $output;
}


// Embeded media function
function the_embeded_media( $type = array() ){
    $content = do_shortcode(apply_filters( 'the_content', get_the_content() ));
    $embed = get_media_embedded_in_content( $content, $type );
    if(in_array('audio', $type)):
        $output = str_replace('?visual=true', '?visual=false', $embed[0]);    
    else:
        $output = $embed[0];
    endif;
    
    return $output;

}






?>