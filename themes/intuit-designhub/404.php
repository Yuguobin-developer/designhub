<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package DesignHub
 */
get_header();
?>
<div class="wrapper" id="single-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">
			<main class="page-main" id="main">
				<div class="page-content">
					<p class="page-title"><?php _e( '404 ERROR'); ?></p>
					<h2><?php _e( 'Donut panic. Still baking.' ); ?></h2>
					<p class="home-link"><a href="/">GO BACK</a></p>

				</div><!-- .page-content -->
			</main><!-- #main -->		

	</div><!-- #content -->

</div><!-- #single-wrapper -->
<?php

get_footer(); ?>
<style type="text/css">
	.page-main {
        background-image: url("/wp-content/uploads/2022/09/donuts.png");
	
		height: 100vh;
		display: flex;
		/*justify-content: center;*/
		align-items: center; 
		background-size: cover;
		background-repeat: none;
	}
	.page-content {
		max-width: 1000px;
		margin-left: 12%;
 		
	}
	.page-title {
		font-family: 'AvenirNext forINTUIT';
		font-style: normal;
		font-weight: 700;
		font-size: 20px;
		line-height: 28px;
		text-transform: uppercase;
		color: 000;
	}
	.page-content h2 {
		font-family: 'AvenirNext forINTUIT';
		font-style: normal;
		font-weight: 700;
		font-size: 60px;
		line-height: 76px;
		color: #000;
		margin: 6rem 0;
	}

	.home-link a {
		font-family: 'AvenirNext forINTUIT';
		font-style: normal;
		font-weight: 700;
		font-size: 20px;
		line-height: 28px;
		color: #000;
		border-bottom: 3px solid #000;
	}
	.home-link a:hover {
		border-bottom: none;
	}
	.navbar-dark .navbar-nav .nav-link {
		color: #000;
	}
	.custom-logo-link img {
		filter: brightness(0);
	}
	.navbar-dark .navbar-toggler {
		color: #000;
	}
</style>
