<?php

namespace App\Http\Controllers\Views;

use App\Components\Controller;

class SessionController extends Controller
{
    public function login()
    {
        return view('pages.login');
    }
}
