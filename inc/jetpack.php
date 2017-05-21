<?php
/**
 * Jetpack Compatibility File
 * See: https://jetpack.me/
 *
 * @package seo_wp
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function seo_wp_jetpack_setup() {
	add_theme_support(
		'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'seo_wp_infinite_scroll_render',
		'footer'    => 'page',
	)
	);
} // end function seo_wp_jetpack_setup
add_action( 'after_setup_theme', 'seo_wp_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function seo_wp_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', get_post_format() );
	}
} // end function seo_wp_infinite_scroll_render

/**
 * Remove Jetpack CSS
 */
function seo_wp_remove_jetpack_css() {
	// Subscription Form Widget
	wp_dequeue_style( 'jetpack-subscriptions' );
	wp_deregister_style( 'jetpack-subscriptions' );

	// Related Posts
	wp_dequeue_style( 'jetpack_related-posts' );
	wp_deregister_style( 'jetpack_related-posts' );
} // end function seo_wp_remove_jetpack_css
add_action( 'wp_enqueue_scripts', 'seo_wp_remove_jetpack_css', 100 );
