<!DOCTYPE html>
<html xmlns:v-on="http://www.w3.org/1999/xhtml" xmlns:v-bind="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>
    <title>Web Developer - Носков Павел</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="shortcut icon" href="img/logo.png"/>
    <meta name="msapplication-TileImage" content="src/img/logo.png">
    <link rel="stylesheet" type="text/css" media="all" href="css/styles.css">
    <link rel="stylesheet" type="text/css" media="all" href="css/animate.min.css">
    <link rel="stylesheet" type="text/css" media="all" href="css/remodal.css">
    <link rel="stylesheet" type="text/css" media="all" href="css/remodal-default-theme.css">
</head>
<body>
<header>
    <div class="header__background">
        <div class="wrapper">
            <div class="header__top">
                <div class="header__logo animated fadeInLeft delay-1s">
                    <img src="img/logo.png" alt="Логотип" title="Логотип">
                </div>
                <h1 class="header__siteName">Сайт-портфолио веб-разработчика</h1>
                <nav class="header__nav animated fadeInRight delay-1s">
                    <ul>
                        <li>
                            <a href="#about">
                                <img src="img/icon-about.svg" title="Обо мне" alt="Обо мне">
                                Обо мне
                            </a>
                        </li>
                        <li>
                            <a href="#service">
                                <img src="img/icon-service.svg" title="Услуги" alt="Услуги">
                                Услуги
                            </a>
                        </li>
                        <li>
                            <a href="#portfolio">
                                <img src="img/icon-portf.svg" title="Портфолио" alt="Портфолио">
                                Портфолио
                            </a>
                        </li>
                        <li>
                            <a href="#contacts">
                                <img src="img/icon-cont.svg" title="Контакты" alt="Контакты">
                                Контакты
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="header__bottom animated fadeInDown delay-1s">
                <p class="header__name">Павел Носков</p>
                <p class="header__skills">Профессиональное создание сайтов</p>
            </div>
        </div>
    </div>
</header>
<main>
    <div class="wrapper">
        <section class="section about" id="about">
            <h2 class="section__title" id="about__title">Подробнее обо мне</h2>
            <div class="section__content">
                <div class="section__my-foto" id="section__my-foto">
                    <div class="section__foto">
                        <img src="img/I.JPG" alt="Носков Павел" title="Носков Павел">
                    </div>
                </div>
                <div class="section__info" id="section__info">
                    <p>Здравствуйте, меня зовут Павел.</p>
                    <p>Я создаю сайты с нуля - от идеи до размещения на хостинге под управлением CMS WordPress.</p>
                    <p>Выполняю верстку и программирую взаимодействие с посетителями сайта. Мои сайты адаптивны и
                        кроссбраузерны, т.е. отображаются корректно на любых устройствах и во всех браузерах.</p>
                    <p>Если вам или вашей компании необходимо представительство в сети интернет, я открыт для
                        сотрудничества.</p>
                </div>
            </div>
        </section>
        <section class="service" id="service">
            <h2 class="service__title">Услуги</h2>
            <div class="service__slider">
                <div id="app"></div>
            </div>                
        </section>
        <section class="section portfolio" id="portfolio">
            <h2 class="section__title portfolio__title">Примеры выполненных работ</h2>
            <div class="section__content portfolio__content">
                <div class="section__item">
                    <h3>Сайт автостанции (CMS Wordpress)</h3>                    
                    <a href="http://avtopizhon.ru" target="_blank">
                        <figure>
                            <img src="img/portfolio_avtopizhon.png" alt="АвтоПижон">
                            <figcaption>
                                Сайт 'под ключ': концепция, дизайн и пользовательский интерфейс. Верстка сайта с установкой на CMS Wordpress.
                            </figcaption>
                        </figure>    
                    </a>
                </div>
                <div class="section__item">
                    <h3>Посадка на CMS Wordpress</h3> 
                    <figure>
                        <img src="img/portfolio_to-wordpress.png" alt="Посадка на CMS Wordpress" class="minimized">
                        <figcaption>
                            Адаптация любой верстки к CMS Wordpress.
                        </figcaption>
                    </figure>
                </div> 
                <div class="section__item">
                    <h3>Верстка по макету Psd</h3> 
                    <figure>
                        <img src="img/portfolio_html.png" alt="Верстка по макету psd" class="minimized">
                        <figcaption>
                            Верстка по произвольному макету формата .psd с соблюдением технологии perfect pixel и программирование функционала на javascript.
                        </figcaption>
                    </figure>
                </div>                
            </div>
        </section>
        <section class="section contact" id="contacts">
            <h2 class="section__title contact__title" id="contact__title">Контакты</h2>
            <div class="section__content contact__content" id="contact__content">
               <div class="contact__item">  
                    <a href="tel:+79374418843">            
                        <div class="contact__icon">
                            <img src="img/icon_contact/phone.svg" title="телефон" alt="телефон">
                        </div> 
                        <p>Мой телефон:&nbsp;&nbsp; +7-937-441-88-43</p>
                    </a>                   
               </div>
               <div class="contact__item">
                    <a class="linkButton" title="Обратный звонок" data-remodal-target="firstModal"> 
                        <div class="contact__icon">
                            <img src="img/icon-cont.svg" title="e-mail" alt="e-mail">
                        </div>                        
                        <p>Мой e-mail:&nbsp;&nbsp; noskov_pavel@mail.ru</p>
                    </a>                  
               </div>
               <div class="contact__item">                   
                    <a href="https://vk.com/id34122674" target="_blank">
                        <div class="contact__icon">
                            <img src="img/icon_contact/vk.svg" title="профиль vk" alt="профиль vk">
                        </div>                        
                        <p>Мой профиль VK</p>
                    </a>                   
               </div>                
            </div>
        </section>
    </div>
    <div class="button"></div>
    <div class="remodal" data-remodal-id="firstModal" data-remodal-options="hashTracking: false,closeOnConfirm: false">
        <button data-remodal-action="close" class="remodal-close"></button>
        <div class="formArea">       
            <form id="secondForm" class="form" autocomplete="off">
                <p class="formTitle">
                    Закажите обратный звонок и я свяжусь с вами!
                </p>
                <p class="msgs"></p> 
                <fieldset class="form-fieldset ui-input __first">
                    <input name="uname" type="text" id="username" required tabindex="0"/>
                    <label for="username">
                      <span data-text="Введите ваше имя">Введите ваше имя</span>
                    </label>
                </fieldset>         
                <fieldset class="form-fieldset ui-input __second">
                    <input name="uphone" type="tel" id="phone" tabindex="0" required pattern="^[ 0-9]+$"/>
                    <label for="phone">
                      <span data-text="Введите ваш телефон">Введите ваш телефон</span>
                    </label>
                </fieldset>         
                <input name="formInfo" class="formInfo" type="hidden" value="Заказ обратного звонка"/>         
                <div class="form-footer">
                    <input type="submit" class="formBtn" value="Обратный звонок" />
                </div>                
            </form>
        </div>
    </div>   
</main>
<script src="dist/build.js"></script>
<script src="js/jquery-3.2.0.js"></script>
<script src="js/remodal.min.js"></script>
<script src="js/form.js"></script>
<script src="js/js.js"></script>
</body>
</html>
               

 