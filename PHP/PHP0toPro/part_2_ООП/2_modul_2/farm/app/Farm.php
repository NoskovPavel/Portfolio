<?php

namespace Farm\App;

class Farm
{
	public $animals = [];

	public function addAnimal($animal)
	{
        array_push($this->animals, $animal);
		$animal->walk();
	}

    public function rollCall()
    {
        shuffle($this->animals);
        foreach ($this->animals as $value) {
            $value->say();
        }
    }
}



