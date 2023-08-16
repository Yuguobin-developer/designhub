<?php
/**
 * designHub functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package designHub
 */

if ( ! function_exists( 'designHub_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function designHub_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on designHub, use a find and replace
		 * to change 'designHub' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'designHub', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

        // Add support for the block editor stylesheet.
		add_theme_support( 'editor-styles' );
		add_editor_style( 'css/editor-style.css' );

		// Add support for wide alignment.
		add_theme_support( 'align-wide' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'designHub' ),
		) );

		register_nav_menus( array(
			'footer-menu' => esc_html__( 'Category Menu', 'designHub' ),
		) );


		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'designHub_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'designHub_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function designHub_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'designHub_content_width', 640 );
}
add_action( 'after_setup_theme', 'designHub_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function designHub_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'designHub' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'designHub' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'designHub_widgets_init' );

/**
 * Customize the mime types to allow uploading SVG
 */
function designHub_custom_mime_types( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';
	$mimes['svgz'] = 'image/svg+xml';
	return $mimes;
}
add_filter( 'upload_mimes', 'designHub_custom_mime_types' );

/**
 * Custom editor style
 */
function designhub_theme_add_editor_css() {
	// add_theme_support( 'editor-styles' );
	// add_editor_style( get_template_directory_uri() . '/css/editor-style.css' );
}
add_action( 'admin_init', 'designhub_theme_add_editor_css' );

/**
 * Customize styles for the block pannel
 */
function designhub_custom_block_pannel() {
	echo '<style>
		.acf-block-panel .acf-block-fields {
			margin: 0;
		} 
		.acf-block-component .acf-block-fields .acf-field.acf-accordion .acf-accordion-title {
			padding: 16px 48px 16px 16px;
		}
	</style>';
}
add_action('admin_head', 'designhub_custom_block_pannel');

/**
 * Theme enquue scripts
 */
require get_template_directory() . '/inc/enqueue.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * WP Bootstrap Navwalker
 */
require get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';


/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

///////////////////////////////////////////////////////////////////

// Add Options page for global potions
if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page();
}

add_action( 'acf/init', 'articles' );
add_action( 'acf/init', 'featured_article' );
add_action( 'acf/init', 'landing_banner' );
add_action( 'acf/init', 'spacer' );
add_action( 'acf/init', 'links' );

function articles() {

	// check function exists
	if( function_exists( 'acf_register_block' ) ) {
		
		// register a article block
		acf_register_block(array(
			'name'				=> 'articles',
			'title'				=> __( 'DesignHub Articles' ),
			'description'		=> __( 'Add articles block.' ),
			'render_template'	=> 'template-parts/blocks/articles.php',
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'			=> 'formatting', 
			'icon'				=> 'admin-comments',
			'keywords'			=> array(),
		));
	}
}

function featured_article() {
	
	// check function exists
	if( function_exists( 'acf_register_block' ) ) {
		
		// register a article block
		acf_register_block(array(
			'name'				=> 'featured_article',
			'title'				=> __( 'DesignHub Featured Article' ),
			'description'		=> __( 'Add the featured article block' ),
			'render_template'	=> 'template-parts/blocks/featured-article.php',
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'			=> 'formatting', 
			'icon'				=> 'admin-comments',
			'keywords'			=> array( 'testimonial', 'quote' ),
		));
	}
}

function landing_banner() {
	
	// check function exists
	if( function_exists( 'acf_register_block' ) ) {
		
		// register a Landing banner block
		acf_register_block(array(
			'name'				=> 'landing_banner',
			'title'				=> __( 'DesignHub Banner' ),
			'description'		=> __( 'Add DesignHub banner block.' ),
			'render_template'	=> 'template-parts/blocks/banner.php',
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'			=> 'formatting',
			'icon'				=> 'admin-comments',
			'keywords'			=> array( 'testimonial', 'quote' ),
		));
	}
}

function spacer() {

	// check function exists
	if( function_exists( 'acf_register_block' ) ) {
		
		// register a article block
		acf_register_block(array(
			'name'				=> 'spacer',
			'title'				=> __( 'DesignHub Spacer' ),
			'description'		=> __( 'Add spacer block.' ),
			'render_template'	=> 'template-parts/blocks/spacer.php',
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'			=> 'formatting', 
			'icon'				=> 'admin-comments',
			'keywords'			=> array(),
		));
	}
}

function links() {

	// check function exists
	if( function_exists( 'acf_register_block' ) ) {
		
		// register a article block
		acf_register_block(array(
			'name'				=> 'link',
			'title'				=> __( 'DesignHub Link' ),
			'description'		=> __( 'Add link block.' ),
			'render_template'	=> 'template-parts/blocks/link.php',
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'			=> 'formatting', 
			'icon'				=> 'admin-comments',
			'keywords'			=> array(),
		));
	}
}

  

function designhub_fix_blog_pagination(){
	add_rewrite_rule( "topics/?$", "index.php?post_type=post&paged=1", 'top' );
	add_rewrite_rule('^topics/page/([0-9]+)/?$', 'index.php?post_type=post&paged=$matches[1]', 'top');
}
add_action( 'init', 'designhub_fix_blog_pagination' );

if (function_exists('acf_set_options_page_menu')){
acf_set_options_page_menu('Footer');
}
if( function_exists('acf_set_options_page_title') ) {
    acf_set_options_page_title( __('Footer') );
}
function klf_acf_input_admin_footer() { ?>
<script type="text/javascript">
(function($) {
acf.add_filter('color_picker_args', function( args, $field ){
// add the hexadecimal codes here for the colors you want to appear as swatches
args.palettes = ['#000000', '#ffffff', '#F54BAC', '#008481', '#2B77CC', '#F7576C', '#6E0B1E', '#15EFE9', '#C5E1FF', '#9C005E', '#C9007A']
// return colors
return args;
});
})(jQuery);
</script>
<?php }
add_action('acf/input/admin_footer', 'klf_acf_input_admin_footer');


add_filter( 'manage_edit-realestate_sortable_columns', 'smashing_realestate_sortable_columns');
function smashing_realestate_sortable_columns( $columns ) {
  $columns['price'] = 'price_per_month';
  return $columns;
}


/*Gravity forms keep visible after form submission */
function dw_show_confirmation_and_form( $form ) {

    $shortcode = '[gravityform id="' . $form['id'] . '" title="false" description="false"]';

    ob_start();
    echo do_shortcode($shortcode);
    $html = str_replace(array("\r","\n"),'',trim(ob_get_clean()));

    if ( array_key_exists( 'confirmations', $form ) ) {
        foreach ( $form['confirmations'] as $key => $confirmation ) {
            $form['confirmations'][ $key ]['message'] = $html . '<div class="confirmation-message">' . $form['confirmations'][ $key ]['message'] . '</div>';
        }
    }

    return $form;
}


function my_function1() {

	 if (is_single()){
		 echo '<meta name="twitter:label1" content="Written by">';
		 echo '<meta name="twitter:data1" content="' . $authors = get_field( 'authors' ) . '" />';
	 }   

}
add_action('wp_head', 'my_function1');


add_filter( 'gform_pre_submission_filter', 'dw_show_confirmation_and_form' );

// Insert Javascript into the site footer to clear Gravity Forms inputs after submission
add_action( 'wp_footer', 'dw_gf_footer_scripts' );
function dw_gf_footer_scripts() {
    ?>
    <script type="text/javascript">
    // Get all form inputs into arrays
    const inputs = document.querySelectorAll('.gform-body input');
    const textareas = document.querySelectorAll('.gform-body textarea');
    const inputsArray = Array.from(inputs);
    const textareasArray = Array.from(textareas);

    // Run clearValues on each input and textarea
    inputsArray.forEach(clearValues);
    textareasArray.forEach(clearValues);

    // Clear the values of inputs
    function clearValues( elem ) {
        // Do not clear hidden values
        if(elem.type !== 'hidden') {
            elem.value = '';
        }
    }
    </script>
    <?php
}

