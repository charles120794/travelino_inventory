<?php

namespace App\Model\Settings;

use Illuminate\Database\Eloquent\Model;

class SystemCompanyModule extends Model
{
    
    // protected $connection = 'settings';

    protected $table = 'system_company_module';

    protected $primaryKey = 'company_id';

    public $timestamps = false;

    public function systemModuleInfo()
    {
        return $this->belongsTo(SystemModule::class, 'module_id', 'module_id');
    }

    public function companyInfo()
    {
        return $this->belongsTo(SystemCompany::class, 'company_id', 'company_id');
    }

}