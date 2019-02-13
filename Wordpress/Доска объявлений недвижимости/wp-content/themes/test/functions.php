<?php	
	//уберем админский сайдбар
	add_filter('show_admin_bar', '__return_false');

	//регистрация стилей и скриптов
	add_action('wp_enqueue_scripts', function (){	    
		wp_enqueue_style('test-main', get_stylesheet_uri());				
		wp_enqueue_script('test-script-main', get_template_directory_uri() . '/assets/js/script.js');
	});

	//регистрация меню
	add_action('after_setup_theme', function (){
		register_nav_menu('top', 'Для шапки');			
		add_theme_support('post-thumbnails');		
		
	});

	//Регистрация сайдбара
	add_action('widgets_init', function (){
		register_sidebar([
			'name' => 'Sidebar Right',
			'id' => 'sidebar-right',
			'description' => 'Правая колонка',
			'before_widget' => '<div class="widget %2$s">',
			'after_widget'  => "</div>\n"
		]);	
		
	});
	

	
	//Регистрация своего вида постов
	add_action('init', function (){
		//Регистрация свой тип записи "Отзывы"
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

		//Регистрация свой тип записи "Недвижимость"
		register_post_type('realty', [
			'labels' => array(
				'name'               => 'Недвижимость', // основное название для типа записи
				'singular_name'      => 'Недвижимость', // название для одной записи этого типа
				'add_new'            => 'Добавить недвижимость', // для добавления новой записи
				'add_new_item'       => 'Добавление недвижимости', // заголовка у вновь создаваемой записи в админ-панели.
				'edit_item'          => 'Редактирование недвижимости', // для редактирования типа записи
				'new_item'           => 'Новая недвижимость', // текст новой записи
				'view_item'          => 'Смотреть недвижимость', // для просмотра записи этого типа.
				'search_items'       => 'Искать недвижимость', // для поиска по этим типам записи
				'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
				'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
				'parent_item_colon'  => '', // для родителей (у древовидных типов)
				'menu_name'          => 'Недвижимость', // название меню
			),
			'public'              => true,
			'menu_position'       => 25,
			'menu_icon'           => 'dashicons-admin-home', 
			'hierarchical'        => false,
			'supports'            => array('title', 'editor', 'thumbnail'),
			'has_archive'         => true
		]);
		
		//Регистрация таксономии "Тип недвижимости" к "Недвижимость" 
		register_taxonomy('property_type', array('realty'), array(
			'labels'                => array(
				'name'              => 'Тип недвижимости',
				'singular_name'     => 'Тип недвижимости',
				'search_items'      => 'Найти тип недвижимости',
				'all_items'         => 'Все типы недвижимости',
				'view_item '        => 'Посмотреть тип недвижимости',
				'edit_item'         => 'Редактировать тип недвижимости',
				'update_item'       => 'Обновить тип недвижимости',
				'add_new_item'      => 'Добавить новый тип недвижимости',
				'new_item_name'     => 'Добавить новый',
				'menu_name'         => 'Тип недвижимости',
			),
			'description'           => '', // описание таксономии
			'public'                => true,
			'hierarchical'          => false
		));	

		//Регистрация свой тип записи "Город"
		register_post_type('city', [
			'labels' => array(
				'name'               => 'Город', // основное название для типа записи
				'singular_name'      => 'Город', // название для одной записи этого типа
				'add_new'            => 'Добавить город', // для добавления новой записи
				'add_new_item'       => 'Добавление города', // заголовка у вновь создаваемой записи в админ-панели.
				'edit_item'          => 'Редактирование города', // для редактирования типа записи
				'new_item'           => 'Новый город', // текст новой записи
				'view_item'          => 'Смотреть город', // для просмотра записи этого типа.
				'search_items'       => 'Искать города', // для поиска по этим типам записи
				'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
				'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
				'parent_item_colon'  => '', // для родителей (у древовидных типов)
				'menu_name'          => 'Города', // название меню
			),
			'public'              => true,
			'menu_position'       => 25,
			'menu_icon'           => 'dashicons-admin-site', 
			'hierarchical'        => false,
			'supports'            => array('title', 'editor', 'thumbnail'),
			'has_archive'         => true
		]);

	});

	//Свяжем города и недвижимость
		// Добавим метабокс выбора города к недвижимости в админку
		add_action('add_meta_boxes', function () {
			add_meta_box( 'realty_city', 'Город объекта недвижимости', 'realty_city_metabox', 'realty', 'side', 'low'  );
		}, 1);

		// метабокс с селектом городов
		function realty_city_metabox( $post ){
			$citys = get_posts(array( 'post_type'=>'city', 'posts_per_page'=>-1, 'orderby'=>'post_title', 'order'=>'ASC' ));

			if( $citys ){			
				echo '
				<div style="max-height:200px; overflow-y:auto;">
					<ul>
				';
				foreach( $citys as $city ){
					echo '
					<li><label>
						<input type="radio" name="post_parent" value="'. $city->ID .'" '. checked($city->ID, $post->post_parent, 0) .'> '. esc_html($city->post_title) .'
					</label></li>
					';
				}

				echo '
					</ul>
				</div>';
			}
			else
				echo 'Объектов недвижимости в этом городе нет...';
		};

	//Добавление пользователем постов
		//прикрепим необходимые js скрипты и передадим данные 
		add_action('wp_print_scripts','include_scripts'); 
		function include_scripts(){
		        wp_enqueue_script('jquery'); 
		        wp_enqueue_script('jquery-form'); // плагин jQuery forms, встроен в WP
		      /*  wp_enqueue_script('jquery-chained', '//www.appelsiini.net/projects/chained/jquery.chained.min.js'); // добавим плагин для связанных селект листов*/

		        wp_localize_script( 'jquery', 'ajaxdata', // функция для передачи глобальных js переменных на страницу, первый аргумент означет перед каким скриптом вставить переменные, второй это название глобального js объекта в котором эти переменные будут храниться, последний аргумент это массив с самими переменными
					array( 
		   				'url' => admin_url('admin-ajax.php'), // передадим путь до нативного обработчика аякс запросов в wp, в js можно будет обратиться к ней так: ajaxdata.url
		   				'nonce' => wp_create_nonce('add_object') // передадим уникальную строку для механизма проверки аякс запроса, ajaxdata.nonce
					)
				);
		}

		//Обработка данных и добавление поста
		add_action( 'wp_ajax_nopriv_add_object_ajax', 'add_object' ); // крепим на событие wp_ajax_nopriv_add_object_ajax, где add_object_ajax это параметр action, который мы добавили в перехвате отправки формы, add_object - ф-я которую надо запустить
		add_action('wp_ajax_add_object_ajax', 'add_object'); // если нужно чтобы вся бадяга работала для админов
		function add_object() {
			$errors = ''; // сначала ошибок нет

			$nonce = $_POST['nonce']; // берем переданную формой строку проверки
			if (!wp_verify_nonce($nonce, 'add_object')) { // проверяем nonce код, второй параметр это аргумент из wp_create_nonce
				$errors .= 'Данные отправлены с левой страницы '; // пишим ошибку
			}

			// запишем все поля			
			$tag = (int)$_POST['tag']; // id таксономии
			$city_ID = (int)$_POST['city']; //id родительского города
			$title = strip_tags($_POST['post_title']); // запишем название поста
			$content = wp_kses_post($_POST['post_content']); // контент
			$area = strip_tags($_POST['area']);//площадь 
			$price = strip_tags($_POST['price']);//стоимость
			$address = strip_tags($_POST['address']);//адрес
			$living_area = strip_tags($_POST['living_area']);//жилая площадь
			$level = strip_tags($_POST['level']);//этаж

			
		    if (!$tag) $errors .= 'Не выбрано "Тип недвижимости"';
		    if (!$title) $errors .= 'Не заполнено поле "Название объекта недвижимости"';
		    if (!$content) $errors .= 'Не заполнено поле "Описание объекта недвижимости"';
		    if (!$area) $errors .= 'Не заполнено поле "Площадь объекта недвижимости"';
		    if (!$price) $errors .= 'Не заполнено поле "Стоимость объекта недвижимости"';	    
		    if (!$level) $errors .= 'Не заполнено поле "Этаж (этажность) объекта недвижимости"';

		    // далее проверим все ли нормально с картинками которые нам отправили
		    if ($_FILES['img']) { // если была передана миниатюра
		   		if ($_FILES['img']['error']) $errors .= "Ошибка загрузки: " . $_FILES['img']['error'].". (".$_FILES['img']['name'].") "; // серверная ошибка загрузки
		    	$type = $_FILES['img']['type']; 
				if (($type != "image/jpg") && ($type != "image/jpeg") && ($type != "image/png")) $errors .= "Формат файла может быть только jpg или png. (".$_FILES['img']['name'].")"; // неверный формат
			}

			if ($_FILES['imgs']) { // если были переданны дополнительные картинки, пробежимся по ним в цикле и проверим тоже самое
				foreach ($_FILES['imgs']['name'] as $key => $array) {
					if ($_FILES['imgs']['error'][$key]) $errors .= "Ошибка загрузки: " . $_FILES['imgs']['error'][$key].". (".$key.$_FILES['imgs']['name'][$key].") ";
		    		$type = $_FILES['imgs']['type'][$key]; 
					if (($type != "image/jpg") && ($type != "image/jpeg") && ($type != "image/png")) $errors .= "Формат файла может быть только jpg или png. (".$_FILES['imgs']['name'][$key].")"; 
				}
			}  

			if (!$errors) { // если с полями все ок, значит можем добавлять пост
				$fields = array( // подготовим массив с полями поста, ключ это название поля, значение - его значение
					'post_type' => 'realty', // нужно указать какой тип постов добавляем, у нас это my_custom_post_type
			    	'post_title'   => $title, // заголовок поста
			        'post_content' => $content, // контент
			        'post_parent'	=> 	$city_ID,	        
			    );
			    $post_id = wp_insert_post($fields); // добавляем пост в базу и получаем его id

			  
			    update_field('area', $area, $post_id); 	
			    update_field('price', $price, $post_id);
			    update_field('address', $address, $post_id);
			    update_field('living_area', $living_area, $post_id);
			    update_field('level', $level, $post_id);	    
			    	    


			    //wp_set_object_terms($post_id, $parent_cat, 'custom_tax_like_cat', true); // привязываем к пост к таксономиям, третий параметр это слаг таксономии
			    //wp_set_object_terms($post_id, $child_cat, 'custom_tax_like_cat', true);
			    wp_set_object_terms($post_id, $tag, 'property_type', true);

			    if ($_FILES['img']) { // если основное фото было загружено
		   			$attach_id_img = media_handle_upload( 'img', $post_id ); // добавляем картинку в медиабиблиотеку и получаем её id
		   			update_post_meta($post_id,'_thumbnail_id',$attach_id_img); // привязываем миниатюру к посту
				}

				if ($_FILES['imgs']) { // если дополнительные фото были загружены
					$imgs = array(); // из-за того, что дефолтный массив с загруженными файлами в пхп выглядит не так как нужно, а именно вся инфа о файлах лежит в разных массивах но с одинаковыми ключами, нам нужно создать свой массив с блэкджеком, где у каждого файла будет свой массив со всеми данными
					foreach ($_FILES['imgs']['name'] as $key => $array) { // пробежим по массиву с именами загруженных файлов
						$file = array( // пишем новый массив
							'name' => $_FILES['imgs']['name'][$key],
							'type' => $_FILES['imgs']['type'][$key], 
							'tmp_name' => $_FILES['imgs']['tmp_name'][$key], 
							'error' => $_FILES['imgs']['error'][$key],
							'size' => $_FILES['imgs']['size'][$key]
						);
						$_FILES['imgs'.$key] = $file; // записываем новый массив с данными в глобальный массив с файлами
						$imgs[] = media_handle_upload( 'imgs'.$key, $post_id ); // добавляем текущий файл в медиабиблиотека, а id картинки суем в другой массив
					}
					update_post_meta($post_id,'multifile_field',$imgs); // привязываем все картинки к посту
				}  
			}
			if ($errors) wp_send_json_error($errors); // если были ошибки
			else wp_send_json_success('Ваша недвижимость добавлена.'); 			
			die(); 
		}



	
	
	
	