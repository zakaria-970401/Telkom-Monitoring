<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    public function username()
    {
        return 'username';
    }

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('welcome');
    }

    public function authenticate(Request $request)
    {
        $validator = $request->validate([
            'nik' => 'required|max:12',
            'password' => 'required|max:255'
        ]);

        if (Auth::attempt([
            'username' => $request['nik'],
            'password' => $request['password'] ], true)) {
            return response()->json(['success' => '1'], 200);
        }else{
            return response()->json(['success' => '0'], 401);
        }
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(['success' => 1], 200);
    }
}
