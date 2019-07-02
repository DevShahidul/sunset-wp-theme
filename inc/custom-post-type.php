<?php 

/*
@package sunsettheme

    ===============================
       Theme Custom post type
    =============================== */
   

// Custom Build-in Contact option
$custom_contact = get_option('sunset_contact');
if(@$custom_contact == 1 ){
    add_action('init', 'sunset_contact_custom_post_type');
    add_filter('manage_sunset-contact_posts_columns', 'sunset_set_contact_columns'); // Add custom contact columns
    add_action('manage_sunset-contact_posts_custom_column', 'sunset_contact_custom_column', 10, 2); // Add custom contact columns details
    // Add contact email filed with metabox
    add_action('add_meta_boxes', 'sunset_contact_add_meta_box');
    
    //Save contact email data
    add_action('save_post', 'sunset_save_contact_email_deta');
}

// Contact Custom post type
function sunset_contact_custom_post_type(){
    $labels = array(
        'name'                  => 'Messages',
        'singular_name'         => 'Message',
        'menu_name'             => 'Messages',
        'name_admin_bar'        => 'Message'
    );
    
    $args = array(
        'labels'                => $labels,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'capability_type'       => 'post',
        'hierarchical'          => false,
        'menu_position'         => 26,
        'menu_icon'             => 'dashicons-email-alt',
        'supports'              => array('title', 'editor', 'author')
    );
    
    register_post_type('sunset-contact', $args);
}

// Set custom contact columns
function sunset_set_contact_columns($columns){
    $newColumns = array();
    $newColumns['title'] = "Full Name";
    $newColumns['message'] = "Message";
    $newColumns['email'] = "Email";
    $newColumns['date'] = "Date";
    return $newColumns;
}

// Custom contact column content
function sunset_contact_custom_column($column, $post_id){
    switch($column){
        case 'message' :
            echo get_the_excerpt();
            break;
        case 'email' :
            $email = get_post_meta($post_id, '_contact_email_value_key', true);
            echo $email;
            break;
            
    }
}

/* Contact meta boxes */
function sunset_contact_add_meta_box(){
    //add_meta_box(string $id, string $title, callback $callback, mixed $screen string $contex, string $priority, array $callback_args);
    add_meta_box('sunset_contact_email', 'User Email', 'sunset_contact_email_callback', 'sunset-contact', 'normal', 'default');
}

// Contact meta callback function
function sunset_contact_email_callback($post){
    //wp_nonce_field(mixed $action, string $name, bool, $referer, bool $echo);
    wp_nonce_field('sunset_save_contact_email_deta', 'sunset_contact_email_meta_box_nonce');
    //get_post_meta(int $post_id, string $key, bool $single);
    $value = get_post_meta($post->ID, '_contact_email_value_key', true);
    
    echo '<label for="sunset_contact_email_field">User Email Address: </label><input type="email" id="sunset_contact_email_field" name="sunset_contact_email_field" required value="'. esc_attr($value) .'" size="25" />';
}

// Save contact email function
function sunset_save_contact_email_deta( $post_id ){
    if(! isset($_POST['sunset_contact_email_meta_box_nonce'])){
        return;
    }
    if(! wp_verify_nonce($_POST['sunset_contact_email_meta_box_nonce'], 'sunset_save_contact_email_deta')){
        return;
    }
    if(! current_user_can('edit_post', $post_id)){
        return;
    }
    if(! isset($_POST['sunset_contact_email_field'])){
        return;
    }
    $my_data = sanitize_text_field($_POST['sunset_contact_email_field']);
    
    update_post_meta($post_id, '_contact_email_value_key', $my_data);
}