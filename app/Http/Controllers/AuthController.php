<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{

    public function login()
    {
        return view('auth.login');
    }

    public function post_login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return to_route('home');
        }

        return to_route('login')->with('error', 'Invalid username or password')->withInput();
    }

    public function register()
    {
        return view('auth.register');
    }

    public function post_register(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
//            'password' => ['required', 'confirmed', Password::min(10)->mixedCase()->numbers()->symbols()],
            'password' => ['required', 'confirmed'],
            'password_confirmation' => ['required']
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return to_route('home');
    }

    public function forgot()
    {
        return view('auth.forgot');
    }

    public function post_forgot(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
//            'password' => ['required', 'confirmed', Password::min(10)->mixedCase()->numbers()->symbols()],
            'password' => ['required', 'confirmed'],
            'password_confirmation' => ['required']
        ]);

        $user = User::where('email', $request->email)->first();
        $user->password = bcrypt($request->password);
        $user->save();

        return to_route('login')->with('success', 'Reset password complete.');
    }

    public function logout()
    {
        Auth::logout();
        return to_route('login');
    }

}
