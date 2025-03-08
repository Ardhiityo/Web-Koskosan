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
            'booking_code' => ['required', 'exists:transactions,code', 'starts_with:KOS'],
            'email' => ['required', new EmailValidationRule, 'exists:transactions,email'],
            'phone' => ['required', 'digits_between:10,14',  'exists:transactions,phone_number', 'starts_with:62']
        ];
    }

    public function messages()
    {
        return [
            'booking_code.starts_with' => 'The Booking code field must start with following: KOS',
            'phone.starts_with' => 'The Phone field must start with following: 62.'
        ];
    }
}
