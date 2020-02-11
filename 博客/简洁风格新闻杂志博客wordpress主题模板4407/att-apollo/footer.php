<?php
/**
 * Footer.php outputs the code for footer hooks and closing body/html tags
 * @package WordPress Theme
 * @since 1.0
 * @author Authentic Themes : http://www.authenticthemes.com (TM)
 * @link http://www.authenticthemes.com
 */
?>
	
        </div><!-- #main-content -->
    </div><!-- #box-wrap -->
    
    
        
    <div id="footer-wrap">
        <footer id="footer" class="span_12 container row clr">
            <div id="footer-widgets" class="row clr">
                <div class="footer-box col span_4 clr">
                    <?php dynamic_sidebar('footer-one'); ?>
                </div><!-- /footer-box -->
                <div class="footer-box col span_4 clr">
                    <?php dynamic_sidebar('footer-two'); ?>
                </div><!-- /footer-box -->
                <div class="footer-box col span_4 clr">
                    <?php dynamic_sidebar('footer-three'); ?>
                </div><!-- /footer-box -->
            </div><!-- /footer-widgets -->
        </footer><!-- /footer -->
    </div><!-- /footer-wrap -->	
    
    
    <div id="footerbottom-wrap">
        <div id="footerbottom" class="container row clr">   
            <div id="copyright" class="col span_6 clr">
                <?php if ( att_option('custom_copyright','') !== '' ) {
                    echo do_shortcode( att_option('custom_copyright','') ); 
                } else { ?>
                <p>
                    <?php _e('Apollo','att'); ?> <a href="http://wordpress.org" title="WordPress"><?php _e('WordPress','att'); ?></a> <?php _e('Theme Designed &amp; Developed by','att'); ?>
                    <a href="http://authenticthemes.com" title="Authentic Themes">Authentic Themes</a>
                </p>
                <?php } ?>
            </div><!-- #copyright -->        
            <div id="footer-menu" class="col span_6 clr">
                <?php
                // Main navigation location
                wp_nav_menu( array( 'theme_location' => 'footer_menu', 'fallback_cb' => false ) ); ?>
            </div><!-- #footer-menu -->               
        </div><!-- #footerbottom -->
    </div><!-- #footerbottom-wrap -->

<?php att_hook_site_after(); ?>

<?php wp_footer(); ?>
</body>
</html>