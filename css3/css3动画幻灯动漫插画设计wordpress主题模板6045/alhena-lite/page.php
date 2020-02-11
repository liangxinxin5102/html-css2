<?php 

	get_header(); 
	do_action( 'alhenalite_header_content' );

	if ( (alhenalite_postmeta('wip_content') == "on") || (!alhenalite_postmeta('wip_content') )): 
	
?>

<!-- START CONTENT -->

    <div class="container main-content page">
    
        <div class="row" >
        
        <div <?php post_class(array('pin-article', alhenalite_template('span'), alhenalite_template('sidebar'))); ?> >
            
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
               
				<?php do_action('alhenalite_postformat'); ?> 
        
				<?php wp_link_pages(array('before' => '<div class="wip-pagination">' . __('Pages:','wip'), 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>') ); ?>
        
            <?php endwhile; endif;?>
        
        </div>
        
            <?php get_sidebar(); ?>
    
        </div>
    
    </div>

<!-- END CONTENT -->

<?php 
	
	endif; 
	
	do_action( 'alhenalite_footer_content' ); 

	get_footer(); 

?>