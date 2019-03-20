<?php

namespace Blackbox\App;

class Plane
{
    private $blackBox;

    public function __construct(BlackBox $blackBox)
    {
        $this->blackBox = $blackBox;
    }

    public function flyAndCrush()
    {
        $this->flyProcess();
        $this->crushProcess();
    }

    public function flyProcess ()
    {
        //пишет лог в черный ящик
        $this->addLog("Взлетели!");
    }

    final public function crushProcess ()
    {
        //пишет лог в черный ящик
        $this->addLog("Крушение!");
    }

    protected function addLog($message)
    {
        //передает сообщение для записи в лог черного ящика.
        $this->blackBox->addLog($message);
    }

    public function getBoxForEngineer(Engineer $engineer)
    {
       $engineer->setBox($this->blackBox);
    }
}



