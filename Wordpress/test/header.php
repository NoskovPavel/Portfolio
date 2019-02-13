<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta <?php bloginfo('charset'); ?>>
    <meta name="viewport" content="width=device-width">
<?php wp_head(); ?>
</head>
<body>
<div  class="wrapper">
    <header>
        <div class="header-top clearfix">
            <a class="logo" href="<?php echo home_url() ?>"><?php bloginfo('name'); ?></a>
            <nav class="topMenu">
                <div class="menu-button">MENU</div>
                <?php
                    wp_nav_menu([
                            'theme_location' => 'top',
                            'container' => null,
                            'items_wrap' => '<ul>%3$s</ul>'
                    ])
                ?>
            </nav>
        </div>
        <div  class="header-bottom">
            <span>Wood Design is a modern web & graphic design studio in Europe. We create beautiful things for web and print. You can see our great work examples in <a href="#">Portfolio</a>. If you need a professional design services <a href="#">Contact</a> us. We would love to work with you.</span>
        </div>
    </header>
    <div  class="content-wrapper clearfix">
