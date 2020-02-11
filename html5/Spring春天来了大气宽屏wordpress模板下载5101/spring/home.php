<?php
if(isset($_POST['submitted'])) {
		//Check to make sure that the name field is not empty
		if(trim($_POST['contactName']) === '') {
			$nameError = __("You forgot to enter your name.", "site5framework");
			$hasError = true;
		} else {
			$name = trim($_POST['contactName']);
		}

		//Check to make sure sure that a valid email address is submitted
		if(trim($_POST['email']) === '')  {
			$emailError = __("You forgot to enter your email address.", "site5framework");
			$hasError = true;
		} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
			$emailError = __("You entered an invalid email address.", "site5framework");
			$hasError = true;
		} else {
			$email = trim($_POST['email']);
		}

		//Check to make sure comments were entered
		if(trim($_POST['comments']) === '') {
			$commentError = __("You forgot to enter your comments.", "site5framework");
			$hasError = true;
		} else {
			if(function_exists('stripslashes')) {
				$comments = stripslashes(trim($_POST['comments']));
			} else {
				$comments = trim($_POST['comments']);
			}
		}

		//If there is no error, send the email
		if(!isset($hasError)) {
			$msg .= "------------User Info------------ \r\n"; //Title
			$msg .= "User IP : ".$_SERVER["REMOTE_ADDR"]."\r\n"; //Sender's IP
			$msg .= "Browser Info : ".$_SERVER["HTTP_USER_AGENT"]."\r\n"; //User agent
			$msg .= "User Come From : ".$_SERVER["HTTP_REFERER"]; //Referrer

			$emailTo = ''.of_get_option('contact_email').'';
			$subject = 'Contact Form Submission From '.$name;
			$body = "Name: $name \n\nEmail: $email \n\nMessage: $comments \n\n $msg";
			$headers = 'From: '.get_bloginfo('name').' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

			if(mail($emailTo, $subject, $body, $headers)) $emailSent = true;

	}

}

get_header(); ?>


		<?php if ( is_home() ) { ?>
		<!-- begin homepage -->
		<section id="homepage" class="bg" data-stellar-background-ratio="0.5" style="background-color: <?php echo of_get_option('homepagebgcolor')  ?>; background-image: url('<?php echo of_get_option('homepagebg')  ?>')">

				<!-- begin .homesummary -->
				<div class="homesummary">
					<div class="homecontent">
						<h2><?php echo of_get_option('hometitle')  ?></h2>
						<p><?php echo of_get_option('homesummary')  ?></p>
						<a href="<?php echo of_get_option('homebuttonurl')  ?>" title="<?php echo of_get_option('homebuttontitle')  ?>" class="homebutton"><?php echo of_get_option('homebuttontitle')  ?></a>
					</div>
				</div>
				<!-- end .homesummary -->

		</section>
		<!-- end homepage -->
		<?php } ?>

		<!-- begin about -->
		<section id="about" class="bg" data-stellar-background-ratio="0.5" style="background-color: <?php echo of_get_option('aboutbgcolor')  ?>; background-image; url('<?php echo of_get_option('aboutbg')  ?>')">

			<div class="container">

				<?php
				$the_query = new WP_Query( 'page_id='.of_get_option('aboutpage').'' );
				while ( $the_query->have_posts() ) : $the_query->the_post();
				?>
				<!-- begin .summary -->
				<div class="summary">
					<div class="content">
						<h2><?php the_title() ?></h2>
						<?php the_content(); ?>
					</div>
				</div>
				<!-- end .summary -->

				<?php endwhile; wp_reset_postdata();?>


				<div id="feature" class="">

					<?php
					$the_query = new WP_Query( 'post_type=feature' );
					while ( $the_query->have_posts() ) : $the_query->the_post();
					$f_icon = get_post_meta($post->ID,'spring_f_icon',true);
					$f_icon_color = get_post_meta($post->ID,'spring_f_icon_color',true);
					?>

					<div class="feature col3">
						<span class="featureicon"><i class="<?php echo $f_icon ?>" style="color:<?php echo $f_icon_color ?>"></i></span>
						<h4><?php the_title()  ?></h4>
						<?php the_excerpt(); ?>
					</div>

					<?php endwhile; wp_reset_postdata();?>

				</div>

			</div><!-- .container -->

		</section>
		<!-- end about -->


		<?php
		$the_query = new WP_Query( 'page_id='.of_get_option('portfoliopage').'' );
		while ( $the_query->have_posts() ) : $the_query->the_post();
		?>

		<!-- begin portfolio -->
		<section id="portfolio" class="bg" data-stellar-background-ratio="0.5" style="background-color: <?php echo of_get_option('portfoliobgcolor')  ?>; background-image: url('<?php echo of_get_option('portfoliobg')  ?>')">


				<!-- begin .summary -->
				<div class="summary">
					<div class="content">
						<h2><?php the_title()  ?></h2>
						<?php the_content(); ?>
					</div>
				</div>
				<!-- end .summary -->



		<?php endwhile; wp_reset_postdata();?>


			<!-- gallery categories -->
			<ul id="gallerycat" class="filterable clearfix" data-option-key="filter">
				<li class="active"><a href="javascript:void(0)" data-value="all" data-type="all" class="all" data-option-value="*"><?php _e('all', 'site5framework'); ?></a></li>
				<?php $categories = get_categories('taxonomy=workcat&title_li='); foreach ($categories as $category){ ?>
				<li><a href="<?php echo get_term_link($category->slug, 'workcat') ?>" class="<?php echo $category->category_nicename;?>" data-type="<?php echo $category->category_nicename;?>" data-option-value=".<?php echo $category->category_nicename;?>"><?php echo $category->name;?></a></li>
				<?php }?>
			</ul>
			<!-- end gallery categories -->

			<div id="gallery">

				<ul class="gallery clearfix">
				<?php
					global $post;
								$term = get_query_var('term');
								$tax = get_query_var('taxonomy');
								$args=array('post_type'=> 'work','post_status'=> 'publish', 'orderby'=> 'menu_order', 'caller_get_posts'=>1, 'paged'=>$paged, 'posts_per_page'=>9);
								$taxargs = array($tax=>$term);
								if($term!='' && $tax!='') { $args  = array_merge($args, $taxargs); }


					query_posts($args);
				?>

				<?php if (have_posts()) : $count = 0; ?>
				<?php while (have_posts()) : the_post(); $count++; global $post; $taxo = wp_get_object_terms( get_the_ID(), 'workcat');?>

					<!-- gallery item -->

					<li data-type="<?php foreach ($taxo as $taxx) { echo strtolower(preg_replace('/\s+/', '-', $taxx->slug)). ' '; } ?>" data-id="id-<?php the_ID(); ?>" class="view <?php foreach ($taxo as $taxx) { echo strtolower(preg_replace('/\s+/', '-', $taxx->slug)). ' '; } ?>">
						<?php
							$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'portfolio-item-small','portfolio-item-small' );
							$large = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large', false);
							if(has_post_thumbnail()): echo '<img src="'.$thumbnail[0].'" alt="'.get_the_title().'"/>'; else: ?><img src="<?php bloginfo('template_url'); ?>/images/gallery_sample.jpg" alt="portfolio" />

						<?php endif; ?>
						<div class="mask">
							<h4><?php the_title(); ?></h4>
							<a class="info" href="<?php echo $large[0] ?>" data-rel="prettyPhoto"><?php _e('+','site5framework') ?></a>
						</div>
					</li>

					<!-- end gallery item -->

				<?php endwhile; endif; wp_reset_postdata();?>
				</ul>

			</div>


		</section>
		<!-- end portfolio -->


		<?php
		$the_query = new WP_Query( 'page_id='.of_get_option('teampage').'' );
		while ( $the_query->have_posts() ) : $the_query->the_post();
		?>

		<!-- begin team -->
		<section id="team" class="bg" data-stellar-background-ratio="0.5" style="background-color: <?php echo of_get_option('teambgcolor')  ?>; background-image: url('<?php echo of_get_option('teambg')  ?>')">



				<!-- begin .summary -->
				<div class="summary">
					<div class="content">
						<h2><?php the_title()  ?></h2>
						<?php the_content(); ?>
					</div>
				</div>
				<!-- end .summary -->

				<?php endwhile; wp_reset_postdata();?>

				<div class="ourteam">

					<?php
					$the_query = new WP_Query( 'post_type=team&posts_per_page=4 ');
					while ( $the_query->have_posts() ) : $the_query->the_post();
					$t_title = get_post_meta($post->ID,'spring_t_title',true);
					$f_icon = get_post_meta($post->ID,'spring_f_icon',true);
					$t_icon = get_post_meta($post->ID,'spring_t_icon',true);
					?>

					<div class="teamgrid">

						<figure class="teaminfo teaminfo-push-up">

							<?php
							$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'team-item-small','team-item-small' );
							$large = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large', false);
							if(has_post_thumbnail()): echo '<img src="'.$thumbnail[0].'" alt="'.get_the_title().'"/>'; else: ?><img src="<?php bloginfo('template_url'); ?>/images/team_sample.jpg" alt="team info" />

							<?php endif; ?>

							<figcaption class="overlay">
							  <h3 class="overlay-header"><?php the_title()  ?></h3>
							  <h5><?php echo $t_title ?></h5>
							  <p class="overlay-content"><?php the_excerpt(15); ?></p>
							  <div class="team-social">
								  <a href="<?php echo $f_icon ?>" ><i class="fa fa-facebook fa-2"></i></a>
								  <a href="<?php echo $t_icon ?>" ><i class="fa fa-twitter fa-2"></i></a>
							  </div>
							</figcaption>

						</figure>

					</div>

					<?php endwhile; wp_reset_postdata();?>

				</div>


		</section>
		<!-- end team -->




		<!-- begin service -->
		<section id="services" class="bg" data-stellar-background-ratio="0.5" style="background-color: <?php echo of_get_option('servicebgcolor')  ?>;background-image: url('<?php echo of_get_option('servicebg')  ?>')">

			<div class="container">

				<?php
				$the_query = new WP_Query( 'page_id='.of_get_option('servicepage').'' );
				while ( $the_query->have_posts() ) : $the_query->the_post();
				?>

				<!-- begin .summary -->
				<div class="summary">
					<h2><?php the_title()  ?></h2>
					<?php the_content(); ?>
				</div>
				<!-- end .summary -->

				<?php endwhile; wp_reset_postdata();?>


				<div id="service">

					<?php
					$the_query = new WP_Query( 'post_type=service' );
					while ( $the_query->have_posts() ) : $the_query->the_post();
					$s_icon = get_post_meta($post->ID,'spring_s_icon',true);
					$s_icon_color = get_post_meta($post->ID,'spring_s_icon_color',true);
					?>

					<div class="service col3">
						<span class="serviceicon"><i class="<?php echo $s_icon ?>" style="color:<?php echo $s_icon_color ?>"></i></span>
						<h4><?php the_title()  ?></h4>
						<?php the_excerpt(); ?>
					</div>

					<?php endwhile; wp_reset_postdata();?>

				</div>

			</div><!-- .container -->

		</section>
		<!-- end service -->




		<?php
		$the_query = new WP_Query( 'page_id='.of_get_option('contactpage').'' );
		while ( $the_query->have_posts() ) : $the_query->the_post();
		?>

		<!-- begin contact -->
		<section id="contact" class="bg" data-stellar-background-ratio="0.5" style="background-color: <?php echo of_get_option('contactbgcolor')  ?>; background-image: url('<?php echo of_get_option('contactbg')  ?>')">


			<div class="container">



				<!-- begin .summary -->
				<div class="summary">

					<h2><?php the_title()  ?></h2>

				</div>
				<!-- end .summary -->

				<div class="row">

					<div class="one-half column contactinfo">
						<h4><?php _e('Contact Info', 'site5framework'); ?></h4>
						<?php the_content(); ?>

						<span><i class="fa fa-envelope"></i> <?php echo of_get_option('contact_email')  ?></span>
						<span><i class="fa fa-phone"></i> <?php echo of_get_option('contact_phone')  ?></span>
						<span><i class="fa fa-map-marker"></i> <?php echo of_get_option('contact_address')  ?></span>
					</div>

					<div class="one-half column">
						<p class="error" <?php if($hasError != '') echo 'style="display:block;"'; ?>><?php _e('There was an error submitting the form.', 'site5framework'); ?></p>

						<p class="thanks"><?php _e('<strong>Thanks!</strong> Your email was successfully sent. We should be in touch soon.', 'site5framework'); ?></p>

						<form id="contactForm" method="POST">

						<label for="nameinput"><?php _e("Your name", "site5framework"); ?> *</label>
							<input type="text" id="nameinput" name="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="requiredField"/>
							<span class="error" <?php if($nameError != '') echo 'style="display:block;"'; ?>><?php _e("You forgot to enter your name.", "site5framework");?></span>
						<label for="emailinput"><?php _e("Your email", "site5framework"); ?>*</label>
							<input type="text" id="emailinput" name="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="requiredField email"/>
							  <span class="error" <?php if($emailError != '') echo 'style="display:block;"'; ?>><?php _e("You forgot to enter your email address.", "site5framework");?></span>

						<label for="commentinput"><?php _e("Your message", "site5framework"); ?>*</label>
							<textarea cols="20" rows="7" id="commentinput" name="comments" class="requiredField"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
							  <span class="error" <?php if($commentError != '') echo 'style="display:block;"'; ?>><?php _e("You forgot to enter your comments.", "site5framework");?></span>

						<br />
						<input type="hidden" name="submitted" id="submitted" value="true" />
						<button type="submit" id="submitbutton" class="submitbutton"><?php _e('SEND', 'site5framework'); ?></button>

						</form>
					</div>

				</div>
				<!-- end .content -->


			</div><!-- .container -->

		</section>
		<!-- end contact -->

		<?php if(of_get_option('contact_map')!=''){?>
			<div id="contact-map">
				<?php echo of_get_option('contact_map') ?>
			</div>
		<?php }?>

		<?php endwhile; wp_reset_postdata();?>

<?php get_footer(); ?>