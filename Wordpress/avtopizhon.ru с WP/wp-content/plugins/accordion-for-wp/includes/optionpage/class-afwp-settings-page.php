<?php
class AFWP_Settings_Page{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct(){

        //add_action( 'admin_menu', array( $this, 'afwp_admin_menu' ) );
        //add_action( 'admin_init', array( $this, 'afwp_admin_init' ) );

    }


    /**
     * Add Submenu page
     */
    public function afwp_admin_menu(){
        add_submenu_page(
            'edit.php?post_type=accordion-for-wp',
            esc_html__('Accordion WordPress Settings', 'accordion-for-wp'),
            esc_html__('Global Settings', 'accordion-for-wp'),
            'manage_options',
            'afwp-settings',
            array( $this, 'afwp_add_submenu_page' )
        );
    }

    /**
     * Options page callback
     */
    public function afwp_add_submenu_page(){

        // Set class property
        $this->options = get_option( 'afwp_global_settings' );
        ?>
        <div class="wrap">
            <h1><?php esc_html_e('Accordion for WordPress Settings  ', 'accordion-for-wp'); ?></h1>
            <div id="poststuff">
                <div id="post-body" class="metabox-holder columns-2">
                    <div id="post-body-content" style="position: relative;">
                        <form class="afwp-tab-wraper" method="post" action="options.php">
                            <?php
                                $active_tab_type = isset($this->options['active_tab_type']) ? esc_attr($this->options['active_tab_type']) : 'general';
                                $list_all_tabs = array(
                                    'general'   =>  array(
                                        'id'    => 'afwp_settings_general',
                                        'label' => esc_html__('General', 'accordion-for-wp'),
                                    ),
                                    'layout'    =>  array(
                                        'id'    => 'afwp_settings_layout',
                                        'label' => esc_html__('Layout', 'accordion-for-wp'),
                                    ),
                                    'design'    =>  array(
                                        'id'    => 'afwp_settings_design',
                                        'label' => esc_html__('Design', 'accordion-for-wp'),
                                    ),
                                );
                            ?>
                            <h5 class="afwp-tab-list nav-tab-wrapper">
                                <?php foreach($list_all_tabs as $tab_key=>$tab_details){ ?>
                                    <label for="tab_<?php echo esc_attr($tab_details['id']); ?>" data-id="#<?php echo esc_attr($tab_details['id']); ?>" class="nav-tab <?php echo ($tab_key == $active_tab_type) ? 'nav-tab-active' : ''; ?>"><?php echo sanitize_text_field($tab_details['label']); ?><input id="tab_<?php echo esc_attr($tab_details['id']); ?>" type="radio" name="afwp_global_settings[active_tab_type]" value="<?php echo esc_attr($tab_key); ?>" <?php checked($active_tab_type, $tab_key); ?> class="afwp-hidden"/></label>
                                <?php } ?>
                                <label for="submit" class="button-primary" style="padding: 5px 10px; height:auto; margin-left: .5em; border:none;">Save Changes</label>
                            </h5>
                            <div class="afwp-tab-content-wraper" >
                                <?php settings_fields( 'afwp_global_setting_group' ); ?>
                                <?php foreach($list_all_tabs as $tab_key=>$tab_details){ ?>
                                    <div id="<?php echo esc_attr($list_all_tabs[$tab_key]['id']); ?>" class="afwp-tab-content <?php echo ($active_tab_type==$tab_key) ? 'afwp-content-active' : ''; ?>">
                                        <?php do_settings_sections( 'afwp_settings_'.$tab_key.'_tab' ); ?>
                                    </div>
                                <?php } ?>
                                <?php submit_button(); ?>
                            </div>
                        </form>
                    </div><!-- /post-body-content -->
                    <div id="postbox-container-1" class="postbox-container">
                        <h2 class="afwp-top-title"><?php esc_html_e('Our Free Plugins', 'accordion-for-wp'); ?></h2>
                        <?php 
                            $themeegg_themes = array(
                                array(
                                    'name'=> esc_html__('Accordion For WordPress - Plugin', 'accordion-for-wp'),
                                    'theme_url'=> 'https://themeegg.com/downloads/accordion-for-wp/',
                                    'demo_url'=> 'https://demo.themeegg.com/plugins/accordion-for-wp/',
                                    'docs_url'=> 'https://docs.themeegg.com/docs/accordion-for-wp/',
                                    'forum_url'=> 'https://themeegg.com/support-forum/forum/accordion-for-wordpress-plugin/',
                                    'thumbnail_url'=>'https://ps.w.org/accordion-for-wp/assets/banner-772x250.png?rev=1717682',
                                    'rate_url'=> 'https://wordpress.org/support/plugin/accordion-for-wp/reviews/?filter=5',
                                    'download_url'=> 'https://wordpress.org/plugins/accordion-for-wp/',
                                ),
                                array(
                                    'name'=> esc_html__('Twitter API Master - Plugin', 'accordion-for-wp'),
                                    'theme_url'=> 'https://themeegg.com/downloads/teg-twitter-api/',
                                    'demo_url'=> 'https://themeegg.com/downloads/teg-twitter-api/',
                                    'docs_url'=> 'https://docs.themeegg.com/docs/teg-twitter-api/',
                                    'forum_url'=> 'https://themeegg.com/support-forum/forum/twitter-api-master-plugin/',
                                    'thumbnail_url'=>'https://ps.w.org/teg-twitter-api/assets/banner-772x250.png?rev=1717682',
                                    'rate_url'=> 'https://wordpress.org/support/plugin/teg-twitter-api/reviews/?filter=5',
                                    'download_url'=> 'https://wordpress.org/plugins/teg-twitter-api/',
                                ),
                            );
                            foreach ($themeegg_themes as $single_theme){
                                ?>
                                <div id="submitdiv" class="postbox afwp-postbox">
                                    <h2 class="hndle ui-sortable-handle"><span><?php echo esc_attr($single_theme['name']); ?></span></h2>
                                    <div class="inside">
                                        <div class="submitbox">
                                            <div class="afwp-minor-publishing">
                                                <a href="<?php echo esc_attr($single_theme['theme_url']); ?>" title="<?php echo esc_attr($single_theme['name']); ?>" target="_blank">
                                                    <img src="<?php echo esc_attr($single_theme['thumbnail_url']); ?>" alt="<?php echo  esc_attr($single_theme['name']); ?>"/>
                                                </a>
                                            </div>
                                            <div class="afwp-bottom-actions">
                                                <a href="<?php echo esc_attr($single_theme['demo_url']); ?>" target="_blank" class="btn button-primary"><?php echo esc_html_e('Demo', 'accordion-for-wp'); ?></a>
                                                <a href="<?php echo  esc_attr($single_theme['docs_url']); ?>" target="_blank" class="btn button-primary"><?php echo esc_html_e('Docs', 'accordion-for-wp'); ?></a>
                                                <a href="<?php echo  esc_attr($single_theme['forum_url']); ?>" target="_blank" class="btn button-primary"><?php echo esc_html_e('Support', 'accordion-for-wp'); ?></a>
                                                <a href="<?php echo  esc_attr($single_theme['rate_url']); ?>" target="_blank" class="btn button-primary"><?php echo esc_html_e('Rating', 'accordion-for-wp'); ?></a>
                                                <a href="<?php echo  esc_attr($single_theme['download_url']); ?>" target="_blank" class="btn button-primary"><?php echo esc_html_e('Download', 'accordion-for-wp'); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        ?>
                    </div>
                </div><!-- /post-body -->
                <br class="clear">
            </div>
        </div>
        <?php

    }

    /**
     * Register and add settings
     */
    public function afwp_admin_init()
    {
        register_setting(
            'afwp_global_setting_group', // Option group
            'afwp_global_settings', // Option name
            array( $this, 'global_settings_sanitize' ) // Sanitize
        );

        add_settings_section(
            'afwp_settings_general_id', // ID
            esc_html__('General Settings', 'accordion-for-wp'), // Title
            array( $this, 'print_section_info' ), // Callback
            'afwp_settings_general_tab' // Page
        );

        add_settings_field(
            'id_number', // ID
            esc_html__('ID Number', 'accordion-for-wp'), // Title
            array( $this, 'afwp_checkbox_callback' ), // Callback
            'afwp_settings_general_tab', // Page
            'afwp_settings_general_id', // Section
            array(
                ''
            ) //Arguments
        );

        add_settings_field(
            'title',
            'Title',
            array( $this, 'title_callback' ),
            'afwp_settings_general_tab',
            'afwp_settings_general_id'
        );
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function global_settings_sanitize( $input )
    {
        $new_input = array();

        if( isset( $input['active_tab_type'] ) )
            $new_input['active_tab_type'] = sanitize_text_field( $input['active_tab_type'] );

        if( isset( $input['id_number'] ) )
            $new_input['id_number'] = absint( $input['id_number'] );

        if( isset( $input['title'] ) )
            $new_input['title'] = sanitize_text_field( $input['title'] );

        return $new_input;
    }

    /**
     * Print the Section text
     */
    public function print_tab_title_info(){

        ?>
        <p><?php esc_html_e('You can change general settings from here.', 'accordion-for-wp'); ?></p>
        <?php

    }

    /**
     * Print the Section text
     */
    public function print_section_info(){

        ?>
        <p><?php esc_html_e('You can change general settings from here.', 'accordion-for-wp'); ?></p>
        <?php

    }

    /**
     * Get the settings option array and print one of its values
     */
    public function afwp_checkbox_callback($args){

        printf(
            '<input type="text" id="id_number" name="afwp_global_settings[id_number]" value="%s" />',
            isset( $this->options['id_number'] ) ? esc_attr( $this->options['id_number']) : ''
        );

    }

    /**
     * Get the settings option array and print one of its values
     */
    public function title_callback()
    {
        printf(
            '<input type="text" id="title" name="afwp_global_settings[title]" value="%s" />',
            isset( $this->options['title'] ) ? esc_attr( $this->options['title']) : ''
        );
    }
}

if( is_admin() )
    $afwp_settings_page = new AFWP_Settings_Page();