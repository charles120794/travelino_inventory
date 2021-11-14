<?php 

namespace App\Model\Settings;

use App\Model\Accounts\UsersCompanyAccess;

use Illuminate\Database\Eloquent\Model;

class SystemCompany extends Model
{
	protected $table = 'system_company';

	protected $primaryKey = 'company_id';

	public $timestamps = false;

	public function usersAccess()
	{
		return $this->hasMany(UsersCompanyAccess::class,'access_company_id','company_id')->with('userInfo');
	}

	public function moduleAccess()
	{
		return $this->hasMany(SystemCompanyModule::class,'access_company_company_id','company_id');
	}

	public function updatedBy()
	{
		return $this->signaTory('updated_by');
	}

	public function createdBy()
	{
		return $this->signaTory('created_by');
	}

	public function signaTory($column)
	{
		$exists = $this->hasOne(User::class,'users_id', $column)->first();

		return (count($exists) > 0) ? $exists->firstname : '' ;
	}
}