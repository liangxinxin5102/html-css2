<?php 

/**
 * Wp in Progress
 * 
 * @author WPinProgress
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * It is also available at this URL: http://www.gnu.org/licenses/gpl-3.0.txt
 */

function alhenalite_footer_content_function() { 

	if ( is_active_sidebar('footer_sidebar_area')) : ?>
    
    <!-- FOOTER WIDGET -->

    <section id="footer-box" >
        <div class="container">
            <div class="row">

			<?php dynamic_sidebar('footer_sidebar_area'); ?>

            </div>
        </div>
    </section>

	<!--  END FOOTER WIDGET -->

<?php
	
	endif;

} 

add_action( 'alhenalite_footer_content', 'alhenalite_footer_content_function', 10, 2 );

?>