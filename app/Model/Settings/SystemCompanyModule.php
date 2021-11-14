<?php

namespace App\Model\Settings;

use App\Model\Settings\SystemModule;
use App\Model\Settings\SystemCompany;

use Illuminate\Database\Eloquent\Model;

class SystemCompanyModule extends Model
{
    protected $table = 'system_company_module';

    protected $primaryKey = 'access_id';

    public $timestamps = false;

    public function moduleInfo()
    {
        return $this->hasOne(SystemModule::class,'module_id','access_company_module_id');
    }

    public function companyInfo()
    {
        return $this->belongsTo(SystemCompany::class,'company_id','access_company_company_id');
    }
}