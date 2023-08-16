<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package intuit-designhub
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<!-- Google tag (gtag.js) -->
<!-- 	<script async src="https://www.googletagmanager.com/gtag/js?id=G-4Y284YF3EJ"></script> -->
	<!--<script>
  	window.dataLayer = window.dataLayer || [];
	 function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());
	  gtag('config', 'G-4Y284YF3EJ');
	</script>
	-->
	<meta name="twitter:label1" content="Est. reading time">
	<meta name="twitter:data1" content="4 minute">
	<meta name="google-site-verification" content="KRt_Czqls55vMpA0ZOCv-Ol7KAjrGnurto14MeozMUw" />
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<script>
    jQuery(document).scroll(function($) {

        myID = document.getElementById("main-nav");

        var myScrollFunc = function () {
            var y = window.scrollY;
            if (y >= 1630) {
                myID.className = "main-nav navbar navbar-expand-md navbar-dark show-nav"
            } else {
                myID.className = "main-nav navbar navbar-expand-md navbar-dark fixed-nav"
            }
        };

        window.addEventListener("scroll", myScrollFunc);
    });
</script>

<body <?php body_class(); ?>>
	<script type="text/javascript" src="https://tags.tiqcdn.com/utag/intuit/brand-design/prod/utag.js" async=""></script>
    <div id="page" class="site">
        <header id="masthead" class="site-header">
            <nav id="main-nav" class="navbar navbar-expand-md navbar-dark">
                <div class="container-fluid header-container">

                    <?php the_custom_logo(); ?>
                    
                    <!-- <a href="<?php get_home_url(); ?>" class="d-block d-md-none" rel="home">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/mobile_logo.svg" alt="Intuit Design logo" />
                    </a> -->

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'DesignHub' ); ?>">
                        <span class="navbar-toggler-icon"></span>
                        <span class="navbar-close-icon"></span>
                    </button>                   

                    <!-- The WordPress Menu goes here -->
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location'  => 'primary',
                            'container_class' => 'collapse navbar-collapse',
                            'container_id'    => 'navbarNavDropdown',
                            'menu_class'      => 'navbar-nav ms-auto',
                            'fallback_cb'     => '',
                            'menu_id'         => 'main-menu',
                            'depth'           => 2,
                            'walker'          => new DesignHub_WP_Bootstrap_Navwalker(),
                        )
                    );
                    ?>

                </div><!-- .container-fluid -->
            </nav><!-- #main-nav -->
        </header><!-- #masthead -->

        <div id="content" class="site-content">




