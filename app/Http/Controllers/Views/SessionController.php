<?php

namespace App\Http\Controllers\Views;

use App\Components\Errors;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SessionController extends ViewsController
{
    public function login(): View
    {
        return view('pages.login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function authenticate(LoginRequest $request)
    {
        $rememberMe = to_bool($request->input('remember_me', false));
        $credentials = $request->only(['username', 'password']);

        if (Auth::attempt($credentials, $rememberMe)) {
            $request->session()->regenerate();

            return redirect()->intended('admin/dashboard');
        }

        return back()->withErrors([
            'username' => trans(Errors::WRONG_CREDENTIALS),
        ]);
    }
}
