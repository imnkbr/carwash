<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use App\Models\CarWash;
use App\Http\Requests\ValidationRequest;
use Carbon\Carbon;
use App\Rules\ReserveTimeRule;
use Illuminate\Support\Facades\Validator;


class CarWashController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('index');
    }

    public function reservation()
    {
        return view('reservation');
    }

    public function addReservation(ValidationRequest $request)
    {
        $code = Str::random(10);

        /* $endtime = Carbon::parse($request->input('start_time'))->addMinutes($request->input('washtype')); */

        $washType = $request->input('washtype');

        // Determine the number of minutes to add based on the wash type
        $minutesToAdd = $this->getMinutesForWashType($washType);

        // Add the minutes to the scheduled time
        $endtime = Carbon::parse($request->input('start_time'))->addMinutes($minutesToAdd);

        $request->validated();


        $carwash = CarWash::create([
        'name' => $request->input('name'),
        'phonenumber' => $request->input('phonenumber'),
        'washtype' => $request->input('washtype'),
        'start_time' => $request->input('start_time'),
        'end_time' => $endtime,
        'code' => $code,
        ]);




        $carwash = CarWash::get()->last();
        return view('privatecode',[
            'carwash' => $carwash
        ]);

    }

    public function login()
    {
        return view('login');
    }

    public function loginPost(Request $request)
    {
        $carwash = CarWash::where('code' , $request->input('code'))->first();

        $code = $carwash['code'];

        return redirect()->route('login', [
            'code' => $code,
        ]);
    }

    public function showDetails(string $code)
    {
        $carwash = CarWash::where('code', $code)->first();
        return view('details' , ['carwash' => $carwash]);
    }


    public function editDetails(string $code)
    {
        $carwash = CarWash::where('code' , $code)->first();

        return view('edit' , [
            'code' => $code,
            'carwash' => $carwash
        ]);
    }

    public function update(Request $request , string $code)
    {
        $washType = $request->input('washtype');

        // Determine the number of minutes to add based on the wash type
        $minutesToAdd = $this->getMinutesForWashType($washType);

        // Add the minutes to the scheduled time
        $endtime = Carbon::parse($request->input('start_time'))->addMinutes($minutesToAdd);

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


        $carwash = CarWash::where('code', $code)
        ->update([
        'name' => $request->input('name'),
        'start_time' => $request->input('start_time'),
        'end_time' => $endtime,

        ]);

        return redirect()->action(
            [CarWashController::class, 'showDetails'], ['code' => $code]
        );
    }

    public function destroy($id)
    {
        $carwash = CarWash::findOrFail($id);
        $carwash->delete();
        return redirect('/');
    }

    protected function getMinutesForWashType($washType)
    {
        switch ($washType) {
            case 'All':
                return 60;
            case 'inside':
                return 20;
            case 'body':
                return 15;
            default:
                return 0;
        }
    }
}
