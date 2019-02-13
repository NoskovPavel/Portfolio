<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset')?>">
		<meta name="viewport" content="width=device-width">
		<?php wp_head(); ?>
	</head>
	<body <?php body_class() ?>>
		<div  class="wrapper">
			<header>
				<div class="header-top clearfix">
					<a href="<?php echo home_url() ?>" class="logo"><?php bloginfo('name')?></a>
					<nav class="topmenu">					
						<?php 
							wp_nav_menu([
								'theme_location' => 'top',
								'container' => null,
								'items_wrap' => '<ul>%3$s</ul>'
							]);
						?>
					</nav>
				</div>				
			</header>
			<div  class="content-wrapper clearfix">