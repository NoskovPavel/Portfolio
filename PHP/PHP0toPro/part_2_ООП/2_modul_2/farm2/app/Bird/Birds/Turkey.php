<?php

namespace Farm2\App\Bird\Birds;

use Farm2\App\Bird\Bird;

class Turkey extends Bird
{
    public function say()
    {
        echo 'Улю-улю!' . PHP_EOL;
    }
}