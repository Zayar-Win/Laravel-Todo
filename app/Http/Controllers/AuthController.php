<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $userData =  $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($userData)) {

            $request->session()->regenerate();

            return redirect(route('home'));
        }

        return redirect(route('login'))->with('error', 'Invalid credentials');
    }

    public function register(Request $request)
    {
        $userData = $request->validate([
            'name' => ['required', 'min:5', 'max:20'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8'],
        ]);

        $user = User::create([
            'name' => $userData['name'],
            'email' => $userData['email'],
            'email_verified_at' => now(),
            'password' => Hash::make($userData['password']),
        ]);

        Auth::login($user);

        $request->session()->regenerate();

        return redirect(route('home'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
