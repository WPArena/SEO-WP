<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package seo_wp
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php seo_wp_preloader(); ?>

<div id="page" class="hfeed site">
	<header id="masthead" class="site-header row" role="banner" itemscope itemtype="http://schema.org/WPHeader">
		<nav id="site-navigation" class="main-navigation" role="navigation">
			<div class="nav-wrapper container">
				<?php seo_wp_logo(); ?>
				<a href="#" data-activates="side-primary-menu" class="button-collapse"><i class="mdi-navigation-menu"></i></a>

				<?php wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'menu_id'        => 'side-primary-menu',
						'menu_class'     => 'side-nav',
					)
				); ?>
				<?php wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'menu_id'        => 'primary-menu',
						'menu_class'     => 'primary-menu right hide-on-med-and-down',
					)
				); ?>

				<?php //dynamic_sidebar( 'menu-right' ); ?>
			</div>
		</nav>
		<!-- #site-navigation -->
	</header>
	<!-- #masthead -->

	<div id="content" class="site-content container">
		<div class="row">
			<?php seo_wp_breadcrumbs(); ?>
