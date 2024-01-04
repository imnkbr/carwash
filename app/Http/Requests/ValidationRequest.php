<?php

namespace App\Http\Requests;

use App\Rules\ShopDates;
use App\Rules\ShopWorkingHours;
use App\Rules\ReserveTimeRule;
use Illuminate\Foundation\Http\FormRequest;

class ValidationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|unique:car_washes',
            'phonenumber' => 'required|unique:car_washes|regex:/^[0-9]{11}$/',
            'washtype' => 'required',
            'start_time' => ['required', new ReserveTimeRule],
            'end_time' => [new ReserveTimeRule]
        ];
    }
}
