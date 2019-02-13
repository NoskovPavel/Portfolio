<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (!empty($_POST['uname']) && (!empty($_POST['uemail']) || !empty($_POST['uphone']))){
    if (isset($_POST['uname'])) {
        if (!empty($_POST['uname'])){
          $uname = strip_tags($_POST['uname']) . "<br>";
          $unameFieldset = "<b>Имя пославшего:</b>";
         }
    }
    if (isset($_POST['uemail'])) {
        if (!empty($_POST['uemail'])){
          $uemail = strip_tags($_POST['uemail']) . "<br>";
          $uemailFieldset = "<b>Почта:</b>";
        }
    }
    if (isset($_POST['uphone'])) {
        if (!empty($_POST['uphone'])){
          $uphone = strip_tags($_POST['uphone']) . "<br>";
          $uphoneFieldset = "<b>Телефон:</b>";
        }
    }
    if (isset($_POST['formInfo'])) {
        if (!empty($_POST['formInfo'])){
          $formInfo = strip_tags($_POST['formInfo']);
          $formInfoFieldset = "<b>Тема:</b>";
        }
    }
    /*Адрес, на который должно приходить письмо*/
    $to = "noskov_pavel@mail.ru"; 
    /*Адрес, с которого будет приходить письмо */
    $sendfrom = "noskovpavel@yandex.ru"; 
    $headers  = "From: " . strip_tags($sendfrom) . "\r\n";
    $headers .= "Reply-To: ". strip_tags($sendfrom) . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html;charset=utf-8 \r\n";
    $headers .= "Content-Transfer-Encoding: 8bit \r\n";
    $subject = "$formInfo";
    $message = "$unameFieldset $uname
                $uemailFieldset $uemail
                $uphoneFieldset $uphone
                $formInfoFieldset $formInfo";
 
    $send = mail ($to, $subject, $message, $headers);
        if ($send == 'true') {
            echo '<p class="success">Спасибо за отправку вашего сообщения!</p>';
        } else {
          echo '<p class="fail"><b>Ошибка. Сообщение не отправлено!</b></p>';
        }
  } else {
    echo '<p class="fail">Ошибка. Вы заполнили не все обязательные поля!</p>';
  }
} else {
  header ("Location: https://noskovpavel.ru"); 
}