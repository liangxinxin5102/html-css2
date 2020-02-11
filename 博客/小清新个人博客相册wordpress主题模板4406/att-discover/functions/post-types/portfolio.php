<?php
if ( ! class_exists( 'ATT_Portfolio_Post_Type' ) ) :
class ATT_Portfolio_Post_Type {

	function __construct() {

		// Adds the portfolio post type and taxonomies
		add_action( 'init', array( &$this, 'portfolio_init' ), 0 );

		// Thumbnail support for portfolio posts
		add_theme_support( 'post-thumbnails', array( 'portfolio' ) );

		// Adds columns in the admin view for thumbnail and taxonomies
		add_filter( 'manage_edit-portfolio_columns', array( &$this, 'portfolio_edit_columns' ) );
		add_action( 'manage_posts_custom_column', array( &$this, 'portfolio_column_display' ), 10, 2 );

		// Allows filtering of posts by taxonomy in the admin view
		add_action( 'restrict_manage_posts', array( &$this, 'portfolio_add_taxonomy_filters' ) );

		// Show portfolio post counts in the dashboard
		add_action( 'right_now_content_table_end', array( &$this, 'add_portfolio_counts' ) );

		// Give the portfolio menu item a unique icon
		add_action( 'admin_head', array( &$this, 'portfolio_icon' ) );
	}
	

	function portfolio_init() {

		/**
		 * Enable the Portfolio custom post type
		 * http://codex.wordpress.org/Function_Reference/register_post_type
		 */

		$labels = array(
			'name' => __( 'Portfolio', 'att' ),
			'singular_name' => __( 'Portfolio Item', 'att' ),
			'add_new' => __( 'Add New Item', 'att' ),
			'add_new_item' => __( 'Add New Portfolio Item', 'att' ),
			'edit_item' => __( 'Edit Portfolio Item', 'att' ),
			'new_item' => __( 'Add New Portfolio Item', 'att' ),
			'view_item' => __( 'View Item', 'att' ),
			'search_items' => __( 'Search Portfolio', 'att' ),
			'not_found' => __( 'No portfolio items found', 'att' ),
			'not_found_in_trash' => __( 'No portfolio items found in trash', 'att' )
		);
		
		$args = array(
	    	'labels' => $labels,
	    	'public' => true,
			'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'comments', 'custom-fields', 'revisions' ),
			'capability_type' => 'post',
			'rewrite' => array("slug" => "portfolio"), // Permalinks format
			'has_archive' => true
		); 
		
		$args = apply_filters( 'att_portfolio_args', $args);
		
		register_post_type( 'portfolio', $args );

		/**
		 * Register a taxonomy for Portfolio Tags
		 * http://codex.wordpress.org/Function_Reference/register_taxonomy
		 */

		$taxonomy_portfolio_tag_labels = array(
			'name' => __( 'Portfolio Tags', 'att' ),
			'singular_name' => __( 'Portfolio Tag', 'att' ),
			'search_items' => __( 'Search Portfolio Tags', 'att' ),
			'popular_items' => __( 'Popular Portfolio Tags', 'att' ),
			'all_items' => __( 'All Portfolio Tags', 'att' ),
			'parent_item' => __( 'Parent Portfolio Tag', 'att' ),
			'parent_item_colon' => __( 'Parent Portfolio Tag:', 'att' ),
			'edit_item' => __( 'Edit Portfolio Tag', 'att' ),
			'update_item' => __( 'Update Portfolio Tag', 'att' ),
			'add_new_item' => __( 'Add New Portfolio Tag', 'att' ),
			'new_item_name' => __( 'New Portfolio Tag Name', 'att' ),
			'separate_items_with_commas' => __( 'Separate portfolio tags with commas', 'att' ),
			'add_or_remove_items' => __( 'Add or remove portfolio tags', 'att' ),
			'choose_from_most_used' => __( 'Choose from the most used portfolio tags', 'att' ),
			'menu_name' => __( 'Portfolio Tags', 'att' )
		);

		$taxonomy_portfolio_tag_args = array(
			'labels' => $taxonomy_portfolio_tag_labels,
			'public' => true,
			'show_in_nav_menus' => true,
			'show_ui' => true,
			'show_tagcloud' => true,
			'hierarchical' => false,
			'rewrite' => array( 'slug' => 'portfolio-tag' ),
			'query_var' => true
		);

		$taxonomy_portfolio_tag_args = apply_filters( 'att_taxonomy_portfolio_tag_args', $taxonomy_portfolio_tag_args);
		
		register_taxonomy( 'portfolio_tag', array( 'portfolio' ), $taxonomy_portfolio_tag_args );

		/**
		 * Register a taxonomy for Portfolio Categories
		 * http://codex.wordpress.org/Function_Reference/register_taxonomy
		 */

	    $taxonomy_portfolio_category_labels = array(
			'name' => __( 'Portfolio Categories', 'att' ),
			'singular_name' => __( 'Portfolio Category', 'att' ),
			'search_items' => __( 'Search Portfolio Categories', 'att' ),
			'popular_items' => __( 'Popular Portfolio Categories', 'att' ),
			'all_items' => __( 'All Portfolio Categories', 'att' ),
			'parent_item' => __( 'Parent Portfolio Category', 'att' ),
			'parent_item_colon' => __( 'Parent Portfolio Category:', 'att' ),
			'edit_item' => __( 'Edit Portfolio Category', 'att' ),
			'update_item' => __( 'Update Portfolio Category', 'att' ),
			'add_new_item' => __( 'Add New Portfolio Category', 'att' ),
			'new_item_name' => __( 'New Portfolio Category Name', 'att' ),
			'separate_items_with_commas' => __( 'Separate portfolio categories with commas', 'att' ),
			'add_or_remove_items' => __( 'Add or remove portfolio categories', 'att' ),
			'choose_from_most_used' => __( 'Choose from the most used portfolio categories', 'att' ),
			'menu_name' => __( 'Portfolio Categories', 'att' ),
	    );

	    $taxonomy_portfolio_category_args = array(
			'labels' => $taxonomy_portfolio_category_labels,
			'public' => true,
			'show_in_nav_menus' => true,
			'show_ui' => true,
			'show_tagcloud' => true,
			'hierarchical' => true,
			'rewrite' => array( 'slug' => 'portfolio-category' ),
			'query_var' => true
	    );

		$taxonomy_portfolio_category_args = apply_filters( 'att_taxonomy_portfolio_category_args', $taxonomy_portfolio_category_args);
		
	    register_taxonomy( 'portfolio_category', array( 'portfolio' ), $taxonomy_portfolio_category_args );

	}

	/**
	 * Add Columns to Portfolio Edit Screen
	 * http://wptheming.com/2010/07/column-edit-pages/
	 */

	function portfolio_edit_columns( $portfolio_columns ) {
		$portfolio_columns = array(
			"cb" => "<input type=\"checkbox\" />",
			"title" => __( 'Title', 'column name'),
			"portfolio_thumbnail" => __( 'Thumbnail', 'att' ),
			"portfolio_category" => __( 'Category', 'att' ),
			"portfolio_tag" => __( 'Tags', 'att' ),
			"author" => __( 'Author', 'att' ),
			"comments" => __( 'Comments', 'att' ),
			"date" => __( 'Date', 'att' ),
		);
		$portfolio_columns['comments'] = '<div class="vers"><img alt="Comments" src="' . esc_url( admin_url( 'images/comment-grey-bubble.png' ) ) . '" /></div>';
		return $portfolio_columns;
	}

	function portfolio_column_display( $portfolio_columns, $post_id ) {

		// Code from: http://wpengineer.com/display-post-thumbnail-post-page-overview

		switch ( $portfolio_columns ) {

			// Display the thumbnail in the column view
			case "portfolio_thumbnail":
				$width = (int) 80;
				$height = (int) 80;
				$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );

				// Display the featured image in the column view if possible
				if ( $thumbnail_id ) {
					$thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
				}
				if ( isset( $thumb ) ) {
					echo $thumb;
				} else {
					echo __( 'None', 'att' );
				}
				break;	

			// Display the portfolio tags in the column view
			case "portfolio_category":

			if ( $category_list = get_the_term_list( $post_id, 'portfolio_category', '', ', ', '' ) ) {
				echo $category_list;
			} else {
				echo __( 'None', 'att' );
			}
			break;	

			// Display the portfolio tags in the column view
			case "portfolio_tag":

			if ( $tag_list = get_the_term_list( $post_id, 'portfolio_tag', '', ', ', '' ) ) {
				echo $tag_list;
			} else {
				echo __( 'None', 'att' );
			}
			break;			
		}
	}

	/**
	 * Adds taxonomy filters to the portfolio admin page
	 * Code artfully lifed from http://pippinsplugins.com
	 */

	function portfolio_add_taxonomy_filters() {
		global $typenow;

		// An array of all the taxonomyies you want to display. Use the taxonomy name or slug
		$taxonomies = array( 'portfolio_category', 'portfolio_tag' );

		// must set this to the post type you want the filter(s) displayed on
		if ( $typenow == 'portfolio' ) {

			foreach ( $taxonomies as $tax_slug ) {
				$current_tax_slug = isset( $_GET[$tax_slug] ) ? $_GET[$tax_slug] : false;
				$tax_obj = get_taxonomy( $tax_slug );
				$tax_name = $tax_obj->labels->name;
				$terms = get_terms($tax_slug);
				if ( count( $terms ) > 0) {
					echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
					echo "<option value=''>$tax_name</option>";
					foreach ( $terms as $term ) {
						echo '<option value=' . $term->slug, $current_tax_slug == $term->slug ? ' selected="selected"' : '','>' . $term->name .' ( ' . $term->count .')</option>';
					}
					echo "</select>";
				}
			}
		}
	}

	/**
	 * Add Portfolio count to "Right Now" Dashboard Widget
	 */

	function add_portfolio_counts() {
	        if ( ! post_type_exists( 'portfolio' ) ) {
	             return;
	        }

	        $num_posts = wp_count_posts( 'portfolio' );
	        $num = number_format_i18n( $num_posts->publish );
	        $text = _n( 'Portfolio Item', 'Portfolio Items', intval($num_posts->publish) );
	        if ( current_user_can( 'edit_posts' ) ) {
	            $num = "<a href='edit.php?post_type=portfolio'>$num</a>";
	            $text = "<a href='edit.php?post_type=portfolio'>$text</a>";
	        }
	        echo '<td class="first b b-portfolio">' . $num . '</td>';
	        echo '<td class="t portfolio">' . $text . '</td>';
	        echo '</tr>';

	        if ($num_posts->pending > 0) {
	            $num = number_format_i18n( $num_posts->pending );
	            $text = _n( 'Portfolio Item Pending', 'Portfolio Items Pending', intval($num_posts->pending) );
	            if ( current_user_can( 'edit_posts' ) ) {
	                $num = "<a href='edit.php?post_status=pending&post_type=portfolio'>$num</a>";
	                $text = "<a href='edit.php?post_status=pending&post_type=portfolio'>$text</a>";
	            }
	            echo '<td class="first b b-portfolio">' . $num . '</td>';
	            echo '<td class="t portfolio">' . $text . '</td>';

	            echo '</tr>';
	        }
	}

	/**
	 * Displays the custom post type icon in the dashboard
	 */

	function portfolio_icon() { ?>
	    <style type="text/css" media="screen">
	        #menu-posts-portfolio .wp-menu-image {
	            background: url(<?php echo get_template_directory_uri(). '/images/post-types/portfolio-icon.png'; ?>) no-repeat 6px 6px !important;
	        }
			#menu-posts-portfolio:hover .wp-menu-image, #menu-posts-portfolio.wp-has-current-submenu .wp-menu-image {
	            background-position: 6px -16px !important;
	        }
	    </style>
	<?php }

}

new ATT_Portfolio_Post_Type;

endif;