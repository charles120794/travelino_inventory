<?php 

namespace App\Http\Controllers\Pizza;

use App\Http\Controllers\Pizza\Pizza;
use App\Http\Controllers\Pizza\PizzaBuilderInterface;

class MargarithaBuilder implements PizzaBuilderInterface
{
	protected $pizza;

	public function prepare()
	{
		$this->pizza = new Pizza();

		return $this->pizza;
	}

	public function applyToppings()
	{
		$this->pizza->setToppings(['cheese', 'tomato']);

		return $this->pizza;
	}

	public function bake()
	{
		$this->pizza->setBakingTemperature(180);
		
		$this->pizza->setBakingMinutes(10);

		return $this->pizza;
	}
}