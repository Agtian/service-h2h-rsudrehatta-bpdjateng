<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DataUserController extends Controller
{
    public function index()
    {
        return view('template-dashboard.layouts.data-user.index', [
            'resultUsers'   => User::paginate(10)
        ]);
    }
}
