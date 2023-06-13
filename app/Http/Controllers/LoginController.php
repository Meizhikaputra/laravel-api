<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login', [
            'title' => 'login',

        ]);
    }

    public function authenticate(Request $request)
    {

        $user =  $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($user)) {
            $request->session()->regenerate();
            return redirect()->intended('/students');
        }

        return redirect('/')->with('message', 'Email atau Password salah!');
    }
}
