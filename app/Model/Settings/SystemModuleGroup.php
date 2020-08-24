<?php

namespace App\Model\Settings;

use Illuminate\Database\Eloquent\Model;

class SystemModuleGroup extends Model
{
	
	// protected $connection = 'settings';

	protected $table = 'system_module_group';

	protected $primaryKey = 'group_id';

	public $timestamps = false;

	public function moduleInfo()
	{
		return $this->hasMany(SystemModule::class,'group_id','group_id');
	}

}