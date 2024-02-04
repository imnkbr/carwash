<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReserveTime;
use App\Models\WashType;
use App\Http\Requests\ReserveTimeRequest;
use App\Models\Users;
use Carbon\Carbon;

class ReserveTimeController extends Controller
{

    public function reservation()
    {
        $washTypes = WashType::all();
        return view('user.reservation',[
            'washTypes'=>$washTypes
        ]);
    }

    public function addReservation(ReserveTimeRequest $request)
    {

        /* $endtime = Carbon::parse($request->input('start_time'))->addMinutes($request->input('washtype')); */
        $washType = $request->input('wash_type_id');
        // Determine the number of minutes to add based on the wash type
        $duration = $this->getMinutesForWashType($washType);

        // Add the minutes to the scheduled time
        $endtime = Carbon::parse($request->input('start_time'))->addMinutes($duration);

        $request->validated();

        $time = ReserveTime::create([
        'start_time' => $request->input('start_time'),
        'end_time' => $endtime,
        'user_id' => auth()->user()->id,
        'wash_type_id' => $washType
        ]);


        return view('user.details' , [
            'user' => auth()->user(),
        ]);

    }

    protected function getMinutesForWashType($washType)
    {
        switch ($washType) {
            case '1':
                return 60;
            case '2':
                return 20;
            case '3':
                return 15;
            default:
                return 0;
        }
    }

}
