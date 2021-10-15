<?php 

namespace App\Http\Controllers\Pizza;

use App\Http\Controllers\Pizza\PizzaBuilderInterface;

class PizzaBuilder
{
	public function make(PizzaBuilderInterface $pizza)
	{
		return $pizza->prepare()->applyToppings()->bake();
	}
}