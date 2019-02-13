<?php
/*
Plugin Name: WP-Cumulus (kama fix)
Description: Создает 3D облако меток на flash. Активируйте поддержку шоткодов и используйте шоткод [wp-cumulus], чтобы вывести облако в контенте постоянной страницы. WP 2.8 и выше.
Plugin URI: http://wp-kama.ru/id_4271/wp-cumulus.html
Author URI: http://www.roytanck.com
Author: Roy Tanck
Version: 1.2	
*/

// check for WP context
! defined('ABSPATH') && exit;


// Delay plugin execution until sidebar is loaded
add_action('widgets_init', 'widget_init_wp_cumulus_widget', 9999);

// add the actions
add_action('admin_menu', 'wp_cumulus_add_pages');

register_activation_hook( __FILE__, 'wp_cumulus_install' );


// отмена обновления
add_filter('site_transient_update_plugins', 'wp_cumulus_plugin_updates');
function wp_cumulus_plugin_updates( $value ) {
    unset( $value->response[ plugin_basename(__FILE__) ] );
    return $value;
}



$wp_cumulus_options = get_option('wpcumulus_options');
if( isset( $wp_cumulus_options['postinsert'] ) ){
	if( function_exists('add_shortcode') ){
		add_shortcode('wp-cumulus', 'wp_cumulus_shortcode');
	} else {
		add_filter('the_content','the_content_wp_cumulus_init');
	}
}


function wp_cumulus_def_options(){
	return array(
		'width' => '550',
		'height' => '375',
		'tcolor' => 'ffffff',
		'tcolor2' => 'ffffff',
		'hicolor' => 'ffffff',
		'bgcolor' => '333333',
		'speed' => '150',
		'trans' => 'false',
		'args' => '',
		'mode' => 'tags',
		'compmode' => 'js',
		'showwptags' => 1,
		'postinsert' => 0
	);
}

// template function
function wp_cumulus_insert( $options = array(), $links = '' ){
	echo wp_cumulus_createflashcode( $options, $links );
}

function wp_cumulus_install () {
	$widgetoptions = array(
		'title'   => 'Облако меток',
		'width'   => '250',
		'height'  => '190',
		'tcolor'  => '333333',
		'tcolor2' => '333333',
		'hicolor' => '000000',
		'bgcolor' => 'ffffff',
		'speed'   => '100',
		'trans'   => 'false',
		'args'    => '',
		'mode'    => 'tags'
	);
	
	update_option('wpcumulus_options', wp_cumulus_def_options() );
	update_option('wpcumulus_widget', $widgetoptions);
}

// add the admin page
function wp_cumulus_add_pages() {
	add_options_page('WP Cumulus', 'WP Cumulus', 'manage_options', __FILE__, 'wp_cumulus_options');
}

// replace tag in content with tag cloud (non-shortcode version for WP 2.3.x)
function the_content_wp_cumulus_init( $content ){
	if( strpos($content, '[wp-cumulus]') === false )
		return $content;

	$code = wp_cumulus_createflashcode();
	$content = str_replace( '[wp-cumulus]', $code, $content );
	return $content;
}

// shortcode function
function wp_cumulus_shortcode( $options = array() ){		
	return wp_cumulus_createflashcode( $options );
}

// piece together the flash code
function wp_cumulus_createflashcode( $options = array(), $links = '' ){
	$def_options = get_option('wpcumulus_options');
	
	$options = array_merge($def_options, $options ? $options : array() );

	// определяем ссылки облака
	if( ! $links ){
		$taxonomy = "post_tag";
		if( $options['mode'] == 'cats' )
			$taxonomy = "category";
		elseif( $options['mode'] == 'both' )
			$taxonomy = array('post_tag','category');
		
		$args = wp_parse_args( $options['args'], array('taxonomy' => $taxonomy) );
		$args = array_merge($args, array( 'echo' => 0, 'format' => 'flat' )); // всегда echo=0&format=flat
		
		$links = wp_tag_cloud( $args );
	}
	$links = str_replace( "&nbsp;", " ", $links );
	
	// установим размер если его нет, для простых ссылок
	if( $links && false === strpos($links, 'font-size:') ){
		$links = str_replace( '<a', '<a style="font-size:15px;" ', $links );
	}

	$folder_url = isset($options['folder_url']) ? $options['folder_url'] : plugins_url('wp-cumulus/');
	
	
	// add random seeds to so name and movie url to avoid collisions and force reloading (needed for IE)
	$foo = 'so'. rand(0,99999);
	$movie = $folder_url . 'tagcloud.swf';
	$js = $folder_url . 'swfobject.js';
	$divname = 'divname'.rand(0,999);
	
	$m_links = 'Для показа облака WP-Cumulus необходим <a href="http://www.adobe.com/go/getflashplayer" target="_blank" rel="nofollow">Flash Player</a>.';
	$m_links = ( is_front_page() && !is_paged() ) ?  $m_links . ' <a href="http://wp-kama.ru">Все о WordPress</a> - wp-kama.ru' : $m_links;
	
	// write flash tag
	if( $options['compmode'] == 'js' ){
		$out = '<!-- SWFObject embed by Geoff Stearns geoff@deconcept.com http://blog.deconcept.com/swfobject/ -->';	
		$out .= '<script type="text/javascript" src="'. $js .'"></script>';
		$out .= '<div class="wp-cumulus" style="text-align:center;" id="'. $divname .'">';
		// alternate content
		if( $options['showwptags'] ){
			$out .=  '<p>'. $links .'</p>';
		}
		$out .= '<p style="font-size:9px;">'. $m_links .'</p>';
		$out .= '</div>';
		
		$out .= '<script type="text/javascript">';
		$out .= 'var '.$foo.' = new SWFObject("'.$movie.'", "tagcloudflash", "'.$options['width'].'", "'.$options['height'].'", "9", "#'.$options['bgcolor'].'");';
		if( $options['trans'] == 'true' ){
			$out .= $foo.'.addParam("wmode", "transparent");';
		}
		$out .= $foo .'.addParam("allowScriptAccess", "always");';
		$out .= $foo .'.addVariable("tcolor", "0x'. $options['tcolor'] .'");';
		$out .= $foo .'.addVariable("tcolor2", "0x' . ($options['tcolor2'] == "" ? $options['tcolor'] : $options['tcolor2']) . '");';
		$out .= $foo .'.addVariable("hicolor", "0x' . ($options['hicolor'] == "" ? $options['tcolor'] : $options['hicolor']) . '");';
		$out .= $foo .'.addVariable("tspeed", "'.$options['speed'].'");';
		$out .= $foo .'.addVariable("distr", "true");';
		$out .= $foo .'.addVariable("mode", "tags");';

		// put tags in flashvar
		$out .= $foo.'.addVariable("tagcloud", "'. urlencode('<tags>'. $links .'</tags>') .'");';
		
		$out .= $foo.'.write("'. $divname .'");';
		
		$out .= '</script>';
	}
 	else
	{
		$out = '<object type="application/x-shockwave-flash" data="'.$movie.'" width="'.$options['width'].'" height="'.$options['height'].'">';
		$out .= '<param name="movie" value="'.$movie.'" />';
		$out .= '<param name="bgcolor" value="#'.$options['bgcolor'].'" />';
		$out .= '<param name="AllowScriptAccess" value="always" />';
		if( $options['trans'] == 'true' ){
			$out .= '<param name="wmode" value="transparent" />';
		}
		$out .= '<param name="flashvars" value="';
		$out .= 'tcolor=0x'.$options['tcolor'];
		$out .= '&amp;tcolor2=0x'.$options['tcolor2'];
		$out .= '&amp;hicolor=0x'.$options['hicolor'];
		$out .= '&amp;tspeed='.$options['speed'];
		$out .= '&amp;distr=true';
		$out .= '&amp;mode=tags';
		// Свои ссылки вы облаке
		// put tags in flashvar

		$out .= '&amp;tagcloud='. urlencode('<tags>'. $links .'</tags>');

		$out .= '" />';
		
		// alternate content
		if( $options['showwptags'] ){
			$out .= '<p>'. $links .'</p>';
		}
		$out .= '<p style="font-size:9px;">'. $m_links .'</p>';
		$out .= '</object>';
	}

	return $out;
}

// options page
function wp_cumulus_options(){
	if( ! current_user_can('manage_options') )
		return;
		
	$options = get_option('wpcumulus_options');
	// if submitted, process results
	if ( isset($_POST["wpcumulus_submit"]) ) {
		$data = array('width','height','tcolor','tcolor2','hicolor','bgcolor','speed','trans','distr','args','mode','compmode','showwptags','postinsert');			
		foreach( $data as $val ){
			$options[ $val ] = strip_tags(stripslashes( @$_POST[ $val ] ));
		}
	} 
	elseif( isset($_POST["wpcumulus_reset"]) ){
		$options = wp_cumulus_def_options();
	}

	update_option('wpcumulus_options', $options);

	// options form
	?>
	<form method="post">
	<div class="wrap"><h2>Настройки плагина WP Cumulus</h2>
	<table class="form-table">
		<tr valign="top"><th scope="row">Размеры flash блока</th>
		<td>
			<input type="text" name="width" value="<?php echo $options['width'] ?>" size="5"></input> ширына в px<br>
			<input type="text" name="height" value="<?php echo $options['height'] ?>" size="5"></input> высота в px (рекомендуется 3/4 от ширины)
		</td></tr>
		
		<tr valign="top"><th scope="row">Цвета <br><small>000000 - черный<br> ffffff - белый</small></th>
		<td><input type="text" name="tcolor" value="<?php echo $options['tcolor'] ?>" size="8" /> цвет больших тегов (конечный)<br />
			<input type="text" name="tcolor2" value="<?php echo $options['tcolor2'] ?>" size="8" /> цвет маленьких тегов (начальный)<br />
			<input type="text" name="hicolor" value="<?php echo $options['hicolor'] ?>" size="8" /> цвет при наведении<br />
			<input type="text" name="bgcolor" value="<?php echo $options['bgcolor'] ?>" size="8"></input> цвет фона</td></tr>
		
		<tr valign="top"><th scope="row">Скорость вращения</th>
		<td><input type="text" name="speed" value="<?php echo $options['speed'] ?>" size="8" /> скорость (в процентах)</td></tr>
		
		<tr valign="top"><th scope="row">Режим прозрачности</th>
		<td><label><input type="checkbox" name="trans" value="true" <?php checked( $options['trans'], "true" ) ?> /> включить прозрачный фон во Flash (не рекомендуется)</label></td></tr>

		<tr valign="top">
		<th scope="row">Настройки вывода. Отображать:</th>
		<td><label><input type="radio" name="mode" value="tags" <?php checked( $options['mode'], "tags" ) ?> /> Теги</label>
		<br /><label><input type="radio" name="mode" value="cats" <?php checked( $options['mode'], "cats" ) ?>/> Рубрики</label>
		<br /><label><input type="radio" name="mode" value="both" <?php checked( $options['mode'], "both" ) ?> /> И теги и рубрики</label>
		</td>
		</tr>
	</table>

	
	<h3>Расширенные настройки</h3>
	<table class="form-table">
	
		<tr valign="top">
			<th scope="row">Параметры функции wp_tag_cloud</th>
			<td><input type="text" name="args" value="<?php echo $options['args'] ?>" style="width:90%"></input><br />
			<br />
			Строка с параметрами определяющие какие ссылки и как выводить в облаке.
			<b>Все параметры:</b><br />
			smallest - размер текста для меток с меньшим количеством записей. По умолчанию 8.<br />
largest - размер текста для меток с большим количеством записей. По умолчанию 22.<br />
unit - единица измерения размера для smallest и largest. Может быть:pt, px, em, %. По умолчанию pt.<br />
number - максимально количество меток, которое будет показано. Если установить на 0, то будут показаны все метки без ограничения. По умолчанию 45.<br />
exclude - исключить указанные метки. Указывать нужно ID через запятую.<br />
include - показать только указанные метки. Указывать нужно ID через запятую.<br />
taxonomy - название таксономии, из терминов которой будет построено облако. Благодаря этому параметру, можно вывести термины из любой таксономии, не только метки или категории.<br />
			<b>Пример:</b><br />
			smallest=5&largest=50 - укажет размер шрифта от 5px до 50px, зависит от того, сколько у метки записей.<br />
			</td>
		</tr>

		<tr valign="top"><th scope="row">Показывать обычное HTML облако тегов?</th>
		<td><label><input type="checkbox" name="showwptags" value="1" <?php checked( $options['showwptags'], 1 ) ?> /> включение этой надстройки активирует создание HTML облака тегов (пока не загрузиться flash облако будет видно стандартное HTML облако). Распространяется и на виджет.</label></td></tr>

		<tr valign="top"><th scope="row">Шоткод <code>[wp-cumulus]</code></th>
		<td><label><input type="checkbox" name="postinsert" value="1" <?php checked( $options['postinsert'], 1 ) ?> /> включить возможность использовать шоткод <code>[wp-cumulus]</code> в постах.</label></td></tr>
		
		<tr valign="top"><th scope="row">Использовать режим совместимости?</th>
			<td><label><input type="checkbox" name="compmode" value="js" <?php checked( $options['compmode'], 'js' ) ?> /> вставлять flash как javascript, а не object. Используйте, если flash не отображается (распространяется и на виджет).</label></td>
		</tr>

	</table>
	<p class="submit">
		<input type="submit" name="wpcumulus_submit" class="button-primary" value="Сохранить Настройки &raquo;" />
		<input type="submit" name="wpcumulus_reset" class="button" value="Сбросить настройки на начальные" onclick="return confirm('Точно сбросить настройки?');" />
	</p>
	</div>
	</form>
	<?php
}




// widget
function widget_init_wp_cumulus_widget() {
	// Check for required functions

	if ( ! function_exists('wp_register_sidebar_widget') || ! is_dynamic_sidebar() )
		return;

	function wp_cumulus_widget($args){
	    extract($args);
		$options = get_option('wpcumulus_widget');

	        echo $before_widget;
			if( !empty($options['title']) )
				echo $before_title . $options['title'] . $after_title;
			
			if( !stristr( $_SERVER['PHP_SELF'], 'widgets.php' ) )				
				echo wp_cumulus_createflashcode( $options );
			
	        echo $after_widget;
	}
	
	function wp_cumulus_widget_control() {
		$widget_options = get_option('wpcumulus_widget');
		
		$widget_options_data = array('title','width','height','tcolor','tcolor2','hicolor','bgcolor','speed','trans','distr','args','mode');
		extract( $widget_options_data ); // for php notice
		if ( isset( $_POST["wpcumulus_widget_submit"] ) ) {
			
			foreach( $widget_options_data as $val ){
				$widget_options['temp'][ $val ] = strip_tags( stripslashes( @$_POST["wpcumulus_widget_". $val ] ) );
			}
			$widget_options = $widget_options['temp'];
			// сохраняем
			update_option('wpcumulus_widget', $widget_options);
			
		}
		
		$widget_options = array_map('esc_attr', $widget_options);
		extract( $widget_options );
		?>
		<style>
			.wpcumulus_widget { margin-left:5px; }
			.wpcumulus_widget p b{ margin-left:-5px; }
		</style>
		<div class="wpcumulus_widget">
		<p><b>Заголовок виджета:</b><br>
			<input class="widefat" name="wpcumulus_widget_title" type="text" value="<?php echo $title ?>" />
		</p>
				
		<p><b>Настройки flash:</b><br>
			<label><input class="widefat" style="width:100px;" name="wpcumulus_widget_width" type="text" value="<?php echo $width; ?>" /> ширина</label><br>
			<label><input class="widefat" style="width:100px;" name="wpcumulus_widget_height" type="text" value="<?php echo $height; ?>" /> высота (лучше 3/4 от ширины)</label><br>
			<label><input class="widefat" style="width:100px;" name="wpcumulus_widget_speed" type="text" value="<?php echo $speed; ?>" /></label> cкорость вращения<br><br>
			<label><input class="checkbox" name="wpcumulus_widget_trans" type="checkbox" value="true" <?php if( $trans == "true" ){ echo ' checked="checked"'; } ?> > прозрачный фон flash (не рекомендуется)</label><br>			
		</p>
		
		<p><b>Настройки цветов flash:</b><br>
			<label><input class="widefat" style="width:100px;" name="wpcumulus_widget_tcolor" type="text" value="<?php echo $tcolor; ?>" /> цвет крупных тегов</label><br>
			<label><input class="widefat" style="width:100px;" name="wpcumulus_widget_tcolor2" type="text" value="<?php echo $tcolor2; ?>" /> цвет мелких тегов</label><br>
			<label><input class="widefat" style="width:100px;" name="wpcumulus_widget_hicolor" type="text" value="<?php echo $hicolor; ?>" /> цвет при наведении</label><br>
			<label><input class="widefat" style="width:100px;" name="wpcumulus_widget_bgcolor" type="text" value="<?php echo $bgcolor; ?>" /> цвет фона</label> 
		</p>
		
		<p><b>Настройки вывода, отображать:</b><br>
			<label><input class="radio" name="wpcumulus_widget_mode" type="radio" value="tags" <?php if( $mode == "tags" ){ echo ' checked="checked"'; } ?> > теги</label><br />
			<label><input class="radio" name="wpcumulus_widget_mode" type="radio" value="cats" <?php if( $mode == "cats" ){ echo ' checked="checked"'; } ?> > рубрики</label><br />
			<label><input class="radio" name="wpcumulus_widget_mode" type="radio" value="both" <?php if( $mode == "both" ){ echo ' checked="checked"'; } ?> > и теги и рубрики</label>
		</p>
		
		<p><b>Параметры функции wp_tag_cloud <a target="_blank" href="http://wp-kama.ru/function/wp_tag_cloud#parametrs">доступные параметры</a>:</b><br>
			
			<input class="widefat" name="wpcumulus_widget_args" type="text" value="<?php echo $args; ?>" />
		</p>
	
		<input type="hidden" id="wpcumulus_widget_submit" name="wpcumulus_widget_submit" value="1" />
		
		</div>
		<?php
	}
	
	wp_register_sidebar_widget( 'wp-cumulus', "wp-cumulus", 'wp_cumulus_widget' );
	wp_register_widget_control( 'wp-cumulus', "wp-cumulus", "wp_cumulus_widget_control" );
}