<?php
/**
 * Template part for displaying posts.
 *
 * @package seo_wp
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'card shades white'); ?> itemscope="" itemtype="http://schema.org/Article">
	<?php seo_wp_post_thumbnail(); ?>
	<div class="card-content">
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title card-title" itemprop="headline">', '</h1>' ); ?>
		</header>
		<!-- .entry-header -->
		<div class="entry-content" itemprop="articleBody">
			<?php
			the_content();
			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'seo-wp' ),
					'after'  => '</div>',
				)
			);
			seo_wp_related_posts();

			?>
		</div>
		<!-- .entry-content -->
	</div>
	<div class="card-action meta">
		<?php seo_wp_entry_footer(); ?>
	</div>
	<!-- .entry-footer -->
</article>
<!-- #post-## -->
<?php
// Author bio.
if ( is_single() && get_the_author_meta( 'description' ) ) :
	get_template_part( 'author-bio' );
endif;
?>
<?php seo_post_navigation(); ?>


