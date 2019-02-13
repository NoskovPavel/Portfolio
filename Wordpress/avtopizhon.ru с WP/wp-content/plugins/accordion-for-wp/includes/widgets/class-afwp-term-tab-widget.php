<?php
// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * The class for tab shortcode
 *
 * @link       http://themeegg.com/
 * @since      1.3.2
 *
 * @package    Tab_For_WP
 * @subpackage Tab_For_WP/public
 */
class AFWP_Term_Tab_Widgets extends WP_Widget {

	/**
	 * Sets up a new Tab WIdget instance.
	 *
	 * @since 1.3.2
	 * @access public
	 */
	public function __construct() {
		$widget_ops  = array(
			'classname'                   => 'afwp_term_tab_widget',
			'description'                 => esc_html__( 'Widget for Term Tab', 'accordion-for-wp' ),
			'customize_selective_refresh' => true,
		);
		$control_ops = array( 'width' => 350, 'height' => 350 );
		parent::__construct( 'afwp_term_tab_widget', esc_html__( 'Tab Term Widget', 'accordion-for-wp' ), $widget_ops, $control_ops );
	}

	/**
	 * Outputs the content for the current Tab widget instance.
	 *
	 * @since 1.3.2
	 * @access public
	 *
	 * @param array $args Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Tab widget instance.
	 */
	public function widget( $args, $instance ) {

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		$taxonomy   		= empty( $instance['taxonomy'] ) ? '' : $instance['taxonomy'];
		$no_of_term 		= empty( $instance['no_of_term'] ) ? '' : $instance['no_of_term'];

		$templates      	= empty( $instance['templates'] ) ? 'default' : esc_attr($instance['templates']);
		$style          	= empty( $instance['style'] ) ? 'vertical' : esc_attr($instance['style']);
		$active_item       	= isset( $instance['active_item'] ) ? absint($instance['active_item']) : 1;

		$tab_icon		= isset($instance['tab_icon']) ? esc_attr( $instance['tab_icon'] ) : 'fa-desktop';
		$title_color		= isset($instance['title_color']) ? sanitize_hex_color( $instance['title_color'] ) : '';
		$title_background	= isset($instance['title_background']) ? sanitize_hex_color( $instance['title_background'] ) : '';
		$content_color		= isset($instance['content_color']) ? sanitize_hex_color( $instance['content_color'] ) : '';
		$content_background	= isset($instance['content_background']) ? sanitize_hex_color( $instance['content_background'] ) : '';

		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		$all_terms = get_terms( array(
			'taxonomy'   => $taxonomy,
			'hide_empty' => false,
		) );
		if ( $all_terms ):
			?>
			<div class="afwp-tab-template afwp-widget afwp-tab-<?php echo $templates; ?>">
				<div class="afwp-tab <?php echo $style; ?>">
					<ul class="afwp-tab-list">
						<?php 
						$current_item = 0; 
						foreach ( $all_terms as $key => $term_detail ):
							$current_item++; 
							$active_class 	= ($current_item==$active_item) ? 'current' : '';
							$active_style 	= ($current_item==$active_item) ? 'display:block;' : '';
							if( $key >= $no_of_term ) {
								break;
							}
							?>
							<li class="afwp-tab-item-wrap">
								<div class="afwp-tab-title <?php echo esc_attr($active_class); ?>" style="background:<?php echo sanitize_hex_color($title_background); ?>; color:<?php echo sanitize_hex_color($title_color); ?>;">
									<?php if(!empty($tab_icon)): ?>
										<i 
										class="afwp-tab-icon fa <?php echo esc_attr($tab_icon); ?>"
										style="color:<?php echo sanitize_hex_color($title_color); ?>;"
										></i>
									<?php endif; ?>
									<a class="afwp-post-link" href="#afwp_<?php echo $term_detail->slug.$term_detail->term_id; ?>"><?php echo $term_detail->name; ?></a>
								</div>
							</li>
						<?php endforeach; ?>
					</ul>
					<div class="afwp-tab-content-wraper">
						<?php 
						$current_item = 0; 
						foreach ( $all_terms as $key => $term_detail ):
						$current_item++; 
							$active_class 	= ($current_item==$active_item) ? 'current' : '';
							if( $key >= $no_of_term ) {
								break;
							}
							?>
							<div class="afwp-tab-content <?php echo esc_attr($active_class); ?>" id="afwp_<?php echo $term_detail->slug.$term_detail->term_id; ?>" style="background:<?php echo sanitize_hex_color($content_background); ?>; color:<?php echo sanitize_hex_color($content_color); ?>;">
								<div class="afwp-content-wraper">
									<p><?php echo $term_detail->description; ?></p>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		<?php endif; ?>
		<?php
		echo $args['after_widget'];
	}

	/**
	 * Handles updating settings for the current Text widget instance.
	 *
	 * @since 1.3.2
	 * @access public
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 *
	 * @return array Settings to save or bool false to cancel saving.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance               = $old_instance;
		$instance['title']      = sanitize_text_field( $new_instance['title'] );
		$instance['taxonomy']   = sanitize_text_field( $new_instance['taxonomy'] );
		$instance['term']       = sanitize_text_field( $new_instance['term'] );
		$instance['no_of_term'] = absint( $new_instance['no_of_term'] );

		$instance['templates'] = sanitize_text_field( $new_instance['templates'] );
		$instance['style']     = sanitize_text_field( $new_instance['style'] );
		$instance['active_item'] = isset($new_instance['active_item']) ? absint( $new_instance['active_item'] ) : '';

		$instance['tab_icon']     = isset($new_instance['tab_icon']) ? esc_attr( $new_instance['tab_icon'] ) : 'fa-desktop';
		$instance['title_color']     = isset($new_instance['title_color']) ? esc_attr( $new_instance['title_color'] ) : '';
		$instance['title_background']     = isset($new_instance['title_background']) ? esc_attr( $new_instance['title_background'] ) : '';
		$instance['content_color']     = isset($new_instance['content_color']) ? esc_attr( $new_instance['content_color'] ) : '';
		$instance['content_background']     = isset($new_instance['content_background']) ? esc_attr( $new_instance['content_background'] ) : '';

		$instance['active_tab_type'] = isset($new_instance['active_tab_type']) ? esc_attr( $new_instance['active_tab_type'] ) : 'general';

		return $instance;
	}

	/**
	 * Outputs the Tab widget settings form.
	 *
	 * @since 1.3.2
	 * @access public
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$instance   = wp_parse_args( (array) $instance, array(
			'title'      => '',
			'taxonomy'   => '',
			'no_of_term' => '5',

			'templates'  => 'default',
			'style'      => 'vertical',
			'active_item' => 1,

			'tab_icon'		=> 'fa-desktop',
			'title_color'  		=> '',
			'title_background'  => '',
			'content_color'  	=> '',
			'content_background'=> '',

			'active_tab_type'	=>'general',

		) );
		$title      = sanitize_text_field( $instance['title'] );
		$taxonomy   = sanitize_text_field( $instance['taxonomy'] );
		$no_of_term = absint( $instance['no_of_term'] );

		$templates = sanitize_text_field( $instance['templates'] );
		$style     = sanitize_text_field( $instance['style'] );
		$active_item	= isset($instance['active_item']) ? esc_attr( $instance['active_item'] ) : '';

		$tab_icon	= isset($instance['tab_icon']) ? esc_attr( $instance['tab_icon'] ) : 'fa-desktop';
		$title_color		= isset($instance['title_color']) ? esc_attr( $instance['title_color'] ) : '';
		$title_background	= isset($instance['title_background']) ? esc_attr( $instance['title_background'] ) : '';
		$content_color		= isset($instance['content_color']) ? esc_attr( $instance['content_color'] ) : '';
		$content_background	= isset($instance['content_background']) ? esc_attr( $instance['content_background'] ) : '';

		$active_tab_type = esc_attr( $instance['active_tab_type'] );
		$list_all_tabs = array(
			'general'	=>	array(
				'id'	=> 'afwp_term_accordion_general'.esc_attr($this->number),
				'label'	=> esc_html__('General', 'accordion-for-wp'),
			),
			'layout'	=>	array(
				'id'	=> 'afwp_term_accordion_layout'.esc_attr($this->number),
				'label'	=> esc_html__('Layout', 'accordion-for-wp'),
			),
			'design'	=>	array(
				'id'	=> 'afwp_term_accordion_design'.esc_attr($this->number),
				'label'	=> esc_html__('Design', 'accordion-for-wp'),
			),
		);

		?>
		<div class="afwp-tab-wraper">
			<h5 class="afwp-tab-list nav-tab-wrapper">
				<?php foreach($list_all_tabs as $tab_key=>$tab_details){ ?>
					<label for="tab_<?php echo esc_attr($tab_details['id']); ?>" data-id="#<?php echo esc_attr($tab_details['id']); ?>" class="nav-tab <?php echo ($tab_key == $active_tab_type) ? 'nav-tab-active' : ''; ?>"><?php echo sanitize_text_field($tab_details['label']); ?><input id="tab_<?php echo esc_attr($tab_details['id']); ?>" type="radio" name="<?php echo $this->get_field_name("active_tab_type"); ?>" value="<?php echo esc_attr($tab_key); ?>" <?php checked($active_tab_type, $tab_key); ?> class="afwp-hidden"/></label>
				<?php } ?>
			</h5>
			<div class="afwp-tab-content-wraper">
				<div id="<?php echo esc_attr($list_all_tabs['general']['id']); ?>" class="afwp-tab-content <?php echo ($active_tab_type=='general') ? 'afwp-content-active' : ''; ?>">
					<p><label
							for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'accordion-for-wp' ); ?></label>
						<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
							   name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
							   value="<?php echo esc_attr( $title ); ?>"/>
					</p>
					<p><label
							for="<?php echo $this->get_field_id( 'taxonomy' ); ?>"><?php esc_html_e( 'Taxonomy:', 'accordion-for-wp' ); ?></label>
						<?php
						$all_object_taxonomies = get_taxonomies();
						?>
						<select class="widefat afwp-widget-taxonomy" data-accordion-value="taxonomy"
								data-accordion-change-id="#<?php echo $this->get_field_id( 'term' ); ?>"
								id="<?php echo $this->get_field_id( 'taxonomy' ); ?>"
								name="<?php echo $this->get_field_name( 'taxonomy' ); ?>" type="text"
								value="<?php echo esc_attr( $taxonomy ); ?>">
							<?php foreach ( $all_object_taxonomies as $taxonomy_key => $taxonomy_value ): ?>
								<?php
								$taxonomy_details = get_taxonomy( $taxonomy_key );
								?>
								<option <?php echo ( $taxonomy_key == $taxonomy ) ? 'selected="selected"' : ''; ?>
									value="<?php echo $taxonomy_key; ?>"><?php echo $taxonomy_details->label; ?></option>
							<?php endforeach; ?>
						</select>
					</p>

					<p><label
							for="<?php echo $this->get_field_id( 'no_of_term' ); ?>"><?php esc_html_e( 'Show no of term:', 'accordion-for-wp' ); ?></label>
						<input class="widefat" min="1" max="99" id="<?php echo $this->get_field_id( 'no_of_term' ); ?>"
							   name="<?php echo $this->get_field_name( 'no_of_term' ); ?>" type="number"
							   value="<?php echo $no_of_term; ?>"/>
							</p>
				</div>
				<div id="<?php echo esc_attr($list_all_tabs['layout']['id']); ?>" class="afwp-tab-content <?php echo ($active_tab_type=='layout') ? 'afwp-content-active' : ''; ?>">
					<p>
						<label for="<?php echo $this->get_field_id( 'active_item' ); ?>"><?php esc_html_e( 'Active Tab Item:', 'accordion-for-wp' ); ?></label>
						<input class="widefat" id="<?php echo $this->get_field_id( 'active_item' ); ?>"
						   name="<?php echo $this->get_field_name( 'active_item' ); ?>" type="number"
						   value="<?php echo absint( $active_item ); ?>"/>
						<span><?php esc_html_e('Please set active item on load(zero for collapse all)', 'accordion-for-wp'); ?></span>
					</p>
					<p><label
							for="<?php echo $this->get_field_id( 'templates' ); ?>"><?php esc_html_e( 'Template:', 'accordion-for-wp' ); ?></label>
						<?php
						$all_templates = afwp_accordion_templates();
						?>
						<select class="widefat" id="<?php echo $this->get_field_id( 'templates' ); ?>"
								name="<?php echo $this->get_field_name( 'templates' ); ?>" type="text"
								value="<?php echo esc_attr( $templates ); ?>">
							<?php foreach ( $all_templates as $template_key => $template_value ): ?>
								<option <?php selected( $templates, $template_key, true ); ?>
									value="<?php echo $template_key; ?>"><?php echo $template_value; ?></option>
							<?php endforeach; ?>
						</select>
					</p>
					<p><label
							for="<?php echo $this->get_field_id( 'style' ); ?>"><?php esc_html_e( 'Style:', 'accordion-for-wp' ); ?></label>
						<?php
						$all_style = afwp_accordion_styles();
						?>
						<select class="widefat" id="<?php echo $this->get_field_id( 'style' ); ?>"
								name="<?php echo $this->get_field_name( 'style' ); ?>" type="text"
								value="<?php echo esc_attr( $style ); ?>">
							<?php foreach ( $all_style as $style_key => $style_value ): ?>
								<option <?php selected( $style, $style_key, true ); ?>
									value="<?php echo $style_key; ?>"><?php echo $style_value; ?></option>
							<?php endforeach; ?>
						</select>
					</p>
				</div>
				<div id="<?php echo esc_attr($list_all_tabs['design']['id']); ?>" class="afwp-tab-content <?php echo ($active_tab_type=='design') ? 'afwp-content-active' : ''; ?> " >
					<div class="afwp_widget_field">
						<label for="<?php echo $this->get_field_id( 'tab_icon' ); ?>"><?php esc_html_e( 'Tab Icon:', 'accordion-for-wp' ); ?></label>
						<div class="afwp_widget_icon_wrap">
							<input class="widefat afwp_icon_picker" id="<?php echo $this->get_field_id( 'tab_icon' ); ?>"
							   name="<?php echo $this->get_field_name( 'tab_icon' ); ?>" type="text"
							   value="<?php echo esc_attr( $tab_icon ); ?>"/>
							<label class="afwp_icon fa <?php echo esc_attr( $tab_icon ); ?>" for="<?php echo $this->get_field_id( 'tab_icon' ); ?>"></label>
						</div>
					</div>
					<div class="afwp_widget_field">
						<label for="<?php echo $this->get_field_id( 'title_color' ); ?>"><?php esc_html_e( 'Title Color:', 'accordion-for-wp' ); ?></label>
						<input class="afwp_color_picker" id="<?php echo $this->get_field_id( 'title_color' ); ?>" name="<?php echo $this->get_field_name( 'title_color' ); ?>" type="text"
							   value="<?php echo esc_attr( $title_color ); ?>"/>
					</div>
					<div class="afwp_widget_field">
						<label for="<?php echo $this->get_field_id( 'title_background' ); ?>"><?php esc_html_e( 'Title Background:', 'accordion-for-wp' ); ?></label>
						<input class="afwp_color_picker" id="<?php echo $this->get_field_id( 'title_background' ); ?>"
							   name="<?php echo $this->get_field_name( 'title_background' ); ?>" type="text"
							   value="<?php echo esc_attr( $title_background ); ?>"/>
					</div>
					<div class="afwp_widget_field">
						<label for="<?php echo $this->get_field_id( 'content_color' ); ?>"><?php esc_html_e( 'Content Color:', 'accordion-for-wp' ); ?></label>
						<input class="afwp_color_picker" id="<?php echo $this->get_field_id( 'content_color' ); ?>"
							   name="<?php echo $this->get_field_name( 'content_color' ); ?>" type="text"
							   value="<?php echo esc_attr( $content_color ); ?>"/>
					</div>
					<div class="afwp_widget_field">
						<label for="<?php echo $this->get_field_id( 'content_background' ); ?>"><?php esc_html_e( 'Content Background:', 'accordion-for-wp' ); ?></label>
						<input class="afwp_color_picker" id="<?php echo $this->get_field_id( 'content_background' ); ?>"
							   name="<?php echo $this->get_field_name( 'content_background' ); ?>" type="text"
							   value="<?php echo esc_attr( $content_background ); ?>"/>
					</div>
					
				</div>
			</div>
		</div>
		<?php
	}

}
register_widget( 'AFWP_Term_Tab_Widgets' );