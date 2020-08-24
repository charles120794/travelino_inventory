<?php

namespace App\Http\Controllers\Manage\System\Settings;

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
    use \App\Http\Traits\Settings\SystemMediaUploaderTrait;
    use \App\Http\Traits\Settings\SystemMethodLoaderTrait;
    use \App\Http\Traits\Settings\SystemModuleTrait;
    use \App\Http\Traits\Settings\SystemWindowLoaderTrait;
    use \App\Http\Traits\Settings\SystemWindowMethodTrait;
    use \App\Http\Traits\Settings\SystemWindowTrait;

	// CREATE
	protected $createSystemCompany = 'create-system-company';
    protected $createSystemWindow  = 'create-system-window';
    protected $createSystemModule  = 'create-system-module';
    protected $createSystemMethod  = 'create-system-module';
    
    // UPDATE
    protected $updateSystemCompany = 'update-system-company';
    protected $updateSystemWindow  = 'update-system-window';
    protected $updateSystemModule  = 'update-system-module';
    protected $updateSystemMethod  = 'update-system-method';

    // DELETE
    protected $deleteSystemCompany = 'delete-system-company';
    protected $deleteSystemWindow  = 'delete-system-window';
    protected $deleteSystemModule  = 'delete-system-module';
    protected $deleteSystemMethod  = 'delete-system-method';

    // TOGGLES
    protected $toggleSystemCompany = 'toggle-system-company';
    protected $toggleSystemWindow  = 'toggle-system-window';
    protected $toggleSystemModule  = 'toggle-system-module';
    protected $toggleSystemMethod  = 'toggle-system-method';

    // OTHER ACTION 
    protected $formSearchModule    = 'settings-search-system-module';
    
}
