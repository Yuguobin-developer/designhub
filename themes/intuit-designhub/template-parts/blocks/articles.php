<?php
/**
 * Template for displaying articles
 *
 * @package DesignHub
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// ACF Fields
$title 						= get_field( 'title' );
$browser_link				= get_field( 'browser_link' );
$browser_link_color			= get_field( 'browser_link_color' );
$browser_link_hover_color	= get_field( 'browser_link_hover_color' );
$post_count					= get_field( 'post_count' );
$columns_per_row			= get_field( 'columns_per_row' );
$posts 						= get_field( 'posts' );
$display_type				= get_field( 'display_type' );

// Block ID
$block_id 					= 'acf-block-' . rand( 0, 99999 );
?>

<div class="acf-block-articles acf-block" id="<?php echo $block_id; ?>">	
	<div class="block-header">
		<div class="container">
			<?php if ( $title ) : ?>
				<div class="block-title">
					<h2 class="display-2"><?php echo $title; ?></h2>
				</div>
			<?php endif; ?>

			<?php if ( $browser_link ) : ?>
				<div class="browser-link">
					<a class="text-uppercase underline" href="<?php echo esc_url( $browser_link ); ?>" title="See All">See All</a>
				</div>
			<?php endif; ?>
		</div>
	</div>
		
	<div class="block-body">
		<?php if ( $post_count || $posts ) : ?>
			<?php if ( 'masonry' === $display_type || 'default' === $display_type ) : ?>
				<div class="container">
			<?php else : ?>
				<div class="container-fluid">
			<?php endif; ?>

				<div class="posts">
					<?php if ( 'masonry' === $display_type ) : ?>
						<div class="row" data-masonry='{"percentPosition": true }'>
					<?php elseif ( 'slider' === $display_type ) : ?>
						<div class="row slider-wrapper" data-slick>
					<?php else : ?>
						<div class="row">
					<?php endif; ?>

						<?php
						if ( $posts ) {
							global $post;

							foreach ( $posts as $post ) {										
								if ( '2' === $columns_per_row ) {
									echo '<div class="col-12 col-md-6">';
								} else if ( '3' === $columns_per_row ) {
									echo '<div class="col-sm-4">';
								} else if ( '4' === $columns_per_row ) {
									echo '<div class="col-md-3">';
								} else {
									echo '<div class="col-12 col-md-6">';	
								}

								setup_postdata( $post );
								get_template_part( 'template-parts/content/content', get_post_format() );

								echo '</div>';
							}

							/* Restore original Post Data */
							wp_reset_postdata();
						} else {
							$args = array(
								'post_type'			=> 'post',
								'posts_per_page'	=> $post_count,						
								'post_status'		=> 'publish'
							);

							// The Query
							$the_query = new WP_Query( $args );

							// The Loop
							if ( $the_query->have_posts() ) {
								while ( $the_query->have_posts() ) {
									$the_query->the_post();

									if ( '2' === $columns_per_row ) {
										echo '<div class="col-12 col-md-6">';
									} else if ( '3' === $columns_per_row ) {
										echo '<div class="col-sm-4">';
									} else if ( '4' === $columns_per_row ) {
										echo '<div class="col-md-3">';
									} else {
										echo '<div class="col-12 col-md-6">';	
									}
										
									get_template_part( 'template-parts/content/content', get_post_format() );

									echo '</div>';
								}

								/* Restore original Post Data */
								wp_reset_postdata();
							} 							
						} 
						?>
					</div>
				</div><!-- .posts -->

					<div class="next-arrow-button" style="background-color: #c9007a; width: 60px; height: 60px; border-radius: 3.75rem;" tabindex="0"><i class="fa fa-angle-right" aria-hidden="true" style="color:white; margin: 20px; margin-left: 27px;"></i></div>
			</div><!-- .container || .slider-wrapper -->
		<?php endif; ?>
	</div>
</div>

<style>
	.acf-block-articles#<?php echo $block_id; ?> .browser-link a {
		color: <?php echo $browser_link_color; ?>;
		border-color: <?php echo $browser_link_color; ?>;
	}

	.acf-block-articles#<?php echo $block_id; ?> .browser-link a:hover {
		color: <?php echo $browser_link_hover_color; ?>;
		border-color: <?php echo $browser_link_hover_color; ?>;
	}
	@media (min-width: 300px) {
		.next-arrow-button {
			max-width: calc(50vw + 490px);
			margin-left: calc(50vw - 730px);
		}
	}
	@media (min-width: 480px) {
		.next-arrow-button {
			max-width: calc(50vw + 490px);
			margin-left: calc(50vw - 730px);
		}
	}

	@media (min-width: 768px) {
		.next-arrow-button {
			max-width: calc(50vw + 490px);
			margin-left: calc(50vw - 400px);
		}
	}
	@media (min-width: 1024px) {
		.next-arrow-button {
			max-width: calc(50vw + 490px);
			margin-left: calc(50vw - 264px);
		}
	}
	@media (min-width: 1200px) {
		.next-arrow-button {
			max-width: calc(50vw + 490px);
			margin-left: calc(50vw - 478px);
		}
	}
	@media (min-width: 1400px) {
		.next-arrow-button {
			max-width: calc(50vw + 490px);
			margin-left: calc(50vw - 570px);
		}
	}
	@media (min-width: 1920px) {
		.next-arrow-button {
			max-width: calc(50vw + 490px);
			margin-left: calc(50vw - 730px);
		}
	}
	.next-arrow-button {
		display: none;
	}
</style>

<?php if ( $display_type === 'slider' ) : ?>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/lib/slick/slick.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/lib/slick/slick-theme.css">
	<script src="<?php echo get_template_directory_uri(); ?>/lib/slick/slick.min.js"></script>
<?php endif; ?>