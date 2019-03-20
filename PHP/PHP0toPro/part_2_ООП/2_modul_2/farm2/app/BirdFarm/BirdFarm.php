<?php

namespace Farm2\App\BirdFarm;

use Farm2\App\Farm;

class BirdFarm extends Farm
{
    public function addAnimal($animal)
    {
        array_push($this->animals, $animal);
        $this->showAnimalsCount();
    }

    function showAnimalsCount()
    {
        echo "Птиц на ферме: " . count($this->animals) . '</br>';
    }

}



