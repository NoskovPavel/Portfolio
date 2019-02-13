<?php get_header(); ?>
<main> 
	<section class="post">
		<div class="postsFlow clearfix">
            <?php the_post(); ?>
            <article class="postItem-full">
                <h2><?php the_title() ?></h2>
                <div class="category__img"><?php the_post_thumbnail('medium') ?></div>
                <div class="category__buy">
                    <?php if (!in_category('Новости') && !in_category('Отзывы')) : ?>
                        <div id="1" class="category__price">
                            <?php echo CFS()-> get('price')." руб."; ?>                         
                        </div>                        
                    <?php endif; ?>
                    <?php if (!in_category('Новости') && !in_category('Отзывы')) : ?>
                        <div class="category__available">В наличии</div>
                    <?php endif; ?>
                    <div class="registration__callback">
                        <label class="btn_news" for="modal-1" data-title-service="<?php the_title(); ?>">
                            Заказать установку
                        </label>
                    </div>
                    <div class="registration__favourites">
                        <?= get_favorites_button() ?>
                    </div>
                    <div>
                        <p>
                            
                        </p>
                    </div>
                    <div class="registration__all-favourites">
                        <div class="header_bottom_cart">
                            <a href="<?php echo get_page_link('177');?>">
                                <div class="header_bottom_cart-cart">
                                    <div class="header_bottom_cart-cart-count">
                                        <?php echo get_user_favorites_count(); ?>
                                    </div>
                                    <p>Корзина</p>
                                    <img src="<?php echo get_template_directory_uri().'/assets/img/icon/cart.svg' ?>" alt="Корзина">
                                </div>
                            </a>
                        </div>
                    </div>
                </div> 
                <div class="category__clearfix"></div>               
                <div <?php  if (in_category('Новости'))
                         echo 'style="font-size : 150%; margin-top:20px;"' ?>>                       
                <?php the_content() ?>                    
                </div>
            </article>
        </div>
	</section>
	<section class="about anchor" id="about">
        <h2 class="section-title">О нас</h2>
        <div class="about__items">
            <div class="about__img"><img class="about__img_img" src="<?php echo get_template_directory_uri().'/assets/img/about.jpg' ?>"  alt="Автопижон"></div>
            <div class="about__text">«AvtoPizhon», был образован в 2015 году, в попытке сделать удобной и комфортной покупку и установку дополнительного автомобильного оборудования. За годы существования организации, в процессе внутренних преобразований был значительно расширен ассортимент предлагаемых товаров и качество оказываемых услуг. На данный момент мы предоставляем услуги по тонировке стекол автомобилей, а также установке, настройке и ремонту дополнительного автомобильного оборудования. </div>
        </div>
    </section>
    <section class="contact anchor" id="contact">
        <h2 class="section-title">Контакты</h2>
        <div class="contact__items">
            <div class="contact__map">
                <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Ac5f21a11e9a83b62aa9655a6b7bfcd7e9a41582ba5f21c4842d56566092cd41a&amp;width=100%25&amp;height=400&amp;lang=ru_RU&amp;scroll=true"></script>
            </div>
            <div class="contact__inf">
                <div class="contact__text">
                    <p class="contact__title">Автопижон</p>
                    <p class="contact__name">ИП Пижонков И. С.</p>
                    <address>г. Пенза, ул. Литвинова, 20а к3</address>
                    <address>
                        <a href="tel:762367">
                            <img src="<?php echo get_template_directory_uri().'/assets/img/icon/phone-without-circle.svg' ?>" title="Позвонить" alt="Позвонить">
                            76 - 23 - 67
                        </a>
                    </address>
                    <div class="social">
                        <div class="social__title">Мы в VK:</div>
                        <div class="social__icon">
                            <a href="https://vk.com/avtopizhon" target="_blank"><img src="<?php echo get_template_directory_uri().'/assets/img/icon/vk.svg' ?>" title="Мы в контакте" alt="Мы в контакте"></a>
                        </div>
                    </div>
                </div>
                <div class="contact__form">Форма обратной связи</div>
            </div>
        </div>
    </section>
</main>
</div>
<div class="empty"></div>
</div>


<?php get_footer(); ?>
