
	</div> <!-- content -->
</div>
		<div id="footer">

		<div class="footer-inside">

			<div class="wrap">
		<div class="widgets_area">
			 <?php dynamic_sidebar( 'Footer' ); ?>
		</div>

		</div> <!-- footer-inside -->

		</div> <!-- footer -->

		<div id="footer-credits">
		
				
					<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'greenpage' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'greenpage' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %1$s by %2$s.', 'greenpage' ), 'GreenPage', '<a href="http://wpmole.com/" rel="designer">WPMole</a>' ); ?>		
				
		
		</div> <!-- footer-credits -->

	<?php wp_footer(); ?>
</body>
</html>
