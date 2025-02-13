<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm(Request $request)
    {
        $request->session()->put('url.intended', url()->previous());
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $user = User::where('email' , $request->input('email'))->first();
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)){
            return view('auth.login')->withErrors(['error' => 'invalid username or password']);
        } else{

            if($user->role_id == 1){
                Auth::login($user);
                return redirect()->route('host.dashboard')->with('success', 'میزبان عزیز خوش آمدید');

            }
            if($user->role_id == 2){
                Auth::login($user);
                return redirect()->route('home')->with('success', 'مهمان عزیز خوش آمدید');

            }
        }
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->role_id === 1) {
            return redirect()->route('host.dashboard');
        }

        return redirect()->intended('/');
    }
}
