<?php

namespace Domna\App\Flareds;

use Domna\App\Flared;
use Domna\App\RedFlame;

class WoodenBoard implements Flared
{
    public function burn()
    {
        return new RedFlame();
    }

    public function __toString()
    {
    return self::class;
    }
}



