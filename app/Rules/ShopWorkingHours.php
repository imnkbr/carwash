<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class ShopWorkingHours implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {


        if(!$value){
            $fail("$attribute is required");
        }
        else{

        $inputTime = Carbon::createFromFormat('H:i', $value);

        // Define your shop's working hours
        $openingTime = Carbon::createFromTime(9, 0);
        $closingTime = Carbon::createFromTime(21, 0);

        // Check if the input time is within working hours
        if( !$inputTime->between($openingTime, $closingTime)){
            $fail ( 'The selected time is outside of the shop\'s working hours (9 AM - 9 PM).') ;
        };

        };
    }
}

