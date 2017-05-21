<?php
/**
 * The template for displaying all single posts.
 *
 * @package seo_wp
 */

get_header(); ?>

<div id="primary" class="content-area col l9 s12">
	<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content', 'single' ); ?>

			<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
			?>

			<!--			--><?php //seo_wp_related_posts(); ?>

		<?php endwhile; // End of the loop. ?>

	</main>
	<!-- #main -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
