<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package seo_wp
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
           	<?php
                   	$comments_number = get_comments_number();
                   	if ( '1' === $comments_number ) {
                           	/* translators: %s: post title */
                           	printf( esc_attr_x( 'One thought on &ldquo;%s&rdquo;', 'comments title', 'seo-wp' ), get_the_title() );
                   	} 	else {
                           	printf(
                                   	/* translators: 1: number of comments, 2: post title */
                                   	esc_html(_nx(
                                       	'%1$s thought on &ldquo;%2$s&rdquo;',
                                       	'%1$s thoughts on &ldquo;%2$s&rdquo;',
                                       	$comments_number,
                                       	'comments title',
                                       	'seo-wp'
                                   	)),
                                   	esc_html(number_format_i18n( $comments_number )),
                                   	get_the_title()
                           	);
                   	}
            ?>
        </h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
				<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'seo-wp' ); ?></h2>

				<div class="nav-links">

					<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'seo-wp' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'seo-wp' ) ); ?></div>

				</div>
				<!-- .nav-links -->
			</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

		<ul class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 60,
				)
			);
			?>
		</ul><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
				<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'seo-wp' ); ?></h2>

				<div class="nav-links">

					<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'seo-wp' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'seo-wp' ) ); ?></div>

				</div>
				<!-- .nav-links -->
			</nav><!-- #comment-nav-below -->
		<?php endif; // Check for comment navigation. ?>

	<?php endif; // Check for have_comments(). ?>

	<?php
	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'seo-wp' ); ?></p>
	<?php endif; ?>

	<?php
	$req = get_option( 'require_name_email' );

	$args = array(
		'class_submit'  => 'submit waves-effect waves-light',
		'comment_field' => '
			<div class="comment-form-comment input-field">
				<i class="mdi-editor-insert-comment prefix"></i>
				<textarea id="comment" name="comment" cols="75" rows="8" aria-required="true" class="materialize-textarea">' . '</textarea>
				<label for="comment">' . __( 'Comment', 'seo-wp' ) . '</label>
			</div>
		',
		'fields'        => array(
			'author' => '
				<div class="comment-form-author input-field">
					<i class="mdi-action-account-circle prefix"></i>
					<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" />
					<label for="author">' . __( 'Name', 'seo-wp' ) . ( $req ? ' *' : '' ) . '</label>' . '
				</div>
			',

			'email' => '
				<div class="comment-form-email input-field">
					<i class="mdi-communication-email prefix"></i>
					<input id="email" name="email" type="email" class="validate" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" />
					<label for="email" data-error="' . __( 'Wrong email address', 'seo-wp' ) . '" data-success="' . __( 'Seems to be a valid email address', 'seo-wp' ) . '">' . __( 'Email', 'seo-wp' ) . ( $req ? ' *' : '' ) . '</label>' . '
				</div>
			',

			'url' => '
				<div class="comment-form-url input-field">
					<i class="mdi-action-https prefix"></i>
					<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" />
					<label for="url">' . __( 'Website', 'seo-wp' ) . '</label>' . '
				</div>
			',
		)
	);
	?>

	<?php comment_form( $args ); ?>

</div><!-- #comments -->
