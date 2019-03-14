<?php

namespace notice\App\User;

class User
{
	public $fio;
	public $email;
	public $sex;
	public $age;
	public $phone;

	public function __construct($fio, $email, $sex = "", $age = "", $phone = "") 
	{
		$this->fio   = $fio;
		$this->email = $email;
		$this->sex   = $sex;
		$this->age   = $age;
		$this->phone = $phone;
	}

	public function notifyOnEmail($message) 
	{
		$this->send("email", $message);		
	}  

	public function notifyOnPhone($message) 
	{ 
		$this->send("phone", $message);
	}

	public function notify($message) 
	{		 
		if ($this->age < 18) {
			$message = $this->censor($message);
		}
		$this->notifyOnEmail($message);
		if ($this->phone != '') {
			$this->notifyOnPhone($message);
		}		
	}

	public function censor($message) 
	{
		$taboo = ["sex", "drugs", "rock'n'roll"];
		$result = str_replace($taboo, "candy", $message);
		return $result;
	}

	public function send($link, $message) 
	{
		echo "Уведомление клиенту: {$this->fio} на  $link({$this->$link}): {$message}</br>";		
	}
}