<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CarwashPosition implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $selectedDatetime = $value['start_time'];
        $selectedPosition = $value['position'];
        if (! isset($selectedDatetime) || ! isset($selectedPosition)) {
            $fail('The selected carwash position is not available at the chosen datetime.');
        }
    }
}
