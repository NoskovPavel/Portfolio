<?php

namespace Domna\App\Flareds;

use Domna\App\Flared;
use Domna\App\RedFlame;

class Torchere implements Flared
{
    public function burn()
    {
        return new RedFlame();
    }

    public function __toString()
    {
    return (new \ReflectionClass($this))->getShortName();
    }
}



