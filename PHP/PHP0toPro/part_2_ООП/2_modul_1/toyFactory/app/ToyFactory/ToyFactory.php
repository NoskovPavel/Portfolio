<?php

namespace toyFactory\App\ToyFactory;

class ToyFactory 
{
	public function createToy($name)
	{
		return new \toyFactory\App\Toy\Toy($name, rand(1, 300));
	}
}