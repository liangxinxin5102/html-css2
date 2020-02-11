<?php
$loom_settings = get_option( 'loom_options');

?>
<div id="sidebar">

	<div class="search-form">
		<form action="<?php echo home_url(); ?>/" method="get">
			<input type="text" value="Type search text and press enter..." name="s" id="ls" class="searchfield" onfocus="if (this.value == 'Type search text and press enter...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Type search text and press enter...';}" />
		</form>
	</div>

	<div class="sidebar-ads">
		<h2>Advertising</h2>
		<div class="sidebar-ads-wrap"><?php echo(stripslashes ($loom_settings['ad125_code'])); ?> </div>
	</div>


	<ul class="sidebar-content">
	<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(1) ) : else : ?>

        <li>
        <h2><?php _e('Categories', 'looming'); ?></h2>
            <ul>
            <?php wp_list_categories('sort_column=name&hierarchical=0'); ?>
            </ul>
        </li>
      	
        <li>
        <h2><?php _e('Archives', 'looming'); ?></h2>
            <ul>
            <?php wp_get_archives('type=monthly'); ?>
            </ul>
        </li>
        
        <li>
        <h2><?php _e('Links', 'looming'); ?></h2>
            <ul>
             <?php  get_bookmarks(); ?>
             </ul>
        </li>
        
	<?php endif; ?>
	</ul>

</div>
