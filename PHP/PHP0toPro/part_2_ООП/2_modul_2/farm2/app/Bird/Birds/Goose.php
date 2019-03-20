<?php

namespace Farm2\App\Bird\Birds;

use Farm2\App\Bird\Bird;

class Goose extends Bird
{
    public function say()
    {
        echo 'Га-га-га!' . PHP_EOL;
    }
}