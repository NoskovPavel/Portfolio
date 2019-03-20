<?php

namespace Farm2\App\Hoof;

use Farm2\App\Animal;

class Hoof extends Animal
{
    public function say()
    {
        echo '' . PHP_EOL;
    }
    public function walk()
    {
        echo 'топ-топ' . '</br>';
    }
}


