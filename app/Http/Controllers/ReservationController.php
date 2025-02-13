<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Residence;

class ReservationController extends Controller
{
    public function store(Request $request, Residence $residence)
    {
        if ($residence->type !== 'instant') {
            return back()->with('error', 'این اقامتگاه قابل رزرو فوری نیست!');
        }

        $residence->update(['is_available' => false]);

        return redirect()->route('home')->with('success', 'رزرو با موفقیت انجام شد!');
    }

}
