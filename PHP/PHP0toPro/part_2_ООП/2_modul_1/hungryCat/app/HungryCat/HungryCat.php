<?php

namespace hungryCat\App\HungryCat;

class HungryCat
{
	public $name;
	public $color;
	public $favoriteFood;

	public function __construct($name, $color, $favoriteFood) 
	{
		$this->name = $name;
		$this->color = $color;
		$this->favoriteFood = $favoriteFood;
	}

	public function eat($food) 
	{
		$text = "Голодный кот " . $this->name . ", особые приметы: цвет - " . $this->color . ", съел " .  $food;
		if ($food == $this->favoriteFood) {
			$text .= " и замурчал 'мррррр' от своей любимой еды";
		}
		echo $text . "</br>";
	}	
}