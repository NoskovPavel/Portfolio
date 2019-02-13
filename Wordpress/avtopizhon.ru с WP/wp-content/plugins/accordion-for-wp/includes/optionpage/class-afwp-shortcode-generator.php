<?php
class AFWP_Shortcode_Generator{

    /**
     * Start up
     */
    public function __construct(){

        add_action( 'admin_menu', array( $this, 'afwp_admin_menu' ) );

        /*if ((current_user_can('edit_posts') || current_user_can('edit_pages')) && get_user_option('rich_editing')) {
            add_filter('mce_external_plugins', array($this, 'add_tinymce_plugin'));
            add_filter('mce_buttons', array($this, 'register_buttons'));
        }*/

    }

    public function register_buttons( $buttons ) {
       array_push( $buttons, 'separator', 'myplugins' );
       return $buttons;
    }

    public function add_tinymce_plugin($context){
        global $pagenow;

        if ( in_array( $pagenow, array( 'post.php', 'page.php', 'post-new.php', 'post-edit.php' ) ) ) {
            $context .= '<button id="insert-accordion-button" type="button" data-editor="content" class="button insert-accordion add_accordion">';
            $context .= '<span class="wp-media-buttons-icon dashicons-before dashicons-index-card">&nbsp;</span>';
            $context .= esc_html__('Add Accordion', 'accordion-for-wp');
            $context .= '</button>';
        }

        return $context;
    }

    /**
     * Add Submenu page
     */
    public function afwp_admin_menu(){
        add_submenu_page(
            'edit.php?post_type=accordion-for-wp',
            esc_html__('Accordion WordPress Shortcode Generator', 'accordion-for-wp'),
            esc_html__('Shortcode Generator', 'accordion-for-wp'),
            'manage_options',
            'afwp-shortcode-generator',
            array( $this, 'afwp_add_submenu_page' )
        );
    }

    /**
     * Options page callback
     */
    public function afwp_add_submenu_page(){

        // Set class property
        ?>
        <div class="wrap">
            <h1><?php esc_html_e('Generate accordion shortcode from here.', 'accordion-for-wp'); ?></h1>
            <div id="poststuff">
                <div id="post-body" class="metabox-holder columns-2">
                    <div id="post-body-content">
                        <div class="afwp_generater_wraper">
                            <p><?php esc_html_e('Change your settings from here and generate shortcode than just copy this shortcode and paste it to text editor.', 'accordion-for-wp'); ?></p>
                            <code class="afwp_generated_shortcode">[afwp_accordion post_type="post" posts_per_page="5" order="date" perm="readable" offset="0" afwp_active_item="1" afwp_template="default" afwp_style="vertical" afwp_dropdown_icon="fa-desktop" afwp_active_dp_icon="fa-desktop"]</code>
                            <form method="post" id="afwp_shortcode_generator_form" class="afwp-tab-wraper">
                                <?php
                                
                                $active_tab_type = 'general';
                                
                                $post_types = get_post_types( array('public' => true ) );
                                $afwp_tab_or_accordion = array(
                                    'afwp_tab'=>esc_html__('Tabs', 'accordion-for-wp'),
                                    'afwp_accordion'=>esc_html__('Accordion', 'accordion-for-wp'),
                                );
                                $afwp_order = array(
                                    'DESC' => esc_html__('Descending', 'accordion-for-wp'),
                                    'ASC' => esc_html__('Ascending', 'accordion-for-wp'),
                                );
                                $afwp_order_by = array(
                                    'date' => esc_html__('Date', 'accordion-for-wp'),
                                    'title' => esc_html__('Title', 'accordion-for-wp'),
                                    'ID' => esc_html__('ID', 'accordion-for-wp'),
                                    'author' => esc_html__('Author', 'accordion-for-wp'),
                                    'modified' => esc_html__('Modified', 'accordion-for-wp'),
                                    'rand' => esc_html__('Random', 'accordion-for-wp'),
                                    'comment_count' => esc_html__('Comment Count', 'accordion-for-wp'),
                                );
                                $afwp_permission = array(
                                    'readable' => esc_html__('Readable', 'accordion-for-wp'),
                                    'editable' => esc_html__('Editable', 'accordion-for-wp'),
                                );
                                $afwp_content_type = array(
                                    'excerpt'   => esc_html__('Short Description', 'accordion-for-wp'),
                                    'content'   => esc_html__('Full Content', 'accordion-for-wp'),
                                );

                                $afwp_template = afwp_accordion_templates();
                                $afwp_style = afwp_accordion_styles();

                                $list_all_tabs = array(
                                    'general'   =>  array(
                                        'id'    => 'afwp_settings_general',
                                        'label' => esc_html__('General', 'accordion-for-wp'),
                                        'fields'=> array(
                                            array(
                                                'type'      => 'select',
                                                'default'   => 'afwp_accordion',
                                                'label'     => esc_html__('Type', 'accordion-for-wp'),
                                                'id'        => 'afwp_tab_or_accordion',
                                                'default'   => 'afwp_accordion',
                                                'choices'   => $afwp_tab_or_accordion,
                                            ),
                                            array(
                                                'type'      => 'select',
                                                'default'   => 'post',
                                                'label'     => esc_html__('Post Type', 'accordion-for-wp'),
                                                'id'        => 'post_type',
                                                'choices'   => $post_types,
                                            ),
                                            array(
                                                'type'      => 'number',
                                                'default'   => '5',
                                                'label'     => esc_html__('Posts per page', 'accordion-for-wp'),
                                                'id'        => 'posts_per_page',
                                            ),
                                            array(
                                                'type'      => 'select',
                                                'default'   => 'DESC',
                                                'label'     => esc_html__('Order', 'accordion-for-wp'),
                                                'id'        => 'order',
                                                'choices'   => $afwp_order,
                                            ),
                                            array(
                                                'type'      => 'select',
                                                'default'   => 'date',
                                                'label'     => esc_html__('Order By', 'accordion-for-wp'),
                                                'id'        => 'order',
                                                'choices'   => $afwp_order_by,
                                            ),
                                            array(
                                                'type'      => 'select',
                                                'default'   => 'readable',
                                                'label'     => esc_html__('Permission', 'accordion-for-wp'),
                                                'id'        => 'perm',
                                                'choices'   => $afwp_permission,
                                            ),
                                            array(
                                                'type'      => 'number',
                                                'default'   => '0',
                                                'label'     => esc_html__('Offset', 'accordion-for-wp'),
                                                'id'        => 'offset',
                                            ),
                                            array(
                                                'type'      => 'select',
                                                'default'   => '0',
                                                'label'     => esc_html__('Content Type:', 'accordion-for-wp'),
                                                'id'        => 'afwp_content_type',
                                                'choices'   => $afwp_content_type,
                                            ),
                                        ),
                                    ),
                                    'layout'    =>  array(
                                        'id'    => 'afwp_settings_layout',
                                        'label' => esc_html__('Layout', 'accordion-for-wp'),
                                        'fields'=> array(
                                            array(
                                                'type'      => 'number',
                                                'label'     => esc_html__('Active Item', 'accordion-for-wp'),
                                                'id'        => 'afwp_active_item',
                                                'default'   => '1',
                                            ),
                                            array(
                                                'type'      => 'select',
                                                'label'     => esc_html__('Template', 'accordion-for-wp'),
                                                'id'        => 'afwp_template',
                                                'default'   => '',
                                                'choices'   => $afwp_template,
                                            ),
                                            array(
                                                'type'      => 'select',
                                                'label'     => esc_html__('Style', 'accordion-for-wp'),
                                                'id'        => 'afwp_style',
                                                'default'   => '',
                                                'choices'   => $afwp_style,
                                            ),
                                        ),
                                    ),
                                    'design'    =>  array(
                                        'id'    => 'afwp_settings_design',
                                        'label' => esc_html__('Design', 'accordion-for-wp'),
                                        'fields'=> array(
                                            array(
                                                'type'      => 'icon',
                                                'label'     => esc_html__('Title Icon', 'accordion-for-wp'),
                                                'id'        => 'afwp_dropdown_icon',
                                                'default'   => 'fa-desktop',
                                            ),
                                            array(
                                                'type'      => 'icon',
                                                'label'     => esc_html__('Active Title Icon', 'accordion-for-wp'),
                                                'id'        => 'afwp_active_dp_icon',
                                                'default'   => 'fa-desktop',
                                            ),
                                            array(
                                                'type'      => 'color',
                                                'label'     => esc_html__('Title Color', 'accordion-for-wp'),
                                                'id'        => 'afwp_title_color',
                                                'default'   => '',
                                            ),
                                            array(
                                                'type'      => 'color',
                                                'label'     => esc_html__('Title Background', 'accordion-for-wp'),
                                                'id'        => 'afwp_title_background',
                                                'default'   => '',
                                            ),
                                            array(
                                                'type'      => 'color',
                                                'label'     => esc_html__('Title Content Color', 'accordion-for-wp'),
                                                'id'        => 'afwp_content_color',
                                                'default'   => '',
                                            ),
                                            array(
                                                'type'      => 'color',
                                                'label'     => esc_html__('Content Background', 'accordion-for-wp'),
                                                'id'        => 'afwp_content_background',
                                                'default'   => '',
                                            ),
                                        ),
                                    ),
                                );
                            ?>
                            <h5 class="afwp-tab-list nav-tab-wrapper">
                                <?php foreach($list_all_tabs as $tab_key=>$tab_details){ ?>
                                    <label for="tab_<?php echo esc_attr($tab_details['id']); ?>" data-id="#<?php echo esc_attr($tab_details['id']); ?>" class="nav-tab <?php echo ($tab_key == $active_tab_type) ? 'nav-tab-active' : ''; ?>"><?php echo sanitize_text_field($tab_details['label']); ?></label>
                                <?php } ?>
                                <label for="afwp_generate_button" class="button-primary" style="padding: 5px 10px; height:auto; margin-left: .5em; border:none;"><?php esc_html_e('Generate Shortcode', 'accordion-for-wp'); ?></label>
                            </h5>
                            <div class="afwp-tab-content-wraper">
                                <?php foreach($list_all_tabs as $tab_key=>$tab_details){ ?>
                                    <div id="<?php echo esc_attr($list_all_tabs[$tab_key]['id']); ?>" class="afwp-tab-content <?php echo ($active_tab_type==$tab_key) ? 'afwp-content-active' : ''; ?>">
                                        <table class="form-table">
                                            <?php 
                                            $tabs_fields = $tab_details['fields']; 
                                            foreach($tabs_fields as $fields_details){
                                                $field_type = $fields_details['type'];
                                                $field_id = $fields_details['id'];
                                                $field_label = $fields_details['label'];
                                                $field_default = $fields_details['default'];
                                                ?>
                                                    <tr class="afwp-field-container">
                                                        <th>
                                                            <label for="<?php echo esc_attr($field_id); ?>"><?php echo esc_attr($field_label); ?></label>
                                                        </th>
                                                        <td>
                                                            <?php 
                                                                switch ($field_type){
                                                                    case 'select':
                                                                        $field_choices = $fields_details['choices'];
                                                                        ?>
                                                                            <select name="<?php echo esc_attr($field_id); ?>" id="<?php echo esc_attr($field_id); ?>" class="widefat">
                                                                                <?php 
                                                                                     foreach($field_choices as $field_value=>$field_label){
                                                                                        ?>
                                                                                            <option <?php selected($field_default, $field_value); ?> value="<?php echo $field_value; ?>"><?php echo $field_label; ?></option>
                                                                                        <?php
                                                                                     }

                                                                                ?>
                                                                            </select>
                                                                        <?php
                                                                        break;
                                                                    
                                                                    case 'number':
                                                                        ?>
                                                                        <input name="<?php echo esc_attr($field_id); ?>" id="<?php echo esc_attr($field_id); ?>" class="widefat" type="number" value="<?php echo $field_default; ?>"/>
                                                                        <?php
                                                                        break;
                                                                    case 'icon':
                                                                        ?>
                                                                        <input name="<?php echo esc_attr($field_id); ?>" id="<?php echo esc_attr($field_id); ?>" class="widefat afwp_icon_picker" type="text" value="<?php echo $field_default; ?>"/>
                                                                        <?php
                                                                        break;
                                                                     case 'color':
                                                                        ?>
                                                                        <input name="<?php echo esc_attr($field_id); ?>" id="<?php echo esc_attr($field_id); ?>" class="widefat afwp_color_picker" type="text" value="<?php echo $field_default; ?>"/>
                                                                        <?php
                                                                        break;

                                                                    default:
                                                                        ?>
                                                                        <p><?php esc_html_e("There is no ".$field_type." field type exist", 'accordion-for-wp'); ?></p>
                                                                        <?php
                                                                        break;

                                                                }
                                                            ?>
                                                            
                                                        </td>
                                                    </tr>
                                                <?php
                                            }
                                            ?>
                                        </table>
                                    </div>
                                <?php } ?>
                                <hr/>
                                <input type="button" id="afwp_generate_button" class="button button-primary" value="<?php esc_html_e('Generate Shortcode', 'accordion-for-wp'); ?>" />
                                <hr/>
                            </div>
                                
                            </form>
                            <code class="afwp_generated_shortcode">[afwp_accordion post_type="post" posts_per_page="5" order="date" perm="readable" offset="0" afwp_active_item="1" afwp_template="default" afwp_style="vertical" afwp_dropdown_icon="fa-desktop" afwp_active_dp_icon="fa-desktop"]</code>
                        </div>
                    </div><!-- /post-body-content -->
                    <div id="postbox-container-1" class="postbox-container ">
                        <h2 class="afwp-top-title"><?php esc_html_e('Our Free Themes', 'accordion-for-wp'); ?></h2>
                        <?php 
                            $themeegg_themes = array(
                                array(
                                    'name'=> esc_html__('EggNews - Magazine Theme', 'accordion-for-wp'),
                                    'theme_url'=> 'https://themeegg.com/downloads/eggnews/',
                                    'demo_url'=> 'https://demo.themeegg.com/themes/eggnews/',
                                    'docs_url'=> 'https://docs.themeegg.com/docs/eggnews/',
                                    'forum_url'=> 'https://themeegg.com/support-forum/forum/eggnews-wordpress-theme/',
                                    'thumbnail_url'=>'https://demo.themeegg.com/themes/eggnews/wp-content/themes/eggnews/screenshot.png',
                                    'rate_url'=> 'https://wordpress.org/support/theme/eggnews/reviews/?filter=5',
                                    'download_url'=> 'https://wordpress.org/themes/eggnews/',
                                ),
                                array(
                                    'name'=> esc_html__('Miteri - Blog Theme', 'accordion-for-wp'),
                                    'theme_url'=> 'https://themeegg.com/downloads/miteri/',
                                    'demo_url'=> 'https://demo.themeegg.com/themes/miteri/',
                                    'docs_url'=> 'https://docs.themeegg.com/docs/miteri/',
                                    'forum_url'=> 'https://themeegg.com/support-forum/forum/miteri-wordpress-theme/',
                                    'thumbnail_url'=>'https://demo.themeegg.com/themes/miteri/wp-content/themes/miteri/screenshot.png',
                                    'rate_url'=> 'https://wordpress.org/support/theme/miteri/reviews/?filter=5',
                                    'download_url'=> 'https://wordpress.org/themes/miteri/',
                                ),
                                array(
                                    'name'=> esc_html__('Education Master - Educational Theme', 'accordion-for-wp'),
                                    'theme_url'=> 'https://themeegg.com/downloads/education-master/',
                                    'demo_url'=> 'https://demo.themeegg.com/themes/education-master/',
                                    'docs_url'=> 'https://docs.themeegg.com/docs/education-master/',
                                    'forum_url'=> 'https://themeegg.com/support-forum/forum/education-master-wordpress-theme/',
                                    'thumbnail_url'=>'https://demo.themeegg.com/themes/education-master/wp-content/themes/education-master/screenshot.png',
                                    'rate_url'=> 'https://wordpress.org/support/theme/education-master/reviews/?filter=5',
                                    'download_url'=> 'https://wordpress.org/themes/education-master/',
                                ),
                            );
                            foreach ($themeegg_themes as $single_theme) {
                                ?>
                                <div id="submitdiv" class="postbox afwp-postbox">
                                    <h2 class="hndle ui-sortable-handle"><span><?php echo esc_attr($single_theme['name']); ?></span></h2>
                                    <div class="inside">
                                        <div class="submitbox">
                                            <div class="afwp-minor-publishing">
                                                <a href="<?php echo  esc_attr($single_theme['theme_url']); ?>" title="<?php echo  esc_attr($single_theme['name']); ?>" target="_blank">
                                                    <img src="<?php echo  esc_attr($single_theme['thumbnail_url']); ?>" alt="<?php echo  esc_attr($single_theme['name']); ?>"/>
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

}

if( is_admin() )
    $afwp_settings_page = new AFWP_Shortcode_Generator();