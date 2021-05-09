<?php

namespace App\Http\Controllers\Views;

use Illuminate\View\View;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class SessionController extends ViewsController
{
    public function register(): View
    {
        return view('pages.register');
    }

    public function login(): View
    {
        return view('pages.login');
    }

    public function authenticate(LoginRequest $request)
    {
        $rememberMe = $request->input('remember-me');
        $credentials = $request->only(['email', 'password']);

        $result = Auth::attempt($credentials, $rememberMe);

        dd($result);
    }
}
