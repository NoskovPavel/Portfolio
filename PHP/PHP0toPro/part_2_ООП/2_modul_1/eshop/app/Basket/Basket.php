<?php

namespace eshop\App\Basket;

class Basket
{
	public $products = [];

	//Добавляет товар/цена в корзину как ассоциативный массив
	public function addProduct(\eshop\App\Product\Product $product, $quantity) 
	{		
		array_push($this->products, ['product' => $product, 'quantity' => $quantity]);
	}

	//Возвращает стоимость товаров в корзине
	public function getPrice() 
	{
		$result = 0;

		foreach ($this->products as $value) {
			$result += $value['product']->price * $value['quantity'];
		}

		return $result;	
	}

	//Выводит информацию по товарам в корзине
	public function describe() 
	{
		$result = "";
		foreach ($this->products as $value) {
			$result .= "{$value['product']->name} - {$value['product']->price} - {$value['quantity']}</br>";
		}
		return $result;
	}
}