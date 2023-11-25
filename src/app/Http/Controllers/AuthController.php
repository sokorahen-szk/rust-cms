<?php

namespace App\Http\Controllers;

class AuthController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        if (auth()->check()) {
            return redirect()->route('index');
        }

        $credentials = request(['account_id', 'password']);

        if (!auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return redirect()->route('index');
    }

    public function logout()
    {
        if (auth()->check()) {
            auth()->logout();
        }

        return redirect()->route('index');
    }
}
