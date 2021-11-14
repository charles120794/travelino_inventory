<?php

namespace App\Http\Traits\Payments;

use Crypt;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Common\CommonServiceController as CommonService;

trait AccountTrait
{	
	public function updateProfile_API(Request $request)
	{
		$userID = encrypt($this->thisUser()->users_id);

		return $this->accounts_update_users_information([], $userID, $request);
	}

	public function updatePassword_API(Request $request)
	{
		$userID = encrypt($this->thisUser()->users_id);

		return $this->accounts_update_users_password([], $userID, $request);
	}
}