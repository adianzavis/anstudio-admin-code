<?php

namespace App\Projects\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectCreateRequest extends FormRequest {

    public function authorize() {
        return true;
    }

    public function rules() {
        $rules = [
            'name' => 'required|string',
            'summary' => 'required|string',
            'total_description' => 'required|string',
            'image' => 'file|required',
            'web' => 'nullable|string',
            'facebook' => 'nullable|string',
            'instagram' => 'nullable|string',
            'google_disk' => 'nullable|string',
        ];

        if ($this->input('public'))
            $rules = $this->validatePublicity($rules);

        return $rules;
    }

    public function validatePublicity($rules) {
        return array_merge($rules, [
            'site_content' => 'required|string',
            'title' => 'required|string',
            'meta_description' => 'required|string',
            'meta_keywords' => 'required|string',
            'og_title' => 'required|string',
            'og_site_name' => 'required|string',
            'og_description' => 'required|string',
            'og_image' => 'nullable|file',
        ]);
    }
}
