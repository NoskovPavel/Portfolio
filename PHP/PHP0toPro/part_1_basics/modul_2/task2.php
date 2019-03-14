<!--
	Теперь расширим этот массив - создадим новый, в котором будет много авторов и много книг. Создайте многомерный массив $result2 - с двумя ключами ‘AUTHORS’ и ‘BOOKS’:
	в индекс ‘AUTHORS’ добавьте многомерный массив каждый элемент которого является автором, т.е. ассоциативным массивов данных об авторе: фио, email (как в задании 1);
	в индекс ‘BOOKS’ добавьте массив каждый элемент которого является книгой, т.е. ассоциативным массивов данных о книге: название и email автора (как в задании 1);
	Создайте несколько авторов и несколько книг;
	Выведите массив.
-->
<pre>
	<?php
	$result2 = [
	    'AUTHORS' => [
	    	[
	    		'name'   => 'Петров Андрей Сергеевич',
             	'email'  => 'petrov@mail.ru',
            ],
            [
             	'name'   => 'Иванов Павел Петрович',
            	 'email'  => 'ivanov@mail.ru',
            ],
            [
             	'name'   => 'Сидоров Николай Борисович',
             	'email'  => 'sidorov@mail.ru',
            ],
	    ],
	    'BOOKS'   => [
	        [
	         	'book_name'  => 'О природе вещей.',
             	'email'      => 'ivanov@mail.ru',
            ],
            [
             	'book_name'  => 'Вторая',
             	'email'      => 'petrov@mail.ru',
            ],
            [
             	'book_name'  => 'Синяя',
             	'email'      => 'petrov@mail.ru',
            ],
	    ],
	];

	var_dump($result2);
	?>	
</pre>
		