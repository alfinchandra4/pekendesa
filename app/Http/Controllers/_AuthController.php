<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class _AuthController extends Controller
{
    public function getlogin() {
        // return redirect('/')->with('error','Data Deleted');
        return view('login');
    }

    public function postlogin(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('homepage');
        }

        return back()->withError('The provided credentials do not match our records.');
    }

    public function logout() {
        Auth::logout();
        return redirect('/');
    }

}
