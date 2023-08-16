<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package makef
 */

get_header();

function getCurrentTag() {

	$tags = get_terms( 'post_tag' );

	foreach ( $tags as $tag ) {

			if  ( isset($_GET['tag'] ) && $tag->slug === $_GET['tag'] ) {
							return $tag;
					}
			}

	return false;
}

$currentTag = getCurrentTag();

$currentCategory = false;
if ( is_category() ) {
	$currentCategory = true;
	$currentCategoryName = single_cat_title('', false);
}
?>

<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri()?>/css/unicons.css">

<div class="wrapper" id="single-wrapper">
	
	<div class="<?php echo esc_attr( $container ); ?> container blog-filter" tabindex="">

		<div class="row nav-filter">

			<div class="col-12 categories-section">   

				<input class="dropdown" type="checkbox" id="dropdown" name="dropdown"/>
				<a href="/topics"><label class="topics desk">TOPICS</label><label class="topics mobile">BROWSE TOPICS</label></a></br>
				<label class="for-dropdown all-categories" for="dropdown"><?php echo $currentCategory? '<div style="color:#000">' . $currentCategoryName . '</div>':'<div class="cate-all">All</div>'; ?><i class="uil uil-arrow-down"></i>

					<div class="section-dropdown-cate"> 

						<?php  

						// Getting categories
						// $categories = get_categories();
						// echo '<ul class="dropdown-menu" style="display: none">';
						// 	foreach($categories as $category) {
						// 	echo '<li><a href="' . get_category_link($category) . '">' . $category->name . '</a></li>';

						wp_nav_menu(
	                        array(
	                            'theme_location'  => 'footer-menu',
	                            'menu_class'      => 'navbar-nav ms-auto dropdown-menu open',
	                            'fallback_cb'     => '',
	                            'menu_id'         => 'category-menu',
	                            'depth'           => 2,
	                            'walker'          => new DesignHub_WP_Bootstrap_Navwalker(),
	                        )
	                    );
						//} 
						?>

					</div>
				</label>
			</div>  

			<div class="col-6 d-flex tags-section">   

				<div class="tag-content">

					<input class="dropdown" type="checkbox" id="dropdowntag" name="dropdown"/>

					<label class="for-dropdown all-tags" for="dropdowntag"><?php echo $currentTag?'Sort By:&nbsp; <div class="cate-name"> ' . $currentTag->name . '<i class="uil uil-arrow-down"></i></div>':'Filter by type:<i class="uil uil-arrow-down"></i>'; ?>

						<div class="section-dropdown-tag"> 

							<?php
							global $wpdb, $wp;

							//Getting tags
							$tags = get_terms( 'post_tag' );
							echo '<ul class="dropdown-menu" style="display: none">';

							foreach ( $tags as $tag ) {
									echo '<li><a href="' . get_permalink( get_option( 'page_for_posts' ) ) . '?tag=' . $tag->slug . '">' . $tag->name . '</a></li>';
							}

							?>
							<li><a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ) ?>">All</a></li></ul>

						</div>
					</label>

				</div>

			</div> 

		</div>

		<div class="row blog-content" data-masonry='{"percentPosition": true }'>

			<?php 
			if ($currentTag ) {
				global $wp_query;

				$original_query = $wp_query;
				$wp_query = null;
				$args = array('tag' => $currentTag->slug);
				$wp_query = new WP_Query($args);
			}
			
			if ( have_posts() ) : 
				?>

				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					?>
					<div class="post-wrap col-sm-6 col-12">

						<a href="<?php the_permalink(); ?>">

							<div class="feature-image">
									<?php the_post_thumbnail(); ?>
							</div>

							<div class="tags">
								<?php //the_tags(); 
									$cats = get_the_category_list( ', ' );
									if ( $cats ) {
										printf( '<span class="post-cats">%s</span>', $cats );
									}
								?>
							</div>

							<div class="title">
									<a href="<?php the_permalink(); ?>"><h5><?php the_title(); ?></h5></a>
							</div>

							<div class="excerpt">
									<a href="<?php the_permalink(); ?>"><?php the_excerpt(); ?></a>
							</div>

						</a>

					</div>
					<?php

				endwhile; 

				// pagination (pagination arguments)

				echo "<div class='page-nav-container'>";

				echo paginate_links( array(
					'prev_text' => __('<img src="'. get_template_directory_uri() .'/images/arrow-back.svg">'),
					'next_text' => __('<img src="'. get_template_directory_uri() .'/images/arrow-right.svg">'),
        ));

				echo "</div>";

				if ($currentTag) {
					$wp_query = null;
					$wp_query = $original_query;
					wp_reset_postdata();
				}

			endif;
			?>			

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #single-wrapper -->

<?php
get_footer();

?>
<style type="text/css">

    @media(max-width: 768px) {           
		footer {
			margin-top: 4rem;
		}
    } 
    /*
    .all-categories ul {
	  display: flex;
	  flex-direction: column;
	}
	.all-categories ul li:first-child {
	  order: 1;
	}
	.all-categories ul li:nth-child(2) {
	  order: 3;
	}
	.all-categories ul li:nth-child(3) {
	  order: 0;
	}
	.all-categories ul li:nth-child(4) {
	  order: 2;
	}
	.all-categories ul li:nth-child(5) {
	  order: 4;
	}*/
	
	.dropdown-menu li a {
		padding: 0;
	}
	#category-menu {
		display: none;
	}
</style>