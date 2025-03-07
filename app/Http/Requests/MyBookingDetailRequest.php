<?php

namespace App\Http\Requests;

use App\Rules\EmailValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class MyBookingDetailRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'booking_code' => ['required', 'exists:transactions,code'],
            'email' => ['required', new EmailValidationRule, 'exists:transactions,email'],
            'phone' => ['required', 'min:10', 'max:15',  'exists:transactions,phone_number']
        ];
    }
}
