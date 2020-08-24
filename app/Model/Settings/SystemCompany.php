<?php 

namespace App\Model\Settings;

use App\User;
use Illuminate\Database\Eloquent\Model;

class SystemCompany extends Model
{
		
	// protected $connection = 'settings';

	protected $table = 'system_company';

	protected $primaryKey = 'company_id';

	public $timestamps = false;

	public function usersInfo()
	{
		return $this->hasMany(User::class,'company_id','company_id');
	}

	public function companyModuleInfo()
	{
		return $this->hasMany(SystemCompanyModule::class,'company_id','company_id');
	}

	public function companyDetailsInfo()
	{
		return $this->hasMany(SystemCompanyDetails::class,'company_id','company_id');
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