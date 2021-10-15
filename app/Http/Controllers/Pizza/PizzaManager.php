<?php

namespace App\Http\Controllers\Pizza;

use Illuminate\Support\Manager;
use App\Http\Controllers\Pizza\MargarithaBuilder;

class PizzaManager extends Manager
{
	protected defaultDriver = 'margaritha'

	public function getDefaultDriver()
	{
		return $this->defaultDriver;
	}

	public function createMargarithaDriver()
	{
		return new MargarithaBuilder();
	}
}