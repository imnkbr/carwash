<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Models\WashType;
use App\Http\Requests\RegistrationRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function register()
        {
            return view('auth.register');
        }

    public function registeration(RegistrationRequest $request)
    {

        $request->validated();

        $defaultRoleName = 'user';

        // Find or create the role
        $role = Role::where('name', $defaultRoleName)->first();

        if (!$role) {
            $role = Role::create(['name' => $defaultRoleName]);
        }

        $user = User::create([
        'name' => $request->input('name'),
        'phone_number' => $request->input('phone_number'),
        'email' => $request->input('email'),
        'password' =>Hash::make($request->input('password')),
        'role_id' => $role->id
        ]);


        return redirect()->route('login');

    }

    public function login()
    {
        return view('auth.login');
    }

    public function loginRequest(LoginRequest $request)
    {
        // Validate the user's login credentials
        $request->validated();

        $user = User::where('email' , '=' , $request->email)->first();

        // Attempt to authenticate the user
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials) and $user->role_id == 1) {
            // Authentication succeeded
            return redirect()->route('reserve');
        }
        elseif(Auth::attempt($credentials) and $user->role_id == 2){
            return  redirect()->intended('/admin');
        } else {
            // Authentication failed
            return back()->withErrors(['email' => 'Invalid email or password']);
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('home');
    }
}
