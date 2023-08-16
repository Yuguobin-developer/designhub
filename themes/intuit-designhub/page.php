<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package DesignHub
 */

get_header();
?>
<div class="container" style="margin-top: 150px;">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php

		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'DesignHub' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		
		?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div>
<?php
//get_sidebar();
get_footer();

?>

<style type="text/css">
	.custom-logo {
		filter: brightness(0);
	}

	#main-menu .nav-link {
		color: #000;
	}
</style>

