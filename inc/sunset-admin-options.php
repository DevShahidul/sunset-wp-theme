<?php

/*
@package sunsettheme

    =========================
        Admin page
    ========================= */


function sunset_menu_page(){
    //add_menu_page(string $page-title, string $menu-title, string $capability, string $menu-slug, string $calback-function, string $dash-icon, number $menu-index-number);
    add_menu_page('Sunset Theme Options ', 'Sunset Options', 'manage_options', 'sunset_options', 'sunset_theme_create_page', get_template_directory_uri(). '/img/dash-icon-sunset.png', 110);
    
    //Add submenu
    //add_submenu_page(string $parent_slug, string $page_title, string $menu_title, string $capability, string menu_slug, callbak $function);
    add_submenu_page('sunset_options', 'Sunset sidebar option', 'Sidebar', 'manage_options', 'sunset_options', 'sunset_theme_create_page');
    add_submenu_page('sunset_options', 'Sunset theme support', 'Theme support', 'manage_options', 'sunset_theme_support', 'sunset_theme_supports');
    
    add_submenu_page('sunset_options', 'Sunset Custom CSS', 'CUstom CSS', 'manage_options', 'sunset_custom_css', 'sunset_custom_css_callback');
}
add_action('admin_menu', 'sunset_menu_page');

// Sunset option callback function
function sunset_theme_create_page(){
    require_once(get_template_directory().'/inc/admin-templates/admin-options-page.php');
}

// Sunset theme support callback function
function sunset_theme_supports(){
    require_once(get_template_directory(). '/inc/admin-templates/sunset-theme-support-page.php');
}

// Sunset Custom css callback function
function sunset_custom_css_callback(){
    require_once(get_template_directory(). '/inc/admin-templates/sunset-custom-css-page.php');
}


// Register menu page functions
function sunset_register_menu_page(){
    // Register settings  =========== ***** ========
    //register_setting(string $option_grounp, string $option_name, callback $sanitize_callback);
    register_setting('sunset-sidebar-settings-group', 'sidebar_profile_picture');
    register_setting('sunset-sidebar-settings-group', 'sidebar_first_name');
    register_setting('sunset-sidebar-settings-group', 'sidebar_last_name');
    register_setting('sunset-sidebar-settings-group', 'sidebar_description');
    register_setting('sunset-sidebar-settings-group', 'sidebar_twitter', 'sunset_sanitize_twitter_handler');
    register_setting('sunset-sidebar-settings-group', 'facebook_twitter');
    register_setting('sunset-sidebar-settings-group', 'linkedin_twitter');
    
    //Add setting section =========== ***** ========
    //add_settings_section(string $id, string $title, string $callback-function, string $page);
    add_settings_section('sunset-sidebar-options', 'Sidebar Option', 'sunset_sidebar_options', 'sunset_options');
    
    // Add settings field  =========== ***** ========
    //add_settings_field(string $id, string $title, string $callback, string $page, string $section);
    add_settings_field('sidebar-profile-picture', 'Your profile picture', 'add_profile_picture', 'sunset_options', 'sunset-sidebar-options');
    add_settings_field('sidebar-name', 'Your name', 'input_sidebar_name', 'sunset_options', 'sunset-sidebar-options');
    add_settings_field('sidebar-description', 'Your description', 'input_sidebar_description', 'sunset_options', 'sunset-sidebar-options');
    add_settings_field('sidebar-twitter', 'Twitter handler', 'input_sidebar_twitter_handler', 'sunset_options', 'sunset-sidebar-options');
    add_settings_field('sidebar-facebook', 'Facebook handler', 'input_sidebar_facebook_handler', 'sunset_options', 'sunset-sidebar-options');
    add_settings_field('sidebar-linkedin', 'Linkedin handler', 'input_sidebar_linkedin_handler', 'sunset_options', 'sunset-sidebar-options');
    // ============== *** End side bar settings section *** ============
    
    //Register settings for sunset theme options ========== *** ==========
    register_setting('sunset-theme-support', 'post_fromats');
    register_setting('sunset-theme-support', 'custom_header');
    register_setting('sunset-theme-support', 'custom_background');
    register_setting('sunset-theme-support', 'sunset_contact');
    
    //Add setting section =========== ***** ========
    add_settings_section('sunset-theme-options', 'Theme Options', 'sunset_theme_options_section', 'theme_options');
    
    // Add settings field  =========== ***** ========
    add_settings_field('post-formats', 'Post Formats', 'sunset_post_formats', 'theme_options', 'sunset-theme-options');
    add_settings_field('custom-header', 'Header option', 'sunset_custom_header', 'theme_options', 'sunset-theme-options');
    add_settings_field('custom-background', 'Background option', 'sunset_custom_background', 'theme_options', 'sunset-theme-options');
    add_settings_field('custom-contact-option', 'Contact option', 'sunset_custom_contact', 'theme_options', 'sunset-theme-options');
    // ============== *** End theme options section *** ============
    
    // Register Sunset =============== *** Custom css options *** ===============
    register_setting('sunset-custom-css-setting', 'custom_css');
    
    //Add setting section
    add_settings_section('sunset-custom-css-section', 'Custom CSS', 'sunset_custom_css_section_callback', 'sunset_custom_css');
    
    //Register Custom css settings field
    add_settings_field('sunset-custom-css-filed', 'Sunset Custom Css', 'sunset_custom_css_field_callback', 'sunset_custom_css', 'sunset-custom-css-section');
    
    
}
add_action('admin_init', 'sunset_register_menu_page');

// Sunset Custom css function
function sunset_custom_css_section_callback(){
    echo 'Customize Sunset Theme with your own css';
}
// Sunset custom css field function
function sunset_custom_css_field_callback(){
    $css = get_option('custom_css');
    $css = ( empty($css) ? '/* Write your own css for sunset theme */' : $css);
    
    echo '<div id="customCsseditor">'.$css.'</div><textarea id="custom_css" name="custom_css" style="display:none; visibility: hidden;">'.$css.'</textarea>';
}

// Function for menu page  
function sunset_sidebar_options(){
    echo "customize option";
}

// ================ *** This functions for sidebar *** ================
// profile picture field function
function add_profile_picture(){    
    $sidebarProfilePicture = esc_attr(get_option( 'sidebar_profile_picture' ));
    if(empty($sidebarProfilePicture)){
        echo '<button class="upload_profile_picture button button-secondary" id="upload_btn">Upload Profile Picture</button> <input type="hidden" name="sidebar_profile_picture" value="" id="sidebar_profile_picture_picker" />';
    }else{
        echo '<button class="upload_profile_picture button button-secondary" id="upload_btn">Replace Profile Picture</button> <input type="hidden" name="sidebar_profile_picture" value="'.$sidebarProfilePicture.'" id="sidebar_profile_picture_picker" /> <button class="remove_profile_picture button button-secondary" id="remove_btn">Remove</button>';
    }
    
}

//Sidebar Name field function 
function input_sidebar_name(){
    $firstName = esc_attr(get_option('sidebar_first_name'));
    $lastName = esc_attr(get_option('sidebar_last_name'));
    echo '<input type="text" value="'.$firstName.'" name="sidebar_first_name" placeholder="First name" /><input type="text" value="'.$lastName.'" name="sidebar_last_name" placeholder="Last name" />';
}

//Sidebar description field function 
function input_sidebar_description(){
    $description = esc_attr(get_option('sidebar_description'));
    echo '<input type="text" value="'.$description.'" name="sidebar_description" placeholder="Description" /><p class="description">Write something smart</p>';
}

//Sidebar twitter handler field function
function input_sidebar_twitter_handler(){
    $twitterHandler = esc_attr(get_option('sidebar_twitter'));
    echo '<input type="text" name="sidebar_twitter" value="'.$twitterHandler.'" placeholder="Twitter handler" /> <p class="description">Input your twitter user name without the @ character</p>' ;
}

//Sidebar facebook handler field function
function input_sidebar_facebook_handler(){
    $facebookHandler = esc_attr(get_option('sidebar_facebook'));
    echo '<input type="text" name="sidebar_facebook" value="'.$facebookHandler.'" placeholder="Facebook handler" />' ;
}

//Sidebar linkedin handler field function
function input_sidebar_linkedin_handler(){
    $facebookHandler = esc_attr(get_option('sidebar_linkedin'));
    echo '<input type="text" name="sidebar_linkedin" value="'.$facebookHandler.'" placeholder="Linkedin handler" />' ;
}

//Sanitization settings
function sunset_sanitize_twitter_handler($input){
    $output = sanitize_text_field($input);
    $output = str_replace('@', '', $output);
    return $output;
}

// ========= *** End sidebar section functions *** =======

// =============== *** Theme support functions *** ========

// Theme options section 
function sunset_theme_options_section(){
    echo 'Activate and Deactivate specific Theme Support Options';
}

//Theme support custom header field function
function sunset_custom_header(){
    $custom_header = get_option('custom_header');
    $checked = (@$custom_header == 1 ? 'checked' : '' );
    echo '<label> <input type="checkbox" id="custom_header" name="custom_header" value="1" '.$checked.' />Active Custom Header option</label>';
}

//Theme support custom background field function
function sunset_custom_background(){
    $custom_background = get_option('custom_background');
    $checked = (@$custom_background == 1 ? 'checked' : '' );
    echo '<label> <input type="checkbox" id="custom_background" name="custom_background" value="1" '.$checked.' />Active Custom Background option</label>';
}

//Theme support custom contact field function
function sunset_custom_contact(){
    $custom_contact = get_option('sunset_contact');
    $checked = (@$custom_contact == 1 ? 'checked' : '' );
    echo '<label> <input type="checkbox" id="sunset_contact" name="sunset_contact" value="1" '.$checked.' />Active the Built-in Contact Form</label>';
}


//Theme support post formats field function
function sunset_post_formats(){
    $options = get_option('post_fromats');
    $formats = array('aside', 'gallery', 'video', 'link', 'image', 'quote', 'status', 'audio', 'chat');
    $output = '';
    foreach($formats as $format){
        $checked = (@$options[$format] == 1 ? 'checked' : '' );
        $output .= '<label> <input type="checkbox" id="'.$format.'" name="post_fromats['.$format.']" value="1" '.$checked.' />' . $format . '</label> <br>';
    }
    echo $output;
}




?>