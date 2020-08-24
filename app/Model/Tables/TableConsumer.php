<?php 

namespace App\Model\Tables;

use App\User;
use Illuminate\Database\Eloquent\Model;
use App\Model\Accounts\UsersBillingAddress;
use App\Model\Settings\SystemInvoice;

class TableConsumer extends Model
{
    // protected $connection = 'settings';

    protected $table = 'table_consumer';

    protected $primaryKey = 'consumer_id';

    public $timestamps = false;

    public function invoiceSupplierInfo()
    {
    	return $this->hasMany(SystemInvoice::class, 'invoice_supplier', 'consumer_id');
    }

    public function invoiceCustomerInfo()
    {
    	return $this->hasMany(SystemInvoice::class, 'invoice_supplier', 'consumer_id');
    }

    public function userAddressInfo()
    {
        return $this->hasOne(UsersBillingAddress::class, 'address_id', 'consumer_address');
    }

}