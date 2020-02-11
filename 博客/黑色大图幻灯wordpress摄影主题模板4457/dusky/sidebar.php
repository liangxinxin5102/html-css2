<?php
$dusky_settings = get_option( 'dusky_options');

?>
<div id="sidebar">

	<div class="search-form">
		<form action="<?php echo home_url(); ?>/" method="get">
			<input type="text" value="Search..." name="s" id="ls" class="searchfield" onfocus="if (this.value == 'Search...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Type search text and press enter...';}" />
		</form>
	</div>

	
	<ul class="sidebar-content">
<?php dynamic_sidebar('Sidebar'); ?>
       
	</ul>

</div>
