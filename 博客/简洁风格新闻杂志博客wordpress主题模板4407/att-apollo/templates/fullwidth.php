<?php
/**
 * Template Name: Full-Width
 *
 * This file is used to create a page without a sidebar
 *
 * @package WordPress Theme
 * @since 1.0
 */

get_header();

if ( have_posts() ) :

	while (have_posts() ) : the_post(); ?>
	
    <div id="full-width-page" class="row clr boxed">
		<div id="page-heading">
		    <h1><?php the_title(); ?></h1>
		</div><!-- /page-heading -->
    
        <article class="entry clr">
            <?php the_content(); ?>
        </article><!-- /entry --> 
        <?php comments_template(); ?>
    </div><!-- /full-width-page -->
    
    <?php
    endwhile;
	
endif;

get_footer();
?>