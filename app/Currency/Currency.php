<?php

namespace App\Currency;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model {
    protected $primaryKey = 'iso';
    protected $keyType = 'string';
}
