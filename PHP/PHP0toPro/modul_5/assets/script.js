$(function(){
  $('#my_form').on('submit', function(e){
    e.preventDefault();
    var $that = $(this);   
    formData = new FormData($that.get(0)); // создаем новый экземпляр объекта и передаем ему нашу форму (*)
    $.ajax({
      url: $that.attr('action'),
      type: $that.attr('method'),
      contentType: false, //убираем форматирование данных по умолчанию
      processData: false, // убираем преобразование строк по умолчанию
      data: formData,
      dataType: 'json',
      success: function(json){
        $('.success').html(json);                
      }
    });
  });
});