<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package seo-wp
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<div id="secondary" class="widget-area col l3 s12" role="complementary" itemscope="" itemtype="http://schema.org/WPSideBar">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div><!-- #secondary -->





