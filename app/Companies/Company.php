<?php

namespace App\Companies;

use App\Users\User;
use Illuminate\Database\Eloquent\Model;
use App\Invoices\Details\InvoiceDetails;

class Company extends Model {
    protected $table = 'companies';

    protected $fillable = [
        'name',
        'description',
    ];

    public function invoiceDetails() {
        return $this->belongsTo(InvoiceDetails::class, 'invoice_detail_id', 'id');
    }

    public function assignees() {
        return $this->belongsToMany(User::class);
    }
}
