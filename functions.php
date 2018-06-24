<?php
/**
 * seo_wp functions and definitions
 *
 * @package seo_wp
 */

define( 'SEO_WP_THEME_VERSION', '2.3.3' );

if ( ! function_exists( 'seo_wp_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function seo_wp_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on seo_wp, use a find and replace
		 * to change 'seo-wp' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'seo-wp', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );

		add_theme_support( 'custom-logo', array(
			'height'      => 50,
			'width'       => 100,
		) );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary Menu', 'seo-wp' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);
		/*Add Support for background-color and background image*/ 
		add_theme_support( 'custom-background');

		/*Add Support for header-image*/ 
		add_theme_support( "custom-header");

		/*
		 * Enable support for Post Formats.
		 * See http://codex.wordpress.org/Post_Formats
		 */
		add_theme_support(
			'post-formats', array(
				'aside',
				'gallery',
				'link',
				'image',
				'quote',
				'status',
				'video',
				'audio',
				'chat',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background', apply_filters(
				'seo_wp_custom_background_args', array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);
	}
endif; // seo_wp_setup
add_action( 'after_setup_theme', 'seo_wp_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function seo_wp_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'seo_wp_content_width', 640 );
}

add_action( 'after_setup_theme', 'seo_wp_content_width', 0 );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function seo_wp_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'seo-wp' ),
			'id'            => 'sidebar-1',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s card-panel animation-element">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 1', 'seo-wp' ),
			'id'            => 'footer-1',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s animation-element">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 2', 'seo-wp' ),
			'id'            => 'footer-2',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s animation-element">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 3', 'seo-wp' ),
			'id'            => 'footer-3',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s animation-element">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
}

add_action( 'widgets_init', 'seo_wp_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function seo_wp_scripts() {
	// Global
	
	wp_enqueue_style('materialize.min.css', 'https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css', array(), SEO_WP_THEME_VERSION );

	wp_enqueue_style( 'seo_wp-style', get_stylesheet_uri(), array(), SEO_WP_THEME_VERSION );

	//wp_enqueue_style('customstyle', get_template_directory_uri() . '/style.min.css', array(), '1.0.0', 'all');
	wp_enqueue_style( 'seo_wp-Material_Icons', 'https://fonts.googleapis.com/icon?family=Material+Icons', array(), SEO_WP_THEME_VERSION );

	wp_enqueue_script( 'seo_wp-materialize-js', get_template_directory_uri() . '/assets/js/materialize.min.js', array( 'jquery' ), '0.97.5', true );
	
	wp_enqueue_script( 'seo_wp-animations-js', get_template_directory_uri() . '/assets/js/seowp-animations.js', array( 'jquery' ), '0.97.5' 	, true );

	wp_enqueue_script( 'seo_wp-custom-js', get_template_directory_uri() . '/assets/js/seowp-custom.js', array(
		'jquery',
		'seo_wp-materialize-js'
	), SEO_WP_THEME_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_localize_script( 'seo_wp-custom-js', 'seo_wp_object', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
	) );
}

add_action( 'wp_enqueue_scripts', 'seo_wp_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Theme Widgets
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Custom functions
 */
require get_template_directory() . '/inc/custom-functions.php';

function seo_wp_excerpt_length( $length ) {
	if(is_admin()){
		return $length;
	}
    return 35;
}
add_filter( 'excerpt_length', 'seo_wp_excerpt_length', 999 );

/**
* Add a pingback url auto-discovery header for singularly identifiable articles.
*/
function seo_wp_pingback_header() {
    if ( is_singular() && pings_open() ) {
        printf( '<link rel="pingback" href="%s">' . "\n", esc_url(get_bloginfo( 'pingback_url' ) ) );
    }
}

add_action( 'wp_head', 'seo_wp_pingback_header' );