<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //

    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
            ]);
        
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials))
        {
            return redirect('/dashboard');
        }
        return redirect('/login')->with('error', 'Invalid Username address or Password');
    }

    public function logout(Request $request)
    {
        if(Auth::check())
        {
            Auth::logout();
            $request->session()->invalidate();
        }
        return  redirect('/login');
    }
}
