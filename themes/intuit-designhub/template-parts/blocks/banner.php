<?php
/**
 * Template for displaying articles
 *
 * @package DesignHub
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// ACF Fields
$banners = get_field( 'banners' );

// Block ID
$block_id = 'acf-block-' . rand( 0, 99999 );
?>

<!-- <script type="text/javascript" src="<?php echo get_template_directory_uri()?>/assets/js/lib/gsap3/gsap.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri()?>/scrollmagic/uncompressed/ScrollMagic.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri()?>/scrollmagic/uncompressed/plugins/animation.gsap.js"></script> -->

<div class="acf-block-banner acf-block" id="<?php echo $block_id; ?>">
    <div id="pinContainer">
        <?php 
        foreach ( $banners as $banner ) :
            $banner_id          = 'banner-' . rand( 0, 99999 );
            $banner_type        = $banner['banner_type'];
            $title              = $banner['title'];
            $links              = $banner['links'];
            $background         = $banner['background'];
            $title_color        = $banner['title_color'];
            $link_color         = $banner['link_color'];
            $link_hover_color   = $banner['link_hover_color'];

            if ( 'with_article' === $banner_type ) {
                $tag_name       = $banner['tag_name'];
                $image          = $banner['image'];
                $tag_color      = $banner['tag_color'];
            }
            ?>

            <section id="<?php echo $banner_id; ?>" class="banner banner-<?php echo $banner_type; ?>" aria-label="banner" style="background-color: <?php echo $background; ?>;">
                <div class="container">
                    <?php if ( 'without_article' == $banner_type ) : ?>

                        <div class="row align-items-center" tabindex="0">
                            <div class="col">

                                <?php if ( $title ) : ?>
                                    <div class="title"><?php echo $title; ?></div>
                                <?php endif; ?>

                                <?php if ( $links ) : ?>
                                    <div class="d-flex links">
                                        <?php foreach ( $links as $link ) : 
                                            $link = $link['link'];
                                            $link_url = $link['url'];
                                            $link_title = $link['title'];
                                            $link_target = $link['target'] ? $link['target'] : '_self';
                                            ?>
                                            <a class="underline text-uppercase" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>

                    <?php else : ?>

                        <div class="row align-items-center">
                            <div class="col-lg-5">

                                <?php if ( $tag_name ) : ?>
                                    <span class="tags"><?php echo $tag_name; ?></span>
                                <?php endif; ?>

                                <?php if ( $title ) : ?>
                                    <div class="title"><?php echo $title; ?></div>
                                <?php endif; ?>

                                <?php if ( $links ) : ?>
                                    <div class="d-flex links">
                                        <?php foreach ( $links as $link ) : 
                                            $link = $link['link'];
                                            $link_url = $link['url'];
                                            $link_title = $link['title'];
                                            $link_target = $link['target'] ? $link['target'] : '_self';
                                            ?>
                                            <a class="underline text-uppercase" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>

                            </div>
                            <div class="col-lg-7 order-first order-lg-last">
                                <div class="banner-image">
                                <?php if ( $image ) : ?>
                                    <?php foreach ( $links as $link ) : 
                                            $link = $link['link'];
                                            $link_url = $link['url'];
                                            $link_title = $link['title'];
                                            $link_target = $link['target'] ? $link['target'] : '_self';
                                            ?>
                                            <a class="underline text-uppercase" style="width: 100%;border-bottom:0px !important;overflow:unset;" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">               
                                        <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
                                    </a></div>
                                        <?php endforeach; ?>
                                    
                                <?php endif; ?>

                            </div>
                        </div>
                        
                    <?php endif; ?>                    
                </div>                
            </section>

            <style>                
                .acf-block-banner#<?php echo $block_id; ?> #<?php echo $banner_id; ?> .title h2, 
                .acf-block-banner#<?php echo $block_id; ?> #<?php echo $banner_id; ?> .title h3 { color: <?php echo $title_color; ?>; }
                .acf-block-banner#<?php echo $block_id; ?> #<?php echo $banner_id; ?> a { color: <?php echo $link_color; ?>; border-color: <?php echo $link_color; ?>; }
                .acf-block-banner#<?php echo $block_id; ?> #<?php echo $banner_id; ?> a:hover { color: <?php echo $link_hover_color; ?>; border-color: <?php echo $link_hover_color; ?>; }
                <?php if ( 'with_article' == $banner_type ) : ?>
                    .acf-block-banner#<?php echo $block_id; ?> #<?php echo $banner_id; ?> .tags { color: <?php echo $link_hover_color; ?>; border-color: <?php echo $link_hover_color; ?>; }
                <?php endif; ?>
            </style>

        <?php endforeach;  ?>
    </div><!-- #pinContainer -->
</div>

<?php if ( !is_admin() ) : ?>
    <script>
        (function( $ ) {
            $(document).ready(function() {
                // init
                var controller = new ScrollMagic.Controller();
                var offset = 0;

                $('section.banner:not(:first-child)').each (function() {
                    var id = $(this).attr('id');
                    
                    var wipeAnimation = new TimelineMax()
                        .fromTo('.banner#' + id, 1, {x:  "100%"}, {x: "0%", ease: Linear.easeNone})  // in from right

                    // create scene to pin and link animation
                    new ScrollMagic.Scene({
                            triggerElement: "#pinContainer",
                            triggerHook: "onLeave",
                            duration: "800",
                            offset: offset
                        })
                        .setPin("#pinContainer")
                        .setTween(wipeAnimation)
                        // .addIndicators() // add indicators (requires plugin)
                        .addTo(controller);

                    offset += 800;
                });
                
            }); 
        })( jQuery );


        $('.banner-without_article a:last').on('keydown', function(e) {
            $('.banner-with_article:first').attr("style", "transform: translate3d(0%, 0px, 0px); background-color:rgb(0, 132, 129);");
        })
        $('.banner-with_article:first a').on('keydown', function(e) {
            $('.banner-with_article:last').attr("style", "transform: translate3d(0%, 0px, 0px); background-color:rgb(30, 115, 190);");
        })
        $('.banner-with_article:last a:first').on('keydown', function(e) {
            
                if (e.which == 9)
                {
                    if(e.shiftKey)
                    {
                        $('.banner-with_article:first').attr("style", "transform: translate3d(0%, 0px, 0px); background-color:rgb(0, 132, 129); z-index:1;");
                    }
                }
            
            //$('.banner-with_article:last').attr("style", "transform: translate3d(0%, 0px, 0px); background-color:rgb(30, 115, 190);");
        })

        $('.banner-with_article:first a').on('keydown', function(e) {
            if (e.which == 9)
            {
                if(e.shiftKey)
                {
                    $('.banner-without_article').attr("style", "background-color:#ff8979; z-index:2;");
                }
            }
        })
        $("h5").attr("tabindex", "0");

        //$('.banner-with_article:first').attr("style", "transform: translate3d(0%, 0px, 0px);");


        // $('.banner a.underline div').on('keydown', function(e) {
        //     $(this).attr("tabindex", "0");
        //     // if(e.which == 9) {
        //     //     $('.algolia-autocomplete').css('display','none');
        //     // }
        // })
    </script>
<?php endif; ?>