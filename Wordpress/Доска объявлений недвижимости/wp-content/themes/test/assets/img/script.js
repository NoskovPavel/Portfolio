function ajax_go(data, jqForm, options) { //ф-я перед отправкой запроса
  	jQuery('#output').html('Отправляем...'); // в див для ответа напишем "отправляем.."
  	jQuery('#sub').attr("disabled", "disabled"); // кнопку выключим
}
function response_go(out)  { // ф-я обработки ответа от wp, в out будет элемент success(bool), который зависит от ф-и вывода которую мы использовали в обработке(wp_send_json_error() или wp_send_json_success()), и элемент data в котором будет все что мы передали аргументом к ф-и wp_send_json_success() или wp_send_json_error()
	console.log(out); // для дебага
	jQuery('#sub').prop("disabled", false); // кнопку включим
	jQuery('#output').html(out.data); // выведем результат
}
jQuery(document).ready(function(){ // после загрузки страницы
	//jQuery("#child_cats").chained("#parent_cats");  // подключаем плагин для связи селект листов с терминами вложенной таксономии
  	add_form = jQuery('#add_object'); // запишем форму в переменную
  	var options = { // опции для отправки формы с помощью jquery form
  		data: { // дополнительные параметры для отправки вместе с данными формы
  			action : 'add_object_ajax', // этот параметр будет указывать wp какой экшн запустить, у нас это wp_ajax_nopriv_add_object_ajax
        	nonce: ajaxdata.nonce // строка для проверки, что форма отправлена откуда надо
    	},
      	dataType:  'json', // ответ ждем в json формате
      	beforeSubmit: ajax_go, // перед отправкой вызовем функцию ajax_go()
      	success: response_go, // после получении ответа вызовем response_go()
      	error: function(request, status, error) { // в случае ошибки
        	console.log(arguments); // напишем все в консоль
      	},
      	url: ajaxdata.url // куда слать форму, переменную с url мы определили вывели в нулевом шаге     
  }; 
  add_form.ajaxForm(options); // подрубаем плагин jquery form с опциями на нашу форму 

  jQuery('#add_img').click(function(e){ // по клику на ссылку "Добавить еще фото"
    e.preventDefault(); // выключим стандартное поведение ссылки
    jQuery(this).before("<label class='imgs'>Еще фото<input type='file' name='imgs[]'/></label>"); // добавим перед ссылкой еще один инпут типа файл с таким же нэймом
  });  
});