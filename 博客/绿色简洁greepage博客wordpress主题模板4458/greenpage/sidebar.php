<?php
$greenpage_settings = get_option( 'greenpage_options');

?>
<div id="sidebar">
   <div class="widget-area">

	<ul class="sidebar-content">
	<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(1) ) : else : ?>

        <li>
        <h2><?php _e('Categories', 'greenpage'); ?></h2>
            <ul>
            <?php wp_list_categories('sort_column=name&hierarchical=0'); ?>
            </ul>
        </li>
      	
        <li>
        <h2><?php _e('Archives', 'greenpage'); ?></h2>
            <ul>
            <?php wp_get_archives('type=monthly'); ?>
            </ul>
        </li>
        
        <li>
        <h2><?php _e('Links', 'greenpage'); ?></h2>
            <ul>
             <?php  get_bookmarks(); ?>
             </ul>
        </li>
        
	<?php endif; ?>
	</ul>

</div>
</div>