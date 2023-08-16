<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package DesignHub
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

?> 
	</div><!-- #content -->

 	<footer id="colophon" class="site-footer">
		<div class="footer-banner">
			<div class="container">
				<div class="row footer-slider-area">
					<div class="footer-slider"></div>
					<div class="footer-slider-base" style="height: 0; visibility: hidden">
						<?php the_field( 'footer_banner_title', 'options' ); ?>
						<?php foreach ( get_field( 'footer_logo', 'options' ) as $logo ) : ?>
							<a href="<?php echo $logo['url']; ?>" target="blank"><img src="<?php echo $logo['image']['url']; ?>" alt="<?php echo $logo['image']['alt']; ?>" height="27" width="120"></a>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
		<div class="footer-main"> 
			<div class="container">
				<div class="row menu-column">
					<div class="col-lg-6 footer-left position-relative">
						<h2><?php echo get_field( 'footer_title', 'options' );?></h2>
						<div class="footer-desc">
							<?php echo get_field( 'footer_description', 'options' );?>
						</div>
						<?php //echo do_shortcode( '[contact-form-7 id="242" title="Contact form 1"]' ); ?>
						<?php echo do_shortcode( '[gravityform id="2" title="false" description="false" ajax="true"]' );
						?>
					</div>
					<div class="col-lg-6 footer-right">
						<div class="row">
							<div class="col-6 col-sm-4">
								<div class="widget">
									<h3 class="widget-title"><?php echo get_field( 'footer_section_1', 'options' )['title']; ?></h3>
									<div class="widget-content">
										<ul class="footer-menu">
											<?php foreach ( get_field( 'footer_section_1', 'options' )['link'] as $datas ) : ?>
												<li>
													<a href="<?php echo $datas['link_text']['url']; ?>">
														<?php echo $datas['link_text']['title']; ?>
													</a>
												</li>
											<?php endforeach; ?>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-6 col-sm-4">
								<div class="widget">
									<h3 class="widget-title"><?php echo get_field( 'footer_section_2', 'options' )['title']; ?></h3>
									<div class="widget-content">
										<ul class="footer-menu">
											<?php foreach ( get_field( 'footer_section_2', 'options' )['link'] as $datas ) : ?>
												<li>
													<a href="<?php echo $datas['link_text']['url']; ?>">
														<?php echo $datas['link_text']['title']; ?>
													</a>
												</li>
											<?php endforeach; ?>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-6 col-sm-4">
								<div class="widget">
									<h3 class="widget-title"><?php echo get_field( 'footer_section_3', 'options' )['title']; ?></h3>
									<div class="widget-content">
										<ul class="footer-menu">
											<?php foreach ( get_field( 'footer_section_3', 'options' )['link'] as $datas ) : ?>
												<li>
													<a href="<?php echo $datas['link_text']['url']; ?>">
														<?php echo $datas['link_text']['title']; ?>
													</a>
												</li>
											<?php endforeach; ?>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="row footer-logo-area">
							<div class="col">								
								<a class="footer-logo" href="<?php echo site_url()?>"><img src="<?php echo esc_url( get_field( 'logo_1', 'options' )['url'] ); ?>" alt="<?php echo esc_url( get_field( 'logo_1', 'options' )['alt'] ); ?>"> </a>								
								<div class="footer-social d-flex">
									<?php foreach ( get_field( 'social_1', 'options' ) as $social ) : ?>
										<a href="<?php echo $social['link_url']?>" target="blank"><img src="<?php echo $social['social_logo']['url']; ?>" alt="<?php echo $social['social_logo']['alt']; ?>"></a> 

								<?php endforeach; ?>
									
									<div class="share" style="margin-top: 15px;">

									     <img src="<?php echo get_field( 'link_copy', 'options' )['url']; ?>" alt="<?php echo get_field( 'link_copy', 'options' )['alt']; ?>">
									     <span id="share-notice">link copied</span>
									</div>
								</div>

								<div class="copyright"><?php the_field( 'copyright', 'options' ); ?></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->
 
 
<?php wp_footer(); ?>

</body>
</html> 



<script type="text/javascript">

  	const div = document.getElementsByClassName('share')[0];
	const shareNotice = document.getElementById('share-notice');
	const mouseoverNotice = document.getElementById('mouseover-notice');

	div.onclick = () => {
		window
	  	.navigator
	  	.clipboard
	  	.writeText(window.location.href);
	  
	  	shareNotice.style.display = 'initial';
	  
	  	window.setTimeout(() => shareNotice.style.display = 'none', 1500);  
	};

	div.onmouseover = () => mouseoverNotice.style.display = 'initial';

	div.onmouseleave = () => mouseoverNotice.style.display = 'none';

</script>

<style type="text/css">
  	.share { cursor: pointer }

	#share-notice { display: none; position: absolute; bottom: 0; }

	#mouseover-notice { display: none; }
</style>

