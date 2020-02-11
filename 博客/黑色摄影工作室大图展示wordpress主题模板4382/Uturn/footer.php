<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package web2feel
 */
?>

	</div><!-- #content -->
	<div id="bottom">
		<div class="clearfix">
			
			
			<?php if ( !function_exists('dynamic_sidebar')
			        || !dynamic_sidebar("Footer") ) : ?>  
			<?php endif; ?>
			
			
			
		</div>
	</div>

	<footer id="colophon" class="site-footer container_12" role="contentinfo">
		<div class="site-info">
			<div class="fcred">
				Copyright &copy; <?php echo date('Y');?> <a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a> - <?php bloginfo('description'); ?>.<br />
				<?php fflink(); ?> | <a href="http://topwpthemes.com/<?php echo wp_get_theme(); ?>/" ><?php echo wp_get_theme(); ?> Theme</a> 	
			</div>		
		</div><!-- .site-info -->
	</footer><!-- #colophon .site-footer -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>