<?php

namespace App\Customers\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerCreateRequest extends FormRequest {

    public function authorize() {
        return true;
    }

    public function rules() {
        $rules = [
            'name' => 'required|string',
            'surname' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'position' => 'nullable|string',
            'based' => 'required|string',
            'facebook' => 'nullable|string',
            'instagram' => 'nullable|string',
            'description' => 'nullable|string',
            'avatar' => 'nullable|file',
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
