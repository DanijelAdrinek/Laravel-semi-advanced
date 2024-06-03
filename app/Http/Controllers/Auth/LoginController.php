<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class LoginController extends Controller implements HasMiddleware
{
    public static function middleware(): array {
        return [
            'guest'
        ];
    }

    public function index() {
        return view("auth.login");
    }

    public function store(Request $request) {
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|max:255'
        ]);

        if(!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('status', 'Invalid login details');
        }

        return redirect()->route('dashboard');
    }
}
