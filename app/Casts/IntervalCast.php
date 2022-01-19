<?php

namespace App\Casts;

use Carbon\CarbonInterval;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class IntervalCast implements CastsAttributes {

    public function get($model, string $key, $value, array $attributes) {
        try {
            return CarbonInterval::make($value);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function set($model, string $key, $value, array $attributes) {
        try {
            if (is_string($value)) {
                return [$key => CarbonInterval::make($value)->spec()];
            } else if (is_array($value)) {
                return [$key => CarbonInterval::make($value['hours'].'h '.$value['minutes'].'m')->spec()];
            }

            return [$key => $value];
        } catch (\Exception $e) {
            return null;
        }
    }
}
