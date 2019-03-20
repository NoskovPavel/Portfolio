<?php

namespace Farm\App\Animals;

use farm\App\Animal;

class Chicken extends Animal
{
    public function say()
    {
        echo 'Ко-ко-ко!' . PHP_EOL;
    }
}
