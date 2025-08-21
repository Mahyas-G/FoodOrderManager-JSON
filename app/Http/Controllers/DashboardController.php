<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login.form');
        }

        if (isset($user->role) && $user->role === 'admin') {
            return view('dashboard.admin', compact('user'));
        }

        return view('dashboard.user', compact('user'));
    }
}
