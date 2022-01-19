<?php

namespace App\Companies\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyUpdateRequest extends FormRequest {

    public function authorize() {
        return true;
    }

    public function rules() {
        $rules = [
            'name' => 'required|string',
            'description' => 'required|string',
        ];
        if ($this->input('invoiceable'))
            $rules = $this->validateInvoiceable($rules);

        return $rules;
    }

    public function validateInvoiceable($rules) {
        return array_merge($rules, [
            'company' => 'required|string',
            'street' => 'required|string',
            'city' => 'required|string',
            'postcode' => 'required|string',
            'country' => 'required|string',
            'ico' => 'required|string',
            'dic' => 'required|string',
            'icdph' => 'nullable|string',
            'DPH' => 'nullable|string',
        ]);
    }
}
