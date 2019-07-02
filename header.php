<?php 

/*  
@packge sunsettheme
    
    ==================
    	Header template
    ================= */

?>

<!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="portfolio" href="http://gmpg.org/xfn/11">
    <?php if(is_singular() && pings_open( get_queried_object() )): ?>
      <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php endif; ?>
    <title>Home | Sunset</title>

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
   
   <div class="main-wrap">
      <!-- =============================
           Beginning main header section -->
       <header class="main-header" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/header-image.jpg);">
           <div class="header-content-section d-table">
             <div class="header-content d-table-cell text-center">
               <a href="<?php echo get_option("siteurl"); ?>" class="brand sunset-icon">
                 <span class="icon-logo"></span>
                 <span class="hidden"><?php bloginfo( 'name' ); ?></span>
               </a>
               <p><?php bloginfo( 'description' ); ?></p>
             </div>
           </div>
           <nav class="nav main-nav-section">
              <?php wp_nav_menu( array(
                  'menu'           => 'Sunset Nav', // Do not fall back to first non-empty menu.
                  'theme_location' => 'main-menu',
                  //'walker'         => new Wp_sunset_Menu_Walker()
              ) ); ?>
           </nav>
       </header>
       <!-- //End header section -->