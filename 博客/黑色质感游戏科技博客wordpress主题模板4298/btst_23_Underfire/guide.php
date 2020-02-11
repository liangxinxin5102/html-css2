<?php
function theme_guide(){
add_theme_page( 'Theme guide','Theme documentation','edit_themes', 'theme-documentation', 'fabthemes_theme_guide');
}
add_action('admin_menu', 'theme_guide');

function fabthemes_theme_guide(){
		echo '
		
<div id="welcome-panel" class="welcome-panel">

	<div class="wpbadge" style="float:left; margin-right:30px; "><img src="'. get_template_directory_uri() . '/screenshot.png" width="200" height="150" /></div>

	<div class="welcome-panel-content">
	
	<h3>Welcome to '.wp_get_theme().' WordPress theme!</h3>
	
	<p class="about-description">Underfire is a free premium WordPress theme. This is a WordPress 3+ ready theme with features like custom menu, featured images, widgetized sidebar, and jQuery image slider on the homepage. Theme also comes with an option panel. </p>
	
	<div class="welcome-panel-column-container">

		<div class="guide-panel-column" style="width:80%">
		<h4><span class="icon16 icon-settings"></span> Required plugins </h4>
		<p>The theme often requires few plugins to work the way it is originally intended to. You will find a notification on the admin panel prompting you to install the required plugins. Please install and activate the plugins.  </p>
		<ol>
			<li><a href="http://wordpress.org/extend/plugins/options-framework/">Options framework</a></li>
		</ol>
		</div>
	
	
		<div class="guide-panel-column" style="width:80%">
		
		<h4><span class="icon16 icon-settings"></span> Theme options explained</h4>
		<p>The theme contains an options page using which you adjust various settings available on the theme. </p>
		

		<p><b>Slider category:</b>
		Select a category for the jQuery image slider </p>
		<p><b>Number of slides:</b>
		Set a number for the slides </p>
		<p><b>Banner setting:</b>
		Configure the banner ads on the sidebar </p>

		</div>
	

				
		<div class="guide-panel-column" style="width:80%">
		' . file_get_contents(dirname(__FILE__) . '/FT/license-html.php') . '
		</div>
	
				
	</div>
	<p class="welcome-panel-dismiss">WordPress theme designed by <a href="http://www.fabthemes.com">FabThemes.com</a>.</p>

	</div>
	</div>
		
		';
		

}
