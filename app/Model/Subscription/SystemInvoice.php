<?php

namespace App\Model\Subscription;

use Illuminate\Database\Eloquent\Model;
use App\Model\Tables\TableConsumer;

class SystemInvoice extends Model
{

    // protected $connection = 'settings';

    protected $table = 'system_invoice';

    protected $primaryKey = 'invoice_id';

    public $timestamps = false;

    public function groupInfo()
    {
    	return $this->belongsTo(SystemInvoiceGroup::class, 'group_id', 'group_id');
    }

    public function detailsInfo()
    {
    	return $this->hasMany(SystemInvoiceDetails::class, 'invoice_id', 'invoice_id');
    }

    public function invoiceSupplierInfo()
    {
    	return $this->hasOne(TableConsumer::class, 'consumer_id', 'invoice_supplier');
    }

    public function invoiceCustomerInfo()
    {
    	return $this->hasOne(TableConsumer::class, 'consumer_id', 'invoice_customer');
    }

}