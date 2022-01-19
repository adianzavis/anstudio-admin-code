<?php

namespace App\Invoices\Details;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class InvoiceDetails extends Model {
    protected $fillable = [
        'company',
        'street',
        'city',
        'postcode',
        'country',
        'dph',
        'ico',
        'dic',
        'icdph',
    ];

    public function oldInvoice() {
        return $this->belongsTo(InvoiceDetails::class, 'old_invoice', 'id');
    }

    public function different(Collection $data) {
        return $this->company !== $data->get('company') ||
            $this->street !== $data->get('street') ||
            $this->city !== $data->get('city') ||
            $this->postcode !== $data->get('postcode') ||
            $this->country !== $data->get('country') ||
            (bool)$this->dph !== (bool)$data->get('dph') ||
            $this->ico !== $data->get('ico') ||
            $this->dic !== $data->get('dic') ||
            $this->icdph !== $data->get('icdph');
    }

    public function wasUsed() {
        return true;
    }
}
