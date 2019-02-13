
<?php get_header(); ?>

<main>
	<section class="category">
			<div class="category__title"> 
				<?php if( is_category() ) echo get_queried_object()->name; ?>
			</div>
			<?php if ( have_posts() ) : ?> 			
				<?php while ( have_posts() ) : the_post(); ?>
					<div class="category__item">
						<a href="<?php the_permalink() ?>" rel="bookmark">
							<h2>
								<?php the_title(); ?>								
							</h2>	
							<div class="category__img"><?php the_post_thumbnail('thumbnail') ?></div>
							<div class="category__buy">
								<?php if (!in_category('Новости') && !in_category('Отзывы')) : ?>
									<div class="category__price"><?php echo CFS()-> get('price')." руб."; ?></div>
								<?php endif; ?>
								<div class="registration__callback">
									<label class="btn_news" for="modal-1" data-title-service="<?php the_title(); ?>">
										Заказать установку
									</label>
								</div>
								<?php if (!in_category('Новости') && !in_category('Отзывы')) : ?>
									<div class="category__available">В наличии</div>
								<?php endif; ?>
							</div>
							<div class="category__clearfix"></div>			 
							<div class="category__description">
								<?php the_excerpt('new_excerpt_length', 5); ?> 													
							</div>
						</a>
					</div>	 
				<?php endwhile; 	 
			else: ?>
				<p>Извините, временно нет товаров в этой категории</p>
			<?php endif; ?>
	</section>		
	<section class="contact anchor" id="contact">
	    <h1 class="section-title">Контакты</h1>
        <div class="contact__items">
            <div class="contact__map">
               <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Ac5f21a11e9a83b62aa9655a6b7bfcd7e9a41582ba5f21c4842d56566092cd41a&amp;width=100%25&amp;height=600&amp;lang=ru_RU&amp;scroll=true"></script>
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
                <div class="contact__form">
					<div class="contact-form__title">
						Оставьте свой телефон и мы вам перезвоним!
					</div>
					<div class="contact-form__form">
						<?php echo do_shortcode('[contact-form-7 id="55" title="Contact us"]'); ?>
					</div>					
				</div>
            </div>
        </div>
    </section>
</main>
</div>
<div class="empty"></div>
</div>

<?php get_footer(); ?>
