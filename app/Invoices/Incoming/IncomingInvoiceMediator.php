<?php

namespace App\Invoices\Incoming;

use App\Core\Mediator;
use Illuminate\Support\Collection;

class IncomingInvoiceMediator extends Mediator {
    private ?IncomingInvoice $invoice;
    private Collection $data;

    public function __construct(array $data, IncomingInvoice $invoice = null) {
        $this->data = collect($data);
        $this->invoice = $invoice;
    }

    public function create() {

    }
}
