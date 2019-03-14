<?php

namespace eshop\App\Order;

class Order
{
	public $basket;

	public function __construct(\eshop\App\Basket\Basket $basket) 
	{
		$this->basket = $basket;
	}

	public function getBasket()
	{
		return $this->basket;
	}

	//Возвращает общую стоимость заказа
	public function getPrice()
	{		
		return $this->basket->getprice();
	}	
}