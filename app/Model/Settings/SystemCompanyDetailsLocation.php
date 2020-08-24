<?php 

namespace App\Model\Settings;

use Illuminate\Database\Eloquent\Model;

class SystemCompanyDetailsLocation extends Model
{

	// protected $connection = 'settings';

	protected $table = 'system_company_details';

	protected $primaryKey = 'details_id';

	public $timestamps = false;

	public function companyInfo()
	{
		return $this->belongsTo(SystemCompany::class,'company_id','company_id');
	}
	
}