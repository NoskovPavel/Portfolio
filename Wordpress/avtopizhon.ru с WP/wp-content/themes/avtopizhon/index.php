
<?php get_header(); ?>

<main>  
    <?php get_sidebar('news'); ?>   
    <section class="about anchor" id="about">
        <h2 class="section-title">О нас</h2>
        <div class="about__items">
            <div class="about__img"><img class="about__img_img" src="<?php echo get_template_directory_uri().'/assets/img/about.jpg' ?>"  alt="Автопижон">
            </div>
            <div class="about__text">«AvtoPizhon», был образован в 2015 году, в попытке сделать удобной и комфортной покупку и установку дополнительного автомобильного оборудования. За годы существования организации, в процессе внутренних преобразований был значительно расширен ассортимент предлагаемых товаров и качество оказываемых услуг. На данный момент мы предоставляем услуги по тонировке стекол автомобилей, а также установке, настройке и ремонту дополнительного автомобильного оборудования. </div>
        </div>
    </section>      

    <?php if (!preg_match("/Firefox/i", $_SERVER["HTTP_USER_AGENT"])
                && !strpos($_SERVER['HTTP_USER_AGENT'],'MSIE')!==false
                    && !strpos($_SERVER['HTTP_USER_AGENT'],'rv:11.0')!==false): ?>   
        <section class="protection">
            <h2 class="section-title" id="section_slider">Защита автомобиля от угона</h2>        
                <div id="slider">
                    <form>
                        <input type="radio" name="slider" id="s1">
                        <input type="radio" name="slider" id="s2">
                        <input type="radio" name="slider" id="s3" checked>
                        <input type="radio" name="slider" id="s4">
                        <input type="radio" name="slider" id="s5">                  
                    <label for="s1" id="slide1">
                        <div class="slider__item1 slide">
                            <h3 class="slider__title">
                                <a  href="<?php 
                                            $category_id = get_cat_ID( 'С обратной связью' );
                                            $category_link = get_category_link( $category_id );                             
                                            echo $category_link;                            
                                        ?>">Автосигнализация с обратной связью 
                                </a>
                            </h3>
                            <p class="slider__text">
                                <a  href="<?php echo $category_link; ?>">Большой выбор сигнализаций с функцией обратной связи!</a>
                            </p>
                            <a  href="<?php echo $category_link; ?>">
                                <img class="slider_img" src="<?php echo get_template_directory_uri().'/assets/img/protect_slider/protect_slider_1.jpg' ?>" alt="слайд">                 
                            </a>
                        </div>
                    </label>
                    <label for="s2" id="slide2">
                        <div class="slider__item2  slide">
                            <h3 class="slider__title">
                                <a  href="<?php 
                                            $category_id = get_cat_ID( 'С GPS' );
                                            $category_link = get_category_link( $category_id );                             
                                            echo $category_link;                            
                                        ?>">Автосигнализация с GPS 
                                </a>
                            </h3>
                            <p class="slider__text">
                                <a  href="<?php echo $category_link; ?>">Встроенный GPS-модуль.</a>
                            </p>
                            <a  href="<?php echo $category_link; ?>">
                                <img class="slider_img" src="<?php echo get_template_directory_uri().'/assets/img/protect_slider/protect_slider_2.jpg' ?>" alt="слайд">                 
                            </a>
                        </div>
                    </label>
                    <label for="s3" id="slide3">
                        <div class="slider__item3  slide">
                            <h3 class="slider__title">
                                <a  href="<?php 
                                            $category_id = get_cat_ID( 'С автозапуском' );
                                            $category_link = get_category_link( $category_id );                             
                                            echo $category_link;                            
                                        ?>">Автосигнализация с автозапуском 
                                </a>
                            </h3>
                            <p class="slider__text">
                                <a  href="<?php echo $category_link; ?>">Дистанционный запуска двигателя!</a>
                            </p>
                            <a  href="<?php echo $category_link; ?>">
                                <img class="slider_img" src="<?php echo get_template_directory_uri().'/assets/img/protect_slider/protect_slider_3.jpg' ?>" alt="слайд">                 
                            </a>
                        </div>
                    </label>
                    <label for="s4" id="slide4">
                        <div class="slider__item4  slide">
                            <h3 class="slider__title">
                                <a  href="<?php 
                                            $category_id = get_cat_ID( 'С GSM' );
                                            $category_link = get_category_link( $category_id );                             
                                            echo $category_link;                            
                                        ?>">Автосигнализация с GSM модулем 
                                </a>
                            </h3>
                            <p class="slider__text">
                                <a  href="<?php echo $category_link; ?>">Для быстрой связи с вашим авто.</a>
                            </p>
                            <a  href="<?php echo $category_link; ?>">
                                <img class="slider_img" src="<?php echo get_template_directory_uri().'/assets/img/protect_slider/protect_slider_4.jpg' ?>" alt="слайд">                 
                            </a>
                        </div>
                    </label>
                    <label for="s5" id="slide5">
                        <div class="slider__item5  slide">
                            <h3 class="slider__title">
                                <a  href="<?php 
                                            $category_id = get_cat_ID( 'Аксессуары автобезопасности' );
                                            $category_link = get_category_link( $category_id );                             
                                            echo $category_link;                            
                                        ?>">Аксессуары автобезопасности 
                                </a>
                            </h3>
                            <p class="slider__text">
                                <a  href="<?php echo $category_link; ?>">Брелки, чехлы и многое другое</a>
                            </p>
                            <a  href="<?php echo $category_link; ?>">
                                <img class="slider_img" src="<?php echo get_template_directory_uri().'/assets/img/protect_slider/protect_slider_5.jpg' ?>" alt="слайд">                 
                            </a>
                        </div>
                    </label>
                    </form>
                </div>
        </section>
        <section class="sound">
            <h2 class="section-title" id="section_slider">Автозвук</h2>        
                <div  id="slider_sound">
                    <form>
                        <input type="radio" name="slider_sound"  id="s1_sound">
                        <input type="radio" name="slider_sound"  id="s2_sound">
                        <input type="radio" name="slider_sound"  id="s3_sound" checked>
                        <input type="radio" name="slider_sound"  id="s4_sound">
                        <input type="radio" name="slider_sound"  id="s5_sound">             
                    <label for="s1_sound" id="slide1_sound">
                        <div class="slider__item1 slide">
                            <h3 class="slider__title">
                                <a  href="<?php 
                                            $category_id = get_cat_ID( 'С обратной связью' );
                                            $category_link = get_category_link( $category_id );                             
                                            echo $category_link;                            
                                        ?>">Сабву́феры 
                                </a>
                            </h3>
                            <p class="slider__text">
                                <a  href="<?php echo $category_link; ?>">Раскачай город</a>
                            </p>
                            <a  href="<?php echo $category_link; ?>">
                                <img class="slider_img" src="<?php echo get_template_directory_uri().'/assets/img/sound_slider/sound_slider_1.jpg' ?>" alt="слайд">                 
                            </a>
                        </div>
                    </label>
                    <label for="s2_sound" id="slide2_sound">
                        <div class="slider__item2  slide">
                            <h3 class="slider__title">
                                <a  href="<?php 
                                            $category_id = get_cat_ID( 'С GPS' );
                                            $category_link = get_category_link( $category_id );                             
                                            echo $category_link;                            
                                        ?>">Динамики 
                                </a>
                            </h3>
                            <p class="slider__text">
                                <a  href="<?php echo $category_link; ?>">Высокочастотные и низкочастотные</a>
                            </p>
                            <a  href="<?php echo $category_link; ?>">
                                <img class="slider_img" src="<?php echo get_template_directory_uri().'/assets/img/sound_slider/sound_slider_2.jpg' ?>" alt="слайд">                 
                            </a>
                        </div>
                    </label>
                    <label for="s3_sound" id="slide3_sound">
                        <div class="slider__item3  slide">
                            <h3 class="slider__title">
                                <a  href="<?php 
                                            $category_id = get_cat_ID( 'С автозапуском' );
                                            $category_link = get_category_link( $category_id );                             
                                            echo $category_link;                            
                                        ?>">Автомагнитолы 
                                </a>
                            </h3>
                            <p class="slider__text">
                                <a  href="<?php echo $category_link; ?>">Качественный звук в авто!</a>
                            </p>
                            <a  href="<?php echo $category_link; ?>">
                                <img class="slider_img" src="<?php echo get_template_directory_uri().'/assets/img/sound_slider/sound_slider_3.jpg' ?>" alt="слайд">                 
                            </a>
                        </div>
                    </label>
                    <label for="s4_sound" id="slide4_sound">
                        <div class="slider__item4  slide">
                            <h3 class="slider__title">
                                <a  href="<?php 
                                            $category_id = get_cat_ID( 'С GSM' );
                                            $category_link = get_category_link( $category_id );                             
                                            echo $category_link;                            
                                        ?>">Усилители 
                                </a>
                            </h3>
                            <p class="slider__text">
                                <a  href="<?php echo $category_link; ?>">Только качественная техника</a>
                            </p>
                            <a  href="<?php echo $category_link; ?>">
                                <img class="slider_img" src="<?php echo get_template_directory_uri().'/assets/img/sound_slider/sound_slider_4.jpg' ?>" alt="слайд">                 
                            </a>
                        </div>
                    </label>
                    <label for="s5_sound" id="slide5_sound">
                        <div class="slider__item5  slide">
                            <h3 class="slider__title">
                                <a  href="<?php 
                                            $category_id = get_cat_ID( 'Аксессуары автобезопасности' );
                                            $category_link = get_category_link( $category_id );                             
                                            echo $category_link;                            
                                        ?>">Аксессуары 
                                </a>
                            </h3>
                            <p class="slider__text">
                                <a  href="<?php echo $category_link; ?>">Защитные сетки, полки и д.р.</a>
                            </p>
                            <a  href="<?php echo $category_link; ?>">
                                <img class="slider_img" src="<?php echo get_template_directory_uri().'/assets/img/sound_slider/sound_slider_5.jpg' ?>" alt="слайд">                 
                            </a>
                        </div>
                    </label>
                    </form>
                </div>
        </section>
    <?php endif; ?>

    <?php get_sidebar('review'); ?>
    
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
