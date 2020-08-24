<?php

namespace App\Model\Settings;

use Illuminate\Database\Eloquent\Model;

class SystemInvoiceGroup extends Model
{

    // protected $connection = 'settings';

    protected $table = 'system_invoice_group';

    protected $primaryKey = 'group_id';

    public $timestamps = false;

    public function invoiceInfo()
    {
    	return $this->hasMany(SystemInvoice::class, 'group_id', 'group_id');
    }

    public function invoicePainInfo()
    {
    	return $this->hasMany(SystemInvoice::class, 'group_id', 'group_id')->where('invoice_status','paid');
    }

}