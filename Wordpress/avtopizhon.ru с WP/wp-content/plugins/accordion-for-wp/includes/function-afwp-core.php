<?php
// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if(!function_exists('afwp_accordion_templates')){
	function afwp_accordion_templates() {

		return apply_filters(

			'afwp_accordion_templates', array(

				'default'       => esc_html__( 'Default', 'accordion-for-wp' ),
				'template-1'    => esc_html__( 'Template 1', 'accordion-for-wp' ),
				'theme-default' => esc_html__( 'Theme default', 'accordion-for-wp' ),
			)
		);
	}
}

if(!function_exists('afwp_sanitize_accordion_templates')){

	function afwp_sanitize_accordion_templates($template='') {

		$default = 'template-1';
		$accordion_templates = afwp_accordion_templates();
		if(isset($accordion_templates[$template])){
			return $template;
		}else{
			return $default;
		}

	}

}

if(!function_exists('afwp_accordion_styles')){
	function afwp_accordion_styles() {

		return apply_filters(

			'afwp_accordion_styles', array(
				'vertical'   => esc_html__( 'Vertical', 'accordion-for-wp' ),
				'horizontal' => esc_html__( 'Horizontal', 'accordion-for-wp' ),
			)
		);
	}
}

if(!function_exists('afwp_sanitize_accordion_styles')){

	function afwp_sanitize_accordion_styles($style='') {

		$default = 'vertical';
		$accordion_style = afwp_accordion_styles();
		if(isset($accordion_style[$style])){
			return $style;
		}else{
			return $default;
		}

	}

}

if(!function_exists('afwp_accordion_content_type')){
	function afwp_accordion_content_type() {
		return apply_filters(
			'afwp_accordion_content_type', array(
				'excerpt'   => esc_html__( 'Excerpt', 'accordion-for-wp' ),
				'content' => esc_html__( 'Full Content', 'accordion-for-wp' ),
			)
		);
	}
}

if(!function_exists('afwp_sanitize_accordion_content_type')){
	function afwp_sanitize_accordion_content_type($content_type='') {
		$default = 'excerpt';
		$accordion_style = afwp_accordion_styles();
		if(isset($accordion_style[$content_type])){
			return $content_type;
		}else{
			return $default;
		}
	}
}

if(!function_exists('afwp_tab_templates')){

	function afwp_tab_templates() {

		return apply_filters(

			'afwp_tab_templates', array(
				'default'       => esc_html__( 'Default', 'accordion-for-wp' ),
				'template-1'    => esc_html__( 'Template 1', 'accordion-for-wp' ),
				'theme-default' => esc_html__( 'Theme default', 'accordion-for-wp' ),
			)

		);

	}
	
}

if(!function_exists('afwp_sanitize_tab_templates')){

	function afwp_sanitize_tab_templates($template='') {

		$default = 'template-1';
		$tab_templates = afwp_tab_templates();
		if(isset($tab_templates[$template])){
			return $template;
		}else{
			return $default;
		}

	}

}


if(!function_exists('afwp_tab_styles')){
	function afwp_tab_styles() {

		return apply_filters(

			'afwp_tab_styles', array(
				'vertical'   => esc_html__( 'Vertical', 'accordion-for-wp' ),
				'horizontal' => esc_html__( 'Horizontal', 'accordion-for-wp' ),
			)
		);
	}
}

if(!function_exists('afwp_sanitize_tab_styles')){

	function afwp_sanitize_tab_styles($style='') {

		$default = 'vertical';
		$tab_style = afwp_tab_styles();
		if(isset($tab_style[$style])){
			return $style;
		}else{
			return $default;
		}

	}

}


if(!function_exists('get_afwp_excerpt')){

	function get_afwp_excerpt($readmore='default') {
		switch ($readmore) {
			case 'default':
				return get_the_excerpt();
				break;
			case 'button':
				return get_the_excerpt();
				break;
			default:
				return get_the_excerpt();
				break;
		}
		return get_the_excerpt();
	}

}


if(!function_exists('the_afwp_excerpt')){

	function the_afwp_excerpt($readmore='default') {

		switch ($readmore) {
			case 'default':
				echo get_afwp_excerpt();
				break;
			case 'button':
				echo get_afwp_excerpt();
				break;
			default:
				echo get_afwp_excerpt();
				break;
		}

	}

}