<?php 

namespace Farm\App\Animals;

use farm\App\Animal;

class Pig extends Animal
{
    public function say()
    {
        echo 'Хрю-хрю!' . PHP_EOL;
    }
}

