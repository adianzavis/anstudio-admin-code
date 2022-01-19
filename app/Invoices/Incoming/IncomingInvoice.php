<?php

namespace App\Invoices\Incoming;

use Illuminate\Database\Eloquent\Model;
use Parental\HasParent;

class IncomingInvoice extends Model {
    use HasParent;
}
