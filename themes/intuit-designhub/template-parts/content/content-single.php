<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'article-single'); ?>>

	<div class="post-thumbnail">

		<?php echo get_the_post_thumbnail( $post->ID, 'full' ); ?>

	</div><!-- .post-thumbnail -->

	<div class="content-wrap">

		<div class="entry-top">
			<?php
			// categories
			$cats = get_the_category_list( ', ' );
			if ( $cats ) {
				printf( '<span class="post-cats">%s</span>', $cats );
			}
			?>

			<header class="entry-header alignwide">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->

			<div class="row post-metas" style="margin-bottom: 1.5rem;">
				<div class="col-1" style="width: 1.5rem">
				<?php
				// author
				printf(
					'<span class="post-author">By %1$s</span>',
					get_field( '' )
				); ?> 

				</div>

				<div class="col-1" style="width: auto;">
				<span class="author-value"><?php 

				echo $authors = get_field( 'authors' ); 
				//$author_groups = get_field( 'author_group' ); 
				//foreach ( $author_groups as $author_group ) { ?></span>
        			<div><?php //echo $author_group['author_name']; ?></div> 
				<?php// } ?>
				</div>

				<div class="col-8"> 
				<?php 

				// date
				$time_string = '<time class="entry-date post-published post-updated" datetime="%1$s">%2$s</time>';
				$time_string = sprintf(
					$time_string,
					esc_attr( get_the_date( 'c' ) ),
					esc_html( get_the_date() ),
					esc_attr( get_the_modified_date( 'c' ) ),
					esc_html( get_the_modified_date() )
				);

				printf(
					'<span class="post-date">%1$s</span>',
					$time_string
				);

				printf(
					'<span class="post-read">%1$s</span>',
					makef_reading_time()
				);
				?>
				</div>
			</div>
			
			<?php 
			$image = wp_get_attachment_url( get_post_thumbnail_id() );
			$permalink = esc_url( apply_filters( 'the_permalink', get_permalink() ) );
			$title = get_the_title();

			$extra_attr = 'target="_blank" rel="noopener noreferrer nofollow"';	
			?>
			<div class="social-share">
				<a href="https://www.facebook.com/sharer.php?u=<?php echo esc_url( $permalink ); ?>" title="<?php esc_attr_e( 'Facebook', 'DesignHub' ); ?>" class="share-facebook" <?php echo $extra_attr ?>><i class="fa fa-facebook-f"></i></a>
				<a href="https://twitter.com/intent/tweet?text=<?php echo urlencode( $title ); ?>&amp;url=<?php echo esc_url( $permalink ); ?>" title="<?php esc_attr_e( 'Twitter', 'DesignHub' ); ?>" class="share-twitter" <?php echo $extra_attr ?>><i class="fa fa-twitter"></i></a>
				<a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_url( $permalink ); ?>" title="<?php esc_attr_e( 'LinkedIn', 'DesignHub' ); ?>" class="share-linkedin" <?php echo $extra_attr ?>><i class="fa fa-linkedin"></i></a>
			</div>
		</div>

		<div class="entry-content">
			<?php
			the_content();
			?>
		</div><!-- .entry-content -->	

		<div class="entry-bottom">
			<?php 
			$image = wp_get_attachment_url( get_post_thumbnail_id() );
			$permalink = esc_url( apply_filters( 'the_permalink', get_permalink() ) );
			$title = get_the_title();

			$extra_attr = 'target="_blank" rel="noopener noreferrer nofollow"';	
			?>
			<div class="social-share">
				<div class="meta-label"><?php _e( 'Share', 'DesignHub' ) ?></div>
				<a href="https://www.facebook.com/sharer.php?u=<?php echo esc_url( $permalink ); ?>" title="<?php esc_attr_e( 'Facebook', 'DesignHub' ); ?>" class="share-facebook" <?php echo $extra_attr ?>><i class="fa fa-facebook-f"></i></a>
				<a href="https://twitter.com/intent/tweet?text=<?php echo urlencode( $title ); ?>&amp;url=<?php echo esc_url( $permalink ); ?>" title="<?php esc_attr_e( 'Twitter', 'DesignHub' ); ?>" class="share-twitter" <?php echo $extra_attr ?>><i class="fa fa-twitter"></i></a>
				<a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_url( $permalink ); ?>&amp;title=<?php echo urlencode( $title ); ?>" title="<?php esc_attr_e( 'LinkedIn', 'DesignHub' ); ?>" class="share-linkedin" <?php echo $extra_attr ?>><i class="fa fa-linkedin"></i></a>
			</div>

			<?php/*
			$tags = get_the_tag_list( '', ', ' );
			if ( $tags ) {
				printf( '<div class="post-tags"><div class="meta-label">' . __( 'Tags', 'DesignHub' ) . '</div>' . esc_html__( '%s', 'DesignHub' ) . '</div>', $tags );
			}*/
			?>
		</div>

		<?php 

			$author_groups = get_field( 'author_group' );

			foreach ($author_groups as $author_group) { ?>

				<div class="entry-author">

					<div class="avatar-wrap">
						<img alt="<?php echo $author_group['author_image']['alt'] ?>" src="<?php echo $author_group['author_image']['url'] ?>" class="avatar avatar-120 photo" height="120" width="120" loading="lazy">
					</div>

					<div class="desc-wrap">
						<div class="author-name"><?php echo $author_group['author_name']; ?></div>
						<div class="author-desc"><?php echo $author_group['author_bio']; ?></div>
					</div>	

				</div>

			<?php }	?>
			
	</div>

</article><!-- #post-<?php the_ID(); ?> --> 

<?php 
	function my_function() {

	        echo '<meta name="twitter:label1" content="Written by">';
	    	echo '<meta name="twitter:data1" content="' . get_field( 'authors' ) . '" />';

	}
	add_action('wp_head', 'my_function');
?>

<script type="text/javascript">
	setTimeout(function() {
          $('.mycustom').attr('content', $(".author-value").html());
      }, 500);   


	$('.mycustom').attr('content', $(".author-value").html());
</script>