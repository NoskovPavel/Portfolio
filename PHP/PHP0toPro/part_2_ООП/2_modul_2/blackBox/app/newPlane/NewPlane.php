<?php

namespace Blackbox\App\NewPlane;

class NewPlane extends \Blackbox\App\Plane
{
    private $blackBox;

    public function flyProcess ()
    {
        //пишет лог в черный ящик
        $this->addLog("Другой самолет взлетел!");
    }
}



