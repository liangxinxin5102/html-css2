<?php
/**
 * Index.php is the default template. This file is used when a more specific template can not be found to display your posts.
 *
 * @package WordPress Theme
 * @since 1.0
 */

get_header(); ?>
    
<div id="post" class="col span_9 clr">
    <?php
    if ( have_posts( )) :
	$att_count=0;
        while ( have_posts() ) : the_post();
			$att_count++;
			get_template_part( 'content', get_post_format() );  
			if ( $att_count == 2 ) { $att_count = 0; }
        endwhile;
    endif;
    echo '<div class="clear"></div>';
    att_pagination(); ?>
</div><!-- .span_8 -->
 
<?php
get_sidebar();
get_footer();
?>