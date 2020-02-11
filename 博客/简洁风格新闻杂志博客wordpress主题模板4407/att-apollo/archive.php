<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress Theme
 * @since 1.0
 */

get_header(); ?>

<div id="post" class="col span_9 clr">

	<header id="page-heading" class="clr">
		 <h1><?php echo single_term_title(); ?></h1>
			<?php if ( term_description() ) { ?>
				<div id="archive-description" class="clr"><?php echo term_description(); ?></div>
			<?php } ?>
	</header><!-- /page-heading -->
    
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