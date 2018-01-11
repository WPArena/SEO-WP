<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package seo_wp
 */

if ( ! function_exists( 'seo_wp_posted_on' ) ) : /**
 * Prints HTML with meta information for the current post-date/time and author.
 */ {
	function seo_wp_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date( 'F j, Y' ) )
		);

		$posted_on_icon = '<i class="material-icons col">event_note</i>';
		$posted_on      = $posted_on_icon . sprintf(
				esc_html_x( ' %s', 'post date', 'seo-wp' ),
				$time_string
			);

		$byline_icon = '<i class="material-icons col">account_box</i>';
		$byline      = $byline_icon . sprintf(
				esc_html_x( ' %s', 'post author', 'seo-wp' ),
				'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
			);

		echo '<span class="posted-on">' . $posted_on . '</span><span class="byline right"> ' . $byline . '<i class="material-icons right activator">more_vert</i></span></span>'; // WPCS: XSS OK.
	}
}
endif;


if ( ! function_exists( 'seo_wp_posted_on_raw' ) ) : /**
 * Prints HTML with meta information for the current post-date/time and author.
 */ {
	function seo_wp_posted_on_raw() {
		$time_string = '<time class="entry-date published updated" itemprop="datePublished" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" itemprop="datePublished" datetime="%1$s">%2$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date( 'F j, Y' ) )
		);

		$posted_on_icon = '<i class="material-icons col">event_note</i>';
		$posted_on      = $posted_on_icon . sprintf(
				esc_html_x( ' %s', 'post date', 'seo-wp' ),
				$time_string
			);

		$byline_icon = '<i class="material-icons col">account_box</i>';
		$byline      = $byline_icon . sprintf(
				esc_html_x( ' %s', 'post author', 'seo-wp' ),
				'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
			);

		echo '<span class="posted-on posted">' . $posted_on . '</span>';
		echo '<p style="display:inline-block;margin:10px;">' . $byline . '</p>';

		 // WPCS: XSS OK.

	}
}
endif;

if ( ! function_exists( 'seo_wp_entry_footer' ) ) : /**
 * Prints HTML with meta information for the categories, tags and comments.
 */ {
	function seo_wp_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' == get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'seo-wp' ) );
			if ( $categories_list && seo_wp_categorized_blog() ) {
				printf( '<i style="position:absolute;margin-top:15px;" class="material-icons">local_offer</i><p style="margin-left:25px;" class="cat-links"> ' . esc_html__( 'Posted in %1$s', 'seo-wp' ) . '</p>', $categories_list ); // WPCS: XSS OK.
			}

			//			printf('<p>Updated on %1$s</p>', '');
			seo_wp_posted_on_raw();

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'seo-wp' ) );
			if ( $tags_list ) {
				printf( '<p class="tags-links"><i class="mdi-action-label"></i> ' . esc_html__( 'Tagged in %1$s', 'seo-wp' ) . '</p>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<p class="comments-link">';
			comments_popup_link( esc_html__( 'Leave a comment', 'seo-wp' ), esc_html__( '1 Comment', 'seo-wp' ), esc_html__( '% Comments', 'seo-wp' ) );
			echo '</p>';
		}

		edit_post_link( esc_html__( 'Edit', 'seo-wp' ), '<p class="edit-link">', '</p>' );
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function seo_wp_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'seo_wp_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories(
			array(
				'fields'     => 'ids',
				'hide_empty' => 1,
				// We only need to know if there is more than one category.
				'number'     => 2,
			)
		);

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'seo_wp_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so seo_wp_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so seo_wp_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in seo_wp_categorized_blog.
 */
function seo_wp_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'seo_wp_categories' );
}

add_action( 'edit_category', 'seo_wp_category_transient_flusher' );
add_action( 'save_post', 'seo_wp_category_transient_flusher' );


class seo_wp_walker_nav_menu extends Walker_Nav_Menu {

	// add classes to ul sub-menus
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		// depth dependent classes
		$indent        = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
		$display_depth = ( $depth + 1 ); // because it counts the first submenu as 0
		$classes       = array(
			'sub-menu',
			( $display_depth % 2 ? 'menu-odd' : 'menu-even' ),
			( $display_depth >= 2 ? 'sub-sub-menu' : '' ),
			'menu-depth-' . $display_depth
		);
		$class_names   = implode( ' ', $classes );

		// build html
		$output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
	}

	// add main/sub classes to li's and links
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $wp_query;
		$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

		// depth dependent classes
		$depth_classes     = array(
			( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
			( $depth >= 2 ? 'sub-sub-menu-item' : '' ),
			( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
			'menu-item-depth-' . $depth
		);
		$depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

		// passed classes
		$classes     = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

		// build html
		$output .= $indent . '<li id="nav-menu-item-' . $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';

		// link attributes
		$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';
		$attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';

		$item_output = sprintf(
			'%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
			$args->before,
			$attributes,
			$args->link_before,
			apply_filters( 'the_title', $item->title, $item->ID ),
			$args->link_after,
			$args->after
		);

		// build html
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 *
 */
function seo_wp_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}
	if ( is_singular() ) {
		echo '<div class="single-thumbnail material-placeholder">';
		the_post_thumbnail( 'large', array( 'class' => '', 'itemprop' => 'image' ) );
		echo '</div>';
	} else {
		the_post_thumbnail( 'medium', array( 'class' => 'activator', 'itemprop' => 'image' ) );
	}
}

/**
 * Remove default excerpt more
 *
 * @param $more
 *
 * @return string
 */
function seo_wp_new_excerpt_more( $more ) {
	return '';
}

add_filter( 'excerpt_more', 'seo_wp_new_excerpt_more' );

/**
 * Increase excerpt length
 *
 * @param $length
 *
 * @return int
 */
function seo_wp_custom_excerpt_length( $length ) {
	return 111;
}

add_filter( 'excerpt_length', 'seo_wp_custom_excerpt_length', 999 );

/**
 * Related posts
 */
function seo_wp_related_posts() {
	global $post;
	$tags = wp_get_post_tags( $post->ID );

	if ( $tags ) {
		$tag_ids = array();
		foreach ( $tags as $individual_tag ) {
			$tag_ids[] = $individual_tag->term_id;
		}
		$args = array(
			'tag__in'             => $tag_ids,
			'post__not_in'        => array( $post->ID ),
			'posts_per_page'      => 3,
			'ignore_sticky_posts' => 1,
			'meta_key'            => '_thumbnail_id'
		);

		$my_query = new wp_query( $args );
		$col      = $my_query->post_count;
		if ( ! $col ) {
			return;
		}
		$col = 'm' . ( 12 / $col );

		echo '<div class="related-posts row">';
		echo '<h3>' . __( 'Related', 'seo-wp' ) . '</h3>';
		while ( $my_query->have_posts() ) {
			$my_query->the_post();
			?>
			<div class="col <?php echo $col; ?> s12">
				<div class="related-thumbnail">
					<a href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php esc_attr( the_title() ); ?>">
						<?php the_post_thumbnail( 'thumbnail', [ 'class' => 'hoverable' ] ) ?>
					</a>
				</div>
				<div class="related-title">
					<a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a>
				</div>
			</div>
			<?php
		}
		echo '</div>';
	}
	wp_reset_query();
}

/**
 * Breadcrumbs with microdata
 */
function seo_wp_breadcrumbs() {

	// Do not display on the homepage
	if ( is_front_page() ) {
		return;
	}
	// Settings
	$id         = 'breadcrumbs';
	$class      = 'breadcrumbs';
	$home_title = __( 'Home', 'seo-wp' );

	// Get the query & post information
	global $post;
	$category = get_the_category();

	// Div container
	echo '<div class="breadcrumbs-container col s12">';
	// Build the breadcrums
	echo '<ul itemscope itemtype="http://schema.org/BreadcrumbList" id="' . $id . '" class="' . $class . '">';


	// Home page
	echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="item-home breadcrumb"><a itemprop="item" class="bread-link bread-home" href="' . esc_url( get_home_url() ) . '" title="' . $home_title . '"><i style="margin-top:-2px;" class="material-icons">home</i></a></li>';
	echo '<li class="separator separator-home material-icons">chevron_right</li>';

	if ( is_single() ) {

		// Single post (Only display the first category)
		echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="item-cat item-cat-' . $category[0]->term_id . ' item-cat-' . $category[0]->category_nicename . '"><a itemprop="item" class="bread-cat bread-cat-' . $category[0]->term_id . ' bread-cat-' . $category[0]->category_nicename . '" href="' . get_category_link( $category[0]->term_id ) . '" title="' . $category[0]->cat_name . '"><span itemprop="name">' . $category[0]->cat_name . '</span></a></li>';
		echo '<li class="separator separator-' . $category[0]->term_id . ' material-icons">chevron_right</li>';
		echo '<li style="margin-top: 1px;" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="item-current item-' . $post->ID . '"><strong itemprop="name" class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';

	} else if ( is_category() ) {

		// Category page
		echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="item-current item-cat-' . $category[0]->term_id . ' item-cat-' . $category[0]->category_nicename . '"><strong itemprop="name" class="bread-current bread-cat-' . $category[0]->term_id . ' bread-cat-' . $category[0]->category_nicename . '">' . $category[0]->cat_name . '</strong></li>';

	} else if ( is_page() ) {

		// Standard page
		if ( $post->post_parent ) {

			// If child page, get parents
			$anc = get_post_ancestors( $post->ID );

			// Get parents in the right order
			$anc = array_reverse( $anc );

			// Parent page loop
			$parents = '';
			foreach ( $anc as $ancestor ) {
				$parents .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="item-parent item-parent-' . $ancestor . '"><a itemprop="item" class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink( $ancestor ) . '" title="' . get_the_title( $ancestor ) . '"><span itemprop="name">' . get_the_title( $ancestor ) . '</span></a></li>';
				$parents .= '<li style="margin-left:-10px;" class="material-icons col">chevron_right</li>';
			}

			// Display parent pages
			echo $parents;

			// Current page
			echo '<li style="margin-top:1px;" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="item-current item-' . $post->ID . '"><strong itemprop="name" title="' . get_the_title() . '"> ' . get_the_title() . '</strong></li>';

		} else {

			// Just display current page if not parents
			echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="item-current item-' . $post->ID . '"><strong itemprop="name" class="bread-current bread-' . $post->ID . '"> ' . get_the_title() . '</strong></li>';

		}

	} else if ( is_tag() ) {

		// Tag page

		// Get tag information
		$term_id  = get_query_var( 'tag_id' );
		$taxonomy = 'post_tag';
		$args     = 'include=' . $term_id;
		$terms    = get_terms( $taxonomy, $args );

		// Display the tag name
		echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="item-current item-tag-' . $terms[0]->term_id . ' item-tag-' . $terms[0]->slug . '"><strong itemprop="name" class="bread-current bread-tag-' . $terms[0]->term_id . ' bread-tag-' . $terms[0]->slug . '">' . $terms[0]->name . '</strong></li>';

	} elseif ( is_day() ) {

		// Day archive

		// Year link
		echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="item-year item-year-' . get_the_time( 'Y' ) . '"><a itemprop="item" class="bread-year bread-year-' . get_the_time( 'Y' ) . '" href="' . get_year_link( get_the_time( 'Y' ) ) . '" title="' . get_the_time( 'Y' ) . '"><span itemprop="name">' . get_the_time( 'Y' ) . ' ' . __( 'Archives', 'seo-wp' ) . '</span></a></li>';
		echo '<li class="separator separator-' . get_the_time( 'Y' ) . ' mdi-navigation-chevron-right"></li>';

		// Month link
		echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="item-month item-month-' . get_the_time( 'm' ) . '"><a itemprop="item" class="bread-month bread-month-' . get_the_time( 'm' ) . '" href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '" title="' . get_the_time( 'M' ) . '"><span itemprop="name">' . get_the_time( 'M' ) . ' ' . __( 'Archives', 'seo-wp' ) . '</span></a></li>';
		echo '<li class="separator separator-' . get_the_time( 'm' ) . ' mdi-navigation-chevron-right"></li>';

		// Day display
		echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="item-current item-' . get_the_time( 'j' ) . '"><strong itemprop="name" class="bread-current bread-' . get_the_time( 'j' ) . '"> ' . get_the_time( 'jS' ) . ' ' . get_the_time( 'M' ) . ' ' . __( 'Archives', 'seo-wp' ) . '</strong></li>';

	} else if ( is_month() ) {

		// Month Archive

		// Year link
		echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="item-year item-year-' . get_the_time( 'Y' ) . '"><a itemprop="item" class="bread-year bread-year-' . get_the_time( 'Y' ) . '" href="' . get_year_link( get_the_time( 'Y' ) ) . '" title="' . get_the_time( 'Y' ) . '"><span itemprop="name">' . get_the_time( 'Y' ) . ' ' . __( 'Archives', 'seo-wp' ) . '</span></a></li>';
		echo '<li class="separator separator-' . get_the_time( 'Y' ) . ' mdi-navigation-chevron-right"></li>';

		// Month display
		echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="item-month item-month-' . get_the_time( 'm' ) . '"><strong itemprop="name" class="bread-month bread-month-' . get_the_time( 'm' ) . '" title="' . get_the_time( 'M' ) . '">' . get_the_time( 'M' ) . ' ' . __( 'Archives', 'seo-wp' ) . '</strong></li>';

	} else if ( is_year() ) {

		// Display year archive
		echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="item-current item-current-' . get_the_time( 'Y' ) . '"><strong itemprop="name" class="bread-current bread-current-' . get_the_time( 'Y' ) . '" title="' . get_the_time( 'Y' ) . '">' . get_the_time( 'Y' ) . ' ' . __( 'Archives', 'seo-wp' ) . '</strong></li>';

	} else if ( is_author() ) {

		// Auhor archive

		// Get the author information
		global $author;
		$userdata = get_userdata( $author );

		// Display author name
		echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="item-current item-current-' . $userdata->user_nicename . '"><strong itemprop="name" class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . __( 'Author', 'seo-wp' ) . ' ' . $userdata->display_name . '</strong></li>';

	} else if ( get_query_var( 'paged' ) ) {

		// Paginated archives
		echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="item-current item-current-' . get_query_var( 'paged' ) . '"><strong itemprop="name" class="bread-current bread-current-' . get_query_var( 'paged' ) . '" title="' . __( 'Page', 'seo-wp' ) . ' ' . get_query_var( 'paged' ) . '">' . __( 'Page', 'seo-wp' ) . ' ' . get_query_var( 'paged' ) . '</strong></li>';

	} else if ( is_search() ) {

		// Search results page
		echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="item-current item-current-' . get_search_query() . '"><strong itemprop="name" class="bread-current bread-current-' . get_search_query() . '" title="' . __( 'Search results for:', 'seo-wp' ) . ' ' . get_search_query() . '">' . __( 'Search results for:', 'seo-wp' ) . ' ' . get_search_query() . '</strong></li>';

	} elseif ( is_404() ) {

		// 404 page
		echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><strong itemprop="name">' . __( '404 Page', 'seo-wp' ) . '</strong></li>';
	}

	echo '</ul>';
	echo '</div>';
}

/**
 * Displays Logo image
 */
function seo_wp_logo() {
	if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) {
		the_custom_logo();
	} else { ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="brand-logo tooltipped truncate waves-effect waves-light" data-position="right" data-delay="50"
		   data-tooltip="<?php bloginfo( 'description' ); ?>"><?php bloginfo( 'name' ); ?></a>
		<?php
	}
}

function seo_wp_custom_logo( $html ) {
	$html = str_replace( 'class="custom-logo-link"', 'class="custom-logo-link brand-logo tooltipped truncate waves-effect waves-light" data-position="right" data-delay="50" data-tooltip="' . get_bloginfo( 'description' ) . '"', $html );

	return $html;
}

add_filter( 'get_custom_logo', 'seo_wp_custom_logo' );

if ( ! function_exists( 'seo_post_navigation' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function seo_post_navigation() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<div class="nav-links">
		<div class="row">
		<!-- Get Previous Post -->
		
		<?php
			$next_post = get_next_post();
			if ( is_a( $next_post , 'WP_Post' ) ) { 
		?>
		<div class="col m6 prev-post" style="padding-left: 22px;">
		<a class="" href="<?php echo esc_url(get_permalink( $next_post->ID )); ?>">
			<?php echo '<i class="material-icons col">arrow_back</i>'; ?>
			<span class="next-prev-text"><?php _e('PREVIOUS POST','seo-wp'); ?></span>
			<br><?php echo '<i style=" visibility:hidden;" class="material-icons col">arrow_back</i>'; ?><span class="hide-on-small-only"><?php if(get_the_title( $next_post->ID ) != ''){echo get_the_title( $next_post->ID );} else {  _e('PREVIOUS POST','seo-wp'); }?></span></a>
		</div>
		<?php } 
		 else { 
			echo '<div class="col m6">';
			echo '<p> </p>';
			echo '</div>';
		} ?>
		
		<!-- Get Next Post -->
		
		<?php
			$prev_post = get_previous_post();
			if (!empty( $prev_post )){
		?>
			<div class="col m6 next-post" style="padding-right: 25px;">
				<a style='float: right;' href="<?php echo esc_url(get_permalink( $prev_post->ID )); ?>">
					<span class="next-prev-text">
						<?php _e('NEXT POST','seo-wp'); ?>
						<?php echo '<i class="material-icons right">arrow_forward</i>'; ?>
					</span>
					<br>
					<span class="hide-on-small-only">
						<?php if(get_the_title( $prev_post->ID ) != ''){echo get_the_title( $prev_post->ID );} else { _e('NEXT POST','seo-wp'); }?>
							
					</span>
				</a>
			</div>

		<?php } 
		 else { 
			echo '<div class="col m6">';
			echo '<p> </p>';
			echo '</div>';
		} ?>
		
		</div>
	</div><!-- .nav-links -->
	<?php
}
endif;