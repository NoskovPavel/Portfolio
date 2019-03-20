<?php

namespace Domna\App\Flareds;

use Domna\App\Flared;
use Domna\App\Smoke;

class Glass implements Flared
{
    public function burn()
    {
        return new Smoke();
    }

    public function __toString()
    {
    return (new \ReflectionClass($this))->getShortName();
    }
}



