<?php

namespace App\Http\Controllers;

use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function register(Request $request) {
       $validatedData = $request->validate([
           'email' => 'required|min:5|max:20|unique',
            'password' => 'required|min:5|max:20|confirmed',
        ]);
       $validatedData['password']=Hash::make($validatedData['password']);

        $validatedData = User::create([
            'email' => $validatedData->email,
            'password' => $validatedData['password'],
        ]);

        return redirect('/login');
    }



}
