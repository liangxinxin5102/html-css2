<div id="subhead" class="container_12 cf">
	<?php
	if(is_home()){
	
		$welcome_title = ft_of_get_option('fabthemes_welcome_title');
		$welcome_text =  ft_of_get_option ('fabthemes_welcome_text');
		
		echo'<div class="welcome"> <h2> '.$welcome_title.' </h2> ';
		echo'<p> '.$welcome_text.'  </p>';
		echo'</div>';
		
	} elseif( is_single() ) {
		
		echo'<div class="pagehead"> ';
		echo'<h2 class="pagetitle"> Our Blog </h2>';
		echo'<p>Articles from our blog</p>';
		echo'</div>';
	} elseif( is_page() ) {
	
		$headtitle = get_the_title($ID);
		echo'<div class="pagehead"> ';
		echo'<h2 class="pagetitle"> '.$headtitle.'</h2>';
		echo'<p>';
		$pdes = get_post_meta( get_the_ID(), 'metabox_page_description', true );
// check if the custom field has a value
if( ! empty( $pdes ) ) {
  echo $pdes;
} 
		echo'</p></div>';

	} elseif( is_archive() ) {
	
		echo'<div class="pagehead"> ';	
		
		if ( is_category() ) {
			printf( __( '<h2 class="pagetitle"> Category Archives: %s </h2>', 'fabthemes' ), '<span>' . single_cat_title( '', false ) . '</span>' );
	
		} elseif ( is_tag() ) {
			printf( __( '<h2 class="pagetitle">Tag Archives: %s </h2>', 'fabthemes' ), '<span>' . single_tag_title( '', false ) . '</span>' );
	
		} elseif ( is_author() ) {
			/* Queue the first post, that way we know
			 * what author we're dealing with (if that is the case).
			*/
			the_post();
			printf( __( ' <h2 class="pagetitle">%s</h2>', 'fabthemes' ), '<span class="vcard"><a class="url fn n" href="' . get_author_posts_url( get_the_author_meta( "ID" ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
			echo' <p>Author Archives</p>';
			/* Since we called the_post() above, we need to
			 * rewind the loop back to the beginning that way
			 * we can run the loop properly, in full.
			 */
			rewind_posts();
	
		} elseif ( is_day() ) {
			printf( __( '<h2 class="pagetitle">%s</h2>', 'fabthemes' ), '<span>' . get_the_date() . '</span>' );
			echo' <p>Daily Archives</p>';
	
		} elseif ( is_month() ) {
			printf( __( '<h2 class="pagetitle">%s</h2>', 'fabthemes' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );
			echo' <p>Monthly Archives</p>';
	
		} elseif ( is_year() ) {
			printf( __( '<h2 class="pagetitle">%s</h2>', 'fabthemes' ), '<span>' . get_the_date( 'Y' ) . '</span>' );
			echo' <p>Yearly Archives</p>';
	
		} else {
			echo'<h2 class="pagetitle">';
			_e( 'Archives', 'fabthemes' );
			echo'</h2>';
	
		}
	
	 
	 	 if ( is_category() ) {
		// show an optional category description
		$category_description = category_description();
		if ( ! empty( $category_description ) )
			echo apply_filters( 'category_archive_meta', ' '. $category_description .'' );

	  } elseif ( is_tag() ) {
		// show an optional tag description
		$tag_description = tag_description();
		if ( ! empty( $tag_description ) )
			echo apply_filters( 'tag_archive_meta', ' '. $tag_description .'' );
	  }
     
	 echo'</div>';
	 
	} elseif( is_search() ) {
	
		$mySearch =& new WP_Query("s=$s & showposts=-1");
		$NumResults = $mySearch->post_count;

		echo'<div class="pagehead"> ';
		echo'<h2 class="pagetitle">';
		printf( __( 'Search Results for: %s', 'fabthemes' ), '<span>' . get_search_query() . '</span>' ); 
		echo'</h2>';
		echo'<p> '.$NumResults .' results found.</p>';
		echo'</div>';
		
	} elseif( is_404() ) {	
	
		echo'<div class="pagehead"> ';
		echo'<h2 class="pagetitle"> 404 error returned! </h2>';
		echo'<p>Page not found</p>';
		echo'</div>';
	
	} else{
		
	} ?>
	
</div>