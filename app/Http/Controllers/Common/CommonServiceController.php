<?php

namespace App\Http\Controllers\Common;

use Carbon\Carbon;
use App\Http\Traits\Retrieves\SystemModuleTrait;
use App\Http\Traits\Retrieves\SystemSideBarTrait;

use App\Http\Traits\Accounts\UsersAccessInformationTrait;

class CommonServiceController
{
    use SystemModuleTrait, SystemSideBarTrait, UsersAccessInformationTrait;

    const TAX_RATE = 0.12;

    public function dateTimeToday($format)
    {
        $dateTimeToday = Carbon::now();

        return $dateTimeToday->format($format);
    }

    public function oneMonthFromNow($format, $day = 30)
    {
        $dateTimeToday = Carbon::now()->addDay($day);

        return $dateTimeToday->format($format);
    }

    public function orderLevel($model)
    {
        $collect = $model->select('order_level')->orderBy('order_level','desc')->first();
        
        return (collect($collect)->isNotEmpty()) ? $collect['order_level'] + 1 : 1 ;
    }
    
}
