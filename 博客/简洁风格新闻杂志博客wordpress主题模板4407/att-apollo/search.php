<?php
/**
 * Search.php is used for your search result pages
 *
 * Learn more here: http://codex.wordpress.org/Creating_a_Search_Page
 *
 * @package WordPress Theme
 * @since 1.0
 */

get_header(); ?>
  
<div id="post" class="col span_9 clr">
    
    <header id="page-heading" class="clr">
        <h1 id="search-results-title"><?php _e('Search Results For','att'); ?>: <?php the_search_query(); ?></h1>
    </header><!-- #page-heading -->
    
    <?php 
	// Results found
	if ( have_posts() ) :
		$att_count=0;
        while ( have_posts() ) : the_post();
			$att_count++;
			get_template_part( 'content', get_post_format() );  
			if ( $att_count == 2 ) { $att_count = 0; }
        endwhile;
    	echo '<div class="clear"></div>';
    	att_pagination();
	 else :
	 // No results found
	 	echo '<div class="clr boxed"><h3>Sorry, no results</h3>' . __('Unfortunately your search turned up no results please try another search term.','att') . '</div>';
	 endif; ?>

</div><!-- #post -->
<?php
get_sidebar();
get_footer();