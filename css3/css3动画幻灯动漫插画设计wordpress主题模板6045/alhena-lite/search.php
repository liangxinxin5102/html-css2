<?php get_header(); ?>

        <section id="slogan">
            <div class="container">
                <div class="row">
                    <div class="span12">
        
                        <h1><?php _e( '<span>Search </span> results for', 'wip' ) ?> <strong><?php echo $s; ?> </strong></h1>
                    
                    </div>
                </div>
            </div>
        </section>

		<?php if ( have_posts() ) :  ?>

		<?php while ( have_posts() ) : the_post(); ?>

        <div class="container main-content blog">
            <div class="row" id="blog" >

                <div class="pin-article span12">
        
                    <?php do_action('alhenalite_postformat'); ?>
            
                    <div style="clear:both"></div>
                
                </div>
                
			</div>
        </div>
        
		<?php endwhile; else:  ?>

        <div class="container main-content blog">
            <div class="row" id="blog" >

                <div class="pin-article span12">
        			<article class="article">

                    <header class="title">
                        <div class="line"><h1><?php _e( 'Not Found',"wip" ) ?></h1></div>
                    </header>
                        
					<p> <?php _e( 'You can repeat your search with the following form.',"wip" ) ?> </p>
                
                    <section class="contact-form searchform">
                        <form method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
                             <div>
                             <input type="text" placeholder="<?php _e( 'Search here', 'wip' ) ?>"  name="s" id="s" class="input-search"/>
                             <input type="submit" id="searchsubmit" class="button-search" value="<?php _e( 'Search', 'wip' ) ?>" />
                             </div>
                        </form>
                    <div class="clear"></div>  
                    </section>
                
                    </article>
                    
                    <div style="clear:both"></div>
                
                </div>
                
			</div>
        </div>

		<?php endif; ?>
           
    </div>
</div>

<?php
	
	get_template_part('pagination');
	get_footer(); 

?>