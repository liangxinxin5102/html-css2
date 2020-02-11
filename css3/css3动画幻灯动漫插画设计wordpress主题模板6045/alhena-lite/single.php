<?php 

	get_header(); 
	do_action( 'alhenalite_header_content' );

?>

<!-- start content -->

<div class="container main-content page">

	<div class="row">
       
        <div <?php post_class(array('pin-article', alhenalite_template('span') , alhenalite_template('sidebar'))); ?> >
            
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
            
                do_action('alhenalite_postformat');
    
            ?>

            <?php wp_link_pages(array('before' => '<div class="wip-pagination">' . __('Pages:','wip'), 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>') ); ?>
            
            <div style="clear:both"></div>
            
        </div>

	<?php get_sidebar(); ?>

	<?php endwhile; get_template_part('pagination'); endif;?>
           
    </div>
    
</div>

<?php

	do_action( 'alhenalite_footer_content' ); 

	get_footer(); 

?>