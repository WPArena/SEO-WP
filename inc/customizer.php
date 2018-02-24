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

//PreLoadder
	$wp_customize->add_section('Preloader_color_section', array(
		'title' => __('PreLoader Color', 'seo-wp'),
		'priority' => 21,
	));

	$wp_customize->add_setting('Preloader_bar_color', array(
		'default' => 'red',
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color'
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'preloader_bar_color_control', array(
		'label' => __('Progress Bar Color', 'seo-wp'),
		'section' => 'Preloader_color_section',
		'settings' => 'Preloader_bar_color',
	) ) );

	$wp_customize->add_setting('Preloader_color', array(
		'default' => '#1E88E5',
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color'
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'preloader_color_control', array(
		'label' => __('Progressbar Inner Color', 'seo-wp'),
		'section' => 'Preloader_color_section',
		'settings' => 'Preloader_color',
	) ) );

/*Show Custom Post Numbers on Page*/
	
	function sanitize_radio_button( $input ) {
	    $valid = array(
	        '12' => '1 Post',
    		'6' => '2 Posts',
    		'4' => '3 Posts',
	    );
	 
	    if ( array_key_exists( $input, $valid ) ) {
	        return $input;
	    } else {
	        return '';
	    }
	}

	$wp_customize->add_section('Custom_post_numbers_section', array(
		'title' => __('Post Numbers To Show In 1 Line', 'seo-wp'),
		'priority' => 22,
	));

	$wp_customize->add_setting('Custom_post_numbers', array(
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_radio_button'
	));

	$wp_customize->add_control('Custom_post_numbers_control', array(
		'label' => __('Number Of Posts To Show', 'seo-wp'),
		'section' => 'Custom_post_numbers_section',
		'settings' => 'Custom_post_numbers',
		'type' => 'radio',
  		'choices' => array(
    	'12' => '1 Post',
    	'6' => '2 Posts',
    	'4' => '3 Posts'
		)
	) );




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

		/*Preloader innner color*/
		.progress .indeterminate{
			background-color: <?php echo get_theme_mod('Preloader_color','#1E88E5');?>;
		}

		/*Preloader progressbar color*/
		#preloader .row .col .progress{
			background-color: <?php echo get_theme_mod('Preloader_bar_color','red');?>;
		}


		nav{
			background-color: <?php echo get_theme_mod('wp_header_color','#1E88E5'); ?>;
		}

		article .no-thumbnail .card-image .entry-title {
			background-color: <?php echo get_theme_mod('wp_card_color','#1E88E5'); ?>;
		}

		.page-footer,
		.btn-floating.btn-large i {
			background-color: <?php echo get_theme_mod('wp_footer_color','#1E88E5'); ?>;
		}

		/*a:link,
		a:visited {
			color: <?php echo get_theme_mod('wp_link_color'); ?>;
		}
*/		
		
		.widget-area h3.widget-title:after{
			background-color: <?php echo get_theme_mod('wp_link_color','#1E88E5'); ?>;
		}

		ul.sub-menu {
			background-color: <?php echo get_theme_mod('wp_header_color','#1E88E5'); ?>;
		} 


		.site-header nav ul li.current-menu-item ,
		.site-header nav ul li.current-page-ancestor {
			background-color: rgba(0,0,0,0.1);
		}

		.site-header nav ul li.current-menu-item a:hover,
		.site-header nav ul li.current-page-ancestor a:hover{
			background-color: rgba(0,0,0,0.1);
		}

		.logged-in-as a{
			color: <?php echo get_theme_mod('wp_link_color','#1E88E5'); ?>;
		}

		li.page_item_has_children ul {
			background-color: <?php echo get_theme_mod('wp_header_color','#1E88E5'); ?>;
		}

		div.primary-menu ul li.current_page_item, .current_page_ancestor {
			background-color: rgba(0,0,0,0.1);
		}

		.author.vcard a,
		.edit-link .post-edit-link,
		.cat-links a,.tags-links a{
			color: <?php echo get_theme_mod('wp_link_color','#1E88E5').'!important'; ?>;
		}

		.btn-a,
		.btn-a:link,
		.btn-a:visited,
		.input-field button[type='submit'],
		div.hd-search #searchsubmit {
			background-color: <?php echo get_theme_mod('wp_btn_color','#1E88E5'); ?>!important;
		}

		.btn-a:hover,
		#searchsubmit:hover,#submit:hover{
			background-color: <?php echo get_theme_mod('wp_btn_hover_color','#1E88E5'); ?>!important;
		}
		

		.form-submit .submit .waves-button-input{
			background-color: <?php echo get_theme_mod('wp_btn_color','#1E88E5'); ?>;
		}

		.related-posts .related-title a{
    		color: <?php echo get_theme_mod('wp_link_color','#1E88E5'); ?>;
		}

		.nav-links .prev-post span,.nav-links .prev-post,.nav-links .next-post span,.nav-links .next-post,
		.nav-links .prev-post .material-icons {
    		color: <?php echo get_theme_mod('wp_link_color','#1E88E5').'!important'; ?>;
    		transition: 0.3s;
		}

		.nav-links .page-numbers:hover {
    		background-color: <?php echo get_theme_mod('wp_btn_hover_color','#1E88E5').'!important'; ?>;
    		transition: 0.3s;
		}

		.nav-links .page-numbers {
    		background-color: <?php echo get_theme_mod('wp_btn_color','#1E88E5').'!important'; ?>;
    		transition: 0.3s;
		}


	</style>

<?php }

add_action('wp_head', 'seowp_customize_css');
