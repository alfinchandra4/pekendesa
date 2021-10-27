<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index() {
        $user = auth()->user();
        return view('admin.pages.profile.index', [
            'user' => $user
        ]);
    }

    public function update(Request $request) {

        if ($request->password != null) {
            $password = bcrypt($request->password);
        } else {
            $password = auth()->user()->password;
        }

        User::find(auth()->user()->id)->update([
            'name'       => $request->name,
            'store_name' => $request->store_name,
            'password'   => $password,
            'email'      => $request->email,
            'phone'      => $request->phone
        ]);

        return back()->withSuccess('Berhasil update profil');

    }
}
