<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Residence;
use Illuminate\Support\Facades\Auth;



class HostController extends Controller
{
    public function dashboard()
    {

        $reserves = Auth::user()->residences;
        return view('host.dashboard',[
            'reserves' => $reserves
        ]);
    }

    public function create()
    {
        return view('host.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'city' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'capacity' => 'required|integer|min:1',
            'price' => 'required|numeric',
            'type' => 'required|in:instant,inquiry,reserved'
        ]);

        Residence::create([
            'title' => $request->title,
            'city' => $request->city,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'capacity' => $request->capacity,
            'price' => $request->price,
            'type' =>$request->type,
            'is_available' => $request->is_available ?? true, // پیش‌فرض: true
            'user_id' => Auth::id(),
        ]);


        return redirect()->route('host.dashboard')->with('success', 'اقامتگاه با موفقیت ایجاد شد.');
    }

    public function destroy(Residence $reserves)
    {
        if ($reserves->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $reserves->delete();

        return redirect()->back();
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('home');
    }
}
