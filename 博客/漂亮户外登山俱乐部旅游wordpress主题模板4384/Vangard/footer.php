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

	
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container_12">
		<div class="site-info wrap grid_12">
			<div class="fcred">
				Copyright &copy; <?php echo date('Y');?> <a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a> - <?php bloginfo('description'); ?>.<br />
				<?php fflink(); ?> | <a href="http://topwpthemes.com/<?php echo wp_get_theme(); ?>/" ><?php echo wp_get_theme(); ?> Theme</a> 	
			</div>		

		</div><!-- .site-info -->
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>