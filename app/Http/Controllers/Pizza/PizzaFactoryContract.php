<?php 

namespace App\Http\Controllers\Pizza;

interface PizzaFactoryContract
{
	public function make($toppings = []);
}