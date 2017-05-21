<form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="input-field">
		<label for="s_"><?php esc_html_e( 'Search for:', 'seo-wp' ); ?></label>
		<input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s_" class="validate" />
		<button type="submit" id="searchsubmit" class="btn waves-effect waves-light"><?php esc_html_e( 'Search', 'seo-wp' ); ?></button>
	</div>
</form>