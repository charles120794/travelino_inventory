<?php

namespace App\Http\Traits\Retrieves;

use App\Model\Accounts\UsersWindowAccess;

trait SystemWindowMethodTrait
{

	public function activeWindowMethod()
	{
		return $this->activeModule()->systemWindowMethodInfo;
	}

}