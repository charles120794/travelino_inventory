<?php

namespace App\Model\Settings;

use Illuminate\Database\Eloquent\Model;

class SystemInvoiceHistory extends Model
{

    // protected $connection = 'settings';

    protected $table = 'system_invoice_history';

    protected $primaryKey = 'history_id';

    public $timestamps = false;

}