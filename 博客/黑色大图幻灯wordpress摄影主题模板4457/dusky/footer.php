
	</div> <!-- content -->

		<div id="footer">



			<div class="wrap">
			
		<div class="widgets_area">
			 <?php dynamic_sidebar( 'Footer' ); ?>
		</div>

		</div> <!-- wrap -->

		<div id="footer-credits">					
					<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'dusky' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'dusky' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %1$s by %2$s.', 'dusky' ), 'Photo Book', '<a href="http://wpmole.com/" rel="designer">WPMole</a>' ); ?>
			
						
		</div> <!-- footer -->

	<?php wp_footer(); ?>
</body>
</html>
