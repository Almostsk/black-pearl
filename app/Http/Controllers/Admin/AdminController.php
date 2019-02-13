<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function logIn()
    {
        if (Auth::user() == null) {
            return view('admin.authorize');
        }

        return redirect()->route('admin_home');
    }

    public function home()
    {
        return view('admin.app');
    }
}
