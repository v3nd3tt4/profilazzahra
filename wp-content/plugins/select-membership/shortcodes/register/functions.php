<?php

if ( ! function_exists( 'stockholm_qode_membership_add_register_shortcodes' ) ) {
	function stockholm_qode_membership_add_register_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'StockholmQodeMembership\Shortcodes\StockholmQodeUserRegister\StockholmQodeUserRegister'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'stockholm_qode_filter_membership_add_vc_shortcode', 'stockholm_qode_membership_add_register_shortcodes' );
}