<?php get_header(); ?>

<?php if ( have_posts() ) : ?>

<section id="slogan">
	<div class="container">
    	<div class="row">
        	<div class="span12">
				<?php if (is_tag()) : ?>

                    <p><?php _e( 'Tag','wip'); ?> : <strong> <?php echo get_query_var('tag');  ?> </strong> </p>
				
				<?php else : ?>
				
                    <p><?php _e( 'Category','wip'); ?> : <strong> <?php the_category(' '); ?> </strong> </p>

				<?php endif; ?>
            </div>
        </div>
    </div>
</section>
        
<div class="container main-content blog">
	<div class="row" id="blog" >
    
	<?php if ( ( alhenalite_template('sidebar') == "left-sidebar" ) || ( alhenalite_template('sidebar') == "right-sidebar" ) ) : ?>
        
        <div class="<?php echo alhenalite_template('span') .' '. alhenalite_template('sidebar'); ?>"> 
        <div class="row"> 
        
    <?php endif; ?>
        
		
		<?php while ( have_posts() ) : the_post(); ?>

        <div <?php post_class(array('pin-article', alhenalite_template('span') )); ?> >
    
				<?php do_action('alhenalite_postformat'); ?>
        
                <div style="clear:both"></div>
            
            </div>
		
		<?php endwhile; else:  ?>

        <div class="container">
            <div class="row" id="blog" >

                <div class="pin-article span12">
        
                    <article class="article">

                        <h1>Not found</h1>

                        <p><?php _e( 'Sorry, no posts matched your criteria',"wip" ) ?> </p>
         
                    </article>
        
                </div>
                
            </div>
        </div>
	
		<?php endif; ?>
        
	<?php if ( ( alhenalite_template('sidebar') == "left-sidebar" ) || ( alhenalite_template('sidebar') == "right-sidebar" ) ) : ?>
        
        </div>
        </div>
        
    <?php endif; ?>

	<?php if ( alhenalite_template('span') == "span8" ) :  ?>

    <!-- HOME WIDGET -->

    <section id="sidebar" class="pin-article span4">
    	<div class="sidebar-box">

			<?php if ( is_active_sidebar('category_sidebar_area') ) { 
            
				dynamic_sidebar('category_sidebar_area');
            
            } else { 
                
                the_widget( 'WP_Widget_Archives','',
				array('before_widget' => '<div class="widget-box">',
					  'after_widget'  => '</div>',
					  'before_title'  => '<header class="title"><div class="line"><h3>',
					  'after_title'   => '</h3></div></header>'
				));

                the_widget( 'WP_Widget_Calendar',
				array("title"=> __('Calendar','wip')),
				array('before_widget' => '<div class="widget-box">',
					  'after_widget'  => '</div>',
					  'before_title'  => '<header class="title"><div class="line"><h3>',
					  'after_title'   => '</h3></div></header>'
				));

                the_widget( 'WP_Widget_Categories','',
				array('before_widget' => '<div class="widget-box">',
					  'after_widget'  => '</div>',
					  'before_title'  => '<header class="title"><div class="line"><h3>',
					  'after_title'   => '</h3></div></header>'
				));
            
             } 
			 
			 ?>

            </div>
        </section>

	<!--  END HOME WIDGET -->

	<?php endif;?>
           
    </div>
</div>

<?php

	get_template_part('pagination');
	get_footer(); 

?>