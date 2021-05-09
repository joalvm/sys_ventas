<?php

namespace App\Http\Controllers\Views;

use Illuminate\View\View;

class AdminController extends ViewsController
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
