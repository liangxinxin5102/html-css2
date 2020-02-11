<?php
/**
 * This file is used to display your author based archives
 *
 * Learn more here: http://codex.wordpress.org/Author_Templates
 *
 * @package WordPress Theme
 * @since 1.0
 */

get_header();
if ( have_posts() ) : the_post(); ?>
    
    <div id="post" class="col span_9 clr">  
        <header id="page-heading">
            <h1><?php _e('Articles Written By','att'); ?>: <?php echo get_the_author() ?></h1>
        </header><!-- #page-heading -->
		<?php
        rewind_posts();
        $att_count=0;
			while ( have_posts() ) : the_post();
				$att_count++;
				get_template_part( 'content', get_post_format() );  
				if ( $att_count == 2 ) { $att_count = 0; }
			endwhile;
        echo '<div class="clear"></div>';
        att_pagination(); ?>
	</div><!--#post -->

<?php
endif;
get_sidebar();
get_footer();