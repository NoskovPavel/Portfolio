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
 * @package     Tab_For_WP
 * @subpackage  Tab_For_WP/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package     Tab_For_WP
 * @subpackage  Tab_For_WP/admin
 * @author     ThemeEgg <themeeggofficial@gmail.com>
 */
class AFWP_TAB_For_WP_Post_Type {

	public function __construct() {
		
		add_action( 'init', array( $this, 'register_custom_post_types' ) );
		add_filter( 'manage_edit-afwp-tab-group_columns', array( $this, 'afwp_tab_shortcode_column' ), 10, 1 );
		add_action( 'manage_afwp-tab-group_custom_column', array( $this, 'action_custom_columns_content' ), 10, 3 );
		add_action( 'afwp-tab-group_add_form_fields', array( $this, 'afwp_tab_group_add_new_meta_field' ), 10, 2 );
		add_action( 'afwp-tab-group_edit_form_fields', array( $this, 'afwp_tab_group_edit_new_meta_field' ), 10, 2 );
		add_action( 'edited_afwp-tab-group', array( $this, 'save_afwp_tab_group_custom_meta' ), 10, 2 );
		add_action( 'create_afwp-tab-group', array( $this, 'save_afwp_tab_group_custom_meta' ), 10, 2 );
		add_action('all_admin_notices' , array($this, 'afwp_admin_notices') );

	}

	public function afwp_admin_notices(){

		$tab_page = false;

		if(isset($_GET['post_type']) && $_GET['post_type']=='afwp-tabs'){
			$tab_page = true;
		}

		global $typenow;
		if($typenow=='afwp-tabs'){
			$tab_page = true;
		}

		if(!$tab_page){
			return;
		}

		$current_screen = get_current_screen();
		$current_id = isset($current_screen->id) ? $current_screen->id : false;

		if(!$current_id){
			return;
		}

		$all_menu_items = array(
			array(
				'id'	=> 'edit-afwp-tab-group',
				'label'	=> esc_html__('Tab Group', 'accordion-for-wp'),
				'url' 	=> 'edit-tags.php?taxonomy=afwp-tab-group&post_type=afwp-tabs',
			),
			array(
				'id'	=> 'edit-afwp-tabs',
				'label'	=> esc_html__('All Tabs', 'accordion-for-wp'),
				'url' 	=> 'edit.php?post_type=afwp-tabs',
			),
			array(
				'id'	=> 'afwp-tabs',
				'label'	=> esc_html__('Add New Tab', 'accordion-for-wp'),
				'url' 	=> 'post-new.php?post_type=afwp-tabs',
			),
		);
		?>
		<div class="acfwp-admin-tab">
		<h5 class="nav-tab-wrapper">
			<?php 
			foreach($all_menu_items as $single_menu){ 
				$menu_url = isset($single_menu['url']) ? $single_menu['url'] : false;
				$menu_label = isset($single_menu['label']) ? $single_menu['label'] : '';
				$menu_active_classs = 'nav-tab-active '; 
				$menu_active_classs = (isset($single_menu['id']) && $current_id==$single_menu['id']) ? ' nav-tab-active ' : '';
				?>
				<a href="<?php echo $menu_url; ?>" class="nav-tab <?php echo esc_attr($menu_active_classs); ?>"><?php echo $menu_label; ?></a>
			<?php } ?>
		</h5>
	</div>
		<?php
	}

	public function save_afwp_tab_group_custom_meta( $term_id ) {


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

	public function afwp_tab_group_add_new_meta_field() {
		?>

		<div class="form-field">
			<label for="term_meta[afwp_term_template]"><?php esc_html_e( ' Tab template', 'accordion-for-wp' ); ?></label>
			<select style="width:94%" name="term_meta[afwp_term_template]" id="term_meta[afwp_term_template]">
				<?php
				foreach ( afwp_tab_templates() as $template_index => $template_value ) {

					?>
					<option value="<?php echo $template_index ?>"><?php echo $template_value; ?></option>
					<?php
				}
				?>
			</select>
			<p class="description"><?php esc_html_e( 'Select template for accordion', 'accordion-for-wp' ); ?></p>
		</div>
		<div class="form-field">
			<label for="term_meta[acwp_term_style]"><?php esc_html_e( ' Tab style', 'accordion-for-wp' ); ?></label>
			<select style="width:94%" name="term_meta[acwp_term_style]" id="term_meta[acwp_term_style]">
				<?php
				foreach ( afwp_tab_styles() as $template_index => $template_value ){
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

	public function afwp_tab_group_edit_new_meta_field( $term ) {
		// put the term ID into a variable
		$t_id = $term->term_id;
		// retrieve the existing value(s) for this meta field. This returns an array
		$afwp_term_template1 = get_term_meta( $t_id );

		?>
		<tr class="form-field">
			<th scope="row" valign="top"><label
					for="term_meta[afwp_term_template]"><?php esc_html_e( ' Tab template', 'accordion-for-wp' ); ?></label>
			</th>
			<td>
				<select style="width:94%" name="term_meta[afwp_term_template]" id="term_meta[afwp_term_template]">
					<?php
					$afwp_term_template = get_term_meta( $t_id, 'afwp_term_template', true );

					foreach ( afwp_tab_templates() as $template_index => $template_value ) {
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
					for="term_meta[acwp_term_style]"><?php esc_html_e( ' Tab style', 'accordion-for-wp' ); ?></label>
			</th>
			<td>
				<select style="width:94%" name="term_meta[acwp_term_style]" id="term_meta[acwp_term_style]">
					<?php
					$acwp_term_style = get_term_meta( $t_id, 'acwp_term_style', true );

					foreach ( afwp_tab_styles() as $template_index => $template_value ) {
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
				return '<span onclick="">[afwp_group_tab id="' . $taxonomy_id . '"]</span>';
				break;

		}
	}

	/**
	 * @param $columns
	 *
	 * @return array
	 */
	function afwp_tab_shortcode_column( $columns ) {

		$key    = 'description';
		$offset = array_search( $key, array_keys( $columns ) );

		$result = array_merge(
			array_slice( $columns, 0, $offset ),
			array( 'accordion_shortcode' => esc_html__( 'Shortcode', 'accordion-for-wp' ) ),
			array_slice( $columns, $offset, null )
		);

		return $result;
	}

	public function register_custom_post_types() {

		// Add new taxonomy, make it hierarchical (like categories)
		$labels = array(
			'name'              => _x( ' Tab group', 'taxonomy general name', 'accordion-for-wp' ),
			'singular_name'     => _x( ' Tab group', 'taxonomy singular name', 'accordion-for-wp' ),
			'search_items'      => esc_html__( 'Search accordion group', 'accordion-for-wp' ),
			'all_items'         => esc_html__( 'All  Tab groups', 'accordion-for-wp' ),
			'parent_item'       => esc_html__( 'Parent  Tab group', 'accordion-for-wp' ),
			'parent_item_colon' => esc_html__( 'Parent  Tab group:', 'accordion-for-wp' ),
			'edit_item'         => esc_html__( 'Edit  Tab group', 'accordion-for-wp' ),
			'update_item'       => esc_html__( 'Update  Tab group', 'accordion-for-wp' ),
			'add_new_item'      => esc_html__( 'Add New  Tab group', 'accordion-for-wp' ),
			'new_item_name'     => esc_html__( 'New  Tab group Name', 'accordion-for-wp' ),
			'menu_name'         => esc_html__( ' Tab group', 'accordion-for-wp' ),
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

		register_taxonomy( 'afwp-tab-group', array( 'afwp-tabs' ), $args );

		$labels = array(
			'name'               => _x( ' Tab', 'post type general name', 'accordion-for-wp' ),
			'singular_name'      => _x( ' Tab', 'post type singular name', 'accordion-for-wp' ),
			'menu_name'          => _x( ' Tabs', 'admin menu', 'accordion-for-wp' ),
			'name_admin_bar'     => _x( ' Tab', 'add new on admin bar', 'accordion-for-wp' ),
			'add_new'            => _x( 'Add New', 'book', 'accordion-for-wp' ),
			'add_new_item'       => esc_html__( 'Add New  Tab', 'accordion-for-wp' ),
			'new_item'           => esc_html__( 'New  Tab', 'accordion-for-wp' ),
			'edit_item'          => esc_html__( 'Edit  Tab', 'accordion-for-wp' ),
			'view_item'          => esc_html__( 'View  Tab', 'accordion-for-wp' ),
			'all_items'          => esc_html__( 'All  Tabs', 'accordion-for-wp' ),
			'search_items'       => esc_html__( 'Search  Tabs', 'accordion-for-wp' ),
			'parent_item_colon'  => esc_html__( 'Parent  Tabs:', 'accordion-for-wp' ),
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
			'rewrite'            => array( 'slug' => 'afwp-tabs' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'menu_icon'           => 'dashicons-index-card',
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
			'show_in_menu' => 'edit.php?post_type=accordion-for-wp'
		);

		register_post_type( 'afwp-tabs', $args );
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

new AFWP_TAB_For_WP_Post_Type();
