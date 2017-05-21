<?php

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function seo_wp_customize_preview_js() {
	wp_enqueue_script( 'seo_wp-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array(
		'jquery',
		'customize-preview'
	), '20130508', true );
}

add_action( 'customize_preview_init', 'seo_wp_customize_preview_js' );

/* Display footer copyright */
function copyright_customizer_register( $wp_customize ) {
	$wp_customize->add_section( 'footer_copyright', array(
		'title'       => __( 'Copyright Options', 'seo-wp' ),
		'description' => 'Add/Edit copyright infomation'
	) );
	$wp_customize->add_setting( 'copyright', array(
		'default' => '<a href="https://wparena.com/themes/seo-wp-theme/">SEO WP Theme</a> Designed by <a href="https://wparena.com/">WPArena</a>.',
		'sanitize_callback' => 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'designer', array(
		'label'    => __( 'Copyright: ', 'seo-wp' ),
		'section'  => 'footer_copyright',
		'settings' => 'copyright'
	) );
}

add_action( 'customize_register', 'copyright_customizer_register' );