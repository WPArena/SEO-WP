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
	$wp_customize->add_setting( 'copyright', array(/*
		'default' => '<a href="https://wparena.com/themes/seo-wp-theme/">SEO WP Theme</a> Designed by <a href="https://wparena.com/">WPArena</a>.',*/
		'sanitize_callback' => 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'designer', array(
		'label'    => __( 'Copyright: ', 'seo-wp' ),
		'section'  => 'footer_copyright',
		'settings' => 'copyright'	
	) );
}

add_action( 'customize_register', 'copyright_customizer_register' );



// Customize Appearance Options
function seowp_customize_register( $wp_customize ) {

	$wp_customize->add_setting('wp_header_color', array(
		'default' => '#1E88E5',
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color'
	));

	

	$wp_customize->add_setting('wp_footer_color', array(
		'default' => '#1E88E5',
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color'
	));

	$wp_customize->add_setting('wp_card_color', array(
		'default' => '#1E88E5',
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color'
	));




	$wp_customize->add_setting('wp_link_color', array(
		'default' => '#1E88E5',
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color'
	));

	$wp_customize->add_setting('wp_btn_color', array(
		'default' => '#1E88E5',
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color'
	));

	$wp_customize->add_setting('wp_btn_hover_color', array(
		'default' => '#1E88E5',
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color'
	));



	

	$wp_customize->add_section('wp_site_colors', array(
		'title' => __('Site Colors', 'seo-wp'),
		'priority' => 20,
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wp_header_color_control', array(
		'label' => __('Header Color', 'seo-wp'),
		'section' => 'wp_site_colors',
		'settings' => 'wp_header_color',
	) ) );

	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wp_footer_color_control', array(
		'label' => __('Footer Color', 'seo-wp'),
		'section' => 'wp_site_colors',
		'settings' => 'wp_footer_color',
	) ) );


	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wp_card_color_control', array(
		'label' => __('Card Header Color', 'seo-wp'),
		'section' => 'wp_site_colors',
		'settings' => 'wp_card_color',
	) ) );




	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wp_link_color_control', array(
		'label' => __('Link Color', 'seo-wp'),
		'section' => 'wp_site_colors',
		'settings' => 'wp_link_color',
	) ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wp_btn_color_control', array(
		'label' => __('Button Color', 'seo-wp'),
		'section' => 'wp_site_colors',
		'settings' => 'wp_btn_color',
	) ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wp_btn_hover_color_control', array(
		'label' => __('Button Hover Color', 'seo-wp'),
		'section' => 'wp_site_colors',
		'settings' => 'wp_btn_hover_color',
	) ) );
}

add_action('customize_register', 'seowp_customize_register');






// Output Customize CSS
function seowp_customize_css() { ?>

	<style type="text/css">

		
		nav{
			background-color: <?php echo get_theme_mod('wp_header_color'); ?>;
		}

		article .no-thumbnail .card-image .entry-title {
			background-color: <?php echo get_theme_mod('wp_card_color'); ?>;
		}

		.page-footer,
		.btn-floating.btn-large i {
			background-color: <?php echo get_theme_mod('wp_footer_color'); ?>;
		}

		/*a:link,
		a:visited {
			color: <?php echo get_theme_mod('wp_link_color'); ?>;
		}
*/		
		ul.sub-menu ,
		.site-header nav ul li.current-menu-item a:link,
		.site-header nav ul li.current-menu-item a:visited,
		.site-header nav ul li.current-page-ancestor a:link,
		.site-header nav ul li.current-page-ancestor a:visited, 
		.widget-area h3.widget-title:after{
			background-color: <?php echo get_theme_mod('wp_link_color'); ?>;
		}

		li.page_item_has_children ul {
			background-color: <?php echo get_theme_mod('wp_link_color'); ?>;
		}

		.reply .comment-reply-link{
		border:1px solid <?php echo get_theme_mod('wp_link_color'); ?>;
		}

		.author.vcard a,
		.edit-link .post-edit-link,
		.cat-links a,.tags-links a{
			color: <?php echo get_theme_mod('wp_link_color').'!important'; ?>;
		}

		.btn-a,
		.btn-a:link,
		.btn-a:visited,
		.input-field button[type='submit'],
		div.hd-search #searchsubmit {
			background-color: <?php echo get_theme_mod('wp_btn_color'); ?>;
		}

		.btn-a:hover,
		div.hd-search #searchsubmit:hover {
			background-color: <?php echo get_theme_mod('wp_btn_hover_color'); ?>;
		}
		

	</style>

<?php }

add_action('wp_head', 'seowp_customize_css');
