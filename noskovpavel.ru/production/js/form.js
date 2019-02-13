$(document).ready(function () {
    $("form").submit(function () {
        // Получение ID формы
        var formID = $(this).attr('id');

        // Добавление решётки к имени ID
        var formNm = $('#' + formID);

        // Ищет класс .msgs в текущей форме  и записываем в переменную
        var message = $(formNm).find(".msgs"); 

        // Ищет класс .formtitle в текущей форме и записываем в переменную
        var formTitle = $(formNm).find(".formTitle");        
        $.ajax({
            type: "POST",
            url: 'mail.php',
            data: formNm.serialize(),            
            success: function (data) {
              // Вывод сообщения об успешной отправке
              message.html(data);
              formTitle.css("display","none");
              setTimeout(function(){
                $('.formTitle').css("display","block");
                $('.msgs').html('');
                $('input').not(':input[type=submit], :input[type=hidden]').val('');
              }, 3000);
            },
            error: function (jqXHR, text, error) {
                // Вывод сообщения об ошибке отправки
                message.html(error);
                formTitle.css("display","none");                
                setTimeout(function(){                  
                  $('.formTitle').css("display","block");
                  $('.msgs').html('');
                  $('input').not(':input[type=submit], :input[type=hidden]').val('');
                }, 3000);
            }
        });
        return false;
    });
    //для стилей формы
      var $input = $('.form-fieldset > input');
      $input.blur(function (e) {
        $(this).toggleClass('filled', !!$(this).val());
      });

      //Заполнение нужного атрибута если кнопок несколько
      $(".linkButton").click(function() {        
          $( "input[name*='formInfo']" ).val($(this).attr( "title" ));
      });

});