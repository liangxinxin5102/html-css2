<?php
/**
 * The Template for displaying your image attachments
 *
 * @package WordPress
 * @subpackage Authentic Themes
 * @since 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area container clr">
		<div id="content" class="site-content" role="main">

            <div id="page-header-wrap">
                <header id="page-header" class="grid-1">
                    <h1><?php the_title(); ?></h1>
                </header><!-- #page-header -->
            </div><!-- #page-header -->
            
            <div id="img-attch-page" class="grid-1">
                <a href="<?php echo wp_get_attachment_url($post->ID, 'full-size' ); ?>" class="prettyphoto-link"><?php $portimg = wp_get_attachment_image( $post->ID, 'full' ); echo preg_replace( '#(width|height)="\d+"#','',$portimg);?></a>
                <div id="img-attach-page-content">
                    <?php the_content(); ?>
                </div><!-- #img-attach-page-content -->
            </div><!-- #img-attch-page -->

    	</div><!-- #content -->
	</div><!-- #primary -->
    
<?php get_footer(); ?>