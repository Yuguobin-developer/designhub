<?php
/**
 * Template for displaying articles
 *
 * @package DesignHub
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// ACF Fields
$designhub_link 		= get_field( 'designhub_link' );
?>

<div aria-hidden="true" class="acf-designhub-link acf-block">
    <a href="<?php echo $designhub_link["url"]; ?>"><?php echo $designhub_link["title"]; ?></a>
</div>