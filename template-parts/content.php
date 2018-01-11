<?php
/**
 * Template part for displaying posts.
 *
 * @package seo_wp
 */
?>
<div class="col l6 m6 s12 animation-element archive">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="card hoverable <?php echo( has_post_thumbnail() ? 'medium' : 'no-thumbnail' ); ?>">
			<?php ?>
			<a href="<?php echo esc_url( get_permalink() ); ?>">
				<div class="card-image waves-effect waves-block waves-light">
				<?php if ( has_post_thumbnail() ) {
					seo_wp_post_thumbnail();
				}
				$sticky = is_sticky() ? '<i class="material-icons">loyalty</i>' : '';
				?>
				<?php the_title('<h2 class="entry-title card-title">','</h2>' ); ?>
				</div>
			</a>
			<div class="card-content">
				<!-- .entry-header -->
				<div class="entry-content">
					<?php
					the_excerpt();
					?>
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
				<?php seo_wp_posted_on() ?>
			</div>
			<!-- .entry-footer -->

			<div class="card-reveal">
				<span class="entry-title card-title"><i class="material-icons right">close</i></span>

				<p><?php the_excerpt(); ?>
					<span class="right read-more"><a href="<?php echo esc_url( get_permalink() ); ?>" class="btn"
					                                 title="<?php echo esc_attr( get_the_title() ); ?>"><?php esc_html_e( 'Read more', 'seo-wp' ); ?></a></span>
				</p>

				<div class="categories">
					<?php
					$categories_list = get_the_category_list( esc_html__( ', ', 'seo-wp' ) );
					if ( $categories_list && seo_wp_categorized_blog() ) {
						printf(
							'<span class="cat-links">
						<i class="mdi-file-folder"></i> ' . esc_html__( 'Posted in %1$s', 'seo-wp' ) . '
					</span>', $categories_list
						); // WPCS: XSS OK.
					}
					?>
				</div>
			</div>

		</div>
	</article>
	<!-- #post-## -->
</div>
