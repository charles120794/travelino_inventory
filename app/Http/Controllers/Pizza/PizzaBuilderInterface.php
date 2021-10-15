<?php 

namespace App\Http\Controllers\Pizza;

interface PizzaBuilderInterface
{
	public function prepare();

	public function applyToppings();

	public function bake();
}