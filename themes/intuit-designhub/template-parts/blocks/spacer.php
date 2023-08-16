<?php
/**
 * Template for displaying articles
 *
 * @package DesignHub
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// ACF Fields
$height_desktop 		= get_field( 'height_desktop' );
$height_tablet			= get_field( 'height_tablet' );
$height_mobile			= get_field( 'height_mobile' );

// Block ID
$block_id               = 'acf-block-' . rand( 0, 99999 );
?>

<div aria-hidden="true" class="acf-block-spacer acf-block" id="<?php echo $block_id; ?>"></div>

<style>
    <?php if ( $height_desktop ) : ?>
        .acf-block-spacer#<?php echo $block_id; ?> { height: <?php echo $height_desktop; ?>px; }
    <?php endif; ?>
    <?php if ( $height_tablet ) : ?>
        @media (max-width: 767px) {
            .acf-block-spacer#<?php echo $block_id; ?> { height: <?php echo $height_tablet; ?>px; }    
        }        
    <?php endif; ?>
    <?php if ( $height_mobile ) : ?>
        @media (max-width: 480px) {
            .acf-block-spacer#<?php echo $block_id; ?> { height: <?php echo $height_mobile; ?>px; }    
        }        
    <?php endif; ?>
</style>