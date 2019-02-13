<?php

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The class for tab shortcode
 *
 * @link       http://themeegg.com/
 * @since      1.0.0
 *
 * @package    Accordion_For_WP
 * @subpackage Accordion_For_WP/public
 */
class AFWP_Tab_Shortcode_Group {

	protected $atts;

	protected $content_type;

	protected $style;
	protected $template;
	protected $active_item;

	protected $tab_icon;
	protected $active_dp_icon;
	protected $title_color;
	protected $title_background;
	protected $content_color;
	protected $content_background;

	/**
	 * @param no param
	 *
	 * @since      1.0.0
	 */
	public function __construct() {

		defined( 'WPINC' ) or exit;

		add_shortcode( 'afwp_group_tab', array( $this, 'afwp_group_tab' ) );
	}


	/**
	 * @param $atts is shortcode attribute
	 *
	 * @since      1.0.0
	 */
	public function filter_args( $atts ) {

		/*WP Query Args*/
		$default_args = array(

			'afwp_content_type'		=> 'excerpt',

			'afwp_style'			=> 'vertical',
			'afwp_active_item'		=> 1,
			'afwp_template'			=> 'default',

			'afwp_tab_icon'	=> '',
			'afwp_title_color'		=> '',
			'afwp_title_background'	=> '',
			'afwp_content_color'	=> '',
			'afwp_content_background' => '',

			//Remaining arguments supports WP_Query Arguments

		);

		$this->atts = wp_parse_args( $atts, $default_args );

		return $this->atts;

	}

	public function afwp_group_tab( $atts, $content = "" ) {

		$args = $this->filter_args( $atts );

		if ( ! isset( $args['id'] ) ) {
			return;
		}


		$taxonomy_id = absint( $args['id'] );
		$post_limit = isset( $args['limit'] ) ? $args['limit'] : - 1;

		$this->content_type = isset( $args['afwp_content_type'] ) ? $args['afwp_content_type'] : 'excerpt';

		$this->template = get_term_meta( $taxonomy_id, 'afwp_term_template', true );
		$this->style = get_term_meta( $taxonomy_id, 'acwp_term_style', true );
		$this->active_item = isset($args['afwp_active_item']) ? absint($args['afwp_active_item']) : 1;

		$this->tab_icon = isset( $args['afwp_tab_icon'] ) ? $args['afwp_tab_icon'] : '';
		$this->title_color = isset( $args['afwp_title_color'] ) ? $args['afwp_title_color'] : '';
		$this->title_background = isset( $args['afwp_title_background'] ) ? $args['afwp_title_background'] : '';
		$this->content_color = isset( $args['afwp_content_color'] ) ? $args['afwp_content_color'] : '';
		$this->content_background = isset( $args['afwp_content_background'] ) ? $args['afwp_content_background'] : '';

		$query_args = array(
			'posts_per_page' => $post_limit,
			'post_type'      => 'afwp-tabs',
			'tax_query'      => array(
				array(
					'taxonomy' => 'afwp-tab-group',
					'field'    => 'term_id',
					'terms'    => $taxonomy_id,
				)
			)
		);
		$this->atts = wp_parse_args($query_args, $args);

		ob_start();

		$this->template();

		$output = ob_get_contents();

		ob_get_clean();

		return $output;

	}

	public function afwp_tab_args() { return $this->atts; }
	public function afwp_content_type(){ return $this->content_type; }

	public function afwp_tab_styles(){  return $this->style; }
	public function afwp_tab_templates(){ return $this->template; }
	public function afwp_active_item(){ return $this->active_item; }

	public function afwp_tab_icon(){  return $this->tab_icon; }
	public function afwp_title_color(){  return $this->title_color; }
	public function afwp_title_background(){ return $this->title_background; }
	public function afwp_content_color(){  return $this->content_color; }
	public function afwp_content_background(){ return $this->content_background; }

	
	public function template() {

		add_filter( 'afwp_tab_args', array( $this, 'afwp_tab_args' ) );

		add_filter( 'afwp_tab_content_type', array( $this, 'afwp_content_type' ) );

		add_filter( 'afwp_tab_styles', array( $this, 'afwp_tab_styles' ) );
		add_filter( 'afwp_tab_templates', array( $this, 'afwp_tab_templates' ) );
		add_filter( 'afwp_tab_activeitem', array( $this, 'afwp_active_item' ));

		add_filter( 'afwp_tab_icon', array( $this, 'afwp_tab_icon' ) );
		add_filter( 'afwp_title_color', array( $this, 'afwp_title_color' ));
		add_filter( 'afwp_title_background', array( $this, 'afwp_title_background' ));
		add_filter( 'afwp_content_color', array( $this, 'afwp_content_color' ));
		add_filter( 'afwp_content_background', array( $this, 'afwp_content_background' ) );
		

		$afwp_loader = new Accordion_For_WP_Loader();
		$afwp_loader->afwp_template_part( 'public/partials/afwp-tab-public-display.php' );

	}

}

new AFWP_Tab_Shortcode_Group();
