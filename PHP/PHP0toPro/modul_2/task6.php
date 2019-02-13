<!--
	Создайте переменную $studentsCount - присвойте ей случайное значение от 1 до 1000000
	Создайте программу, которая выведет в нужной форме текстовое сообщение, например такие “на учебе 100 студентов”, или “на учебе 2 студента” и т.д.
-->

<?php
$studentsCount = rand(0, 1000000);
$str = "студентов";

function getUnitCase($value, $unit1, $unit2, $unit3) {
    $value = abs((int)$value);
    if (($value % 100 >= 11) && ($value % 100 <= 19)) {
        return $unit3;
    } else {
        switch ($value % 10) {
            case 1:
                return $unit1;
            case 2:
            case 3:
            case 4:
                return $unit2;
            default:
                return $unit3;
        }
    }
};
echo "на учебе $studentsCount ".getUnitCase($studentsCount, 'студент', 'студента', 'студентов');

	

	