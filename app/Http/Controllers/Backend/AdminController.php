<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{


    /**
     * Display the admin login page.
     */
    public function login()
    {
        return view('admin.auth.login');
    }

    /**
     * Display the admin dashboard page.
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
