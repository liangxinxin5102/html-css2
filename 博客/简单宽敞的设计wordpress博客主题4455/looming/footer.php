
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
			<div class="footer-credits-inside">
				<div class="footer-credits-left">
					<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'looming' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'looming' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %1$s by %2$s.', 'looming' ), 'Photo Book', '<a href="http://wpmole.com/" rel="designer">WPMole</a>' ); ?>
				</div>
				
			</div>
		</div> <!-- footer-credits -->

	<?php wp_footer(); ?>
</body>
</html>
