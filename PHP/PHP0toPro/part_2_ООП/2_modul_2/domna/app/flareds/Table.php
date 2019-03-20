<?php

namespace Domna\App\Flareds;

use Domna\App\BlueFlame;
use Domna\App\Flared;

class Table implements Flared
{
    public function burn()
    {
        return new BlueFlame();
    }

    public function __toString()
    {
    return (new \ReflectionClass($this))->getShortName();
    }
}



