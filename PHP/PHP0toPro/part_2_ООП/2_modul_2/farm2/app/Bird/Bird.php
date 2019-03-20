<?php

namespace Farm2\App\Bird;

use Farm2\App\Animal;

class Bird extends Animal
{
    public function say()
    {
        echo '' . PHP_EOL;
    }

    function tryToFly()
    {
        echo 'Вжих-Вжих-топ-топ' . '</br>';
    }
}



