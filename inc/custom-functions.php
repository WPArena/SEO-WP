<?php

/**
 * Rewrite uri stylesheet
 */
/**if ( ! function_exists( 'seo_wp_rewrite_uri_stylesheet' ) ) {
	function seo_wp_rewrite_uri_stylesheet() {
		return get_stylesheet_directory_uri() . '/style.min.css';
	}
}

add_action( 'stylesheet_uri', 'seo_wp_rewrite_uri_stylesheet' );

if ( ! function_exists( 'seo_wp___return_false_value' ) ) {
	function seo_wp___return_false_value( $value ) {
		return $value;
	}
}
*/

/**
 * Custom header image
 */
if ( ! function_exists( 'seo_wp_custom_header_image' ) ) {
	function seo_wp_custom_header_image() {
		$header_image = get_custom_header();

		if ( ! property_exists( $header_image, 'url' ) ) {
			return;
		}

		if ( $header_image->url == '' || ! isset( $header_image->url ) ) {
			return;
		}

		echo '<img src="' . esc_url(get_header_image()) . '" height="' . esc_attr($header_image->height) . '" width="' . esc_attr($header_image->width) . '" alt="attachment-' . esc_attr($header_image->attachment_id) . '" />';
	}
}

/**
 * Preloader
 */
if ( ! function_exists( 'seo_wp_preloader' ) ) {
	function seo_wp_preloader() {
		?>
		<div class="container" id="preloader">
			<div class="row">
				<div class="col s6 offset-s3 center">
					<div class="progress">
						<div class="indeterminate"></div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}


/**
 * Add class pre-loader to body class
 */
if ( ! function_exists( 'seo_wp_preloader_add_class' ) ) {
	function seo_wp_preloader_add_class( $classes ) {
		// add 'class-name' to the $classes array
		$classes[] = 'preloader';

		// return the $classes array
		return $classes;
	}
}

add_filter( 'body_class', 'seo_wp_preloader_add_class' );