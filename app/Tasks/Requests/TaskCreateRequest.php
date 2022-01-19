<?php

namespace App\Tasks\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskCreateRequest extends FormRequest {

    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'project' => 'exists:App\Projects\Project,id',
            'name' => 'required|string',
            'assignees' => 'nullable|array',
            'duration' => 'required|string',
            'duration_budget' => 'required|string',
            'money_budget' => 'required',
            'money_budget.amount' => 'required|numeric',
            'money_budget.currency' => 'exists:App\Currency\Currency,iso',
            'dates' => 'required',
            'dates.start' => 'required|date',
            'dates.end' => 'required|date',
            'description' => 'nullable|string',
        ];
    }
}
