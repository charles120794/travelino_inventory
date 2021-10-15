<?php

namespace App\Http\Controllers\Pizza;

use App\Http\Controllers\Pizza\PizzaFactoryContract;

class PizzaFactory implements PizzaFactoryContract
{
	public function make($toppings = [])
	{
		return new Pizza($toppings);
	}
}