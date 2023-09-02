<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm() {
        if (Auth::check()) return redirect()->route('dashboard');
        return view('auth.login');
    }

    public function login(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt($request->only('username', 'password'))) {
            return redirect()->route('dashboard');
        }
        return redirect()->route('auth.login.form')->with('error', 'Username atau Password anda salah.');
    }

    public function logout() {
        session()->flush();
        Auth::logout();
  
        return redirect()->route('auth.login.form');
    }
}
