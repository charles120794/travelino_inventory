<?php

namespace App\Model\Settings;

use Illuminate\Database\Eloquent\Model;

class SystemCompanyPlan extends Model
{

    // protected $connection = 'settings';

    protected $table = 'system_company_plan';

    protected $primaryKey = 'control_id';

    public $timestamps = false;
    
}