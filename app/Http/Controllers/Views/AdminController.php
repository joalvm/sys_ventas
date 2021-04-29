<?php

namespace App\Http\Controllers\Views;

use Illuminate\View\View;
use App\Components\Controller;

class AdminController extends Controller
{
    public function dashboard(): View
    {
        return view('pages.admin.dashboard');
    }

    public function profile(): View
    {
        return view('pages.admin.profile');
    }
}
