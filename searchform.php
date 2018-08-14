<?php
/**
 * Template for displaying search forms
 *
 * @package  TM Moody
 * @since    1.0
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'tm-moody' ); ?></span>
		<input type="search" class="search-field"
		       placeholder="<?php echo esc_attr_x( 'Search...', 'placeholder', 'tm-moody' ); ?>"
		       value="<?php echo get_search_query() ?>" name="s"
		       title="<?php echo esc_attr_x( 'Search for:', 'label', 'tm-moody' ); ?>"/>
	</label>
	<button type="submit" class="search-submit"><i class="icon-magnifier-1"></i><span
			class="screen-reader-text"><?php echo _x( 'Search', 'submit button', 'tm-moody' ); ?></span></button>
</form>
