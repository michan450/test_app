<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        
        if (!Auth::attempt($credentials)) {
            return back()
                ->withErrors(['password' => 'ログイン情報が登録されていません'])
                ->withInput();
        }

        
        return redirect('/admin');
    }
}
