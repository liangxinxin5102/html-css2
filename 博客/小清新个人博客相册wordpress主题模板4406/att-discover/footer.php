<?php
/**
 * The template for displaying the footer.
 *
 * @package WordPress
 * @subpackage Authentic Themes
 * @since 1.0
 */
?>

    <div class="clear"></div>
    </div><!-- #main-content -->
    
    </div><!-- #wrap -->

    <div id="footer-wrap">
        <footer id="footer" class="container">
            <div id="footer-widgets" class="clr site-footer">
                <div class="footer-box">
                    <?php dynamic_sidebar( 'footer-one' ); ?>
                </div><!-- .footer-box -->
                <div class="footer-box">
                    <?php dynamic_sidebar( 'footer-two' ); ?>
                </div><!-- .footer-box -->
                <div class="footer-box">
                    <?php dynamic_sidebar( 'footer-three' ); ?>
                </div><!-- .footer-box -->
                <div class="footer-box remove-margin">
                    <?php dynamic_sidebar( 'footer-four' ); ?>
                </div><!-- .footer-box -->
            </div><!-- #footer-widgets -->
        </footer><!-- #footer -->
    </div><!-- #footer-wrap -->
    
    <?php att_hook_site_after(); ?>

<?php wp_footer(); ?>
</body>
</html>