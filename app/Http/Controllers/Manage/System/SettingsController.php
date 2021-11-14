<?php

namespace App\Http\Controllers\Manage\System;

use Crypt;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends Controller 
{

    use \App\Http\Traits\Settings\SystemCompanyDetailsTrait;
    use \App\Http\Traits\Settings\SystemCompanyModuleAccessTrait;
    use \App\Http\Traits\Settings\SystemCompanyTrait;
    use \App\Http\Traits\Settings\SystemDatabaseBackupTrait;
    use \App\Http\Traits\Settings\SystemFileSystemTrait;
    use \App\Http\Traits\Settings\SystemMethodLoaderTrait;
    use \App\Http\Traits\Settings\SystemModuleTrait;
    use \App\Http\Traits\Settings\SystemWindowLoaderTrait;
    use \App\Http\Traits\Settings\SystemWindowMethodTrait;
    use \App\Http\Traits\Settings\SystemWindowTrait;
    
}
