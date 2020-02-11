
<!-- begin aside -->
<aside class="sidebar">

    <?php
	if(is_page()){
	?>
		<!-- Page Widgets Area -->
		<?php if ( !function_exists('dynamic_sidebar') || dynamic_sidebar('Page') ) { ?>
		<?php } else { ?>
		<!-- This content shows up if there are no widgets defined in the backend. -->
			<p>
				Here you can add widgets.
				<?php if(current_user_can('edit_theme_options')) : ?><br>
				<a href="<?php echo admin_url('widgets.php')?>" class="add-widget">Add Widget</a>
				<?php endif ?>
			</p>
		<?php
		}
		?>
	
    <?php
	} else {
	?>
    <!-- End Page Widgets Area -->

	<!-- Sidebar Widgets Area -->
    <?php if ( !function_exists('dynamic_sidebar') || dynamic_sidebar('Sidebar') ) { ?>
	<?php } else { ?>
    <!-- This content shows up if there are no widgets defined in the backend. -->
        <p>
            Here you can add widgets.
            <?php if(current_user_can('edit_theme_options')) : ?><br>
            <a href="<?php echo admin_url('widgets.php')?>" class="add-widget">Add Widget</a>
            <?php endif ?>
        </p>
    
    <!-- END Sidebar Widgets Area -->
	<?php
	}
	?>
	<?php
		}
		?>
</aside>
<!-- end aside -->