<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 02.03.2018
 * Time: 10:03
 */

add_filter('show_admin_bar', '__return_false');

add_action('wp_enqueue_scripts', function(){
    wp_enqueue_style('test_main', get_stylesheet_uri());
    wp_enqueue_script('test-script-main', get_template_directory_uri().'/assets/js/script.js', [], null, true);
});

add_action('after_setup_theme', function(){
   register_nav_menu('top', 'Для шапки меню');

    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
});

add_action('widgets_init', function(){
    register_sidebar([
            'name' => 'Sidebar Right',
            'id' => 'sidebar-right',
            'description' => 'Правая колонка',
            'before_widget' => '<div class="widget %2$s">',
            'after_widget'  => "</div>\n"
        ]);
});
?>
