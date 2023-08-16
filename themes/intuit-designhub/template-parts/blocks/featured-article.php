<?php
/**
 * Template for displaying the featured article
 *
 * @package DesignHub
 */
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
// ACF fields
$post 					= get_field( 'post' );
$custom_link			= get_field( 'custom_link' );
$background 			= get_field( 'background' );
$tag_color 				= get_field( 'tag_color' );
$tag_hover_color 		= get_field( 'tag_hover_color' );
$title_color 			= get_field( 'title_color' );
$description_color 		= get_field( 'description_color' );
$link_color 			= get_field( 'link_color' );
$link_hover_color 		= get_field( 'link_hover_color' );
// Block ID
$block_id               = 'acf-block-' . rand( 0, 99999 );
?>
<div class="acf-block-featured-article acf-block" id="<?php echo $block_id; ?>">
	<div class="article-block-bg"></div>
	<div class="container">
		<?php if ( $post ): ?>
			<article <?php post_class( 'article' ); ?> id="post-<?php echo $post->ID; ?>">
				<div class="row align-items-center">
					<div class="col-lg-5">
						<div class="post-content">
							<?php
							$tags = get_the_tags( $post->ID );
							if ( sizeof( $tags ) ) {
								$tag_id = $tags[0]->term_id;
								$tag_name = $tags[0]->name;
								$tag_link = get_tag_link( $tag_id );							
								?>
								<div class="entry-tags">
									<a class="text-uppercase inverse-color" href="<?php echo esc_url( $tag_link ); ?>" title="<?php echo $tag_name; ?>"><?php echo $tag_name; ?></a>
								</div>
								<?php
							}
							$title = get_the_title( $post->ID );
							$excerpt = get_the_excerpt( $post->ID );
							$permalink = get_the_permalink( $post_ID );
							?>

							<h2 class="entry-title display-2">
								<a href="<?php echo esc_url(  $custom_link['url'] ); ?>">
								<?php echo $title; ?>
								</a>
							</h2>

							<div class="entry-content">
								<?php echo $excerpt; ?>
							</div><!-- .entry-content -->
							<?php if ( $custom_link ): 
								$custom_link_url = $custom_link['url'];
								$custom_link_title = $custom_link['title'];
								$custom_link_target = $custom_link['target'] ? $custom_link['target'] : '_self';
								?>
								<a class="permalink text-uppercase inverse-color underline" href="<?php echo esc_url( $custom_link_url ); ?>" target="<?php echo esc_attr( $custom_link_target ); ?>"><?php echo $custom_link_title; ?></a>
							<?php else: ?>
								<a class="permalink text-uppercase inverse-color underline" href="<?php echo esc_url( $permalink ); ?>" title="Read the book">Read the book</a>
							<?php endif; ?>
						</div>
					</div>
					<div class="col-lg-7 order-first order-lg-last">				
						<div class="post-thumbnail">
							<a href="<?php echo esc_url(  $custom_link['url']); ?>">
							<?php echo get_the_post_thumbnail( $post->ID, 'full' ); ?>
							</a>
						</div>
					</div>
				</div>
			</article>
		<?php endif; ?>		
	</div>
</div>
<style type="text/css">
	<?php if ( $background ) : ?>
		.acf-block-featured-article#<?php echo $block_id; ?> .article-block-bg {
			background-color: <?php echo $background; ?>;
		}
		.acf-block-featured-article#<?php echo $block_id; ?> .container article .post-content .entry-tags a {
			color: <?php echo $tag_color; ?>;
			border-color: <?php echo $tag_color; ?>;
		}
		.acf-block-featured-article#<?php echo $block_id; ?> .container article .post-content .entry-tags a:hover {
			color: <?php echo $tag_hover_color; ?>;
			border-color: <?php echo $tag_hover_color; ?>;
		}
		.acf-block-featured-article#<?php echo $block_id; ?> .container article .post-content .entry-title {
			color: <?php echo $title_color; ?>;
		}
		.acf-block-featured-article#<?php echo $block_id; ?> .container article .post-content .entry-content {
			color: <?php echo $description_color; ?>;
		}
		.acf-block-featured-article#<?php echo $block_id; ?> .container article .post-content .permalink {
			color: <?php echo $link_color; ?>;
			border-color: <?php echo $link_color; ?>;
		}
		.acf-block-featured-article#<?php echo $block_id; ?> .container article .post-content .permalink:hover {
			color: <?php echo $link_hover_color; ?>;
			border-color: <?php echo $link_hover_color; ?>;
		}
	<?php endif; ?>
	
</style>
