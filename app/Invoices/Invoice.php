<?php

namespace App\Invoices;

use Illuminate\Database\Eloquent\Model;
use App\Invoices\Incoming\IncomingInvoice;
use Parental\HasChildren;

class Invoice extends Model {
    use HasChildren;

    protected $childTypes = [
        'IncomingInvoice' => IncomingInvoice::class,
    ];
}
