<?php

namespace App\Http\Controllers\Common;

use Carbon\Carbon;
use App\Http\Traits\Common\ModuleCommonAccessTrait;
use App\Http\Traits\Common\SystemCommonSideBarTrait;

use App\Http\Traits\Accounts\UsersInformationTrait;

class CommonServiceController
{
    use ModuleCommonAccessTrait, SystemCommonSideBarTrait, UsersInformationTrait;

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
        
        return (count($collect) > 0) ? $collect['order_level'] + 1 : 1 ;
    }
    
}
