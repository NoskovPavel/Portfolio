<?php

namespace Domna\App;

class Forge
{
    public function burn(Flared $object)
    {
        $flame = $object->burn();
        echo $flame->render((string)$object) . PHP_EOL;
    }
}



