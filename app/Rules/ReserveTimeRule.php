<?php

namespace App\Rules;

use Closure;
use App\Models\CarWash;
use Illuminate\Support\Carbon;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Validator;


class ReserveTimeRule implements ValidationRule
{
    private $carwashes;

    public function __construct()
    {
        $this->carwashes = CarWash::all();
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(strtotime($value) <= strtotime(now())){
            $fail('invalid date');
        }


        $timestamp = strtotime($value);
        // Separate date and time components
        $date = date('Y-m-d', $timestamp); // Format: YYYY-MM-DD

        $time = date('H:i:s', $timestamp); // Format: HH:MM:SS

        $now = date('Y-m-d',strtotime(now()));

            // Date validation rules
        if ($date < now()->toDateString()) {
                $fail("The date must be today or future.");
            }
            // Time validation rules
        if ($time < '09:00' || $time > '21:00')
            {
                $fail("The time must be between 09:00 and");
            }


        $carWash = CarWash::where(function ($query) use ($value) {
            $givenCarbon = Carbon::parse($value);

            $query->where(function ($subQuery) use ($givenCarbon) {
                    // Check if the given datetime is between start_time and end_time
                $subQuery->where('start_time', '<=', $givenCarbon)
                         ->where('end_time', '>=', $givenCarbon);
                })
                ->orWhere(function ($subQuery) use ($givenCarbon) {
                    // Check if the given datetime is equal to start_time or end_time
                    $subQuery->where('start_time', '=', $givenCarbon)
                             ->orWhere('end_time', '=', $givenCarbon);
                });
            })
            ->first();

            if ($carWash) {
                // The given datetime falls within the range of start_time and end_time
                // Do something here...
                $fail('reserved time already exists');
            }
        }
}
