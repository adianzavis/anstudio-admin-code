<?php

namespace App\Customers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Projects\Project;
use App\Invoices\Details\InvoiceDetails;

class Customer extends Model  {
    protected $fillable = [
        'name',
        'surname',
        'position',
        'based',
        'phone',
        'email',
        'facebook',
        'instagram',
        'description',
    ];

    public function getInstagramNameAttribute() {
        return Str::replace('https://www.instagram.com/', '', $this->instagram);
    }

    public function getFacebookNameAttribute() {
        return Str::replace('https://www.facebook.com/', '', $this->facebook);
    }

    public function invoiceDetails() {
        return $this->belongsTo(InvoiceDetails::class, 'invoice_detail_id', 'id');
    }

    public function projects() {
        return $this->hasMany(Project::class, 'customer_id');
    }
}
