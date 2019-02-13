<?php
/* убрать админский сайдбар из верстки */
add_filter('show_admin_bar', '__return_false');

/* регистрация стилей и скриптов */
add_action('wp_enqueue_scripts', function (){
    wp_enqueue_style('avtopizhon_main', get_stylesheet_uri());
    wp_enqueue_script('avtopizhon_script_jquery', get_template_directory_uri() . '/assets/js/jquery-3.2.0.js');
    wp_enqueue_script('avtopizhon_script', get_template_directory_uri() . '/assets/js/script.js');
});



/* регистрация меню */
add_action ('after_setup_theme', function (){
    register_nav_menu('top', 'Для шапки');
	register_nav_menu('bottom', 'Аккордион');
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');    
});

/* регистрация сайдбара Меню аккордион */
		 add_action('widgets_init', function (){
			register_sidebar([
				'name' => 'Sidebar-accordion',
				'id' => 'sidebar-accordion',
				'description' => 'Сайдбар-аккордион',
				/*'before_widget' => '<div class="widget %2$s">',
				'after_widget'  => "</div>\n",*/
			]);

		 });
		 
/* Функция для подсветки слов поиска */

	add_filter('the_content', 'kama_search_backlight');
	add_filter('the_excerpt', 'kama_search_backlight');
	add_filter('the_title', 'kama_search_backlight');
	function kama_search_backlight( $text ){
		// ------------ Настройки -----------
		$styles = ['',
			'color: #ec1616; background: #fff;',
			'color: #000; background: #ffcc66;',
			'color: #000; background: #99ccff;',
			'color: #000; background: #ff9999;',
			'color: #000; background: #FF7EFF;',
		];

		// только для страниц поиска...
		if ( ! is_search() ) return $text;

		$query_terms = get_query_var('search_terms');
		if( empty($query_terms) ) $query_terms = array(get_query_var('s'));
		if( empty($query_terms) ) return $text;

		$n = 0;
		foreach( $query_terms as $term ){
			$n++;

			$term = preg_quote( $term, '/' );
			$text = preg_replace_callback( "/$term/iu", function($match) use ($styles,$n){
				return '<span style="'. $styles[ $n ] .'">'. $match[0] .'</span>';
			}, $text );
		}

		return $text;
	}
	
	
	/*ограничение названия поста в index.php */
		function trim_title_words($count, $after) {
		  $title = get_the_title();
		  $words = explode(' ', $title);
		  if (count($words) > $count) {
			array_splice($words, $count);
			$title = implode(' ', $words);
		  }
		  else $after = '';
		  echo $title . $after;
		}	
		
			
	/* регистрация сайдбара Новости */
		 add_action('widgets_init', function (){
			register_sidebar([
				'name' => 'Sidebar-news',
				'id' => 'sidebar-news',
				'description' => 'Сайдбар',
				'before_widget' => '<div class="widget %2$s">',
				'after_widget'  => "</div>\n",
			]);

		 });
		 
		 
	/* регистрация сайдбара Отзывы */
		 add_action('widgets_init', function (){
			register_sidebar([
				'name' => 'Sidebar-review',
				'id' => 'sidebar-review',
				'description' => 'Сайдбар',
				'before_widget' => '<div class="widget %2$s">',
				'after_widget'  => "</div>\n",
			]);

		 });

	/* Вывод анонса с заданным количеством слов на category.php  */	

	function new_excerpt_length($length) {
	  return 5;
	}
	add_filter('excerpt_length', 'new_excerpt_length');



//AJAX запрос для получения названий избранных постов при заказе из Корзины

	function my_custom_ajax() {
	  ?>
	  <script type="text/javascript" >

	  	//отслеживаем клик по кнопке Заказать на странице Избранное
	  	$('.favourites-btn_news').on('click', function(){
	  		
	  		//передаваемые данные на сервер
	        var data = {
	            action: 'ACTION_NAME',	            
	            _ajax_nonce: '<?php echo wp_create_nonce( 'my_ajax_nonce' ); ?>'
	        };
	        //url для ajax запроса
	        var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
	        //запрос
	        jQuery.post(ajaxurl, data, function(response) {
	            //запишем ответ в скрытое поле в форме заказа
	            $('#title-service').val(response);
	        });
	  	});
	  </script>

	  <?php
	}

 //По окончании загрузки footer будет вызвана функция my_custom_ajax и напечатан скрипт 
	//для запроса на сервер
	add_action('wp_footer', 'my_custom_ajax');

	//если вы хотите принимать запрос только от авторизованных пользователей, тогда добавьте этот хук
	add_action('wp_ajax_ACTION_NAME', 'my_AJAX_processing_function');
	//если вы хотите получить запрос от неавторизованных пользователей, тогда добавьте этот хук
	add_action('wp_ajax_nopriv_ACTION_NAME', 'my_AJAX_processing_function');
	//Если хотите, чтобы оба вариант работали, тогда оставьте оба хука

	function my_AJAX_processing_function(){
	  check_ajax_referer('my_ajax_nonce');

	  //строка для записи названий всех избранных постов
	  $favouritesTitle = '';
	  //массив id постов в избранном
	  $favouritesItem = get_user_favorites();
        foreach($favouritesItem as $value){
        	//сформируем строку
            $favouritesTitle .= get_the_title($value).' ';
        }	  	  

      //отправим все названия избранных постов 
	  echo json_encode([$favouritesTitle], JSON_UNESCAPED_UNICODE);
	  wp_die();
	}