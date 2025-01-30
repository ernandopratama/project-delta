<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function create() {
        return view('auth.login');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!auth()->attempt($data)) {
            return back()->withInput()->withErrors([
                'email' => 'Your provided credentials could not be verified.'
            ]);
        }

        return redirect()->route('web.dashboard');
    }

    public function destroy(Request $request) {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('web.login');
    }
}
