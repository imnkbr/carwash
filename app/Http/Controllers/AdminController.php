<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReserveTime;
use App\Models\WashType;
use App\Models\User;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function userDetails()
    {
        $users = User::all();

        foreach ($users as $user) {

        $lastThreeMonthsReservedTimes = $user->reserveTimes()
        ->where('start_time', '>=', Carbon::now()->subMonths(3))
        ->get();


        // Calculate the count of reserved times
        $user->reservedTimesCount = $lastThreeMonthsReservedTimes->count();
        }

        return view('admin.userdetails',[
            'users'  => $users,
            'reservedTimesCount' =>  $user->reservedTimesCount
        ]);
    }

    public function reservedTimes()
    {

        $times = ReserveTime::all();

        return view('admin.reservedtimes',[
            'times' => $times
        ]);
    }

    public function reservedTimesFilter(Request $request)
    {
        $washtypeFilter = $request->input('typefilter', null);
        $dayFilter = $request->input('dayfilter', null);

        $query = ReserveTime::query();

        // Apply filters if they are not "all"
        if ($washtypeFilter !== null) {
            $washtypeId = Washtype::where('id', $washtypeFilter)->value('id');
            $query->where('wash_type_id', $washtypeId);
        }

        if ($dayFilter !== null) {
            // Use DAYOFWEEK to filter by the selected day
            $query->whereRaw('DAYOFWEEK(start_time) = ?', [$dayFilter]);
        }

        $times = $query->get();

        return view('admin.reservedtimes',[
            'times' => $times
        ]);
    }

    public function washType()
    {
        $washtypes = WashType::all();
        return view('admin.washtypes',[
            'washtypes' => $washtypes
        ]);
    }

    public function addWashType()
    {
        return view('admin.add_washtype');
    }

    public function createWashType(Request $request)
    {
        $washtypes = WashType::create([
            'washtype' =>$request->input('washtype'),
            'cost' =>$request->input('cost'),
            'duration' =>$request->input('duration')

        ]);
        return view('admin.washtypes',[
            'washtypes' => $washtypes
        ]);
    }

    public function editWashType($id)
    {
        $washtypes = WashType::find($id);

        return view('admin.editwashtype',[
            'washtypes'=>$washtypes
        ]);
    }

    public function updateWashType(Request $request, $id)
    {
        $washtypes = WashType::where('id',$id)
        ->update([
            'washtype'=>$request->input('washtype'),
            'cost'=>$request->input('cost'),
            'duration'=>$request->input('duration')
        ]);

        return redirect()->route('washtype');
    }

    public function destroy($id)
    {
        $washtype = WashType::findOrFail($id);
        $washtype->delete();
        return redirect()->route('washtype');
    }
}
