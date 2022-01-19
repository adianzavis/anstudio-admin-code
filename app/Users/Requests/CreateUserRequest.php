<?php

namespace App\Users\Requests;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CreateUserRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'email' => 'required|unique:users,email|email',
        ];
    }
}
