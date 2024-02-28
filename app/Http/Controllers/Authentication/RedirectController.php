<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectController extends Controller
{
    public function cekAksesDashboard()
    {
        if (auth()->user()->level_user == 1) {
            // Akses user
            return redirect('/home');
        } else if (auth()->user()->level_user == 2) {
            // Akses admin
            return redirect('/dashboard');
        } else {
            return redirect('/register');
        }
    }
}
