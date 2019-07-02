<?php
/*  
@packge sunsettheme
    
    ===============================
    Sunset theme support options page
    =============================== */

?>

<h1>Sunset theme support options</h1>
<?php settings_errors(); ?>
<form action="options.php" method="post" class="sunset-general-form">
    <?php settings_fields('sunset-theme-support'); ?>
    <?php do_settings_sections('theme_options'); ?>
    <?php submit_button(); ?>
</form>
