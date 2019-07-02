<?php 
/*
@package sunsettheme 
    
    ============================
        Admin enqueue function
    ============================ */

// Enqueue Admin css and js
function sunset_admin_css_js( $hook ){
    //echo $hook;
    
    if('toplevel_page_sunset_options' == $hook) {
        wp_enqueue_media();
        // Register sunset admin style
        wp_enqueue_style('admin-style', get_template_directory_uri().'/inc/admin-css/sunset-admin-style.css', array(), '1.0.0', 'all');

        // Register sunset admin scripts
        //wp_register_script( string $handle, string|bool $src, array $deps = array(), string|bool|null $ver = false, bool $in_footer = false );
        wp_enqueue_script('admin-script', get_template_directory_uri(). '/inc/js/sunset.admin.js', array('jquery'), '1.0.0', true);
    }else if('sunset-options_page_sunset_custom_css' == $hook){
        wp_enqueue_style('ace', get_template_directory_uri(). '/inc/admin-css/sunset-custom-css.css', array(), '1.0.0', 'all');
        
        wp_enqueue_script('ace', get_template_directory_uri(). '/inc/js/ace/ace.js', array('jquery'), '1.4.4', true);
        wp_enqueue_script('sunset-custom-script', get_template_directory_uri(). '/inc/js/sunset-custom-css.js', array('jquery'), '1.0.0', true);        
    }else{
        return;
        
    }
    
}
add_action('admin_enqueue_scripts', 'sunset_admin_css_js');


/*  ======================================
      Front-end Enqueue function 
    ====================================== */

    function register_theme_styles_and_scripts(){
        // Register style
        wp_enqueue_style( 'theme-icons', get_template_directory_uri(). '/css/icons.css', array(), '1.0.0', 'all' ); // Register font icons
        wp_enqueue_style( 'google_fonts', sunset_google_fonts_url(), array(), '1.0.0'); // Register Google fonts
        wp_enqueue_style( 'slick-style', get_template_directory_uri(). '/css/slick.css', array(), '1.9.0', 'all' ); // Register theme main style
        wp_enqueue_style( 'theme-main-style', get_template_directory_uri(). '/css/main.css', array(), '1.0.0', 'all' ); // Register theme main style

        // Register scripts
        wp_enqueue_script( 'jquery');
        wp_enqueue_script( 'slick-scripts', get_template_directory_uri(). '/js/slick.js', array('jquery'), '1.9.0', true );
        wp_enqueue_script( 'main-scripts', get_template_directory_uri(). '/js/main.js', array('jquery'), '1.0.0', true );
    }
    add_action( 'wp_enqueue_scripts', 'register_theme_styles_and_scripts');

    // google fonts
    function sunset_google_fonts_url() {
        $fonts_url = '';

        $raleway = _x( 'on', 'raleway font: on or off', 'theme-slug' );
        
        if ( 'off' !== $raleway ) {
            $font_families = array();

            if ( 'off' !== $raleway ) {
                $font_families[] = 'Raleway:100,200,300,400,500,600';
            }
            
            $query_args = array(
                'family' => urlencode( implode( '|', $font_families ) ),
                'subset' => urlencode( 'latin-ext,latin' ),
            );
            
            $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
        }

        return esc_url_raw($fonts_url);
    }


    function consult_editor_styles() {
        $raleway = ( array( 'editor-style.css', 'https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600' ) );
        add_editor_style( $raleway);
    }
    add_action('after_setup_theme', 'consult_editor_styles');


    function consult_custom_header_fonts(){
        wp_enqueue_style( 'raleway-fonts', 'https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600', array(), null );
    }
    add_action('admin_print_styles_appearance_page_custom-header', 'consult_custom_header_fonts');


?>


