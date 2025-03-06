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
            'boardingHouse' => ['required', 'exists:boarding_houses,id'],
            'room' => ['required', 'exists:rooms,id'],
            'name' => ['required', 'min:3', 'max:35'],
            'email' => ['required', new EmailValidationRule],
            'phone' => ['required', 'numeric', 'min_digits:10', 'max_digits:15'],
            'duration' => ['required'],
            'start_date' => ['required']
        ];
    }
}
