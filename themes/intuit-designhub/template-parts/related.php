<?php
/**
 * Post rendering related posts according to caller of get_template_part
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$articles = get_field( 'related_articles' );
if ( empty( $articles ) ) {
  return;
}

// ACF Fields
$title = get_field( 'related_articles_title' );
$link = get_field( 'related_articles_link' );
$browser_link_url = '';
$browser_link_title = '';
if ( is_array( $link ) ) {
  $browser_link_title = $link['title'];
  $browser_link_url = $link['url'];
}
$columns_per_row			= 3;
$display_type				= 'slider';

// Block ID
$block_id 					= 'acf-block-' . rand( 0, 99999 );
?>

<div class="related-posts acf-block-articles acf-block" id="<?php echo $block_id; ?>">	
	<div class="block-header">
		<div class="container">
			<?php if ( $title ) : ?>
				<div class="block-title">
					<h2 class="display-2"><?php echo $title; ?></h2>
				</div>
			<?php endif; ?>

			<?php if ( $browser_link_title ) : ?>
				<div class="browser-link">
					<a class="text-uppercase underline" href="<?php echo esc_url( $browser_link_url ); ?>" title="<?php echo $browser_link_title ?>"><?php echo $browser_link_title ?></a>
				</div>
			<?php endif; ?>
		</div>
	</div>
		
	<div class="block-body">
    <div class="container-fluid">    
      <div class="posts">
        <?php if ( 'masonry' === $display_type ) : ?>
          <div class="row" data-masonry='{"percentPosition": true }'>
        <?php elseif ( 'slider' === $display_type ) : ?>
          <div class="row slider-wrapper" data-slick>
        <?php else : ?>
          <div class="row">
        <?php endif; ?>

          <?php
          // The Loop
          foreach ( $articles as $post ) :
            setup_postdata( $post );
            
            if ( '2' === $columns_per_row ) {
              echo '<div class="col-6">';
            } else if ( '3' === $columns_per_row ) {
              echo '<div class="col-sm-4">';
            } else if ( '4' === $columns_per_row ) {
              echo '<div class="col-md-3">';
            } else {
              echo '<div class="col-12">';	
            }
                
            get_template_part( 'template-parts/content/content', get_post_format() );

            echo '</div>';
          endforeach;
          ?>
        </div>
      </div><!-- .posts -->
    </div><!-- .container || .slider-wrapper -->
	</div>
</div>

<?php if ( $display_type === 'slider' ) : ?>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/lib/slick/slick.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/lib/slick/slick-theme.css">
	<script src="<?php echo get_template_directory_uri(); ?>/lib/slick/slick.min.js"></script>
<?php endif; ?>