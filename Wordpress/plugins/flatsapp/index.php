<?php

	/*
		Plugin Name: Заявки на квартиры
		
	*/
	
	register_activation_hook(__FILE__, 'flatsapp_install');
	register_deactivation_hook(__FILE__, 'flatsapp_uninstall');
	register_uninstall_hook(__FILE__, 'flatsapp_ondelete');
	
	function flatsapp_install(){
	
	}

	function flatsapp_uninstall(){
		
	}

	function flatsapp_ondelete(){
		
	}
	
	
	/*     Передача параметра из php в js		*/
			
			add_action('wp_head', function(){
				$vars = array(
					'ajax_url' => admin_url('admin-ajax.php'), 
					);
				
				echo "<script>window.wp = ".json_encode($vars)."</script>"; 		//создаем глобальную переменную в js и присваиваем ей JSON представление объекта из php 
			});
	
	
	
	/*Функция обработки AJAX запроса - выдача ответа  */
		
		
		add_action('wp_ajax_flatapp', 'flatsapp_ajax');  			  //при запросе от авторизованного пользователя
	    add_action('wp_ajax_nopriv_flatapp', 'flatsapp_ajax');		//при запросе от не авторизованного пользователя
			//в названии хука последнее слово - нами придуманное, его регистрируем в js при отправке ajax запроса
	
		function flatsapp_ajax(){
				/* проверки	*/
				
				
				
				/*Реализация добавления заявок на квартиры
					через добавление новых типов записи*/
				$id_flat = (int)$_POST['flat_id'];                //присланные через запрос данные заявки
				$phone   = htmlspecialchars($_POST['phone']);
				
				$data    = [
					'post_type'    => 'flatsapp',
					'post_status'  => 'publish',
					'post_title'   => $phone,
				];				
				
				$id_post = wp_insert_post($data);  //внесение в БД постов этой записи (появится новая запись)
				
				add_post_meta($id_post, 'id_flat', $id_flat);       //добавление произвольного поля к этой записи
				add_post_meta($id_post, 'is_new', '1');            // 1 - значение по умолчанию, означает что заявка новая
				
				//Серверный ответ
				$res = array(
						'success' => true
				);		
				echo json_encode($res);
		
		
			wp_die();				
			}
			
		/* Регистрация типов записи для хранения заявок на квартиру  */	
		add_action('init', function (){
				register_post_type('flatsapp', [
					'labels' => array(
						'name'               => 'Заявки на квартиры',
						'menu_name'          => 'Заявки на квартиры', 
					),
					'public'              => true,
					'menu_position'       => 25,
					'menu_icon'           => 'dashicons-category', 
					'hierarchical'        => false,
					'supports'            => array('title', 'custom-fields')
				]);
		}
		);
			
		/* Реализация вывода заявок на квартиру удобным менеджеру способом в отдельную страницу админки */	
		
		
		add_action('admin_menu', function(){
			add_menu_page('Заявки', 'Заявки', 8, 'flatsapp', 'flatsapp_list');    //Добавляем пункт и страницу в админ-меню
		}
		);
		
		
		function flatsapp_list(){							//Реализуем страницу с заявками
			echo "<h1>Список заявок</h1>";
			
			$str = '';
	
			$args = array(
				'orderby'     => 'date',
				'order'       => 'DESC',
				'post_type'   => 'flatsapp'
			);

			$posts = get_posts($args);           //получаем все записи - заявки на квартиры
			global $post;

			$str .= "<table>";
			
			foreach($posts as $post){ 
				setup_postdata($post);
				
				$title = get_the_title();
				$dt = get_the_date();
				
				$meta = get_post_custom($post->ID);        //все произвольные поля записи

				$str .= "<tr>
							<td><em>$dt</em></td>
							<td><strong>$title</strong></td>
							<td><strong>{$meta['id_flat'][0]}</strong></td>
							<td><strong>{$meta['is_new'][0]}</strong></td>     //можно поставить тернарный оператор проверяющий - если 0 - заявка обработана. Или поставить чек-бокс - а при нажатии на него еще один ajax запрос идет, еще вешаем хук на ajax передаем id поста и меняем этот метабокс
						</tr>";
			}

			$str .= "</table>";
			
			wp_reset_postdata(); 
			
			echo $str;
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		