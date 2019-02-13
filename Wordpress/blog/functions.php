<?php
/* убрать админский сайдбар из верстки */
			add_filter('show_admin_bar', '__return_false');
			
			

/* регистрация стилей и скриптов */
		add_action('wp_enqueue_scripts', function (){
			 wp_enqueue_style('blog_main', get_stylesheet_uri());
			 wp_enqueue_script('blog_script_jquery', get_template_directory_uri() . '/assets/js/jquery-3.3.1.min.js');
			 wp_enqueue_script('blog_script', get_template_directory_uri() . '/assets/js/script.js');			 
		 });
		 
				
				
				
				
/* Добавляем в админку выбор картинки для логотипа */
		add_theme_support( 'custom-logo' );
		
		
		
		
		

 /* регистрация меню */
		 add_action ('after_setup_theme', function (){
			register_nav_menu('top', 'Для шапки');
			register_nav_menu('landing', 'Лендинг');
			
	/*  Доп возможности темы */		
			 add_theme_support('post-thumbnails');
			 add_theme_support('title-tag');
			 add_theme_support( 'post-formats', array( 'aside', 'quote' ) );
		 });
		 
		 
		 

 /* регистрация сайдбара */
		 add_action('widgets_init', function (){
			register_sidebar([
				'name' => 'Sidebar-one',
				'id' => 'sidebar-one',
				'description' => 'Сайдбар1',
				'before_widget' => '<div class="widget %2$s">',
				'after_widget'  => "</div>\n",
			]);

		 });
		 
		 
		 
		 
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

/* Фильтр для вывода своего title, который задает контент-менеджер    */
		add_filter( 'pre_get_document_title', 'filter_title' );
		function filter_title( $title ){
			if (is_single()) {
				$title = CFS() -> get('doc_title');
			}
			return $title;
		}
		
		
		
/* Создание своего типа записей reviews (отзывы) */

			add_action('init', function (){
				register_post_type('reviews', [
					'labels' => [
						'name'               => 'Отзывы', // основное название для типа записи
						'singular_name'      => 'Отзыв', // название для одной записи этого типа
						'add_new'            => 'Добавить новый', // для добавления новой записи
						'add_new_item'       => 'Добавление отзыва', // заголовка у вновь создаваемой записи в админ-панели.
						'edit_item'          => 'Редактирование отзыва', // для редактирования типа записи
						'new_item'           => 'Новый отзыв', // текст новой записи
						'view_item'          => 'Смотреть отзыв', // для просмотра записи этого типа.
						'search_items'       => 'Искать отзывы', // для поиска по этим типам записи
						'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
						'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
						'parent_item_colon'  => '', // для родителей (у древовидных типов)
						'menu_name'          => 'Отзывы', // название меню
					],
					'public'              => true,
					'menu_position'       => 25,
					'menu_icon'           => 'dashicons-format-quote', 
					'hierarchical'        => false,
					'supports'            => array('title', 'editor', 'thumbnail'), // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
				]);
	});
			
	/* Функция получения всех своих типов постов reviews */		
		function test_show_reviews (){
			$args = array (
					'orderby'    => 'date',
					'order'      => 'DESC',
					'post_type'  => 'reviews'
				);
			$posts = get_posts($args);							
			return $posts;
		}		
			
			
/* Создание своего типа записей apartment (квартира) */			
			
		add_action('init', function (){
				register_post_type('apartment', [
					'labels' => [
						'name'               => 'Квартиры', // основное название для типа записи
						'singular_name'      => 'Квартира', // название для одной записи этого типа
						'add_new'            => 'Добавить новую', // для добавления новой записи
						'add_new_item'       => 'Добавление квартиры', // заголовка у вновь создаваемой записи в админ-панели.
						'edit_item'          => 'Редактирование квартиры', // для редактирования типа записи
						'new_item'           => 'Новая квартира', // текст новой записи
						'view_item'          => 'Смотреть квартиру', // для просмотра записи этого типа.
						'search_items'       => 'Искать квартиру', // для поиска по этим типам записи
						'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
						'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
						'parent_item_colon'  => '', // для родителей (у древовидных типов)
						'menu_name'          => 'Квартиры', // название меню
					],
					'public'              => true,
					'menu_position'       => 25,
					'menu_icon'           => 'dashicons-admin-home', 
					'hierarchical'        => false,
					'supports'            => array('title', 'editor', 'thumbnail'), // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
					'has_archive' 		  => true,
				]);	
			});
			
			
/* Создание своего вида таксономии */
					
		add_action('init', function(){
			register_taxonomy('city',  array('apartment'), array(
						'label'                 => '', // определяется параметром $labels->name
						'labels'                => array(
																								'name'              => 'Города',
																								'singular_name'     => 'Город',
																								'search_items'      => 'Поиск города',
																								'all_items'         => 'Все города',
																								'view_item '        => 'Просмотр города',
																								'edit_item'         => 'Редактировать город',
																								'update_item'       => 'Обновить Город',
																								'add_new_item'      => 'Добавить новый город',
																								'new_item_name'     => 'Название нового города',
																								'menu_name'         => 'Город',
																							),
						'description'           => '', // описание таксономии
						'public'                => true,		
						'hierarchical'          => false,
			
		)); 		
		});	
			
			
/*     Передача параметра из php в js	по завершении вывода head распечатает в документ переменную	*/
			
		/*	add_action('wp_head', function(){
				$vars = array(
					'ajax_url' => admin_url('admin-ajax.php'), 
					);
				
				echo "<script>window.wp = ".json_encode($vars)."</script>"; 		//создаем глобальную переменную в js и присваиваем ей JSON представление объекта из php 
			});
			
/*  Функция обработки AJAX запроса - выдача ответа от сервера  перенесли в плагин flatsapp*/
		
	/*	add_action('wp_ajax_flatapp', 'test_ajax_flatapp');  			  //при запросе от авторизованного пользователя
	    add_action('wp_ajax_nopriv_flatapp', 'test_ajax_flatapp');		//при запросе от не авторизованного пользователя
			//в названии хука последнее слово - нами придуманное, его регистрируем в js при отправке ajax запроса
	
			function test_ajax_flatapp(){
				/* здесь можно делать все что нужно
					добавлять в свою таблицу
					отпр на почту
					wp_insert_post
					работать с $_POST
				*/
				
	/*			$res = array(
						'success' => mt_rand(0, 1) ? true : false, 
						'err' => 'Ни хрена не получилось('
				);
		
		echo json_encode($res);
		
		wp_die();
				
			};*/
			
			
