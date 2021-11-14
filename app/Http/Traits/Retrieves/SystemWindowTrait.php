<?php

namespace App\Http\Traits\Retrieves;

use App\Model\Accounts\UsersWindowAccess;

trait SystemWindowTrait
{

	public function activeWindow()
	{
		return $this->activeModule()->systemWindowInfo()->where('window_path', active_path())->first();
	}

}