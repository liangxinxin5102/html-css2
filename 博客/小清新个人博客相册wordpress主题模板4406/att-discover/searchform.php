<?php
/**
 * Theme searchform
 *
 * @package WordPress
 * @subpackage Authentic Themes
 * @since 1.0
 */
?>

<form method="get" id="searchform" class="searchform att-searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
	<input type="search" class="field" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" placeholder="<?php echo esc_attr_x( 'Search &amp; Press Enter', 'placeholder', 'att' ); ?>" />
</form>