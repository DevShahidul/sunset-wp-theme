<?php
/*  
@packge sunsettheme
    
    ===============================
    Sunset admin options page
    =============================== */

?>

<h1>Sunset theme options</h1>
<?php 

    settings_errors(); // Showing page action notification
    
    $sidebarProfilePicture = esc_attr(get_option( 'sidebar_profile_picture' )); // Get Sidebar profile picture link
    $firstName = esc_attr(get_option('sidebar_first_name')); // Get Sidebar first name
    $lastName = esc_attr(get_option('sidebar_last_name')); // Get Sidebar last name
    $fullname = $firstName .' ' .$lastName;
    $description = esc_attr(get_option('sidebar_description')); // Get Sidebar description

?>

<!-- =======================================
        Beginning Sidebar preview section 
     ======================================= -->
<div class="sunset-sidebar-preview">
    <div class="sunset-sidebar">
        <div class="sidebar-profile-image" style="background-image: url(<?php print($sidebarProfilePicture); ?>);"></div>
        <h1 class="sidebar-name"><?php print($fullname); ?></h1>
        <p class="sidebar-description"><?php print($description); ?></p>
        
    </div>
</div>
<!-- //End sidebar preview sturcutre -->

<!-- =======================================
        Beginning Sidebar field form section 
     ======================================= -->
<form action="options.php" method="post" class="sunset-general-form">
   
    <?php 
        // setting_fields(string $register-setting-option-group, );
        settings_fields('sunset-sidebar-settings-group'); 
        do_settings_sections("sunset_options");
        
    
        //submit_button(string $text, string $type, string $name, bool $wrap, mixed $other_attributes);
        submit_button('Save Changes', 'primary', 'btnSubmit');
    ?>
</form>
<!-- //End sidebar form section sturcutre -->

