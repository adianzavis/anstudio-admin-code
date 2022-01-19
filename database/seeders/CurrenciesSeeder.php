<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrenciesSeeder extends Seeder {
    public function run() {
        DB::table('currencies')->insert([
            [
                'ISO' => 'EUR',
                'symbol' => '€',
                'symbol_before_amount' => false,
            ],
            [
                'ISO' => 'CZK',
                'symbol' => 'Kč',
                'symbol_before_amount' => false,
            ],
        ]);
    }
}
