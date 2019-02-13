<?php
//максимальный размер файла в байтах
$maxSizeFile = 5242880;

//допустимые форматы файлов
$mimeTypes = ['image/jpg', 'image/jpeg', 'image/png'];

//допустимое количество загрузки файлов за один раз
$validNumber = 5;

ob_start();

//если форма была отправлена
if (isset($_FILES['myfile'])) {

    //массив с описанием загружаемых файлов  
    $files = $_FILES['myfile']; 

    //Количество загружаемых файлов
    $fileNumber = count($files['name']);

    //Если картинок передано 5 или меньше загружаем их
    if ($fileNumber <= $validNumber){

        //Идем по массиву
        for ($i = 0;  $i < $fileNumber; $i++) {
            //Имя файла   
            $fileName = $files['name'][$i];

            //Тип файла  
            $fileMime = $files['type'][$i];

            //если файл не правильного формата завершаем его обработку переходим к следующему
            if (!in_array($fileMime, $mimeTypes)) {
                echo "Извините, файл $fileName незагружен, вы можете загрузить только файлы форматов jpeg, png, jpg\r\n";
                continue;
            }

            //если файл больше допустимого размера завершаем его обработку переходим к следующему
            if ($files['size'][$i] > $maxSizeFile) {
                echo "Извините, файл $fileName незагружен, вы можете загрузить только файлы не более 5 МВ\r\n";
                continue;
            }  
            //Загружаем
            //Папка для загрузки  
            $uploadPath = $_SERVER['DOCUMENT_ROOT'] . '/upload/';   
            //Если нет ошибок загружаем файл на сервер
            if (!empty($files['error'][$i])) {
                echo "Произошла ошибка загрузки файла $fileName!\r\n";     
            } else {
                if (move_uploaded_file($files['tmp_name'][$i], $uploadPath . $files['name'][$i])) {
                    //echo "Успешно.\r\n";
                } else {
                    echo "Произошла ошибка загрузки файла $fileName!\r\n"; 
                }                
            }    
        }     
    } else {
        //если файлов более 5 - незагружаем
        echo "Вы можете загрузить не более 5 картинок.\r\n";
    }

    $req = false; // изначально переменная для "ответа" - false  
    $req = ob_get_contents();
    ob_end_clean();
    echo json_encode($req); // вернем полученное в ответе
    exit;
}