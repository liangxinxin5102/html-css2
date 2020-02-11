<?php $shortname = "design_studio"; ?>
<div class="footer_copyright_cont">
<div class="footer_copyright">
	<div class="container">
		<?php echo stripslashes(stripslashes(get_option($shortname.'_copyright_text',''))); ?>
		<div class="clear"></div>
	</div><!--//container-->
</div><!--//footer_copyright-->
</div><!--//footer_copyright_cont-->
<?php wp_footer(); ?>
</body>
</html>