<?php

namespace App\Http\Requests;

use App\Rules\EmailValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CustomerBookingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'boarding_house_id' => ['required', 'exists:boarding_houses,id'],
            'room_id' => ['required', 'exists:rooms,id'],
            'name' => ['required', 'min:3', 'max:35'],
            'email' => ['required', new EmailValidationRule],
            'phone_number' => ['required', 'numeric', 'min_digits:10', 'max_digits:14', 'starts_with:62'],
            'duration' => ['required'],
            'start_date' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'starts_with:62' => 'The phone number field must start with following: 62.'
        ];
    }
}
