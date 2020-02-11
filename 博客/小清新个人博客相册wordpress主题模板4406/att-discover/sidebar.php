<?php
/**
 * The sidebar containing the main widget area.
 *
 * If no active widgets in this sidebar, it will be hidden completely.
 *
 * @package WordPress
 * @subpackage Authentic Themes
 * @since 1.0
 */
?>

<?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
    <aside id="secondary" class="sidebar-container col span_7" role="complementary">
        <div class="sidebar-inner">
			<div class="widget-area">
				<?php dynamic_sidebar( 'sidebar' ); ?>
			</div>
		</div>
    </aside><!-- /sidebar -->
<?php endif; ?>