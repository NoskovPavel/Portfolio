<!--
	Для этой задачи возьмите предыдущий массив, положите его в переменную $result3 (Ctrl + C -> Ctrl + V). Ключами для каждого из авторов сделайте их email - чтобы на основе email автора у книги можно было получить автора. И теперь добавьте каждому автору еще и год рождения.
	Выведите информацию по всем книгам, в формате:
	“Книга <Название книги>, ее написал <Фио автора> <Год Рождения автора> (<email автора>)”
	Затем перемешайте (Найдите подходящую функцию) книги и снова выведите информацию по книгам.
-->

<?php
$result3 = [
    'AUTHORS' => [
    	'petrov@mail.ru'  =>  [
            'name'       => 'Петров Андрей Сергеевич',
            'birth_year' => '1956 г.р.',
         ],
        'ivanov@mail.ru'  =>  [
            'name'       => 'Иванов Павел Петрович',
         	'birth_year' => '1962 г.р.',
         ],
        'sidorov@mail.ru' =>  [
            'name'       => 'Сидоров Николай Борисович',
         	'birth_year' => '1975 г.р.',
         ],
    ],		    
    'BOOKS' => [
        [
            'book_name' => 'О природе вещей',
            'email'     => 'ivanov@mail.ru',
        ],
        [
            'book_name' => 'Вторая',
            'email'     => 'petrov@mail.ru',
        ],
        [
            'book_name' => 'Синяя',
            'email'     => 'petrov@mail.ru',
        ],
    ],
];

//Вывод “Книга <Название книги>, ее написал <Фио автора> <Год Рождения автора> (<email автора>)”
foreach ($result3['BOOKS'] as $value) {
	//Найдем автора книги по email книги 
	$author = $result3['AUTHORS'][$value['email']];

	echo 'Книга \''.$value['book_name'].'\', ее написал '.$author['name'].' '.
	      $author['birth_year'].' ('.$value['email'].')</br>';
};		

//перемешаем массив
shuffle($result3['BOOKS']);

//визуальное разделение результата
echo '</br>';

//Вывод “Книга <Название книги>, ее написал <Фио автора> <Год Рождения автора> (<email автора>)”
foreach ($result3['BOOKS'] as $value) {
	//Найдем автора книги по email книги 
	$author = $result3['AUTHORS'][$value['email']];

	echo 'Книга \''.$value['book_name'].'\', ее написал '.$author['name'].' '.
	      $author['birth_year'].' ('.$value['email'].')</br>';
};	
?>	

	