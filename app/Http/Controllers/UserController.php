<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index() {
        return view('register');
    }

    public function register(Request $request) {
        $request->merge(['password' => bcrypt($request->password)]);
        $user = User::create($request->all());
        Auth::login($user);
        return redirect()->route('admin-dashboard');
    }
}
