<?php
/*  
@packge sunsettheme
    
    ===============================
    Sunset Custom CSS options page
    =============================== */

?>

<h1>Sunset Custom Css option</h1>
<?php 

    settings_errors();
?>
<form id="save-custom-css-form" action="options.php" method="post" class="sunset-general-form">
    <?php 
        settings_fields('sunset-custom-css-setting');
        do_settings_sections('sunset_custom_css');
        submit_button();
    ?>

</form>