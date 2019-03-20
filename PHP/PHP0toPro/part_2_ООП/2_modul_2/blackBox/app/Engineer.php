<?php

namespace Blackbox\App;

class Engineer
{
    public $data;

    public function setBox(BlackBox $blackBox)
    {
        //устанавливает черный ящик для дешифрации у инженера
         $blackBox->getDataForEngineer($this);
    }

    public function takeBox(Plane $plane)
    {
        //должен доставать черный ящик из самолета (посмотрите какой подходящий метод есть в классе Plane)
        $plane->getBoxForEngineer($this);
    }

    public function decodeBox()
    {
    //декодирует черный ящик - выводит на экран лог черного ящика
        foreach ($this->data as $value) {
            echo $value;
        }
    }
}



