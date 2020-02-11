<?php 

/**
 * Wp in Progress
 * 
 * @author WPinProgress
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * It is also available at this URL: http://www.gnu.org/licenses/gpl-3.0.txt
 */

alhenalite_thumbnail('blog','pin-container'); ?>
    
<article class="article">

	<?php alhenalite_get_title(); ?>    
    
    <div class="entry-info">
       
         <span class="entry-date"><i class="icon-time" ></i><a href="<?php echo get_permalink($post->ID); ?>"><?php echo get_the_date(); ?></a></span>
      
         <?php if (alhenalite_setting('wip_view_comments') == "on" ): ?>
         
             <span class="entry-comments"><i class="icon-comments-alt" ></i> <?php echo comments_number( '<a href="'.get_permalink($post->ID).'#respond">'.__( "No comments","wip").'</a>', '<a href="'.get_permalink($post->ID).'#comments">1 '.__( "comment","wip").'</a>', '<a href="'.get_permalink($post->ID).'#comments">% '.__( "comments","wip").'</a>' ); ?> 
             </span>
            
        <?php endif; ?>
        
        <span class="entry-standard"><i class="icon-quote-left"></i> <?php _e( "Quote","wip"); ?> </span>
        
    </div>

	<?php do_action('alhenalite_after_content'); ?>

</article>