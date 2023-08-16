<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 * @package DesignHub
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class( 'article' ); ?> id="post-<?php the_ID(); ?>">

	<div class="post-thumbnail">
		<a href="<?php echo esc_url( get_permalink() ); ?>">
			<?php echo get_the_post_thumbnail( $post->ID, 'full' ); ?>
		</a>
	</div>

	<div class="post-content">

		<div class="entry-tags">
			<?php/* the_tags( '',  ',', '' ); */?>
			<?php
			// categories
			$cats = get_the_category_list( ', ' );
			if ( $cats ) {
				printf( '<span class="post-cats">%s</span>', $cats );
			}
			?>
		</div>

		<?php the_title( sprintf( '<h5 class="entry-title"><a href="%s">', esc_url( get_permalink() ) ), '</a></h5>' ); ?>

		<div class="entry-content">
			<?php the_excerpt(); ?>
		</div><!-- .entry-content -->

	</div>

</article><!-- #post-## -->
