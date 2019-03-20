<?php

namespace Farm2\App\Bird\Birds;

use Farm2\App\Bird\Bird;

class Chicken extends Bird
{
    public function say()
    {
        echo 'Ко-ко-ко!' . PHP_EOL;
    }
}
