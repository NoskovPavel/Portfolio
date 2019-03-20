<?php

namespace Blackbox\App;

class BlackBox
{
    private $data = [];

    public function addLog($message)
    {
        //добавляет очередную строку в свое свойство $data
        array_push($this->data, $message);
    }

    public function getDataForEngineer(Engineer $engineer)
    {
        //возвращает свои данные для инженера
        $engineer->data = $this->data;
    }
}



