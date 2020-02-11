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
	
	<div class="footer-widget-section">
		<div class="container"><div class="row">
			<?php if ( !function_exists('dynamic_sidebar')
			        || !dynamic_sidebar("Footer") ) : ?>  
			<?php endif; ?>
		</div></div>
	</div>

	<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="container"><div class="row"> 
		<div class="col-md-8">
			<div class="site-info">
				Copyright &copy; <?php echo date('Y');?> <a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a> - <?php bloginfo('description'); ?>.<br />
				<?php fflink(); ?> | <a href="http://topwpthemes.com/<?php echo wp_get_theme(); ?>/" ><?php echo wp_get_theme(); ?> Theme</a> </div><!-- .site-info -->
		</div>
		
		<div class="col-md-4">
			 <a href="#" class="go-top glyphicon glyphicon-circle-arrow-up"></a> 
		</div>
	</div></div>
	</footer><!-- #colophon -->
</div><!-- #page -->


<?php wp_footer(); ?>
<script type="text/javascript">

	jQuery(".subhead").backstretch("<?php echo of_get_option('w2f_header','');?>");

</script>
</body>
</html>