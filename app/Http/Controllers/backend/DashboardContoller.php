<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\FlareClient\View;

class DashboardContoller extends Controller
{
    public function ShowDeshboard()
    {
        return view('backend.pages.dashboard.index');
    }
}
