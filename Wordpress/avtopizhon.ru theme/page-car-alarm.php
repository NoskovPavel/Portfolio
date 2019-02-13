<?php
	/*
		Template Name: Автосигнализации
	*/

?>

<?php get_header(); ?>

<main> 
	<section class="protection anchor""> 
		<h2 class="section-title">Автосигнализации</h2>
		<section class="protection__autorun">			
			<h2 class="section-title-small">С автозапуском</h2>
				<?php $catquery = new WP_Query( array( 'category__and' => array(3,22) )); ?>
				<div class="product-items">
					<?php while($catquery->have_posts()) : $catquery->the_post(); ?>						
						<div class="product-items__item">
							<h3 class="item__title">
								<a href="<?php the_permalink() ?>"><?php the_title(); ?><a>
							</h3>
							<div class="item__img">
								<a href="<?php the_permalink() ?>"><?php the_post_thumbnail('thumbnail') ?></a>
							</div>
							<p class="item__intro">
								<a href="<?php the_permalink() ?>"><?php echo CFS()-> get('intro'); ?></a>
							</p>
							<p class="item__price">
								<a href="<?php the_permalink() ?>"><?php echo CFS()-> get('price')." руб."; ?></a>
							</p>							
						</div>											
					<?php endwhile; ?> 					
				</div>				
				<?php wp_reset_postdata();?>
				<div class="product-items__more">
					<a href="<?php echo get_category_link(3); ?>">Все сигнализации с автозапуском...</a>
				</div>			
		</section>			
		<section class="protection__feedback">
			<h2 class="section-title-small">С обратной связью</h2>
			<?php $catquery = new WP_Query( array( 'category__and' => array(4,22) )); ?>
				<div class="product-items">
					<?php while($catquery->have_posts()) : $catquery->the_post(); ?>
						<div class="product-items__item">
							<a href="<?php the_permalink() ?>">
								<h3 class="item__title"><?php the_title(); ?></h3>
								<div class="item__img"><?php the_post_thumbnail('thumbnail') ?></div>
								<p class="item__intro"><?php echo CFS()-> get('intro'); ?></p>
								<p class="item__price"><?php echo CFS()-> get('price')." руб."; ?></p>
							</a>
						</div>					
					<?php endwhile; ?> 					
				</div>				
				<?php wp_reset_postdata();?>
				<div class="product-items__more">
					<a href="<?php echo get_category_link(4); ?>">Все сигнализации с обратной связью...</a>
				</div>
		</section>
		<section class="protection__with-gps">
			<h2 class="section-title-small">С GPS</h2>
			<?php $catquery = new WP_Query( array( 'category__and' => array(5,22) )); ?>
			<div class="product-items">
				<?php while($catquery->have_posts()) : $catquery->the_post(); ?>
					<div class="product-items__item">
						<a href="<?php the_permalink() ?>">
							<h3 class="item__title"><?php the_title(); ?></h3>
							<div class="item__img"><?php the_post_thumbnail('thumbnail') ?></div>
							<p class="item__intro"><?php echo CFS()-> get('intro'); ?></p>
							<p class="item__price"><?php echo CFS()-> get('price')." руб."; ?></p>
						</a>
					</div>					
				<?php endwhile; ?> 					
			</div>				
			<?php wp_reset_postdata();?>
			<div class="product-items__more">
				<a href="<?php echo get_category_link(5); ?>">Все сигнализации с GPS...</a>
			</div>
		</section>
		<section class="protection__with-gsm">
			<h2 class="section-title-small">С GSM</h2>
			<?php $catquery = new WP_Query( array( 'category__and' => array(13,22) )); ?>
			<div class="product-items">
				<?php while($catquery->have_posts()) : $catquery->the_post(); ?>
					<div class="product-items__item">
						<a href="<?php the_permalink() ?>">
							<h3 class="item__title"><?php the_title(); ?></h3>
							<div class="item__img"><?php the_post_thumbnail('thumbnail') ?></div>
							<p class="item__intro"><?php echo CFS()-> get('intro'); ?></p>
							<p class="item__price"><?php echo CFS()-> get('price')." руб."; ?></p>
						</a>
					</div>					
				<?php endwhile; ?> 					
			</div>				
			<?php wp_reset_postdata();?>
			<div class="product-items__more">
				<a href="<?php echo get_category_link(13); ?>">Все сигнализации с GSM...</a>
			</div>
		</section>
		<section class="protection__accessories">
			<h2 class="section-title-small">Аксессуары</h2>
			<?php $catquery = new WP_Query( array( 'category__and' => array(14,22) )); ?>
			<div class="product-items">
				<?php while($catquery->have_posts()) : $catquery->the_post(); ?>
					<div class="product-items__item">
						<a href="<?php the_permalink() ?>">
							<h3 class="item__title"><?php the_title(); ?></h3>
							<div class="item__img"><?php the_post_thumbnail('thumbnail') ?></div>
							<p class="item__intro"><?php echo CFS()-> get('intro'); ?></p>
							<p class="item__price"><?php echo CFS()-> get('price')." руб."; ?></p>
						</a>
					</div>					
				<?php endwhile; ?> 					
			</div>				
			<?php wp_reset_postdata();?>
			<div class="product-items__more">
				<a href="<?php echo get_category_link(14); ?>">Все аксессуары...</a>
			</div>
		</section>
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
