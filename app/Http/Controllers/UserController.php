<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use App\Models\User;
use App\Models\Role;
use App\Models\ReserveTime;
use App\Models\WashType;
use App\Http\Requests\ReserveTimeRequest;
use App\Http\Requests\RegistrationRequest;
use App\Http\Requests\LoginRequest;
use Carbon\Carbon;
use App\Rules\ReserveTimeRule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('index');
    }

    /* public function reservation()
    {
        return view('reservation');
    }

    public function addReservation(ReserveTimeRequest $request)
    {

        $endtime = Carbon::parse($request->input('start_time'))->addMinutes($request->input('washtype'));

        $washType = $request->input('washtype');


        $duration = $this->getMinutesForWashType($washType);


        $endtime = Carbon::parse($request->input('start_time'))->addMinutes($duration);

        $request->validated();


        $time = ReserveTime::create([
        'start_time' => $request->input('start_time'),
        'end_time' => $endtime,
        'user_id' => auth()->user()->id,
        'wash_type_id'
        ]);




        $carwash = CarWash::get()->last();
        return view('privatecode',[
            'carwash' => $carwash
        ]);

    } */

    /* public function loginPost(Request $request)
    {
        $carwash = CarWash::where('code' , $request->input('code'))->first();

        $code = $carwash['code'];

        return redirect()->route('login', [
            'code' => $code,
        ]);
    } */

    public function showDetails($id)
    {
        $user = User::find($id);

        $this->authorize('show' , $user);


        return view('user.details', [
            'user' => $user
        ]);
    }


    public function editDetails($user_id , $time_id)
    {
        $time = ReserveTime::where('user_id' , $user_id)->findOrFail($time_id);

        $washTypes = WashType::all();

        $user = User::find($user_id);

        return view('user.edit' , [
            'time' => $time,
            'user' => $user,
            'washTypes'=>$washTypes
        ]);
    }

    public function update(Request $request , $user_id , $time_id)
    {
        $this->authorize('update', [$userId, $reservationId]);

        
        $washType = $request->input('wash_type_id');

        // Determine the number of minutes to add based on the wash type
        $duration = $this->getMinutesForWashType($washType);

        // Add the minutes to the scheduled time
        $endtime = Carbon::parse($request->input('start_time'))->addMinutes($duration);

        $rules = [
            'start_time' => [new ReserveTimeRule],
            // Add other validation rules as needed
        ];

        // Create a validator instance
        $validator = Validator::make($request->all(), $rules);

        // Perform the validation
        if ($validator->fails()) {
            // Handle validation failure
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $time = ReserveTime::where('user_id' , $user_id)->findOrFail($time_id)
        ->update([
            'start_time' => $request->input('start_time'),
            'end_time' => $endtime,
            'user_id' => auth()->user()->id,
            'wash_type_id' => $washType
        ]);

        return redirect()->route('details',auth()->user());
    }

    public function destroy($id)
    {
        $time = ReserveTime::findOrFail($id);
        $time->delete();
        return redirect('/');
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
