<?php

namespace Farm\App\Animals;

use farm\App\Animal;

class Cow extends Animal
{
    public function say()
    {
        echo 'Му!' . PHP_EOL;
    }
}

