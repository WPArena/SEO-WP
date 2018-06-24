<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package seo_wp
 */

?>
</div>
</div><!-- #content -->
<footer id="colophon" class="site-footer page-footer" role="contentinfo" itemscope="" itemtype="http://schema.org/WPFooter">
	<?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) ) : ?>
		<div class="container">
			<div class="row">
				<div id="sidebar-footer-1" class="widget-area col m4 s12" role="complementary">
					<?php dynamic_sidebar( 'footer-1' ); ?>
				</div>
				<!-- #sidebar-footer-1 -->
				<div id="sidebar-footer-2" class="widget-area col m4 s12" role="complementary">
					<?php dynamic_sidebar( 'footer-2' ); ?>
				</div>
				<!-- #sidebar-footer-2 -->
				<div id="sidebar-footer-3" class="widget-area col m4 s12" role="complementary">
					<?php dynamic_sidebar( 'footer-3' ); ?>
				</div>
				<!-- #sidebar-footer-3 -->
			</div>
		</div>
	<?php endif; ?>
	<div class="site-info footer-copyright">
		<div class="container">
		<?php $wordpress_uri = 'https://wordpress.org/';?>

		<?php if(get_theme_mod('copyright')) { 
					$get_copyright_text = esc_html(get_theme_mod('copyright'));
					echo "&copy".esc_html(date("o"))." ";
					echo esc_html($get_copyright_text);
					echo esc_html__(' Powered by ', 'seo-wp');
					echo '<a href="'. esc_url($wordpress_uri).'"target="_blank">WordPress.</a>';

		} else { 
						$author_uri = 'https://wparena.com/';
				?>

				&copy; <?php echo esc_html(date_i18n( __( 'Y', 'seo-wp' ) ) ); ?> <a href="<?php echo esc_url(home_url()); ?>"><?php echo esc_html(get_bloginfo('name')); ?></a> - Theme By <a href="<?php echo esc_url($author_uri); ?>" target="_blank">WPArena</a> . <?php echo esc_html__('Powered by', 'seo-wp'); ?> <a href="<?php echo esc_url($wordpress_uri); ?>" target="_blank">WordPress.</a>

			<?php } ?>

		</div>
		<!-- .container -->
	</div>

	<!-- .site-info -->
</footer><!-- #colophon -->

<div class="fixed-action-btn to-top">
	<a class="btn-floating btn-large waves-effect waves-light">
		<i class="material-icons">keyboard_arrow_up</i>
	</a>
</div>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
