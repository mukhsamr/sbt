<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function index()
    {
        return Inertia::render('Login');
    }

    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'nama' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, true)) {

            session(['tipe' => $request->tipe]);

            $request->session()->regenerate();
            return redirect()->intended();
        }

        return back()->withErrors([
            'msg' => 'Invalid Credentials !!',
        ]);
    }

    public function logout()
    {
        Auth::logout();

        session()->invalidate();

        session()->regenerateToken();

        return redirect('/login');
    }
}
