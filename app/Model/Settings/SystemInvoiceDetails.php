<?php

namespace App\Model\Settings;

use Illuminate\Database\Eloquent\Model;

class SystemInvoiceDetails extends Model
{

    // protected $connection = 'settings';

    protected $table = 'system_invoice_details';

    protected $primaryKey = 'detail_id';

    public $timestamps = false;

    public function invoiceInfo()
    {
    	return $this->belongsTo(SystemInvoice::class, 'invoice_id', 'invoice_id');
    }

}