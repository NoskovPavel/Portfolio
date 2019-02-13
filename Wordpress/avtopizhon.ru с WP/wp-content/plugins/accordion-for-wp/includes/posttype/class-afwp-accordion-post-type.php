<?php

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://themeegg.com/plugins/accordion-for-wp//
 * @since      1.0.0
 *
 * @package    Accordion_For_WP
 * @subpackage Accordion_For_WP/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Accordion_For_WP
 * @subpackage Accordion_For_WP/admin
 * @author     ThemeEgg <themeeggofficial@gmail.com>
 */
class Accordion_For_WP_Post_Type {

	public function __construct() {

		add_action( 'init', array( $this, 'register_custom_post_types' ) );
		add_filter( 'manage_edit-accordion-group_columns', array( $this, 'accordion_shortcode_column' ), 10, 1 );
		add_action( 'manage_accordion-group_custom_column', array( $this, 'action_custom_columns_content' ), 10, 3 );
		add_action( 'accordion-group_add_form_fields', array( $this, 'accordion_group_add_new_meta_field' ), 10, 2 );
		add_action( 'accordion-group_edit_form_fields', array( $this, 'accordion_group_edit_new_meta_field' ), 10, 2 );
		add_action( 'edited_accordion-group', array( $this, 'save_accordion_group_custom_meta' ), 10, 2 );
		add_action( 'create_accordion-group', array( $this, 'save_accordion_group_custom_meta' ), 10, 2 );

	}

	public function save_accordion_group_custom_meta( $term_id ) {


		if ( isset( $_POST['term_meta'] ) ) {

			$cat_keys = array_keys( $_POST['term_meta'] );
			foreach ( $cat_keys as $key ) {
				if ( isset ( $_POST['term_meta'][ $key ] ) ) {

					$term_meta_value = sanitize_text_field( $_POST['term_meta'][ $key ] );
					update_term_meta( $term_id, $key, $term_meta_value );

				}
			}

			// Save the option array.

		}
	}

	public function accordion_group_add_new_meta_field() {
		?>

		<div class="form-field">
			<label for="term_meta[afwp_term_template]"><?php esc_html_e( 'Accordion template', 'accordion-for-wp' ); ?></label>
			<select style="width:94%" name="term_meta[afwp_term_template]" id="term_meta[afwp_term_template]">
				<?php
				foreach ( afwp_accordion_templates() as $template_index => $template_value ) {

					?>
					<option value="<?php echo $template_index ?>"><?php echo $template_value; ?></option>
					<?php

				}

				?>
			</select>
			<p class="description"><?php esc_html_e( 'Select template for accordion', 'accordion-for-wp' ); ?></p>
		</div>
		<div class="form-field">
			<label for="term_meta[acwp_term_style]"><?php esc_html_e( 'Accordion style', 'accordion-for-wp' ); ?></label>
			<select style="width:94%" name="term_meta[acwp_term_style]" id="term_meta[acwp_term_style]">
				<?php
				foreach ( afwp_accordion_styles() as $template_index => $template_value ) {
					?>
					<option value="<?php echo $template_index ?>"><?php echo $template_value; ?></option>
					<?php
				}

				?>
			</select>
			<p class="description"><?php esc_html_e( 'Select style for accordion', 'accordion-for-wp' ); ?></p>
		</div>
		<?php


	}

	public function accordion_group_edit_new_meta_field( $term ) {
		// put the term ID into a variable
		$t_id = $term->term_id;
		// retrieve the existing value(s) for this meta field. This returns an array
		$afwp_term_template1 = get_term_meta( $t_id );

		?>
		<tr class="form-field">
			<th scope="row" valign="top"><label
					for="term_meta[afwp_term_template]"><?php esc_html_e( 'Accordion template', 'accordion-for-wp' ); ?></label>
			</th>
			<td>
				<select style="width:94%" name="term_meta[afwp_term_template]" id="term_meta[afwp_term_template]">
					<?php
					$afwp_term_template = get_term_meta( $t_id, 'afwp_term_template', true );

					foreach ( afwp_accordion_templates() as $template_index => $template_value ) {
						?>
						<option value="<?php echo $template_index ?>"

							<?php echo $afwp_term_template === $template_index ? 'selected= "selected"' : '' ?>
						><?php echo $template_value; ?></option>
						<?php

					}

					?>
				</select>
				<p class="description"><?php esc_html_e( 'Select template for accordion', 'accordion-for-wp' ); ?></p>
			</td>
		</tr>
		<tr class="form-field">
			<th scope="row" valign="top"><label
					for="term_meta[acwp_term_style]"><?php esc_html_e( 'Accordion style', 'accordion-for-wp' ); ?></label>
			</th>
			<td>
				<select style="width:94%" name="term_meta[acwp_term_style]" id="term_meta[acwp_term_style]">
					<?php
					$acwp_term_style = get_term_meta( $t_id, 'acwp_term_style', true );

					foreach ( afwp_accordion_styles() as $template_index => $template_value ) {
						?>
						<option value="<?php echo $template_index ?>"
							<?php echo $acwp_term_style === $template_index ? 'selected= "selected"' : '' ?>
						><?php echo $template_value; ?></option>
						<?php

					}

					?>
				</select>
				<p class="description"><?php esc_html_e( 'Select style for accordion', 'accordion-for-wp' ); ?></p>
			</td>
		</tr>

		<?php


	}

	/**
	 * @param $column_id
	 * @param $post_id
	 *
	 * @return string
	 */
	function action_custom_columns_content( $content, $column_id, $taxonomy_id ) {

		//run a switch statement for all of the custom columns created
		switch ( $column_id ) {
			case 'accordion_shortcode':
				return '<span onclick="">[afwp_group_accordion id="' . $taxonomy_id . '"]</span>';
				break;

		}
	}

	/**
	 * @param $columns
	 *
	 * @return array
	 */
	function accordion_shortcode_column( $columns ) {

		$key    = 'description';
		$offset = array_search( $key, array_keys( $columns ) );

		$result = array_merge
		(
			array_slice( $columns, 0, $offset ),
			array( 'accordion_shortcode' => esc_html__( 'Shortcode', 'accordion-for-wp' ) ),
			array_slice( $columns, $offset, null )
		);

		return $result;
	}

	public function register_custom_post_types() {

		// Add new taxonomy, make it hierarchical (like categories)
		$labels = array(
			'name'              => _x( 'Accordion group', 'taxonomy general name', 'accordion-for-wp' ),
			'singular_name'     => _x( 'Accordion group', 'taxonomy singular name', 'accordion-for-wp' ),
			'search_items'      => esc_html__( 'Search accordion group', 'accordion-for-wp' ),
			'all_items'         => esc_html__( 'All Accordion groups', 'accordion-for-wp' ),
			'parent_item'       => esc_html__( 'Parent Accordion group', 'accordion-for-wp' ),
			'parent_item_colon' => esc_html__( 'Parent Accordion group:', 'accordion-for-wp' ),
			'edit_item'         => esc_html__( 'Edit Accordion group', 'accordion-for-wp' ),
			'update_item'       => esc_html__( 'Update Accordion group', 'accordion-for-wp' ),
			'add_new_item'      => esc_html__( 'Add New Accordion group', 'accordion-for-wp' ),
			'new_item_name'     => esc_html__( 'New Accordion group Name', 'accordion-for-wp' ),
			'menu_name'         => esc_html__( 'Accordion group', 'accordion-for-wp' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			//'meta_box_cb'       => array( $this, 'accordion_group_dropdown' ),
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'accordion-group' ),
		);

		register_taxonomy( 'accordion-group', array( 'accordion-for-wp' ), $args );

		$labels = array(
			'name'               => _x( 'Accordion', 'post type general name', 'accordion-for-wp' ),
			'singular_name'      => _x( 'Accordion', 'post type singular name', 'accordion-for-wp' ),
			'menu_name'          => _x( 'Accordions', 'admin menu', 'accordion-for-wp' ),
			'name_admin_bar'     => _x( 'Accordion', 'add new on admin bar', 'accordion-for-wp' ),
			'add_new'            => _x( 'Add New', 'book', 'accordion-for-wp' ),
			'add_new_item'       => esc_html__( 'Add New Accordion', 'accordion-for-wp' ),
			'new_item'           => esc_html__( 'New Accordion', 'accordion-for-wp' ),
			'edit_item'          => esc_html__( 'Edit Accordion', 'accordion-for-wp' ),
			'view_item'          => esc_html__( 'View Accordion', 'accordion-for-wp' ),
			'all_items'          => esc_html__( 'All Accordions', 'accordion-for-wp' ),
			'search_items'       => esc_html__( 'Search Accordions', 'accordion-for-wp' ),
			'parent_item_colon'  => esc_html__( 'Parent Accordions:', 'accordion-for-wp' ),
			'not_found'          => esc_html__( 'No accordions found.', 'accordion-for-wp' ),
			'not_found_in_trash' => esc_html__( 'No accordions found in Trash.', 'accordion-for-wp' )
		);

		$args = array(
			'labels'             => $labels,
			'description'        => esc_html__( 'Description.', 'accordion-for-wp' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'meta_box_cb'        => 'accordion-for-wp_categories_meta_box',
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'accordion-for-wp' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'menu_icon'           => 'dashicons-index-card',
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
		);

		register_post_type( 'accordion-for-wp', $args );
	}

	public function accordion_group_dropdown( $post, $box ) {


		/*wp_dropdown_categories( array(
			'taxonomy'         => $taxonomy,
			'hide_empty'       => 0,
			'name'             => "{$name}[]",
			'selected'         => 1,
			'orderby'          => 'name',
			'hierarchical'     => 0,
			'show_option_none' => '&mdash;'
		) );*/


	}


}

new Accordion_For_WP_Post_Type();
