<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create() {
        return view('auth.login');
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:100',
            'email' => 'required|email|unique:users|min:6|max:100',
            'password' => 'required|min:6|max:100',
        ]);

        if(!Auth::attempt($request->only('email', 'password'))) {
            return back()->withErrors(['email' => 'Invalid email or password']);
        }
        $request->session()->regenerate();
        return redirect()->route('dashboard');
    }
}
