<?php

/**
 * Created by PhpStorm.
 * User: thong
 * Date: 7/4/15
 * Time: 8:56 AM
 */

if ( ! class_exists( 'SEO_WP_Tabs_Widget' ) ):
	class SEO_WP_Tabs_Widget extends WP_Widget {

		/**
		 * Sets up the widgets name etc
		 */
		public function __construct() {
			// widget actual processes
			parent::__construct(
				'seo_wp_tabs_widget', // Base ID
				__( '[SEO WP] Tabs', 'seo-wp' ), // Name
				array( 'description' => __( 'Display a tabs with recent posts, recent comments', 'seo-wp' ), ) // Args
			);
		}

		/**
		 * Outputs the content of the widget
		 *
		 * @param array $args
		 * @param array $instance
		 */
		public function widget( $args, $instance ) {
			// outputs the content of the widget
			$recent_posts = wp_get_recent_posts();
			$comments     = get_comments();
			?>
			<div class="seo_wp_tabs">
				<div class="row">
					<div class="col s12">
						<ul class="tabs">
							<li class="tab col s6">
								<a class="active" href="#recent-posts"><?php esc_html_e( 'Recent Posts', 'seo-wp' ); ?></a></li>
							<li class="tab col s6"><a href="#recent-comments"><?php esc_html_e( 'Comments', 'seo-wp' ); ?></a>
							</li>
						</ul>
					</div>
					<div id="recent-posts" class="col s12">
						<div class="collection">
							<?php foreach ( $recent_posts as $recent_post ) : ?>
								<a href="<?php echo esc_url(get_permalink( $recent_post['ID'] )); ?>" class="collection-item"><?php echo esc_html($recent_post['post_title']); ?></a>
							<?php endforeach; ?>
						</div>
					</div>
					<div id="recent-comments" class="col s12">
						<div class="collection">
							<?php foreach ( $comments as $comment ) : ?>
								<span><?php echo esc_html($comment->comment_author) . ' ' . esc_html__( 'on', 'seo-wp' ); ?></span>
								<a href="<?php echo esc_url(get_permalink( $comment->comment_post_ID )); ?>" class="collection-item"><?php echo get_the_title( $comment->comment_post_ID ); ?></a>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
			<?php
		}

		/**
		 * Outputs the options form on admin
		 *
		 * @param array $instance The widget options
		 */
		public function form( $instance ) {
			// outputs the options form on admin
		}

		/**
		 * Processing widget options on save
		 *
		 * @param array $new_instance The new options
		 * @param array $old_instance The previous options
		 */
		public function update( $new_instance, $old_instance ) {
			// processes widget options to be saved
		}
	}
endif;

if ( ! function_exists( 'seo_wp_register_tabs_widget' ) ) {
	// register SEO_WP_Tabs_Widget widget
	function seo_wp_register_tabs_widget() {
		register_widget( 'SEO_WP_Tabs_Widget' );
	}
}

add_action( 'widgets_init', 'seo_wp_register_tabs_widget' );