<?php

namespace App\Invoices\Details;

use App\Core\Mediator;
use Illuminate\Support\Collection;

class InvoiceDetailsMediator extends Mediator {
    private ?InvoiceDetails $invoiceDetails;
    private Collection $data;

    public function __construct(array $data, ?InvoiceDetails $invoiceDetails = null) {
        $this->data = collect($data);
        $this->invoiceDetails = $invoiceDetails;
    }

    public function create() {
        $detail = new InvoiceDetails();

        $detail->fill($this->data->all());
        $detail->dph = (bool)$this->data->get('dph');

        if ($this->data->get('oldInvoice'))
            $detail->oldInvoice()->associate($this->data->get('oldInvoice'));

        $detail->save();
        $this->invoiceDetails = $detail;

        return $detail;
    }

    public function createIfDifferent(): ?InvoiceDetails {
        if (!$this->invoiceDetails || ($this->invoiceDetails->different($this->data) && $this->invoiceDetails->wasUsed())) {
            $this->data->put('oldInvoice', $this->invoiceDetails);
            return $this->create();
        }
        return null;
    }
}
