<?php

namespace homeZoo\App\Dog;

class Dog
{
	public $name;

	public function __construct($name)
	{
		$this->name = $name;
	}
}