<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package seo_wp
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'card shades white' ); ?> itemscope="" itemtype="http://schema.org/Article">
	<?php seo_wp_post_thumbnail(); ?>
	<div class="card-content">
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title card-title" itemprop="name">', '</h1>' ); ?>
		</header>
		<!-- .entry-header -->
		<div class="entry-content" itemprop="articleBody">
			<?php the_content(); ?>
			<?php
			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'seo-wp' ),
					'after'  => '</div>',
				)
			);
			?>
		</div>
		<!-- .entry-content -->
	</div>
	<div class="card-action">
		<?php edit_post_link( esc_html__( 'Edit', 'seo-wp' ), '<span class="edit-link">', '</span>' ); ?>
	</div>
	<!-- .entry-footer -->
</article>
<!-- #post-## -->

