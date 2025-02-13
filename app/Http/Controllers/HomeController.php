<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Residence;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function search(Request $request)
    {
        $city = $request->input('city');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $numberOfGuests = $request->input('number_of_guests');

        $query = Residence::query();

        if ($city) {
            $query->where('city', 'like', '%' . $city . '%');
        }

        if ($startDate && $endDate) {
            $query->where('start_date', '<=', $startDate)
                  ->where('end_date', '>=', $endDate);
        }

        if ($numberOfGuests) {
            $query->where('capacity', '>=', $numberOfGuests);
        }

        $residences = $query->get();

        return view('search_results', compact('residences'));
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('home');
    }
}
