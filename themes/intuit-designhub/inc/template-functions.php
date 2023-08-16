<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package makef
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function makef_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'makef_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function makef_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'makef_pingback_header' );

/**
 * Estimated reading time
 */
function makef_reading_time() {
	$content = get_post_field( 'post_content' );

	$word_count = str_word_count( strip_tags( $content ) );
	$readingtime = ceil($word_count / 200);

	if ( $readingtime == 1 ) {
		$timer = __( 'min read', 'DesignHub' );
	} else {
	  $timer = __( 'min read', 'DesignHub' );
	}
	
	$totalreadingtime = $readingtime . ' ' . $timer;

	return $totalreadingtime;
}