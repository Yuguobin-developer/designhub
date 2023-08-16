<?php
/**
 * Theme enqueue scripts
 *
 * @package DesignHub
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Enqueue scripts and styles.
 */
function designHub_scripts() {
	wp_enqueue_style( 'designHub-style', get_stylesheet_uri() );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

    // Get the theme data.
    $the_theme         = wp_get_theme();
    $theme_version     = $the_theme->get( 'Version' );
    $suffix            = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
    $version           = $theme_version . '.' . filemtime( get_template_directory() );

    // wp_enqueue_script( 'designhub-font-awesome-5',  'https://use.fontawesome.com/releases/v5.3.1/js/all.js', array(), '2018928', true );		
	wp_enqueue_script( 'jquery-min', get_template_directory_uri() . '/js/jquery.min.js', array('jquery'));
    
    // Slick slider
	wp_enqueue_script( 'designhub-slickslider', get_template_directory_uri() . '/lib/slick/slick.min.js', array( 'jquery' ) );	

    // Fancybox
    // wp_enqueue_style( 'designhub-fancybox-css', get_template_directory_uri() . '/lib/fancybox/jquery.fancybox.css', array(), false );
	// wp_enqueue_script( 'designhub-fancybox-js', get_template_directory_uri() . '/lib/fancybox/jquery.fancybox.pack.js', array( 'jquery' ), '1.0.0' );

    // Way points
    wp_enqueue_script( 'designhub-waypoints', get_template_directory_uri() . '/lib/waypoints/jquery.waypoints.min.js', array( 'jquery' ) );	

    // Meanmenu
    wp_enqueue_script( 'designhub-meanmenu-js', get_template_directory_uri() . '/js/jquery.meanmenu.min.js', array( 'jquery' ) );

    // Scrollmagic
    wp_enqueue_script( 'designhub-gsap', get_template_directory_uri() . '/lib/gsap3/gsap.min.js', array( 'jquery' ) );
    wp_enqueue_script( 'designhub-scrollMagic', get_template_directory_uri() . '/lib/scrollmagic/uncompressed/ScrollMagic.js', array( 'jquery' ) );
    wp_enqueue_script( 'designhub-animation-gsap', get_template_directory_uri() . '/lib/scrollmagic/uncompressed/plugins/animation.gsap.js', array( 'jquery' ) );
    // wp_enqueue_script( 'designhub-addIndicators', get_template_directory_uri() . '/lib/scrollmagic/uncompressed/plugins/debug.addIndicators.js', array( 'jquery' ) );

    // Masonry
    wp_enqueue_script( 'designhub-masonry', 'https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js', array( 'jquery' ) );

    // Slick slider
    // wp_enqueue_style( 'designhub-slick', get_template_directory_uri() . '/lib/slick/slick.css', array(), false );
    // wp_enqueue_script( 'designhub-slick', get_template_directory_uri() . '/lib/slick/slick.min.js', array( 'jquery' ) );
    
    // Bootstrap
    wp_enqueue_script( 'designhub-bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ) );

    // Theme Styles & Scripts
    wp_enqueue_style( 'designhub-main-style', get_template_directory_uri() . '/css/main' . $suffix . '.css', array(), $version );
	wp_enqueue_script( 'main-js', get_template_directory_uri() . '/js/main.js', array( 'jquery' ), $version, true );
}
add_action( 'wp_enqueue_scripts', 'designHub_scripts' );
