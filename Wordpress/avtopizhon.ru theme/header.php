<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta http-equiv="Content-Type" content="text/html" />
    <meta charset="<?php bloginfo('charset') ?>">
    <meta name="viewport" content="width=device-width">
    <title>AVTOPIZHON</title>
    <meta name="keywords" content="автосигнализация, автомагнитола, качество, автозапуск, пенза">
    <meta name="description" content="Быстро, качественного и недорого установим автосигнализацию и автомузыку в Пензе">	
     <link rel="shortcut icon" href="<?=get_template_directory_uri().'/assets/img/car.ico'?>"type="image/x-icon">
</head>
<body>
<div class="container">
    <div class="container__wrapper">
        <header>		
            <div class="registration">                
				<div class="registration__callback">	
					<label class="btn" for="modal-1">
						Заказать обратный звонок
						<img class="btn__img" src="<?php echo get_template_directory_uri().'/assets/img/icon/phone.svg' ?>">
                    </label>
					<div class="modal">
						 <input class="modal-open" id="modal-1" type="checkbox" hidden>
						 <div class="modal-wrap" aria-hidden="true" role="dialog">
							 <label class="modal-overlay" for="modal-1"></label>
							 <div class="modal-dialog">
								 <div class="modal-header">
									 <h3>Быстрая обратная связь </h3>
									 <p>Если у Вас возникли вопросы, просьбы или вы хотите сделать заказ... </p>
									 <label class="btn-close" for="modal-1" aria-hidden="true">×</label>
								 </div>
								 <div class="modal-body">
									<center><?php echo do_shortcode('[contact-form-7 id="55" title="Contact us"]'); ?></center>
								 </div>
							 </div>
						 </div>
					</div>
                </div>  
				<div class="registration__quote">					
                    <blockquote>
                      <p align="right">Жизнь - это то, что с тобой происходит, пока ты строишь планы...</p>                      
                    </blockquote>                                  
				</div>
			</div>
            <div class="header_bottom">
                <div class="header_bottom_logo">
                    <img usemap="#map" src="<?php echo get_template_directory_uri().'/assets/img/logo.png' ?>" class="logo-pic" title="Автопижон" alt="Автопижон">
                    <map name="map">
                        <area href="<?php echo get_home_url(); ?>"  shape="poly"  coords="60,50,100,20,140,12,200,15,250,45,260,55,270,100,250,140,170,170,80,150,40,95">
                    </map></p>
                </div>
                <div class="header_bottom_search">
                    <div class="header_bottom_search_phone">
                        <div class="header_bottom_search_phone-time">пн - сб с 9:00 до 18:00</div>
                        <div class="header_bottom_search_phone-number">
                            <a href="tel:762367">
                                <img src="<?php echo get_template_directory_uri()."/assets/img/icon/phone-without-circle.svg" ?>" alt="Позвонить">
                                76 - 23 - 67
                            </a>
                        </div>
                    </div>
                    <div class="header_bottom_search-search">
						<form action="<?php bloginfo( 'url' ); ?>" method="get">
							<input type="text" name="s" placeholder="Поиск" value=""/>
							<input type="submit" value=""/>
						</form> 
                    </div>
                </div>
                <div class="header_bottom_cart">
                    <a href="<?php echo get_page_link('177');?>">
                        <div class="header_bottom_cart-cart">
                            <div class="header_bottom_cart-cart-count">
                                <?php echo get_user_favorites_count(); ?>
                            </div>
                            <p>Корзина</p>
                            <img src="<?php echo get_template_directory_uri().'/assets/img/icon/cart.svg' ?>">
                        </div>
                    </a>
                </div>
            </div>
            <div class="navigation">
                <nav role="navigation">
					<?php
						wp_nav_menu([
							'theme_location' => 'top',
							'container' => 'null',
							'items-wrap' => '<ul>%3$s</ul>',
						])
					?>                      
                </nav>
				<aside class="menu-accordion">
					<?php dynamic_sidebar('sidebar-accordion') ?>
				</aside>
            </div>
            <?php wp_head(); ?>
        </header>