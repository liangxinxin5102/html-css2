<?php 
require( get_template_directory() . '/settings/fancier-options.php' );

  function fancier_get_option($Aoption_name, $default = null)
  {
    return stripslashes(get_option($Aoption_name, $default));
  };		   

function fancier_filter_wp_title( $title ) {
	global $page, $paged;
    $site_name = get_bloginfo( 'name' );
    $filtered_title = $site_name . $title;
      return $filtered_title;
	  $site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";
		if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'fancier' ), max( $paged, $page ) ); 
}
add_filter( 'wp_title', 'fancier_filter_wp_title' );


function fancier_theme_styles()  
{ 
	wp_register_style('custom-style', get_template_directory_uri() . '/css/comments.css');
	wp_enqueue_style('custom-style');
	
	wp_register_style('fancy_default_font', 'http://fonts.googleapis.com/css?family=Droid+Sans');
	wp_enqueue_style('fancy_default_font');

}
add_action('wp_enqueue_scripts', 'fancier_theme_styles');

	

  function fancier_template_setup() 
  {	
   if ( ! isset( $content_width ) ) 
        $content_width = 630;
	add_theme_support( 'automatic-feed-links' );	
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 225, 150, true ); 
	add_image_size('squareThumb', 220, 220, true);	
	add_editor_style( 'custom-editor-style.css' );	
	load_theme_textdomain('fancier', get_template_directory() . '/languages');
	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if (is_readable($locale_file ))
	  require_once($locale_file);	
	register_nav_menus
(
array( 
	'header-cats' => __( 'Header Categories', 'fancier' ),
)); 
   
  };
  add_action('after_setup_theme', 'fancier_template_setup');
   

function fancier_enqueue_comment_reply() {
  if ( is_singular() && get_option( 'thread_comments' ) )
	wp_enqueue_script( 'comment-reply' );
	};
add_action( 'wp_enqueue_scripts', 'fancier_enqueue_comment_reply' );


// Short Featured Title

function fancier_short_feat_title() {
 $title = get_the_title();
 $count = strlen($title);
 if ($count >= 14) {
 $title = substr($title, 0, 14);
 $title .= '...';
 }
 echo $title;
} 

 if ( ! function_exists( 'fancier_comment' ) ) :	
  function fancier_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 ); ?>			
			<?php printf( __( '%s', 'fancier' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'fancier' ); ?></em>
			<br />
		<?php endif; ?>

<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s', 'fancier'), get_comment_date('M j')) ?></a>

</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php sanitize_text_field(comment_text()); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'fancier' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'fancier' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
  };
  endif; 


// Standard Post Excerpt


function fancier_the_post_excerpt($excerpt_length='', $allowedtags='', $filter_type='none', $use_more_link=false, $more_link_text="Read More", $force_more_link=false, $fakeit=1, $fix_tags=true) {

	if (preg_match('%^content($|_rss)|^excerpt($|_rss)%', $filter_type)) {

		$filter_type = 'the_' . $filter_type;

	}

	$text = apply_filters($filter_type, fancier_get_the_post_excerpt($excerpt_length, $allowedtags, $use_more_link, $more_link_text, $force_more_link, $fakeit));

	$text = ($fix_tags) ? balanceTags($text) : $text;

	echo $text;

}

function fancier_get_the_post_excerpt($excerpt_length, $allowedtags, $use_more_link, $more_link_text, $force_more_link, $fakeit) {

	global $id, $post;

	$output = '';

	$output = $post->post_excerpt;

	if (!empty($post->post_password)) { 

		if ( post_password_required() ) {  
			$output = __('There is no excerpt because this is a protected post.', 'fancier');

			return $output;

		}

	}



	if ((($output == '') && ($fakeit == 1)) || ($fakeit == 2)) {

		$output = $post->post_content;

		$output = strip_tags($output, $allowedtags);

        $output = preg_replace( '|\[(.+?)\](.+?\[/\\1\])?|s', '', $output );

		$blah = explode(' ', $output);

		if (count($blah) > $excerpt_length) {

			$k = $excerpt_length;

			$use_dotdotdot = 1;

		} else {

			$k = count($blah);

			$use_dotdotdot = 0;

		}

		$excerpt = '';

		for ($i=0; $i<$k; $i++) {

			$excerpt .= $blah[$i] . ' ';

		}


		if (($use_more_link && $use_dotdotdot) || $force_more_link) {

			$excerpt .= "...&nbsp;<a href=\"". get_permalink() . "#more-$id\" class=\"more-link\">$more_link_text</a>";

		} else {

			$excerpt .= ($use_dotdotdot) ? '...' : '';

		}

		 $output = $excerpt;

	} 

	return $output;

}



// Sidebar Widget
function fancier_widget_init() {	
	register_sidebar(array('name'=>'Sidebar',
	'before_widget' => '<li id="%1$s" class="widget %2$s">',
	'after_widget' => '</li>',
	'before_title' => '<h6>',
	'after_title' => '</h6>',
	));
	
	register_sidebar(array('name'=>'Footer',
	'before_widget' => '<li id="%1$s" class="widget %2$s">',
	'after_widget' => '</li>',
	'before_title' => '<h6>',
	'after_title' => '</h6>',
	));
  } 	
add_action( 'widgets_init', 'fancier_widget_init' );


 
?>