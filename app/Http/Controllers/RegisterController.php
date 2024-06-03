<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller implements HasMiddleware
{
    public static function middleware(): array {
        return [
            'guest'
        ];
    }

    public function index() {
        return view('auth.register');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed|max:255'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'username' => $request->username

        ]);

        auth()->attempt($request->only('email', 'password'));

        return redirect()->route('dashboard');
    }
}
