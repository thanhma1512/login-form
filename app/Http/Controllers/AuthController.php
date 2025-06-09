<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function LoginForm()
    {
        return view('auth.login');
    }

    public function RegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login.form')->with('success', 'Đăng ký thành công!');
    }

    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $status = Auth::attempt([
            'email' => $email,
            'password' => $password,
        ]);
        if ($status) {
            $user = Auth::user();
            $urlRedirect = "/";
            if ($user->is_admin) {
                $urlRedirect = "/admin";
            }
            return  redirect($urlRedirect);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.form');
    }
}
