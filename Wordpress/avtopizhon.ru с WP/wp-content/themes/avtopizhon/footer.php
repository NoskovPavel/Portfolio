<footer>
    <div class="footer__wrapper">
        <div class="footer__map">
			<div class="map__title">
				Карта сайта
			</div>
			<?php echo do_shortcode('[wp_sitemap_page]'); ?>					
		</div>
        <div class="footer__tags-contact">
            <div class="footer__tags">
    			<?php $options = array(		//Плагин WP-kama Облако тегов
        				'width' => '300',        // ширина flash
        				'height' => '300',       // высота flash
        				'tcolor' => '000000',    // цвет больших ссылок
        				'tcolor2' => '000000',   // цвет маленьких ссылок
        				'hicolor' => '000000',   // цвет наведенной ссылки
        				'bgcolor' => 'dbdbdb',  // цвет фона
        				'speed' => '150',        // скорость вращения
        				'trans' => 'false',      // прозрачный фон у flash
        				'args' => 'number=30',   // аргументы передаваемые функции wp_tag_cloud. Пр.: largest=20&smallest=12&number=40
        				'mode' => 'both',        // какие ссылки выводить: tags (метки), cats (категории), both (метки и категории)
        				'compmode' => 'js',      // код вставки flash: js (javascript), пусто (object)
        				'showwptags' => 1,       // показывать ли HTML ссылки, если в браузере не работает flash
    			     );
    			     wp_cumulus_insert( $options ); 
                 ?>
            </div>
            <div class="footer__contact">
                <div class="fcontact">
                    <p class="fcontact__title">Автопижон</p>
                    <p class="fcontact__name">ИП Пижонков И. С.</p>
                    <address class="fcontact__address">г. Пенза, ул. Литвинова, 20а к3</address>
                    <address class="fcontact__phone">
                        <a href="tel:762367">
                            <img src="<?php echo get_template_directory_uri().'/assets/img/icon/phone-without-circle.svg' ?>" tile="Позвонить" alt="Позвонить">
                            76 - 23 - 67
                        </a>
                    </address>
                    <div class="fcontact__social">
                        <div class="social">
                            <div class="social__title">Мы в VK:</div>
                            <div class="social__icon">
                                <a href="https://vk.com/avtopizhon" target="_blank"><img src="<?php echo get_template_directory_uri().'/assets/img/icon/vk.svg' ?>" title="Страничка в VK" alt="Мы в контакте"></a>
                            </div>
                        </div>
                    </div>
                </div>
		    </div>      
        </div>
    </div>
    <div class="footer__author">
        produced by <a href="http://noskovpavel.ru" target="_blank">Webmaster Noskov Pavel</a>
    </div>
</footer>
<div class="button_up"></div>
<?php wp_footer(); ?>
</body>
