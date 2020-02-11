<?php
/**
* Outputs default theme options
* @since 1.1
*/

if ( !function_exists( 'att_option' ) ) {
	function att_option($id, $fallback = '') {
		$options = get_option( 'att_options' );
		if ( $fallback == false ) $fallback = '';
		$output = ( isset($options[$id]) && $options[$id] !== '' ) ? $options[$id] : $fallback;
		return $output;
	}
}