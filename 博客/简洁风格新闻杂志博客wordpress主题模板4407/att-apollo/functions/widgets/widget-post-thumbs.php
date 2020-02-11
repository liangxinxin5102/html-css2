<?php
/**
 * Recent Posts Widget used for regular posts and portfolio posts
 * @package WordPress Theme
 * @since 1.0
 * @author Authentic Themes : http://www.authenticthemes.com
 */
 
class att_recent_posts_thumb_widget extends WP_Widget {
    /** constructor */
    function att_recent_posts_thumb_widget() {
        parent::WP_Widget(false, $name = __('ATT - Featured Posts','att') );
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
		$category = apply_filters('widget_title', $instance['category']);
        $number = apply_filters('widget_title', $instance['number']);
        $offset = apply_filters('widget_title', $instance['offset']); ?>
              <?php echo $before_widget; ?>
                  <?php if ( $title )
                        echo $before_title . $title . $after_title; ?>
							<div class="att-widget-recent-posts blog">
							<?php
								global $post;
								$tmp_post = $post;
								$args = array(
									'numberposts' => $number,
									'offset'=> $offset,
									'category' => $category
								);
								$myposts = get_posts( $args );
								foreach( $myposts as $post ) : setup_postdata($post);
								if( has_post_thumbnail() ) {  ?>
									<article class="clr">
										<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="title">
                                        	<img src="<?php echo aq_resize( wp_get_attachment_url( get_post_thumbnail_id() ), att_img('blog_entry_width'), att_img('blog_entry_height'), true ); ?>" alt="<?php the_title(); ?>" />
                                        </a>
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="att-recent-posts-title"><?php the_title(); ?></a>
                                        <div class="att-recent-posts-date"><?php echo get_the_date(); ?></div>
                                    </article>
                               <?php
                               } endforeach;
							   $post = $tmp_post; ?>
							</div>
              <?php echo $after_widget; ?>
        <?php
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
	$instance['category'] = strip_tags($new_instance['category']);
	$instance['number'] = strip_tags($new_instance['number']);
	$instance['offset'] = strip_tags($new_instance['offset']);
        return $instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {	
	    $instance = wp_parse_args( (array) $instance, array(
			'title' => __('Featured Posts','att'),
			'category' => '',
			'number' => '5',
			'offset'=> '0'
		));					
        $title = esc_attr($instance['title']);
		$category = esc_attr($instance['category']);
        $number = esc_attr($instance['number']);
        $offset = esc_attr($instance['offset']); ?>
         <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'att'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title','att'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Select a Category:', 'att'); ?></label>
            <br />
            <select class='att-select' name="<?php echo $this->get_field_name('category'); ?>" id="<?php echo $this->get_field_id('category'); ?>">
            <option value="all-cats" <?php if($category == 'all-cats') { ?>selected="selected"<?php } ?>><?php _e('All', 'att'); ?></option>
            <?php
            //get terms
            $cat_terms = get_terms('category', array( 'hide_empty' => '1' ) );
            foreach ( $cat_terms as $cat_term) { ?>
                <option value="<?php echo $cat_term->term_id; ?>" id="<?php echo $cat_term->term_id; ?>" <?php if($category == $cat_term->term_id) { ?>selected="selected"<?php } ?>><?php echo $cat_term->name; ?></option>
            <?php } ?>
            </select>
        </p>
        
		<p>
          <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number to Show:', 'att'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" />
        </p>
		<p>
          <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Offset (the number of posts to skip):', 'att'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('offset'); ?>" name="<?php echo $this->get_field_name('offset'); ?>" type="text" value="<?php echo $offset; ?>" />
        </p>
        <?php
    }


} // class att_recent_posts_thumb_widget
// register Recent Posts widget
add_action('widgets_init', create_function('', 'return register_widget("att_recent_posts_thumb_widget");'));	