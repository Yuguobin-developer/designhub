<?php
/**
 * Customizer section options.
 *
 * @package designhub
 *
 */

function designhub_customizer_theme_settings( $wp_customize ){
	
	$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';	
		
		$wp_customize->add_setting(
			'arilewp_footer_copright_text',
			array(
				'sanitize_callback' =>  'designhub_sanitize_text',
				'default' => __('Copyright &copy; 2022 | Powered by <a href="//wordpress.org/">WordPress</a> <span class="sep"> | </span> DesignHub theme by <a target="_blank" href="//themearile.com/">ThemeArile</a>', 'designhub'),
				'transport'         => $selective_refresh,
			)	
		);
		$wp_customize->add_control('arilewp_footer_copright_text', array(
				'label' => esc_html__('Footer Copyright','designhub'),
				'section' => 'arilewp_footer_copyright',
				'priority'        => 10,
				'type'    =>  'textarea'
		));

}
add_action( 'customize_register', 'designhub_customizer_theme_settings' );

function designhub_sanitize_text( $input ) {
		return wp_kses_post( force_balance_tags( $input ) );
}