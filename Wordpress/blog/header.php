<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta http-equiv="Content-Type" content="text/html" />
    <meta charset="<?php bloginfo('charset') ?>">
    <meta name="viewport" content="width=device-width">

<?php wp_head(); ?>

</head>
<body <?php body_class() ?>>

<div id="templatemo_header_wrapper">
    <div id="templatemo_header">
        <div id="site_title">
            <?php the_custom_logo( $blog_id ); ?>
                <span>free blog template</span>
        </div>

        <div id="templatemo_rss">
            <a href="" target="_parent">SUBSCRIBE<br /><span>OUR FEED</span></a>
        </div>

    </div> <!-- end of header -->

    <div id="templatemo_menu">
        <?php
            wp_nav_menu([
                'theme_location' => 'top',
                'container' => 'null',
                'items-wrap' => '<ul>%3$s</ul>',
            ])
        ?>

    </div> <!-- end of templatemo_menu -->

</div> <!-- end of header wrapper -->
