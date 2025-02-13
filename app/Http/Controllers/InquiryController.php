<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inquiry;
use App\Models\Residence;

class InquiryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'residence_id' => 'required|exists:residences,id',
        ]);

        $residence = Residence::findOrFail($request->residence_id);

        if ($residence->type !== 'inquiry') {
            return back()->with('error', 'این اقامتگاه قابل استعلام نیست!');
        }

        Inquiry::create([
            'start_date' => $residence->start_date,
            'end_date' =>$residence->end_date,
            'number_of_guests' => $residence->capacity,
            'user_id' => auth()->id(),
            'residence_id' => $residence->id,
            'status' => 'pending',
        ]);

        return redirect()->route('home')->with('success', 'درخواست استعلام شما ثبت شد!');
    }

    public function hostInquiries()
    {
        $user = auth()->user();


        $inquiries = Inquiry::whereHas('residence', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();

        return view('inquiries.inquiries', compact('inquiries'));
    }


    public function approve(Inquiry $inquiry)
    {

        if ($inquiry->residence->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $inquiry->update(['status' => 'approved']);

        return redirect()->route('host.dashboard')->with('success', 'درخواست با موفقیت تأیید شد.');
    }
}
