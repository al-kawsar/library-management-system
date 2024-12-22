<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function showFormLogin()
    {
        return response()->json('Logout Success, Show Form Login Page', 200);
        // return Inertia::render('Auth/Login');
    }

    public function doLogin(LoginRequest $request)
    {
        try {
            $credentials = $request->only('email', 'password');

            if (!auth()->attempt(credentials: $credentials))
                throw new \Exception('Email atau Password Salah!', 400);

            $request->session()->regenerate();
            return response()->json([
                'message' => 'Login Successfull'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], $e->getCode());
        }
    }

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('auth.login.index');
    }
}
