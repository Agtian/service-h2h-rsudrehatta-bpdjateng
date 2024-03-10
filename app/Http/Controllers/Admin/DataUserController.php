<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataUserController extends Controller
{
    public function index()
    {
        return view('template-dashboard.layouts.data-user.index');
    }
}
